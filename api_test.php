<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "basit_sistem";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

echo "<h2>🎭 API Test - Anime ID 1</h2>";

// API'den gelen veriyi simüle et
$id = 1;
$sonuc = $conn->query("SELECT * FROM animeler WHERE id = $id");

if ($sonuc && $sonuc->num_rows > 0) {
    $anime = $sonuc->fetch_assoc();
    
    echo "<h3>📋 Anime Verisi:</h3>";
    echo "<pre>";
    print_r($anime);
    echo "</pre>";
    
    echo "<h3>🖼️ Kapak URL Test:</h3>";
    if (!empty($anime['kapak_url'])) {
        echo "<p><strong>URL:</strong> " . $anime['kapak_url'] . "</p>";
        
        // Resmi göster
        echo "<h4>📸 Resim Önizleme:</h4>";
        echo "<img src='" . $anime['kapak_url'] . "' alt='" . $anime['anime_adi'] . "' style='max-width: 200px; border: 2px solid #ccc;' />";
        
        // URL'yi test et
        echo "<h4>🔗 URL Durumu:</h4>";
        $headers = @get_headers($anime['kapak_url']);
        if ($headers && strpos($headers[0], '200') !== false) {
            echo "<p style='color: green;'>✅ URL çalışıyor</p>";
        } else {
            echo "<p style='color: red;'>❌ URL çalışmıyor (404 hatası)</p>";
            echo "<p><strong>Hata:</strong> " . ($headers ? $headers[0] : 'Bağlantı hatası') . "</p>";
        }
    } else {
        echo "<p style='color: red;'>❌ kapak_url boş!</p>";
    }
} else {
    echo "<p style='color: red;'>❌ Anime bulunamadı!</p>";
}

$conn->close();
?>
