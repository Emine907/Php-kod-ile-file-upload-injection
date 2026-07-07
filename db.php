<?php
$sunucu = "localhost";
$kullanici = "root";
$sifre = "";
$veritabani = "todo_db";

//Veritabanı bağlantısı
$baglan = mysqli_connect($sunucu, $kullanici, $sifre, $veritabani);

//Bağlantı hatası kontrolü
if (!$baglan) {
        die("Bağlantı başarısız: " . mysqli_connect_error());
}
?>
