<?php
// Veritabanı bağlantısı
$baglanti = new mysqli("localhost", "root", "", "basit_sistem");

if ($baglanti->connect_error) {
    die("Veritabanı bağlantı hatası: " . $baglanti->connect_error);
}

echo "<h2>📋 iletisim_formu Tablosu Kontrolü</h2>";

// Tablo varlığını kontrol et
$tablo_kontrol = $baglanti->query("SHOW TABLES LIKE 'iletisim_formu'");
if ($tablo_kontrol->num_rows == 0) {
    echo "<p style='color: red;'>❌ iletisim_formu tablosu bulunamadı!</p>";
    exit;
}

echo "<p style='color: green;'>✅ iletisim_formu tablosu bulundu</p>";

// Tablo yapısını göster
echo "<h3>📊 Tablo Yapısı:</h3>";
$sutunlar = $baglanti->query("SHOW COLUMNS FROM iletisim_formu");
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
$veriler = $baglanti->query("SELECT * FROM iletisim_formu ORDER BY id DESC");
if ($veriler->num_rows == 0) {
    echo "<p style='color: orange;'>⚠️ Tabloda hiç veri yok!</p>";
} else {
    echo "<table border='1' style='border-collapse: collapse;'>";
    echo "<tr><th>ID</th><th>Ad Soyad</th><th>E-posta</th><th>Mesaj</th><th>Konu</th></tr>";
    while ($satir = $veriler->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $satir['id'] . "</td>";
        echo "<td>" . htmlspecialchars($satir['adisoyadi']) . "</td>";
        echo "<td>" . htmlspecialchars($satir['eposta']) . "</td>";
        echo "<td>" . htmlspecialchars(substr($satir['mesaj'], 0, 50)) . "...</td>";
        echo "<td>" . htmlspecialchars($satir['konu']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<p style='color: green;'>✅ Toplam " . $veriler->num_rows . " kayıt bulundu</p>";
}

$baglanti->close();
?> 