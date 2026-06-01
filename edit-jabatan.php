<?php
    include 'layouts/header.php';

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $query_get = "select * from positions where id = '$id'";
        $run_query_get = mysqli_query($conn, $query_get);
        $result = mysqli_fetch_object($run_query_get);

        $tunjangan = mysqli_fetch_all(mysqli_query($conn, "select * from position_allowances where position_id = '$id'"), MYSQLI_ASSOC);

        if(!$result){
            header("location: jabatan.php");
        }
    }

    if(isset($_POST['simpan'])){
        //tampung data jabatan
        $name  = $_POST['name'];
        $base_salary  = $_POST['base_salary'];
        $overtime_rate  = $_POST['overtime_rate'];

        //tampung data tunjangan
        $allowance_names = $_POST['allowance_names'];
        $allowance_types = $_POST['allowance_types'];
        $allowance_amounts = $_POST['allowance_amounts'];

        //sql transaksi
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        //start transaction
        mysqli_begin_transaction($conn);

        try {
            //proses update jabatan
            $query_update = "update positions set name = '$name', base_salary = '$base_salary', overtime_rate = '$overtime_rate' where id = '$id'";
            $run_query_update = mysqli_query($conn, $query_update);

            //proses hapus semua tunjangan berdasarkan id jabatan yang diedit
            mysqli_query($conn, "delete from position_allowances where position_id = '$id'");

            //proses insert tunjangan
            foreach($allowance_names as $i => $allowance_name){
                $amount = $allowance_amounts[$i];
                $type = $allowance_types[$i];
                mysqli_query($conn, "insert into position_allowances (position_id, name, amount, allowance_type) values ('$id', '$allowance_name', '$amount', '$type')");
            }

            mysqli_commit($conn);
            echo "<script>
                    alert('Data berhasil diubah');
                    window.location.href='jabatan.php'
                </script>";
        } catch (\Throwable $th) {
            mysqli_rollback($conn);
            echo "Error : " . $th->getMessage();
            echo "<script>
                    alert('Data gagal diubah');
                </script>";
        }
    }

?>
<div class="box w-60">
    <div class="box-header">
        <b>Edit Jabatan</b>
    </div>

    <div class="box-content">
    <form action="" method="post">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="name" value="<?= $result->name ?>" required>
            </div>
            <div class="form-group">
                <label>Gaji Pokok</label>
                <input type="text" name="base_salary" value="<?= $result->base_salary ?>" required>
            </div>
            <div class="form-group">
                <label>Tarif Lembur (per jam)</label>
                <input type="text" name="overtime_rate" value="<?= $result->overtime_rate ?>" required>
            </div>
            <div class="form-group">
                <label>Tunjangan</label>
                <table>
                    <thead>
                        <tr>
                            <td>Nama</td>
                            <td>Tipe</td>
                            <td>Nilai</td>
                            <td>#</td>
                        </tr>
                    </thead>
                    <tbody id="allowance-container">
                        <?php foreach($tunjangan as $v): ?>
                        <tr>
                            <td><input type="text" name="allowance_names[]" value="<?= $v['name'] ?>" required /></td>
                            <td>
                                <select name="allowance_types[]" required>
                                    <option value="">Pilih</option>
                                    <option value="fixed" <?= $v['allowance_type'] == 'fixed' ? 'selected':'' ?>>Fixed</option>
                                    <option value="percentage" <?= $v['allowance_type'] == 'percentage' ? 'selected':'' ?>>Percentage</option>
                                </select>
                            </td>
                            <td><input type="text" name="allowance_amounts[]" value="<?= $v['amount'] ?>" required /></td>
                            <td><button type="button" onclick="this.parentElement.parentElement.remove()">x</button></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4"><button type="button" onclick="addAllowanceRow()">Tambah Tunjangan</button></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <button type="button" onclick="window.location.href='jabatan.php'" class="btn btn-light">Kembali</button>
            <button type="submit" name="simpan" class="btn btn-dark">Simpan Perubahan</button>
        </form>
    </div>
</div>  
<script>
    function addAllowanceRow(){
        const allowanceContainer = document.getElementById("allowance-container")
        const html = `
            <tr>
                <td><input type="text" name="allowance_names[]" required /></td>
                <td>
                    <select name="allowance_types[]" required>
                        <option value="">Pilih</option>
                        <option value="fixed">Fixed</option>
                        <option value="percentage">Percentage</option>
                    </select>
                </td>
                <td><input type="text" name="allowance_amounts[]" required /></td>
                <td><button type="button" onclick="this.parentElement.parentElement.remove()">x</button></td>
            </tr>
        `
        allowanceContainer.insertAdjacentHTML('beforeend', html)
    }
</script>
<?php include 'layouts/footer.php' ?>