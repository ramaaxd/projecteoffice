<?php
include 'koneksi.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';
if (empty($id)) {
    die("ID tidak ditemukan.");
}

// Ambil data lama
$query = mysqli_query($koneksi, "SELECT * FROM personal WHERE id_personal='$id'");
$data = mysqli_fetch_assoc($query);
if (!$data) {
    die("Data tidak ditemukan.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $ttl = mysqli_real_escape_string($koneksi, $_POST['ttl']);
    $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $jabatan = mysqli_real_escape_string($koneksi, $_POST['jabatan']);
    $no_telp = mysqli_real_escape_string($koneksi, $_POST['no_telp']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);

    // Default pakai foto lama
    $foto = $data['foto'] ?? null;

    // Cek upload foto baru
    if (isset($_FILES['foto']) && is_uploaded_file($_FILES['foto']['tmp_name'])) {
        $target_dir = "profile/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        $ext = strtolower(pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (in_array($ext, $allowed)) {
            // hitung hash file
            $hash = md5_file($_FILES['foto']['tmp_name']);
            $new_name = $hash . "." . $ext;
            $target_file = $target_dir . $new_name;

            // kalau file belum ada → simpan
            if (!file_exists($target_file)) {
                move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);
            }

            // hapus foto lama (asal bukan default)
            if (!empty($data['foto']) && $data['foto'] !== "default.jpg" && file_exists($target_dir . $data['foto'])) {
                unlink($target_dir . $data['foto']);
            }

            // simpan nama file di DB
            $foto = $new_name;
        }
    }


    // Update database
    $update = "UPDATE personal SET 
                nama='$nama',
                ttl='$ttl',
                jenis_kelamin='$jenis_kelamin',
                alamat='$alamat',
                jabatan='$jabatan',
                no_telp='$no_telp',
                email='$email',
                foto='$foto'
               WHERE id_personal='$id'";

    if (mysqli_query($koneksi, $update)) {
        header("Location: personal.php?status=updated");
        exit;
    } else {
        echo "Gagal memperbarui data: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit Data Personal</title>
    <link rel="stylesheet" href="personal_action.css">
</head>

<body>
    <div class="form-container">
        <h2>Edit Data Personal</h2>
        <form method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <?php
                $fotoPath = !empty($data['foto']) ? "profile/" . $data['foto'] : "profile/default.png";
                ?>
                <img src="<?php echo $fotoPath; ?>" width="80" height="80" style="border-radius:50%;"><br>
                <input type="file" name="foto">
            </div>

            <input type="text" name="nama" value="<?php echo $data['nama']; ?>" required>
            <input type="text" name="ttl" value="<?php echo $data['ttl']; ?>" required>

            <div class="form-group">
                <select name="jenis_kelamin" id="jenis_kelamin" required>
                    <option value="Laki-laki" <?php if ($data['jenis_kelamin'] == 'Laki-laki')
                        echo 'selected'; ?>>
                        Laki-laki
                    </option>
                    <option value="Perempuan" <?php if ($data['jenis_kelamin'] == 'Perempuan')
                        echo 'selected'; ?>>
                        Perempuan
                    </option>
                </select>
            </div>

            <input type="text" name="alamat" value="<?php echo $data['alamat']; ?>" required>
            <input type="text" name="jabatan" value="<?php echo $data['jabatan']; ?>" required>
            <input type="text" name="no_telp" value="<?php echo $data['no_telp']; ?>" required>
            <input type="email" name="email" value="<?php echo $data['email']; ?>" required>

            <div class="form-buttons">
                <button type="submit" class="btn-save">Simpan</button>
                <a href="personal.php" class="btn-cancel">Batal</a>
            </div>
        </form>
    </div>
</body>

</html>