<?php
// Süre verilerini kontrol et
$baglanti = new mysqli("localhost", "root", "", "basit_sistem");

if ($baglanti->connect_error) {
    die("Veritabanı bağlantı hatası: " . $baglanti->connect_error);
}

echo "<h2>🎵 Süre Verileri Kontrol</h2>";

// Klasik müzik şarkılarının süre verilerini kontrol et
echo "<h3>Klasik Müzik Şarkıları - Süre Verileri:</h3>";
$sonuc = $baglanti->query("SELECT muzik_adi, sanatci, sure, yayin_yili FROM muzikler WHERE tur = 'Klasik' ORDER BY id LIMIT 10");

if ($sonuc) {
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr><th>Şarkı Adı</th><th>Sanatçı</th><th>Süre (DB)</th><th>Yıl</th></tr>";
    
    while ($satir = $sonuc->fetch_assoc()) {
        $sure = $satir['sure'];
        $sureDurum = is_null($sure) ? "NULL" : ($sure === "" ? "BOŞ" : $sure);
        
        echo "<tr>";
        echo "<td>{$satir['muzik_adi']}</td>";
        echo "<td>{$satir['sanatci']}</td>";
        echo "<td style='color: " . (is_null($sure) || $sure === "" ? "red" : "green") . "'>{$sureDurum}</td>";
        echo "<td>{$satir['yayin_yili']}</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>❌ Hata: " . $baglanti->error . "</p>";
}

// Tüm şarkıların süre durumunu kontrol et
echo "<h3>Tüm Şarkılar - Süre Durumu:</h3>";
$sonuc = $baglanti->query("SELECT COUNT(*) as toplam, 
                          SUM(CASE WHEN sure IS NULL OR sure = '' THEN 1 ELSE 0 END) as bos_sure,
                          SUM(CASE WHEN sure IS NOT NULL AND sure != '' THEN 1 ELSE 0 END) as dolu_sure
                          FROM muzikler");

if ($sonuc) {
    $satir = $sonuc->fetch_assoc();
    echo "<p>📊 <strong>Toplam şarkı:</strong> {$satir['toplam']}</p>";
    echo "<p>❌ <strong>Boş süre:</strong> {$satir['bos_sure']}</p>";
    echo "<p>✅ <strong>Dolu süre:</strong> {$satir['dolu_sure']}</p>";
} else {
    echo "<p>❌ Hata: " . $baglanti->error . "</p>";
}

$baglanti->close();
?>
