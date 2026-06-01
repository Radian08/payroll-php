<?php
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db   = 'payroll_db';

    $conn = mysqli_connect($host, $user, $pass, $db) or die ("Failed to connect database");