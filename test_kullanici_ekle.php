<?php
// Test kullanıcısı ekleme scripti
$baglanti = new mysqli("localhost", "root", "", "basit_sistem");

if ($baglanti->connect_error) {
    echo "❌ Veritabanı bağlantı hatası: " . $baglanti->connect_error;
    exit;
}

echo "✅ Veritabanı bağlantısı başarılı<br>";

// Test kullanıcısı ekle
$username = "testuser";
$adsoyad = "Test Kullanıcı";
$sifre = password_hash("123456", PASSWORD_DEFAULT);
$rol = "kullanici";

// Önce kullanıcının var olup olmadığını kontrol et
$kontrol = $baglanti->query("SELECT id FROM kisiler WHERE username = '$username'");
if ($kontrol->num_rows > 0) {
    echo "⚠️ '$username' kullanıcısı zaten mevcut<br>";
} else {
    // Yeni kullanıcı ekle
    $sql = "INSERT INTO kisiler (username, adsoyad, sifre, rol) VALUES ('$username', '$adsoyad', '$sifre', '$rol')";
    
    if ($baglanti->query($sql)) {
        echo "✅ Test kullanıcısı başarıyla eklendi<br>";
        echo "👤 Kullanıcı Adı: $username<br>";
        echo "🔑 Şifre: 123456<br>";
        echo "👑 Rol: $rol<br>";
    } else {
        echo "❌ Kullanıcı eklenirken hata: " . $baglanti->error . "<br>";
    }
}

// Mevcut kullanıcıları listele
echo "<h3>📋 Mevcut Kullanıcılar:</h3>";
$kullanicilar = $baglanti->query("SELECT id, username, adsoyad, rol FROM kisiler");
echo "<table border='1' style='border-collapse: collapse;'>";
echo "<tr><th>ID</th><th>Kullanıcı Adı</th><th>Ad Soyad</th><th>Rol</th></tr>";
while ($kullanici = $kullanicilar->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $kullanici['id'] . "</td>";
    echo "<td>" . htmlspecialchars($kullanici['username']) . "</td>";
    echo "<td>" . htmlspecialchars($kullanici['adsoyad']) . "</td>";
    echo "<td>" . htmlspecialchars($kullanici['rol']) . "</td>";
    echo "</tr>";
}
echo "</table>";

$baglanti->close();
?> 