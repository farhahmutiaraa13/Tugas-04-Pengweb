<?php
    // memulai sesi
    session_start();
    include('koneksi.php');

    // meriksa status login
    if (!isset($_SESSION['login'])) { 
        header('Location: login.php');
        exit();
    }

    // meriksa parameter id
    if (isset($_GET['id'])) {
        $journal_id = $_GET['id'];

        // nyiapin query sql dan eksekusi hasil
        $sql = $conn->prepare("SELECT * FROM journal WHERE id = ?");
        $sql->bind_param("i", $journal_id);
        $sql->execute();
        $result = $sql->get_result();

        if ($result->num_rows > 0) {
            $journal = $result->fetch_assoc();
        } else {
            echo "Journal not found!";
            exit();
        }
    } else {
        echo "Journal ID not provided!";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($journal['title']); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5; 
            margin: 0;
            padding: 0; 
            height: 100vh; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
        }

        .container {
            background-color: #ffffff; 
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 90%; 
            max-width: 600px; 
            height: auto; 
            display: flex;
            flex-direction: column;
            box-sizing: border-box;
        }

        h2 {
            color: #333;
            text-align: center; 
            margin-bottom: 10px;
        }

        p {
            line-height: 1.6;
            color: #555; 
        }

        strong {
            color: #333; 
        }

        .back-button {
            display: inline-block;
            margin: 20px auto 0; 
            padding: 10px 20px; 
            background-color: #007bff; 
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none; 
            text-align: center;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #0056b3; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><?php echo htmlspecialchars($journal['title']); ?></h2>
        <p><strong>Date:</strong> <?php echo htmlspecialchars($journal['date']); ?></p>
        <p><?php echo nl2br(htmlspecialchars($journal['content'])); ?></p>
        <a class="back-button" href="jurnal.php">Back to List</a>
    </div>
</body>
</html>
