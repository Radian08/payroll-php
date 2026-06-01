<?php
    session_start();
    include 'config/db.php';

    if(isset($_POST['login'])){
        // tampung data username dan password
        $username = $_POST['username'];
        $password = $_POST['password'];

        // cek data di database
        $query_check = "select * from users where username = '$username'";
        $run_query_check = mysqli_query($conn, $query_check);
        $result = mysqli_fetch_object($run_query_check);
        
        if($result){
            // jika data ada

            if(password_verify($password, $result->password)){

                $_SESSION['logged_in'] = true;
                $_SESSION['uid'] = $result->id;
                $_SESSION['uname'] = $result->name;
                $_SESSION['urole'] = $result->role;
    
                echo "<script>
                        alert('Login berhasil');
                        window.location.href='index.php'
                    </script>";

            } else {
                echo "<script>alert('Username atau password salah')</script>";
            }
        } else {
            // jika data tidak ada
            echo "<script>alert('Username atau password salah')</script>";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Payroll Online</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap');
        * {
            box-sizing: border-box;
        }
        body {
            font-family: "Rubik", sans-serif;
            margin:0;
            padding:0;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 300px;
            min-height: 100px;
        }
        .box {
            border:1px solid #ccc;
            background-color: white;
            border-radius: 5px;
        }
        .box-header {
            border-bottom:1px solid #ccc;
            padding: 15px;
        }
        .box-content {
            padding: 15px;
        }
        .form-group {
            margin-bottom: 10px;
        }
        .form-group input {
            padding: 8px 12px;
            width: 100%;
        }
        .btn {
            border: none;
            padding: 10px 15px;
            width: 100%;
            background-color: #333;
            color: white;
            cursor: pointer;
        }
    </style>
</head>
<body>
    
    <div class="container">

        <h1 style="text-align: center;">Payroll Online</h1>

        <div class="box">
            <div class="box-header">
                <b>Login</b>
            </div>

            <div class="box-content">
                <form action="" method="post">
                    <div class="form-group">
                        <input type="text" name="username" placeholder="Masukkan username" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Masukkan password" required>
                    </div>
                    <button type="submit" name="login" class="btn">Login</button>
                </form>
            </div>
        </div>

        <p style="text-align: center;"><small>copyright &copy; 2025 - Payroll Online.<br /> versi 1.0.0</small></p>

    </div>

</body>
</html>