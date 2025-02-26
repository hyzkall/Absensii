<?php
// Mulai session untuk mengecek login
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect ke halaman login jika belum login
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
      body {
            background: linear-gradient(135deg,rgba(49, 26, 152, 0.69) 0%,rgba(59, 26, 158, 0.73) 100%,rgba(21, 114, 195, 0.81) 100%);
            background-image: url('https://png.pngtree.com/thumb_back/fw800/background/20200907/pngtree-green-hand-drawn-blackboard-education-school-supplies-background-image_397994.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Poppins', sans-serif;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.9); /* Transparansi di belakang konten */
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            max-width: 800px;
            width: 100%;
        }
        h2 {
            font-size: 32px;
            color: #2c5f2d; /* Warna hijau untuk teks */
            text-align: center;
            margin-bottom: 30px;
        }
        .stats {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .card {
            background-color: #f8f9fa;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 30%;
        }
        .card h3 {
            font-size: 24px;
            color: #2c5f2d;
        }
        .card p {
            font-size: 18px;
            color: #555;
        }
        .announcement {
            background-color: rgba(46, 139, 87, 0.1);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 30px;
        }
        .announcement h3 {
            font-size: 22px;
            color: #2c5f2d;
        }
        .announcement p {
            font-size: 16px;
            color: #333;
        }
        .menu ul {
            display: flex;
            justify-content: space-around;
            padding: 0;
            list-style: none;
        }
        .menu ul li {
            text-align: center;
        }
        .menu ul li a {
            display: block;
            color: #2c5f2d;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            padding: 10px;
            border-radius: 10px;
            transition: background-color 0.4s ease, transform 0.2s ease;
        }
        .menu ul li a:hover {
            background-color: rgba(46, 139, 87, 0.1);
            transform: scale(1.05);
        }
        .box {
            margin-top: 10px;
        }
        .box img {
            width: 60px;
            height: 60px;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Bagian Selamat Datang -->
    <h2>Selamat Datang, <?php echo $_SESSION['username']; ?>!</h2>

    <!-- Bagian Statistik Ringkas -->
    <div class="stats">
        <div class="card">
            <h3>Total Siswa</h3>
            <p>117 Siswa</p>
        </div>
        <div class="card">
            <h3>Total Kelas</h3>
            <p>9 Kelas</p>
        </div>
        <div class="card">
            <h3>Total Jadwal</h3>
            <p>18 Jadwal</p>
        </div>
    </div>

    <!-- Bagian Pengumuman atau Informasi Penting -->
    <div class="announcement">
        <h3>Pengumuman</h3>
        <p>Tanggal 25 Februari 2025: Semua jadwal harian akan di-update di halaman jadwal, pastikan untuk memeriksa jadwal terbaru.</p>
    </div>

    <!-- Menu Navigasi Utama -->
    <div class="menu">
        <ul>
            <li>
                <a href="daftar_siswa.php">Lihat Daftar Guru</a>
                <div class="box">
                    <img src="1.png" alt="Icon Siswa">
                </div>
            </li>
            <li>
                <a href="pilih_jadwalkelas.php">Jadwal</a>
                <div class="box">
                    <img src="3.png" alt="Icon Jadwal">
                </div>
            </li>
            <li>
                <a href="kelas.php">Kelas</a>
                <div class="box">
                    <img src="2.png" alt="Icon Kelas">
                </div>
            </li>
            <li>
                <a href="logout.php">Logout</a>
                <div class="box">
                    <img src="4.png" alt="Icon Logout">
                </div>
            </li>
        </ul>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
