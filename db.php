<?php
error_reporting(E_ALL);
ini_set('display_errors' ,1);

$host = getenv('MYSQLHOST') ? : 'junction.proxy.rlwy.net';
$user = getenv('MYSQLUSER') ? : 'root';
$pass = getenv('MYSQLPASSWORD') ? : '';
$dbname = getenv('MYSQLDATABASES') ? : 'railway';
$port = getenv('MYSQLPORT') ? : '3306';

try {
    // PHP'nin varsayılan olarak desteklediği PDO bağlantısını kuruyoruz
    $dsn = "mysql:host=$host;dbname=$dbname;port=$port;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Eğer bağlantı veya sorgu patlarsa ekrana detaylıca yazdıracak
    echo "Veritabanı bağlantı hatası (PDO): " . $e->getMessage();
}
?>
