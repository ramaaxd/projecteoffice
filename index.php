<?php
include 'koneksi.php';

// Hitung total Personal
$query_personal = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM personal");
$row_personal = mysqli_fetch_assoc($query_personal);
$total_personal = $row_personal['total'];

// Hitung total Komunikasi
$query_komunikasi = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM komunikasi");
$row_komunikasi = mysqli_fetch_assoc($query_komunikasi);
$total_komunikasi = $row_komunikasi['total'];

// Hitung total Aset
$query_aset = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM aset");
$row_aset = mysqli_fetch_assoc($query_aset);
$total_aset = $row_aset['total'];

// Hitung total Kuesioner
$query_kuesioner = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM kuesioner");
$row_kuesioner = mysqli_fetch_assoc($query_kuesioner);
$total_kuesioner = $row_kuesioner['total'];

// Ambil 5 data personal terbaru
$data_personal = mysqli_query($koneksi, "SELECT * FROM personal ORDER BY id_personal DESC LIMIT 5");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Sistem Manajemen</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
      <li><a href="komunikasi.php"><i class="fas fa-comments"></i> Komunikasi</a></li>
      <li><a href="tata_usaha.php"><i class="fas fa-building"></i> Tata Usaha</a></li>
      <li><a href="sistem.php"><i class="fas fa-cogs"></i> Sistem</a></li>
      <li><a href="lain_lain.php"><i class="fas fa-ellipsis-h"></i> Lain-Lain</a></li>
      <li><a href="aset.php"><i class="fas fa-boxes"></i> Manajemen Aset</a></li>
      <li><a href="kuesioner.php"><i class="fas fa-question-circle"></i> Kuesioner</a></li>
    </ul>
  </div>

<!-- Konten Utama -->
<div class="main-content">
    <header>
        <h1>Dashboard</h1>
        <p>Selamat datang di Sistem Manajemen</p>
    </header>

    <!-- Ringkasan -->
    <div class="stats">
        <div class="card">
        <i class="fas fa-user"></i>
    <h3>Total Personal</h3>
    <p><?php echo $total_personal; ?></p>
    </div>

    <div class="card">
    <i class="fas fa-comments"></i>
     <h3>Total Komunikasi</h3>
     <p><?php echo $total_komunikasi; ?></p>
    </div>

    <div class="card">
        <i class="fas fa-boxes"></i>
     <h3>Total Aset</h3>
     <p><?php echo $total_aset; ?></p>
    </div>

    <div class="card">
        <i class="fas fa-question-circle"></i>
     <h3>Total Kuesioner</h3>
     <p><?php echo $total_kuesioner; ?></p>
    </div>
    </div>

    <!-- Grafik -->
    <div class="chart-container">
        <canvas id="dashboardChart"></canvas>
    </div>
</div>

<script>
const ctx = document.getElementById('dashboardChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Personal', 'Komunikasi', 'Aset', 'Kuesioner'],
        datasets: [{
            label: 'Jumlah Data',
            data: [<?= $total_personal ?>, <?= $total_komunikasi ?>, <?= $total_aset ?>, <?= $total_kuesioner ?>],
            backgroundColor: ['#631ff6ff', '#1cc88a', '#36b9cc', '#f6c23e']
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false }
        }
    }
});
</script>

</body>
</html>