<?php 
session_start();  // Memastikan session dimulai

include "koneksi.php";  // Koneksi ke database

// Tentukan bahasa berdasarkan pilihan
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];  // Set bahasa berdasarkan pilihan
}

// Jika session 'lang' belum diset, default ke bahasa Indonesia
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'bahasa_indonesia';  // Set bahasa default
}

// Memuat file bahasa sesuai dengan session
if ($_SESSION['lang'] == 'bahasa_indonesia') {
    include 'bahasa_indo.php';  // Bahasa default
} else {
    include 'bahasa_inggris.php';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($lang_judul); ?></title>
</head>
<body>
    <!-- Tautan bahasa untuk mengubah session bahasa -->
    <a href="index.php?lang=bahasa_inggris">Bahasa Inggris</a> 
    <a href="index.php?lang=bahasa_indonesia">Bahasa Indonesia</a>
    
    <nav> 
        <ul> 
            <li><a href="index.php"><?php echo htmlspecialchars($lang_menu_home); ?></a></li> 
            <li><a href="login.php"><?php echo htmlspecialchars($lang_menu_profile); ?></a></li> 
            <li><a href="login.php"><?php echo htmlspecialchars($lang_menu_contact); ?></a></li> 
            <li><a href="addBerita.php"><?php echo htmlspecialchars($lang_menu_add); ?></a></li>
            
            <!-- Tampilkan tautan logout jika pengguna sudah login -->
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']): ?>
                <li><a href="logout.php">Logout</a></li>
            <?php endif; ?>
        </ul> 
    </nav> 
    
    <p> 
        <?php echo htmlspecialchars($lang_selamat_datang); ?> 
    </p>
    
    <table border="1"> 
    <?php
    // Pastikan koneksi ke database sudah benar
    if (!$mysqli) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    // Query ke database
    $sql = "SELECT * FROM berita ORDER BY id_berita ASC";
    $hasil = mysqli_query($mysqli, $sql);

    if (!$hasil) {
        echo "Error: " . mysqli_error($mysqli);
        exit;
    }

    // Tampilkan header tabel berdasarkan bahasa
    if ($_SESSION['lang'] == "bahasa_indonesia") {
        echo "<tr> 
                <th>Id</th> 
                <th>Waktu</th> 
                <th>Judul</th> 
                <th>Isi</th> 
                <th>Nama File</th> 
              </tr>";
    } else if ($_SESSION['lang'] == "bahasa_inggris") {
        echo "<tr> 
                <th>Id</th> 
                <th>Time</th> 
                <th>Title</th> 
                <th>Content</th> 
                <th>File Name</th> 
              </tr>";
    }

    // Loop untuk menampilkan data
    while ($row = mysqli_fetch_assoc($hasil)) {
        $id_berita = htmlspecialchars($row['id_berita']);
        $waktu_berita = htmlspecialchars($row['waktu_simpan']);
        $judul_id = htmlspecialchars($row['judul_id']);
        $judul_en = htmlspecialchars($row['judul_en']);
        $isi_id = htmlspecialchars($row['isi_id']);
        $isi_en = htmlspecialchars($row['isi_en']);
        $nama_file = htmlspecialchars($row['nama_file']);

        if ($_SESSION['lang'] == "bahasa_inggris") {
            echo "<tr>
                    <td>$id_berita</td> 
                    <td>$waktu_berita</td> 
                    <td>$judul_en</td> 
                    <td>$isi_en</td> 
                    <td><a href='berkas/$nama_file'>$nama_file</a></td> 
                  </tr>";
        } else if ($_SESSION['lang'] == "bahasa_indonesia") {
            echo "<tr>
                    <td>$id_berita</td> 
                    <td>$waktu_berita</td> 
                    <td>$judul_id</td> 
                    <td>$isi_id</td> 
                    <td><a href='berkas/$nama_file'>$nama_file</a></td> 
                  </tr>";
        }
    }

    // Jika tidak ada data
    if (mysqli_num_rows($hasil) == 0) {
        echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
    }
    ?>
    </table>
</body>
</html>
