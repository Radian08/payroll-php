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
        <b>Riwayat Absensi</b>
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

        <table>
            <thead>
                <tr>
                    <td>No</td>
                    <td>Hari</td>
                    <td>Tanggal</td>
                    <td>Jam Masuk</td>
                    <td>Jam Pulang</td>
                    <td>Note</td>
                </tr>
            </thead>
            <tbody>
               <?php
                    $no = 1;
                    for($hari=1; $hari <= $jumlah_hari; $hari++):
                        $tanggal_absen = sprintf("%04d-%02d-%02d", $filter_tahun, $filter_bulan, $hari);
                        $no_hari = date('N', strtotime($tanggal_absen));

                        $query_get_absen = "select * from attendances where userid = '$userid' and attendance_date = '$tanggal_absen'";
                        $run_query_get_absen = mysqli_query($conn, $query_get_absen);
                        $result = mysqli_fetch_object($run_query_get_absen);

                        $check_in = ($result && $result->check_in) ? date("H:i", strtotime($result->check_in)) : '--:--';
                        $check_out = ($result && $result->check_out) ? date("H:i", strtotime($result->check_out)) : '--:--';
                        $note = ($result) ? $result->notes : '-';
               ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $ref_day[$no_hari] ?></td>
                    <td><?= $tanggal_absen ?></td>
                    <td><?= $check_in ?></td>
                    <td><?= $check_out ?></td>
                    <td><?= $note ?></td>
                </tr>
               <?php endfor ?>
            </tbody>
        </table>

    </div>
</div>  
<?php include 'layouts/footer.php' ?>