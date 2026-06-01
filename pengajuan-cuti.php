<?php
    include 'layouts/header.php';

    if(isset($_POST['simpan'])){
        $leave_type  = $_POST['leave_type'];
        $start_date  = $_POST['start_date'];
        $end_date    = $_POST['end_date'];
        $reason      = $_POST['reason'];

        $start = new DateTime($start_date);
        $end   = new DateTime($end_date);

        $end->modify("+1 days");

        $calc = $start->diff($end);
        $total_days = $calc->days;

        // echo $total_days;
        // exit;
        $query_insert = "insert into leave_requests (userid, leave_type, start_date, end_date, total_days, reason, status) values ('$userid', '$leave_type', '$start_date', '$end_date', '$total_days', '$reason', 'pending')";
        $run_query_insert = mysqli_query($conn, $query_insert);

        if($run_query_insert){
            echo "<script>
                    alert('Pengajuan cuti berhasil disimpan');
                    window.location.href='pengajuan-cuti.php'
                </script>";
        } else {
            // echo mysqli_error($conn);
            echo "<script>
                    alert('Pengajuan cuti gagal disimpan');
                </script>";
        }
    }

?>
<div class="box w-30">
    <div class="box-header">
        <b>Pengajuan Cuti</b>
    </div>

    <div class="box-content">
        <form action="" method="post">
            <div class="form-group">
                <label>Jenis Cuti</label>
                <select name="leave_type" required>
                    <option value="">Pilih</option>
                    <option value="Cuti Tahunan">Cuti Tahunan</option>
                    <option value="Cuti Sakit">Cuti Sakit</option>
                    <option value="Cuti Melahirkan">Cuti Melahirkan</option>
                    <option value="Cuti Ayah/Cuti Kelahiran Anak">Cuti Ayah/Cuti Kelahiran Anak</option>
                    <option value="Cuti Menikah">Cuti Menikah</option>
                    <option value="Cuti Duka">Cuti Duka</option>
                </select>
            </div>
            <div class="form-group">
                <label>Tanggal Mulai</label>
                <input type="date" name="start_date" required>
            </div>
            <div class="form-group">
                <label>Tanggal Selesai</label>
                <input type="date" name="end_date" required>
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