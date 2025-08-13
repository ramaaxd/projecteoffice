<?php
include 'koneksi.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';
if (empty($id)) {
    die("ID tidak ditemukan.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama           = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $jabatan  = mysqli_real_escape_string($koneksi, $_POST['jabatan']);
    $alamat         = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $no_telp        = mysqli_real_escape_string($koneksi, $_POST['no_telp']);
    $email          = mysqli_real_escape_string($koneksi, $_POST['email']);

    $update = "UPDATE personal SET 
                nama='$nama',
                jabatan='$jabatan',
                alamat='$alamat',
                no_telp='$no_telp',
                email='$email'
               WHERE id_personal='$id'";

    if (mysqli_query($koneksi, $update)) {
        header("Location: personal.php?status=updated");
        exit;
    } else {
        echo "Gagal memperbarui data: " . mysqli_error($koneksi);
    }
}

$query = mysqli_query($koneksi, "SELECT * FROM personal WHERE id_personal='$id'");
$data = mysqli_fetch_assoc($query);
if (!$data) {
    die("Data tidak ditemukan.");
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
    <form method="POST">
        <input type="text" name="nama" value="<?php echo $data['nama']; ?>" required>
        <input type="text" name="jabatan" value="<?php echo $data['jabatan']; ?>" required>
        <input type="text" name="alamat" value="<?php echo $data['alamat']; ?>" required>
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
