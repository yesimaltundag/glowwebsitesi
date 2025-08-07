<?php
echo "<h2>💬 Mesaj Cevapları Tablosu Oluşturma</h2>";

// Veritabanı bağlantısı
$baglanti = new mysqli("localhost", "root", "", "basit_sistem");

if ($baglanti->connect_error) {
    echo "<p style='color: red;'>❌ Veritabanı bağlantı hatası: " . $baglanti->connect_error . "</p>";
    exit;
}

echo "<p style='color: green;'>✅ Veritabanı bağlantısı başarılı</p>";

// mesaj_cevaplari tablosunu kontrol et
$cevap_tablo = $baglanti->query("SHOW TABLES LIKE 'mesaj_cevaplari'");
if ($cevap_tablo->num_rows > 0) {
    echo "<p style='color: orange;'>⚠️ mesaj_cevaplari tablosu zaten mevcut!</p>";
} else {
    // Tabloyu oluştur
    $sql = "CREATE TABLE mesaj_cevaplari (
        id INT AUTO_INCREMENT PRIMARY KEY,
        iletisim_formu_id INT NOT NULL,
        cevap_id INT NOT NULL,
        cevap_mesaji TEXT NOT NULL,
        cevap_veren_yonetici_user_id INT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (iletisim_formu_id) REFERENCES iletisim_formu(id) ON DELETE CASCADE,
        FOREIGN KEY (cevap_veren_yonetici_user_id) REFERENCES kisiler(id) ON DELETE CASCADE,
        INDEX idx_iletisim_formu_id (iletisim_formu_id),
        INDEX idx_cevap_veren_user_id (cevap_veren_yonetici_user_id)
    )";
    
    if ($baglanti->query($sql) === TRUE) {
        echo "<p style='color: green;'>✅ mesaj_cevaplari tablosu başarıyla oluşturuldu!</p>";
        
        // Test verisi ekle (eğer iletisim_formu tablosunda veri varsa)
        $iletisim_kontrol = $baglanti->query("SELECT id FROM iletisim_formu LIMIT 1");
        $yonetici_kontrol = $baglanti->query("SELECT id FROM kisiler WHERE rol = 'admin' LIMIT 1");
        
        if ($iletisim_kontrol->num_rows > 0 && $yonetici_kontrol->num_rows > 0) {
            $iletisim_id = $iletisim_kontrol->fetch_assoc()['id'];
            $yonetici_id = $yonetici_kontrol->fetch_assoc()['id'];
            
            $test_sql = "INSERT INTO mesaj_cevaplari (iletisim_formu_id, cevap_id, cevap_mesaji, cevap_veren_yonetici_user_id) VALUES 
            ($iletisim_id, 1, 'Bu mesajınız için teşekkür ederiz. En kısa sürede size dönüş yapacağız.'),
            ($iletisim_id, 2, 'Mesajınız alınmıştır. Gerekli işlemler başlatılmıştır.')";
            
            if ($baglanti->query($test_sql) === TRUE) {
                echo "<p style='color: green;'>✅ Test cevapları başarıyla eklendi!</p>";
            } else {
                echo "<p style='color: red;'>❌ Test cevapları eklenirken hata: " . $baglanti->error . "</p>";
            }
        } else {
            echo "<p style='color: orange;'>⚠️ Test verisi eklenemedi - iletisim_formu veya admin kullanıcısı bulunamadı</p>";
        }
        
    } else {
        echo "<p style='color: red;'>❌ Tablo oluşturulurken hata: " . $baglanti->error . "</p>";
    }
}

// Tabloyu kontrol et
$kontrol = $baglanti->query("SHOW TABLES LIKE 'mesaj_cevaplari'");
if ($kontrol->num_rows > 0) {
    echo "<h3>📊 Tablo Kontrolü:</h3>";
    
    // Tablo yapısını göster
    $sutunlar = $baglanti->query("SHOW COLUMNS FROM mesaj_cevaplari");
    echo "<h4>📋 Tablo Yapısı:</h4>";
    echo "<table border='1' style='border-collapse: collapse; margin: 10px 0;'>";
    echo "<tr><th>Sütun</th><th>Tip</th><th>Null</th><th>Key</th><th>Default</th></tr>";
    while ($sutun = $sutunlar->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $sutun['Field'] . "</td>";
        echo "<td>" . $sutun['Type'] . "</td>";
        echo "<td>" . $sutun['Null'] . "</td>";
        echo "<td>" . $sutun['Key'] . "</td>";
        echo "<td>" . $sutun['Default'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    // Veri sayısını kontrol et
    $veri_sayisi = $baglanti->query("SELECT COUNT(*) as toplam FROM mesaj_cevaplari");
    $sayi = $veri_sayisi->fetch_assoc();
    echo "<p><strong>Toplam cevap sayısı:</strong> " . $sayi['toplam'] . "</p>";
    
    // Cevapları göster
    $cevaplar = $baglanti->query("SELECT mc.*, k.adsoyad as yonetici_adi, if.adisoyadi as mesaj_gonderen 
                                  FROM mesaj_cevaplari mc 
                                  LEFT JOIN kisiler k ON mc.cevap_veren_yonetici_user_id = k.id 
                                  LEFT JOIN iletisim_formu if ON mc.iletisim_formu_id = if.id 
                                  ORDER BY mc.id DESC");
    if ($cevaplar->num_rows > 0) {
        echo "<h4>💬 Mevcut Cevaplar:</h4>";
        echo "<table border='1' style='border-collapse: collapse; margin: 10px 0;'>";
        echo "<tr><th>ID</th><th>İletişim ID</th><th>Cevap ID</th><th>Cevap Mesajı</th><th>Yönetici</th><th>Mesaj Gönderen</th><th>Tarih</th></tr>";
        while ($cevap = $cevaplar->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $cevap['id'] . "</td>";
            echo "<td>" . $cevap['iletisim_formu_id'] . "</td>";
            echo "<td>" . $cevap['cevap_id'] . "</td>";
            echo "<td>" . htmlspecialchars(substr($cevap['cevap_mesaji'], 0, 50)) . "...</td>";
            echo "<td>" . htmlspecialchars($cevap['yonetici_adi']) . "</td>";
            echo "<td>" . htmlspecialchars($cevap['mesaj_gonderen']) . "</td>";
            echo "<td>" . $cevap['created_at'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}

echo "<h3>🔗 Test Linkleri:</h3>";
echo "<p><a href='mesaj_cevap_api.php' target='_blank'>💬 Mesaj Cevap API Testi</a></p>";
echo "<p><a href='mesaj-yonetimi.php' target='_blank'>📋 Mesaj Yönetimi Sayfası</a></p>";

$baglanti->close();
?> 