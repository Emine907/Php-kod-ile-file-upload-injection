<?php
error_reporting(E_ALL);
ini_set('display_errors' ,1);

$host = getenv('MYSQLHOST') ?: ($_ENV['MYSQLHOST'] ?? null);
$user = getenv('MYSQLUSER') ?: ($_ENV['MYSQLUSER'] ?? 'root');
$pass = getenv('MYSQLPASSWORD') ?: ($_ENV['MYSQLPASSWORD'] ?? null);
$dbname = getenv('MYSQLDATABASE') ?: ($_ENV['MYSQLDATABASE'] ?? null);
$port = getenv('MYSQLPORT') ?: ($_ENV['MYSQLPORT'] ?? '3306');

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
        gorev_adi VARCHAR(255) NOT NULL,
        durum TINYINT(1) DEFAULT 0,
        olusturma_tarihi TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    $conn->exec($sql);

} catch (\PDOException $e) {
    // Eğer bağlantı veya sorgu patlarsa ekrana detaylıca yazdıracak
    die("Veritabanı bağlantı hatası (PDO): " . $e->getMessage());
}
?>
