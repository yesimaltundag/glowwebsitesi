<?php
/**
 * Mevcut film_takip tablosundaki rating sütununu 
 * filmler tablosundaki imdb_puani ile günceller
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
    // Mevcut film_takip kayıtlarını al
    $stmt = $pdo->query("SELECT id, title, rating FROM film_takip");
    $filmTakipRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "📊 Toplam " . count($filmTakipRecords) . " adet film takip kaydı bulundu.\n\n";
    
    $updatedCount = 0;
    $notFoundCount = 0;
    
    foreach ($filmTakipRecords as $record) {
        $filmTitle = $record['title'];
        $currentRating = $record['rating'];
        
        // filmler tablosundan IMDb puanını al
        $stmt = $pdo->prepare("SELECT imdb_puani FROM filmler WHERE film_adi = ? LIMIT 1");
        $stmt->execute([$filmTitle]);
        $filmData = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($filmData) {
            $imdbRating = floatval($filmData['imdb_puani']);
            
            // Rating'i güncelle
            $updateStmt = $pdo->prepare("UPDATE film_takip SET rating = ? WHERE id = ?");
            $updateStmt->execute([$imdbRating, $record['id']]);
            
            echo "✅ '{$filmTitle}' - Rating güncellendi: {$currentRating} → {$imdbRating}\n";
            $updatedCount++;
        } else {
            echo "⚠️  '{$filmTitle}' - filmler tablosunda bulunamadı\n";
            $notFoundCount++;
        }
    }
    
    echo "\n🎯 Güncelleme Özeti:\n";
    echo "✅ Güncellenen: {$updatedCount} adet\n";
    echo "⚠️  Bulunamayan: {$notFoundCount} adet\n";
    echo "📊 Toplam: " . count($filmTakipRecords) . " adet\n";
    
} catch(PDOException $e) {
    echo "❌ Güncelleme hatası: " . $e->getMessage() . "\n";
}

echo "\n🚀 İşlem tamamlandı!\n";
?>
