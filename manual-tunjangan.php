<?php
    include 'layouts/header.php';

    if(isset($_GET['hapus-manual-tunjangan'])){
        $id = $_GET['hapus-manual-tunjangan'];

        $query_delete = "delete from manual_allowances where id = '$id'";
        $run_query_delete = mysqli_query($conn, $query_delete);
        
        if($run_query_delete){
            echo "<script>
                    alert('Hapus berhasil');
                    window.location.href='manual-tunjangan.php'
                </script>";
        } else {
            echo "<script>
                    alert('Hapus gagal');
                    window.location.href='manual-tunjangan.php'
                </script>";
        }

    }
?>
<div class="box">
    <div class="box-header">
        <b>Data Manual Tunjangan</b>
    </div>

    <div class="box-content">
        <a href="tambah-manual-tunjangan.php">Tambah Data</a>
        <table>
            <thead>
                <tr>
                    <td>No</td>
                    <td>Periode</td>
                    <td>Karyawan</td>
                    <td>Tunjangan</td>
                    <td>Nominal</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $query_get_data = "select ma.*, u.name emp_name from manual_allowances ma left join users u on ma.userid = u.id order by ma.id desc";
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
                        <a href="edit-manual-tunjangan.php?id=<?= $row['id'] ?>">Edit</a> | <a href="?hapus-manual-tunjangan=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus ?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile ?>
            </tbody>
        </table>

    </div>
</div>  
<?php include 'layouts/footer.php' ?>