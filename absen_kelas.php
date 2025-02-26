<?php
include 'koneksi.php';

// Ambil data kelas dari database untuk ditampilkan di dropdown
$sql_kelas = "SELECT * FROM kelas";
$result_kelas = $conn->query($sql_kelas);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Kelas untuk Absensi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <div class="w-full max-w-lg mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h1 class="text-2xl font-bold mb-6">Pilih Kelas</h1>

            <!-- Form untuk memilih kelas -->
            <form action="absenkelasviia.php" method="GET">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="kelas">Kelas:</label>
                    <select name="idk" id="idk" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <option value="">-- Pilih Kelas --</option>
                        <?php
                        // Loop untuk menampilkan pilihan kelas
                        if ($result_kelas->num_rows > 0) {
                            while ($row_kelas = $result_kelas->fetch_assoc()) {
                                echo "<option value='" . $row_kelas['idk'] . "'>" . $row_kelas['nama_kelas'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>Kelas tidak tersedia</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Lihat Siswa
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
