<?php
    include 'layouts/header.php';

    $list_jabatan = mysqli_fetch_all(mysqli_query($conn, "select * from positions"), MYSQLI_ASSOC);

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $query_check = "select id, name, username, role, position_id from users where id = '$id'";
        $run_query_check = mysqli_query($conn, $query_check);
        $result = mysqli_fetch_object($run_query_check);

        if(!$result){
            header('location: users.php');
            exit;
        }
    }

    if(isset($_POST['simpan'])){
        $id         = $_POST['id'];
        $name       = $_POST['name'];
        $username   = $_POST['username'];
        $password   = $_POST['password'];
        $role       = $_POST['role'];
        $position   = $_POST['position'];

        if(!empty($password)){
            $password = password_hash($password, PASSWORD_DEFAULT);
            $query_update = "update users set name = '$name', username = '$username', role = '$role', password = '$password', position_id = '$position' where id = '$id'";
        } else {
            $query_update = "update users set name = '$name', username = '$username', role = '$role', position_id = '$position' where id = '$id'";
        }
        
        $run_query_update = mysqli_query($conn, $query_update);

        if($run_query_update){
            echo "<script>
                    alert('Data berhasil diubah');
                    window.location.href='users.php'
                </script>";
        } else {
            echo "<script>
                    alert('Data gagal diubah');
                </script>";
        }
    }

?>
<div class="box w-30">
    <div class="box-header">
        <b>Edit User</b>
    </div>

    <div class="box-content">
        <form action="" method="post">
            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
            <div class="form-group">
                <input type="text" name="name" placeholder="Masukkan nama" value="<?= $result->name ?>" required>
            </div>
            <div class="form-group">
                <input type="text" name="username" placeholder="Masukkan username" value="<?= $result->username ?>" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Masukkan password">
                <small>Kosongkan password jika tidak diubah</small>
            </div>
            <div class="form-group">
                <select name="role" required>
                    <option value="">Pilih Role</option>
                    <option value="admin" <?= $result->role == 'admin' ? 'selected':'' ?>>admin</option>
                    <option value="user" <?= $result->role == 'user' ? 'selected':'' ?>>user</option>
                </select>
            </div>
            <div class="form-group">
                <select name="position" required>
                    <option value="">Pilih Jabatan</option>
                    <?php foreach($list_jabatan as $v): ?>
                        <option value="<?= $v['id'] ?>" <?= $result->position_id == $v['id'] ? 'selected':''; ?>><?= $v['name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <button type="button" onclick="window.location.href='users.php'" class="btn btn-light">Kembali</button>
            <button type="submit" name="simpan" class="btn btn-dark">Simpan Perubahan</button>
        </form>
    </div>
</div>  
<?php include 'layouts/footer.php' ?>