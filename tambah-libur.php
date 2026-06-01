<?php
    include 'layouts/header.php';

    if(isset($_POST['simpan'])){
        $holiday_name  = $_POST['holiday_name'];
        $holiday_date  = $_POST['holiday_date'];

        $query_insert = "insert into public_holidays (holiday_name, holiday_date, created_by) values ('$holiday_name', '$holiday_date', '$userid')";
        $run_query_insert = mysqli_query($conn, $query_insert);

        if($run_query_insert){
            echo "<script>
                    alert('Data berhasil disimpan');
                    window.location.href='libur-nasional.php'
                </script>";
        } else {
            // echo mysqli_error($conn);
            echo "<script>
                    alert('Data gagal disimpan');
                </script>";
        }
    }

?>
<div class="box w-30">
    <div class="box-header">
        <b>Tambah Libur Nasional</b>
    </div>

    <div class="box-content">
        <form action="" method="post">
            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="holiday_date" required>
            </div>
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="holiday_name" required>
            </div>
            <button type="button" onclick="window.location.href='libur-nasional.php'" class="btn btn-light">Kembali</button>
            <button type="submit" name="simpan" class="btn btn-dark">Simpan</button>
        </form>
    </div>
</div>  
<?php include 'layouts/footer.php' ?>