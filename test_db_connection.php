<?php
echo "<h2>🔍 Veritabanı Bağlantı Testi</h2>";

// Veritabanı bağlantısı
$baglanti = new mysqli("localhost", "root", "", "basit_sistem");

if ($baglanti->connect_error) {
    echo "<p style='color: red;'>❌ Veritabanı bağlantı hatası: " . $baglanti->connect_error . "</p>";
    exit;
}

echo "<p style='color: green;'>✅ Veritabanı bağlantısı başarılı</p>";

// Tabloları listele
echo "<h3>📋 Mevcut Tablolar:</h3>";
$tablolar = $baglanti->query("SHOW TABLES");
echo "<ul>";
while ($tablo = $tablolar->fetch_array()) {
    echo "<li>" . $tablo[0] . "</li>";
}
echo "</ul>";

// kisiler tablosunu kontrol et
echo "<h3>👥 Kisiler Tablosu Kontrolü:</h3>";
$kisiler_tablo = $baglanti->query("SHOW TABLES LIKE 'kisiler'");
if ($kisiler_tablo->num_rows > 0) {
    echo "<p style='color: green;'>✅ kisiler tablosu bulundu</p>";
    
    // Sütunları göster
    $sutunlar = $baglanti->query("SHOW COLUMNS FROM kisiler");
    echo "<h4>📊 Tablo Yapısı:</h4>";
    echo "<table border='1' style='border-collapse: collapse;'>";
    echo "<tr><th>Sütun</th><th>Tip</th><th>Null</th><th>Key</th><th>Default</th></tr>";
    while ($sutun = $sutunlar->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $sutun['Field'] . "</td>";
        echo "<td>" . $sutun['Type'] . "</td>";
        echo "<td>" . $sutun['Null'] . "</td>";
        echo "<td>" . $sutun['Key'] . "</td>";
        echo "<td>" . $sutun['Default'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    // Veri sayısını kontrol et
    $veri_sayisi = $baglanti->query("SELECT COUNT(*) as toplam FROM kisiler");
    $sayi = $veri_sayisi->fetch_assoc();
    echo "<p><strong>Toplam kullanıcı sayısı:</strong> " . $sayi['toplam'] . "</p>";
    
    // İlk 5 kullanıcıyı göster
    $kisiler = $baglanti->query("SELECT id, username, adsoyad, e_posta, rol FROM kisiler LIMIT 5");
    if ($kisiler->num_rows > 0) {
        echo "<h4>📝 İlk 5 Kullanıcı:</h4>";
        echo "<table border='1' style='border-collapse: collapse;'>";
        echo "<tr><th>ID</th><th>Kullanıcı Adı</th><th>Ad Soyad</th><th>E-posta</th><th>Rol</th></tr>";
        while ($kisi = $kisiler->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $kisi['id'] . "</td>";
            echo "<td>" . htmlspecialchars($kisi['username']) . "</td>";
            echo "<td>" . htmlspecialchars($kisi['adsoyad']) . "</td>";
            echo "<td>" . htmlspecialchars($kisi['e_posta']) . "</td>";
            echo "<td>" . htmlspecialchars($kisi['rol']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='color: orange;'>⚠️ Tabloda hiç kullanıcı yok!</p>";
    }
    
} else {
    echo "<p style='color: red;'>❌ kisiler tablosu bulunamadı!</p>";
}

// API endpoint testi
echo "<h3>🔗 API Endpoint Testi:</h3>";
echo "<p><a href='api.php?kisiler=1' target='_blank'>api.php?kisiler=1</a></p>";

$baglanti->close();
?> 