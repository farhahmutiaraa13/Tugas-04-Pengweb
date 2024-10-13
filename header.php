<!DOCTYPE html>
<html>
<head>
    <title>My Journal</title>
    <style>
        body {
            margin: 0; /* Menghilangkan margin default pada body */
            font-family: Arial, sans-serif; /* Menetapkan font untuk seluruh halaman */
        }

        .nav {
            width: 100%;
            padding: 10px 0;
            display: flex;
            justify-content: center; /* Memposisikan elemen navigasi di tengah */
            align-items: center; /* Memposisikan elemen navigasi secara vertikal */
            background-color: #fff; /* Warna latar belakang header */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Bayangan untuk efek kedalaman */
            position: relative;
        }

        .nav a {
            margin: 0 15px; /* Jarak antar tautan */
            text-decoration: none; /* Menghilangkan garis bawah pada tautan */
            color: #007bff; /* Warna tautan */
            font-weight: bold; /* Menebalkan teks tautan */
            transition: color 0.3s; /* Transisi untuk efek hover */
        }

        .nav a:hover {
            color: #0056b3; /* Warna tautan saat hover */
        }
    </style>
</head>
<body>
    <div class="nav">
        <a href="jurnal.php">Home</a>
        <?php
        if (isset($_SESSION['username'])) {
            echo '<a href="logout.php">Logout</a>';
        } else {
            echo '<a href="login.php">Login</a>';
            echo '<a href="register.php">Register</a>';
        }
        ?>
    </div>
</body>
</html>
