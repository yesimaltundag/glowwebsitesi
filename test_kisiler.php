<?php
// Veritabanı bağlantısı
$baglanti = new mysqli("localhost", "root", "", "basit_sistem");

if ($baglanti->connect_error) {
    die("Veritabanı bağlantı hatası: " . $baglanti->connect_error);
}

echo "<h2>📋 Kisiler Tablosu Kontrolü</h2>";

// Tablo varlığını kontrol et
$tablo_kontrol = $baglanti->query("SHOW TABLES LIKE 'kisiler'");
if ($tablo_kontrol->num_rows == 0) {
    echo "<p style='color: red;'>❌ kisiler tablosu bulunamadı!</p>";
    exit;
}

echo "<p style='color: green;'>✅ kisiler tablosu bulundu</p>";

// Tablo yapısını göster
echo "<h3>📊 Tablo Yapısı:</h3>";
$sutunlar = $baglanti->query("SHOW COLUMNS FROM kisiler");
echo "<table border='1' style='border-collapse: collapse;'>";
echo "<tr><th>Sütun Adı</th><th>Tip</th><th>Null</th><th>Key</th><th>Default</th></tr>";
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

// Verileri göster
echo "<h3>📝 Tablo Verileri:</h3>";
$veriler = $baglanti->query("SELECT id, username, adsoyad, e_posta, rol FROM kisiler ORDER BY id ASC");
if ($veriler->num_rows == 0) {
    echo "<p style='color: orange;'>⚠️ Tabloda hiç kullanıcı yok!</p>";
} else {
    echo "<table border='1' style='border-collapse: collapse;'>";
    echo "<tr><th>ID</th><th>Kullanıcı Adı</th><th>Ad Soyad</th><th>E-posta</th><th>Rol</th></tr>";
    while ($satir = $veriler->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $satir['id'] . "</td>";
        echo "<td>" . htmlspecialchars($satir['username']) . "</td>";
        echo "<td>" . htmlspecialchars($satir['adsoyad']) . "</td>";
        echo "<td>" . htmlspecialchars($satir['e_posta']) . "</td>";
        echo "<td>" . htmlspecialchars($satir['rol']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<p style='color: green;'>✅ Toplam " . $veriler->num_rows . " kullanıcı bulundu</p>";
}

// API endpoint testi
echo "<h3>🔗 API Endpoint Testi:</h3>";
echo "<p><a href='api.php?kisiler=1' target='_blank'>api.php?kisiler=1</a></p>";

$baglanti->close();
?> 