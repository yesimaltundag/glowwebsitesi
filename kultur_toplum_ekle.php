<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "basit_sistem";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ Veritabanı bağlantısı başarılı!<br><br>";
} catch(PDOException $e) {
    echo "❌ Bağlantı hatası: " . $e->getMessage();
    exit;
}

// Kültür & Toplum kitapları
$kultur_toplum_kitaplar = [
    [
        'kitap_adi' => 'Sapiens',
        'yazar' => 'Yuval Noah Harari',
        'basim_yili' => 2011,
        'kategori' => 'Kültür & Toplum',
        'sayfa_sayisi' => 464,
        'basim_yeri' => 'Tel Aviv, İsrail',
        'isbn' => 9789750767901,
        'tanitim' => 'İnsanlığın kısa tarihini anlatan bu kitap, Homo sapiens\'in dünyayı nasıl ele geçirdiğini ve modern toplumları nasıl şekillendirdiğini anlatır.',
        'kapak_url' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'Homo Deus',
        'yazar' => 'Yuval Noah Harari',
        'basim_yili' => 2015,
        'kategori' => 'Kültür & Toplum',
        'sayfa_sayisi' => 448,
        'basim_yeri' => 'Tel Aviv, İsrail',
        'isbn' => 9789750767902,
        'tanitim' => 'Gelecekte insanlığın nasıl evrileceğini ve yapay zeka çağında insanın rolünü inceleyen bu kitap, gelecek vizyonları sunar.',
        'kapak_url' => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'Guns, Germs, and Steel',
        'yazar' => 'Jared Diamond',
        'basim_yili' => 1997,
        'kategori' => 'Kültür & Toplum',
        'sayfa_sayisi' => 480,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767903,
        'tanitim' => 'İnsan toplumlarının neden farklı şekillerde geliştiğini açıklayan bu kitap, coğrafya, biyoloji ve kültürün etkileşimini inceler.',
        'kapak_url' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'The Tipping Point',
        'yazar' => 'Malcolm Gladwell',
        'basim_yili' => 2000,
        'kategori' => 'Kültür & Toplum',
        'sayfa_sayisi' => 304,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767904,
        'tanitim' => 'Küçük değişikliklerin nasıl büyük etkiler yaratabileceğini anlatan bu kitap, sosyal epidemilerin nasıl yayıldığını inceler.',
        'kapak_url' => 'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'Outliers',
        'yazar' => 'Malcolm Gladwell',
        'basim_yili' => 2008,
        'kategori' => 'Kültür & Toplum',
        'sayfa_sayisi' => 309,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767905,
        'tanitim' => 'Başarılı insanların hikayelerini inceleyen bu kitap, başarının arkasındaki gizli faktörleri ortaya çıkarır.',
        'kapak_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=600&fit=crop'
    ]
];

// Önce Kültür & Toplum kategorisindeki mevcut kitapları temizle
try {
    $pdo->exec("DELETE FROM kitaplar WHERE kategori = 'Kültür & Toplum'");
    echo "🗑️ Mevcut Kültür & Toplum kitapları temizlendi.<br><br>";
} catch(PDOException $e) {
    echo "❌ Temizleme hatası: " . $e->getMessage() . "<br><br>";
}

// Kitapları veritabanına ekle
$stmt = $pdo->prepare("INSERT INTO kitaplar (kitap_adi, yazar, basim_yili, kategori, sayfa_sayisi, basim_yeri, isbn, tanitim, kapak_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

$basarili = 0;
$hatali = 0;

foreach ($kultur_toplum_kitaplar as $kitap) {
    try {
        $stmt->execute([
            $kitap['kitap_adi'],
            $kitap['yazar'],
            $kitap['basim_yili'],
            $kitap['kategori'],
            $kitap['sayfa_sayisi'],
            $kitap['basim_yeri'],
            $kitap['isbn'],
            $kitap['tanitim'],
            $kitap['kapak_url']
        ]);
        echo "✅ <strong>{$kitap['kitap_adi']}</strong> - {$kitap['yazar']} başarıyla eklendi.<br>";
        $basarili++;
    } catch(PDOException $e) {
        echo "❌ <strong>{$kitap['kitap_adi']}</strong> eklenirken hata: " . $e->getMessage() . "<br>";
        $hatali++;
    }
}

echo "<br><hr><br>";
echo "📊 <strong>Özet:</strong><br>";
echo "✅ Başarıyla eklenen: $basarili kitap<br>";
echo "❌ Hatalı: $hatali kitap<br>";
echo "📚 Toplam: " . count($kultur_toplum_kitaplar) . " Kültür & Toplum kitabı eklendi.<br><br>";

// Kültür & Toplum kategorisindeki kitapları listele
echo "📋 <strong>Kültür & Toplum Kitapları:</strong><br>";
$stmt = $pdo->query("SELECT * FROM kitaplar WHERE kategori = 'Kültür & Toplum' ORDER BY id");
$kitaplar_liste = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($kitaplar_liste as $kitap) {
    echo "📖 ID: {$kitap['id']} | {$kitap['kitap_adi']} - {$kitap['yazar']} ({$kitap['basim_yili']})<br>";
}

echo "<br>🎉 Kültür & Toplum kitapları başarıyla eklendi!";
echo "<br><br><a href='kultur-toplum.html' style='background: #b48a78; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Kültür & Toplum Sayfasını Aç</a>";
?>
