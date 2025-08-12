<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "basit_sistem";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<h2>🔄 Tablo Adı Değiştirme İşlemi</h2>";
    
    // Önce mevcut tabloyu kontrol et
    $check_table = $conn->query("SHOW TABLES LIKE 'yoresel_yemekler'");
    if ($check_table->rowCount() > 0) {
        echo "✅ yoresel_yemekler tablosu bulundu<br>";
        
        // Tablo adını değiştir
        $sql = "RENAME TABLE yoresel_yemekler TO yemekler";
        $conn->exec($sql);
        echo "✅ Tablo adı başarıyla 'yemekler' olarak değiştirildi!<br><br>";
        
        // Yeni tablo adını kontrol et
        $check_new_table = $conn->query("SHOW TABLES LIKE 'yemekler'");
        if ($check_new_table->rowCount() > 0) {
            echo "✅ yemekler tablosu başarıyla oluşturuldu<br>";
            
            // Tablo yapısını göster
            echo "<h3>📋 Yeni Tablo Yapısı:</h3>";
            $result = $conn->query("DESCRIBE yemekler");
            echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
            echo "<tr><th>Alan</th><th>Tip</th><th>Null</th><th>Key</th><th>Default</th></tr>";
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['Field'] . "</td>";
                echo "<td>" . $row['Type'] . "</td>";
                echo "<td>" . $row['Null'] . "</td>";
                echo "<td>" . $row['Key'] . "</td>";
                echo "<td>" . $row['Default'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            
            // Verileri göster
            echo "<br><h3>🍽️ Tablodaki Yemekler:</h3>";
            $result = $conn->query("SELECT id, ad, bolge, sure, zorluk, porsiyon FROM yemekler ORDER BY id DESC");
            echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
            echo "<tr><th>ID</th><th>Yemek Adı</th><th>Bölge</th><th>Süre</th><th>Zorluk</th><th>Porsiyon</th></tr>";
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['ad'] . "</td>";
                echo "<td>" . $row['bolge'] . "</td>";
                echo "<td>" . $row['sure'] . "</td>";
                echo "<td>" . $row['zorluk'] . "</td>";
                echo "<td>" . $row['porsiyon'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            
            echo "<br><h3>⚠️ Önemli Not:</h3>";
            echo "<p>API dosyasındaki endpoint'i de güncellemeniz gerekiyor:</p>";
            echo "<ul>";
            echo "<li>api.php dosyasında 'yoresel_yemekler' yerine 'yemekler' kullanın</li>";
            echo "<li>Frontend dosyalarında API endpoint'ini güncelleyin</li>";
            echo "</ul>";
            
        } else {
            echo "❌ yemekler tablosu oluşturulamadı!<br>";
        }
        
    } else {
        echo "❌ yoresel_yemekler tablosu bulunamadı!<br>";
        echo "Tablo zaten 'yemekler' adında olabilir veya hiç oluşturulmamış olabilir.<br>";
        
        // yemekler tablosunu kontrol et
        $check_yemekler = $conn->query("SHOW TABLES LIKE 'yemekler'");
        if ($check_yemekler->rowCount() > 0) {
            echo "✅ yemekler tablosu zaten mevcut!<br>";
        } else {
            echo "❌ Hiçbir yemek tablosu bulunamadı!<br>";
        }
    }
    
} catch(PDOException $e) {
    echo "❌ Hata: " . $e->getMessage();
}

$conn = null;
?>
