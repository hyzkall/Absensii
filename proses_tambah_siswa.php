<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "absen";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$nama = $_POST['nama'];
$nis = $_POST['nis'];
$pass = $_POST['pass'];
$jk = $_POST['jk'];
$idk = $_POST['idk'];
$tlp = $_POST['tlp'];

// Validasi data kosong
if (empty($nama) || empty($nis) || empty($pass) || empty($jk) || empty($idk) || empty($tlp)) {
    echo "Semua kolom harus diisi!";
    exit;
}

// Gunakan prepared statement untuk menghindari SQL Injection
$stmt = $conn->prepare("INSERT INTO siswa (nama, nis, pass, jk, idk, tlp) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $nama, $nis, $pass, $jk, $idk, $tlp);

if ($stmt->execute()) {
    // Redirect kembali ke halaman siswa setelah sukses
    header("Location: siswa.php");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
