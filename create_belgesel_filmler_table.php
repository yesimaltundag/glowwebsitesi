<?php
// Veritabanı bağlantı ayarları - WampServer
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "basit_sistem";

try {
    // PDO bağlantısı oluştur
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✅ Veritabanı bağlantısı başarılı!<br>";
    
         // Belgesel filmleri tablosu oluştur
     $sql = "CREATE TABLE IF NOT EXISTS filmler (
         id INT AUTO_INCREMENT PRIMARY KEY,
         film_adi VARCHAR(255) NOT NULL,
         yil INT,
         imdb_puani DECIMAL(3,1),
         kategori VARCHAR(100) DEFAULT 'Belgesel',
         ozet TEXT,
         poster_url VARCHAR(500),
         yonetmen VARCHAR(255),
         sure VARCHAR(50),
         ulke VARCHAR(100),
         dil VARCHAR(100),
         created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
     )";
    
    $pdo->exec($sql);
    echo "✅ 'filmler' tablosu oluşturuldu!<br>";
    
    // Örnek belgesel filmleri ekle
    $belgesel_filmler = [
        [
            'film_adi' => 'Planet Earth II',
            'yil' => 2016,
            'imdb_puani' => 9.5,
            'kategori' => 'Belgesel',
            'ozet' => 'Dünya\'nın en muhteşem doğal ortamlarının keşfi. Yüksek çözünürlüklü görüntülerle doğa belgeseli.',
                         'poster_url' => 'https://m.media-amazon.com/images/M/MV5BZWYxODViMGYtMGE2ZC00ZGQ3LThhMWUtYTVkNGE3OWU4NWRkL2ltYWdlL2ltYWdlXkEyXkFqcGdeQXVyMjYwNDA2MDE@._V1_.jpg',
            'yonetmen' => 'David Attenborough',
            'sure' => '6 Bölüm',
            'ulke' => 'Birleşik Krallık',
            'dil' => 'İngilizce'
        ],
        [
            'film_adi' => 'The Last Dance',
            'yil' => 2020,
            'imdb_puani' => 9.1,
            'kategori' => 'Belgesel',
            'ozet' => 'Michael Jordan ve Chicago Bulls\'un 1997-98 sezonundaki son şampiyonluk yolculuğu.',
                         'poster_url' => 'https://m.media-amazon.com/images/M/MV5BY2U1ZTU4OWItNGU2MC00MTg1LTk4NzUtYTk3ODhjYjI0MzlmXkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_.jpg',
            'yonetmen' => 'Jason Hehir',
            'sure' => '10 Bölüm',
            'ulke' => 'ABD',
            'dil' => 'İngilizce'
        ],
        [
            'film_adi' => 'Won\'t You Be My Neighbor?',
            'yil' => 2018,
            'imdb_puani' => 8.3,
            'kategori' => 'Belgesel',
            'ozet' => 'Fred Rogers\'ın Mister Rogers\' Neighborhood programının arkasındaki hikaye.',
                         'poster_url' => 'https://m.media-amazon.com/images/M/MV5BMjI0MDMzOTQyM15BMl5BanBnXkFtZTgwMTM5MjI5NTM@._V1_.jpg',
            'yonetmen' => 'Morgan Neville',
            'sure' => '94 dk',
            'ulke' => 'ABD',
            'dil' => 'İngilizce'
        ],
        [
            'film_adi' => 'The Act of Killing',
            'yil' => 2012,
            'imdb_puani' => 8.2,
            'kategori' => 'Belgesel',
            'ozet' => 'Endonezya\'daki katliamların faillerinin kendi suçlarını yeniden canlandırması.',
                         'poster_url' => 'https://m.media-amazon.com/images/M/MV5BMTY2NjU2NDcwN15BMl5BanBnXkFtZTcwOTU4NzU1OQ@@._V1_.jpg',
            'yonetmen' => 'Joshua Oppenheimer',
            'sure' => '115 dk',
            'ulke' => 'Endonezya',
            'dil' => 'Endonezce'
        ],
        [
            'film_adi' => 'Free Solo',
            'yil' => 2018,
            'imdb_puani' => 8.1,
            'kategori' => 'Belgesel',
            'ozet' => 'Alex Honnold\'un El Capitan\'ı ip kullanmadan tırmanma denemesi. Tehlikeli spor belgeseli.',
                         'poster_url' => 'https://m.media-amazon.com/images/M/MV5BMjA0MzQzNjM1Ml5BMl5BanBnXkFtZTgwNjM5MjU5NTM@._V1_.jpg',
            'yonetmen' => 'Elizabeth Chai Vasarhelyi, Jimmy Chin',
            'sure' => '100 dk',
            'ulke' => 'ABD',
            'dil' => 'İngilizce'
        ],
        [
            'film_adi' => 'My Octopus Teacher',
            'yil' => 2020,
            'imdb_puani' => 8.1,
            'kategori' => 'Belgesel',
            'ozet' => 'Craig Foster\'ın bir ahtapotla geliştirdiği dostluk. Doğa ve insan bağlantısı.',
                         'poster_url' => 'https://m.media-amazon.com/images/M/MV5BZWIxYTdmZDgtN2ZiMS00M2Y3LTg3MzYtOGJhNGE1ZDFmOGU3XkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_.jpg',
            'yonetmen' => 'Pippa Ehrlich, James Reed',
            'sure' => '85 dk',
            'ulke' => 'Güney Afrika',
            'dil' => 'İngilizce'
        ]
    ];
    
    // Mevcut verileri kontrol et ve ekle
    foreach ($belgesel_filmler as $film) {
        $check_sql = "SELECT id FROM filmler WHERE film_adi = ? AND kategori = 'Belgesel'";
        $check_stmt = $pdo->prepare($check_sql);
        $check_stmt->execute([$film['film_adi']]);
        
        if ($check_stmt->rowCount() == 0) {
                         $insert_sql = "INSERT INTO filmler (film_adi, yil, imdb_puani, kategori, ozet, poster_url, yonetmen, sure, ulke, dil) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $insert_stmt = $pdo->prepare($insert_sql);
            $insert_stmt->execute([
                $film['film_adi'],
                $film['yil'],
                $film['imdb_puani'],
                $film['kategori'],
                $film['ozet'],
                $film['kapak_url'],
                $film['yonetmen'],
                $film['sure'],
                $film['ulke'],
                $film['dil']
            ]);
            echo "✅ '{$film['film_adi']}' eklendi!<br>";
        } else {
            echo "ℹ️ '{$film['film_adi']}' zaten mevcut!<br>";
        }
    }
    
    echo "<br><br>🎉 Belgesel filmleri tablosu kurulumu tamamlandı!";
    echo "<br><br>📝 <strong>Sonraki Adımlar:</strong>";
    echo "<br>1. WampServer'ı başlatın";
    echo "<br>2. Tarayıcıda http://app.test2.local/belgesel-filmler.html adresini açın";
    echo "<br>3. Belgesel filmlerinin kapak görselleriyle yüklendiğini kontrol edin";
    
} catch(PDOException $e) {
    echo "❌ Hata: " . $e->getMessage();
}
?>
