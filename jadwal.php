<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Jadwal Kelas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Data Jadwal Kelas</h2>

    <a href="tambah_jadwal.php" class="tambah-btn">Tambah Jadwal</a>

    <?php
    // Query untuk mendapatkan data jadwal, menggunakan JOIN untuk mendapatkan nama, bukan ID
    $sql = "SELECT jadwal.idj, kelas.nama AS nama, mata_pelajaran.nama_mp, hari.hari 
            FROM jadwal 
            JOIN kelas ON jadwal.idk = kelas.idk 
            JOIN mata_pelajaran ON jadwal.idm = mata_pelajaran.idm 
            JOIN hari ON jadwal.idh = hari.idh";
    
    $result = $conn->query($sql);

    // Jika query gagal, tampilkan error
    if (!$result) {
        die("Query error: " . $conn->error); // Tampilkan pesan error jika query gagal
    }

    // Jika ada data, tampilkan dalam tabel
    if ($result->num_rows > 0) {
        echo "<table class='jadwal-table'>
                <thead>
                    <tr>
                        <th>ID Jadwal</th>
                        <th>Nama Kelas</th>
                        <th>Mata Pelajaran</th>
                        <th>Hari</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>";
        
        // Ulangi baris data untuk setiap jadwal
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["idj"] . "</td>  <!-- ID Jadwal tetap ditampilkan -->
                    <td>" . $row["nama"] . "</td>  <!-- Nama kelas -->
                    <td>" . $row["nama_mp"] . "</td>  <!-- Nama mata pelajaran -->
                    <td>" . $row["hari"] . "</td>  <!-- Nama hari -->
                    <td>
                        <a href='edit_jadwal.php?idj=" . $row["idj"] . "' class='edit-btn'>Edit</a> 
                        <a href='hapus_jadwal.php?idj=" . $row["idj"] . "' class='hapus-btn' onclick=\"return confirm('Yakin ingin menghapus jadwal ini?');\">Hapus</a>
                    </td>
                  </tr>";
        }
        echo "</tbody></table>";
    } else {
        // Jika tidak ada data, tampilkan pesan
        echo "<p class='no-data'>Tidak ada data jadwal.</p>";
    }

    $conn->close();
    ?>

    <!-- Tombol Back -->
    <a href="index.php" class="back-btn">Kembali ke Beranda</a>
</div>

</body>
</html>
