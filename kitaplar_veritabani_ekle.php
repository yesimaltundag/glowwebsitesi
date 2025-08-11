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

// Kitaplar verileri - TÜM KİTAPLAR
$kitaplar = [
    // Modern Kitaplar (Anasayfa carousel'den)
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
    
    // Klasik Kitaplar (Kitaplar.html'den)
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
        'kitap_adi' => 'Büyük Umutlar',
        'yazar' => 'Charles Dickens',
        'basim_yili' => 1861,
        'kategori' => 'Klasik Edebiyat',
        'sayfa_sayisi' => 544,
        'basim_yeri' => 'Londra, İngiltere',
        'isbn' => 9789750790123,
        'tanitim' => 'İngiliz edebiyatının önemli eserlerinden biri. Pip adlı yetim bir çocuğun hayatındaki değişimleri ve sosyal sınıf farklılıklarının insan üzerindeki etkisini anlatan bu roman, dünya edebiyatının en etkileyici eserlerinden biridir.',
        'kapak_url' => 'https://covers.openlibrary.org/b/id/12310271-M.jpg'
    ],
    [
        'kitap_adi' => 'Karamazov Kardeşler',
        'yazar' => 'Fyodor Dostoyevski',
        'basim_yili' => 1880,
        'kategori' => 'Klasik Edebiyat',
        'sayfa_sayisi' => 796,
        'basim_yeri' => 'Sankt Petersburg, Rusya',
        'isbn' => 9789750791234,
        'tanitim' => 'Dostoyevski\'nin son ve en önemli eseridir. Karamazov ailesinin dört oğlunun babalarının ölümü etrafında yaşadığı dramı anlatan bu roman, dünya edebiyatının en derin felsefi analizlerinden biridir.',
        'kapak_url' => 'https://covers.openlibrary.org/b/id/10848852-M.jpg'
    ],
    
    // Türk Edebiyatı (Alintilar.html'den)
    [
        'kitap_adi' => 'Çalıkuşu',
        'yazar' => 'Reşat Nuri Güntekin',
        'basim_yili' => 1922,
        'kategori' => 'Türk Edebiyatı',
        'sayfa_sayisi' => 448,
        'basim_yeri' => 'İstanbul, Türkiye',
        'isbn' => 9789750712345,
        'tanitim' => 'Türk edebiyatının en önemli eserlerinden biridir. Feride\'nin öğretmenlik yaparken yaşadığı zorlukları ve aşk hayatındaki trajedileri anlatan bu roman, Türk edebiyatının en sevilen eserlerinden biridir.',
        'kapak_url' => 'https://covers.openlibrary.org/b/id/8231856-L.jpg'
    ],
    [
        'kitap_adi' => 'Tutunamayanlar',
        'yazar' => 'Oğuz Atay',
        'basim_yili' => 1972,
        'kategori' => 'Türk Edebiyatı',
        'sayfa_sayisi' => 724,
        'basim_yeri' => 'İstanbul, Türkiye',
        'isbn' => 9789750723456,
        'tanitim' => 'Türk edebiyatında postmodern akımın öncü eserlerinden biridir. Turgut Özben\'in arkadaşı Selim Işık\'ın intiharından sonra onun geçmişini araştırması ve kendini keşfetmesi sürecini anlatan bu roman, Türk edebiyatının en önemli eserlerinden biri kabul edilir.',
        'kapak_url' => 'https://covers.openlibrary.org/b/id/10031512-M.jpg'
    ],
    [
        'kitap_adi' => 'Kürk Mantolu Madonna',
        'yazar' => 'Sabahattin Ali',
        'basim_yili' => 1943,
        'kategori' => 'Türk Edebiyatı',
        'sayfa_sayisi' => 160,
        'basim_yeri' => 'İstanbul, Türkiye',
        'isbn' => 9789750734567,
        'tanitim' => 'Türk edebiyatının en önemli eserlerinden biridir. Raif Efendi\'nin Berlin\'de yaşadığı aşk hikayesini anlatan bu roman, Türk edebiyatının en etkileyici aşk hikayelerinden biridir.',
        'kapak_url' => 'https://covers.openlibrary.org/b/id/10031512-M.jpg'
    ],
    [
        'kitap_adi' => 'Memleketimden İnsan Manzaraları',
        'yazar' => 'Nâzım Hikmet',
        'basim_yili' => 1966,
        'kategori' => 'Türk Edebiyatı',
        'sayfa_sayisi' => 2000,
        'basim_yeri' => 'İstanbul, Türkiye',
        'isbn' => 9789750745678,
        'tanitim' => 'Türk edebiyatının en önemli eserlerinden biridir. Türk toplumunun farklı kesimlerinden insanların hikayelerini anlatan bu destansı şiir, Türk edebiyatının en kapsamlı toplumsal analizlerinden biridir.',
        'kapak_url' => 'https://covers.openlibrary.org/b/id/14994023-M.jpg'
    ],
    [
        'kitap_adi' => 'Kara Kitap',
        'yazar' => 'Orhan Pamuk',
        'basim_yili' => 1990,
        'kategori' => 'Türk Edebiyatı',
        'sayfa_sayisi' => 448,
        'basim_yeri' => 'İstanbul, Türkiye',
        'isbn' => 9789750756789,
        'tanitim' => 'Postmodern Türk edebiyatının önemli örneklerinden biridir. Galip\'in kaybolan eşi Rüya\'yı arama sürecinde İstanbul\'un gizemli sokaklarında yaşadığı maceraları anlatan bu roman, Türk edebiyatının önemli eserlerinden biridir.',
        'kapak_url' => 'https://covers.openlibrary.org/b/id/12297420-M.jpg'
    ],
    
    // Edebiyat Kategorisi Kitapları
    [
        'kitap_adi' => '1984',
        'yazar' => 'George Orwell',
        'basim_yili' => 1949,
        'kategori' => 'Edebiyat',
        'sayfa_sayisi' => 328,
        'basim_yeri' => 'Londra, İngiltere',
        'isbn' => 9789750767891,
        'tanitim' => 'Distopik edebiyatın başyapıtlarından biri. Totaliter bir rejimde yaşayan Winston Smith\'in hayatını anlatan bu roman, güç, kontrol ve özgürlük temalarını işler.',
        'kapak_url' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'Hayvan Çiftliği',
        'yazar' => 'George Orwell',
        'basim_yili' => 1945,
        'kategori' => 'Edebiyat',
        'sayfa_sayisi' => 112,
        'basim_yeri' => 'Londra, İngiltere',
        'isbn' => 9789750767892,
        'tanitim' => 'Alegorik bir roman. Çiftlik hayvanlarının insanlara karşı ayaklanmasını ve sonrasında yaşananları anlatan bu eser, siyasi sistemlerin eleştirisini yapar.',
        'kapak_url' => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'Fareler ve İnsanlar',
        'yazar' => 'John Steinbeck',
        'basim_yili' => 1937,
        'kategori' => 'Edebiyat',
        'sayfa_sayisi' => 112,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767893,
        'tanitim' => 'Büyük Buhran döneminde iki göçmen işçinin hikayesini anlatan bu roman, dostluk, yalnızlık ve Amerikan Rüyası temalarını işler.',
        'kapak_url' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'Gazap Üzümleri',
        'yazar' => 'John Steinbeck',
        'basim_yili' => 1939,
        'kategori' => 'Edebiyat',
        'sayfa_sayisi' => 464,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767894,
        'tanitim' => 'Büyük Buhran döneminde Oklahoma\'dan Kaliforniya\'ya göç eden bir ailenin hikayesini anlatan bu roman, toplumsal adaletsizlik ve insan dayanışması temalarını işler.',
        'kapak_url' => 'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'Gurur ve Önyargı',
        'yazar' => 'Jane Austen',
        'basim_yili' => 1813,
        'kategori' => 'Edebiyat',
        'sayfa_sayisi' => 432,
        'basim_yeri' => 'Londra, İngiltere',
        'isbn' => 9789750767895,
        'tanitim' => '19. yüzyıl İngiliz toplumunda geçen bu aşk romanı, sosyal sınıflar, evlilik ve kadının toplumdaki yeri temalarını işler.',
        'kapak_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=600&fit=crop'
    ],
    
    // Kişisel Gelişim Kategorisi Kitapları
    [
        'kitap_adi' => 'İkigai',
        'yazar' => 'Héctor García',
        'basim_yili' => 2016,
        'kategori' => 'Kişisel Gelişim',
        'sayfa_sayisi' => 208,
        'basim_yeri' => 'Barselona, İspanya',
        'isbn' => 9789750767896,
        'tanitim' => 'Japon felsefesinden esinlenen bu kitap, yaşam amacını bulma ve uzun ömürlü yaşama sanatını anlatır.',
        'kapak_url' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'Minimalizm',
        'yazar' => 'Joshua Fields Millburn',
        'basim_yili' => 2011,
        'kategori' => 'Kişisel Gelişim',
        'sayfa_sayisi' => 240,
        'basim_yeri' => 'Ohio, ABD',
        'isbn' => 9789750767897,
        'tanitim' => 'Modern yaşamın karmaşasından kurtulmak için minimalizm felsefesini anlatan bu kitap, sade yaşamın faydalarını gösterir.',
        'kapak_url' => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'Atomic Habits',
        'yazar' => 'James Clear',
        'basim_yili' => 2018,
        'kategori' => 'Kişisel Gelişim',
        'sayfa_sayisi' => 320,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767898,
        'tanitim' => 'Küçük alışkanlıkların büyük değişimlere yol açabileceğini anlatan bu kitap, etkili alışkanlık oluşturma yöntemlerini sunar.',
        'kapak_url' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'Deep Work',
        'yazar' => 'Cal Newport',
        'basim_yili' => 2016,
        'kategori' => 'Kişisel Gelişim',
        'sayfa_sayisi' => 304,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767899,
        'tanitim' => 'Dikkat dağınıklığı çağında odaklanma sanatını anlatan bu kitap, derin çalışma tekniklerini öğretir.',
        'kapak_url' => 'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'Mindset',
        'yazar' => 'Carol S. Dweck',
        'basim_yili' => 2006,
        'kategori' => 'Kişisel Gelişim',
        'sayfa_sayisi' => 288,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767900,
        'tanitim' => 'Sabit ve gelişim odaklı zihniyet türlerini inceleyen bu kitap, başarı ve öğrenme süreçlerini anlatır.',
        'kapak_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=600&fit=crop'
    ],
    
    // Kültür & Toplum Kategorisi Kitapları
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
    ],
    
    // Teknoloji Kategorisi Kitapları
    [
        'kitap_adi' => 'The Innovators',
        'yazar' => 'Walter Isaacson',
        'basim_yili' => 2014,
        'kategori' => 'Teknoloji',
        'sayfa_sayisi' => 560,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767906,
        'tanitim' => 'Dijital devrimin öncülerinin hikayelerini anlatan bu kitap, bilgisayar ve internet çağının nasıl başladığını anlatır.',
        'kapak_url' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'Steve Jobs',
        'yazar' => 'Walter Isaacson',
        'basim_yili' => 2011,
        'kategori' => 'Teknoloji',
        'sayfa_sayisi' => 656,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767907,
        'tanitim' => 'Apple\'ın kurucusu Steve Jobs\'ın hayatını anlatan bu biyografi, teknoloji dünyasının en etkili isimlerinden birinin hikayesini sunar.',
        'kapak_url' => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'The Code Book',
        'yazar' => 'Simon Singh',
        'basim_yili' => 1999,
        'kategori' => 'Teknoloji',
        'sayfa_sayisi' => 432,
        'basim_yeri' => 'Londra, İngiltere',
        'isbn' => 9789750767908,
        'tanitim' => 'Şifreleme tarihini anlatan bu kitap, antik çağlardan günümüze kadar şifreleme tekniklerinin gelişimini inceler.',
        'kapak_url' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'The Art of Computer Programming',
        'yazar' => 'Donald E. Knuth',
        'basim_yili' => 1968,
        'kategori' => 'Teknoloji',
        'sayfa_sayisi' => 672,
        'basim_yeri' => 'California, ABD',
        'isbn' => 9789750767909,
        'tanitim' => 'Bilgisayar programlama alanının en kapsamlı eserlerinden biri. Algoritma ve veri yapılarını detaylı bir şekilde anlatır.',
        'kapak_url' => 'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'Clean Code',
        'yazar' => 'Robert C. Martin',
        'basim_yili' => 2008,
        'kategori' => 'Teknoloji',
        'sayfa_sayisi' => 464,
        'basim_yeri' => 'New Jersey, ABD',
        'isbn' => 9789750767910,
        'tanitim' => 'Yazılım geliştirme alanında temiz kod yazma prensiplerini anlatan bu kitap, programcılar için vazgeçilmez bir rehber.',
        'kapak_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=600&fit=crop'
    ],
    
    // Sanat Kategorisi Kitapları
    [
        'kitap_adi' => 'The Story of Art',
        'yazar' => 'E.H. Gombrich',
        'basim_yili' => 1950,
        'kategori' => 'Sanat',
        'sayfa_sayisi' => 688,
        'basim_yeri' => 'Londra, İngiltere',
        'isbn' => 9789750767911,
        'tanitim' => 'Sanat tarihinin en kapsamlı eserlerinden biri. İlk çağlardan günümüze kadar sanatın gelişimini anlatır.',
        'kapak_url' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'Ways of Seeing',
        'yazar' => 'John Berger',
        'basim_yili' => 1972,
        'kategori' => 'Sanat',
        'sayfa_sayisi' => 176,
        'basim_yeri' => 'Londra, İngiltere',
        'isbn' => 9789750767912,
        'tanitim' => 'Görsel sanatları nasıl yorumlayacağımızı öğreten bu kitap, sanat eleştirisi alanında çığır açan bir eser.',
        'kapak_url' => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'The Art Book',
        'yazar' => 'Phaidon Editors',
        'basim_yili' => 1994,
        'kategori' => 'Sanat',
        'sayfa_sayisi' => 512,
        'basim_yeri' => 'Londra, İngiltere',
        'isbn' => 9789750767913,
        'tanitim' => '500 büyük sanatçının eserlerini tanıtan bu kitap, sanat tarihinin en önemli yapıtlarını gözler önüne serer.',
        'kapak_url' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'Art and Visual Perception',
        'yazar' => 'Rudolf Arnheim',
        'basim_yili' => 1954,
        'kategori' => 'Sanat',
        'sayfa_sayisi' => 508,
        'basim_yeri' => 'California, ABD',
        'isbn' => 9789750767914,
        'tanitim' => 'Görsel algı ve sanat arasındaki ilişkiyi inceleyen bu kitap, psikoloji ve sanatın kesişim noktalarını araştırır.',
        'kapak_url' => 'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'The Art of Color',
        'yazar' => 'Johannes Itten',
        'basim_yili' => 1961,
        'kategori' => 'Sanat',
        'sayfa_sayisi' => 96,
        'basim_yeri' => 'Zürih, İsviçre',
        'isbn' => 9789750767915,
        'tanitim' => 'Renk teorisi ve uygulamasını anlatan bu kitap, sanatçılar ve tasarımcılar için temel bir kaynak.',
        'kapak_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=600&fit=crop'
    ],
    
    // Eğitim Kategorisi Kitapları
    [
        'kitap_adi' => 'Pedagogy of the Oppressed',
        'yazar' => 'Paulo Freire',
        'basim_yili' => 1968,
        'kategori' => 'Eğitim',
        'sayfa_sayisi' => 184,
        'basim_yeri' => 'São Paulo, Brezilya',
        'isbn' => 9789750767916,
        'tanitim' => 'Eğitim felsefesi alanında çığır açan bu kitap, ezilenlerin eğitimi konusunu ele alır ve özgürleştirici eğitim yöntemlerini önerir.',
        'kapak_url' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'How Children Learn',
        'yazar' => 'John Holt',
        'basim_yili' => 1967,
        'kategori' => 'Eğitim',
        'sayfa_sayisi' => 320,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767917,
        'tanitim' => 'Çocukların doğal öğrenme süreçlerini inceleyen bu kitap, geleneksel eğitim sisteminin eleştirisini yapar.',
        'kapak_url' => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'The Montessori Method',
        'yazar' => 'Maria Montessori',
        'basim_yili' => 1909,
        'kategori' => 'Eğitim',
        'sayfa_sayisi' => 416,
        'basim_yeri' => 'Roma, İtalya',
        'isbn' => 9789750767918,
        'tanitim' => 'Montessori eğitim yönteminin temellerini anlatan bu kitap, çocuk merkezli eğitim yaklaşımını detaylandırır.',
        'kapak_url' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'Democracy and Education',
        'yazar' => 'John Dewey',
        'basim_yili' => 1916,
        'kategori' => 'Eğitim',
        'sayfa_sayisi' => 378,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767919,
        'tanitim' => 'Demokratik eğitim felsefesini anlatan bu kitap, eğitim ve demokrasi arasındaki ilişkiyi inceler.',
        'kapak_url' => 'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'The Art of Learning',
        'yazar' => 'Josh Waitzkin',
        'basim_yili' => 2007,
        'kategori' => 'Eğitim',
        'sayfa_sayisi' => 288,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767920,
        'tanitim' => 'Satranç şampiyonu ve dövüş sanatları ustası olan yazarın öğrenme süreçlerini anlatan bu kitap, performans psikolojisini inceler.',
        'kapak_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=600&fit=crop'
    ],
    
    // Yaşam Tarzı Kategorisi Kitapları
    [
        'kitap_adi' => 'The Life-Changing Magic of Tidying Up',
        'yazar' => 'Marie Kondo',
        'basim_yili' => 2010,
        'kategori' => 'Yaşam Tarzı',
        'sayfa_sayisi' => 224,
        'basim_yeri' => 'Tokyo, Japonya',
        'isbn' => 9789750767921,
        'tanitim' => 'KonMari yöntemi olarak bilinen düzenleme tekniğini anlatan bu kitap, sadece sevdiğiniz eşyaları tutma felsefesini öğretir.',
        'kapak_url' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'The Power of Habit',
        'yazar' => 'Charles Duhigg',
        'basim_yili' => 2012,
        'kategori' => 'Yaşam Tarzı',
        'sayfa_sayisi' => 371,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767922,
        'tanitim' => 'Alışkanlıkların bilimsel temellerini anlatan bu kitap, iyi alışkanlıklar oluşturma ve kötü alışkanlıkları değiştirme yöntemlerini sunar.',
        'kapak_url' => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'The 4-Hour Workweek',
        'yazar' => 'Timothy Ferriss',
        'basim_yili' => 2007,
        'kategori' => 'Yaşam Tarzı',
        'sayfa_sayisi' => 308,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767923,
        'tanitim' => 'Çalışma hayatını optimize etme ve daha fazla zaman kazanma yöntemlerini anlatan bu kitap, yaşam tarzı tasarımı konusunu ele alır.',
        'kapak_url' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'Essentialism',
        'yazar' => 'Greg McKeown',
        'basim_yili' => 2014,
        'kategori' => 'Yaşam Tarzı',
        'sayfa_sayisi' => 272,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767924,
        'tanitim' => 'Sadece önemli şeylere odaklanma sanatını anlatan bu kitap, hayatı sadeleştirme ve öncelikleri belirleme konusunda rehberlik eder.',
        'kapak_url' => 'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'The Happiness Project',
        'yazar' => 'Gretchen Rubin',
        'basim_yili' => 2009,
        'kategori' => 'Yaşam Tarzı',
        'sayfa_sayisi' => 320,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767925,
        'tanitim' => 'Mutluluk üzerine yapılan bir yıllık deneyi anlatan bu kitap, günlük yaşamda mutluluğu artırma yöntemlerini sunar.',
        'kapak_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=600&fit=crop'
    ],
    
    // Edebiyat Kategorisi - Ek Kitaplar
    [
        'kitap_adi' => 'Dönüşüm',
        'yazar' => 'Franz Kafka',
        'basim_yili' => 1915,
        'kategori' => 'Edebiyat',
        'sayfa_sayisi' => 128,
        'basim_yeri' => 'Prag, Çek Cumhuriyeti',
        'isbn' => 9789750767926,
        'tanitim' => 'Gregor Samsa\'nın bir sabah kendini dev bir böceğe dönüşmüş bulmasıyla başlayan bu roman, modern edebiyatın en etkileyici alegorilerinden biridir.',
        'kapak_url' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'Yabancı',
        'yazar' => 'Albert Camus',
        'basim_yili' => 1942,
        'kategori' => 'Edebiyat',
        'sayfa_sayisi' => 184,
        'basim_yeri' => 'Paris, Fransa',
        'isbn' => 9789750767927,
        'tanitim' => 'Meursault\'nun annesinin ölümü ve sonrasında işlediği cinayet etrafında gelişen bu roman, absürdizm ve varoluşçuluk temalarını işler.',
        'kapak_url' => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'Küçük Prens',
        'yazar' => 'Antoine de Saint-Exupéry',
        'basim_yili' => 1943,
        'kategori' => 'Edebiyat',
        'sayfa_sayisi' => 96,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767928,
        'tanitim' => 'Küçük bir prensin farklı gezegenlerde yaşadığı maceraları anlatan bu alegorik eser, sevgi, dostluk ve yaşamın anlamı üzerine düşündürür.',
        'kapak_url' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'Şeker Portakalı',
        'yazar' => 'José Mauro de Vasconcelos',
        'basim_yili' => 1968,
        'kategori' => 'Edebiyat',
        'sayfa_sayisi' => 184,
        'basim_yeri' => 'Rio de Janeiro, Brezilya',
        'isbn' => 9789750767929,
        'tanitim' => 'Beş yaşındaki Zeze\'nin yoksulluk içinde geçen çocukluğunu anlatan bu roman, umut ve hayal gücünün gücünü gösterir.',
        'kapak_url' => 'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=400&h=600&fit=crop'
    ],

    
    // Kişisel Gelişim Kategorisi - Ek Kitaplar
    [
        'kitap_adi' => 'Rich Dad Poor Dad',
        'yazar' => 'Robert T. Kiyosaki',
        'basim_yili' => 1997,
        'kategori' => 'Kişisel Gelişim',
        'sayfa_sayisi' => 336,
        'basim_yeri' => 'Hawaii, ABD',
        'isbn' => 9789750767931,
        'tanitim' => 'İki farklı babanın para ve yatırım konusundaki farklı yaklaşımlarını anlatan bu kitap, finansal okuryazarlık konusunda rehberlik eder.',
        'kapak_url' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'Think and Grow Rich',
        'yazar' => 'Napoleon Hill',
        'basim_yili' => 1937,
        'kategori' => 'Kişisel Gelişim',
        'sayfa_sayisi' => 256,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767932,
        'tanitim' => 'Başarılı insanların ortak özelliklerini inceleyen bu klasik eser, zihinsel güç ve başarı prensiplerini öğretir.',
        'kapak_url' => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'How to Win Friends and Influence People',
        'yazar' => 'Dale Carnegie',
        'basim_yili' => 1936,
        'kategori' => 'Kişisel Gelişim',
        'sayfa_sayisi' => 288,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767933,
        'tanitim' => 'İnsan ilişkileri ve iletişim konusunda çığır açan bu kitap, etkili iletişim tekniklerini öğretir.',
        'kapak_url' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'The 7 Habits of Highly Effective People',
        'yazar' => 'Stephen R. Covey',
        'basim_yili' => 1989,
        'kategori' => 'Kişisel Gelişim',
        'sayfa_sayisi' => 432,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767934,
        'tanitim' => 'Etkili insanların yedi alışkanlığını anlatan bu kitap, kişisel ve profesyonel başarı için rehberlik eder.',
        'kapak_url' => 'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'Awaken the Giant Within',
        'yazar' => 'Tony Robbins',
        'basim_yili' => 1991,
        'kategori' => 'Kişisel Gelişim',
        'sayfa_sayisi' => 544,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767935,
        'tanitim' => 'İç gücü uyandırma ve potansiyeli ortaya çıkarma konusunda yazılmış bu kitap, motivasyon ve kişisel güç konularını ele alır.',
        'kapak_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=600&fit=crop'
    ],
    
    // Kültür & Toplum Kategorisi - Ek Kitaplar
    [
        'kitap_adi' => 'Freakonomics',
        'yazar' => 'Steven D. Levitt',
        'basim_yili' => 2005,
        'kategori' => 'Kültür & Toplum',
        'sayfa_sayisi' => 320,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767936,
        'tanitim' => 'Ekonomi ve sosyolojiyi birleştiren bu kitap, günlük hayattaki olayları ekonomik açıdan analiz eder.',
        'kapak_url' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'The Black Swan',
        'yazar' => 'Nassim Nicholas Taleb',
        'basim_yili' => 2007,
        'kategori' => 'Kültür & Toplum',
        'sayfa_sayisi' => 400,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767937,
        'tanitim' => 'Beklenmedik olayların etkisini inceleyen bu kitap, belirsizlik ve risk yönetimi konularını ele alır.',
        'kapak_url' => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'Predictably Irrational',
        'yazar' => 'Dan Ariely',
        'basim_yili' => 2008,
        'kategori' => 'Kültür & Toplum',
        'sayfa_sayisi' => 304,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767938,
        'tanitim' => 'İnsan davranışlarının mantıksız yönlerini inceleyen bu kitap, davranışsal ekonomi alanında önemli bir eser.',
        'kapak_url' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'The Wisdom of Crowds',
        'yazar' => 'James Surowiecki',
        'basim_yili' => 2004,
        'kategori' => 'Kültür & Toplum',
        'sayfa_sayisi' => 296,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767939,
        'tanitim' => 'Kitlelerin bilgeliğini inceleyen bu kitap, kolektif zeka ve karar verme süreçlerini analiz eder.',
        'kapak_url' => 'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'Nudge',
        'yazar' => 'Richard H. Thaler',
        'basim_yili' => 2008,
        'kategori' => 'Kültür & Toplum',
        'sayfa_sayisi' => 320,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767940,
        'tanitim' => 'Davranışsal ekonomi alanında önemli bir eser olan bu kitap, insan kararlarını etkileme yöntemlerini anlatır.',
        'kapak_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=600&fit=crop'
    ],
    
    // Teknoloji Kategorisi - Ek Kitaplar
    [
        'kitap_adi' => 'The Singularity Is Near',
        'yazar' => 'Ray Kurzweil',
        'basim_yili' => 2005,
        'kategori' => 'Teknoloji',
        'sayfa_sayisi' => 672,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767941,
        'tanitim' => 'Teknolojik tekillik kavramını inceleyen bu kitap, yapay zeka ve gelecek teknolojileri hakkında vizyon sunar.',
        'kapak_url' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'The Future of the Mind',
        'yazar' => 'Michio Kaku',
        'basim_yili' => 2014,
        'kategori' => 'Teknoloji',
        'sayfa_sayisi' => 400,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767942,
        'tanitim' => 'Beyin bilimi ve teknoloji alanındaki gelişmeleri inceleyen bu kitap, zihin kontrolü ve beyin-bilgisayar arayüzleri konularını ele alır.',
        'kapak_url' => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'The Master Algorithm',
        'yazar' => 'Pedro Domingos',
        'basim_yili' => 2015,
        'kategori' => 'Teknoloji',
        'sayfa_sayisi' => 352,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767943,
        'tanitim' => 'Makine öğrenmesi alanındaki farklı yaklaşımları inceleyen bu kitap, yapay zeka ve öğrenme algoritmaları konularını ele alır.',
        'kapak_url' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'Superintelligence',
        'yazar' => 'Nick Bostrom',
        'basim_yili' => 2014,
        'kategori' => 'Teknoloji',
        'sayfa_sayisi' => 352,
        'basim_yeri' => 'Oxford, İngiltere',
        'isbn' => 9789750767944,
        'tanitim' => 'Süper zeka kavramını ve potansiyel risklerini inceleyen bu kitap, yapay zeka güvenliği konularını ele alır.',
        'kapak_url' => 'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'The Inevitable',
        'yazar' => 'Kevin Kelly',
        'basim_yili' => 2016,
        'kategori' => 'Teknoloji',
        'sayfa_sayisi' => 336,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767945,
        'tanitim' => 'Teknolojik gelişmelerin kaçınılmaz yönlerini inceleyen bu kitap, gelecekte bizi bekleyen teknolojik değişimleri analiz eder.',
        'kapak_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=600&fit=crop'
    ],
    
    // Sanat Kategorisi - Ek Kitaplar
    [
        'kitap_adi' => 'The Art of the Deal',
        'yazar' => 'Donald J. Trump',
        'basim_yili' => 1987,
        'kategori' => 'Sanat',
        'sayfa_sayisi' => 384,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767946,
        'tanitim' => 'İş dünyasında başarılı olma stratejilerini anlatan bu kitap, pazarlık ve iş yapma sanatını öğretir.',
        'kapak_url' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'The Art of War',
        'yazar' => 'Sun Tzu',
        'basim_yili' => -500,
        'kategori' => 'Sanat',
        'sayfa_sayisi' => 128,
        'basim_yeri' => 'Çin',
        'isbn' => 9789750767947,
        'tanitim' => 'Antik Çin\'den gelen bu strateji kitabı, savaş sanatının temel prensiplerini öğretir ve günümüzde iş dünyasında da kullanılır.',
        'kapak_url' => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'The Art of Happiness',
        'yazar' => 'Dalai Lama',
        'basim_yili' => 1998,
        'kategori' => 'Sanat',
        'sayfa_sayisi' => 320,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767948,
        'tanitim' => 'Dalai Lama\'nın mutluluk üzerine görüşlerini paylaştığı bu kitap, iç huzur ve mutluluk sanatını öğretir.',
        'kapak_url' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'The Art of Loving',
        'yazar' => 'Erich Fromm',
        'basim_yili' => 1956,
        'kategori' => 'Sanat',
        'sayfa_sayisi' => 176,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767949,
        'tanitim' => 'Sevme sanatını inceleyen bu psikolojik eser, aşk ve insan ilişkileri konularında derinlemesine analiz sunar.',
        'kapak_url' => 'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'The Art of Living',
        'yazar' => 'Epictetus',
        'basim_yili' => 100,
        'kategori' => 'Sanat',
        'sayfa_sayisi' => 128,
        'basim_yeri' => 'Antik Yunan',
        'isbn' => 9789750767950,
        'tanitim' => 'Stoik felsefenin temel prensiplerini anlatan bu klasik eser, yaşama sanatı konusunda rehberlik eder.',
        'kapak_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=600&fit=crop'
    ],
    
    // Eğitim Kategorisi - Ek Kitaplar

    [
        'kitap_adi' => 'Make It Stick',
        'yazar' => 'Peter C. Brown',
        'basim_yili' => 2014,
        'kategori' => 'Eğitim',
        'sayfa_sayisi' => 336,
        'basim_yeri' => 'Massachusetts, ABD',
        'isbn' => 9789750767952,
        'tanitim' => 'Bilimsel araştırmalara dayalı öğrenme tekniklerini anlatan bu kitap, etkili öğrenme yöntemlerini öğretir.',
        'kapak_url' => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'A Mind for Numbers',
        'yazar' => 'Barbara Oakley',
        'basim_yili' => 2014,
        'kategori' => 'Eğitim',
        'sayfa_sayisi' => 336,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767953,
        'tanitim' => 'Matematik ve fen bilimleri öğrenme konusunda yazılmış bu kitap, zor konuları öğrenme tekniklerini sunar.',
        'kapak_url' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'Learning How to Learn',
        'yazar' => 'Barbara Oakley',
        'basim_yili' => 2018,
        'kategori' => 'Eğitim',
        'sayfa_sayisi' => 256,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767954,
        'tanitim' => 'Öğrenme süreçlerini optimize etme konusunda yazılmış bu kitap, beyin bilimi ve öğrenme tekniklerini birleştirir.',
        'kapak_url' => 'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'The Talent Code',
        'yazar' => 'Daniel Coyle',
        'basim_yili' => 2009,
        'kategori' => 'Eğitim',
        'sayfa_sayisi' => 256,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767955,
        'tanitim' => 'Yetenek geliştirme süreçlerini inceleyen bu kitap, beceri kazanma ve uzmanlaşma konularını ele alır.',
        'kapak_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=600&fit=crop'
    ],
    
    // Yaşam Tarzı Kategorisi - Ek Kitaplar
    [
        'kitap_adi' => 'The Subtle Art of Not Giving a F*ck',
        'yazar' => 'Mark Manson',
        'basim_yili' => 2016,
        'kategori' => 'Yaşam Tarzı',
        'sayfa_sayisi' => 224,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767956,
        'tanitim' => 'Modern yaşamın karmaşasından kurtulma konusunda yazılmış bu kitap, öncelikleri belirleme ve gereksiz endişelerden kurtulma yöntemlerini öğretir.',
        'kapak_url' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'Big Magic',
        'yazar' => 'Elizabeth Gilbert',
        'basim_yili' => 2015,
        'kategori' => 'Yaşam Tarzı',
        'sayfa_sayisi' => 288,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767957,
        'tanitim' => 'Yaratıcılık ve ilham konularını ele alan bu kitap, sanatçılar ve yaratıcı kişiler için rehberlik eder.',
        'kapak_url' => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'The Life-Changing Magic of Not Giving a F*ck',
        'yazar' => 'Sarah Knight',
        'basim_yili' => 2015,
        'kategori' => 'Yaşam Tarzı',
        'sayfa_sayisi' => 256,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767958,
        'tanitim' => 'Gereksiz endişelerden kurtulma ve öncelikleri belirleme konusunda yazılmış bu kitap, sade yaşam felsefesini öğretir.',
        'kapak_url' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'The Power of Now',
        'yazar' => 'Eckhart Tolle',
        'basim_yili' => 1997,
        'kategori' => 'Yaşam Tarzı',
        'sayfa_sayisi' => 236,
        'basim_yeri' => 'New York, ABD',
        'isbn' => 9789750767959,
        'tanitim' => 'Şimdiki anın gücünü anlatan bu spiritüel kitap, farkındalık ve iç huzur konularında rehberlik eder.',
        'kapak_url' => 'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=400&h=600&fit=crop'
    ],
    [
        'kitap_adi' => 'The Four Agreements',
        'yazar' => 'Don Miguel Ruiz',
        'basim_yili' => 1997,
        'kategori' => 'Yaşam Tarzı',
        'sayfa_sayisi' => 160,
        'basim_yeri' => 'California, ABD',
        'isbn' => 9789750767960,
        'tanitim' => 'Toltek bilgeliğinden esinlenen bu kitap, kişisel özgürlük ve mutluluk için dört temel anlaşmayı öğretir.',
        'kapak_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=600&fit=crop'
    ]
];

// Kitapları veritabanına ekle
$stmt = $pdo->prepare("INSERT INTO kitaplar (kitap_adi, yazar, basim_yili, kategori, sayfa_sayisi, basim_yeri, isbn, tanitim, kapak_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

$basarili = 0;
$hatali = 0;

foreach ($kitaplar as $kitap) {
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
echo "📚 Toplam: " . count($kitaplar) . " kitap işlendi.<br><br>";

// Veritabanındaki tüm kitapları listele
echo "📋 <strong>Veritabanındaki Tüm Kitaplar:</strong><br>";
$stmt = $pdo->query("SELECT * FROM kitaplar ORDER BY id");
$kitaplar_liste = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($kitaplar_liste as $kitap) {
    echo "📖 ID: {$kitap['id']} | {$kitap['kitap_adi']} - {$kitap['yazar']} ({$kitap['basim_yili']})<br>";
}

echo "<br>🎉 İşlem tamamlandı!";
?>
