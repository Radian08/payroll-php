<?php
    include 'layouts/header.php';

    $employees = mysqli_fetch_all(mysqli_query($conn, "select id, name from users"), MYSQLI_ASSOC);

    if(isset($_POST['simpan'])){
        $payroll_month  = $_POST['payroll_month'];
        $payroll_year  = $_POST['payroll_year'];
        $userid  = $_POST['userid'];
        $name  = $_POST['name'];
        $amount  = $_POST['amount'];

        $query_insert = "insert into manual_allowances (userid, name, amount, payroll_month, payroll_year) values ('$userid', '$name', '$amount', '$payroll_month', '$payroll_year')";
        $run_query_insert = mysqli_query($conn, $query_insert);

        if($run_query_insert){
            echo "<script>
                    alert('Data berhasil disimpan');
                    window.location.href='manual-tunjangan.php'
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
        <b>Tambah Manual Tunjangan</b>
    </div>

    <div class="box-content">
        <form action="" method="post">
            <div class="form-group">
                <label>Bulan</label>
                <select name="payroll_month">
                    <option value="">Pilih</option>
                    <?php foreach($ref_month as $i => $v): ?>
                        <option value="<?= $i ?>"><?= $v ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <label>Tahun</label>
                <select name="payroll_year">
                    <option value="">Pilih</option>
                    <?php for($tahun = date('Y') - 1; $tahun <= date('Y'); $tahun++): ?>
                        <option value="<?= $tahun ?>"><?= $tahun ?></option>
                    <?php endfor ?>
                </select>
            </div>
            <div class="form-group">
                <label>Karyawan</label>
                <select name="userid">
                    <option value="">Pilih</option>
                    <?php foreach($employees as $v): ?>
                        <option value="<?= $v['id'] ?>"><?= $v['name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Nominal</label>
                <input type="text" name="amount" required>
            </div>
            <button type="button" onclick="window.location.href='manual-tunjangan.php'" class="btn btn-light">Kembali</button>
            <button type="submit" name="simpan" class="btn btn-dark">Simpan</button>
        </form>
    </div>
</div>  
<?php include 'layouts/footer.php' ?>