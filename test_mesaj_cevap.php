<?php
echo "<h2>🧪 Mesaj Cevap API Testi</h2>";

// Test fonksiyonları
function testAPI($url, $method = 'GET', $data = null) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    
    if ($data && $method !== 'GET') {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen(json_encode($data))
        ]);
    }
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    return [
        'http_code' => $httpCode,
        'response' => json_decode($response, true),
        'raw_response' => $response
    ];
}

echo "<h3>📋 Test 1: Tüm Cevapları Getir</h3>";
$result1 = testAPI('http://localhost/test2/mesaj_cevap_api.php');
echo "<p><strong>HTTP Code:</strong> " . $result1['http_code'] . "</p>";
echo "<p><strong>Response:</strong></p>";
echo "<pre>" . print_r($result1['response'], true) . "</pre>";

echo "<h3>📋 Test 2: Belirli Mesajın Cevaplarını Getir</h3>";
$result2 = testAPI('http://localhost/test2/mesaj_cevap_api.php?iletisim_id=1');
echo "<p><strong>HTTP Code:</strong> " . $result2['http_code'] . "</p>";
echo "<p><strong>Response:</strong></p>";
echo "<pre>" . print_r($result2['response'], true) . "</pre>";

echo "<h3>📋 Test 3: Yeni Cevap Ekle</h3>";
$testData = [
    'iletisim_formu_id' => 1,
    'cevap_mesaji' => 'Bu bir test cevabıdır. API testi için eklenmiştir.',
    'cevap_veren_yonetici_user_id' => 1
];
$result3 = testAPI('http://localhost/test2/mesaj_cevap_api.php', 'POST', $testData);
echo "<p><strong>HTTP Code:</strong> " . $result3['http_code'] . "</p>";
echo "<p><strong>Response:</strong></p>";
echo "<pre>" . print_r($result3['response'], true) . "</pre>";

echo "<h3>📋 Test 4: Cevap Güncelle</h3>";
$updateData = [
    'cevap_id' => 1,
    'cevap_mesaji' => 'Bu cevap güncellenmiştir.'
];
$result4 = testAPI('http://localhost/test2/mesaj_cevap_api.php', 'PUT', $updateData);
echo "<p><strong>HTTP Code:</strong> " . $result4['http_code'] . "</p>";
echo "<p><strong>Response:</strong></p>";
echo "<pre>" . print_r($result4['response'], true) . "</pre>";

echo "<h3>📋 Test 5: Cevap Sil</h3>";
$result5 = testAPI('http://localhost/test2/mesaj_cevap_api.php?cevap_id=1', 'DELETE');
echo "<p><strong>HTTP Code:</strong> " . $result5['http_code'] . "</p>";
echo "<p><strong>Response:</strong></p>";
echo "<pre>" . print_r($result5['response'], true) . "</pre>";

echo "<h3>🔗 API Endpoint'leri:</h3>";
echo "<ul>";
echo "<li><strong>GET</strong> mesaj_cevap_api.php - Tüm cevapları getir</li>";
echo "<li><strong>GET</strong> mesaj_cevap_api.php?iletisim_id=X - Belirli mesajın cevaplarını getir</li>";
echo "<li><strong>GET</strong> mesaj_cevap_api.php?cevap_id=X - Belirli cevabı getir</li>";
echo "<li><strong>POST</strong> mesaj_cevap_api.php - Yeni cevap ekle</li>";
echo "<li><strong>PUT</strong> mesaj_cevap_api.php - Cevap güncelle</li>";
echo "<li><strong>DELETE</strong> mesaj_cevap_api.php?cevap_id=X - Cevap sil</li>";
echo "</ul>";

echo "<h3>📝 POST Data Formatı:</h3>";
echo "<pre>";
echo json_encode([
    'iletisim_formu_id' => 1,
    'cevap_mesaji' => 'Cevap metni buraya',
    'cevap_veren_yonetici_user_id' => 1
], JSON_PRETTY_PRINT);
echo "</pre>";
?> 