<?php
include 'koneksi.php'; // Menghubungkan ke database

$idk = $_POST['idk']; // ID Kelas dari form
$absen = $_POST['absen']; // Data absen dari checkbox

// Query untuk mengambil semua siswa dari kelas yang diabsen
$sql = "SELECT * FROM siswa WHERE idk = '$idk'";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    $nis = $row['nis']; // Mendapatkan NIS siswa

    // Mengecek apakah siswa ini ditandai hadir atau tidak
    if (isset($absen[$nis])) {
        // Siswa ini hadir
        $status = 'Hadir';
    } else {
        // Siswa ini tidak hadir
        $status = 'Tidak Hadir';
    }

    // Simpan status absen ke database (contoh tabel absensi)
    $sql_absen = "INSERT INTO absensi (nis, idk, status) VALUES ('$nis', '$idk', '$status')";
    $conn->query($sql_absen);
}

echo "<p>Absensi berhasil disimpan.</p>";
echo "<a href='index.php'>Kembali ke Beranda</a>";

$conn->close();
?>
