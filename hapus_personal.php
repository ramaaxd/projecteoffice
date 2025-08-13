<?php
include 'koneksi.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';
if (empty($id)) {
    die("ID tidak ditemukan.");
}

$hapus = mysqli_query($koneksi, "DELETE FROM personal WHERE id_personal='$id'");
if ($hapus) {
    header("Location: personal.php?status=deleted");
} else {
    echo "Gagal menghapus data: " . mysqli_error($koneksi);
}
?>
