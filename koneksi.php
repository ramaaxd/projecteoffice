<?php
$host = "localhost"; // host database
$user = "root";      // username database
$pass = "";          // password database
$db   = "manajemen_sistem"; // ganti sesuai nama database

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>