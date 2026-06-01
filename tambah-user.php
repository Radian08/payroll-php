<?php
    include 'layouts/header.php';

    $list_jabatan = mysqli_fetch_all(mysqli_query($conn, "select * from positions"), MYSQLI_ASSOC);

    if(isset($_POST['simpan'])){
        $name       = $_POST['name'];
        $username   = $_POST['username'];
        $password   = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role       = $_POST['role'];
        $position   = $_POST['position'];

        $query_insert = "insert into users (name, username, password, role, position_id) values ('$name', '$username', '$password', '$role', '$position')";
        $run_query_insert = mysqli_query($conn, $query_insert);

        if($run_query_insert){
            echo "<script>
                    alert('Data berhasil disimpan');
                    window.location.href='users.php'
                </script>";
        } else {
            echo "<script>
                    alert('Data gagal disimpan');
                </script>";
        }
    }

?>
<div class="box w-30">
    <div class="box-header">
        <b>Tambah User</b>
    </div>

    <div class="box-content">
        <form action="" method="post">
            <div class="form-group">
                <input type="text" name="name" placeholder="Masukkan nama" required>
            </div>
            <div class="form-group">
                <input type="text" name="username" placeholder="Masukkan username" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Masukkan password" required>
            </div>
            <div class="form-group">
                <select name="role" required>
                    <option value="">Pilih Role</option>
                    <option value="admin">admin</option>
                    <option value="user">user</option>
                </select>
            </div>
            <div class="form-group">
                <select name="position" required>
                    <option value="">Pilih Jabatan</option>
                    <?php foreach($list_jabatan as $v): ?>
                        <option value="<?= $v['id'] ?>"><?= $v['name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <button type="button" onclick="window.location.href='users.php'" class="btn btn-light">Kembali</button>
            <button type="submit" name="simpan" class="btn btn-dark">Simpan</button>
        </form>
    </div>
</div>  
<?php include 'layouts/footer.php' ?>