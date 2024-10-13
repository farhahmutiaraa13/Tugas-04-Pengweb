<?php
    // memeulai sesi
    session_start();
    
    // meriksa status login
    if (!isset($_SESSION['login'])) {
        header('Location: login.php'); 
        exit();
    }

    include 'header.php';
    include 'koneksi.php';

    // ngambil semua data jurnal dari database
    $sql = "SELECT * FROM journal ORDER BY date DESC";
    $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jurnaling Harian</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            background-color: #f0f2f5;
            font-family: Arial, sans-serif;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-size: 18px;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #ffd700; 
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 600px;
            max-width: 90%;
            text-align: left;
            margin-top: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .journal-title {
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 8px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .journal-title a {
            text-decoration: none;
            color: black;
            font-size: 18px;
            font-weight: bold;
        }

        .journal-title a:hover {
            text-decoration: underline;
            color: #0056b3;
        }

        .journal-title:hover {
            background-color: #eef3f7;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .no-journal {
            text-align: center;
            color: #999;
            font-size: 16px;
            margin-top: 20px;
        }

        .btn-logout {
            display: block;
            margin: 20px auto 0;
            padding: 10px 20px;
            background-color: #6c757d;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .btn-logout:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>What do you want to read?</h1>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <div class="journal-title">
                    <a href="detail-jurnal.php?id=<?= $row['id'] ?>">
                        <?= htmlspecialchars($row['title']) ?>
                    </a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="no-journal">Belum ada catatan jurnaling.</p>
        <?php endif; ?>
        <a class="btn-logout" href="logout.php">Logout</a>
    </div>
</body>
</html>
