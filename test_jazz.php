<?php
// Jazz müzik verilerini kontrol et
$baglanti = new mysqli("localhost", "root", "", "basit_sistem");

if ($baglanti->connect_error) {
    die("Veritabanı bağlantı hatası: " . $baglanti->connect_error);
}

echo "<h2>🎷 Jazz Müzik Verileri Kontrol</h2>";

// Jazz müzik şarkılarını listele
echo "<h3>Jazz Müzik Şarkıları:</h3>";
$sonuc = $baglanti->query("SELECT * FROM muzikler WHERE tur = 'Jazz' ORDER BY yayin_yili DESC");

if ($sonuc) {
    echo "<p>✅ Bulunan şarkı sayısı: " . $sonuc->num_rows . "</p>";
    
    if ($sonuc->num_rows > 0) {
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr><th>ID</th><th>Müzik Adı</th><th>Sanatçı</th><th>Tür</th><th>Yıl</th><th>Süre (sn)</th></tr>";
        
        while ($satir = $sonuc->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$satir['id']}</td>";
            echo "<td>{$satir['muzik_adi']}</td>";
            echo "<td>{$satir['sanatci']}</td>";
            echo "<td>{$satir['tur']}</td>";
            echo "<td>{$satir['yayin_yili']}</td>";
            echo "<td>{$satir['sure']}</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>❌ Jazz türünde şarkı bulunamadı!</p>";
    }
} else {
    echo "<p>❌ Hata: " . $baglanti->error . "</p>";
}

// Tüm müzik türlerini listele
echo "<h3>Tüm Müzik Türleri:</h3>";
$sonuc = $baglanti->query("SELECT DISTINCT tur, COUNT(*) as sarki_sayisi FROM muzikler GROUP BY tur ORDER BY sarki_sayisi DESC");

if ($sonuc) {
    while ($satir = $sonuc->fetch_assoc()) {
        echo "<p>• <strong>{$satir['tur']}</strong> - {$satir['sarki_sayisi']} şarkı</p>";
    }
} else {
    echo "<p>❌ Hata: " . $baglanti->error . "</p>";
}

$baglanti->close();
?>
