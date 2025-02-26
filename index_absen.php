<?php
include 'koneksi.php';

// Ambil daftar kelas dari database
$sql_kelas = "SELECT * FROM kelas"; // Pastikan kamu punya tabel 'kelas'
$result_kelas = $conn->query($sql_kelas);

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Kelas</title>
</head>
<body>
    <h2>Pilih Kelas</h2>
    
    <form action="absen_kelas.php" method="GET">
        <label for="idk">Kelas:</label>
        <select name="idk" id="idk">
            <?php
            // Loop untuk menampilkan kelas dalam dropdown
            if ($result_kelas->num_rows > 0) {
                while ($row_kelas = $result_kelas->fetch_assoc()) {
                    echo "<option value='" . $row_kelas['idk'] . "'>" . $row_kelas['nama_kelas'] . "</option>";
                }
            } else {
                echo "<option value=''>Tidak ada kelas tersedia</option>";
            }
            ?>
        </select>
        <button type="submit">Pilih</button>
    </form>

</body>
</html>

<?php
$conn->close();
?>
