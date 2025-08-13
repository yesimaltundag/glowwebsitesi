<?php
// WampServer için Sağlıklı Besinler tablosu kurulum scripti
echo "<h2>🚀 Sağlıklı Besinler Tablosu Kurulumu - WampServer</h2>";

// Veritabanı bağlantı ayarları
$servername = "localhost";
$username = "root";
$password = "";

try {
    // Ana veritabanına bağlan
    $pdo = new PDO("mysql:host=$servername;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✅ WampServer bağlantısı başarılı!<br>";
    
         // basit_sistem veritabanına bağlan
     $pdo = new PDO("mysql:host=$servername;dbname=basit_sistem;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
         echo "✅ 'basit_sistem' veritabanına bağlantı başarılı!<br><br>";
    
    // Sağlıklı besinler tablosu oluştur
    $sql = "CREATE TABLE IF NOT EXISTS saglikli_besinler (
        id INT AUTO_INCREMENT PRIMARY KEY,
        ad VARCHAR(255) NOT NULL,
        kategori VARCHAR(100) NOT NULL,
        aciklama TEXT,
        sure VARCHAR(50),
        zorluk VARCHAR(50),
        porsiyon VARCHAR(50),
        kalori VARCHAR(50),
        protein VARCHAR(50),
        karbonhidrat VARCHAR(50),
        yag VARCHAR(50),
        lif VARCHAR(50),
        resim VARCHAR(500),
        malzemeler TEXT,
        hazirlanis TEXT,
        puf_noktalari TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    
    $pdo->exec($sql);
    echo "✅ 'saglikli_besinler' tablosu oluşturuldu!<br>";
    
    // Örnek veriler ekle
    $ornek_veriler = [
        [
            'ad' => 'Quinoa Salatası',
            'kategori' => 'Salata',
            'aciklama' => 'Protein açısından zengin quinoa ile hazırlanmış besleyici salata',
            'sure' => '20 dk',
            'zorluk' => 'Kolay',
            'porsiyon' => '4 kişilik',
            'kalori' => '180 kcal',
            'protein' => '8g',
            'karbonhidrat' => '25g',
            'yag' => '6g',
            'lif' => '4g',
            'resim' => 'assets/images/quinoa-salata.jpg',
            'malzemeler' => '1 su bardağı quinoa, 1 adet salatalık, 1 adet domates, 1/2 adet kırmızı soğan, 1/4 demet maydanoz, 2 yemek kaşığı zeytinyağı, 1 adet limon, tuz, karabiber',
            'hazirlanis' => '1. Quinoa\'yı yıkayın ve süzün. 2. Tencereye alıp 2 su bardağı su ile haşlayın. 3. Sebzeleri doğrayın. 4. Tüm malzemeleri karıştırın. 5. Zeytinyağı ve limon suyu ekleyin.',
            'puf_noktalari' => 'Quinoa\'yı önceden yıkayarak acı tadını alabilirsiniz. Salatayı buzdolabında 2-3 gün saklayabilirsiniz.'
        ],
        [
            'ad' => 'Avokado Smoothie',
            'kategori' => 'İçecek',
            'aciklama' => 'Sağlıklı yağlar ve protein içeren besleyici smoothie',
            'sure' => '5 dk',
            'zorluk' => 'Çok Kolay',
            'porsiyon' => '2 kişilik',
            'kalori' => '220 kcal',
            'protein' => '12g',
            'karbonhidrat' => '15g',
            'yag' => '18g',
            'lif' => '8g',
            'resim' => 'assets/images/avokado-smoothie.jpg',
            'malzemeler' => '1 adet olgun avokado, 1 adet muz, 1 su bardağı süt, 1 yemek kaşığı bal, 1/2 çay kaşığı vanilya',
            'hazirlanis' => '1. Avokado ve muzu soyun. 2. Tüm malzemeleri blender\'a koyun. 3. Pürüzsüz olana kadar çırpın. 4. Soğuk servis yapın.',
            'puf_noktalari' => 'Avokado\'nun olgun olması önemli. Muzu dondurucuda saklayarak daha soğuk bir smoothie elde edebilirsiniz.'
        ],
        [
            'ad' => 'Mercimek Çorbası',
            'kategori' => 'Çorba',
            'aciklama' => 'Demir ve protein açısından zengin besleyici çorba',
            'sure' => '45 dk',
            'zorluk' => 'Orta',
            'porsiyon' => '6 kişilik',
            'kalori' => '160 kcal',
            'protein' => '10g',
            'karbonhidrat' => '28g',
            'yag' => '2g',
            'lif' => '12g',
            'resim' => 'assets/images/mercimek-corbasi.jpg',
            'malzemeler' => '1 su bardağı kırmızı mercimek, 1 adet soğan, 1 adet havuç, 2 diş sarımsak, 1 yemek kaşığı zeytinyağı, 6 su bardağı su, tuz, karabiber, pul biber',
            'hazirlanis' => '1. Soğan ve havuçları doğrayın. 2. Zeytinyağında kavurun. 3. Mercimek ve suyu ekleyin. 4. Yumuşayana kadar pişirin. 5. Blender\'dan geçirin.',
            'puf_noktalari' => 'Mercimeği önceden yıkayın. Çorbayı daha kıvamlı yapmak için patates ekleyebilirsiniz.'
        ],
        [
            'ad' => 'Fırında Somon',
            'kategori' => 'Ana Yemek',
            'aciklama' => 'Omega-3 açısından zengin sağlıklı balık yemeği',
            'sure' => '25 dk',
            'zorluk' => 'Orta',
            'porsiyon' => '2 kişilik',
            'kalori' => '280 kcal',
            'protein' => '35g',
            'karbonhidrat' => '5g',
            'yag' => '15g',
            'lif' => '2g',
            'resim' => 'assets/images/firinda-somon.jpg',
            'malzemeler' => '2 adet somon filetosu, 2 adet limon, 2 yemek kaşığı zeytinyağı, 2 diş sarımsak, tuz, karabiber, kekik',
            'hazirlanis' => '1. Fırını 200°C\'ye ısıtın. 2. Somonları yağlayın ve baharatlayın. 3. Limon dilimleri ekleyin. 4. 20-25 dakika pişirin.',
            'puf_noktalari' => 'Somonu fazla pişirmeyin, nemli kalması önemli. Limon suyu ile marine edebilirsiniz.'
        ],
        [
            'ad' => 'Chia Pudding',
            'kategori' => 'Tatlı',
            'aciklama' => 'Omega-3 ve lif açısından zengin sağlıklı tatlı',
            'sure' => '10 dk + 4 saat',
            'zorluk' => 'Kolay',
            'porsiyon' => '2 kişilik',
            'kalori' => '180 kcal',
            'protein' => '6g',
            'karbonhidrat' => '20g',
            'yag' => '10g',
            'lif' => '12g',
            'resim' => 'assets/images/chia-pudding.jpg',
            'malzemeler' => '1/4 su bardağı chia tohumu, 1 su bardağı süt, 1 yemek kaşığı bal, 1/2 çay kaşığı vanilya, mevsim meyveleri',
            'hazirlanis' => '1. Tüm malzemeleri karıştırın. 2. 4 saat buzdolabında bekletin. 3. Üzerine meyve ekleyerek servis yapın.',
            'puf_noktalari' => 'Gece boyunca bekletirseniz daha kıvamlı olur. Badem sütü kullanarak vegan yapabilirsiniz.'
        ]
    ];
    
    // Verileri ekle
    $insert_sql = "INSERT INTO saglikli_besinler (ad, kategori, aciklama, sure, zorluk, porsiyon, kalori, protein, karbonhidrat, yag, lif, resim, malzemeler, hazirlanis, puf_noktalari) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($insert_sql);
    
    $eklenen = 0;
    foreach ($ornek_veriler as $veri) {
        try {
            $stmt->execute([
                $veri['ad'],
                $veri['kategori'],
                $veri['aciklama'],
                $veri['sure'],
                $veri['zorluk'],
                $veri['porsiyon'],
                $veri['kalori'],
                $veri['protein'],
                $veri['karbonhidrat'],
                $veri['yag'],
                $veri['lif'],
                $veri['resim'],
                $veri['malzemeler'],
                $veri['hazirlanis'],
                $veri['puf_noktalari']
            ]);
            $eklenen++;
            echo "✅ " . $veri['ad'] . " eklendi<br>";
        } catch(PDOException $e) {
            if ($e->getCode() == 23000) { // Duplicate entry
                echo "⚠️ " . $veri['ad'] . " zaten mevcut<br>";
            } else {
                echo "❌ " . $veri['ad'] . " eklenirken hata: " . $e->getMessage() . "<br>";
            }
        }
    }
    
    echo "<br>📊 Toplam " . $eklenen . " adet sağlıklı besin eklendi.<br>";
    
    // Tablo yapısını göster
    echo "<br><h3>📋 Tablo Yapısı:</h3>";
    $columns_sql = "DESCRIBE saglikli_besinler";
    $columns_stmt = $pdo->query($columns_sql);
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr><th>Sütun</th><th>Tip</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
    while ($row = $columns_stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['Field'] . "</td>";
        echo "<td>" . $row['Type'] . "</td>";
        echo "<td>" . $row['Null'] . "</td>";
        echo "<td>" . $row['Key'] . "</td>";
        echo "<td>" . $row['Default'] . "</td>";
        echo "<td>" . $row['Extra'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    // Eklenen verileri göster
    echo "<br><h3>🥗 Eklenen Sağlıklı Besinler:</h3>";
    $select_sql = "SELECT id, ad, kategori, sure, zorluk, kalori FROM saglikli_besinler ORDER BY id";
    $select_stmt = $pdo->query($select_sql);
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr><th>ID</th><th>Ad</th><th>Kategori</th><th>Süre</th><th>Zorluk</th><th>Kalori</th></tr>";
    while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['ad'] . "</td>";
        echo "<td>" . $row['kategori'] . "</td>";
        echo "<td>" . $row['sure'] . "</td>";
        echo "<td>" . $row['zorluk'] . "</td>";
        echo "<td>" . $row['kalori'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
} catch(PDOException $e) {
    echo "❌ Hata: " . $e->getMessage();
}

echo "<br><br>🎉 Sağlıklı besinler tablosu kurulumu tamamlandı!";
echo "<br><br>📝 <strong>Sonraki Adımlar:</strong>";
echo "<br>1. WampServer'ı başlatın";
echo "<br>2. Tarayıcıda http://app.test2.local/saglikli-besinler.html adresini açın";
echo "<br>3. Sağlıklı besinler sayfasının çalıştığını kontrol edin";
?>
