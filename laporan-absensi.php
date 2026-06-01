<?php
    include 'layouts/header.php';

    if(isset($_GET['bulan'])){
        if($_GET['bulan'] == ''){
            $filter_bulan = date('m');
        } else {
            $filter_bulan = $_GET['bulan'];
        }
    } else {
        $filter_bulan = date('m');
    }

    if(isset($_GET['tahun'])){
        if($_GET['tahun'] == ''){
            $filter_tahun = date('Y');
        } else {
            $filter_tahun = $_GET['tahun'];
        }
    } else {
        $filter_tahun = date('Y');
    }

    $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $filter_bulan, $filter_tahun);
?>
<div class="box">
    <div class="box-header">
        <b>Laporan Absensi</b>
    </div>

    <div class="box-content">
        <form action="" style="margin-bottom:10px;">
            <select name="bulan">
                <option value="">Pilih Bulan</option>
                <?php foreach($ref_month as $i => $v): ?>
                    <option value="<?= $i ?>" <?= $filter_bulan == $i ? 'selected': '' ?>><?= $v ?></option>
                <?php endforeach ?>
            </select>
            <select name="tahun">
                <option value="">Pilih Tahun</option>
                <?php for($tahun=date('Y') - 5; $tahun <= date('Y'); $tahun++): ?>
                    <option value="<?= $tahun ?>" <?= $filter_tahun == $tahun ? 'selected': '' ?>><?= $tahun ?></option>
                <?php endfor ?>
            </select>
            <button type="submit" name="filter">Filter</button>
        </form>

        <div class="box-table">
        <table>
            <thead>
                <tr>
                    <td rowspan="2">No</td>
                    <td rowspan="2">Nama</td>
                    <td align="center" colspan="<?= $jumlah_hari ?>"><?= $ref_month[$filter_bulan] ?></td>
                    <td rowspan="2">Total Masuk</td>
                </tr>
                <tr>
                    <?php for($hari=1; $hari<=$jumlah_hari; $hari++): ?>
                    <td><?= $hari ?></td>
                    <?php endfor ?>
                </tr>
            </thead>
            <tbody>
                <?php
                    $query_get_users = "select * from users order by name";
                    $run_query_get_users = mysqli_query($conn, $query_get_users);
                    $no=1;
                    while($row = mysqli_fetch_array($run_query_get_users)):
                        $total_masuk = 0;
                ?>
               <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['name'] ?></td>
                    <?php
                        for($hari=1; $hari<=$jumlah_hari; $hari++):
                            $tanggal_absen = sprintf("%04d-%02d-%02d", $filter_tahun, $filter_bulan, $hari);
                            $tooltip = '';
                            // cek cuti
                            $query_cuti = "select * from leave_requests where '$tanggal_absen' between start_date and end_date and userid = '$row[id]' and status = 'approved'";
                            $run_query_cuti = mysqli_query($conn, $query_cuti);
                            $result_cuti = mysqli_fetch_object($run_query_cuti);

                            // cek libur nasional
                            $query_libur = "select * from public_holidays where holiday_date = '$tanggal_absen'";
                            $run_query_libur = mysqli_query($conn, $query_libur);
                            $result_libur = mysqli_fetch_object($run_query_libur);


                            // cek hari sabtu dan minggu
                            $no_hari = date('N', strtotime($tanggal_absen));
                            $is_weekend = ($no_hari == '6' || $no_hari == '7');

                            $query_get_absen = "select * from attendances where userid = '$row[id]' and attendance_date = '$tanggal_absen'";
                            $run_query_get_absen = mysqli_query($conn, $query_get_absen);
                            $result = mysqli_fetch_object($run_query_get_absen);


                            if($result && $result->check_out){
                                $absen = '🟢';
                                $tooltip = 'Hadir';
                                $total_masuk++;
                            } elseif($result_cuti){
                                $absen = '🟡';
                                $tooltip = $result_cuti->leave_type;
                            } elseif($result_libur){
                                $absen = '⚫';
                                $tooltip = $result_libur->holiday_name;
                            } elseif($is_weekend){
                                $absen = '⚫';
                                $tooltip = 'Weekend';
                            } else {
                                $absen = '🔴';
                                $tooltip = 'Tidak Hadir';
                            }
                    ?>
                    <td title="<?= $tooltip ?>"><?= $absen ?></td>
                    <?php endfor ?>
                    <td><?= $total_masuk ?></td>
               </tr>
               <?php endwhile ?>
            </tbody>
        </table>
        </div>

    </div>
</div>  
<?php include 'layouts/footer.php' ?>