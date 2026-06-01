<?php
    include 'layouts/header.php';

    if(isset($_GET['hapus-manual-potongan'])){
        $id = $_GET['hapus-manual-potongan'];

        $query_delete = "delete from manual_deductions where id = '$id'";
        $run_query_delete = mysqli_query($conn, $query_delete);
        
        if($run_query_delete){
            echo "<script>
                    alert('Hapus berhasil');
                    window.location.href='manual-potongan.php'
                </script>";
        } else {
            echo "<script>
                    alert('Hapus gagal');
                    window.location.href='manual-potongan.php'
                </script>";
        }

    }
?>
<div class="box">
    <div class="box-header">
        <b>Data Manual Potongan</b>
    </div>

    <div class="box-content">
        <a href="tambah-manual-potongan.php">Tambah Data</a>
        <table>
            <thead>
                <tr>
                    <td>No</td>
                    <td>Periode</td>
                    <td>Karyawan</td>
                    <td>Potongan</td>
                    <td>Nominal</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $query_get_data = "select md.*, u.name emp_name from manual_deductions md left join users u on md.userid = u.id order by md.id desc";
                    $run_query_get_data = mysqli_query($conn, $query_get_data);
                    $no = 1;
                    while($row = mysqli_fetch_array($run_query_get_data)):
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $ref_month[$row['payroll_month']] ?> <?= $row['payroll_year'] ?></td>
                    <td><?= $row['emp_name'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td align="right">Rp<?= number_format($row['amount'],0, ",",".") ?></td>
                    <td>
                        <a href="edit-manual-potongan.php?id=<?= $row['id'] ?>">Edit</a> | <a href="?hapus-manual-potongan=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus ?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile ?>
            </tbody>
        </table>

    </div>
</div>  
<?php include 'layouts/footer.php' ?>