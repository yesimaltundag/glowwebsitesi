<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "basit_sistem";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Dünya mutfağı tablosunu oluştur
    $sql = "CREATE TABLE IF NOT EXISTS dunya_mutfagi (
        id INT AUTO_INCREMENT PRIMARY KEY,
        ad VARCHAR(255) NOT NULL,
        ulke VARCHAR(255) NOT NULL,
        malzemeler TEXT NOT NULL,
        hazirlanis TEXT NOT NULL,
        sure VARCHAR(100) NOT NULL,
        zorluk ENUM('Kolay', 'Orta', 'Zor') DEFAULT 'Orta',
        porsiyon VARCHAR(50) NOT NULL,
        kalori VARCHAR(50),
        resim VARCHAR(500) NOT NULL,
        aciklama TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
    $conn->exec($sql);
    echo "✅ Dünya mutfağı tablosu başarıyla oluşturuldu!<br><br>";
    
    // Örnek verileri ekle
    $yemekler = [
        [
            'ad' => 'Pizza Margherita',
            'ulke' => 'İtalya',
            'malzemeler' => 'Un, maya, domates sosu, mozzarella peyniri, fesleğen, zeytinyağı, tuz',
            'hazirlanis' => 'Hamur yoğrulur ve mayalandırılır, ince açılır, domates sosu ve mozzarella ile kaplanır, fırında pişirilir.',
            'sure' => '60 dakika',
            'zorluk' => 'Orta',
            'porsiyon' => '4 kişilik',
            'kalori' => '285 kcal',
            'resim' => 'assets/images/yemekler/pizza-margherita.jpg',
            'aciklama' => 'İtalya\'nın geleneksel pizzası, taze mozzarella ve fesleğen ile.'
        ],
        [
            'ad' => 'Sushi Nigiri',
            'ulke' => 'Japonya',
            'malzemeler' => 'Sushi pirinci, somon, nori, wasabi, soya sosu, zencefil turşusu',
            'hazirlanis' => 'Pirinç pişirilir ve sirke ile karıştırılır, somon dilimleri ile şekillendirilir.',
            'sure' => '45 dakika',
            'zorluk' => 'Zor',
            'porsiyon' => '6 adet',
            'kalori' => '180 kcal',
            'resim' => 'assets/images/yemekler/sushi-nigiri.jpg',
            'aciklama' => 'Japon mutfağının en popüler yemeği, taze somon ile hazırlanır.'
        ],
        [
            'ad' => 'Paella',
            'ulke' => 'İspanya',
            'malzemeler' => 'Bomba pirinci, karides, midye, safran, domates, soğan, sarımsak, zeytinyağı',
            'hazirlanis' => 'Safranlı su hazırlanır, pirinç ve deniz ürünleri ile paella tavasında pişirilir.',
            'sure' => '75 dakika',
            'zorluk' => 'Zor',
            'porsiyon' => '6 kişilik',
            'kalori' => '420 kcal',
            'resim' => 'assets/images/yemekler/paella.jpg',
            'aciklama' => 'Valencia\'nın meşhur paellası, safran ve deniz ürünleri ile.'
        ],
        [
            'ad' => 'Pad Thai',
            'ulke' => 'Tayland',
            'malzemeler' => 'Pirinç eriştesi, karides, tofu, yumurta, soya filizi, yer fıstığı, limon, balık sosu',
            'hazirlanis' => 'Erişte haşlanır, wok tavasında karides ve tofu ile sote edilir, yumurta eklenir.',
            'sure' => '30 dakika',
            'zorluk' => 'Orta',
            'porsiyon' => '4 kişilik',
            'kalori' => '380 kcal',
            'resim' => 'assets/images/yemekler/pad-thai.jpg',
            'aciklama' => 'Tayland\'ın ulusal yemeği, ekşi-tatlı sos ile hazırlanır.'
        ],
        [
            'ad' => 'Hamburger',
            'ulke' => 'Amerika',
            'malzemeler' => 'Dana kıyma, hamburger ekmeği, marul, domates, soğan, peynir, ketçap, mayonez',
            'hazirlanis' => 'Kıyma köfte haline getirilir, ızgarada pişirilir, ekmek arası sebzelerle servis edilir.',
            'sure' => '25 dakika',
            'zorluk' => 'Kolay',
            'porsiyon' => '4 adet',
            'kalori' => '550 kcal',
            'resim' => 'assets/images/yemekler/hamburger.jpg',
            'aciklama' => 'Amerikan fast food kültürünün simgesi, özel soslarla.'
        ],
        [
            'ad' => 'Ratatouille',
            'ulke' => 'Fransa',
            'malzemeler' => 'Patlıcan, kabak, domates, biber, soğan, sarımsak, zeytinyağı, kekik, fesleğen',
            'hazirlanis' => 'Sebzeler dilimlenir, katmanlar halinde dizilir ve fırında yavaşça pişirilir.',
            'sure' => '90 dakika',
            'zorluk' => 'Orta',
            'porsiyon' => '6 kişilik',
            'kalori' => '180 kcal',
            'resim' => 'assets/images/yemekler/ratatouille.jpg',
            'aciklama' => 'Provence bölgesinin geleneksel sebze yemeği, zeytinyağı ile.'
        ],
        [
            'ad' => 'Tacos',
            'ulke' => 'Meksika',
            'malzemeler' => 'Mısır tortilla, dana eti, soğan, domates, marul, peynir, salsa, ekşi krema',
            'hazirlanis' => 'Et baharatlarla pişirilir, tortilla üzerine konur, sebzeler ve soslarla servis edilir.',
            'sure' => '40 dakika',
            'zorluk' => 'Kolay',
            'porsiyon' => '8 adet',
            'kalori' => '320 kcal',
            'resim' => 'assets/images/yemekler/tacos.jpg',
            'aciklama' => 'Meksika\'nın geleneksel yemeği, baharatlı et ve taze sebzelerle.'
        ],
        [
            'ad' => 'Köfte',
            'ulke' => 'Türkiye',
            'malzemeler' => 'Dana kıyma, soğan, ekmek içi, yumurta, maydanoz, baharatlar, zeytinyağı',
            'hazirlanis' => 'Kıyma ve malzemeler yoğrulur, köfte şekli verilir, ızgarada pişirilir.',
            'sure' => '35 dakika',
            'zorluk' => 'Kolay',
            'porsiyon' => '6 kişilik',
            'kalori' => '280 kcal',
            'resim' => 'assets/images/yemekler/kofte.jpg',
            'aciklama' => 'Türk mutfağının vazgeçilmezi, özel baharatlarla hazırlanır.'
        ]
    ];
    
    // Verileri ekle
    $stmt = $conn->prepare("INSERT INTO dunya_mutfagi (ad, ulke, malzemeler, hazirlanis, sure, zorluk, porsiyon, kalori, resim, aciklama) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $eklenen = 0;
    foreach ($yemekler as $yemek) {
        try {
            $stmt->execute([
                $yemek['ad'],
                $yemek['ulke'],
                $yemek['malzemeler'],
                $yemek['hazirlanis'],
                $yemek['sure'],
                $yemek['zorluk'],
                $yemek['porsiyon'],
                $yemek['kalori'],
                $yemek['resim'],
                $yemek['aciklama']
            ]);
            $eklenen++;
            echo "✅ " . $yemek['ad'] . " (" . $yemek['ulke'] . ") eklendi<br>";
        } catch(PDOException $e) {
            if ($e->getCode() == 23000) { // Duplicate entry
                echo "⚠️ " . $yemek['ad'] . " zaten mevcut<br>";
            } else {
                echo "❌ " . $yemek['ad'] . " eklenirken hata: " . $e->getMessage() . "<br>";
            }
        }
    }
    
    echo "<br>📊 Toplam " . $eklenen . " dünya mutfağı yemeği eklendi<br><br>";
    
    // Tablo yapısını göster
    echo "<h3>📋 Tablo Yapısı:</h3>";
    $result = $conn->query("DESCRIBE dunya_mutfagi");
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
    
    // Eklenen verileri göster
    echo "<br><h3>🌍 Eklenen Dünya Mutfağı Yemekleri:</h3>";
    $result = $conn->query("SELECT id, ad, ulke, sure, zorluk, porsiyon FROM dunya_mutfagi ORDER BY id DESC");
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr><th>ID</th><th>Yemek Adı</th><th>Ülke</th><th>Süre</th><th>Zorluk</th><th>Porsiyon</th></tr>";
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['ad'] . "</td>";
        echo "<td>" . $row['ulke'] . "</td>";
        echo "<td>" . $row['sure'] . "</td>";
        echo "<td>" . $row['zorluk'] . "</td>";
        echo "<td>" . $row['porsiyon'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
} catch(PDOException $e) {
    echo "❌ Hata: " . $e->getMessage();
}

$conn = null;
?>
