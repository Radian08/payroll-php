<?php
    include 'layouts/header.php';

    $filter_bulan = isset($_GET['bulan']) ? $_GET['bulan'] : '';
    $filter_tahun = isset($_GET['tahun']) ? $_GET['tahun'] : '';

    function get_date_range($tahun, $bulan){
        $start = "$tahun-$bulan-01";
        $end = date('Y-m-t', strtotime($start));
        return [$start, $end];
    }

    function total_hari_kerja($tahun, $bulan, $conn){
        list($start_date, $end_date) = get_date_range($tahun, $bulan);
        $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
        $total_hari_kerja = 0;

        //libur nasional atau cuti bersama
        $libur = mysqli_fetch_all(mysqli_query($conn, "select holiday_date from public_holidays where holiday_date between '$start_date' and '$end_date'"), MYSQLI_ASSOC);
        $tanggal_libur = array_column($libur, 'holiday_date');
        for($hari=1; $hari <= $jumlah_hari; $hari++){
            $tanggal = sprintf("%04d-%02d-%02d", $tahun, $bulan, $hari);
            $no_hari = date('N', strtotime($tanggal));
            if($no_hari == 6 || $no_hari == 7 || in_array($tanggal, $tanggal_libur)){
                continue;
            }
            $total_hari_kerja++;
        }
        return $total_hari_kerja;
    }

    function hitung_upah_lembur($userid, $tahun, $bulan, $tarif, $conn){
        list($start_date, $end_date) = get_date_range($tahun, $bulan);

        $query = "select sum(total_time) as total_jam from overtime_requests where userid = $userid and overtime_date between '$start_date' and '$end_date' and status = 'approved'";
        $result = mysqli_fetch_assoc(mysqli_query($conn, $query));
        $total_jam = $result['total_jam'] ?? 0;

        return $total_jam * $tarif;
    }

    function hitung_tunjangan_jabatan($position_id, $base_salary, $conn){
        $query = "select * from position_allowances where position_id = $position_id";
        $results = mysqli_fetch_all(mysqli_query($conn, $query), MYSQLI_ASSOC);
        $total=0;

        foreach($results as $v){
            $total += $v['allowance_type'] == 'percentage' ? $base_salary * ($v['amount']/100) : $v['amount'];
        }

        return $total;
    }

    function hitung_manual_tunjangan($userid, $bulan, $tahun, $conn){
        $query = "select sum(amount) as total from manual_allowances where userid = $userid and payroll_month = '$bulan' and payroll_year = '$tahun'";
        $result = mysqli_fetch_assoc(mysqli_query($conn, $query));

        return $result['total'] ?? 0;
    }

    function hitung_manual_potongan($userid, $bulan, $tahun, $conn){
        $query = "select sum(amount) as total from manual_deductions where userid = $userid and payroll_month = '$bulan' and payroll_year = '$tahun'";
        $result = mysqli_fetch_assoc(mysqli_query($conn, $query));

        return $result['total'] ?? 0;
    }

    function total_alpha($userid, $tahun, $bulan, $conn){
        list($start_date, $end_date) = get_date_range($tahun, $bulan);
        $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
        $total_alpha = 0;

        //libur nasional atau cuti bersama
        $libur = mysqli_fetch_all(mysqli_query($conn, "select holiday_date from public_holidays where holiday_date between '$start_date' and '$end_date'"), MYSQLI_ASSOC);
        $tanggal_libur = array_column($libur, 'holiday_date');

        //data cuti
        $cuti = mysqli_query($conn, "select start_date, end_date from leave_requests where userid = $userid and (start_date <= '$end_date' and end_date >= '$start_date') and status = 'approved'");

        $tanggal_cuti = [];
        while($v = mysqli_fetch_array($cuti)){
            $start = new DateTime($v['start_date']);
            $end = new DateTime($v['end_date']);
            $interval = new DateInterval('P1D');
            $end->modify('+1 day');

            $range = new DatePeriod($start, $interval, $end);
            foreach($range as $date){
                $tanggal_cuti[] = $date->format('Y-m-d');
            }
        }

        //tanggal absensi
        $absen = mysqli_fetch_all(mysqli_query($conn, "select attendance_date from attendances where userid = $userid and attendance_date between '$start_date' and '$end_date' and check_out is not null"), MYSQLI_ASSOC);
        $tanggal_absen = array_column($absen, 'attendance_date');

        for($hari=1; $hari <= $jumlah_hari; $hari++){
            $tanggal = sprintf("%04d-%02d-%02d", $tahun, $bulan, $hari);
            $no_hari = date('N', strtotime($tanggal));
            if($no_hari == 6 || $no_hari == 7 || in_array($tanggal, $tanggal_libur) || in_array($tanggal, $tanggal_cuti) || in_array($tanggal, $tanggal_absen)){
                continue;
            }
            $total_alpha++;
        }
        return $total_alpha;
    }

    if(isset($_GET['generate'])){
        
         //sql transaksi
         mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
         //start transaction
         mysqli_begin_transaction($conn);

         try {
            //data karyawan
            $query = "select u.id userid, u.name, u.position_id, p.name position_name, p.base_salary, p.overtime_rate from users u left join positions p on u.position_id = p.id order by u.name";
            $run_query = mysqli_query($conn, $query);

            while($v = mysqli_fetch_array($run_query)){

                //cek jika datanya sudah ada
                $cek_payroll = mysqli_fetch_object(mysqli_query($conn, "select * from payrolls where userid = '$v[userid]' and payroll_month = '$filter_bulan' and payroll_year = '$filter_tahun'"));

                //hapus datanya
                if($cek_payroll){
                    mysqli_query($conn, "delete from payrolls where id = $cek_payroll->id");
                    mysqli_query($conn, "delete from payroll_details where payroll_id = $cek_payroll->id");
                }

                //proses hitung total lembur
                $total_lembur = hitung_upah_lembur($v['userid'], $filter_tahun, $filter_bulan, $v['overtime_rate'], $conn);

                //proses hitung total tunjangan
                //1 hitung tunjangan jabatan
                $tunjangan_jabatan = hitung_tunjangan_jabatan($v['position_id'], $v['base_salary'], $conn);
                //2 hitung manual tunjangan
                $manual_tunjangan = hitung_manual_tunjangan($v['userid'], $filter_bulan, $filter_tahun, $conn);

                $total_tunjangan = $tunjangan_jabatan + $manual_tunjangan;

                //proses hitung total potongan
                //1 hitung potongan alpha
                $total_alpha = total_alpha($v['userid'], $filter_tahun, $filter_bulan, $conn);
                $potongan_perhari = round($v['base_salary'] / total_hari_kerja($filter_tahun, $filter_bulan, $conn));
                $potongan_alpha = $total_alpha * $potongan_perhari;
                //2 hitung manual potongan
                $manual_potongan = hitung_manual_potongan($v['userid'], $filter_bulan, $filter_tahun, $conn);

                $total_potongan = $potongan_alpha + $manual_potongan;

                //proses hitung total gaji
                $total_gaji = ($v['base_salary'] + $total_lembur + $total_tunjangan) - $total_potongan;

                //proses insert data gaji
                $insert_payroll = mysqli_query($conn, "insert into payrolls (userid, payroll_month, payroll_year, base_salary, total_overtime, total_allowance, total_deduction, net_salary) values ('$v[userid]', '$filter_bulan', '$filter_tahun', '$v[base_salary]', '$total_lembur', '$total_tunjangan', '$total_potongan', '$total_gaji')");
                $payroll_id = mysqli_insert_id($conn);

                //proses insert data rincian gaji
                //list tunjangan jabatan
                $tunjangan_jabatan_list = mysqli_fetch_all(mysqli_query($conn, "select * from position_allowances where position_id = '$v[position_id]'"), MYSQLI_ASSOC);

                //list manual tunjangan
                $manual_tunjangan_list = mysqli_fetch_all(mysqli_query($conn, "select * from manual_allowances where userid = '$v[userid]' and payroll_month = '$filter_bulan' and payroll_year = '$filter_tahun'"), MYSQLI_ASSOC);

                //list manual potongan
                $manual_potongan_list = mysqli_fetch_all(mysqli_query($conn, "select * from manual_deductions where userid = '$v[userid]' and payroll_month = '$filter_bulan' and payroll_year = '$filter_tahun'"), MYSQLI_ASSOC);

                //insert potongan alpha
                if($total_alpha > 0){
                    mysqli_query($conn, "insert into payroll_details (payroll_id, name, amount, payroll_type) values ('$payroll_id', 'Alpha',  '$potongan_alpha', 'deduction')");
                }

                //insert tunjangan jabatan
                $nominal = 0;
                foreach($tunjangan_jabatan_list as $r){
                    $nominal += $r['allowance_type'] == 'percentage' ? $v['base_salary'] * ($r['amount']/100) : $r['amount'];

                    mysqli_query($conn, "insert into payroll_details (payroll_id, name, amount, payroll_type) values ('$payroll_id', '$r[name]',  '$nominal', 'allowance')");
                }

                //insert manual tunjangan
                foreach($manual_tunjangan_list as $r){
                    mysqli_query($conn, "insert into payroll_details (payroll_id, name, amount, payroll_type) values ('$payroll_id', '$r[name]',  '$r[amount]', 'allowance')");
                }

                //insert manual potongan
                foreach($manual_potongan_list as $r){
                    mysqli_query($conn, "insert into payroll_details (payroll_id, name, amount, payroll_type) values ('$payroll_id', '$r[name]',  '$r[amount]', 'deduction')");
                }

            }

            mysqli_commit($conn);
            echo "<script>
                    alert('Generate Gaji Berhasil');
                    window.location.href='generate-gaji.php'
                </script>";
         } catch (\Throwable $th) {
            mysqli_rollback($conn);
            echo "Error : " . $th->getMessage();
            echo "<script>
                    alert('Generate Gaji Gagal');
                </script>";
         }

    }
