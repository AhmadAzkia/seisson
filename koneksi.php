<?php
// Informasi koneksi ke database
$host = 'localhost'; // Atau sesuaikan dengan host database Anda
$user = 'root';      // Username MySQL Anda
$pass = '';          // Password MySQL Anda (kosongkan jika tidak ada password)
$dbname = 'db_berita'; // Ganti dengan nama database Anda

// Membuat koneksi ke database
$mysqli = new mysqli($host, $user, $pass, $dbname);

// Cek apakah koneksi berhasil
if ($mysqli->connect_error) {
    die("Koneksi ke database gagal: " . $mysqli->connect_error);
}
?>
