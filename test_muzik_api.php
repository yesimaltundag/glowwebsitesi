<?php
// Müzik API test dosyası
$baglanti = new mysqli("localhost", "root", "", "basit_sistem");

if ($baglanti->connect_error) {
    die("Veritabanı bağlantı hatası: " . $baglanti->connect_error);
}

echo "<h2>🎵 Müzik API Test</h2>";

// 1. Tüm müzik türlerini listele
echo "<h3>1. Müzik Türleri:</h3>";
$sonuc = $baglanti->query("SELECT DISTINCT tur, COUNT(*) as sarki_sayisi FROM muzikler GROUP BY tur ORDER BY sarki_sayisi DESC");

if ($sonuc) {
    while ($satir = $sonuc->fetch_assoc()) {
        echo "<p>• <strong>{$satir['tur']}</strong> - {$satir['sarki_sayisi']} şarkı</p>";
    }
} else {
    echo "<p>❌ Hata: " . $baglanti->error . "</p>";
}

// 2. Klasik müzik şarkılarını listele
echo "<h3>2. Klasik Müzik Şarkıları:</h3>";
$sonuc = $baglanti->query("SELECT * FROM muzikler WHERE tur = 'Klasik' ORDER BY yayin_yili DESC");

if ($sonuc) {
    echo "<p>✅ Bulunan şarkı sayısı: " . $sonuc->num_rows . "</p>";
    while ($satir = $sonuc->fetch_assoc()) {
        echo "<p>• <strong>{$satir['muzik_adi']}</strong> - {$satir['sanatci']} ({$satir['yayin_yili']})</p>";
    }
} else {
    echo "<p>❌ Hata: " . $baglanti->error . "</p>";
}

// 3. Tüm şarkıları listele
echo "<h3>3. Tüm Şarkılar (İlk 10):</h3>";
$sonuc = $baglanti->query("SELECT * FROM muzikler ORDER BY id LIMIT 10");

if ($sonuc) {
    while ($satir = $sonuc->fetch_assoc()) {
        echo "<p>• <strong>{$satir['muzik_adi']}</strong> - {$satir['sanatci']} ({$satir['tur']})</p>";
    }
} else {
    echo "<p>❌ Hata: " . $baglanti->error . "</p>";
}

$baglanti->close();
?>
