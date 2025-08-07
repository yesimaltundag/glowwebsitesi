<?php
// Veritabanı bağlantısı
$baglanti = new mysqli("localhost", "root", "", "basit_sistem");

if ($baglanti->connect_error) {
    die("Veritabanı bağlantı hatası: " . $baglanti->connect_error);
}

echo "<h2>📋 iletisim_formu Tablosu Oluşturma</h2>";

// Tablo var mı kontrol et
$table_check = $baglanti->query("SHOW TABLES LIKE 'iletisim_formu'");

if ($table_check->num_rows > 0) {
    echo "<p style='color: orange;'>⚠️ iletisim_formu tablosu zaten mevcut</p>";
    
    // Mevcut sütunları kontrol et
    $columns_check = $baglanti->query("SHOW COLUMNS FROM iletisim_formu LIKE 'created_at'");
    
    if ($columns_check->num_rows == 0) {
        echo "<p style='color: blue;'>📅 created_at sütunu ekleniyor...</p>";
        
        $alter_sql = "ALTER TABLE iletisim_formu ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP";
        
        if ($baglanti->query($alter_sql)) {
            echo "<p style='color: green;'>✅ created_at sütunu başarıyla eklendi</p>";
        } else {
            echo "<p style='color: red;'>❌ created_at sütunu eklenemedi: " . $baglanti->error . "</p>";
        }
    } else {
        echo "<p style='color: green;'>✅ created_at sütunu zaten mevcut</p>";
    }
    
    // Mevcut sütunları göster
    $columns = $baglanti->query("SHOW COLUMNS FROM iletisim_formu");
    echo "<h3>📊 Mevcut Sütunlar:</h3>";
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr><th>Sütun Adı</th><th>Tip</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
    
    while ($column = $columns->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $column['Field'] . "</td>";
        echo "<td>" . $column['Type'] . "</td>";
        echo "<td>" . $column['Null'] . "</td>";
        echo "<td>" . $column['Key'] . "</td>";
        echo "<td>" . $column['Default'] . "</td>";
        echo "<td>" . $column['Extra'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
} else {
    echo "<p style='color: blue;'>📝 iletisim_formu tablosu oluşturuluyor...</p>";
    
    // Tablo oluştur
    $create_sql = "CREATE TABLE iletisim_formu (
        id INT AUTO_INCREMENT PRIMARY KEY,
        adisoyadi VARCHAR(100) NOT NULL,
        eposta VARCHAR(100) NOT NULL,
        konu VARCHAR(200) NOT NULL,
        mesaj TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        INDEX idx_created_at (created_at),
        INDEX idx_eposta (eposta)
    )";
    
    if ($baglanti->query($create_sql)) {
        echo "<p style='color: green;'>✅ iletisim_formu tablosu başarıyla oluşturuldu</p>";
        
        // Test verisi ekle
        $test_sql = "INSERT INTO iletisim_formu (adisoyadi, eposta, konu, mesaj) VALUES 
        ('Test Kullanıcı', 'test@example.com', 'Test Konusu', 'Bu bir test mesajıdır.'),
        ('Ahmet Yılmaz', 'ahmet@example.com', 'Genel Bilgi', 'Siteniz hakkında bilgi almak istiyorum.'),
        ('Fatma Demir', 'fatma@example.com', 'Teknik Destek', 'Bir sorun yaşıyorum, yardım edebilir misiniz?')";
        
        if ($baglanti->query($test_sql)) {
            echo "<p style='color: green;'>✅ Test verileri eklendi</p>";
        } else {
            echo "<p style='color: orange;'>⚠️ Test verileri eklenemedi: " . $baglanti->error . "</p>";
        }
        
    } else {
        echo "<p style='color: red;'>❌ Tablo oluşturulamadı: " . $baglanti->error . "</p>";
    }
}

// Mevcut verileri göster
echo "<h3>📋 Mevcut Mesajlar:</h3>";
$veriler = $baglanti->query("SELECT * FROM iletisim_formu ORDER BY created_at DESC");

if ($veriler && $veriler->num_rows > 0) {
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr><th>ID</th><th>Ad Soyad</th><th>E-posta</th><th>Konu</th><th>Mesaj</th><th>Gönderilme Tarihi</th></tr>";
    
    while ($mesaj = $veriler->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $mesaj['id'] . "</td>";
        echo "<td>" . htmlspecialchars($mesaj['adisoyadi']) . "</td>";
        echo "<td>" . htmlspecialchars($mesaj['eposta']) . "</td>";
        echo "<td>" . htmlspecialchars($mesaj['konu']) . "</td>";
        echo "<td>" . htmlspecialchars(substr($mesaj['mesaj'], 0, 50)) . "...</td>";
        echo "<td>" . $mesaj['created_at'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p style='color: orange;'>⚠️ Henüz mesaj yok</p>";
}

$baglanti->close();
?> 