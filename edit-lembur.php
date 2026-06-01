<?php
    include 'layouts/header.php';

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $query_get = "select * from overtime_requests where id = '$id'";
        $run_query_get = mysqli_query($conn, $query_get);
        $result = mysqli_fetch_object($run_query_get);

        if(!$result){
            header("location: riwayat-lembur.php");
        }
    }

    // print_r($result);

    if(isset($_POST['simpan'])){
        $overtime_date  = $_POST['overtime_date'];
        $start_time     = $_POST['start_time'];
        $end_time       = $_POST['end_time'];
        $reason         = $_POST['reason'];

        $start = new DateTime($start_time);
        $end   = new DateTime($end_time);

        // $end->modify("+1 days");

        $calc = $start->diff($end);
        $total_jam = $calc->h;
        $total_menit = $calc->i;

        // echo $total_jam . '<br />';
        // echo $total_menit . '<br />';

        if($total_menit > 0){
            $total_jam += 1;
        }

        // echo $total_days;
        // exit;
        $query_update = "update overtime_requests set overtime_date = '$overtime_date', start_time = '$start_time', end_time = '$end_time', total_time = '$total_jam', reason = '$reason' where id = '$id'";
        $run_query_update = mysqli_query($conn, $query_update);

        if($run_query_update){
            echo "<script>
                    alert('Pengajuan lembur berhasil diubah');
                    window.location.href='riwayat-lembur.php'
                </script>";
        } else {
            // echo mysqli_error($conn);
            echo "<script>
                    alert('Pengajuan lembur gagal diubah');
                </script>";
        }
    }

?>
<div class="box w-30">
    <div class="box-header">
        <b>Edit Lembur</b>
    </div>

    <div class="box-content">
        <form action="" method="post">
            <div class="form-group">
                <label>Tanggal Lembur</label>
                <input type="date" name="overtime_date" value="<?= $result->overtime_date ?>" required>
            </div>
            <div class="form-group">
                <label>Jam Mulai</label>
                <input type="time" name="start_time" value="<?= $result->start_time ?>" required>
            </div>
            <div class="form-group">
                <label>Jam Selesai</label>
                <input type="time" name="end_time" value="<?= $result->end_time ?>" required>
            </div>
            <div class="form-group">
                <label>Alasan</label>
                <textarea name="reason" ><?= $result->reason ?></textarea>
            </div>
            <button type="button" onclick="window.location.href='riwayat-lembur.php'" class="btn btn-light">Kembali</button>
            <button type="submit" name="simpan" class="btn btn-dark">Simpan Perubahan</button>
        </form>
    </div>
</div>  
<?php include 'layouts/footer.php' ?>