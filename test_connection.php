<?php
echo "✅ PHP çalışıyor!<br>";
echo "📅 Tarih: " . date('Y-m-d H:i:s') . "<br>";
echo "🌐 Sunucu: " . $_SERVER['SERVER_NAME'] . "<br>";
echo "📁 Dizin: " . $_SERVER['DOCUMENT_ROOT'] . "<br>";

// Veritabanı bağlantısını test et
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "basit_sistem";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ Veritabanı bağlantısı başarılı!<br>";
    
    // Kitaplar tablosunu kontrol et
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM kitaplar");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "📚 Toplam kitap sayısı: " . $result['count'] . "<br>";
    
    // Kategorileri listele
    $stmt = $pdo->query("SELECT DISTINCT kategori, COUNT(*) as count FROM kitaplar GROUP BY kategori");
    $kategoriler = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "📋 Kategoriler:<br>";
    foreach ($kategoriler as $kat) {
        echo "- " . $kat['kategori'] . " (" . $kat['count'] . " kitap)<br>";
    }
    
} catch(PDOException $e) {
    echo "❌ Veritabanı hatası: " . $e->getMessage() . "<br>";
}
?>
