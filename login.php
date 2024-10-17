<?php
// Mulai session
session_start();

// Hardcoded username dan password
$valid_username = "admin";
$valid_password = "password123";

// Inisialisasi variabel error untuk menyimpan pesan kesalahan
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil username dan password dari input form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek apakah username dan password sesuai dengan yang di-hardcode
    if ($username === $valid_username && $password === $valid_password) {
        // Login berhasil, simpan informasi ke dalam session
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;

        // Redirect ke halaman utama atau dashboard
        header("Location: addBerita.php");
        exit();
    } else {
        // Jika username atau password salah, tampilkan pesan error
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    <!-- Menampilkan pesan error jika login gagal -->
    <?php if (!empty($error)): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <!-- Form login -->
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
