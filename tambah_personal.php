<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $ttl = mysqli_real_escape_string($koneksi, $_POST['ttl']);
    $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $jabatan = mysqli_real_escape_string($koneksi, $_POST['jabatan']);
    $no_telp = mysqli_real_escape_string($koneksi, $_POST['no_telp']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);

    $foto = "default.jpg"; // default kalau tidak upload

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "profile/";

        // Pastikan folder ada
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        // Ekstensi file
        $ext = strtolower(pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (in_array($ext, $allowed)) {
            // Hash isi file
            $hash = md5_file($_FILES["foto"]["tmp_name"]);
            $newName = $hash . "." . $ext;
            $targetFile = $targetDir . $newName;

            // Kalau belum ada → simpan
            if (!file_exists($targetFile)) {
                move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFile);
            }

            $foto = $newName; // simpan nama file
        }
    }

    // Insert data
    $sql = "INSERT INTO personal (nama, ttl, jenis_kelamin, alamat, jabatan, no_telp, email, foto)
            VALUES ('$nama', '$ttl', '$jenis_kelamin', '$alamat', '$jabatan', '$no_telp', '$email', '$foto')";

    if (mysqli_query($koneksi, $sql)) {
        header("Location: personal.php?status=added");
        exit;
    } else {
        echo "Gagal: " . mysqli_error($koneksi);
    }
}
?>