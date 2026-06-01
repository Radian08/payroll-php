<?php
    include 'layouts/header.php';

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $query_get = "select * from public_holidays where id = '$id'";
        $run_query_get = mysqli_query($conn, $query_get);
        $result = mysqli_fetch_object($run_query_get);

        if(!$result){
            header("location: libur-nasional.php");
        }
    }

    if(isset($_POST['simpan'])){
        $holiday_name  = $_POST['holiday_name'];
        $holiday_date  = $_POST['holiday_date'];

        $query_update = "update public_holidays set holiday_name = '$holiday_name', holiday_date = '$holiday_date' where id = '$id'";
        $run_query_update = mysqli_query($conn, $query_update);

        if($run_query_update){
            echo "<script>
                    alert('Data berhasil diubah');
                    window.location.href='libur-nasional.php'
                </script>";
        } else {
            // echo mysqli_error($conn);
            echo "<script>
                    alert('Data gagal diubah');
                </script>";
        }
    }

?>
<div class="box w-30">
    <div class="box-header">
        <b>Edit Libur Nasional</b>
    </div>

    <div class="box-content">
        <form action="" method="post">
            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="holiday_date" value="<?= $result->holiday_date ?>" required>
            </div>
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="holiday_name" value="<?= $result->holiday_name ?>" required>
            </div>
            <button type="button" onclick="window.location.href='libur-nasional.php'" class="btn btn-light">Kembali</button>
            <button type="submit" name="simpan" class="btn btn-dark">Simpan Perubahan</button>
        </form>
    </div>
</div>  
<?php include 'layouts/footer.php' ?>