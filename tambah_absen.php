<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ids = $_POST['ids'];
    $idj = $_POST['idj'];
    $tgl = $_POST['tgl'];
    $ket = $_POST['ket'];

    $sql = "INSERT INTO absen (ids, idj, tgl, ket) VALUES ('$ids', '$idj', '$tgl', '$ket')";

    if ($conn->query($sql) === TRUE) {
        echo "Data absensi berhasil ditambahkan.";
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Absensi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Tambah Data Absensi</h2>

<form method="POST" action="tambah_absen.php">
    <label for="ids">ID Siswa:</label><br>
    <input type="text" id="ids" name="ids" required><br><br>

    <label for="idj">ID Jadwal:</label><br>
    <input type="text" id="idj" name="idj" required><br><br>

    <label for="tgl">Tanggal (YYYY-MM-DD):</label><br>
    <input type="text" id="tgl" name="tgl" required><br><br>

    <label for="ket">Keterangan (M/S/I/A):</label><br>
    <input type="text" id="ket" name="ket" required><br><br>

    <input type="submit" value="Simpan">
</form>

<a href="index.php" class="kembali-btn">Kembali</a>

</body>
</html>