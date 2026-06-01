<?php
    include 'layouts/header.php';

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
        
        // echo 'total efektif lembur : ' . $total_jam . '<br />';
        // exit;
        $query_insert = "insert into overtime_requests (userid, overtime_date, start_time, end_time, total_time, reason, status) values ('$userid', '$overtime_date', '$start_time', '$end_time', '$total_jam', '$reason', 'pending')";
        $run_query_insert = mysqli_query($conn, $query_insert);

        if($run_query_insert){
            echo "<script>
                    alert('Pengajuan lembur berhasil disimpan');
                    window.location.href='pengajuan-lembur.php'
                </script>";
        } else {
            // echo mysqli_error($conn);
            echo "<script>
                    alert('Pengajuan lembur gagal disimpan');
                </script>";
        }
    }

?>
<div class="box w-30">
    <div class="box-header">
        <b>Pengajuan Lembur</b>
    </div>

    <div class="box-content">
        <form action="" method="post">
            <div class="form-group">
                <label>Tanggal Lembur</label>
                <input type="date" name="overtime_date" required>
            </div>
            <div class="form-group">
                <label>Jam Mulai</label>
                <input type="time" name="start_time" required>
            </div>
            <div class="form-group">
                <label>Jam Selesai</label>
                <input type="time" name="end_time" required>
            </div>
            <div class="form-group">
                <label>Alasan</label>
                <textarea name="reason" ></textarea>
            </div>
            <button type="submit" name="simpan" class="btn btn-dark">Simpan</button>
        </form>
    </div>
</div>  
<?php include 'layouts/footer.php' ?>