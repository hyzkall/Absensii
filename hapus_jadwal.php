<?php
// Menghubungkan ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "absen";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID Jadwal dari parameter URL
$idj = isset($_GET['id']) ? $_GET['id'] : null;
$idk = isset($_GET['idk']) ? $_GET['idk'] : null;

if ($idj) {
    // Query untuk menghapus jadwal berdasarkan ID jadwal
    $sql_delete = "DELETE FROM jadwal WHERE idj = '$idj'";

    if ($conn->query($sql_delete) === TRUE) {
        echo "<script>alert('Jadwal berhasil dihapus'); window.location.href='jadwal_kelas.php?idk=$idk';</script>";
    } else {
        echo "Error: " . $sql_delete . "<br>" . $conn->error;
    }
} else {
    echo "ID jadwal tidak ditemukan.";
}

$conn->close();
?>
