<?php
    session_start();
    include 'config/db.php';

    if(!isset($_SESSION['logged_in'])){
        header('location: login.php');
    }

    date_default_timezone_set('Asia/Jakarta');
    $userid = $_SESSION['uid'];
    $ref_day = [1 => "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu", "Minggu"];
    $ref_month = [
        "01" => "Januari",
        "02" => "Februari",
        "03" => "Maret",
        "04" => "April",
        "05" => "Mei",
        "06" => "Juni",
        "07" => "Juli",
        "08" => "Agustus",
        "09" => "September",
        "10" => "Oktober",
        "11" => "November",
        "12" => "Desember"
    ];

    if(isset($_GET['logout'])){
        session_destroy();

        echo "<script>
                alert('Logout berhasil');
                window.location.href='login.php'
            </script>";
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll Online</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <nav class="navbar">
        <a href="index.php" class="navbar-brand">Payroll Online</a>

        <ul>
            <li><a href="index.php">Beranda</a></li>
            <li><a href="riwayat-absensi.php">Riwayat Absensi</a></li>

            <li class="dropdown"><a href="">Cuti</a>
                <ul>
                    <li><a href="pengajuan-cuti.php">Pengajuan</a></li>
                    <li><a href="riwayat-cuti.php">Riwayat</a></li>

                    <?php if($_SESSION['urole'] == 'admin'): ?>
                    <li><a href="approval-cuti.php">Approval</a></li>
                    <?php endif ?>
                </ul>
            </li>

            <li class="dropdown"><a href="">Lembur</a>
                <ul>
                    <li><a href="pengajuan-lembur.php">Pengajuan</a></li>
                    <li><a href="riwayat-lembur.php">Riwayat</a></li>

                    <?php if($_SESSION['urole'] == 'admin'): ?>
                    <li><a href="approval-lembur.php">Approval</a></li>
                    <?php endif ?>
                </ul>
            </li>

            <li class="dropdown"><a href="">Gaji</a>
                <ul>
                    <?php if($_SESSION['urole'] == 'admin'): ?>
                        <li><a href="manual-tunjangan.php">Manual Tunjangan</a></li>
                        <li><a href="manual-potongan.php">Manual Potongan</a></li>
                        <li><a href="generate-gaji.php">Generate Gaji</a></li>
                        <li><a href="riwayat-gaji.php">Riwayat Gaji</a></li>
                    <?php endif ?>
                    <li><a href="slip-gaji.php">Slip Gaji</a></li>
                </ul>
            </li>

            <?php if($_SESSION['urole'] == 'admin'): ?>
                <li><a href="jabatan.php">Jabatan</a></li>
                <li><a href="libur-nasional.php">Libur Nasional</a></li>
                <li><a href="users.php">Data Users</a></li>
                <li class="dropdown"><a href="">Laporan</a>
                    <ul>
                        <li><a href="laporan-absensi.php">Absensi</a></li>
                        <li><a href="laporan-cuti.php">Cuti</a></li>
                        <li><a href="laporan-lembur.php">Lembur</a></li>
                        <li><a href="laporan-gaji.php">Gaji</a></li>
                    </ul>
                </li>
            <?php endif ?>
            
            <li><a href="?logout">Logout</a></li>
        </ul>
    </nav>

    <div class="content">