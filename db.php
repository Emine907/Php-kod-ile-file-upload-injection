<?php
$sunucu = getenv('MYSQLHOST');
$kullanici = getenv('MYSQLUSER');
$sifre = getenv('MYSQLPASSWORD');
$veritabani = getenv('MYSQLDATABASE');
$port = getenv('MYSQLPORT'); 

//Veritabanı bağlantısı
$baglan = mysqli_connect($sunucu, $kullanici, $sifre, $veritabani, $port);

//Bağlantı hatası kontrolü
if (!$baglan) {
        die("Bağlantı başarısız: " . mysqli_connect_error());
}


$sql = "CREATE TABLE IF NOT EXIST gorevler (
        id INT AUTO_INCREMENT PRIMARY KEY,
        gorev VARCHAR(255) NOT NULL
);
mysqli_query($conn, $sql);
?>
