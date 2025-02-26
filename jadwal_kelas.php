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

// Ambil ID Kelas dari parameter URL
$idk = isset($_GET['idk']) ? $_GET['idk'] : null;

// Tambah jadwal jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idm = $_POST['idm'];
    $idh = $_POST['idh'];
    $idg = $_POST['idg'];
    $jam_mulai = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];
    $aktif = isset($_POST['aktif']) ? 1 : 0;

    // Query untuk menambahkan jadwal baru
    $sql_insert = "INSERT INTO jadwal (idk, idm, idh, idg, jam_mulai, jam_selesai, aktif) 
                   VALUES ('$idk', '$idm', '$idh', '$idg', '$jam_mulai', '$jam_selesai', '$aktif')";

    if ($conn->query($sql_insert) === TRUE) {
        echo "<script>alert('Jadwal berhasil ditambahkan'); window.location.href='jadwal_kelas.php?idk=$idk';</script>";
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
}

// Query untuk mengambil jadwal kelas berdasarkan ID kelas yang dipilih
$sql = "SELECT jadwal.idj, kelas.nama, mata_pelajaran.nama_mp, hari.hari, jadwal.jam_mulai, jadwal.jam_selesai, jadwal.aktif, guru.guru 
        FROM jadwal
        JOIN kelas ON jadwal.idk = kelas.idk
        JOIN mata_pelajaran ON jadwal.idm = mata_pelajaran.idm
        JOIN hari ON jadwal.idh = hari.idh
        JOIN guru ON jadwal.idg = guru.idg
        WHERE kelas.idk = '$idk'
        ORDER BY jadwal.idj ASC";

$result = $conn->query($sql);

// Query untuk mengambil semua mata pelajaran
$sql_mata_pelajaran = "SELECT idm, nama_mp FROM mata_pelajaran";
$result_mp = $conn->query($sql_mata_pelajaran);

// Query untuk mengambil semua hari
$sql_hari = "SELECT idh, hari FROM hari";
$result_hari = $conn->query($sql_hari);

// Query untuk mengambil semua guru
$sql_guru = "SELECT idg, guru FROM guru";
$result_guru = $conn->query($sql_guru);

// Debugging untuk memeriksa apakah query gagal
if ($result_guru === false) {
    die("Error: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Kelas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('https://png.pngtree.com/thumb_back/fw800/background/20200907/pngtree-green-hand-drawn-blackboard-education-school-supplies-background-image_397994.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 150vh;
            font-family: 'Poppins', sans-serif;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.9); 
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            max-width: 1000px;
            width: 100%;
        }
        h1 {
            font-size: 32px;
            color: #2c5f2d; 
            text-align: center;
            margin-bottom: 30px;
        }
        .table {
            margin-bottom: 30px;
        }
        .btn-success {
            background-color: #2c5f2d;
            border-color: #2c5f2d;
        }
        .btn-edit {
            background-color:rgba(22, 103, 16, 0.79);
            border-color:rgba(14, 102, 20, 0.68);
        }
        .btn-danger {
            background-color: #d9534f;
            border-color: #d9534f;
        }
        .kembali {
            text-align: center;
            margin-top: 20px;
        }
        .btn-kembali {
            background-color: rgba(46, 139, 87, 0.1);
            color: #2c5f2d;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Jadwal Kelas</h1>

        <!-- Form Tambah Jadwal -->
        <form method="POST" action="">
            <div class="mb-3">
                <label for="idm" class="form-label">Mata Pelajaran</label>
                <select class="form-select" name="idm" id="idm" required>
                    <option value="" selected disabled>Pilih Mata Pelajaran</option>
                    <?php
                    if ($result_mp->num_rows > 0) {
                        while($row_mp = $result_mp->fetch_assoc()) {
                            echo "<option value='" . $row_mp['idm'] . "'>" . $row_mp['nama_mp'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="idh" class="form-label">Hari</label>
                <select class="form-select" name="idh" id="idh" required>
                    <option value="" selected disabled>Pilih Hari</option>
                    <?php
                    if ($result_hari->num_rows > 0) {
                        while($row_hari = $result_hari->fetch_assoc()) {
                            echo "<option value='" . $row_hari['idh'] . "'>" . $row_hari['hari'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="idg" class="form-label">Guru</label>
                <select class="form-select" name="idg" id="idg" required>
                    <option value="" selected disabled>Pilih Guru</option>
                    <?php
                    if ($result_guru->num_rows > 0) {
                        while($row_guru = $result_guru->fetch_assoc()) {
                            // Debug untuk memeriksa apakah key 'guru' ada
                            if (!isset($row_guru['guru'])) {
                                die("Key 'guru' tidak ditemukan dalam hasil query.");
                            }
                            echo "<option value='" . $row_guru['idg'] . "'>" . $row_guru['guru'] . "</option>";
                        }
                    } else {
                        echo "Tidak ada data guru";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="jam_mulai" class="form-label">Jam Mulai</label>
                <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" required>
            </div>
            <div class="mb-3">
                <label for="jam_selesai" class="form-label">Jam Selesai</label>
                <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" required>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="aktif" name="aktif">
                <label class="form-check-label" for="aktif">Aktif</label>
            </div>
            <button type="submit" class="btn btn-success">Tambah Jadwal</button>
        </form>

        <!-- Tabel Jadwal -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Jadwal</th>
                    <th>Nama Kelas</th>
                    <th>Mata Pelajaran</th>
                    <th>Hari</th>
                    <th>Guru</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Aktif</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["idj"] . "</td>";
                        echo "<td>" . $row["nama"] . "</td>";
                        echo "<td>" . $row["nama_mp"] . "</td>";
                        echo "<td>" . $row["hari"] . "</td>";
                        echo "<td>" . $row["guru"] . "</td>"; // Jika 'guru' benar-benar ada
                        echo "<td>" . $row["jam_mulai"] . "</td>";
                        echo "<td>" . $row["jam_selesai"] . "</td>";
                        echo "<td>" . ($row["aktif"] == 1 ? 'Ya' : 'Tidak') . "</td>";
                        echo "<td><a href='edit_jadwal.php?idj=" . $row["idj"] . "' class='btn btn-edit'>Edit</a> <a href='hapus_jadwal.php?idj=" . $row["idj"] . "' class='btn btn-danger'>Hapus</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>Tidak ada jadwal untuk kelas ini.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="kembali">
            <a href="pilih_jadwalkelas.php" class="btn btn-kembali">Kembali ke Menu Utama</a>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
