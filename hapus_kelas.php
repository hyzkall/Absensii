<?php
include 'koneksi.php';

if (isset($_GET['idk'])) {
    $idk = $_GET['idk'];

    // Hapus data kelas berdasarkan ID
    $sql = "DELETE FROM kelas WHERE idk = '$idk'";

    if ($conn->query($sql) === TRUE) {
        header("Location: kelas.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "ID Kelas tidak ditemukan!";
}

$conn->close();
?>
