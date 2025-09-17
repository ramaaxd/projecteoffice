<?php
include 'koneksi.php';

// Helpers
function h($s){ return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }
function like($conn, $s){
  $s = mysqli_real_escape_string($conn, $s);
  return "%$s%";
}

// Filters
$q     = isset($_GET['q']) ? trim($_GET['q']) : '';
$from  = isset($_GET['from']) ? $_GET['from'] : '';
$to    = isset($_GET['to']) ? $_GET['to'] : '';

// Build WHERE per tabel
// --- Pegawai
$sql_pegawai = "SELECT id_pegawai, nama_pegawai, jabatan, alamat, no_telp, tgl_masuk
                FROM pegawai WHERE 1";
if($q !== '') {
  $k = like($koneksi,$q);
  $sql_pegawai .= " AND (nama_pegawai LIKE '$k' OR nip LIKE '$k' OR jabatan LIKE '$k' OR email LIKE '$k')";
}
if($from !== '') $sql_pegawai .= " AND (tgl_masuk >= '".mysqli_real_escape_string($koneksi,$from)."')";
if($to   !== '') $sql_pegawai .= " AND (tgl_masuk <= '".mysqli_real_escape_string($koneksi,$to)."')";
$sql_pegawai .= " ORDER BY tgl_masuk DESC";

// --- Kehadiran
$sql_hadir = "SELECT k.id, k.tanggal_kehadiran, k.jam_masuk, k.jam_keluar, k.status_kehadiran,
                     p.nip, p.nama_pegawai, p.jabatan
              FROM kehadiran k
              LEFT JOIN pegawai p ON p.id_pegawai = k.id_pegawai
              WHERE 1";
if($q !== '') {
  $k = like($koneksi,$q);
  $sql_hadir .= " AND (p.nama_pegawai LIKE '$k' OR p.nip LIKE '$k' OR k.status_kehadiran LIKE '$k')";
}
if($from !== '') $sql_hadir .= " AND (k.tanggal_kehadiran >= '".mysqli_real_escape_string($koneksi,$from)."')";
if($to   !== '') $sql_hadir .= " AND (k.tanggal_kehadiran <= '".mysqli_real_escape_string($koneksi,$to)."')";
$sql_hadir .= " ORDER BY k.tanggal_kehadiran DESC, k.jam_masuk DESC";

// --- Manajemen Surat
$sql_surat = "SELECT id_surat, nomor_surat, jenis_surat, perihal, tgl_surat, pengirim, penerima
              FROM manajemen_surat WHERE 1";
if($q !== '') {
  $k = like($koneksi,$q);
  $sql_surat .= " AND (nomor_surat LIKE '$k' OR perihal LIKE '$k' OR pengirim LIKE '$k' OR penerima LIKE '$k')";
}
if($from !== '') $sql_surat .= " AND (tgl_surat >= '".mysqli_real_escape_string($koneksi,$from)."')";
if($to   !== '') $sql_surat .= " AND (tgl_surat <= '".mysqli_real_escape_string($koneksi,$to)."')";
$sql_surat .= " ORDER BY tgl_surat DESC";

// --- Laporan Kegiatan
$sql_laporan = "SELECT id_laporan, judul_kegiatan, tgl_kegiatan, penanggung_jawab
                FROM laporan_kegiatan WHERE 1";
if($q !== '') {
  $k = like($koneksi,$q);
  $sql_laporan .= " AND (judul_kegiatan LIKE '$k' OR penanggung_jawab LIKE '$k')";
}
if($from !== '') $sql_laporan .= " AND (tgl_kegiatan >= '".mysqli_real_escape_string($koneksi,$from)."')";
if($to   !== '') $sql_laporan .= " AND (tgl_kegiatan <= '".mysqli_real_escape_string($koneksi,$to)."')";
$sql_laporan .= " ORDER BY tgl_kegiatan DESC";

// --- Jadwal Kegiatan
$sql_jadwal = "SELECT id_jadwal, nama_kegiatan, tgl_mulai, tgl_selesai, lokasi_kegiatan
               FROM jadwal_kegiatan WHERE 1";
if($q !== '') {
  $k = like($koneksi,$q);
  $sql_jadwal .= " AND (nama_kegiatan LIKE '$k' OR lokasi_kegiatan LIKE '$k')";
}
if($from !== '') $sql_jadwal .= " AND (tgl_mulai >= '".mysqli_real_escape_string($koneksi,$from)."')";
if($to   !== '') $sql_jadwal .= " AND (tgl_selesai <= '".mysqli_real_escape_string($koneksi,$to)."')";
$sql_jadwal .= " ORDER BY tgl_mulai DESC";

