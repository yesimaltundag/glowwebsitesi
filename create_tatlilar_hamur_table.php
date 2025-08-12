<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "basit_sistem";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Tatlılar ve hamur işleri tablosunu oluştur
    $sql = "CREATE TABLE IF NOT EXISTS tatlilar_hamur (
        id INT AUTO_INCREMENT PRIMARY KEY,
        ad VARCHAR(255) NOT NULL,
        kategori VARCHAR(255) NOT NULL,
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
    echo "✅ Tatlılar ve hamur işleri tablosu başarıyla oluşturuldu!<br><br>";
    
    // Örnek verileri ekle
    $tatlilar = [
        [
            'ad' => 'Baklava',
            'kategori' => 'Geleneksel Tatlılar',
            'malzemeler' => 'Yufka, ceviz, tereyağı, şeker, su, limon suyu, gül suyu',
            'hazirlanis' => 'Yufkalar arasına ceviz serpilir, tereyağı ile yağlanır, fırında pişirilir, şerbeti dökülür.',
            'sure' => '120 dakika',
            'zorluk' => 'Zor',
            'porsiyon' => '20 adet',
            'kalori' => '350 kcal',
            'resim' => 'assets/images/yemekler/baklava.jpg',
            'aciklama' => 'Türk mutfağının en meşhur tatlısı, ince yufka katmanları ve ceviz ile.'
        ],
        [
            'ad' => 'Künefe',
            'kategori' => 'Geleneksel Tatlılar',
            'malzemeler' => 'Kadayıf, peynir, tereyağı, şeker, su, antep fıstığı',
            'hazirlanis' => 'Kadayıf arasına peynir konur, tereyağı ile yağlanır, ızgarada pişirilir.',
            'sure' => '45 dakika',
            'zorluk' => 'Orta',
            'porsiyon' => '6 kişilik',
            'kalori' => '420 kcal',
            'resim' => 'assets/images/yemekler/kunefe.jpg',
            'aciklama' => 'Antep\'in meşhur künefesi, taze peynir ve kadayıf ile.'
        ],
        [
            'ad' => 'Tiramisu',
            'kategori' => 'Modern Tatlılar',
            'malzemeler' => 'Mascarpone peyniri, yumurta, şeker, kahve, kakao, ladyfinger bisküvi',
            'hazirlanis' => 'Krema hazırlanır, bisküviler kahveye batırılır, katmanlar halinde dizilir.',
            'sure' => '60 dakika',
            'zorluk' => 'Orta',
            'porsiyon' => '8 kişilik',
            'kalori' => '280 kcal',
            'resim' => 'assets/images/yemekler/tiramisu.jpg',
            'aciklama' => 'İtalyan mutfağının popüler tatlısı, kahve ve mascarpone ile.'
        ],
        [
            'ad' => 'Cheesecake',
            'kategori' => 'Modern Tatlılar',
            'malzemeler' => 'Krem peynir, yumurta, şeker, vanilya, bisküvi, tereyağı',
            'hazirlanis' => 'Bisküvi tabanı hazırlanır, krem peynir karışımı dökülür, fırında pişirilir.',
            'sure' => '90 dakika',
            'zorluk' => 'Orta',
            'porsiyon' => '12 dilim',
            'kalori' => '320 kcal',
            'resim' => 'assets/images/yemekler/cheesecake.jpg',
            'aciklama' => 'Amerikan mutfağının klasik tatlısı, krem peynir ve bisküvi tabanı ile.'
        ],
        [
            'ad' => 'Pogaca',
            'kategori' => 'Hamur İşleri',
            'malzemeler' => 'Un, maya, süt, yumurta, tereyağı, peynir, tuz',
            'hazirlanis' => 'Hamur yoğrulur, mayalandırılır, iç harcı konur, fırında pişirilir.',
            'sure' => '75 dakika',
            'zorluk' => 'Kolay',
            'porsiyon' => '12 adet',
            'kalori' => '180 kcal',
            'resim' => 'assets/images/yemekler/pogaca.jpg',
            'aciklama' => 'Geleneksel Türk hamur işi, peynirli iç harcı ile.'
        ],
        [
            'ad' => 'Croissant',
            'kategori' => 'Hamur İşleri',
            'malzemeler' => 'Un, maya, süt, tereyağı, yumurta, tuz, şeker',
            'hazirlanis' => 'Katmerli hamur hazırlanır, üçgen şeklinde kesilir, rulo yapılır.',
            'sure' => '180 dakika',
            'zorluk' => 'Zor',
            'porsiyon' => '8 adet',
            'kalori' => '250 kcal',
            'resim' => 'assets/images/yemekler/croissant.jpg',
            'aciklama' => 'Fransız mutfağının simgesi, katmerli hamur ve tereyağı ile.'
        ],
        [
            'ad' => 'Brownie',
            'kategori' => 'Modern Tatlılar',
            'malzemeler' => 'Çikolata, tereyağı, yumurta, şeker, un, kakao, vanilya',
            'hazirlanis' => 'Çikolata eritilir, malzemeler karıştırılır, fırında pişirilir.',
            'sure' => '40 dakika',
            'zorluk' => 'Kolay',
            'porsiyon' => '16 parça',
            'kalori' => '200 kcal',
            'resim' => 'assets/images/yemekler/brownie.jpg',
            'aciklama' => 'Çikolata severlerin favorisi, yoğun çikolata tadı ile.'
        ],
        [
            'ad' => 'Sufle',
            'kategori' => 'Modern Tatlılar',
            'malzemeler' => 'Çikolata, yumurta, şeker, un, tereyağı, vanilya',
            'hazirlanis' => 'Çikolata eritilir, yumurta beyazları çırpılır, fırında pişirilir.',
            'sure' => '30 dakika',
            'zorluk' => 'Zor',
            'porsiyon' => '4 adet',
            'kalori' => '180 kcal',
            'resim' => 'assets/images/yemekler/sufle.jpg',
            'aciklama' => 'Fransız mutfağının zarif tatlısı, sıcak servis edilir.'
        ]
    ];
    
    // Verileri ekle
    $stmt = $conn->prepare("INSERT INTO tatlilar_hamur (ad, kategori, malzemeler, hazirlanis, sure, zorluk, porsiyon, kalori, resim, aciklama) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $eklenen = 0;
    foreach ($tatlilar as $tatli) {
        try {
            $stmt->execute([
                $tatli['ad'],
                $tatli['kategori'],
                $tatli['malzemeler'],
                $tatli['hazirlanis'],
                $tatli['sure'],
                $tatli['zorluk'],
                $tatli['porsiyon'],
                $tatli['kalori'],
                $tatli['resim'],
                $tatli['aciklama']
            ]);
            $eklenen++;
            echo "✅ " . $tatli['ad'] . " (" . $tatli['kategori'] . ") eklendi<br>";
        } catch(PDOException $e) {
            if ($e->getCode() == 23000) { // Duplicate entry
                echo "⚠️ " . $tatli['ad'] . " zaten mevcut<br>";
            } else {
                echo "❌ " . $tatli['ad'] . " eklenirken hata: " . $e->getMessage() . "<br>";
            }
        }
    }
    
    echo "<br>📊 Toplam " . $eklenen . " tatlı ve hamur işi eklendi<br><br>";
    
    // Tablo yapısını göster
    echo "<h3>📋 Tablo Yapısı:</h3>";
    $result = $conn->query("DESCRIBE tatlilar_hamur");
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
    echo "<br><h3>🍰 Eklenen Tatlılar ve Hamur İşleri:</h3>";
    $result = $conn->query("SELECT id, ad, kategori, sure, zorluk, porsiyon FROM tatlilar_hamur ORDER BY id DESC");
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr><th>ID</th><th>Tatlı Adı</th><th>Kategori</th><th>Süre</th><th>Zorluk</th><th>Porsiyon</th></tr>";
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
