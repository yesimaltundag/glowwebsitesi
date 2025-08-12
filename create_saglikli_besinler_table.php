<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "basit_sistem";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Sağlıklı besinler tablosunu oluştur
    $sql = "CREATE TABLE IF NOT EXISTS saglikli_besinler (
        id INT AUTO_INCREMENT PRIMARY KEY,
        ad VARCHAR(255) NOT NULL,
        kategori VARCHAR(255) NOT NULL,
        malzemeler TEXT NOT NULL,
        hazirlanis TEXT NOT NULL,
        sure VARCHAR(100) NOT NULL,
        zorluk ENUM('Kolay', 'Orta', 'Zor') DEFAULT 'Kolay',
        porsiyon VARCHAR(50) NOT NULL,
        kalori VARCHAR(50),
        protein VARCHAR(50),
        karbonhidrat VARCHAR(50),
        yag VARCHAR(50),
        lif VARCHAR(50),
        resim VARCHAR(500) NOT NULL,
        aciklama TEXT NOT NULL,
        faydalar TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
    $conn->exec($sql);
    echo "✅ Sağlıklı besinler tablosu başarıyla oluşturuldu!<br><br>";
    
    // Örnek verileri ekle
    $besinler = [
        [
            'ad' => 'Quinoa Salatası',
            'kategori' => 'Salata',
            'malzemeler' => 'Quinoa, domates, salatalık, avokado, zeytin, limon, zeytinyağı, tuz, karabiber',
            'hazirlanis' => 'Quinoa haşlanır, sebzeler doğranır. Limon ve zeytinyağı ile sos hazırlanır, karıştırılır.',
            'sure' => '20 dakika',
            'zorluk' => 'Kolay',
            'porsiyon' => '4 kişilik',
            'kalori' => '180 kcal',
            'protein' => '8g',
            'karbonhidrat' => '25g',
            'yag' => '6g',
            'lif' => '4g',
            'resim' => 'assets/images/yemekler/quinoa-salatasi.jpg',
            'aciklama' => 'Protein açısından zengin quinoa ile hazırlanmış sağlıklı salata.',
            'faydalar' => 'Yüksek protein, lif açısından zengin, gluten içermez, antioksidan kaynağı.'
        ],
        [
            'ad' => 'Smoothie Bowl',
            'kategori' => 'Kahvaltı',
            'malzemeler' => 'Muz, çilek, süt, yoğurt, bal, granola, badem, hindistan cevizi',
            'hazirlanis' => 'Meyveler ve süt blenderdan geçirilir, üzerine granola ve meyveler dizilir.',
            'sure' => '10 dakika',
            'zorluk' => 'Kolay',
            'porsiyon' => '2 kişilik',
            'kalori' => '220 kcal',
            'protein' => '12g',
            'karbonhidrat' => '35g',
            'yag' => '8g',
            'lif' => '6g',
            'resim' => 'assets/images/yemekler/smoothie-bowl.jpg',
            'aciklama' => 'Renkli ve besleyici smoothie bowl, kahvaltıların sağlıklı alternatifi.',
            'faydalar' => 'Vitamin ve mineral deposu, antioksidan açısından zengin, enerji verici.'
        ],
        [
            'ad' => 'Somon Izgara',
            'kategori' => 'Ana Yemek',
            'malzemeler' => 'Somon filetosu, limon, dereotu, zeytinyağı, tuz, karabiber, sarımsak',
            'hazirlanis' => 'Somon marine edilir, ızgarada pişirilir. Limon ve dereotu ile servis edilir.',
            'sure' => '25 dakika',
            'zorluk' => 'Orta',
            'porsiyon' => '2 kişilik',
            'kalori' => '280 kcal',
            'protein' => '35g',
            'karbonhidrat' => '2g',
            'yag' => '15g',
            'lif' => '1g',
            'resim' => 'assets/images/yemekler/somon-izgara.jpg',
            'aciklama' => 'Omega-3 açısından zengin somon balığı, sağlıklı protein kaynağı.',
            'faydalar' => 'Omega-3 yağ asitleri, yüksek protein, kalp sağlığı için faydalı.'
        ],
        [
            'ad' => 'Avokado Toast',
            'kategori' => 'Kahvaltı',
            'malzemeler' => 'Tam buğday ekmeği, avokado, yumurta, tuz, karabiber, kırmızı pul biber',
            'hazirlanis' => 'Ekmek kızartılır, avokado ezilir, yumurta pişirilir. Üzerine baharatlar eklenir.',
            'sure' => '15 dakika',
            'zorluk' => 'Kolay',
            'porsiyon' => '2 adet',
            'kalori' => '320 kcal',
            'protein' => '15g',
            'karbonhidrat' => '25g',
            'yag' => '18g',
            'lif' => '8g',
            'resim' => 'assets/images/yemekler/avokado-toast.jpg',
            'aciklama' => 'Sağlıklı yağlar içeren avokado ile hazırlanmış besleyici toast.',
            'faydalar' => 'Sağlıklı yağlar, lif açısından zengin, tok tutucu, vitamin deposu.'
        ],
        [
            'ad' => 'Mercimek Çorbası',
            'kategori' => 'Çorba',
            'malzemeler' => 'Kırmızı mercimek, soğan, havuç, sarımsak, zeytinyağı, tuz, karabiber, kimyon',
            'hazirlanis' => 'Soğan ve havuç doğranır, mercimek eklenir. Su ile pişirilir, blenderdan geçirilir.',
            'sure' => '30 dakika',
            'zorluk' => 'Kolay',
            'porsiyon' => '4 kişilik',
            'kalori' => '160 kcal',
            'protein' => '12g',
            'karbonhidrat' => '28g',
            'yag' => '4g',
            'lif' => '12g',
            'resim' => 'assets/images/yemekler/mercimek-corbasi.jpg',
            'aciklama' => 'Protein ve lif açısından zengin, besleyici mercimek çorbası.',
            'faydalar' => 'Yüksek protein, demir kaynağı, lif açısından zengin, tok tutucu.'
        ],
        [
            'ad' => 'Chia Pudding',
            'kategori' => 'Tatlı',
            'malzemeler' => 'Chia tohumu, süt, bal, vanilya, meyveler, badem',
            'hazirlanis' => 'Chia tohumu süt ile karıştırılır, gece bekletilir. Üzerine meyveler eklenir.',
            'sure' => '8 saat (gece)',
            'zorluk' => 'Kolay',
            'porsiyon' => '2 kişilik',
            'kalori' => '180 kcal',
            'protein' => '8g',
            'karbonhidrat' => '22g',
            'yag' => '10g',
            'lif' => '12g',
            'resim' => 'assets/images/yemekler/chia-pudding.jpg',
            'aciklama' => 'Omega-3 açısından zengin chia tohumu ile hazırlanmış sağlıklı tatlı.',
            'faydalar' => 'Omega-3 yağ asitleri, yüksek lif, antioksidan, tok tutucu.'
        ],
        [
            'ad' => 'Tavuk Göğsü Izgara',
            'kategori' => 'Ana Yemek',
            'malzemeler' => 'Tavuk göğsü, zeytinyağı, limon, sarımsak, kekik, tuz, karabiber',
            'hazirlanis' => 'Tavuk marine edilir, ızgarada pişirilir. Baharatlar eklenir.',
            'sure' => '20 dakika',
            'zorluk' => 'Kolay',
            'porsiyon' => '2 kişilik',
            'kalori' => '220 kcal',
            'protein' => '40g',
            'karbonhidrat' => '2g',
            'yag' => '6g',
            'lif' => '0g',
            'resim' => 'assets/images/yemekler/tavuk-izgara.jpg',
            'aciklama' => 'Yağsız protein kaynağı tavuk göğsü, diyet dostu ana yemek.',
            'faydalar' => 'Yüksek protein, düşük yağ, kas gelişimi için ideal, tok tutucu.'
        ],
        [
            'ad' => 'Yulaf Ezmesi',
            'kategori' => 'Kahvaltı',
            'malzemeler' => 'Yulaf ezmesi, süt, bal, tarçın, muz, badem, ceviz',
            'hazirlanis' => 'Yulaf süt ile pişirilir, bal ve tarçın eklenir. Üzerine meyve ve kuruyemiş konur.',
            'sure' => '15 dakika',
            'zorluk' => 'Kolay',
            'porsiyon' => '2 kişilik',
            'kalori' => '280 kcal',
            'protein' => '12g',
            'karbonhidrat' => '45g',
            'yag' => '10g',
            'lif' => '8g',
            'resim' => 'assets/images/yemekler/yulaf-ezmesi.jpg',
            'aciklama' => 'Lif açısından zengin yulaf ezmesi, sağlıklı kahvaltı seçeneği.',
            'faydalar' => 'Yüksek lif, beta-glukan, kolesterol düşürücü, tok tutucu.'
        ],
        [
            'ad' => 'Sebze Çorbası',
            'kategori' => 'Çorba',
            'malzemeler' => 'Brokoli, havuç, kabak, soğan, sarımsak, zeytinyağı, tuz, karabiber',
            'hazirlanis' => 'Sebzeler doğranır, su ile pişirilir. Blenderdan geçirilir, baharatlar eklenir.',
            'sure' => '25 dakika',
            'zorluk' => 'Kolay',
            'porsiyon' => '4 kişilik',
            'kalori' => '120 kcal',
            'protein' => '6g',
            'karbonhidrat' => '18g',
            'yag' => '4g',
            'lif' => '8g',
            'resim' => 'assets/images/yemekler/sebze-corbasi.jpg',
            'aciklama' => 'Vitamin ve mineral deposu sebze çorbası, bağışıklık güçlendirici.',
            'faydalar' => 'Vitamin ve mineral deposu, antioksidan, bağışıklık güçlendirici.'
        ],
        [
            'ad' => 'Protein Bar',
            'kategori' => 'Atıştırmalık',
            'malzemeler' => 'Yulaf, protein tozu, bal, badem, çikolata parçaları, vanilya',
            'hazirlanis' => 'Malzemeler karıştırılır, kalıba dökülür. Buzdolabında soğutulur.',
            'sure' => '30 dakika',
            'zorluk' => 'Kolay',
            'porsiyon' => '8 adet',
            'kalori' => '180 kcal',
            'protein' => '15g',
            'karbonhidrat' => '20g',
            'yag' => '8g',
            'lif' => '4g',
            'resim' => 'assets/images/yemekler/protein-bar.jpg',
            'aciklama' => 'Ev yapımı protein bar, spor sonrası ideal atıştırmalık.',
            'faydalar' => 'Yüksek protein, enerji verici, kas onarımı, tok tutucu.'
        ]
    ];
    
    // Verileri ekle
    $stmt = $conn->prepare("INSERT INTO saglikli_besinler (ad, kategori, malzemeler, hazirlanis, sure, zorluk, porsiyon, kalori, protein, karbonhidrat, yag, lif, resim, aciklama, faydalar) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $eklenen = 0;
    foreach ($besinler as $besin) {
        try {
            $stmt->execute([
                $besin['ad'],
                $besin['kategori'],
                $besin['malzemeler'],
                $besin['hazirlanis'],
                $besin['sure'],
                $besin['zorluk'],
                $besin['porsiyon'],
                $besin['kalori'],
                $besin['protein'],
                $besin['karbonhidrat'],
                $besin['yag'],
                $besin['lif'],
                $besin['resim'],
                $besin['aciklama'],
                $besin['faydalar']
            ]);
            $eklenen++;
            echo "✅ " . $besin['ad'] . " (" . $besin['kategori'] . ") eklendi<br>";
        } catch(PDOException $e) {
            if ($e->getCode() == 23000) { // Duplicate entry
                echo "⚠️ " . $besin['ad'] . " zaten mevcut<br>";
            } else {
                echo "❌ " . $besin['ad'] . " eklenirken hata: " . $e->getMessage() . "<br>";
            }
        }
    }
    
    echo "<br>📊 Toplam " . $eklenen . " sağlıklı besin eklendi<br><br>";
    
    // Tablo yapısını göster
    echo "<h3>📋 Tablo Yapısı:</h3>";
    $result = $conn->query("DESCRIBE saglikli_besinler");
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
    echo "<br><h3>🥗 Eklenen Sağlıklı Besinler:</h3>";
    $result = $conn->query("SELECT id, ad, kategori, sure, zorluk, porsiyon, kalori FROM saglikli_besinler ORDER BY id DESC");
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr><th>ID</th><th>Besin Adı</th><th>Kategori</th><th>Süre</th><th>Zorluk</th><th>Porsiyon</th><th>Kalori</th></tr>";
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['ad'] . "</td>";
        echo "<td>" . $row['kategori'] . "</td>";
        echo "<td>" . $row['sure'] . "</td>";
        echo "<td>" . $row['zorluk'] . "</td>";
        echo "<td>" . $row['porsiyon'] . "</td>";
        echo "<td>" . $row['kalori'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
} catch(PDOException $e) {
    echo "❌ Hata: " . $e->getMessage();
}

$conn = null;
?>
