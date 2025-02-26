<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kelas</title>
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
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            max-width: 800px;
            width: 100%;
        }
        h2 {
            font-size: 28px;
            color: #2c5f2d;
            text-align: center;
            margin-bottom: 20px;
        }
        .table {
            margin-bottom: 20px;
            font-size: 14px;
        }
        .table th, .table td {
            padding: 8px 10px; /* Memperkecil padding sel */
        }
        .tambah-btn {
            display: inline-block;
            background-color: #2c5f2d;
            color: #fff;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            margin-bottom: 15px;
        }
        .tambah-btn:hover {
            background-color: #245923;
        }
        .lihat-siswa-btn, .edit-btn, .hapus-btn {
            color: #2c5f2d;
            text-decoration: none;
            font-size: 14px;
            padding: 2px 5px;
        }
        .lihat-siswa-btn:hover, .edit-btn:hover, .hapus-btn:hover {
            color: #245923;
        }
        .kembali-btn {
            background-color: rgba(46, 139, 87, 0.1);
            color: #2c5f2d;
            font-size: 14px;
            display: inline-block;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Daftar Kelas</h2>

    <a href="tambah_kelas.php" class="tambah-btn">Tambah Kelas</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Kelas</th>
                <th>Nama Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'koneksi.php'; // Menghubungkan ke database
            
            // Query untuk mengambil data kelas
            $sql = "SELECT * FROM kelas"; 
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['idk'] . "</td>"; // Menampilkan ID Kelas
                    echo "<td>" . $row['nama'] . "</td>"; // Menampilkan Nama Kelas
                    echo "<td>
                            <a href='absenkelasviia.php?idk=" . $row['idk'] . "' class='lihat-siswa-btn'>Lihat Siswa</a> 
                            | 
                            <a href='edit_kelas.php?idk=" . $row['idk'] . "' class='edit-btn'>Edit</a>
                            |
                            <a href='hapus_kelas.php?idk=" . $row['idk'] . "' class='hapus-btn' onclick=\"return confirm('Yakin ingin menghapus kelas ini?');\">Hapus</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Tidak ada data kelas.</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>

    <a href="index.php" class="kembali-btn">Kembali ke Beranda</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
