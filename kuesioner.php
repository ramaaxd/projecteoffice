<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Kuesioner Kepuasan</title>

  <!-- Ganti ke file CSS eksternal jika mau -->
  <link rel="stylesheet" href="kuesioner.css">
  <link rel="stylesheet" href="style.css"> <!-- Opsional: kalau ingin sidebar yang sama -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
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

  <main class="q-main">
    <header class="q-header">
      <h1>Kuesioner Kepuasan Layanan</h1>
      <p>Mohon luangkan waktu untuk mengisi kuesioner ini. Jawaban Anda membantu kami meningkatkan kualitas layanan.</p>
    </header>

    <form class="q-form" method="post" action="#">
      <!-- Identitas singkat -->
      <section class="q-card">
        <h2>Identitas</h2>
        <div class="q-grid">
          <label class="q-field">
            <span>Nama <b>*</b></span>
            <input type="text" name="nama" placeholder="Nama lengkap" required>
          </label>
          <label class="q-field">
            <span>Email</span>
            <input type="email" name="email" placeholder="email@contoh.com">
          </label>
          <label class="q-field">
            <span>Unit/Bagian</span>
            <input type="text" name="unit" placeholder="Contoh: Kepegawaian">
          </label>
          <label class="q-field">
            <span>Tanggal</span>
            <input type="date" name="tanggal" value="">
          </label>
        </div>
      </section>

      <!-- Penilaian bintang -->
      <section class="q-card">
        <h2>Penilaian Umum</h2>
        <div class="q-stars-group">
          <div class="q-stars">
            <span>Kualitas layanan keseluruhan</span>
            <div class="stars-input" aria-label="Beri penilaian 1-5">
              <!-- urutan dibalik agar hover rapi (rtl teknik) -->
              <input type="radio" id="s5" name="rating_umum" value="5" required>
              <label for="s5" title="Sangat Baik">★</label>
              <input type="radio" id="s4" name="rating_umum" value="4">
              <label for="s4" title="Baik">★</label>
              <input type="radio" id="s3" name="rating_umum" value="3">
              <label for="s3" title="Cukup">★</label>
              <input type="radio" id="s2" name="rating_umum" value="2">
              <label for="s2" title="Kurang">★</label>
              <input type="radio" id="s1" name="rating_umum" value="1">
              <label for="s1" title="Buruk">★</label>
            </div>
          </div>

          <div class="q-stars">
            <span>Kecepatan pelayanan</span>
            <div class="stars-input">
              <input type="radio" id="k5" name="rating_cepat" value="5" required>
              <label for="k5">★</label>
              <input type="radio" id="k4" name="rating_cepat" value="4">
              <label for="k4">★</label>
              <input type="radio" id="k3" name="rating_cepat" value="3">
              <label for="k3">★</label>
              <input type="radio" id="k2" name="rating_cepat" value="2">
              <label for="k2">★</label>
              <input type="radio" id="k1" name="rating_cepat" value="1">
              <label for="k1">★</label>
            </div>
          </div>
        </div>
      </section>

      <!-- Skala Likert -->
      <section class="q-card">
        <h2>Penilaian Detail</h2>
        <div class="q-likert">
          <div class="q-likert-row">
            <div class="q-likert-question">Informasi mudah dipahami</div>
            <div class="q-likert-options">
              <label><input type="radio" name="q1" value="1" required><span>STS</span></label>
              <label><input type="radio" name="q1" value="2"><span>TS</span></label>
              <label><input type="radio" name="q1" value="3"><span>N</span></label>
              <label><input type="radio" name="q1" value="4"><span>S</span></label>
              <label><input type="radio" name="q1" value="5"><span>SS</span></label>
            </div>
          </div>

          <div class="q-likert-row">
            <div class="q-likert-question">Petugas responsif terhadap kebutuhan</div>
            <div class="q-likert-options">
              <label><input type="radio" name="q2" value="1" required><span>STS</span></label>
              <label><input type="radio" name="q2" value="2"><span>TS</span></label>
              <label><input type="radio" name="q2" value="3"><span>N</span></label>
              <label><input type="radio" name="q2" value="4"><span>S</span></label>
              <label><input type="radio" name="q2" value="5"><span>SS</span></label>
            </div>
          </div>

          <div class="q-likert-row">
            <div class="q-likert-question">Proses layanan jelas dan transparan</div>
            <div class="q-likert-options">
              <label><input type="radio" name="q3" value="1" required><span>STS</span></label>
              <label><input type="radio" name="q3" value="2"><span>TS</span></label>
              <label><input type="radio" name="q3" value="3"><span>N</span></label>
              <label><input type="radio" name="q3" value="4"><span>S</span></label>
              <label><input type="radio" name="q3" value="5"><span>SS</span></label>
            </div>
          </div>
        </div>
        <div class="q-help">Skala: STS = Sangat Tidak Setuju, TS = Tidak Setuju, N = Netral, S = Setuju, SS = Sangat
          Setuju</div>
      </section>

      <!-- Checkbox kebutuhan -->
      <section class="q-card">
        <h2>Kebutuhan Layanan yang Sering Digunakan</h2>
        <div class="q-checks">
          <label class="q-check"><input type="checkbox" name="layanan[]" value="informasi"><span>Informasi
              umum</span></label>
          <label class="q-check"><input type="checkbox" name="layanan[]" value="dokumen"><span>Pengurusan
              dokumen</span></label>
          <label class="q-check"><input type="checkbox" name="layanan[]"
              value="konsultasi"><span>Konsultasi</span></label>
          <label class="q-check"><input type="checkbox" name="layanan[]"
              value="pengaduan"><span>Pengaduan</span></label>
        </div>
      </section>

      <!-- Saran -->
      <section class="q-card">
        <h2>Saran & Masukan</h2>
        <label class="q-field">
          <textarea name="saran" rows="5" placeholder="Tulis masukan Anda di sini..."></textarea>
        </label>
      </section>

      <!-- Persetujuan -->
      <section class="q-card q-consent">
        <label class="q-check">
          <input type="checkbox" name="consent" required>
          <span>Saya menyetujui data ini digunakan untuk evaluasi layanan.</span>
        </label>
      </section>

      <div class="q-actions">
        <button type="submit" class="q-btn q-primary"><i class="fa fa-paper-plane"></i> Kirim</button>
        <button type="reset" class="q-btn q-ghost">Reset</button>
      </div>
    </form>
  </main>

</body>

</html>