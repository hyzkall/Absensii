<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Bulanan Siswa</title>
    <link rel="stylesheet" href="styleabsen.css"> <!-- Hubungkan ke file CSS -->
    <style>
        body {
            background-image: url('https://png.pngtree.com/thumb_back/fw800/background/20200907/pngtree-green-hand-drawn-blackboard-education-school-supplies-background-image_397994.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 150vh;
            margin: 0;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            max-width: 1200px;
            width: 100%;
            margin-top: 20px;
            overflow-x: auto;
        }

        h2 {
            text-align: center;
            color: #2c5f2d;
            margin-bottom: 20px;
        }

        .date-picker {
            margin-bottom: 20px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 4px;
            text-align: center;
            font-size: 12px; /* Kurangi ukuran font */
            border: 1px solid #2c5f2d;
        }

        th {
            background-color: #2c5f2d;
            color: white;
            font-size: 14px;
        }

        td {
            background-color: #f8f8f8;
        }

        .absen-btn {
            background-color: #2c5f2d;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .absen-btn:hover {
            background-color: #1e4621;
        }

        .kembali-btn {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #2c5f2d;
        }

        /* Responsif untuk layar kecil */
        @media (max-width: 768px) {
            th, td {
                padding: 2px;
                font-size: 10px;
            }
            h2 {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Absensi Bulanan Siswa</h2>

    <?php
    include 'koneksi.php'; // Menghubungkan ke database

    // Dapatkan ID Kelas dari URL
    $idk = $_GET['idk'];

    // Dapatkan bulan dan tahun yang dipilih (default bulan ini)
    $bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
    $tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');

    // Menentukan jumlah hari dalam bulan yang dipilih
    $jumlahHari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

    // Query untuk mengambil siswa dari kelas yang dipilih
    $sql = "SELECT * FROM siswa WHERE idk = '$idk'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<form action='proses_absen_bulanan.php' method='POST'>";
        echo "<input type='hidden' name='idk' value='$idk'>"; // Menyimpan ID Kelas
        echo "<input type='hidden' name='bulan' value='$bulan'>"; // Menyimpan bulan yang dipilih
        echo "<input type='hidden' name='tahun' value='$tahun'>"; // Menyimpan tahun yang dipilih
        
        // Tampilkan pilihan bulan dan tahun
        echo "<div class='date-picker'>
                <label for='bulan'>Bulan:</label>
                <select name='bulan' id='bulan'>
                    <option value='01' " . ($bulan == '01' ? 'selected' : '') . ">Januari</option>
                    <option value='02' " . ($bulan == '02' ? 'selected' : '') . ">Februari</option>
                    <option value='03' " . ($bulan == '03' ? 'selected' : '') . ">Maret</option>
                    <option value='04' " . ($bulan == '04' ? 'selected' : '') . ">April</option>
                    <option value='05' " . ($bulan == '05' ? 'selected' : '') . ">Mei</option>
                    <option value='06' " . ($bulan == '06' ? 'selected' : '') . ">Juni</option>
                    <option value='07' " . ($bulan == '07' ? 'selected' : '') . ">Juli</option>
                    <option value='08' " . ($bulan == '08' ? 'selected' : '') . ">Agustus</option>
                    <option value='09' " . ($bulan == '09' ? 'selected' : '') . ">September</option>
                    <option value='10' " . ($bulan == '10' ? 'selected' : '') . ">Oktober</option>
                    <option value='11' " . ($bulan == '11' ? 'selected' : '') . ">November</option>
                    <option value='12' " . ($bulan == '12' ? 'selected' : '') . ">Desember</option>
                </select>

                <label for='tahun'>Tahun:</label>
                <select name='tahun' id='tahun'>
                    <option value='" . ($tahun-1) . "'>" . ($tahun-1) . "</option>
                    <option value='$tahun' selected>$tahun</option>
                    <option value='" . ($tahun+1) . "'>" . ($tahun+1) . "</option>
                </select>
                <button type='submit' class='change-month-btn'>Pilih</button>
            </div>";

        echo "<table>
                <thead>
                    <tr>
                        <th>Nama Siswa</th>";
        // Loop untuk menampilkan tanggal dalam bulan
        for ($i = 1; $i <= $jumlahHari; $i++) {
            echo "<th>" . $i . "</th>"; // Tampilkan tanggal
        }
        echo "  </tr>
                </thead>
                <tbody>";

        // Menampilkan data siswa
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['nama'] . "</td>"; // Menampilkan nama siswa

            // Loop untuk checkbox kehadiran tiap tanggal
            for ($i = 1; $i <= $jumlahHari; $i++) {
                $tanggal = $tahun . '-' . $bulan . '-' . str_pad($i, 2, '0', STR_PAD_LEFT); // Format tanggal (YYYY-MM-DD)
                echo "<td><input type='checkbox' name='hadir[" . $row['nis'] . "][$tanggal]'></td>"; // Checkbox untuk kehadiran per tanggal
            }

            echo "</tr>";
        }

        echo "</tbody></table>";

        echo "<button type='submit' class='absen-btn'>Submit Absensi Bulanan</button>";
        echo "</form>";
    } else {
        echo "Tidak ada siswa dalam kelas ini.";
    }

    $conn->close();
    ?>

    <a href="kelas.php" class="kembali-btn">Kembali ke Daftar Kelas</a>
</div>

</body>
</html>
