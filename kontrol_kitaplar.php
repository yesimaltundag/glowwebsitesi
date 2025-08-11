<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "basit_sistem";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES utf8");
    echo "✅ Veritabanı bağlantısı başarılı!<br><br>";
} catch(PDOException $e) {
    echo "❌ Bağlantı hatası: " . $e->getMessage();
    exit;
}

// Kitaplar tablosundaki verileri kontrol et
try {
    $stmt = $pdo->query("SELECT COUNT(*) as toplam FROM kitaplar");
    $count = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "📚 Kitaplar tablosunda toplam " . $count['toplam'] . " kitap var.<br><br>";
    
         // Rastgele 8 kitabı listele
     $stmt = $pdo->query("SELECT kitap_adi, yazar, kapak_url FROM kitaplar ORDER BY RAND() LIMIT 8");
     $kitaplar = $stmt->fetchAll(PDO::FETCH_ASSOC);
     
     echo "📖 Rastgele 8 kitap:<br>";
     foreach ($kitaplar as $kitap) {
       echo "• {$kitap['kitap_adi']} - {$kitap['yazar']}<br>";
       echo "  🖼️ Kapak: {$kitap['kapak_url']}<br><br>";
     }
    
} catch(PDOException $e) {
    echo "❌ Hata: " . $e->getMessage();
}
?>
