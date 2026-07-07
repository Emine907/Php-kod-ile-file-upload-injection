<?php
include 'upload.html';
?>
<?php
$hedef_klasor = "uploads/";

// Silme işlemi
if (isset($_GET['sil'])) {
    $dosya_adi = basename($_GET['sil']);
    $dosya_yolu = "uploads/" . $dosya_adi;

    // Dosyanın gerçekten var olup olmadığını kontrol et ve sil
    if (file_exists($dosya_yolu)) {
        unlink($dosya_yolu);
        echo "<p style='color:green;'>Dosya silindi.</p>";
    }
}

// Yükleme İşlemi
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['dosya'])) {
   // HATA KONTROLÜ
    if ($_FILES['dosya']['error'] !== UPLOAD_ERR_OK) {
        echo "Yükleme hatası! Hata kodu: " . $_FILES['dosya']['error'];
        // Hata kodlarını açıklayalım:
        switch ($_FILES['dosya']['error']) {
            case 1: echo " (Dosya php.ini içindeki upload_max_filesize değerinden büyük.)"; break;
            case 2: echo " (Dosya formdaki MAX_FILE_SIZE değerinden büyük.)"; break;
            case 3: echo " (Dosya sadece kısmen yüklendi.)"; break;
            case 4: echo " (Hiçbir dosya yüklenmedi.)"; break;
            case 6: echo " (Geçici klasör eksik.)"; break;
            case 7: echo " (Diske yazma başarısız oldu - İZİN HATASI!)"; break;
        }
    } else {
        $hedef_klasor = "uploads/";
        if (!is_dir($hedef_klasor)) { mkdir($hedef_klasor, 0777, true); }

        if (move_uploaded_file($_FILES["dosya"]["tmp_name"], $hedef_klasor . basename($_FILES["dosya"]["name"]))) {
            echo "Başarıyla yüklendi!";
        } else {
            echo "Dosya taşınamadı! Hedef klasör izinlerini kontrol edin.";
        }
    }
}
?>

<h2>Dosya Yükle</h2>
<form action="upload.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="dosya">
    <button type="submit">Yükle</button>
</form>

<hr>

<h2>Yüklenen Dosyalar</h2>

<ul>

<?php
//Dosyaları Listeleme
$dosyalar = scandir($hedef_klasor);
foreach ($dosyalar as $dosya) {
	if ($dosya !== '.' && $dosya !== '..') {
		echo "<li>". $dosya . "- <a href='?sil=" . $dosya . "'>[SİL]</a></li>";
	}
}
?>
</ul>
