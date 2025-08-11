<?php
// API test dosyası
echo "<h2>🔍 Filmler API Testi</h2>";

// API'yi çağır
$apiUrl = "http://localhost/test2/filmler_api.php";
echo "<p>API URL: $apiUrl</p>";

try {
    $response = file_get_contents($apiUrl);
    $data = json_decode($response, true);
    
    echo "<h3>✅ API Response:</h3>";
    echo "<pre>" . print_r($data, true) . "</pre>";
    
    if ($data && $data['success']) {
        echo "<h3>✅ Başarılı! " . count($data['filmler']) . " film bulundu.</h3>";
        
        echo "<h4>📋 Filmler:</h4>";
        foreach ($data['filmler'] as $index => $film) {
            echo "<div style='border: 1px solid #ccc; margin: 10px; padding: 10px;'>";
            echo "<strong>Film " . ($index + 1) . ":</strong><br>";
            echo "Ad: " . $film['film_adi'] . "<br>";
            echo "Yönetmen: " . $film['yonetmen'] . "<br>";
            echo "Yıl: " . $film['yil'] . "<br>";
            echo "IMDB: " . $film['imdb_puani'] . "<br>";
            echo "Kategori: " . $film['kategori'] . "<br>";
            echo "Poster: " . substr($film['poster_url'], 0, 50) . "...<br>";
            echo "</div>";
        }
    } else {
        echo "<h3>❌ API Hatası:</h3>";
        echo "<p>" . ($data['error'] ?? 'Bilinmeyen hata') . "</p>";
    }
    
} catch (Exception $e) {
    echo "<h3>❌ Bağlantı Hatası:</h3>";
    echo "<p>" . $e->getMessage() . "</p>";
}

echo "<hr>";
echo "<h3>🔧 Debug Bilgileri:</h3>";
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<p>allow_url_fopen: " . (ini_get('allow_url_fopen') ? 'Açık' : 'Kapalı') . "</p>";
echo "<p>cURL: " . (function_exists('curl_init') ? 'Mevcut' : 'Yok') . "</p>";
?>
