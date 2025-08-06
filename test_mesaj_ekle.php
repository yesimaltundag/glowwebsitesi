<?php
// Veritabanı bağlantısı
$baglanti = new mysqli("localhost", "root", "", "basit_sistem");

if ($baglanti->connect_error) {
    die("Veritabanı bağlantı hatası: " . $baglanti->connect_error);
}

// Test mesajı ekle
$adisoyadi = "Test Kullanıcı";
$eposta = "test@example.com";
$mesaj = "Bu bir test mesajıdır. Mesaj yönetimi sayfasını test etmek için eklenmiştir.";
$konu = "İletişim Formu";

$sql = "INSERT INTO iletisim_formu (adisoyadi, eposta, mesaj, konu) VALUES (?, ?, ?, ?)";
$stmt = $baglanti->prepare($sql);
$stmt->bind_param("ssss", $adisoyadi, $eposta, $mesaj, $konu);

if ($stmt->execute()) {
    echo "<h2 style='color: green;'>✅ Test mesajı başarıyla eklendi!</h2>";
    echo "<p><strong>Ad Soyad:</strong> $adisoyadi</p>";
    echo "<p><strong>E-posta:</strong> $eposta</p>";
    echo "<p><strong>Mesaj:</strong> $mesaj</p>";
    echo "<p><strong>Konu:</strong> $konu</p>";
    echo "<p><a href='mesaj-yonetimi.html'>Mesaj Yönetimi Sayfasına Git</a></p>";
} else {
    echo "<h2 style='color: red;'>❌ Test mesajı eklenirken hata oluştu!</h2>";
    echo "<p>Hata: " . $stmt->error . "</p>";
}

$stmt->close();
$baglanti->close();
?> 