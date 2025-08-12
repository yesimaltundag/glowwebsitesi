<?php
// API Debug dosyası
error_log("=== DEBUG API BAŞLADI ===");

// GET parametrelerini kontrol et
echo "<h2>🔍 API Debug</h2>";
echo "<h3>GET Parametreleri:</h3>";
echo "<pre>" . print_r($_GET, true) . "</pre>";

// Müzik endpoint'i test et
if (isset($_GET["muzik"])) {
    echo "<h3>✅ Müzik endpoint tespit edildi!</h3>";
    
    $baglanti = new mysqli("localhost", "root", "", "basit_sistem");
    
    if ($baglanti->connect_error) {
        echo "<p>❌ Veritabanı bağlantı hatası: " . $baglanti->connect_error . "</p>";
        exit;
    }
    
    if (isset($_GET["tur"])) {
        $tur = $baglanti->real_escape_string($_GET["tur"]);
        echo "<p>🔍 Aranan tür: <strong>$tur</strong></p>";
        
        $query = "SELECT * FROM muzikler WHERE tur = '$tur' ORDER BY yayin_yili DESC";
        echo "<p>📝 SQL Sorgusu: <code>$query</code></p>";
        
        $sonuc = $baglanti->query($query);
        
        if (!$sonuc) {
            echo "<p>❌ SQL hatası: " . $baglanti->error . "</p>";
        } else {
            echo "<p>✅ SQL sorgusu başarılı</p>";
            echo "<p>📊 Bulunan satır sayısı: " . $sonuc->num_rows . "</p>";
            
            if ($sonuc->num_rows > 0) {
                echo "<h4>🎵 Bulunan Şarkılar:</h4>";
                while ($satir = $sonuc->fetch_assoc()) {
                    echo "<div style='border: 1px solid #ccc; margin: 10px; padding: 10px;'>";
                    echo "<strong>ID:</strong> " . $satir['id'] . "<br>";
                    echo "<strong>Müzik Adı:</strong> " . $satir['muzik_adi'] . "<br>";
                    echo "<strong>Sanatçı:</strong> " . $satir['sanatci'] . "<br>";
                    echo "<strong>Tür:</strong> " . $satir['tur'] . "<br>";
                    echo "<strong>Yıl:</strong> " . $satir['yayin_yili'] . "<br>";
                    echo "<strong>Süre:</strong> " . $satir['sure'] . "<br>";
                    echo "</div>";
                }
            } else {
                echo "<p>❌ Bu türde şarkı bulunamadı!</p>";
            }
        }
    } else {
        echo "<p>❌ 'tur' parametresi eksik!</p>";
    }
    
    $baglanti->close();
} else {
    echo "<h3>❌ Müzik endpoint tespit edilemedi!</h3>";
    echo "<p>GET parametrelerinde 'muzik' yok.</p>";
}

echo "<hr>";
echo "<h3>🔧 Test Linkleri:</h3>";
echo "<p><a href='?muzik=1&tur=Klasik'>Klasik Müzik Test</a></p>";
echo "<p><a href='?muzik=1&tur=Jazz'>Jazz Test</a></p>";
echo "<p><a href='?muzik=1'>Tüm Müzikler Test</a></p>";
?>
