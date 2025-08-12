<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "basit_sistem";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Yemekler tablosunu oluştur
    $sql = "CREATE TABLE IF NOT EXISTS yemekler (
        id INT AUTO_INCREMENT PRIMARY KEY,
        ad VARCHAR(255) NOT NULL,
        bolge VARCHAR(255) NOT NULL,
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
    echo "✅ Yemekler tablosu başarıyla oluşturuldu!<br><br>";
    
    // Örnek verileri ekle
    $yemekler = [
        [
            'ad' => 'İskender Kebap',
            'bolge' => 'Bursa',
            'malzemeler' => 'Dana eti, tereyağı, domates sosu, yoğurt, ekmek, domates, biber',
            'hazirlanis' => 'Dana eti ızgarada pişirilir, tereyağı ile soslanır, yoğurt ve domates sosu ile servis edilir.',
            'sure' => '45 dakika',
            'zorluk' => 'Orta',
            'porsiyon' => '4 kişilik',
            'kalori' => '650 kcal',
            'resim' => 'assets/images/yemekler/iskender.jpg',
            'aciklama' => 'Bursa\'nın meşhur iskender kebabı, özel sosu ve tereyağı ile servis edilir.'
        ],
        [
            'ad' => 'Mantı',
            'bolge' => 'Kayseri',
            'malzemeler' => 'Un, yumurta, kıyma, soğan, yoğurt, domates sosu, nane, pul biber',
            'hazirlanis' => 'Hamur yoğrulur, iç harcı hazırlanır, küçük parçalar halinde şekillendirilir ve haşlanır.',
            'sure' => '90 dakika',
            'zorluk' => 'Zor',
            'porsiyon' => '6 kişilik',
            'kalori' => '450 kcal',
            'resim' => 'assets/images/yemekler/manti.jpg',
            'aciklama' => 'Kayseri mantısı, el açması hamur ve özel sosu ile Türk mutfağının vazgeçilmezidir.'
        ],
        [
            'ad' => 'Lahmacun',
            'bolge' => 'Gaziantep',
            'malzemeler' => 'Un, maya, kıyma, soğan, domates, biber, maydanoz, baharatlar',
            'hazirlanis' => 'Hamur yoğrulur, ince açılır, üzerine harc yayılır ve odun ateşinde pişirilir.',
            'sure' => '60 dakika',
            'zorluk' => 'Orta',
            'porsiyon' => '8 adet',
            'kalori' => '280 kcal',
            'resim' => 'assets/images/yemekler/lahmacun.jpg',
            'aciklama' => 'Gaziantep\'in meşhur lahmacunu, ince hamuru ve özel harcı ile eşsiz lezzet.'
        ],
        [
            'ad' => 'Pide',
            'bolge' => 'Kastamonu',
            'malzemeler' => 'Un, maya, kıyma, soğan, yumurta, tereyağı, tuz',
            'hazirlanis' => 'Hamur yoğrulur, uzun şekilde açılır, harc yayılır ve odun ateşinde pişirilir.',
            'sure' => '45 dakika',
            'zorluk' => 'Kolay',
            'porsiyon' => '4 adet',
            'kalori' => '320 kcal',
            'resim' => 'assets/images/yemekler/pide.jpg',
            'aciklama' => 'Kastamonu pidesi, geleneksel yapım tekniği ile hazırlanan eşsiz lezzet.'
        ],
        [
            'ad' => 'Hünkar Beğendi',
            'bolge' => 'İstanbul',
            'malzemeler' => 'Kuzu eti, patlıcan, süt, tereyağı, un, soğan, domates, baharatlar',
            'hazirlanis' => 'Kuzu eti pişirilir, patlıcan közlenir, sütlü sos hazırlanır ve birleştirilir.',
            'sure' => '75 dakika',
            'zorluk' => 'Orta',
            'porsiyon' => '4 kişilik',
            'kalori' => '580 kcal',
            'resim' => 'assets/images/yemekler/hunkar-begendi.jpg',
            'aciklama' => 'Osmanlı mutfağından gelen hünkar beğendi, patlıcan püresi ve kuzu eti ile.'
        ],
        [
            'ad' => 'Çiğ Köfte',
            'bolge' => 'Şanlıurfa',
            'malzemeler' => 'Bulgur, isot, soğan, sarımsak, maydanoz, domates, limon, baharatlar',
            'hazirlanis' => 'Bulgur ıslatılır, isot ve baharatlarla yoğrulur, marul ve domates ile servis edilir.',
            'sure' => '30 dakika',
            'zorluk' => 'Kolay',
            'porsiyon' => '6 kişilik',
            'kalori' => '220 kcal',
            'resim' => 'assets/images/yemekler/cig-kofte.jpg',
            'aciklama' => 'Şanlıurfa\'nın meşhur çiğ köftesi, isot ve özel baharatlarla hazırlanır.'
        ],
        [
            'ad' => 'Karnıyarık',
            'bolge' => 'Antalya',
            'malzemeler' => 'Patlıcan, kıyma, soğan, domates, biber, sarımsak, zeytinyağı',
            'hazirlanis' => 'Patlıcan közlenir, içi çıkarılır, harc hazırlanır ve fırında pişirilir.',
            'sure' => '50 dakika',
            'zorluk' => 'Orta',
            'porsiyon' => '4 kişilik',
            'kalori' => '380 kcal',
            'resim' => 'assets/images/yemekler/karniyarik.jpg',
            'aciklama' => 'Antalya\'nın geleneksel karnıyarık yemeği, közlenmiş patlıcan ile.'
        ],
        [
            'ad' => 'Döner',
            'bolge' => 'Bursa',
            'malzemeler' => 'Kuzu eti, baharatlar, ekmek, soğan, domates, turşu, soslar',
            'hazirlanis' => 'Et marine edilir, dikey şişe takılır, döner makinesinde pişirilir.',
            'sure' => '120 dakika',
            'zorluk' => 'Zor',
            'porsiyon' => '8 kişilik',
            'kalori' => '420 kcal',
            'resim' => 'assets/images/yemekler/doner.jpg',
            'aciklama' => 'Bursa\'nın meşhur döneri, özel baharatlarla marine edilmiş et ile.'
        ]
    ];
    
    // Verileri ekle
    $stmt = $conn->prepare("INSERT INTO yemekler (ad, bolge, malzemeler, hazirlanis, sure, zorluk, porsiyon, kalori, resim, aciklama) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $eklenen = 0;
    foreach ($yemekler as $yemek) {
        try {
            $stmt->execute([
                $yemek['ad'],
                $yemek['bolge'],
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
            echo "✅ " . $yemek['ad'] . " eklendi<br>";
        } catch(PDOException $e) {
            if ($e->getCode() == 23000) { // Duplicate entry
                echo "⚠️ " . $yemek['ad'] . " zaten mevcut<br>";
            } else {
                echo "❌ " . $yemek['ad'] . " eklenirken hata: " . $e->getMessage() . "<br>";
            }
        }
    }
    
    echo "<br>📊 Toplam " . $eklenen . " yemek eklendi<br><br>";
    
    // Tablo yapısını göster
    echo "<h3>📋 Tablo Yapısı:</h3>";
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
    
    // Eklenen verileri göster
    echo "<br><h3>🍽️ Eklenen Yemekler:</h3>";
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
    
} catch(PDOException $e) {
    echo "❌ Hata: " . $e->getMessage();
}

$conn = null;
?>
