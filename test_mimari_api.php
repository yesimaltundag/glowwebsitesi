<?php
// Mimari API test dosyası
echo "<h2>🏗️ Mimari API Test</h2>";

// Veritabanı bağlantısı
$baglanti = new mysqli("localhost", "root", "", "basit_sistem");

if ($baglanti->connect_error) {
    die("Veritabanı bağlantı hatası: " . $baglanti->connect_error);
}

// Doğrudan veritabanından veri çek
echo "<h3>📊 Veritabanından Doğrudan Veri Çekme:</h3>";
$sql = "SELECT * FROM mimari ORDER BY id";
$result = $baglanti->query($sql);

if ($result) {
    echo "<p style='color: green;'><strong>✅ Veritabanı sorgusu başarılı</strong></p>";
    echo "<p><strong>📊 Bulunan kayıt sayısı:</strong> " . $result->num_rows . "</p>";
    
    if ($result->num_rows > 0) {
        echo "<h4>📋 Veritabanındaki Veriler:</h4>";
        echo "<table border='1' style='border-collapse: collapse; width: 100%; margin-bottom: 20px;'>";
        echo "<tr><th>ID</th><th>Ad</th><th>Mimar</th><th>Tarih</th><th>Yer</th><th>Stil</th><th>Resim</th></tr>";
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['ad'] . "</td>";
            echo "<td>" . $row['mimar'] . "</td>";
            echo "<td>" . $row['tarih'] . "</td>";
            echo "<td>" . $row['yer'] . "</td>";
            echo "<td>" . $row['stil'] . "</td>";
            echo "<td style='max-width: 200px; word-break: break-all;'>" . substr($row['resim'], 0, 50) . "...</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
} else {
    echo "<p style='color: red;'><strong>❌ Veritabanı sorgusu hatası:</strong> " . $baglanti->error . "</p>";
}

// API endpoint'ini test et
echo "<h3>🔧 API Endpoint Test:</h3>";
$api_url = "http://localhost/test2/api.php?mimari=1";
echo "<p>API URL: <code>$api_url</code></p>";

// cURL ile API'yi çağır
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

echo "<p><strong>HTTP Kodu:</strong> $http_code</p>";

if ($error) {
    echo "<p style='color: red;'><strong>❌ cURL Hatası:</strong> $error</p>";
} else {
    echo "<p style='color: green;'><strong>✅ cURL Başarılı</strong></p>";
}

echo "<p><strong>📄 API Yanıtı:</strong></p>";
echo "<pre style='background: #f5f5f5; padding: 10px; border-radius: 5px; max-height: 400px; overflow-y: auto;'>";
echo htmlspecialchars($response);
echo "</pre>";

// JSON decode test
$data = json_decode($response, true);
if ($data === null) {
    echo "<p style='color: red;'><strong>❌ JSON Decode Hatası:</strong> " . json_last_error_msg() . "</p>";
} else {
    echo "<p style='color: green;'><strong>✅ JSON Decode Başarılı</strong></p>";
    echo "<p><strong>📊 API'den gelen veri sayısı:</strong> " . count($data) . "</p>";
    
    if (count($data) > 0) {
        echo "<h4>📋 API'den Gelen İlk Eser:</h4>";
        echo "<ul>";
        foreach ($data[0] as $key => $value) {
            if ($key == 'resim') {
                echo "<li><strong>$key:</strong> " . substr($value, 0, 50) . "...</li>";
            } else {
                echo "<li><strong>$key:</strong> " . htmlspecialchars($value) . "</li>";
            }
        }
        echo "</ul>";
    }
}

echo "<hr>";
echo "<h3>🔧 Manuel Test Linkleri:</h3>";
echo "<ul>";
echo "<li><a href='$api_url' target='_blank'>Tüm Mimari Eserler</a></li>";
echo "<li><a href='http://localhost/test2/api.php?mimari=1&id=1' target='_blank'>ID=1 Eser</a></li>";
echo "<li><a href='http://localhost/test2/api.php?mimari=1&limit=3' target='_blank'>İlk 3 Eser</a></li>";
echo "<li><a href='http://localhost/test2/mimari.html' target='_blank'>Mimari.html Sayfası</a></li>";
echo "</ul>";

$baglanti->close();
?>
