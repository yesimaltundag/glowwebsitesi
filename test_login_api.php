<?php
// API Login Test Scripti
echo "<h2>🔐 API Login Test</h2>";

// Test verileri
$test_data = [
    'username' => 'testuser',
    'sifre' => '123456'
];

// cURL ile API'yi test et
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://localhost/test2/api.php?login=1");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($test_data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Accept: application/json'
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "<h3>📤 Gönderilen Veri:</h3>";
echo "<pre>" . json_encode($test_data, JSON_PRETTY_PRINT) . "</pre>";

echo "<h3>📥 API Yanıtı:</h3>";
echo "<p><strong>HTTP Kodu:</strong> $http_code</p>";
echo "<pre>" . $response . "</pre>";

// Yanıtı decode et
$decoded = json_decode($response, true);
if ($decoded) {
    echo "<h3>🔍 Decode Edilmiş Yanıt:</h3>";
    echo "<pre>" . json_encode($decoded, JSON_PRETTY_PRINT) . "</pre>";
    
    if (isset($decoded['success']) && $decoded['success']) {
        echo "<p style='color: green;'>✅ Login başarılı!</p>";
        echo "<p><strong>Kullanıcı Bilgileri:</strong></p>";
        echo "<ul>";
        foreach ($decoded['kullanici'] as $key => $value) {
            if ($key !== 'sifre') {
                echo "<li><strong>$key:</strong> $value</li>";
            }
        }
        echo "</ul>";
    } else {
        echo "<p style='color: red;'>❌ Login başarısız!</p>";
        if (isset($decoded['message'])) {
            echo "<p><strong>Hata:</strong> " . $decoded['message'] . "</p>";
        }
    }
} else {
    echo "<p style='color: red;'>❌ JSON decode hatası!</p>";
}

// Veritabanından kullanıcıyı kontrol et
echo "<h3>🗄️ Veritabanı Kontrolü:</h3>";
$baglanti = new mysqli("localhost", "root", "", "basit_sistem");
if ($baglanti->connect_error) {
    echo "<p style='color: red;'>❌ Veritabanı bağlantı hatası: " . $baglanti->connect_error . "</p>";
} else {
    $username = $baglanti->real_escape_string($test_data['username']);
    $sonuc = $baglanti->query("SELECT * FROM kisiler WHERE username = '$username'");
    
    if ($sonuc && $sonuc->num_rows > 0) {
        $kullanici = $sonuc->fetch_assoc();
        echo "<p style='color: green;'>✅ Kullanıcı veritabanında bulundu</p>";
        echo "<p><strong>Kullanıcı Adı:</strong> " . $kullanici['username'] . "</p>";
        echo "<p><strong>Ad Soyad:</strong> " . $kullanici['adsoyad'] . "</p>";
        echo "<p><strong>Rol:</strong> " . $kullanici['rol'] . "</p>";
        
        // Şifre kontrolü
        if (password_verify($test_data['sifre'], $kullanici['sifre'])) {
            echo "<p style='color: green;'>✅ Şifre doğru!</p>";
        } else {
            echo "<p style='color: red;'>❌ Şifre yanlış!</p>";
        }
    } else {
        echo "<p style='color: red;'>❌ Kullanıcı veritabanında bulunamadı!</p>";
    }
    $baglanti->close();
}
?> 