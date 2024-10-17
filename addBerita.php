<!DOCTYPE html>
<html>
<head>
    <title>Buku Tamu</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <center>
        <form action="simpan_berita.php" method="post" enctype="multipart/form-data">
            <h1>FORM TAMBAH BERITA</h1>
            <h2>UNIKOM NEWS</h2>
            <hr>
            <table>
                <tr>
                    <td>Judul Berita Bahasa Indonesia</td>
                    <td><input type="text" name="judul_berita_indonesia" size="50" required></td>
                </tr>
                <tr>
                    <td>Judul Berita Bahasa Inggris</td>
                    <td><input type="text" name="judul_berita_inggris" size="50" required></td>
                </tr>
                <tr>
                    <td>Isi Berita Bahasa Indonesia</td>
                    <td><textarea rows="10" cols="50" name="isi_berita_indonesia" maxlength="1000" required></textarea></td>
                </tr>
                <tr>
                    <td>Isi Berita Bahasa Inggris</td>
                    <td><textarea rows="10" cols="50" name="isi_berita_inggris" maxlength="1000" required></textarea></td>
                </tr>
                <tr>
                    <td>File Pendukung</td>
                    <td><input type="file" name="file" required></td>
                </tr>
            </table>
            <br><br>
            <input type="submit" value="Simpan" name="simpan">
            <input type="reset" value="Reset">
        </form>
    </center>
</body>
</html>