// --- Pelamar Kerja
$sql_pelamar = "SELECT id_pelamar, nama_pelamar, posisi_dilamar, no_telp_pelamar, email_pelamar, status_pelamar
                FROM pelamar_kerja WHERE 1";
if($q !== '') {
  $k = like($koneksi,$q);
  $sql_pelamar .= " AND (nama_pelamar LIKE '$k' OR posisi_dilamar LIKE '$k' OR email_pelamar LIKE '$k')";
}
$sql_pelamar .= " ORDER BY id_pelamar DESC";

// --- SPPD
$sql_sppd = "SELECT id_sppd, tujuan_sppd, tgl_berangkat, tgl_kembali, biaya
             FROM sppd WHERE 1";
if($q !== '') {
  $k = like($koneksi,$q);
  $sql_sppd .= " AND (tujuan_sppd LIKE '$k')";
}
if($from !== '') $sql_sppd .= " AND (tgl_berangkat >= '".mysqli_real_escape_string($koneksi,$from)."')";
if($to   !== '') $sql_sppd .= " AND (tgl_kembali <= '".mysqli_real_escape_string($koneksi,$to)."')";
$sql_sppd .= " ORDER BY tgl_berangkat DESC";

// --- Manajemen Barang
$sql_barang = "SELECT id_barang, nama_barang, kategori_barang, jumlah_barang, kondisi_barang, lokasi_barang, tgl_input_barang
               FROM manajemen_barang WHERE 1";
if($q !== '') {
  $k = like($koneksi,$q);
  $sql_barang .= " AND (nama_barang LIKE '$k' OR kategori_barang LIKE '$k' OR lokasi_barang LIKE '$k')";
}
if($from !== '') $sql_barang .= " AND (tgl_input_barang >= '".mysqli_real_escape_string($koneksi,$from)."')";
if($to   !== '') $sql_barang .= " AND (tgl_input_barang <= '".mysqli_real_escape_string($koneksi,$to)."')";
$sql_barang .= " ORDER BY tgl_input_barang DESC";

