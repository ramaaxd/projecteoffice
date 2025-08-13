<?php
include 'koneksi.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';
if (empty($id)) {
    die("ID tidak ditemukan.");
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
    <title>Detail Data Personal</title>
    <link rel="stylesheet" href="personal_action.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<div class="detail-card">
    <div class="detail-header">
        <i class="fas fa-user-circle profile-icon"></i>
        <h2><?php echo $data['nama']; ?></h2>
        <p><?php echo $data['email']; ?></p>
    </div>
    <div class="detail-body">
        <table>
            <tr>
                <th>ID</th>
                <td><?php echo $data['id_personal']; ?></td>
            </tr>
            <tr>
                <th>Nama</th>
                <td><?php echo $data['nama']; ?></td>
            </tr>
            <tr>
                <th>Jabatan</th>
                <td><?php echo $data['jabatan']; ?></td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td><?php echo $data['alamat']; ?></td>
            </tr>
            <tr>
                <th>No. Telepon</th>
                <td><?php echo $data['no_telp']; ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $data['email']; ?></td>
            </tr>
        </table>
    </div>
    <div class="detail-footer">
    <a href="edit_personal.php?id=<?php echo $data['id_personal']; ?>" class="btn-edit">
        <i class="fas fa-edit"></i> Edit
    </a>
    <button type="button" class="btn-hapus" id="btnHapus">
        <i class="fas fa-trash"></i> Hapus
    </button>
    <a href="personal.php" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>
</div>

<script>
document.getElementById('btnHapus').addEventListener('click', function() {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data ini akan dihapus secara permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "hapus_personal.php?id=<?php echo $data['id_personal']; ?>";
        }
    });
});
</script>

</body>
</html>
