<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Komunikasi</title>
    <link rel="stylesheet" href="komunikasi.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            <li><a href="komunikasi.php" class="active"><i class="fas fa-comments"></i> Komunikasi</a></li>
            <li><a href="tata_usaha.php"><i class="fas fa-building"></i> Tata Usaha</a></li>
            <li><a href="sistem.php"><i class="fas fa-cogs"></i> Sistem</a></li>
            <li><a href="lain_lain.php"><i class="fas fa-ellipsis-h"></i> Lain-Lain</a></li>
            <li><a href="aset.php"><i class="fas fa-boxes"></i> Manajemen Aset</a></li>
            <li><a href="kuesioner.php"><i class="fas fa-question-circle"></i> Kuesioner</a></li>
        </ul>
    </div>

    <!-- Konten Utama -->
    <div class="main-content">
        <h1><i class="fas fa-comments"></i> Komunikasi</h1>
        <p>Pusat komunikasi internal: diskusi, forum, pesan, dan informasi.</p>

        <!-- Tabs -->
        <div class="tabs">
            <button class="tab active" data-tab="chat"><i class="fas fa-comment-dots"></i> Chat</button>
            <button class="tab" data-tab="forum"><i class="fas fa-users"></i> Forum</button>
            <button class="tab" data-tab="pengumuman"><i class="fas fa-bullhorn"></i> Pengumuman</button>
            <button class="tab" data-tab="pesan"><i class="fas fa-envelope"></i> Pesan</button>
            <button class="tab" data-tab="file"><i class="fas fa-file-upload"></i> Tukar File</button>
            <button class="tab" data-tab="sms"><i class="fas fa-sms"></i> Info SMS</button>
        </div>

        <!-- Tab Contents -->
        <div class="tab-content">

            <!-- Chat -->
            <div id="chat" class="content active">
                <div class="chat-box">
                    <div class="chat-message"><b>Admin:</b> Selamat datang di ruang chat.</div>
                    <div class="chat-message user"><b>Anda:</b> Halo 👋</div>
                </div>
                <div class="chat-input">
                    <input type="text" placeholder="Ketik pesan...">
                    <button>Kirim</button>
                </div>
            </div>

            <!-- Forum -->
            <div id="forum" class="content">
                <h2>Forum Diskusi</h2>
                <div class="forum-thread">
                    <h3>Cara absen online?</h3>
                    <p><b>User1:</b> Masuk menu Tata Usaha → Kehadiran</p>
                    <p><b>User2:</b> Bisa juga lewat aplikasi mobile</p>
                </div>
                <form class="forum-form">
                    <textarea placeholder="Tulis pertanyaan atau jawaban..."></textarea>
                    <button>Posting</button>
                </form>
            </div>

            <!-- Pengumuman -->
            <div id="pengumuman" class="content">
                <h2>Pengumuman & Info</h2>
                <ul class="announcement">
                    <li><i class="fas fa-circle-info"></i> Rapat koordinasi Senin, 09.00 WIB</li>
                    <li><i class="fas fa-circle-info"></i> Deadline laporan akhir bulan ini</li>
                </ul>
            </div>

            <!-- Pesan -->
            <div id="pesan" class="content">
                <h2>Kotak Pesan</h2>
                <div class="pesan-list">
                    <div class="pesan-item"><b>Admin:</b> Silakan lengkapi biodata Anda.</div>
                    <div class="pesan-item"><b>HRD:</b> Undangan interview besok jam 10.00</div>
                </div>
                <form class="pesan-form">
                    <input type="text" placeholder="Judul pesan">
                    <textarea placeholder="Tulis pesan..."></textarea>
                    <button>Kirim</button>
                </form>
            </div>

            <!-- Tukar File -->
            <div id="file" class="content">
                <h2>Tukar File</h2>
                <form class="file-form">
                    <input type="file">
                    <button>Upload</button>
                </form>
                <div class="file-list">
                    <p><i class="fas fa-file"></i> laporan_kehadiran.pdf</p>
                    <p><i class="fas fa-file"></i> surat_masuk.docx</p>
                </div>
            </div>

            <!-- Info SMS -->
            <div id="sms" class="content">
                <h2>Info SMS</h2>
                <p><i class="fas fa-sms"></i> Dari 08123456789: *"Jangan lupa rapat besok."*</p>
                <form class="sms-form">
                    <input type="text" placeholder="Nomor HP">
                    <textarea placeholder="Tulis SMS..."></textarea>
                    <button>Kirim SMS</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Tab switching
        const tabs = document.querySelectorAll(".tab");
        const contents = document.querySelectorAll(".content");

        tabs.forEach(tab => {
            tab.addEventListener("click", () => {
                tabs.forEach(t => t.classList.remove("active"));
                contents.forEach(c => c.classList.remove("active"));
                tab.classList.add("active");
                document.getElementById(tab.dataset.tab).classList.add("active");
            });
        });
    </script>
</body>

</html>