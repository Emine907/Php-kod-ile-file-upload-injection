<?php
$sunucu = "juntion.proxy.rlwy.net";
$kullanici = "root";
$sifre = "";
$veritabani = "railway";
$port = "3306";

//Veritabanı bağlantısı
$baglan = mysqli_connect($sunucu, $kullanici, $sifre, $veritabani, $port);

//Bağlantı hatası kontrolü
if (!$baglan) {
        die("Bağlantı başarısız: " . mysqli_connect_error());
}


$sql = "CREATE TABLE IF NOT EXIST gorevler (
        id INT AUTO_INCREMENT PRIMARY KEY,
        gorev VARCHAR(255) NOT NULL
)";
mysqli_query($conn, $sql);
?>
