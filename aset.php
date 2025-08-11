<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Sistem Manajemen</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<div class="sidebar">
    <div class="logo">
      <img src="image/th.jpg" alt="Logo" class="logo-img">
      <h2>Sistem Manajemen</h2>
    </div>
    <ul class="menu">
      <li><a href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
      <li><a href="personal.php"><i class="fas fa-users"></i> Personal</a></li>
      <li><a href="komunikasi.php"><i class="fas fa-briefcase"></i> Komunikasi</a></li>
      <li><a href="tata_usaha.php"><i class="fas fa-star"></i> Tata Usaha</a></li>
      <li><a href="sistem.php"><i class="fas fa-clock"></i> Sistem</a></li>
      <li><a href="lain_lain.php"><i class="fas fa-money-bill"></i> Lain-Lain</a></li>
      <li><a href="aset.php"><i class="fas fa-money-bill"></i> Manajemen Aset</a></li>
      <li><a href="kuesioner.php"><i class="fas fa-money-bill"></i> Kuesioner</a></li>
    </ul>
  </div>

<div class="content">
    <h1>Dashboard</h1>
    <p>Selamat datang di Sistem Manajemen.</p>
</div>

</body>
</html>