?>
<div class="box">
    <div class="box-header">
        <b>Generate Gaji</b>
    </div>

    <div class="box-content">
        <form action="" style="margin-bottom:10px;">
            <select name="bulan" required>
                <option value="">Pilih Bulan</option>
                <?php foreach($ref_month as $i => $v): ?>
                    <option value="<?= $i ?>" <?= $filter_bulan == $i ? 'selected': '' ?>><?= $v ?></option>
                <?php endforeach ?>
            </select>
            <select name="tahun" required>
                <option value="">Pilih Tahun</option>
                <?php for($tahun=date('Y') - 1; $tahun <= date('Y'); $tahun++): ?>
                    <option value="<?= $tahun ?>" <?= $filter_tahun == $tahun ? 'selected': '' ?>><?= $tahun ?></option>
                <?php endfor ?>
            </select>
            <button type="submit" name="preview">Preview</button>
        </form>

        <?php if(isset($_GET['preview']) && $_GET['bulan'] != '' && $_GET['tahun'] != ''): ?>
        <div class="box-table">
            <table>
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Periode</td>
                        <td>Karyawan</td>
                        <td>Jabatan</td>
                        <td>Gaji Pokok</td>
                        <td>Total Lembur</td>
                        <td>Total Tunjangan</td>
                        <td>Total Potongan</td>
                        <td>Total Gaji</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $query = "select u.id userid, u.name, u.position_id, p.name position_name, p.base_salary, p.overtime_rate from users u left join positions p on u.position_id = p.id order by u.name";
                        $run_query = mysqli_query($conn, $query);
                        $no=1;
                        while($v = mysqli_fetch_array($run_query)):

                            //proses hitung total lembur
                            $total_lembur = hitung_upah_lembur($v['userid'], $filter_tahun, $filter_bulan, $v['overtime_rate'], $conn);

                            //proses hitung total tunjangan
                            //1 hitung tunjangan jabatan
                            $tunjangan_jabatan = hitung_tunjangan_jabatan($v['position_id'], $v['base_salary'], $conn);
                            //2 hitung manual tunjangan
                            $manual_tunjangan = hitung_manual_tunjangan($v['userid'], $filter_bulan, $filter_tahun, $conn);

                            $total_tunjangan = $tunjangan_jabatan + $manual_tunjangan;

                            //proses hitung total potongan
                            //1 hitung potongan alpha
                            $total_alpha = total_alpha($v['userid'], $filter_tahun, $filter_bulan, $conn);
                            $potongan_perhari = round($v['base_salary'] / total_hari_kerja($filter_tahun, $filter_bulan, $conn));
                            $potongan_alpha = $total_alpha * $potongan_perhari;
                            //2 hitung manual potongan
                            $manual_potongan = hitung_manual_potongan($v['userid'], $filter_bulan, $filter_tahun, $conn);

                            $total_potongan = $potongan_alpha + $manual_potongan;

                            //proses hitung total gaji
                            $total_gaji = ($v['base_salary'] + $total_lembur + $total_tunjangan) - $total_potongan;
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $ref_month[$filter_bulan] . ' ' . $filter_tahun ?></td>
                        <td><?= $v['name'] ?></td>
                        <td><?= $v['position_name'] ?></td>
                        <td align="right">Rp<?= number_format($v['base_salary'], 0, ",", ".") ?></td>
                        <td align="right">Rp<?= number_format($total_lembur, 0, ",", ".") ?></td>
                        <td align="right">Rp<?= number_format($total_tunjangan, 0, ",", ".") ?></td>
                        <td align="right">Rp<?= number_format($total_potongan, 0, ",", ".") ?></td>
                        <td align="right">Rp<?= number_format($total_gaji, 0, ",", ".") ?></td>
                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
        </div>

        <form action="">
            <input type="hidden" name="bulan" value="<?= $_GET['bulan'] ?>">
            <input type="hidden" name="tahun" value="<?= $_GET['tahun'] ?>">
            <button type="submit" name="generate">Generate</button>
        </form>
        <?php endif ?>
    </div>
</div>  
<?php include 'layouts/footer.php' ?>