<?php
include 'koneksi.php';

// Proses pencarian
$cari = isset($_GET['cari']) ? $_GET['cari'] : '';
$query = "SELECT * FROM personal";
if (!empty($cari)) {
    $query .= " WHERE nama LIKE '%$cari%' OR email LIKE '%$cari%'";
}
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Personal - Sistem Manajemen</title>
    <link rel="stylesheet" href="personal.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="logo">
      <img src="image/th.jpg" alt="Logo" class="logo-img">
      <h2>Sistem Manajemen</h2>
    </div>
    <ul class="menu">
      <li><a href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
      <li><a href="personal.php"><i class="fas fa-user"></i> Personal</a></li>
      <li><a href="komunikasi.php"><i class="fas fa-comments"></i> Komunikasi</a></li>
      <li><a href="tata_usaha.php"><i class="fas fa-building"></i> Tata Usaha</a></li>
      <li><a href="sistem.php"><i class="fas fa-cogs"></i> Sistem</a></li>
      <li><a href="lain_lain.php"><i class="fas fa-ellipsis-h"></i> Lain-Lain</a></li>
      <li><a href="aset.php"><i class="fas fa-boxes"></i> Manajemen Aset</a></li>
      <li><a href="kuesioner.php"><i class="fas fa-question-circle"></i> Kuesioner</a></li>
    </ul>
  </div>

<!-- Konten -->
<div class="content">
    <h1>Data Personal</h1>

    <!-- Search Box & Tombol Tambah -->
    <div class="top-bar">
        <form method="GET" class="search-box">
            <input type="text" name="cari" placeholder="Cari Nama atau Email..." value="<?php echo htmlspecialchars($cari); ?>">
            <button type="submit"><i class="fas fa-search"></i> Cari</button>
        </form>
        <button class="btn-add" onclick="openModal()"><i class="fas fa-plus"></i> Tambah Data</button>
    </div>

    <!-- Tabel Data -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Alamat</th>
                <th>No. Telepon</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr class="data-row">
                    <td><?php echo $row['id_personal']; ?></td>
                    <td><?php echo $row['nama']; ?></td>
                    <td><?php echo $row['jabatan']; ?></td>
                    <td><?php echo $row['alamat']; ?></td>
                    <td><?php echo $row['no_telp']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td>
                        <a href="detail_personal.php?id=<?php echo $row['id_personal']; ?>" class="btn-action btn-detail">
                            <i class="fas fa-info-circle"></i> Detail
                        </a>
                        <a href="edit_personal.php?id=<?php echo $row['id_personal']; ?>" class="btn-action btn-edit">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <button class="btn-action btn-hapus" onclick="confirmDelete(<?php echo $row['id_personal']; ?>)">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Modal Tambah Data -->
<div id="modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Tambah Data Personal</h2>
        <form action="tambah_personal.php" method="POST">
            <input type="text" name="nama" placeholder="Nama" required>
            <input type="text" name="jabatan" placeholder="Jabatan" required>
            <input type="text" name="alamat" placeholder="Alamat" required>
            <input type="text" name="no_telp" placeholder="No. Telepon" required>
            <input type="email" name="email" placeholder="Email" required>
            <button type="submit" class="btn-save">Simpan</button>
        </form>
    </div>
</div>

<script>
function openModal() { document.getElementById('modal').style.display = 'block'; }
function closeModal() { document.getElementById('modal').style.display = 'none'; }

function confirmDelete(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data yang sudah dihapus tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'hapus_personal.php?id=' + id;
        }
    });
}
</script>

</body>
</html>
