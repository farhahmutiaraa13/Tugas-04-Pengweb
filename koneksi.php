<?php
$servername = "localhost";   // Nama host atau alamat IP server MySQL
$username = "root";          // Username MySQL (default: root)
$password = "";              // Password MySQL (kosong jika default)
$dbname = "journaling";   // Nama database yang dibuat

// Membuat koneksi ke database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Memeriksa apakah koneksi berhasil
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