// Execute
$rPegawai = mysqli_query($koneksi, $sql_pegawai);
$rKehadiran   = mysqli_query($koneksi, $sql_Kehadiran);
$rSurat   = mysqli_query($koneksi, $sql_surat);
$rLaporan = mysqli_query($koneksi, $sql_laporan);
$rJadwal  = mysqli_query($koneksi, $sql_jadwal);
$rPelamar = mysqli_query($koneksi, $sql_pelamar);
$rSPPD    = mysqli_query($koneksi, $sql_sppd);
$rBarang  = mysqli_query($koneksi, $sql_barang);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Tata Usaha</title>
  <link rel="stylesheet" href="style.css">
  <style>
    /* Tambahan styling ringan agar seragam */
    .content { margin-left: 250px; padding: 20px; }
    .tu-filters{
      display:flex; gap:10px; align-items:center; margin-bottom:16px; flex-wrap:wrap;
      background:#fff; padding:12px 14px; border-radius:8px; box-shadow:0 2px 10px rgba(0,0,0,.06);
    }
    .tu-filters input[type="text"], .tu-filters input[type="date"]{
      padding:8px 10px; border:1px solid #dcdcdc; border-radius:6px;
    }
    .tu-filters button{
      padding:8px 14px; border:none; border-radius:6px; background:#2c3e50; color:#fff; cursor:pointer;
    }
    .tu-wrap{ margin-left:250px; padding:20px; }
    .tu-section{
      background:#fff; border-radius:12px; padding:14px 16px; margin-bottom:22px;
      box-shadow:0 4px 18px rgba(0,0,0,.07);
    }
    .tu-section h2{
      margin:0 0 12px; font-size:18px; display:flex; align-items:center; gap:8px;
      border-left:4px solid #1abc9c; padding-left:10px;
    }
    .tu-table{ width:100%; border-collapse:collapse; }
    .tu-table th,.tu-table td{
      padding:9px 10px; border-bottom:1px solid #eee; text-align:left; font-size:14px;
    }
    .tu-table thead th{ background:#2c3e50; color:#fff; position:sticky; top:0; }
    .tu-badge{ padding:3px 8px; border-radius:999px; font-size:12px; background:#eef2ff; }
    .status-Hadir{ background:#e8fff1; color:#117a3a; }
    .status-Izin{ background:#fffbe6; color:#7a5e11; }
    .status-Sakit{ background:#ffecec; color:#8a1f1f; }
    .status-Alpha{ background:#f0f0f0; color:#444; }
    .empty{ color:#666; font-style:italic; padding:8px 0; }
    @media (max-width: 900px){
      .content, .tu-wrap{ margin-left:0; }
      .tu-table{ display:block; overflow-x:auto; }
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<div class="sidebar">
  <div class="logo">
    <img src="image/th.jpg" alt="Logo" class="logo-img">
    <h2>Sistem Manajemen</h2>
  </div>
  <ul class="menu">
    <li><a href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
    <li><a href="personal.php"><i class="fas fa-user"></i> Personal</a></li>
    <li><a class="active" href="tata_usaha.php"><i class="fas fa-building"></i> Tata Usaha</a></li>
    <li><a href="komunikasi.php"><i class="fas fa-comments"></i> Komunikasi</a></li>
    <li><a href="sistem.php"><i class="fas fa-cogs"></i> Sistem</a></li>
    <li><a href="lain_lain.php"><i class="fas fa-ellipsis-h"></i> Lain-Lain</a></li>
    <li><a href="aset.php"><i class="fas fa-boxes"></i> Manajemen Aset</a></li>
    <li><a href="kuesioner.php"><i class="fas fa-question-circle"></i> Kuesioner</a></li>
  </ul>
</div>

<div class="content">
  <h1>Tata Usaha</h1>

  <!-- Filter Global -->
  <form class="tu-filters" method="get">
    <input type="text" name="q" placeholder="Cari apa saja (nama, perihal, barang, tujuan…)" value="<?=h($q)?>">
    <span>Rentang tanggal:</span>
    <input type="date" name="from" value="<?=h($from)?>">
    <span>s/d</span>
    <input type="date" name="to" value="<?=h($to)?>">
    <button type="submit"><i class="fa fa-search"></i> Terapkan</button>
    <?php if($q || $from || $to): ?>
      <a href="tata_usaha.php" style="margin-left:auto; text-decoration:none;">Reset</a>
    <?php endif; ?>
  </form>

  <!-- Pegawai -->
  <section class="tu-section">
    <h2><i class="fa fa-id-badge"></i> Data Pegawai</h2>
    <?php if(mysqli_num_rows($rPegawai)): ?>
    <table class="tu-table">
      <thead>
        <tr>
          <th>NIP</th><th>Nama</th><th>Jabatan</th><th>Email</th><th>No. Telp</th><th>Tgl Masuk</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = mysqli_fetch_assoc($rPegawai)): ?>
        <tr>
          <td><?=h($row['nip'])?></td>
          <td><?=h($row['nama_pegawai'])?></td>
          <td><?=h($row['jabatan'])?></td>
          <td><?=h($row['email'])?></td>
          <td><?=h($row['no_telp'])?></td>
          <td><?=h($row['tgl_masuk'])?></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
    <?php else: ?><div class="empty">Belum ada data.</div><?php endif; ?>
  </section>

  <!-- Kehadiran -->
  <section class="tu-section">
    <h2><i class="fa fa-user-check"></i> Daftar Kehadiran</h2>
    <?php if(mysqli_num_rows($rHadir)): ?>
    <table class="tu-table">
      <thead>
        <tr>
          <th>Tanggal</th><th>Nama</th><th>NIP</th><th>Jabatan</th><th>Masuk</th><th>Keluar</th><th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = mysqli_fetch_assoc($rHadir)): ?>
        <tr>
          <td><?=h($row['tanggal_kehadiran'])?></td>
          <td><?=h($row['nama_pegawai'])?></td>
          <td><?=h($row['nip'])?></td>
          <td><?=h($row['jabatan'])?></td>
          <td><?=h($row['jam_masuk'])?></td>
          <td><?=h($row['jam_keluar'])?></td>
          <td><span class="tu-badge status-<?=h($row['status_kehadiran'])?>"><?=h($row['status_kehadiran'])?></span></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
    <?php else: ?><div class="empty">Belum ada data.</div><?php endif; ?>
  </section>

  <!-- Manajemen Surat -->
  <section class="tu-section">
    <h2><i class="fa fa-envelope-open-text"></i> Manajemen Surat</h2>
    <?php if(mysqli_num_rows($rSurat)): ?>
    <table class="tu-table">
      <thead>
        <tr>
          <th>Tanggal</th><th>Nomor</th><th>Jenis</th><th>Perihal</th><th>Pengirim</th><th>Penerima</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = mysqli_fetch_assoc($rSurat)): ?>
        <tr>
          <td><?=h($row['tgl_surat'])?></td>
          <td><?=h($row['nomor_surat'])?></td>
          <td><?=h($row['jenis_surat'])?></td>
          <td><?=h($row['perihal'])?></td>
          <td><?=h($row['pengirim'])?></td>
          <td><?=h($row['penerima'])?></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
    <?php else: ?><div class="empty">Belum ada data.</div><?php endif; ?>
  </section>

  <!-- Laporan Kegiatan -->
  <section class="tu-section">
    <h2><i class="fa fa-clipboard-list"></i> Laporan Kegiatan</h2>
    <?php if(mysqli_num_rows($rLaporan)): ?>
    <table class="tu-table">
      <thead>
        <tr>
          <th>Tanggal</th><th>Judul</th><th>PJ</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = mysqli_fetch_assoc($rLaporan)): ?>
        <tr>
          <td><?=h($row['tgl_kegiatan'])?></td>
          <td><?=h($row['judul_kegiatan'])?></td>
          <td><?=h($row['penanggung_jawab'])?></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
    <?php else: ?><div class="empty">Belum ada data.</div><?php endif; ?>
  </section>

  <!-- Jadwal Kegiatan -->
  <section class="tu-section">
    <h2><i class="fa fa-calendar-check"></i> Jadwal Kegiatan</h2>
    <?php if(mysqli_num_rows($rJadwal)): ?>
    <table class="tu-table">
      <thead>
        <tr>
          <th>Mulai</th><th>Selesai</th><th>Nama Kegiatan</th><th>Lokasi</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = mysqli_fetch_assoc($rJadwal)): ?>
        <tr>
          <td><?=h($row['tgl_mulai'])?></td>
          <td><?=h($row['tgl_selesai'])?></td>
          <td><?=h($row['nama_kegiatan'])?></td>
          <td><?=h($row['lokasi_kegiatan'])?></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
    <?php else: ?><div class="empty">Belum ada data.</div><?php endif; ?>
  </section>

  <!-- Pelamar Kerja -->
  <section class="tu-section">
    <h2><i class="fa fa-user-tie"></i> Pelamar Kerja</h2>
    <?php if(mysqli_num_rows($rPelamar)): ?>
    <table class="tu-table">
      <thead>
        <tr>
          <th>Nama</th><th>Posisi</th><th>Email</th><th>No. Telp</th><th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = mysqli_fetch_assoc($rPelamar)): ?>
        <tr>
          <td><?=h($row['nama_pelamar'])?></td>
          <td><?=h($row['posisi_dilamar'])?></td>
          <td><?=h($row['email_pelamar'])?></td>
          <td><?=h($row['no_telp_pelamar'])?></td>
          <td><span class="tu-badge"><?=h($row['status_pelamar'])?></span></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
    <?php else: ?><div class="empty">Belum ada data.</div><?php endif; ?>
  </section>

  <!-- SPPD -->
  <section class="tu-section">
    <h2><i class="fa fa-route"></i> SPPD</h2>
    <?php if(mysqli_num_rows($rSPPD)): ?>
    <table class="tu-table">
      <thead>
        <tr>
          <th>Tujuan</th><th>Berangkat</th><th>Kembali</th><th>Biaya</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = mysqli_fetch_assoc($rSPPD)): ?>
        <tr>
          <td><?=h($row['tujuan_sppd'])?></td>
          <td><?=h($row['tgl_berangkat'])?></td>
          <td><?=h($row['tgl_kembali'])?></td>
          <td>Rp <?=number_format((float)$row['biaya'],0,',','.')?></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
    <?php else: ?><div class="empty">Belum ada data.</div><?php endif; ?>
  </section>

  <!-- Manajemen Barang -->
  <section class="tu-section">
    <h2><i class="fa fa-boxes-stacked"></i> Manajemen Barang</h2>
    <?php if(mysqli_num_rows($rBarang)): ?>
    <table class="tu-table">
      <thead>
        <tr>
          <th>Tanggal Input</th><th>Nama</th><th>Kategori</th><th>Jumlah</th><th>Kondisi</th><th>Lokasi</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = mysqli_fetch_assoc($rBarang)): ?>
        <tr>
          <td><?=h($row['tgl_input_barang'])?></td>
          <td><?=h($row['nama_barang'])?></td>
          <td><?=h($row['kategori_barang'])?></td>
          <td><?=h($row['jumlah_barang'])?></td>
          <td><?=h($row['kondisi_barang'])?></td>
          <td><?=h($row['lokasi_barang'])?></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
    <?php else: ?><div class="empty">Belum ada data.</div><?php endif; ?>
  </section>

</div>
</body>
</html>
