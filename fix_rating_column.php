<?php
/**
 * film_takip tablosundaki rating sütununun veri tipini 
 * INT'den DECIMAL(3,1)'e çevirir ve değerleri günceller
 */

// Veritabanı bağlantısı
$host = 'localhost';
$dbname = 'basit_sistem';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ Veritabanına başarıyla bağlanıldı.\n";
} catch(PDOException $e) {
    die("❌ Veritabanı bağlantı hatası: " . $e->getMessage() . "\n");
}

try {
    echo "🔧 Rating sütunu veri tipini güncelleniyor...\n";
    
    // Önce rating sütununun veri tipini değiştir
    $pdo->exec("ALTER TABLE film_takip MODIFY COLUMN rating DECIMAL(3,1) DEFAULT 0.0");
    echo "✅ Rating sütunu DECIMAL(3,1) olarak güncellendi.\n\n";
    
    // Şimdi tüm kayıtları doğru IMDb puanları ile güncelle
    echo "📊 Mevcut kayıtlar güncelleniyor...\n";
    
    $stmt = $pdo->query("SELECT id, title, rating FROM film_takip");
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "📋 Toplam " . count($records) . " kayıt bulundu.\n\n";
    
    $updatedCount = 0;
    $notFoundCount = 0;
    
    foreach ($records as $record) {
        $filmTitle = $record['title'];
        $currentRating = $record['rating'];
        
        // filmler tablosundan doğru IMDb puanını al
        $stmt = $pdo->prepare("SELECT imdb_puani FROM filmler WHERE film_adi = ? LIMIT 1");
        $stmt->execute([$filmTitle]);
        $filmData = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($filmData) {
            $correctImdbRating = floatval($filmData['imdb_puani']);
            
            // Rating'i doğru değerle güncelle
            $updateStmt = $pdo->prepare("UPDATE film_takip SET rating = ? WHERE id = ?");
            $updateStmt->execute([$correctImdbRating, $record['id']]);
            
            echo "✅ '{$filmTitle}' - {$currentRating} → {$correctImdbRating}\n";
            $updatedCount++;
        } else {
            echo "⚠️  '{$filmTitle}' - filmler tablosunda bulunamadı\n";
            $notFoundCount++;
        }
    }
    
    echo "\n🎯 Güncelleme Özeti:\n";
    echo "✅ Güncellenen: {$updatedCount} adet\n";
    echo "⚠️  Bulunamayan: {$notFoundCount} adet\n";
    echo "📊 Toplam: " . count($records) . " adet\n";
    
    // Örnek kayıtları kontrol et
    echo "\n🔍 Güncellenmiş kayıtları kontrol ediliyor:\n";
    $checkStmt = $pdo->query("SELECT title, rating FROM film_takip WHERE rating > 0 LIMIT 5");
    $sampleRecords = $checkStmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($sampleRecords as $sample) {
        echo "📽️  {$sample['title']} - Rating: {$sample['rating']}\n";
    }
    
} catch(PDOException $e) {
    echo "❌ İşlem hatası: " . $e->getMessage() . "\n";
}

echo "\n🚀 İşlem tamamlandı!\n";
echo "💡 Artık film takip sayfasında doğru IMDb puanları görünecek.\n";
?>
