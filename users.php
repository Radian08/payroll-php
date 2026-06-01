<?php
    include 'layouts/header.php';

    if(isset($_GET['hapus-user'])){
        $id = $_GET['hapus-user'];

        $query_delete = "delete from users where id = '$id'";
        $run_query_delete = mysqli_query($conn, $query_delete);
        
        if($run_query_delete){
            echo "<script>
                    alert('Hapus berhasil');
                    window.location.href='users.php'
                </script>";
        } else {
            echo "<script>
                    alert('Hapus gagal');
                    window.location.href='users.php'
                </script>";
        }

    }
?>
<div class="box">
    <div class="box-header">
        <b>Data User</b>
    </div>

    <div class="box-content">
        <a href="tambah-user.php">Tambah Data</a>
        <table>
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama</td>
                    <td>Username</td>
                    <td>Role</td>
                    <td>Jabatan</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $query_get_data = "select u.*, p.name position_name from users u left join positions p on u.position_id = p.id order by u.id desc";
                    $run_query_get_data = mysqli_query($conn, $query_get_data);
                    $no = 1;
                    while($row = mysqli_fetch_array($run_query_get_data)):
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['username'] ?></td>
                    <td><?= $row['role'] ?></td>
                    <td><?= $row['position_name'] ?></td>
                    <td>
                        <a href="edit-user.php?id=<?= $row['id'] ?>">Edit</a> | <a href="?hapus-user=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus ?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile ?>
            </tbody>
        </table>

    </div>
</div>  
<?php include 'layouts/footer.php' ?>