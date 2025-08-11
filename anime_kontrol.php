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

echo "<h2>🎬 Anime Veritabanı Kontrolü</h2>";

// Animeler tablosunu kontrol et
$check_table = "SHOW TABLES LIKE 'animeler'";
$result = $conn->query($check_table);

if ($result->num_rows == 0) {
    echo "❌ animeler tablosu bulunamadı!<br>";
    exit;
} else {
    echo "✅ animeler tablosu mevcut<br>";
}

// Tablo yapısını kontrol et
echo "<h3>📋 Tablo Yapısı:</h3>";
$columns = "SHOW COLUMNS FROM animeler";
$result = $conn->query($columns);

echo "<table border='1' style='border-collapse: collapse; margin: 10px 0;'>";
echo "<tr><th>Sütun</th><th>Tip</th><th>Null</th><th>Key</th><th>Default</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['Field'] . "</td>";
    echo "<td>" . $row['Type'] . "</td>";
    echo "<td>" . $row['Null'] . "</td>";
    echo "<td>" . $row['Key'] . "</td>";
    echo "<td>" . $row['Default'] . "</td>";
    echo "</tr>";
}
echo "</table>";

// Anime verilerini kontrol et
echo "<h3>🎭 Anime Verileri:</h3>";
$animes = "SELECT id, anime_adi, yonetmen, yil, tur, puan, kapak_url FROM animeler LIMIT 5";
$result = $conn->query($animes);

if ($result->num_rows == 0) {
    echo "❌ Hiç anime verisi bulunamadı!<br>";
} else {
    echo "<table border='1' style='border-collapse: collapse; margin: 10px 0;'>";
    echo "<tr><th>ID</th><th>Anime Adı</th><th>Yönetmen</th><th>Yıl</th><th>Tür</th><th>Puan</th><th>Kapak URL</th></tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['anime_adi'] . "</td>";
        echo "<td>" . $row['yonetmen'] . "</td>";
        echo "<td>" . $row['yil'] . "</td>";
        echo "<td>" . $row['tur'] . "</td>";
        echo "<td>" . $row['puan'] . "</td>";
        echo "<td>" . (empty($row['kapak_url']) ? "❌ Boş" : "✅ Dolu") . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}

$conn->close();
?>
