<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama           = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $tanggal_lahir  = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir']);
    $alamat         = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $no_telp        = mysqli_real_escape_string($koneksi, $_POST['no_telp']);
    $email          = mysqli_real_escape_string($koneksi, $_POST['email']);

    $query = "INSERT INTO personal (nama, tanggal_lahir, alamat, no_telp, email) 
              VALUES ('$nama', '$tanggal_lahir', '$alamat', '$no_telp', '$email')";

    if (mysqli_query($koneksi, $query)) {
        // Kembali ke halaman personal.php setelah berhasil
        header("Location: personal.php");
        exit;
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($koneksi);
    }
} else {
    echo "Metode request tidak valid.";
}
?>
