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
    
    echo "📚 Veritabanındaki kategoriler:<br>";
    $stmt = $pdo->query("SELECT DISTINCT kategori FROM kitaplar ORDER BY kategori");
    $kategoriler = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    foreach($kategoriler as $kategori) {
        echo "• $kategori<br>";
    }
    
    echo "<br>📖 Kategori bazında kitap sayıları:<br>";
    $stmt = $pdo->query("SELECT kategori, COUNT(*) as sayi FROM kitaplar GROUP BY kategori ORDER BY kategori");
    $sayilar = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($sayilar as $sayi) {
        echo "• {$sayi['kategori']}: {$sayi['sayi']} kitap<br>";
    }
    
    echo "<br>🎯 Yazılar kategorileri ile eşleşen kitaplar:<br>";
    $yazilar_kategorileri = [
        'Kişisel Gelişim',
        'Kültür & Toplum', 
        'Teknoloji',
        'Sanat',
        'Eğitim',
        'Yaşam Tarzı',
        'Klasik Edebiyat',
        'Türk Edebiyatı'
    ];
    
    foreach($yazilar_kategorileri as $kategori) {
        $stmt = $pdo->prepare("SELECT COUNT(*) as sayi FROM kitaplar WHERE kategori = ?");
        $stmt->execute([$kategori]);
        $sayi = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $sayi['sayi'];
        
        if($count > 0) {
            echo "✅ $kategori: $count kitap<br>";
        } else {
            echo "❌ $kategori: 0 kitap (Bu kategori için kitap eklenmeli)<br>";
        }
    }
    
} catch(PDOException $e) {
    echo "❌ Hata: " . $e->getMessage();
}
?>
