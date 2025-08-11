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

// Sadece anasayfada gösterilen kitaplar
$anasayfa_kitaplar = [
    [
        'kitap_adi' => 'Sarı Yüz',
        'yazar' => 'R. F. Kuang',
        'basim_yili' => 2022,
        'kategori' => 'Fantastik',
        'sayfa_sayisi' => 480,
        'basim_yeri' => 'İstanbul',
        'isbn' => 9786053751234,
        'tanitim' => 'Modern fantastik edebiyatın önemli eserlerinden biri. Sarı Yüz, güç ve iktidar temalarını işleyen etkileyici bir roman.',
        'kapak_url' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'Bırak Yapsınlar Teorisi',
        'yazar' => 'Mel Robbins',
        'basim_yili' => 2021,
        'kategori' => 'Kişisel Gelişim',
        'sayfa_sayisi' => 320,
        'basim_yeri' => 'İstanbul',
        'isbn' => 9786053751235,
        'tanitim' => 'Milyonlarca insanın hayatını değiştiren 5 saniye kuralı. Kişisel gelişim alanında çığır açan bir eser.',
        'kapak_url' => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'Değişiyorum',
        'yazar' => 'Caner Yaman',
        'basim_yili' => 2023,
        'kategori' => 'Kişisel Gelişim',
        'sayfa_sayisi' => 280,
        'basim_yeri' => 'İstanbul',
        'isbn' => 9786053751236,
        'tanitim' => 'Kişisel dönüşüm ve değişim üzerine yazılmış etkileyici bir eser. Modern yaşamın getirdiği zorluklarla başa çıkma yöntemleri.',
        'kapak_url' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'Yaşanmamış Hayatlar',
        'yazar' => 'Sarah Jio',
        'basim_yili' => 2022,
        'kategori' => 'Roman',
        'sayfa_sayisi' => 350,
        'basim_yeri' => 'İstanbul',
        'isbn' => 9786053751237,
        'tanitim' => 'Alternatif hayatlar ve seçimler üzerine kurulu etkileyici bir roman. Karakterlerin iç dünyalarını derinlemesine inceleyen bir eser.',
        'kapak_url' => 'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'Sen Yeter ki İste',
        'yazar' => 'Pierre Franckh',
        'basim_yili' => 2021,
        'kategori' => 'Kişisel Gelişim',
        'sayfa_sayisi' => 300,
        'basim_yeri' => 'İstanbul',
        'isbn' => 9786053751238,
        'tanitim' => 'Hayalleri gerçeğe dönüştürmek için 7 kural. Motivasyon ve başarı üzerine yazılmış pratik bir rehber.',
        'kapak_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'Suç ve Ceza',
        'yazar' => 'Fyodor Dostoyevski',
        'basim_yili' => 1866,
        'kategori' => 'Klasik Edebiyat',
        'sayfa_sayisi' => 671,
        'basim_yeri' => 'Sankt Petersburg, Rusya',
        'isbn' => 9789750767890,
        'tanitim' => 'Dünya edebiyatının başyapıtlarından biri. Rodion Raskolnikov adlı genç bir öğrencinin işlediği cinayet sonrası yaşadığı psikolojik çöküşü ve vicdani hesaplaşmasını anlatan bu roman, dünya edebiyatının en derin psikolojik analizlerinden biridir.',
        'kapak_url' => 'https://covers.openlibrary.org/b/id/12315028-M.jpg'
    ],
    [
        'kitap_adi' => 'Sefiller',
        'yazar' => 'Victor Hugo',
        'basim_yili' => 1862,
        'kategori' => 'Klasik Edebiyat',
        'sayfa_sayisi' => 1488,
        'basim_yeri' => 'Paris, Fransa',
        'isbn' => 9789750778901,
        'tanitim' => 'Fransız edebiyatının en önemli eserlerinden biri. Jean Valjean\'ın hayatındaki dönüşümü ve 19. yüzyıl Fransa\'sının toplumsal sorunlarını anlatan bu dev roman, dünya edebiyatının en etkileyici eserlerinden biridir.',
        'kapak_url' => 'https://covers.openlibrary.org/b/id/12218285-M.jpg'
    ],
    [
        'kitap_adi' => 'Anna Karenina',
        'yazar' => 'Lev Tolstoy',
        'basim_yili' => 1877,
        'kategori' => 'Klasik Edebiyat',
        'sayfa_sayisi' => 864,
        'basim_yeri' => 'Moskova, Rusya',
        'isbn' => 9789750789012,
        'tanitim' => 'Rus edebiyatının en büyük eserlerinden biri. Anna Karenina\'nın aşk ve evlilik arasında yaşadığı trajik çelişkiyi anlatan bu roman, dünya edebiyatının en derin psikolojik analizlerinden biridir.',
        'kapak_url' => 'https://covers.openlibrary.org/b/id/12639895-M.jpg'
    ],
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

// Önce mevcut kitaplar tablosunu temizle
try {
    $pdo->exec("DELETE FROM kitaplar");
    echo "🗑️ Mevcut kitaplar temizlendi.<br><br>";
} catch(PDOException $e) {
    echo "❌ Tablo temizleme hatası: " . $e->getMessage() . "<br><br>";
}

// Kitapları veritabanına ekle
$stmt = $pdo->prepare("INSERT INTO kitaplar (kitap_adi, yazar, basim_yili, kategori, sayfa_sayisi, basim_yeri, isbn, tanitim, kapak_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

$basarili = 0;
$hatali = 0;

foreach ($anasayfa_kitaplar as $kitap) {
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
echo "📚 Toplam: " . count($anasayfa_kitaplar) . " kitap işlendi.<br><br>";

// Veritabanındaki tüm kitapları listele
echo "📋 <strong>Veritabanındaki Kitaplar:</strong><br>";
$stmt = $pdo->query("SELECT * FROM kitaplar ORDER BY id");
$kitaplar_liste = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($kitaplar_liste as $kitap) {
    echo "📖 ID: {$kitap['id']} | {$kitap['kitap_adi']} - {$kitap['yazar']} ({$kitap['basim_yili']})<br>";
}

echo "<br>🎉 İşlem tamamlandı! Artık sadece anasayfada gösterilen kitaplar var.";
?>
