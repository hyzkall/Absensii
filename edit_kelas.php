<?php
include 'koneksi.php';

$idk = isset($_GET['idk']) ? $_GET['idk'] : null;

if ($idk) {
    // Ambil data kelas berdasarkan ID
    $sql = "SELECT * FROM kelas WHERE idk = '$idk'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data kelas tidak ditemukan!";
        exit();
    }
} else {
    echo "ID kelas tidak diberikan!";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];

    // Update data kelas
    $sql = "UPDATE kelas SET nama = '$nama' WHERE idk = '$idk'";

    if ($conn->query($sql) === TRUE) {
        header("Location: kelas.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kelas</title>
    <style>
        body {
            background-image: url('https://png.pngtree.com/thumb_back/fw800/background/20200907/pngtree-green-hand-drawn-blackboard-education-school-supplies-background-image_397994.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            color: #2c5f2d;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            color: #333;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #2c5f2d;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #1e4621;
        }

        .kembali-btn {
            color: #2c5f2d;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }

        .kembali-btn:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Kelas</h2>

    <form method="POST" action="edit_kelas.php?idk=<?php echo $idk; ?>">
        <label for="nama">Nama Kelas:</label><br>
        <input type="text" id="nama" name="nama" value="<?php echo isset($row['nama']) ? $row['nama'] : ''; ?>" required><br><br>
        
        <input type="submit" value="Simpan Perubahan">
    </form>

    <a href="kelas.php" class="kembali-btn">Kembali</a>
</div>

</body>
</html>
