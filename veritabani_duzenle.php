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

echo "<h2>🔧 Veritabanı Düzenleme</h2>";

// stüdyo sütununu studio olarak değiştir
$alter_sql = "ALTER TABLE animeler CHANGE `stüdyo` `studio` VARCHAR(100)";
if ($conn->query($alter_sql) === TRUE) {
    echo "✅ stüdyo sütunu studio olarak değiştirildi<br>";
} else {
    echo "❌ Sütun değiştirme hatası: " . $conn->error . "<br>";
}

// Test için bir anime verisini göster
$test_sql = "SELECT id, anime_adi, kapak_url FROM animeler WHERE id = 1";
$result = $conn->query($test_sql);

if ($result && $result->num_rows > 0) {
    $anime = $result->fetch_assoc();
    echo "<br><h3>🎭 Test Verisi:</h3>";
    echo "<p><strong>ID:</strong> " . $anime['id'] . "</p>";
    echo "<p><strong>Anime Adı:</strong> " . $anime['anime_adi'] . "</p>";
    echo "<p><strong>Kapak URL:</strong> " . $anime['kapak_url'] . "</p>";
    
    // URL'yi test et
    if (!empty($anime['kapak_url'])) {
        echo "<p><strong>URL Test:</strong> ";
        $headers = @get_headers($anime['kapak_url']);
        if ($headers && strpos($headers[0], '200') !== false) {
            echo "✅ URL çalışıyor</p>";
        } else {
            echo "❌ URL çalışmıyor (404 hatası)</p>";
        }
    }
}

$conn->close();
?>
