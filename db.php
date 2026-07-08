<?php
error_reporting(E_ALL);
ini_set('display_errors' ,1);

$sunucu = getenv('MYSQLHOST') ?: ($_ENV['MYSQLHOST'] ?? null);
$kullanici = getenv('MYSQLUSER') ?: ($_ENV['MYSQLUSER'] ?? 'root)';
$sifre = getenv('MYSQLPASSWORD') ?: ($_ENV['MYSQLPASSWORD'] ?? null);
$veritabani = getenv('MYSQLDATABASE') ?: (_ENV['MYSQLDATABASE'] ?? null);
$port = getenv('MYSQLPORT') ?: (_ENV['MYSQLPORT'] ?? '3306');

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
