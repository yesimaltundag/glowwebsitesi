<?php
// Hızlı veritabanı test
echo "<h2>🔍 Hızlı Veritabanı Test</h2>";

// Veritabanı bağlantısı
$baglanti = new mysqli("localhost", "root", "", "basit_sistem");

if ($baglanti->connect_error) {
    die("❌ Veritabanı bağlantı hatası: " . $baglanti->connect_error);
}

echo "✅ Veritabanı bağlantısı başarılı<br>";

// Tabloları listele
$tables = $baglanti->query("SHOW TABLES");
echo "<h3>📋 Mevcut Tablolar:</h3>";
while ($table = $tables->fetch_array()) {
    echo "- " . $table[0] . "<br>";
}

// Mimari tablosunu kontrol et
echo "<h3>🏗️ Mimari Tablosu Kontrolü:</h3>";
$mimari_check = $baglanti->query("SELECT COUNT(*) as count FROM mimari");
if ($mimari_check) {
    $row = $mimari_check->fetch_assoc();
    echo "✅ Mimari tablosu mevcut<br>";
    echo "📊 Kayıt sayısı: " . $row['count'] . "<br>";
    
    if ($row['count'] > 0) {
        echo "<h4>📋 İlk 3 Kayıt:</h4>";
        $data = $baglanti->query("SELECT id, ad, mimar FROM mimari LIMIT 3");
        while ($row = $data->fetch_assoc()) {
            echo "- ID: " . $row['id'] . " | " . $row['ad'] . " | " . $row['mimar'] . "<br>";
        }
    } else {
        echo "⚠️ Tablo boş!<br>";
    }
} else {
    echo "❌ Mimari tablosu bulunamadı: " . $baglanti->error . "<br>";
}

$baglanti->close();
?>
