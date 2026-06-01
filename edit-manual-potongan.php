<?php
    include 'layouts/header.php';

    $employees = mysqli_fetch_all(mysqli_query($conn, "select id, name from users"), MYSQLI_ASSOC);

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $query_get = "select * from manual_deductions where id = '$id'";
        $run_query_get = mysqli_query($conn, $query_get);
        $result = mysqli_fetch_object($run_query_get);

        if(!$result){
            header("location: manual-potongan.php");
        }
    }

    if(isset($_POST['simpan'])){
        $payroll_month  = $_POST['payroll_month'];
        $payroll_year  = $_POST['payroll_year'];
        $userid  = $_POST['userid'];
        $name  = $_POST['name'];
        $amount  = $_POST['amount'];

        $query_update = "update manual_deductions set userid = '$userid', name = '$name', amount = '$amount', payroll_month = '$payroll_month', payroll_year = '$payroll_year' where id = '$id'";
        $run_query_update = mysqli_query($conn, $query_update);

        if($run_query_update){
            echo "<script>
                    alert('Data berhasil diubah');
                    window.location.href='manual-potongan.php'
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
        <b>Edit Manual Potongan</b>
    </div>

    <div class="box-content">
    <form action="" method="post">
            <div class="form-group">
                <label>Bulan</label>
                <select name="payroll_month">
                    <option value="">Pilih</option>
                    <?php foreach($ref_month as $i => $v): ?>
                        <option value="<?= $i ?>" <?= $result->payroll_month == $i ? 'selected':'' ?>><?= $v ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <label>Tahun</label>
                <select name="payroll_year">
                    <option value="">Pilih</option>
                    <?php for($tahun = date('Y') - 1; $tahun <= date('Y'); $tahun++): ?>
                        <option value="<?= $tahun ?>" <?= $result->payroll_year == $tahun ? 'selected':'' ?>><?= $tahun ?></option>
                    <?php endfor ?>
                </select>
            </div>
            <div class="form-group">
                <label>Karyawan</label>
                <select name="userid">
                    <option value="">Pilih</option>
                    <?php foreach($employees as $v): ?>
                        <option value="<?= $v['id'] ?>" <?= $result->userid == $v['id'] ? 'selected':'' ?>><?= $v['name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="name" value="<?= $result->name ?>" required>
            </div>
            <div class="form-group">
                <label>Nominal</label>
                <input type="text" name="amount" value="<?= $result->amount ?>" required>
            </div>
            <button type="button" onclick="window.location.href='manual-potongan.php'" class="btn btn-light">Kembali</button>
            <button type="submit" name="simpan" class="btn btn-dark">Simpan Perubahan</button>
        </form>
    </div>
</div>  
<?php include 'layouts/footer.php' ?>