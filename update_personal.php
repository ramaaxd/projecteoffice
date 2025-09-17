<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_personal'];
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $ttl = mysqli_real_escape_string($koneksi, $_POST['ttl']);
    $jk = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $jabatan = mysqli_real_escape_string($koneksi, $_POST['jabatan']);
    $no_telp = mysqli_real_escape_string($koneksi, $_POST['no_telp']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);

    // Ambil data lama untuk cek foto lama
    $res = mysqli_query($koneksi, "SELECT foto FROM personal WHERE id_personal='$id'");
    $oldData = mysqli_fetch_assoc($res);
    $oldFoto = $oldData['foto'] ?? "default.jpg";

    $foto = $oldFoto; // default pakai foto lama

    // Cek kalau ada foto baru
    if (isset($_FILES['foto']) && is_uploaded_file($_FILES['foto']['tmp_name'])) {
        $target_dir = "profile/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (in_array($ext, $allowed)) {
            $new_name = "profile_" . time() . "." . $ext;
            $target_file = $target_dir . $new_name;

            // Hapus foto lama (asal bukan default.png)
            if (!empty($oldFoto) && $oldFoto !== "default.jpg" && file_exists($target_dir . $oldFoto)) {
                unlink($target_dir . $oldFoto);
            }

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
                $foto = $new_name;
            }
        }
    }

    // query update
    $sql = "UPDATE personal SET 
                nama='$nama',
                ttl='$ttl',
                jenis_kelamin='$jk',
                alamat='$alamat',
                jabatan='$jabatan',
                no_telp='$no_telp',
                email='$email',
                foto='$foto'
            WHERE id_personal='$id'";

    if (mysqli_query($koneksi, $sql)) {
        header("Location: personal.php?status=updated");
        exit;
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>