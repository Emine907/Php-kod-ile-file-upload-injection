<?php
$sunucu = "mysql.railway.internal";
$kullanici = "root";
$sifre = "xIlGKGTCTnYjlGEpLQsrzxMOfNRbiTIo";
$veritabani = "railway";

//Veritabanı bağlantısı
$baglan = mysqli_connect($sunucu, $kullanici, $sifre, $veritabani);

//Bağlantı hatası kontrolü
if (!$baglan) {
        die("Bağlantı başarısız: " . mysqli_connect_error());
}
?>
