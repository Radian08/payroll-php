<?php
    include 'layouts/header.php';

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $query_get = "select * from leave_requests where id = '$id'";
        $run_query_get = mysqli_query($conn, $query_get);
        $result = mysqli_fetch_object($run_query_get);

        if(!$result){
            header("location: riwayat-cuti.php");
        }
    }

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
        $query_update = "update leave_requests set leave_type = '$leave_type', start_date = '$start_date', end_date = '$end_date', total_days = '$total_days', reason = '$reason' where id = '$id'";
        $run_query_update = mysqli_query($conn, $query_update);

        if($run_query_update){
            echo "<script>
                    alert('Pengajuan cuti berhasil diubah');
                    window.location.href='riwayat-cuti.php'
                </script>";
        } else {
            // echo mysqli_error($conn);
            echo "<script>
                    alert('Pengajuan cuti gagal diubah');
                </script>";
        }
    }

?>
<div class="box w-30">
    <div class="box-header">
        <b>Edit Cuti</b>
    </div>

    <div class="box-content">
        <form action="" method="post">
            <div class="form-group">
                <label>Jenis Cuti</label>
                <select name="leave_type" required>
                    <option value="">Pilih</option>
                    <option value="Cuti Tahunan" <?= $result->leave_type == 'Cuti Tahunan' ? 'selected':'' ?>>Cuti Tahunan</option>
                    <option value="Cuti Sakit" <?= $result->leave_type == 'Cuti Sakit' ? 'selected':'' ?>>Cuti Sakit</option>
                    <option value="Cuti Melahirkan" <?= $result->leave_type == 'Cuti Melahirkan' ? 'selected':'' ?>>Cuti Melahirkan</option>
                    <option value="Cuti Ayah/Cuti Kelahiran Anak" <?= $result->leave_type == 'Cuti Ayah/Cuti Kelahiran Anak' ? 'selected':'' ?>>Cuti Ayah/Cuti Kelahiran Anak</option>
                    <option value="Cuti Menikah" <?= $result->leave_type == 'Cuti Menikah' ? 'selected':'' ?>>Cuti Menikah</option>
                    <option value="Cuti Duka" <?= $result->leave_type == 'Cuti Duka' ? 'selected':'' ?>>Cuti Duka</option>
                </select>
            </div>
            <div class="form-group">
                <label>Tanggal Mulai</label>
                <input type="date" name="start_date" value="<?= $result->start_date ?>" required>
            </div>
            <div class="form-group">
                <label>Tanggal Selesai</label>
                <input type="date" name="end_date" value="<?= $result->end_date ?>" required>
            </div>
            <div class="form-group">
                <label>Alasan</label>
                <textarea name="reason" ><?= $result->reason ?></textarea>
            </div>
            <button type="button" onclick="window.location.href='riwayat-cuti.php'" class="btn btn-light">Kembali</button>
            <button type="submit" name="simpan" class="btn btn-dark">Simpan Perubahan</button>
        </form>
    </div>
</div>  
<?php include 'layouts/footer.php' ?>