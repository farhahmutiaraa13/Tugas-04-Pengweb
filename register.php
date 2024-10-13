<?php
    include 'koneksi.php';

    $error_message = ''; // Inisialisasi variabel pesan error kosong

    // meriksa form regist
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password untuk keamanan

        // meriksa username yang sudah ada
        $query = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $query->bind_param("s", $username);
        $query->execute();
        $result = $query->get_result();

        // mengenali username yang sudah terdaftar
        if ($result->num_rows > 0) {
            $error_message = "Username sudah terdaftar!";
        } else {
            // menyimpan data new register
            $query = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $query->bind_param("ss", $username, $password);

            //eksekusi query dan hasilnya
            if ($query->execute()) {
                echo "Registrasi berhasil!";
                header("Location: login.php");
                exit();
            } else {
                $error_message = "Registrasi gagal!";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 500px;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"], input[type="password"] {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: grey;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <hr>
        <form action="register.php" method="POST">
            <label for="Nama">Username:</label>
            <input type="text" name="username" size="1" required><br>
            <?php if ($error_message): ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <label for="Password">Password:</label>
            <input type="password" name="password" size="1" required><br>
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
</body>
</html>
