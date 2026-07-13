<?php
error_reporting(E_ALL);
ini_set('display_errors' ,1);

$host = 'junction.proxy.rlwy.net';
$user = 'root';
$pass = '';
$dbname = 'railway';
$port = '3306';

try {
    // PHP'nin varsayılan olarak desteklediği PDO bağlantısını kuruyoruz
    $dsn = "mysql:host=$host;dbname=$dbname;port=$port;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $conn = new PDO($dsn, $user, $pass, $options);

    // Otomatik tablo oluşturma adımı
    $sql = "CREATE TABLE IF NOT EXISTS gorevler (
        id INT AUTO_INCREMENT PRIMARY KEY,
        gorev_adi VARCHAR(255) NOT NULL
    )";

    $conn->exec($sql);

} catch (\PDOException $e) {
    // Eğer bağlantı veya sorgu patlarsa ekrana detaylıca yazdıracak
    die("Veritabanı bağlantı hatası (PDO): " . $e->getMessage());
}
?>
