<?php include('koneksi.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('wallpaper.jpg'); /* Ganti dengan URL gambar latar belakang Anda */
            background-size: cover;
            background-repeat: no-repeat;
        }

        .register-container {
            background-color: rgba(255, 255, 255, 0.8); /* Ubah opasitas sesuai kebutuhan Anda */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
            width: 300px;
        }

        .register-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .register-form input[type="text"],
        .register-form input[type="email"],
        .register-form input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .register-form input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .register-form input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <form class="register-form" action="" method="post">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username"><br>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email"><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password"><br><br>
            <input type="submit" value="Register">
        </form>
        <?php
        // Fungsi untuk melakukan proses register
        function register($username, $email, $password) {
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
            $email = $conn->real_escape_string($email);
            $password = $conn->real_escape_string($password);

            // Query untuk menambahkan user baru ke database
            $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
            if ($conn->query($sql) === TRUE) {
                echo "<p style='color: green;'>Registrasi berhasil!</p>";
                // Arahkan ke halaman login setelah registrasi berhasil
                header("Location: login.php");
                exit();
            } else {
                echo "<p style='color: red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
            }

            $conn->close();
        }

        // Proses register ketika form register dikirim
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];

            register($username, $email, $password);
        }
        ?>
    </div>
</body>
</html>
