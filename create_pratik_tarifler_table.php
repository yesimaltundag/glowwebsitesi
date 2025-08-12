<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "basit_sistem";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Pratik tarifler tablosunu oluştur
    $sql = "CREATE TABLE IF NOT EXISTS pratik_tarifler (
        id INT AUTO_INCREMENT PRIMARY KEY,
        ad VARCHAR(255) NOT NULL,
        kategori VARCHAR(255) NOT NULL,
        malzemeler TEXT NOT NULL,
        hazirlanis TEXT NOT NULL,
        sure VARCHAR(100) NOT NULL,
        zorluk ENUM('Kolay', 'Orta', 'Zor') DEFAULT 'Kolay',
        porsiyon VARCHAR(50) NOT NULL,
        kalori VARCHAR(50),
        resim VARCHAR(500) NOT NULL,
        aciklama TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
    $conn->exec($sql);
    echo "✅ Pratik tarifler tablosu başarıyla oluşturuldu!<br><br>";
    
    // Örnek verileri ekle
    $tarifler = [
        [
            'ad' => 'Mercimek Çorbası',
            'kategori' => 'Çorbalar',
            'malzemeler' => 'Kırmızı mercimek, soğan, havuç, patates, tereyağı, un, tuz, karabiber, pul biber',
            'hazirlanis' => 'Soğan ve havuç doğranır, tereyağında kavrulur. Mercimek ve patates eklenir, su ile pişirilir. Blenderdan geçirilir.',
            'sure' => '25 dakika',
            'zorluk' => 'Kolay',
            'porsiyon' => '4 kişilik',
            'kalori' => '180 kcal',
            'resim' => 'assets/images/yemekler/mercimek-corbasi.jpg',
            'aciklama' => 'Hızlı ve besleyici mercimek çorbası, kış günlerinin vazgeçilmezi.'
        ],
        [
            'ad' => 'Omlet',
            'kategori' => 'Kahvaltı',
            'malzemeler' => 'Yumurta, süt, peynir, domates, biber, tuz, karabiber, tereyağı',
            'hazirlanis' => 'Yumurtalar çırpılır, malzemeler eklenir. Tereyağında pişirilir, katlanır.',
            'sure' => '10 dakika',
            'zorluk' => 'Kolay',
            'porsiyon' => '2 kişilik',
            'kalori' => '220 kcal',
            'resim' => 'assets/images/yemekler/omlet.jpg',
            'aciklama' => 'Kahvaltıların pratik ve lezzetli omleti, sebzelerle zenginleştirilmiş.'
        ],
        [
            'ad' => 'Makarna Carbonara',
            'kategori' => 'Makarna',
            'malzemeler' => 'Spaghetti, yumurta, peynir, pastırma, karabiber, tuz, zeytinyağı',
            'hazirlanis' => 'Makarna haşlanır, pastırma kızartılır. Yumurta ve peynir karıştırılır, makarna ile birleştirilir.',
            'sure' => '15 dakika',
            'zorluk' => 'Kolay',
            'porsiyon' => '4 kişilik',
            'kalori' => '380 kcal',
            'resim' => 'assets/images/yemekler/carbonara.jpg',
            'aciklama' => 'İtalyan mutfağının klasik makarnası, hızlı ve lezzetli.'
        ],
        [
            'ad' => 'Tavuk Sote',
            'kategori' => 'Ana Yemek',
            'malzemeler' => 'Tavuk göğsü, soğan, biber, domates, zeytinyağı, tuz, karabiber, kekik',
            'hazirlanis' => 'Tavuk kuşbaşı doğranır, sebzelerle birlikte sote edilir. Baharatlar eklenir.',
            'sure' => '20 dakika',
            'zorluk' => 'Kolay',
            'porsiyon' => '4 kişilik',
            'kalori' => '280 kcal',
            'resim' => 'assets/images/yemekler/tavuk-sote.jpg',
            'aciklama' => 'Pratik tavuk sote, sebzelerle zenginleştirilmiş lezzetli ana yemek.'
        ],
        [
            'ad' => 'Salata',
            'kategori' => 'Salata',
            'malzemeler' => 'Marul, domates, salatalık, havuç, zeytin, peynir, zeytinyağı, limon, tuz',
            'hazirlanis' => 'Sebzeler doğranır, karıştırılır. Zeytinyağı ve limon sosu hazırlanır.',
            'sure' => '10 dakika',
            'zorluk' => 'Kolay',
            'porsiyon' => '4 kişilik',
            'kalori' => '120 kcal',
            'resim' => 'assets/images/yemekler/salata.jpg',
            'aciklama' => 'Taze ve sağlıklı salata, her öğünün yanında servis edilebilir.'
        ],
        [
            'ad' => 'Pilav',
            'kategori' => 'Garnitür',
            'malzemeler' => 'Pirinç, soğan, tereyağı, tuz, karabiber, su',
            'hazirlanis' => 'Soğan tereyağında kavrulur, pirinç eklenir. Su ile pişirilir.',
            'sure' => '25 dakika',
            'zorluk' => 'Kolay',
            'porsiyon' => '6 kişilik',
            'kalori' => '200 kcal',
            'resim' => 'assets/images/yemekler/pilav.jpg',
            'aciklama' => 'Geleneksel Türk pilavı, her yemeğin yanında mükemmel gider.'
        ],
        [
            'ad' => 'Sandviç',
            'kategori' => 'Hızlı Yemek',
            'malzemeler' => 'Ekmek, tavuk göğsü, marul, domates, peynir, mayonez, hardal',
            'hazirlanis' => 'Ekmek arası malzemeler dizilir, soslar eklenir.',
            'sure' => '5 dakika',
            'zorluk' => 'Kolay',
            'porsiyon' => '2 adet',
            'kalori' => '320 kcal',
            'resim' => 'assets/images/yemekler/sandvic.jpg',
            'aciklama' => 'Hızlı ve pratik sandviç, acil durumların kurtarıcısı.'
        ],
        [
            'ad' => 'Çorba',
            'kategori' => 'Çorbalar',
            'malzemeler' => 'Tavuk suyu, şehriye, havuç, soğan, maydanoz, tuz, karabiber',
            'hazirlanis' => 'Tavuk suyu kaynatılır, şehriye ve sebzeler eklenir. Pişirilir.',
            'sure' => '20 dakika',
            'zorluk' => 'Kolay',
            'porsiyon' => '4 kişilik',
            'kalori' => '150 kcal',
            'resim' => 'assets/images/yemekler/sehirliye-corbasi.jpg',
            'aciklama' => 'Geleneksel şehriye çorbası, soğuk kış günlerinin sıcak dostu.'
        ],
        [
            'ad' => 'Tost',
            'kategori' => 'Hızlı Yemek',
            'malzemeler' => 'Ekmek, peynir, domates, sucuk, tereyağı',
            'hazirlanis' => 'Ekmek arası malzemeler konur, tost makinesinde pişirilir.',
            'sure' => '8 dakika',
            'zorluk' => 'Kolay',
            'porsiyon' => '2 adet',
            'kalori' => '280 kcal',
            'resim' => 'assets/images/yemekler/tost.jpg',
            'aciklama' => 'Klasik Türk tostu, kahvaltıların vazgeçilmezi.'
        ],
        [
            'ad' => 'Meyve Salatası',
            'kategori' => 'Tatlı',
            'malzemeler' => 'Elma, muz, portakal, üzüm, çilek, bal, limon suyu',
            'hazirlanis' => 'Meyveler doğranır, karıştırılır. Bal ve limon suyu eklenir.',
            'sure' => '10 dakika',
            'zorluk' => 'Kolay',
            'porsiyon' => '4 kişilik',
            'kalori' => '120 kcal',
            'resim' => 'assets/images/yemekler/meyve-salatasi.jpg',
            'aciklama' => 'Sağlıklı ve lezzetli meyve salatası, tatlı ihtiyacını karşılar.'
        ]
    ];
    
    // Verileri ekle
    $stmt = $conn->prepare("INSERT INTO pratik_tarifler (ad, kategori, malzemeler, hazirlanis, sure, zorluk, porsiyon, kalori, resim, aciklama) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $eklenen = 0;
    foreach ($tarifler as $tarif) {
        try {
            $stmt->execute([
                $tarif['ad'],
                $tarif['kategori'],
                $tarif['malzemeler'],
                $tarif['hazirlanis'],
                $tarif['sure'],
                $tarif['zorluk'],
                $tarif['porsiyon'],
                $tarif['kalori'],
                $tarif['resim'],
                $tarif['aciklama']
            ]);
            $eklenen++;
            echo "✅ " . $tarif['ad'] . " (" . $tarif['kategori'] . ") eklendi<br>";
        } catch(PDOException $e) {
            if ($e->getCode() == 23000) { // Duplicate entry
                echo "⚠️ " . $tarif['ad'] . " zaten mevcut<br>";
            } else {
                echo "❌ " . $tarif['ad'] . " eklenirken hata: " . $e->getMessage() . "<br>";
            }
        }
    }
    
    echo "<br>📊 Toplam " . $eklenen . " pratik tarif eklendi<br><br>";
    
    // Tablo yapısını göster
    echo "<h3>📋 Tablo Yapısı:</h3>";
    $result = $conn->query("DESCRIBE pratik_tarifler");
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
    echo "<br><h3>⚡ Eklenen Pratik Tarifler:</h3>";
    $result = $conn->query("SELECT id, ad, kategori, sure, zorluk, porsiyon FROM pratik_tarifler ORDER BY id DESC");
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr><th>ID</th><th>Tarif Adı</th><th>Kategori</th><th>Süre</th><th>Zorluk</th><th>Porsiyon</th></tr>";
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['ad'] . "</td>";
        echo "<td>" . $row['kategori'] . "</td>";
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
