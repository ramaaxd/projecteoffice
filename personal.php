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
    <link rel="stylesheet" href="personal_action.css">
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
                <input type="search" name="cari" placeholder="Cari Nama atau Email..."
                    value="<?php echo htmlspecialchars($cari); ?>">
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
                    <th>Tempat/Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Jabatan</th>
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
                        <td><?php echo $row['ttl']; ?></td>
                        <td><?php echo $row['jenis_kelamin']; ?></td>
                        <td><?php echo $row['alamat']; ?></td>
                        <td><?php echo $row['jabatan']; ?></td>
                        <td><?php echo $row['no_telp']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td>
                            <button class="btn-action btn-detail" onclick="openDetailModal(
                                '<?php echo $row['id_personal']; ?>',
                                '<?php echo $row['nama']; ?>',
                                '<?php echo $row['ttl']; ?>',
                                '<?php echo $row['jenis_kelamin']; ?>',
                                '<?php echo $row['alamat']; ?>',
                                '<?php echo $row['jabatan']; ?>',
                                '<?php echo $row['no_telp']; ?>',
                                '<?php echo $row['email']; ?>',
                                '<?php echo $row['foto']; ?>'
                            )">
                                <i class="fas fa-info-circle"></i> Detail
                            </button>

                            <button class="btn-action btn-edit" onclick="openEditModal(
                                '<?php echo $row['id_personal']; ?>',
                                '<?php echo $row['nama']; ?>',
                                '<?php echo $row['ttl']; ?>',
                                '<?php echo $row['jenis_kelamin']; ?>',
                                '<?php echo $row['alamat']; ?>',
                                '<?php echo $row['jabatan']; ?>',
                                '<?php echo $row['no_telp']; ?>',
                                '<?php echo $row['email']; ?>',
                                '<?php echo $row['foto']; ?>'
                            )">
                                <i class="fas fa-edit"></i> Edit
                            </button>

                            <button class="btn-action btn-hapus"
                                onclick="confirmDelete(<?php echo $row['id_personal']; ?>)">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Detail Data -->
    <div id="detailModal" class="modal">
        <div class="modal-content detail-card">
            <span class="close" onclick="closeDetailModal()">&times;</span>
            <div class="detail-header">
                <img id="detailFoto" src="profile/default.jpg" alt="Foto Profil" class="profile-img">
                <h2 id="detailNama">Nama</h2>
                <p id="detailEmail">email@example.com</p>
            </div>
            <div class="detail-body">
                <table>
                    <tr>
                        <th>ID</th>
                        <td id="detailId"></td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td id="detailNamaTabel"></td>
                    </tr>
                    <tr>
                        <th>Tempat/Tanggal Lahir</th>
                        <td id="detailTTL"></td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td id="detailJK"></td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td id="detailAlamat"></td>
                    </tr>
                    <tr>
                        <th>Jabatan</th>
                        <td id="detailJabatan"></td>
                    </tr>
                    <tr>
                        <th>No. Telepon</th>
                        <td id="detailTelp"></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td id="detailEmailTabel"></td>
                    </tr>
                </table>
            </div>
            <div class="detail-footer">
                <button type="button" class="btn-edit" id="btnEditDetail">
                    <i class="fas fa-edit"></i> Edit
                </button>
                <button type="button" class="btn-hapus" id="btnHapusDetail">
                    <i class="fas fa-trash"></i> Hapus
                </button>
                <button type="button" class="btn-back" onclick="closeDetailModal()">
                    <i class="fas fa-arrow-left"></i> Tutup
                </button>
            </div>
        </div>
    </div>


    <!-- Modal Tambah Data -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Tambah Data Personal</h2>
            <form action="tambah_personal.php" method="POST" enctype="multipart/form-data">
                <input type="text" name="nama" placeholder="Nama" required>
                <input type="text" name="ttl" placeholder="Tempat/Tanggal lahir" required>

                <!-- Tambahan Jenis Kelamin -->
                <label class="jenis-kelamin-label">Jenis Kelamin</label>
                <div class="jenis-kelamin">
                    <label><input type="radio" name="jenis_kelamin" value="Laki-laki"> Laki-laki</label>
                    <label><input type="radio" name="jenis_kelamin" value="Perempuan"> Perempuan</label>
                </div>

                <input type="text" name="alamat" placeholder="Alamat" required>
                <input type="text" name="jabatan" placeholder="Jabatan" required>
                <input type="text" name="no_telp" placeholder="No. Telepon" required>
                <input type="email" name="email" placeholder="Email" required>

                <!-- Tambahan Upload Foto -->
                <label for="foto">Upload Foto Profil</label>
                <input type="file" name="foto" accept="profile/*">

                <button type="submit" class="btn-save">Simpan</button>
            </form>
        </div>
    </div>

    <!-- Modal Edit Data -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditModal()">&times;</span>
            <h2>Edit Data Personal</h2>
            <form id="editForm" action="update_personal.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_personal" id="edit_id">

                <div class="form-group">
                    <img id="previewFoto" src="" width="80" height="80" style="border-radius:50%;"><br>
                    <input type="file" name="foto">
                </div>

                <input type="text" name="nama" id="edit_nama" placeholder="Nama" required>
                <input type="text" name="ttl" id="edit_ttl" placeholder="Tempat/Tanggal Lahir" required>

                <label class="jenis-kelamin-label">Jenis Kelamin</label>
                <div class="jenis-kelamin">
                    <label><input type="radio" name="jenis_kelamin" value="Laki-laki" id="edit_laki"> Laki-laki</label>
                    <label><input type="radio" name="jenis_kelamin" value="Perempuan" id="edit_perempuan">
                        Perempuan</label>
                </div>

                <input type="text" name="alamat" id="edit_alamat" placeholder="Alamat" required>
                <input type="text" name="jabatan" id="edit_jabatan" placeholder="Jabatan" required>
                <input type="text" name="no_telp" id="edit_no_telp" placeholder="No. Telepon" required>
                <input type="email" name="email" id="edit_email" placeholder="Email" required>

                <button type="submit" class="btn-save">Simpan Perubahan</button>
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

        function openEditModal(id, nama, ttl, jk, alamat, jabatan, no_telp, email, foto) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_ttl').value = ttl;
            document.getElementById('edit_alamat').value = alamat;
            document.getElementById('edit_jabatan').value = jabatan;
            document.getElementById('edit_no_telp').value = no_telp;
            document.getElementById('edit_email').value = email;

            // cek radio jenis kelamin
            if (jk === 'Laki-laki') {
                document.getElementById('edit_laki').checked = true;
            } else {
                document.getElementById('edit_perempuan').checked = true;
            }

            // tampilkan foto lama
            if (foto) {
                document.getElementById('previewFoto').src = "image/" + foto;
            } else {
                document.getElementById('previewFoto').src = "image/default.png";
            }

            document.getElementById('editModal').style.display = 'block';
        }
        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        function openDetailModal(id, nama, ttl, jk, alamat, jabatan, no_telp, email, foto) {
            document.getElementById('detailId').innerText = id;
            document.getElementById('detailNama').innerText = nama;
            document.getElementById('detailNamaTabel').innerText = nama;
            document.getElementById('detailTTL').innerText = ttl;
            document.getElementById('detailJK').innerText = jk;
            document.getElementById('detailAlamat').innerText = alamat;
            document.getElementById('detailJabatan').innerText = jabatan;
            document.getElementById('detailTelp').innerText = no_telp;
            document.getElementById('detailEmail').innerText = email;
            document.getElementById('detailEmailTabel').innerText = email;

            // Foto
            if (foto) {
                document.getElementById('detailFoto').src = "profile/" + foto;
            } else {
                document.getElementById('detailFoto').src = "profile/default.jpg";
            }

            // Tombol Edit
            document.getElementById('btnEditDetail').onclick = function () {
                openEditModal(id, nama, ttl, jk, alamat, jabatan, no_telp, email, foto);
                closeDetailModal();
            };

            // Tombol Hapus
            document.getElementById('btnHapusDetail').onclick = function () {
                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data ini akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "hapus_personal.php?id=" + id;
                    }
                });
            };

            document.getElementById('detailModal').style.display = 'block';
        }

        function closeDetailModal() {
            document.getElementById('detailModal').style.display = 'none';
        }

    </script>

</body>

</html>