<?php
// Menghubungkan ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "absen";

// Buat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil semua kelas
$sql = "SELECT * FROM kelas";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Kelas</title>
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
            background-color: rgba(255, 255, 255, 0.9); /* Transparansi */
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            max-width: 900px;
            width: 100%;
        }
        h2 {
            font-size: 28px;
            color: #2c5f2d;
            text-align: center;
            margin-bottom: 30px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .card-body {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            color: #fff;
            background-color: #2c5f2d;
            border-radius: 15px;
            padding: 20px;
        }
        .row {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        .kembali {
            text-align: center;
            margin-top: 20px;
        }
        .btn-kembali {
            background-color: rgba(46, 139, 87, 0.1);
            color: #2c5f2d;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Pilih Kelas</h2>

    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='col-md-4'>";
                echo "<div class='card'>";
                echo "<div class='card-body'>";
                echo "<a href='jadwal_kelas.php?idk=" . $row['idk'] . "' class='stretched-link text-white'>" . $row['nama'] . "</a>";  // Mengarahkan ke jadwal kelas berdasarkan ID kelas
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>Tidak ada data kelas.</p>";
        }
        ?>
    </div>

    <div class="kembali">
        <a href="index.php" class="btn btn-kembali">Kembali ke Beranda</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
