<?php
// Set time zone
date_default_timezone_set("Asia/Bangkok");

// Koneksi ke database
$host = "localhost";
$user = "root";
$pass = "";
$db = "db_berita";

$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_errno) {
    echo "Koneksi Gagal! " . $mysqli->connect_error;
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simpan Berita</title>
</head>
<body>
<center>

<?php
if (isset($_POST['simpan'])) {
    $judul_id = $_POST['judul_berita_indonesia'];
    $judul_en = $_POST['judul_berita_inggris'];
    $isi_id = $_POST['isi_berita_indonesia'];
    $isi_en = $_POST['isi_berita_inggris'];

    $ekstensi_diperbolehkan = array('png', 'jpg', 'pdf', 'zip');
    $nama = $_FILES['file']['name'];
    $x = explode('.', $nama);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];

    // Normalisasi nama file agar aman (mengganti spasi dengan underscore dan menghapus karakter khusus)
    $nama = str_replace(' ', '_', $nama); 
    $nama = preg_replace('/[^A-Za-z0-9_\.-]/', '', $nama); 

    // Pastikan folder 'berkas/' ada, jika tidak maka buat folder
    if (!file_exists('berkas')) {
        mkdir('berkas', 0777, true);
    }

    // Pengecekan ekstensi dan ukuran file
    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        if ($ukuran < 1048576) { // Batas ukuran 1 MB
            // Proses upload file
            if (move_uploaded_file($file_tmp, 'berkas/' . $nama)) {
                // Insert ke database
                $hasil = mysqli_query($mysqli, "INSERT INTO berita VALUES (NULL, NOW(), '$judul_id', '$judul_en', '$isi_id', '$isi_en', '$nama', 'T')");
                if ($hasil) {
                    echo 'Proses Upload File: Berhasil<br>';
                    echo '<a href="index.php">Kembali Ke Halaman Berita</a>';
                } else {
                    echo 'Proses Upload File: Gagal (Database Error)<br>';
                    echo '<a href="index.php">Kembali Ke Halaman Berita</a>';
                }
            } else {
                echo 'Proses pemindahan file gagal. Cek izin akses folder atau path folder.<br>';
            }
        } else {
            echo 'Ukuran File Terlalu Besar (Maksimal 1 MB).<br>';
        }
    } else {
        echo 'File yang dikirim tidak diperbolehkan. Hanya boleh: png, jpg, pdf, zip.<br>';
    }
}
?>

</center>
</body>
</html>
