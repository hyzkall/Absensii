<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Mengenkripsi password menggunakan MD5

    // Query untuk memeriksa username dan password
    $sql = "SELECT * FROM user WHERE nama = '$username' AND pass = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['nama'];
        $_SESSION['level'] = $row['level']; // Menyimpan level pengguna (admin misalnya)
        header("Location: index.php"); // Redirect ke halaman index setelah login sukses
        exit();
    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg,rgba(49, 26, 152, 0.69) 0%,rgba(59, 26, 158, 0.73) 100%,rgba(21, 114, 195, 0.81) 100%);
            background-image: url('https://png.pngtree.com/thumb_back/fw800/background/20200907/pngtree-green-hand-drawn-blackboard-education-school-supplies-background-image_397994.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Poppins', sans-serif;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
        }
        .login-container {
            position: relative;
            z-index: 1;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            animation: fadeIn 1s ease-in-out;
        }
        .login-container h2 {
            font-size: 28px;
            margin-bottom: 20px;
            font-weight: 700;
            color: #2c5f2d;
            text-align: center;
            letter-spacing: 1px;
        }
        .form-control {
            height: 48px;
            font-size: 16px;
            padding-left: 20px;
            border-radius: 30px;
            border: 1px solid #ddd;
        }
        .btn-primary {
            background: linear-gradient(135deg,rgba(46, 139, 87, 0.9),rgba(60, 179, 113, 0.9));
            border: none;
            height: 50px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 30px;
            transition: background-color 0.4s ease, transform 0.2s ease;
        }
        .btn-primary:hover {
            transform: scale(1.05);
            background: linear-gradient(135deg,rgba(34, 139, 34, 1),rgba(0, 128, 0, 1));
        }
        .forgot-password {
            text-align: center;
            font-size: 14px;
            margin-top: 15px;
        }
        .forgot-password a {
            color: rgb(0, 100, 0);
            text-decoration: none;
        }
        .forgot-password a:hover {
            text-decoration: underline;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
<div class="overlay"></div>
<div class="login-container">
    <h2>Login</h2>
    <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
    <form action="" method="POST">
        <div class="mb-3">
            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
        <div class="forgot-password">
            <a href="#">Forgot your password?</a>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
