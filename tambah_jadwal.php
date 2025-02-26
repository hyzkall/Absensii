<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idk = $_POST['idk'];    // ID Kelas
    $idm = $_POST['idm'];    // Mata Pelajaran
    $idh = $_POST['idh'];    // Hari
    $idg = $_POST['idg'];    // Guru

    $sql = "INSERT INTO jadwal (idk, idm, idh, idg) VALUES ('$idk', '$idm', '$idh', '$idg')";

    if ($conn->query($sql) === TRUE) {
        echo "Jadwal berhasil ditambahkan.";
        header("Location: jadwal_kelas.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Mengambil data kelas
$kelasQuery = "SELECT * FROM kelas";
$kelasResult = $conn->query($kelasQuery);

// Mengambil data mata pelajaran
$mpQuery = "SELECT * FROM mata_pelajaran";
$mpResult = $conn->query($mpQuery);

// Mengambil data hari
$hariQuery = "SELECT * FROM hari";
$hariResult = $conn->query($hariQuery);

// Mengambil data guru
$guruQuery = "SELECT * FROM guru";
$guruResult = $conn->query($guruQuery);

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jadwal Kelas</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-image: url('https://png.pngtree.com/thumb_back/fw800/background/20200907/pngtree-green-hand-drawn-blackboard-education-school-supplies-background-image_397994.jpg');
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            color: #333;
        }
        .form-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 15px;
            width: 450px;
            margin: 120px auto;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            color: #4CAF50;
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-size: 1.1em;
            margin-bottom: 10px;
            text-align: left;
        }
        select, input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
            font-size: 1em;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .kembali-btn {
            display: inline-block;
            padding: 10px 15px;
            background-color: #f44336;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .kembali-btn:hover {
            background-color: #e53935;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Tambah Jadwal Kelas</h2>

    <form method="POST" action="tambah_jadwal.php">
        <label for="idk">Kelas:</label>
        <select name="idk" id="idk" required>
            <?php while ($row = $kelasResult->fetch_assoc()) { ?>
                <option value="<?php echo $row['idk']; ?>"><?php echo $row['nama']; ?></option>
            <?php } ?>
        </select>

        <label for="idm">Mata Pelajaran:</label>
        <select name="idm" id="idm" required>
            <?php while ($row = $mpResult->fetch_assoc()) { ?>
                <option value="<?php echo $row['idm']; ?>"><?php echo $row['nama_mp']; ?></option>
            <?php } ?>
        </select>

        <label for="idh">Hari:</label>
        <select name="idh" id="idh" required>
            <?php while ($row = $hariResult->fetch_assoc()) { ?>
                <option value="<?php echo $row['idh']; ?>"><?php echo $row['hari']; ?></option>
            <?php } ?>
        </select>

        <label for="idg">Guru:</label>
        <select name="idg" id="idg" required>
            <?php while ($row = $guruResult->fetch_assoc()) { ?>
                <option value="<?php echo $row['idg']; ?>"><?php echo $row['nama']; ?></option>
            <?php } ?>
        </select>

        <input type="submit" value="Simpan">
    </form>

    <a href="jadwal.php" class="kembali-btn">Kembali</a>
</div>

</body>
</html>
