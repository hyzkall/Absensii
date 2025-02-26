<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;            
            background-image: url('https://png.pngtree.com/thumb_back/fw800/background/20200907/pngtree-green-hand-drawn-blackboard-education-school-supplies-background-image_397994.jpg');
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            color: #333;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-group input:focus {
            border-color: #007bff;
            outline: none;
        }

        .form-group input[type="submit"] {
            background-color: #007bff;
            color: white;
            cursor: pointer;
            font-weight: bold;
        }

        .form-group input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .form-group input[type="submit"]:active {
            background-color: #003f7f;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Siswa</h1>
        <!-- Form Edit Siswa -->
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo isset($siswa['id']) ? $siswa['id'] : ''; ?>">

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" value="<?php echo isset($siswa['nama']) ? $siswa['nama'] : ''; ?>">
            </div>

            <div class="form-group">
                <label for="nis">NIS</label>
                <input type="text" name="nis" id="nis" value="<?php echo isset($siswa['nis']) ? $siswa['nis'] : ''; ?>">
            </div>

            <div class="form-group">
                <label for="pass">Password</label>
                <input type="password" name="pass" id="pass" value="<?php echo isset($siswa['pass']) ? $siswa['pass'] : ''; ?>">
            </div>

            <div class="form-group">
                <label for="jk">Jenis Kelamin</label>
                <input type="text" name="jk" id="jk" value="<?php echo isset($siswa['jk']) ? $siswa['jk'] : ''; ?>">
            </div>

            <div class="form-group">
                <label for="idk">ID Kelas</label>
                <input type="text" name="idk" id="idk" value="<?php echo isset($siswa['idk']) ? $siswa['idk'] : ''; ?>">
            </div>

            <div class="form-group">
                <label for="tlp">Telepon</label>
                <input type="text" name="tlp" id="tlp" value="<?php echo isset($siswa['tlp']) ? $siswa['tlp'] : ''; ?>">
            </div>

            <div class="form-group">
                <input type="submit" value="Update">
            </div>
        </form>
    </div>
</body>
</html>
