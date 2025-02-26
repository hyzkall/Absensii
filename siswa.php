<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Data Siswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Data Siswa</h2>

        <a href="tambah_siswa.php" class="tambah-btn">Tambah Siswa</a>

        <?php
        // Query untuk mengambil data siswa
        $sql = "SELECT * FROM siswa";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>ID Siswa</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Aksi</th>
                    </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["ids"] . "</td>
                        <td>" . $row["nama"] . "</td>
                        <td>" . $row["idk"] . "</td>
                        <td>
                            <a href='edit_siswa.php?ids=" . $row["ids"] . "' class='edit-btn'>Edit</a> |
                            <a href='hapus_siswa.php?ids=" . $row["ids"] . "' class='hapus-btn' onclick=\"return confirm('Yakin ingin menghapus siswa ini?');\">Hapus</a>
                        </td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "<p class='no-data'>Tidak ada data siswa.</p>";
        }

        $conn->close();
        ?>

        <a href="index.php" class="kembali-btn">Kembali</a>
    </div>
</body>
</html>
