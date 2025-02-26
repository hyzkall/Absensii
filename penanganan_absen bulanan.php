<?php
include 'koneksi.php'; // Menghubungkan ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idk = $_POST['idk']; // ID Kelas
    $hadir = $_POST['hadir']; // Array absensi (nis => tanggal)

    foreach ($hadir as $nis => $tanggalArray) {
        foreach ($tanggalArray as $tanggal => $status) {
            // Simpan kehadiran ke database (sesuaikan dengan tabel absensi Anda)
            $sql = "INSERT INTO absensi (nis, tanggal, hadir) VALUES ('$nis', '$tanggal', '1')
                    ON DUPLICATE KEY UPDATE hadir = '1'"; // Update jika sudah ada
            $conn->query($sql);
        }
    }

    echo "Absensi bulanan telah disimpan.";
    header("Location: kelas.php?idk=$idk");
    exit;
}

$conn->close();
?>
