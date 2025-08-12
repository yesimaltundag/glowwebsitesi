<?php
// Mimari API Debug
echo "<h2>🔍 Mimari API Debug</h2>";

// GET parametrelerini kontrol et
echo "<h3>📊 GET Parametreleri:</h3>";
echo "<pre>";
print_r($_GET);
echo "</pre>";

// Mimari parametresi var mı?
echo "<h3>🔍 Mimari Parametresi Kontrolü:</h3>";
if (isset($_GET["mimari"])) {
    echo "✅ mimari parametresi var: " . $_GET["mimari"] . "<br>";
} else {
    echo "❌ mimari parametresi yok<br>";
}

// Veritabanı bağlantısı
$baglanti = new mysqli("localhost", "root", "", "basit_sistem");

if ($baglanti->connect_error) {
    die("❌ Veritabanı bağlantı hatası: " . $baglanti->connect_error);
}

echo "✅ Veritabanı bağlantısı başarılı<br>";

// Mimari tablosunu kontrol et
echo "<h3>🏗️ Mimari Tablosu Kontrolü:</h3>";
$mimari_check = $baglanti->query("SELECT COUNT(*) as count FROM mimari");
if ($mimari_check) {
    $row = $mimari_check->fetch_assoc();
    echo "✅ Mimari tablosu mevcut<br>";
    echo "📊 Kayıt sayısı: " . $row['count'] . "<br>";
    
    if ($row['count'] > 0) {
        echo "<h4>📋 İlk 3 Mimari Eser:</h4>";
        $data = $baglanti->query("SELECT id, ad, mimar FROM mimari LIMIT 3");
        while ($row = $data->fetch_assoc()) {
            echo "- ID: " . $row['id'] . " | " . $row['ad'] . " | " . $row['mimar'] . "<br>";
        }
    } else {
        echo "⚠️ Mimari tablosu boş!<br>";
    }
} else {
    echo "❌ Mimari tablosu bulunamadı: " . $baglanti->error . "<br>";
}

// Doğrudan mimari sorgusu yap
echo "<h3>🔧 Doğrudan Mimari Sorgusu:</h3>";
$sql = "SELECT * FROM mimari ORDER BY id DESC";
echo "SQL: " . $sql . "<br>";

$result = $baglanti->query($sql);
if ($result) {
    echo "✅ Sorgu başarılı<br>";
    echo "📊 Bulunan kayıt: " . $result->num_rows . "<br>";
    
    if ($result->num_rows > 0) {
        echo "<h4>📋 Mimari Eserler:</h4>";
        while ($row = $result->fetch_assoc()) {
            echo "- ID: " . $row['id'] . " | " . $row['ad'] . " | " . $row['mimar'] . "<br>";
        }
    }
} else {
    echo "❌ Sorgu hatası: " . $baglanti->error . "<br>";
}

// Kisiler tablosunu da kontrol et
echo "<h3>👥 Kisiler Tablosu Kontrolü:</h3>";
$kisiler_check = $baglanti->query("SELECT COUNT(*) as count FROM kisiler");
if ($kisiler_check) {
    $row = $kisiler_check->fetch_assoc();
    echo "✅ Kisiler tablosu mevcut<br>";
    echo "📊 Kayıt sayısı: " . $row['count'] . "<br>";
}

$baglanti->close();

echo "<hr>";
echo "<h3>🔗 Test Linkleri:</h3>";
echo "<a href='api.php?mimari=1' target='_blank'>API Test: api.php?mimari=1</a><br>";
echo "<a href='api.php' target='_blank'>API Test: api.php (varsayılan)</a><br>";
echo "<a href='mimari.html' target='_blank'>Mimari Sayfası</a><br>";
?>
