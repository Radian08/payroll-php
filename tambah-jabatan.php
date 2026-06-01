<?php
    include 'layouts/header.php';

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
            //proses insert jabatan
            $query_insert = "insert into positions (name, base_salary, overtime_rate) values ('$name', '$base_salary', '$overtime_rate')";
            $run_query_insert = mysqli_query($conn, $query_insert);
            $position_id = mysqli_insert_id($conn);


            //proses insert tunjangan
            foreach($allowance_names as $i => $allowance_name){
                $amount = $allowance_amounts[$i];
                $type = $allowance_types[$i];
                mysqli_query($conn, "insert into position_allowances (position_id, name, amount, allowance_type) values ('$position_id', '$allowance_name', '$amount', '$type')");
            }

            mysqli_commit($conn);
            echo "<script>
                alert('Data berhasil disimpan');
                window.location.href='jabatan.php'
            </script>";
        } catch (\Throwable $th) {
            //throw $th;
            mysqli_rollback($conn);
            echo "Error : " . $th->getMessage();
            echo "<script>
                    alert('Data gagal disimpan');
                </script>";
        }
    }

?>
<div class="box w-60">
    <div class="box-header">
        <b>Tambah Jabatan</b>
    </div>

    <div class="box-content">
        <form action="" method="post">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Gaji Pokok</label>
                <input type="text" name="base_salary" required>
            </div>
            <div class="form-group">
                <label>Tarif Lembur (per jam)</label>
                <input type="text" name="overtime_rate" required>
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
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4"><button type="button" onclick="addAllowanceRow()">Tambah Tunjangan</button></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <button type="button" onclick="window.location.href='jabatan.php'" class="btn btn-light">Kembali</button>
            <button type="submit" name="simpan" class="btn btn-dark">Simpan</button>
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