<?php
include 'index.html';
?>

<?php
//500 hatası yerine hatanın ismini vermesi için 
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php'; //db.php buraya bağlanıyor.
//Formdan veri gelirse veritabanına eklemek için 
if(isset($_POST['gorev']) && !empty($_POST['gorev'])) {
        $yeni_gorev = $_POST['gorev'];
        $stmt = $baglan->prepare("INSERT INTO gorevler (gorev) VALUES(?)");
        $stmt->bind_param("s", $yeni_gorev);
        $stmt->execute();
        header("Location: /file_injection");
        exit;
}
if(isset($_GET['sil'])) {
        $silinecek_id = (int) $_GET['sil'];
        $stmt = $baglan-> prepare("DELETE FROM gorevler WHERE id = ?");
        $stmt -> bind_param("i",$silinecek_id);
        $stmt->execute();
        $stmt->close();
        header("Location: /file_injection");
        exit;
}
?>
<?php
//Görevleri listele
$ara = isset($_GET['ara']) ? $_GET['ara'] : "";
if($ara == "") {
        $sorgu = $baglan->prepare("SELECT * FROM  gorevler");
} else {
        $sorgu = $baglan->prepare("SELECT * FROM gorevler WHERE gorev = ?");
        $sorgu -> bind_param("s", $ara);
}
$sorgu->execute();
$liste = $sorgu->get_result();
while ($satir = mysqli_fetch_assoc($liste)) {
        echo "<li>" .htmlspecialchars ($satir['gorev']) . " <a href='? sil=" . $satir['id'] . " '>[Sil]</a></li>";
}
//Kod bitiminde sonucun serbest bırakılıp statemnt'ı boşaltmamız gerekir.
//$liste ->free();
$sorgu->close();
?>
