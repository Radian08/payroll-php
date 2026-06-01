<?php
    include 'layouts/header.php';

    if(isset($_GET['hapus-libur'])){
        $id = $_GET['hapus-libur'];

        $query_delete = "delete from public_holidays where id = '$id'";
        $run_query_delete = mysqli_query($conn, $query_delete);
        
        if($run_query_delete){
            echo "<script>
                    alert('Hapus berhasil');
                    window.location.href='libur-nasional.php'
                </script>";
        } else {
            echo "<script>
                    alert('Hapus gagal');
                    window.location.href='libur-nasional.php'
                </script>";
        }

    }
?>
<div class="box">
    <div class="box-header">
        <b>Data Libur Nasional</b>
    </div>

    <div class="box-content">
        <a href="tambah-libur.php">Tambah Data</a>
        <table>
            <thead>
                <tr>
                    <td>No</td>
                    <td>Tanggal</td>
                    <td>Nama</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $query_get_data = "select * from public_holidays order by id desc";
                    $run_query_get_data = mysqli_query($conn, $query_get_data);
                    $no = 1;
                    while($row = mysqli_fetch_array($run_query_get_data)):
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['holiday_date'] ?></td>
                    <td><?= $row['holiday_name'] ?></td>
                    <td>
                        <a href="edit-libur.php?id=<?= $row['id'] ?>">Edit</a> | <a href="?hapus-libur=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus ?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile ?>
            </tbody>
        </table>

    </div>
</div>  
<?php include 'layouts/footer.php' ?>