<?php 
2. //set time zone 
3. date_default_timezone_set("Asia/Bangkok"); 
4. 
5. 
6. // Koneksi 
7. $host = "localhost"; 
8. $user = "root"; 
9. $pass = ""; 
10. $db = "berita"; 
11. 
12. $mysqli = new mysqli($host, $user, $pass, $db); 
13. if ($mysqli->connect_errno) { 
14. 
15. echo "Koneksi Gagal !". $mysqli->connect_errno; 
16. 
17. } else { 
18. 
19. // echo "Berhasil Konek !"; 
20. 
21. } 
22. ?>