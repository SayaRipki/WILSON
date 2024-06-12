<?php include('koneksi.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('wallpaper.jpg'); /* Ganti dengan lokasi gambar latar belakang Anda */
            background-size: cover;
            background-repeat: no-repeat;
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.8); /* Ubah ke opasitas yang diinginkan */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
            width: 300px;
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .login-form input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .login-form a {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
        }

        .login-form a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form class="login-form" action="" method="post">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username"><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password"><br><br>
            <input type="submit" value="Login">
            <a href="register.php">Register</a>
        </form>
        <?php
        // Fungsi untuk melakukan proses login
        function login($username, $password) {
            $host = "localhost"; // Ganti dengan host database Anda
            $dbUsername = "root"; // Ganti dengan username database Anda
            $dbPassword = ""; // Ganti dengan password database Anda
            $dbName = "crud_gc"; // Ganti dengan nama database Anda

            // Buat koneksi ke database
            $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

            // Cek koneksi
            if ($conn->connect_error) {
                die("Koneksi gagal: " . $conn->connect_error);
            }

            // Lindungi dari SQL injection
            $username = $conn->real_escape_string($username);
            $password = $conn->real_escape_string($password);

            // Query untuk mencari user dengan username dan password yang sesuai
            $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
            $result = $conn->query($sql);

            // Jika user ditemukan, kembalikan true (login berhasil)
            if ($result && $result->num_rows > 0) {
                $conn->close();
                return true;
            } else {
                $conn->close();
                return false;
            }
        }

        // Proses login ketika form login dikirim
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $password = $_POST["password"];

            if (login($username, $password)) {
                echo "<p style='color: green;'>Login berhasil!</p>";
                // Redirect ke halaman index.php jika login berhasil
                header("Location: index.php");
                exit();
            } else {
                echo "<p style='color: red;'>Username atau password salah.</p>";
            }
        }
        ?>
    </div>
</body>
</html>
