<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "absen";

// Koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Hapus data siswa jika ada parameter ID pada URL
if (isset($_GET['ids'])) {
    $id = $_GET['ids'];
    $sql = "DELETE FROM siswa WHERE ids=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil dihapus";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
