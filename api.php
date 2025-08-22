<?php
// Basit log ekle
error_log("=== API ÇAĞRILDI ===");
error_log("REQUEST_METHOD: " . $_SERVER["REQUEST_METHOD"]);
error_log("GET parametreleri: " . json_encode($_GET));
error_log("POST parametreleri: " . json_encode($_POST));

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, DELETE, PUT");
header("Access-Control-Allow-Headers: Content-Type");
$baglanti = new mysqli("localhost", "root", "", "basit_sistem");

if ($baglanti->connect_error) {
    error_log("Veritabanı bağlantı hatası: " . $baglanti->connect_error);
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Veritabanına bağlanılamadı: " . $baglanti->connect_error]);
    exit;
}

error_log("Veritabanı bağlantısı başarılı");

// MİMARİ ENDPOINT'LERİ - EN BAŞA TAŞI
if (isset($_GET["mimari"])) {
    error_log("=== MİMARİ ENDPOINT BAŞLADI ===");
    error_log("Mimari endpoint çağrıldı");
    if (isset($_GET["id"])) {
        // Belirli mimari eseri getir
        $id = (int)$_GET["id"];
        $sonuc = $baglanti->query("SELECT * FROM mimari WHERE id = $id");
        if ($sonuc && $sonuc->num_rows > 0) {
            $eser = $sonuc->fetch_assoc();
            echo json_encode($eser);
        } else {
            echo json_encode(["error" => "Mimari eser bulunamadı"]);
        }
        exit;
    } else {
        // Tüm mimari eserleri getir (limit desteği ile)
        $limit = isset($_GET["limit"]) ? (int)$_GET["limit"] : 0;
        $query = "SELECT * FROM mimari ORDER BY id DESC";
        if ($limit > 0) {
            $query .= " LIMIT $limit";
        }
        error_log("SQL sorgusu: " . $query);
        $sonuc = $baglanti->query($query);
        
        if (!$sonuc) {
            error_log("❌ SQL hatası: " . $baglanti->error);
            echo json_encode([]);
            exit;
        }
        
        error_log("✅ SQL sorgusu başarılı");
        error_log("📊 Bulunan satır sayısı: " . $sonuc->num_rows);
        
        $eserler = [];
        while ($satir = $sonuc->fetch_assoc()) {
            $eserler[] = $satir;
            error_log("🏗️ Mimari eser verisi: " . json_encode($satir));
        }
        
        error_log("✅ Bulunan eser sayısı: " . count($eserler));
        error_log("📤 JSON yanıtı: " . json_encode($eserler));
        echo json_encode($eserler);
        error_log("=== MİMARİ ENDPOINT BİTTİ ===");
        exit;
    }
}

// MÜZİK ENDPOINT'LERİ - EN BAŞA TAŞI
if (isset($_GET["muzik"])) {
    error_log("=== MÜZİK ENDPOINT BAŞLADI ===");
    error_log("Müzik endpoint çağrıldı");
    error_log("GET parametreleri: " . json_encode($_GET));
    
    if (isset($_GET["tur"])) {
        // Belirli türdeki şarkıları getir
        $tur = $baglanti->real_escape_string($_GET["tur"]);
        $query = "SELECT * FROM muzikler WHERE tur = '$tur' ORDER BY yayin_yili DESC";
        error_log("SQL sorgusu: " . $query);
        $sonuc = $baglanti->query($query);
        
        if (!$sonuc) {
            error_log("❌ SQL hatası: " . $baglanti->error);
            echo json_encode([]);
            exit;
        }
        
        error_log("✅ SQL sorgusu başarılı");
        error_log("📊 Bulunan satır sayısı: " . $sonuc->num_rows);
        
        $sarkilar = [];
        while ($satir = $sonuc->fetch_assoc()) {
            $sarkilar[] = $satir;
            error_log("🎵 Şarkı verisi: " . json_encode($satir));
        }
        
        error_log("✅ Bulunan şarkı sayısı: " . count($sarkilar));
        error_log("📤 JSON yanıtı: " . json_encode($sarkilar));
        echo json_encode($sarkilar);
        error_log("=== MÜZİK ENDPOINT BİTTİ ===");
        exit;
    } elseif (isset($_GET["id"])) {
        // Belirli şarkıyı getir (ID veya başlık ile)
        $id = $baglanti->real_escape_string($_GET["id"]);
        
        // Önce ID ile ara
        $sonuc = $baglanti->query("SELECT * FROM muzikler WHERE id = '$id'");
        
        // ID ile bulunamazsa başlık ile ara
        if (!$sonuc || $sonuc->num_rows == 0) {
            $baslik = str_replace('-', ' ', $id); // URL'deki tireleri boşluğa çevir
            $sonuc = $baglanti->query("SELECT * FROM muzikler WHERE LOWER(muzik_adi) LIKE LOWER('%$baslik%')");
        }
        
        if ($sonuc && $sonuc->num_rows > 0) {
            $sarki = $sonuc->fetch_assoc();
            echo json_encode($sarki);
        } else {
            echo json_encode(["error" => "Şarkı bulunamadı"]);
        }
        exit;
    } else {
        // Tüm şarkıları getir
        $sonuc = $baglanti->query("SELECT * FROM muzikler ORDER BY yayin_yili DESC");
        $sarkilar = [];
        while ($satir = $sonuc->fetch_assoc()) {
            $sarkilar[] = $satir;
        }
        echo json_encode($sarkilar);
        exit;
    }
}

// MÜZİK TÜRLERİ ENDPOINT'İ
if (isset($_GET["muzik_turleri"])) {
    error_log("=== MÜZİK TÜRLERİ ENDPOINT BAŞLADI ===");
    error_log("Müzik türleri endpoint çağrıldı");
    
    $query = "SELECT DISTINCT tur, COUNT(*) as sarki_sayisi FROM muzikler GROUP BY tur ORDER BY sarki_sayisi DESC";
    error_log("SQL sorgusu: " . $query);
    $sonuc = $baglanti->query($query);
    
    if (!$sonuc) {
        error_log("❌ SQL hatası: " . $baglanti->error);
        echo json_encode([]);
        exit;
    }
    
    error_log("✅ SQL sorgusu başarılı");
    error_log("📊 Bulunan satır sayısı: " . $sonuc->num_rows);
    
    $turler = [];
    while ($satir = $sonuc->fetch_assoc()) {
        $turler[] = $satir;
        error_log("🎼 Tür verisi: " . json_encode($satir));
    }
    
    error_log("✅ Bulunan tür sayısı: " . count($turler));
    error_log("📤 JSON yanıtı: " . json_encode($turler));
    echo json_encode($turler);
    error_log("=== MÜZİK TÜRLERİ ENDPOINT BİTTİ ===");
    exit;
}

// Film API endpoint'leri
if (isset($_GET["films"])) {
    if (isset($_GET["kategori"])) {
        // Belirli kategorideki filmleri getir
        $kategori = $baglanti->real_escape_string($_GET["kategori"]);
        $sonuc = $baglanti->query("SELECT * FROM filmler WHERE kategori = '$kategori' ORDER BY imdb_puani DESC");
        $filmler = [];
        while ($satir = $sonuc->fetch_assoc()) {
            $filmler[] = $satir;
        }
        echo json_encode($filmler);
        exit;
    } elseif (isset($_GET["id"])) {
        // Belirli filmi getir
        $id = (int)$_GET["id"];
        $sonuc = $baglanti->query("SELECT * FROM filmler WHERE id = $id");
        if ($sonuc && $sonuc->num_rows > 0) {
            $film = $sonuc->fetch_assoc();
            echo json_encode($film);
        } else {
            echo json_encode(["error" => "Film bulunamadı"]);
        }
        exit;
    } else {
        // Tüm filmleri getir
        $sonuc = $baglanti->query("SELECT * FROM filmler ORDER BY imdb_puani DESC");
        $filmler = [];
        while ($satir = $sonuc->fetch_assoc()) {
            $filmler[] = $satir;
        }
        echo json_encode($filmler);
        exit;
    }
}

// Tiyatro API endpoint'leri
if (isset($_GET["tiyatro"])) {
    if (isset($_GET["kategoriler"])) {
        // Tiyatro kategorilerini getir
        $sonuc = $baglanti->query("SELECT DISTINCT tur FROM tiyatro_eserleri ORDER BY tur");
        $kategoriler = [];
        while ($satir = $sonuc->fetch_assoc()) {
            $kategoriler[] = $satir["tur"];
        }
        echo json_encode($kategoriler);
        exit;
    } elseif (isset($_GET["tur"])) {
        // Belirli türdeki tiyatro eserlerini getir
        $tur = $baglanti->real_escape_string($_GET["tur"]);
        $sonuc = $baglanti->query("SELECT * FROM tiyatro_eserleri WHERE tur = '$tur' ORDER BY puan DESC");
        $tiyatro_eserleri = [];
        while ($satir = $sonuc->fetch_assoc()) {
            $tiyatro_eserleri[] = $satir;
        }
        echo json_encode($tiyatro_eserleri);
        exit;
    } elseif (isset($_GET["id"])) {
        // Belirli tiyatro eserini getir
        $id = (int)$_GET["id"];
        $sonuc = $baglanti->query("SELECT * FROM tiyatro_eserleri WHERE id = $id");
        if ($sonuc && $sonuc->num_rows > 0) {
            $tiyatro_eseri = $sonuc->fetch_assoc();
            echo json_encode($tiyatro_eseri);
        } else {
            echo json_encode(["error" => "Tiyatro eseri bulunamadı"]);
        }
        exit;
    } else {
        // Tüm tiyatro eserlerini getir (limit desteği ile)
        $limit = isset($_GET["limit"]) ? (int)$_GET["limit"] : 0;
        
        // Tabloların varlığını kontrol et
        $tablo_kontrol = $baglanti->query("SHOW TABLES LIKE 'tiyatro_eserleri'");
        if ($tablo_kontrol->num_rows == 0) {
            error_log("tiyatro_eserleri tablosu bulunamadı");
            echo json_encode([]);
            exit;
        }
        
        $query = "SELECT * FROM tiyatro_eserleri ORDER BY puan DESC";
        if ($limit > 0) {
            $query .= " LIMIT $limit";
        }
        $sonuc = $baglanti->query($query);
        $tiyatro_eserleri = [];
        while ($satir = $sonuc->fetch_assoc()) {
            $tiyatro_eserleri[] = $satir;
        }
        echo json_encode($tiyatro_eserleri);
        exit;
    }
}

// GET: Yönetici Kontrolü
if (isset($_GET["islem"]) && $_GET["islem"] === "yonetici_kontrol") {
    $sorgu = $baglanti->query("SELECT COUNT(*) AS sayi FROM kisiler WHERE rol = 'admin'");
    $satir = $sorgu->fetch_assoc();
    echo json_encode(["yoneticiVar" => $satir["sayi"] > 0]);
    exit;
}

// GET: Belgesel endpoint'leri (önce kontrol et)
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["belgesel"])) {
    header("Content-Type: application/json");
    
    if (isset($_GET["kategoriler"])) {
        // Belgesel kategorilerini getir
        $sonuc = $baglanti->query("SELECT DISTINCT tur FROM belgeseller ORDER BY tur");
        $kategoriler = [];
        while ($satir = $sonuc->fetch_assoc()) {
            $kategoriler[] = $satir["tur"];
        }
        echo json_encode($kategoriler);
        exit;
    } elseif (isset($_GET["tur"])) {
        // Belirli türdeki belgeselleri getir
        $tur = $baglanti->real_escape_string($_GET["tur"]);
        $sonuc = $baglanti->query("SELECT * FROM belgeseller WHERE tur = '$tur' ORDER BY puan DESC");
        $belgeseller = [];
        while ($satir = $sonuc->fetch_assoc()) {
            $belgeseller[] = $satir;
        }
        echo json_encode($belgeseller);
        exit;
    } elseif (isset($_GET["id"])) {
        // Belirli belgeseli getir
        $id = (int)$_GET["id"];
        $sonuc = $baglanti->query("SELECT * FROM belgeseller WHERE id = $id");
        if ($sonuc && $sonuc->num_rows > 0) {
            $belgesel = $sonuc->fetch_assoc();
            echo json_encode($belgesel);
        } else {
            echo json_encode(["error" => "Belgesel bulunamadı"]);
        }
        exit;
    } else {
        // Tüm belgeselleri getir (limit desteği ile)
        $limit = isset($_GET["limit"]) ? (int)$_GET["limit"] : 0;
        
        // Tabloların varlığını kontrol et
        $tablo_kontrol = $baglanti->query("SHOW TABLES LIKE 'belgeseller'");
        if ($tablo_kontrol->num_rows == 0) {
            error_log("belgeseller tablosu bulunamadı");
            echo json_encode([]);
            exit;
        }
        
        $query = "SELECT * FROM belgeseller ORDER BY puan DESC";
        if ($limit > 0) {
            $query .= " LIMIT $limit";
        }
        $sonuc = $baglanti->query($query);
        $belgeseller = [];
        while ($satir = $sonuc->fetch_assoc()) {
            $belgeseller[] = $satir;
        }
        echo json_encode($belgeseller);
        exit;
    }
}

// ESKİ YORUM ENDPOINT'LERİ SİLİNDİ - ÇAKIŞMA ÖNLENDİ

// GET: Anime endpoint'leri (önce kontrol et)
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["anime"])) {
    header("Content-Type: application/json");
    
    if (isset($_GET["kategoriler"])) {
        // Anime kategorilerini getir
        $sonuc = $baglanti->query("SELECT DISTINCT tur FROM animeler ORDER BY tur");
        $kategoriler = [];
        while ($satir = $sonuc->fetch_assoc()) {
            $kategoriler[] = $satir["tur"];
        }
        echo json_encode($kategoriler);
        exit;
    } elseif (isset($_GET["tur"])) {
        // Belirli türdeki animeleri getir
        $tur = $baglanti->real_escape_string($_GET["tur"]);
        $sonuc = $baglanti->query("SELECT * FROM animeler WHERE tur LIKE '%$tur%' ORDER BY puan DESC");
        $animeler = [];
        while ($satir = $sonuc->fetch_assoc()) {
            $animeler[] = $satir;
        }
        echo json_encode($animeler);
        exit;
    } elseif (isset($_GET["id"])) {
        // Belirli animeyi getir
        $id = (int)$_GET["id"];
        $sonuc = $baglanti->query("SELECT * FROM animeler WHERE id = $id");
        if ($sonuc && $sonuc->num_rows > 0) {
            $anime = $sonuc->fetch_assoc();
            echo json_encode($anime);
        } else {
            echo json_encode(["error" => "Anime bulunamadı"]);
        }
        exit;
    } else {
        // Tüm animeleri getir (limit desteği ile)
        $limit = isset($_GET["limit"]) ? (int)$_GET["limit"] : 0;
        
        // Tabloların varlığını kontrol et
        $tablo_kontrol = $baglanti->query("SHOW TABLES LIKE 'animeler'");
        if ($tablo_kontrol->num_rows == 0) {
            error_log("animeler tablosu bulunamadı");
            echo json_encode([]);
            exit;
        }
        
        $query = "SELECT * FROM animeler ORDER BY puan DESC";
        if ($limit > 0) {
            $query .= " LIMIT $limit";
        }
        $sonuc = $baglanti->query($query);
        $animeler = [];
        while ($satir = $sonuc->fetch_assoc()) {
            $animeler[] = $satir;
        }
        echo json_encode($animeler);
        exit;
    }
}

// GET: Kullanıcıları getir
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["kisiler"])) {
    header("Content-Type: application/json");
    error_log("Kisiler endpoint çağrıldı");
    
    $sonuc = $baglanti->query("SELECT id, username, adsoyad, e_posta, rol FROM kisiler ORDER BY CASE WHEN rol = 'admin' THEN 0 ELSE 1 END, id ASC");
    $kisiler = [];
    while ($satir = $sonuc->fetch_assoc()) {
        $kisiler[] = $satir;
    }
    error_log("Bulunan kullanıcı sayısı: " . count($kisiler));
    echo json_encode($kisiler);
    exit;
}

        // GET: Listeleme (varsayılan) - Sadece belirli parametreler yoksa
        if ($_SERVER["REQUEST_METHOD"] === "GET" && !isset($_GET["yorum"]) && !isset($_GET["films"]) && !isset($_GET["tiyatro"]) && !isset($_GET["belgesel"]) && !isset($_GET["anime"]) && !isset($_GET["son_yorumlar"]) && !isset($_GET["tum_yorumlar"]) && !isset($_GET["kisiler"]) && !isset($_GET["muzik"]) && !isset($_GET["muzik_turleri"]) && !isset($_GET["mimari"]) && !isset($_GET["fotograf"]) && !isset($_GET["dans"]) && !isset($_GET["yemek"]) && !isset($_GET["dunya_mutfagi"]) && !isset($_GET["tatlilar_hamur"]) && !isset($_GET["pratik_tarifler"]) && !isset($_GET["saglikli_besinler"])) {
    $sonuc = $baglanti->query("SELECT id, username, adsoyad, e_posta, rol FROM kisiler ORDER BY CASE WHEN rol = 'admin' THEN 0 ELSE 1 END, id ASC");
    $kisiler = [];
    while ($satir = $sonuc->fetch_assoc()) {
        $kisiler[] = $satir;
    }
    echo json_encode($kisiler);
    exit;
}

// POST: Yorum ekle
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_GET["yorum"])) {
    header("Content-Type: application/json");
    error_log("Yorum ekleme endpoint'i çağrıldı");
    
    // Yorum tablosunun varlığını kontrol et
    $tablo_kontrol = $baglanti->query("SHOW TABLES LIKE 'yorumlar'");
    if ($tablo_kontrol->num_rows == 0) {
        error_log("yorumlar tablosu bulunamadı!");
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Yorum tablosu bulunamadı"]);
        exit;
    }
    
    $girdi = json_decode(file_get_contents("php://input"), true);
    error_log("Gelen veri: " . json_encode($girdi));
    
    if (!isset($girdi["kullanici_id"]) || !isset($girdi["kullanici_adi"]) || 
        !isset($girdi["tur"]) || !isset($girdi["icerik_id"]) || 
        !isset($girdi["icerik_adi"]) || !isset($girdi["yorum"]) || 
        !isset($girdi["puan"])) {
        error_log("Eksik parametreler tespit edildi");
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Eksik parametreler"]);
        exit;
    }
    
    $kullanici_id = (int)$girdi["kullanici_id"];
    $kullanici_adi = $baglanti->real_escape_string($girdi["kullanici_adi"]);
    $tur = $baglanti->real_escape_string($girdi["tur"]);
    $icerik_id = (int)$girdi["icerik_id"];
    $icerik_adi = $baglanti->real_escape_string($girdi["icerik_adi"]);
    $yorum = $baglanti->real_escape_string(trim($girdi["yorum"]));
    $puan = (int)$girdi["puan"];
    $spoiler = isset($girdi["spoiler"]) ? (int)$girdi["spoiler"] : 0;
    
    // Validasyon
    if ($puan < 1 || $puan > 10) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Puan 1-10 arasında olmalıdır"]);
        exit;
    }
    

    
    // Spoiler sütunu varsa dinamik şekilde ekle
    $spoilerKolonuVar = false;
    $kolonKontrol = $baglanti->query("SHOW COLUMNS FROM yorumlar LIKE 'spoiler'");
    if ($kolonKontrol && $kolonKontrol->num_rows > 0) {
        $spoilerKolonuVar = true;
    }

    if ($spoilerKolonuVar) {
        $sql = "INSERT INTO yorumlar (kullanici_id, kullanici_adi, tur, icerik_id, icerik_adi, yorum, puan, spoiler, created_at) 
                VALUES ($kullanici_id, '$kullanici_adi', '$tur', $icerik_id, '$icerik_adi', '$yorum', $puan, $spoiler, NOW())";
    } else {
        $sql = "INSERT INTO yorumlar (kullanici_id, kullanici_adi, tur, icerik_id, icerik_adi, yorum, puan, created_at) 
                VALUES ($kullanici_id, '$kullanici_adi', '$tur', $icerik_id, '$icerik_adi', '$yorum', $puan, NOW())";
    }
    
    error_log("SQL sorgusu: " . $sql);
    
    if ($baglanti->query($sql)) {
        error_log("Yorum başarıyla eklendi");
        echo json_encode(["success" => true, "message" => "Yorum başarıyla eklendi"]);
    } else {
        error_log("Yorum eklenirken hata: " . $baglanti->error);
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Yorum eklenirken hata: " . $baglanti->error]);
    }
    exit;
}

// POST: İletişim mesajı
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_GET["iletisim"])) {
    error_log("İletişim endpoint'i çağrıldı");
    
    try {
        // JSON header'ı ekle
        header('Content-Type: application/json');
        
        $girdi = json_decode(file_get_contents("php://input"), true);

        // Debug: Gelen veriyi logla
        error_log("İletişim verisi: " . json_encode($girdi));

    // Parametre kontrolü
    if (!isset($girdi["username"]) || empty($girdi["username"])) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Ad soyad alanı boş bırakılamaz."]);
        exit;
    }
    
    if (!isset($girdi["email"]) || empty($girdi["email"])) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "E-posta alanı boş bırakılamaz."]);
        exit;
    }

    // E-posta formatı kontrolü
    if (!filter_var($girdi["email"], FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Geçerli bir e-posta adresi giriniz."]);
        exit;
    }

    if (!isset($girdi["konu"]) || empty($girdi["konu"])) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Konu alanı boş bırakılamaz."]);
        exit;
    }

    if (!isset($girdi["message"]) || empty($girdi["message"])) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Mesaj alanı boş bırakılamaz."]);
        exit;
    }

    if (strlen($girdi["message"]) > 300) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Mesaj 300 karakterden uzun olamaz."]);
        exit;
    }

    $username = $baglanti->real_escape_string($girdi["username"]);
    $email = $baglanti->real_escape_string($girdi["email"]);
    $konu = $baglanti->real_escape_string($girdi["konu"]);
    $message = $baglanti->real_escape_string($girdi["message"]);

    // Önce tablonun var olup olmadığını kontrol et
    $table_check = $baglanti->query("SHOW TABLES LIKE 'iletisim_formu'");
    if (!$table_check) {
        error_log("Tablo kontrol hatası: " . $baglanti->error);
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Tablo kontrolü başarısız: " . $baglanti->error]);
        exit;
    }
    
    if ($table_check->num_rows === 0) {
        error_log("iletisim_formu tablosu bulunamadı");
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "iletisim_formu tablosu bulunamadı."]);
        exit;
    }

    error_log("iletisim_formu tablosu bulundu");

    // Tablo yapısını kontrol et
    $column_check = $baglanti->query("SHOW COLUMNS FROM iletisim_formu LIKE 'adisoyadi'");
    if (!$column_check) {
        error_log("Sütun kontrol hatası: " . $baglanti->error);
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Sütun kontrolü başarısız: " . $baglanti->error]);
        exit;
    }
    
    if ($column_check->num_rows === 0) {
        error_log("adisoyadi sütunu bulunamadı");
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "adisoyadi sütunu bulunamadı."]);
        exit;
    }

    error_log("adisoyadi sütunu bulundu");

    // iletisim_formu tablosuna kayıt
    $insert_sql = "INSERT INTO iletisim_formu (adisoyadi, eposta, mesaj, konu) 
                    VALUES ('$username', '$email', '$message', '$konu')";
    
    if ($baglanti->query($insert_sql)) {
        // E-posta gönderme işlemi
        $email_sent = false;
        try {
            // E-posta konfigürasyon dosyasını dahil et
            require_once 'email_config.php';
            
            // E-posta gönderme fonksiyonunu çağır
            $email_sent = sendContactEmail($username, $email, $konu, $message);
            
        } catch (Exception $e) {
            error_log("❌ E-posta gönderme hatası: " . $e->getMessage());
            // E-posta gönderilemese bile veritabanına kayıt başarılı olduğu için devam et
        }

        $response_message = "Mesaj başarıyla gönderildi.";
        if ($email_sent) {
            $response_message .= " E-posta bildirimi de gönderildi.";
        } else {
            $response_message .= " (E-posta bildirimi gönderilemedi)";
        }
        
        echo json_encode(["success" => true, "message" => $response_message]);
    } else {
        http_response_code(500);
        $error_message = "Mesaj gönderilemedi";
        if ($baglanti->error) {
            $error_message .= ": " . $baglanti->error;
        }
        echo json_encode(["success" => false, "message" => $error_message]);
    }
    } catch (Exception $e) {
        error_log("İletişim hatası: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Sunucu hatası: " . $e->getMessage()]);
    }
    exit;
}

// POST: Yeni kayıt
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_GET["kayit"])) {
    $girdi = json_decode(file_get_contents("php://input"), true);

    // Parametre kontrolü
    if (!isset($girdi["username"]) || empty($girdi["username"])) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Kullanıcı adı alanı boş bırakılamaz."]);
        exit;
    }
    
    if (!isset($girdi["adsoyad"]) || empty($girdi["adsoyad"])) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Ad soyad alanı boş bırakılamaz."]);
        exit;
    }

    if (!isset($girdi["eposta"]) || empty($girdi["eposta"])) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "E-posta alanı boş bırakılamaz."]);
        exit;
    }

    $username = $baglanti->real_escape_string($girdi["username"]);
    $adsoyad = $baglanti->real_escape_string($girdi["adsoyad"]);
    $eposta = $baglanti->real_escape_string($girdi["eposta"]);
    if (!isset($girdi["sifre"]) || empty($girdi["sifre"])) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Şifre alanı boş bırakılamaz."]);
        exit;
    }
    $sifre = password_hash($girdi["sifre"], PASSWORD_DEFAULT);
    $rol = $baglanti->real_escape_string($girdi["rol"]);

    // Kullanıcı adı kontrolü - zaten var mı?
    $username_check = $baglanti->query("SELECT COUNT(*) as sayi FROM kisiler WHERE username = '$username'");
    if (!$username_check) {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Veritabanı hatası: " . $baglanti->error]);
        exit;
    }
    $username_data = $username_check->fetch_assoc();
    if ($username_data["sayi"] > 0) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Bu kullanıcı adı zaten kullanılıyor. Lütfen farklı bir kullanıcı adı seçin."]);
        exit;
    }

    // E-posta kontrolü - zaten var mı?
    $email_check = $baglanti->query("SELECT COUNT(*) as sayi FROM kisiler WHERE e_posta = '$eposta'");
    if (!$email_check) {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Veritabanı hatası: " . $baglanti->error]);
        exit;
    }
    $email_data = $email_check->fetch_assoc();
    if ($email_data["sayi"] > 0) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Bu e-posta adresi zaten kullanılıyor. Lütfen farklı bir e-posta adresi seçin."]);
        exit;
    }

    // Yönetici kontrolü
    if ($rol === "admin") {
        $kontrol = $baglanti->query("SELECT COUNT(*) as sayi FROM kisiler WHERE rol = 'admin'");
        $veri = $kontrol->fetch_assoc();
        if ($veri["sayi"] >= 1) {
            http_response_code(403);
            echo json_encode(["success" => false, "message" => "Zaten bir yönetici mevcut. Yeni yönetici atanamaz."]);
            exit;
        }
    }

    $sql = "INSERT INTO kisiler (username, adsoyad, sifre, e_posta, rol) 
            VALUES ('$username', '$adsoyad', '$sifre', '$eposta', '$rol')";

    if ($baglanti->query($sql)) {
        echo json_encode(["success" => true, "message" => "Kayıt başarıyla eklendi."]);
    } else {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Kayıt başarısız: " . $baglanti->error]);
    }
    exit;
}

// POST: Yeni film ekleme
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_GET["films"])) {
    $girdi = json_decode(file_get_contents("php://input"), true);

    $film_adi = $baglanti->real_escape_string($girdi["film_adi"]);
    $yil = (int)$girdi["yil"];
    $sure = $baglanti->real_escape_string($girdi["sure"]);
    $imdb_puani = (float)$girdi["imdb_puani"];
    $poster_url = $baglanti->real_escape_string($girdi["poster_url"]);
    $ozet = $baglanti->real_escape_string($girdi["ozet"]);
    $yonetmen = $baglanti->real_escape_string($girdi["yonetmen"]);
    $oyuncular = $baglanti->real_escape_string($girdi["oyuncular"]);
    $tur = $baglanti->real_escape_string($girdi["tur"]);
    $ulke = $baglanti->real_escape_string($girdi["ulke"]);
    $fragman_url = $baglanti->real_escape_string($girdi["fragman_url"]);
    $kategori = $baglanti->real_escape_string($girdi["kategori"]);

    $sql = "INSERT INTO filmler (film_adi, yil, sure, imdb_puani, poster_url, ozet, yonetmen, oyuncular, tur, ulke, fragman_url, kategori) 
            VALUES ('$film_adi', $yil, '$sure', $imdb_puani, '$poster_url', '$ozet', '$yonetmen', '$oyuncular', '$tur', '$ulke', '$fragman_url', '$kategori')";

    if ($baglanti->query($sql)) {
        echo json_encode(["success" => true, "message" => "Film başarıyla eklendi."]);
    } else {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Film ekleme başarısız: " . $baglanti->error]);
    }
    exit;
}

// POST: Giriş işlemi
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_GET["login"])) {
    error_log("=== GİRİŞ ENDPOINT BAŞLADI ===");
    
    $girdi = json_decode(file_get_contents("php://input"), true);
    error_log("Gelen veri: " . json_encode($girdi));
    
    // Parametre kontrolü
    if (!isset($girdi["username"]) || empty($girdi["username"])) {
        error_log("Kullanıcı adı boş");
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Kullanıcı adı alanı boş bırakılamaz."]);
        exit;
    }
    
    if (!isset($girdi["sifre"]) || empty($girdi["sifre"])) {
        error_log("Şifre boş");
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Şifre alanı boş bırakılamaz."]);
        exit;
    }
    
    $username = $baglanti->real_escape_string($girdi["username"]);
    $sifre = $girdi["sifre"];
    
    error_log("Aranan kullanıcı: " . $username);

    $sonuc = $baglanti->query("SELECT * FROM kisiler WHERE username='$username'");
    error_log("SQL sorgusu sonucu: " . ($sonuc ? "başarılı" : "başarısız"));
    
    if ($sonuc && $sonuc->num_rows > 0) {
        $kisi = $sonuc->fetch_assoc();
        error_log("Kullanıcı bulundu, şifre kontrolü yapılıyor");
        
        if (password_verify($sifre, $kisi["sifre"])) {
            error_log("Şifre doğru, giriş başarılı");
            unset($kisi["sifre"]);
            echo json_encode(["success" => true, "kullanici" => $kisi]);
            exit;
        } else {
            error_log("Şifre yanlış");
        }
    } else {
        error_log("Kullanıcı bulunamadı");
    }
    
    error_log("Giriş başarısız");
    echo json_encode(["success" => false, "message" => "Geçersiz kullanıcı adı veya şifre."]);
    exit;
}

// DELETE: Kişi sil
if ($_SERVER["REQUEST_METHOD"] === "DELETE" && !isset($_GET["films"]) && !isset($_GET["yorum"])) {
    $id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;
    if ($id > 0) {
        $baglanti->query("DELETE FROM kisiler WHERE id = $id");
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Geçersiz ID."]);
    }
    exit;
}

// DELETE: Film sil
if ($_SERVER["REQUEST_METHOD"] === "DELETE" && isset($_GET["films"])) {
    $id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;
    if ($id > 0) {
        $baglanti->query("DELETE FROM filmler WHERE id = $id");
        echo json_encode(["success" => true, "message" => "Film başarıyla silindi."]);
    } else {
        echo json_encode(["success" => false, "message" => "Geçersiz ID."]);
    }
    exit;
}

// PUT: Güncelleme
if ($_SERVER["REQUEST_METHOD"] === "PUT" && !isset($_GET["films"])) {
    $girdi = json_decode(file_get_contents("php://input"), true);

    if (!isset($girdi["id"])) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "ID eksik."]);
        exit;
    }

    $id = (int)$girdi["id"];
    $username = $baglanti->real_escape_string($girdi["username"]);
    $adsoyad = $baglanti->real_escape_string($girdi["adsoyad"]);
    $e_posta = isset($girdi["e_posta"]) ? $baglanti->real_escape_string($girdi["e_posta"]) : "";
    $rol = isset($girdi["rol"]) ? $baglanti->real_escape_string($girdi["rol"]) : "kullanici";

    // Admin rolü kontrolü - sadece mevcut admin'i kullanıcı yapmaya çalışırken kontrol et
    if ($rol === "kullanici") {
        $kontrol = $baglanti->query("SELECT COUNT(*) as sayi FROM kisiler WHERE rol = 'admin' AND id != $id");
        $veri = $kontrol->fetch_assoc();
        if ($veri["sayi"] == 0) {
            http_response_code(403);
            echo json_encode(["success" => false, "message" => "Son admin kullanıcısını kaldıramazsınız. En az bir admin olmalıdır."]);
            exit;
        }
    }

    if (isset($girdi["sifre"]) && !empty($girdi["sifre"])) {
        $sifre = password_hash($girdi["sifre"], PASSWORD_DEFAULT);
        $sql = "UPDATE kisiler 
                SET username='$username', adsoyad='$adsoyad', e_posta='$e_posta', sifre='$sifre', rol='$rol' 
                WHERE id=$id";
    } else {
        $sql = "UPDATE kisiler 
                SET username='$username', adsoyad='$adsoyad', e_posta='$e_posta', rol='$rol' 
                WHERE id=$id";
    }

    if ($baglanti->query($sql)) {
        echo json_encode(["success" => true, "message" => "Kayıt başarıyla güncellendi."]);
    } else {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Güncelleme başarısız: " . $baglanti->error]);
    }
    exit;
}

// PUT: Film güncelleme
if ($_SERVER["REQUEST_METHOD"] === "PUT" && isset($_GET["films"])) {
    $girdi = json_decode(file_get_contents("php://input"), true);

    if (!isset($girdi["id"])) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "ID eksik."]);
        exit;
    }

    $id = (int)$girdi["id"];
    $film_adi = $baglanti->real_escape_string($girdi["film_adi"]);
    $yil = (int)$girdi["yil"];
    $sure = $baglanti->real_escape_string($girdi["sure"]);
    $imdb_puani = (float)$girdi["imdb_puani"];
    $poster_url = $baglanti->real_escape_string($girdi["poster_url"]);
    $ozet = $baglanti->real_escape_string($girdi["ozet"]);
    $yonetmen = $baglanti->real_escape_string($girdi["yonetmen"]);
    $oyuncular = $baglanti->real_escape_string($girdi["oyuncular"]);
    $tur = $baglanti->real_escape_string($girdi["tur"]);
    $ulke = $baglanti->real_escape_string($girdi["ulke"]);
    $fragman_url = $baglanti->real_escape_string($girdi["fragman_url"]);
    $kategori = $baglanti->real_escape_string($girdi["kategori"]);

    $sql = "UPDATE filmler 
            SET film_adi='$film_adi', yil=$yil, sure='$sure', imdb_puani=$imdb_puani, 
                poster_url='$poster_url', ozet='$ozet', yonetmen='$yonetmen', 
                oyuncular='$oyuncular', tur='$tur', ulke='$ulke', 
                fragman_url='$fragman_url', kategori='$kategori' 
            WHERE id=$id";

    if ($baglanti->query($sql)) {
        echo json_encode(["success" => true, "message" => "Film başarıyla güncellendi."]);
    } else {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Film güncelleme başarısız: " . $baglanti->error]);
    }
    exit;
}

// YORUM ENDPOINT'LERİ
// GET: Tüm yorumları listele (debug için)
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["tum_yorumlar"])) {
    header("Content-Type: application/json");
    error_log("Tüm yorumlar listeleme endpoint'i çağrıldı");
    
    // Yorum tablosunun varlığını kontrol et
    $tablo_kontrol = $baglanti->query("SHOW TABLES LIKE 'yorumlar'");
    if ($tablo_kontrol->num_rows == 0) {
        error_log("yorumlar tablosu bulunamadı!");
        echo json_encode([]);
        exit;
    }
    
    $sql = "SELECT * FROM yorumlar ORDER BY created_at DESC";
    
    error_log("Tüm yorumlar SQL sorgusu: " . $sql);
    $sonuc = $baglanti->query($sql);
    $yorumlar = [];
    
    if ($sonuc) {
        while ($satir = $sonuc->fetch_assoc()) {
            // Yorum metnini temizle (gereksiz boşlukları kaldır)
            if (isset($satir['yorum'])) {
                $satir['yorum'] = trim(preg_replace('/\s+/', ' ', $satir['yorum']));
            }
            $yorumlar[] = $satir;
        }
        error_log("Toplam yorum sayısı: " . count($yorumlar));
    } else {
        error_log("Tüm yorumlar SQL hatası: " . $baglanti->error);
    }
    
    echo json_encode($yorumlar);
    exit;
}

// GET: Son yorumları getir (anasayfa için)
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["son_yorumlar"])) {
    header("Content-Type: application/json");
    error_log("Son yorumlar endpoint'i çağrıldı");
    
    // Yorum tablosunun varlığını kontrol et
    $tablo_kontrol = $baglanti->query("SHOW TABLES LIKE 'yorumlar'");
    if ($tablo_kontrol->num_rows == 0) {
        error_log("yorumlar tablosu bulunamadı!");
        echo json_encode([]);
        exit;
    }
    
    $limit = isset($_GET["limit"]) ? (int)$_GET["limit"] : 6;
    $limit = min($limit, 20); // Maksimum 20 yorum
    
    $sql = "SELECT * FROM yorumlar 
            ORDER BY created_at DESC 
            LIMIT $limit";
    
    error_log("Son yorumlar SQL sorgusu: " . $sql);
    $sonuc = $baglanti->query($sql);
    $yorumlar = [];
    
    if ($sonuc) {
        while ($satir = $sonuc->fetch_assoc()) {
            // Yorum metnini temizle (gereksiz boşlukları kaldır)
            if (isset($satir['yorum'])) {
                $satir['yorum'] = trim(preg_replace('/\s+/', ' ', $satir['yorum']));
            }
            $yorumlar[] = $satir;
        }
        error_log("Bulunan son yorum sayısı: " . count($yorumlar));
    } else {
        error_log("Son yorumlar SQL hatası: " . $baglanti->error);
    }
    
    echo json_encode($yorumlar);
    exit;
}

// GET: Yorumları getir
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["yorum"])) {
    header("Content-Type: application/json");
    error_log("=== YORUM GETİRME BAŞLADI ===");
    error_log("Yorum getirme endpoint'i çağrıldı");
    
    // Yorum tablosunun varlığını kontrol et
    $tablo_kontrol = $baglanti->query("SHOW TABLES LIKE 'yorumlar'");
    if ($tablo_kontrol->num_rows == 0) {
        error_log("❌ yorumlar tablosu bulunamadı!");
        echo json_encode([]);
        exit;
    }
    error_log("✅ yorumlar tablosu bulundu");
    
    // Parametreleri kontrol et
    if (!isset($_GET["tur"]) || !isset($_GET["icerik_id"])) {
        error_log("❌ Eksik parametreler: tur veya icerik_id");
        echo json_encode([]);
        exit;
    }
    
    $tur = $baglanti->real_escape_string($_GET["tur"]);
    $icerik_id = (int)$_GET["icerik_id"];
    error_log("🔍 Tür: '$tur', İçerik ID: $icerik_id");
    
    $sql = "SELECT * FROM yorumlar 
            WHERE tur = '$tur' AND icerik_id = $icerik_id 
            ORDER BY created_at DESC";
    
    error_log("📝 SQL sorgusu: " . $sql);
    $sonuc = $baglanti->query($sql);
    $yorumlar = [];
    
    if ($sonuc) {
        error_log("✅ SQL sorgusu başarılı");
        while ($satir = $sonuc->fetch_assoc()) {
            // Yorum metnini temizle (gereksiz boşlukları kaldır)
            if (isset($satir['yorum'])) {
                $satir['yorum'] = trim(preg_replace('/\s+/', ' ', $satir['yorum']));
            }
            error_log("📊 Yorum satırı: " . json_encode($satir));
            $yorumlar[] = $satir;
        }
        error_log("📈 Bulunan yorum sayısı: " . count($yorumlar));
    } else {
        error_log("❌ SQL hatası: " . $baglanti->error);
    }
    
    error_log("🎯 Gönderilen JSON: " . json_encode($yorumlar));
    error_log("=== YORUM GETİRME BİTTİ ===");
    
    echo json_encode($yorumlar);
    exit;
}

// DELETE: Yorum sil
if ($_SERVER["REQUEST_METHOD"] === "DELETE" && isset($_GET["yorum"])) {
    header("Content-Type: application/json");
    error_log("=== YORUM SİLME BAŞLADI (DELETE) ===");
    
    $yorum_id = (int)$_GET["id"];
    error_log("Silinecek yorum ID: $yorum_id");
    
    // Yorumun var olup olmadığını kontrol et
    $kontrol_sql = "SELECT id FROM yorumlar WHERE id = $yorum_id";
    error_log("Kontrol SQL: " . $kontrol_sql);
    $kontrol = $baglanti->query($kontrol_sql);
    
    if ($kontrol && $kontrol->num_rows > 0) {
        error_log("✅ Yorum bulundu, silme işlemi başlıyor");
        
        // Basit silme işlemi (transaction olmadan)
        $sql = "DELETE FROM yorumlar WHERE id = $yorum_id";
        error_log("Silme SQL: " . $sql);
        
        $silme_sonuc = $baglanti->query($sql);
        error_log("Silme sonucu: " . ($silme_sonuc ? "true" : "false"));
        error_log("Etkilenen satır sayısı: " . $baglanti->affected_rows);
        
        if ($silme_sonuc && $baglanti->affected_rows > 0) {
            error_log("✅ Yorum silindi");
            
            // Silme sonrası kontrol
            $kontrol2 = $baglanti->query("SELECT id FROM yorumlar WHERE id = $yorum_id");
            if ($kontrol2 && $kontrol2->num_rows == 0) {
                error_log("✅ Yorum gerçekten silindi (kontrol doğrulandı)");
                echo json_encode(["success" => true, "message" => "Yorum başarıyla silindi"]);
            } else {
                error_log("❌ Yorum silinmedi (kontrol başarısız)");
                http_response_code(500);
                echo json_encode(["success" => false, "message" => "Yorum silinmedi"]);
            }
        } else {
            error_log("❌ Yorum silinirken hata: " . $baglanti->error);
            http_response_code(500);
            echo json_encode(["success" => false, "message" => "Yorum silinirken hata: " . $baglanti->error]);
        }
    } else {
        error_log("❌ Yorum bulunamadı (ID: $yorum_id)");
        http_response_code(404);
        echo json_encode(["success" => false, "message" => "Yorum bulunamadı"]);
    }
    error_log("=== YORUM SİLME BİTTİ (DELETE) ===");
    exit;
}

// POST: Yorum sil (alternatif method)
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_GET["yorum"]) && isset($_GET["sil"])) {
    header("Content-Type: application/json");
    error_log("=== YORUM SİLME BAŞLADI (POST) ===");
    
    $yorum_id = (int)$_GET["id"];
    error_log("Silinecek yorum ID: $yorum_id");
    
    // Yorumun var olup olmadığını kontrol et
    $kontrol_sql = "SELECT id FROM yorumlar WHERE id = $yorum_id";
    error_log("Kontrol SQL: " . $kontrol_sql);
    $kontrol = $baglanti->query($kontrol_sql);
    
    if ($kontrol && $kontrol->num_rows > 0) {
        error_log("✅ Yorum bulundu, silme işlemi başlıyor");
        
        // Basit silme işlemi (transaction olmadan)
        $sql = "DELETE FROM yorumlar WHERE id = $yorum_id";
        error_log("Silme SQL: " . $sql);
        
        $silme_sonuc = $baglanti->query($sql);
        error_log("Silme sonucu: " . ($silme_sonuc ? "true" : "false"));
        error_log("Etkilenen satır sayısı: " . $baglanti->affected_rows);
        
        if ($silme_sonuc && $baglanti->affected_rows > 0) {
            error_log("✅ Yorum silindi");
            
            // Silme sonrası kontrol
            $kontrol2 = $baglanti->query("SELECT id FROM yorumlar WHERE id = $yorum_id");
            if ($kontrol2 && $kontrol2->num_rows == 0) {
                error_log("✅ Yorum gerçekten silindi (kontrol doğrulandı)");
                echo json_encode(["success" => true, "message" => "Yorum başarıyla silindi"]);
            } else {
                error_log("❌ Yorum silinmedi (kontrol başarısız)");
                http_response_code(500);
                echo json_encode(["success" => false, "message" => "Yorum silinmedi"]);
            }
        } else {
            error_log("❌ Yorum silinirken hata: " . $baglanti->error);
            http_response_code(500);
            echo json_encode(["success" => false, "message" => "Yorum silinirken hata: " . $baglanti->error]);
        }
    } else {
        error_log("❌ Yorum bulunamadı (ID: $yorum_id)");
        http_response_code(404);
        echo json_encode(["success" => false, "message" => "Yorum bulunamadı"]);
    }
    error_log("=== YORUM SİLME BİTTİ (POST) ===");
    exit;
}


// TİYATRO ENDPOINT'LERİ
// GET: Tiyatro eserlerini getir
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["tiyatro"])) {
    header("Content-Type: application/json");
    
    error_log("Tiyatro endpoint çağrıldı");
    
    // Tabloların varlığını kontrol et
    $tablo_kontrol = $baglanti->query("SHOW TABLES LIKE 'tiyatro_eserleri'");
    error_log("Tablo kontrol sonucu: " . $tablo_kontrol->num_rows);
    
    if ($tablo_kontrol->num_rows == 0) {
        error_log("tiyatro_eserleri tablosu bulunamadı");
        echo json_encode([]);
        exit;
    }
    
    $sql = "SELECT * FROM tiyatro_eserleri ORDER BY puan DESC";
    error_log("SQL sorgusu: " . $sql);
    
    $sonuc = $baglanti->query($sql);
    
    if (!$sonuc) {
        error_log("SQL hatası: " . $baglanti->error);
        echo json_encode([]);
        exit;
    }
    
    $tiyatrolar = [];
    while ($satir = $sonuc->fetch_assoc()) {
        $tiyatrolar[] = $satir;
    }
    
    error_log("Bulunan tiyatro sayısı: " . count($tiyatrolar));
    echo json_encode($tiyatrolar);
    exit;
}

// MESAJ YÖNETİMİ ENDPOINT'LERİ
// GET: Mesajları getir
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["mesajlar"])) {
    header("Content-Type: application/json");
    
    error_log("=== MESAJLAR ENDPOINT BAŞLADI ===");
    error_log("Mesajlar endpoint çağrıldı");
    
    // Tabloların varlığını kontrol et
    $tablo_kontrol = $baglanti->query("SHOW TABLES LIKE 'iletisim_formu'");
    error_log("Tablo kontrol sonucu: " . $tablo_kontrol->num_rows);
    
    if ($tablo_kontrol->num_rows == 0) {
        error_log("❌ iletisim_formu tablosu bulunamadı");
        echo json_encode([]);
        exit;
    }
    
    error_log("✅ iletisim_formu tablosu bulundu");
    
    // Tablo yapısını kontrol et
    $sutun_kontrol = $baglanti->query("SHOW COLUMNS FROM iletisim_formu");
    error_log("Sütun kontrol sonucu: " . $sutun_kontrol->num_rows);
    
    $sutunlar = [];
    while ($sutun = $sutun_kontrol->fetch_assoc()) {
        $sutunlar[] = $sutun['Field'];
    }
    error_log("📋 Tablo sütunları: " . json_encode($sutunlar));
    
    $sql = "SELECT * FROM iletisim_formu ORDER BY id DESC";
    error_log("SQL sorgusu: " . $sql);
    
    $sonuc = $baglanti->query($sql);
    
    if (!$sonuc) {
        error_log("❌ SQL hatası: " . $baglanti->error);
        echo json_encode([]);
        exit;
    }
    
    error_log("✅ SQL sorgusu başarılı");
    error_log("📊 Bulunan satır sayısı: " . $sonuc->num_rows);
    
    $mesajlar = [];
    while ($satir = $sonuc->fetch_assoc()) {
        $mesajlar[] = $satir;
        error_log("📝 Mesaj verisi: " . json_encode($satir));
    }
    
    error_log("✅ Bulunan mesaj sayısı: " . count($mesajlar));
    error_log("📤 JSON yanıtı: " . json_encode($mesajlar));
    echo json_encode($mesajlar);
    error_log("=== MESAJLAR ENDPOINT BİTTİ ===");
    exit;
}

// MÜZİK ENDPOINT'LERİ
if (isset($_GET["muzik"])) {
    error_log("=== MÜZİK ENDPOINT BAŞLADI ===");
    error_log("Müzik endpoint çağrıldı");
    error_log("GET parametreleri: " . json_encode($_GET));
    
    if (isset($_GET["tur"])) {
        // Belirli türdeki şarkıları getir
        $tur = $baglanti->real_escape_string($_GET["tur"]);
        $query = "SELECT * FROM muzikler WHERE tur = '$tur' ORDER BY yayin_yili DESC";
        error_log("SQL sorgusu: " . $query);
        $sonuc = $baglanti->query($query);
        
        if (!$sonuc) {
            error_log("❌ SQL hatası: " . $baglanti->error);
            echo json_encode([]);
            exit;
        }
        
        error_log("✅ SQL sorgusu başarılı");
        error_log("📊 Bulunan satır sayısı: " . $sonuc->num_rows);
        
        $sarkilar = [];
        while ($satir = $sonuc->fetch_assoc()) {
            $sarkilar[] = $satir;
            error_log("🎵 Şarkı verisi: " . json_encode($satir));
        }
        
        error_log("✅ Bulunan şarkı sayısı: " . count($sarkilar));
        error_log("📤 JSON yanıtı: " . json_encode($sarkilar));
        echo json_encode($sarkilar);
        error_log("=== MÜZİK ENDPOINT BİTTİ ===");
        exit;
    } elseif (isset($_GET["id"])) {
        // Belirli şarkıyı getir (ID veya başlık ile)
        $id = $baglanti->real_escape_string($_GET["id"]);
        
        // Önce ID ile ara
        $sonuc = $baglanti->query("SELECT * FROM muzikler WHERE id = '$id'");
        
        // ID ile bulunamazsa başlık ile ara
        if (!$sonuc || $sonuc->num_rows == 0) {
            $baslik = str_replace('-', ' ', $id); // URL'deki tireleri boşluğa çevir
            $sonuc = $baglanti->query("SELECT * FROM muzikler WHERE LOWER(muzik_adi) LIKE LOWER('%$baslik%')");
        }
        
        if ($sonuc && $sonuc->num_rows > 0) {
            $sarki = $sonuc->fetch_assoc();
            echo json_encode($sarki);
        } else {
            echo json_encode(["error" => "Şarkı bulunamadı"]);
        }
        exit;
    } else {
        // Tüm şarkıları getir
        $sonuc = $baglanti->query("SELECT * FROM muzikler ORDER BY yayin_yili DESC");
        $sarkilar = [];
        while ($satir = $sonuc->fetch_assoc()) {
            $sarkilar[] = $satir;
        }
        echo json_encode($sarkilar);
        exit;
    }
}

// MÜZİK TÜRLERİ ENDPOINT'İ
if (isset($_GET["muzik_turleri"])) {
    error_log("=== MÜZİK TÜRLERİ ENDPOINT BAŞLADI ===");
    error_log("Müzik türleri endpoint çağrıldı");
    
    $query = "SELECT DISTINCT tur, COUNT(*) as sarki_sayisi FROM muzikler GROUP BY tur ORDER BY sarki_sayisi DESC";
    error_log("SQL sorgusu: " . $query);
    $sonuc = $baglanti->query($query);
    
    if (!$sonuc) {
        error_log("❌ SQL hatası: " . $baglanti->error);
        echo json_encode([]);
        exit;
    }
    
    error_log("✅ SQL sorgusu başarılı");
    error_log("📊 Bulunan satır sayısı: " . $sonuc->num_rows);
    
    $turler = [];
    while ($satir = $sonuc->fetch_assoc()) {
        $turler[] = $satir;
        error_log("🎼 Tür verisi: " . json_encode($satir));
    }
    
    error_log("✅ Bulunan tür sayısı: " . count($turler));
    error_log("📤 JSON yanıtı: " . json_encode($turler));
    echo json_encode($turler);
    error_log("=== MÜZİK TÜRLERİ ENDPOINT BİTTİ ===");
    exit;
}

// HEYKELLER ENDPOINT'LERİ
if (isset($_GET["heykel"])) {
    error_log("=== HEYKELLER ENDPOINT BAŞLADI ===");
    error_log("Heykeller endpoint çağrıldı");
    if (isset($_GET["id"])) {
        // Belirli heykeli getir
        $id = (int)$_GET["id"];
        $sonuc = $baglanti->query("SELECT * FROM heykeller WHERE id = $id");
        if ($sonuc && $sonuc->num_rows > 0) {
            $heykel = $sonuc->fetch_assoc();
            echo json_encode($heykel);
        } else {
            echo json_encode(["error" => "Heykel bulunamadı"]);
        }
        exit;
    } else {
        // Tüm heykelleri getir (limit desteği ile)
        $limit = isset($_GET["limit"]) ? (int)$_GET["limit"] : 0;
        $query = "SELECT * FROM heykeller ORDER BY id DESC";
        if ($limit > 0) {
            $query .= " LIMIT $limit";
        }
        error_log("SQL sorgusu: " . $query);
        $sonuc = $baglanti->query($query);
        
        if (!$sonuc) {
            error_log("❌ SQL hatası: " . $baglanti->error);
            echo json_encode([]);
            exit;
        }
        
        error_log("✅ SQL sorgusu başarılı");
        error_log("📊 Bulunan satır sayısı: " . $sonuc->num_rows);
        
        $heykeller = [];
        while ($satir = $sonuc->fetch_assoc()) {
            $heykeller[] = $satir;
            error_log("🗿 Heykel verisi: " . json_encode($satir));
        }
        
        error_log("✅ Bulunan heykel sayısı: " . count($heykeller));
        error_log("📤 JSON yanıtı: " . json_encode($heykeller));
        echo json_encode($heykeller);
        error_log("=== HEYKELLER ENDPOINT BİTTİ ===");
        exit;
    }
}

// FOTOĞRAFLAR ENDPOINT'LERİ
if (isset($_GET["fotograf"])) {
    error_log("=== FOTOĞRAFLAR ENDPOINT BAŞLADI ===");
    error_log("Fotoğraflar endpoint çağrıldı");
    if (isset($_GET["id"])) {
        // Belirli fotoğrafı getir
        $id = (int)$_GET["id"];
        $sonuc = $baglanti->query("SELECT * FROM fotograflar WHERE id = $id");
        if ($sonuc && $sonuc->num_rows > 0) {
            $fotograf = $sonuc->fetch_assoc();
            echo json_encode($fotograf);
        } else {
            echo json_encode(["error" => "Fotoğraf bulunamadı"]);
        }
        exit;
    } else {
        // Tüm fotoğrafları getir (limit desteği ile)
        $limit = isset($_GET["limit"]) ? (int)$_GET["limit"] : 0;
        $query = "SELECT * FROM fotograflar ORDER BY id DESC";
        if ($limit > 0) {
            $query .= " LIMIT $limit";
        }
        error_log("SQL sorgusu: " . $query);
        $sonuc = $baglanti->query($query);
        
        if (!$sonuc) {
            error_log("❌ SQL hatası: " . $baglanti->error);
            echo json_encode([]);
            exit;
        }
        
        error_log("✅ SQL sorgusu başarılı");
        error_log("📊 Bulunan satır sayısı: " . $sonuc->num_rows);
        
        $fotograflar = [];
        while ($satir = $sonuc->fetch_assoc()) {
            $fotograflar[] = $satir;
            error_log("📸 Fotoğraf verisi: " . json_encode($satir));
        }
        
        error_log("✅ Bulunan fotoğraf sayısı: " . count($fotograflar));
        error_log("📤 JSON yanıtı: " . json_encode($fotograflar));
        echo json_encode($fotograflar);
        error_log("=== FOTOĞRAFLAR ENDPOINT BİTTİ ===");
        exit;
    }
}

        // DANSLAR ENDPOINT'LERİ
        if (isset($_GET["dans"])) {
            error_log("=== DANSLAR ENDPOINT BAŞLADI ===");
            error_log("Danslar endpoint çağrıldı");
            if (isset($_GET["id"])) {
                // Belirli dansı getir
                $id = (int)$_GET["id"];
                $sonuc = $baglanti->query("SELECT * FROM danslar WHERE id = $id");
                if ($sonuc && $sonuc->num_rows > 0) {
                    $dans = $sonuc->fetch_assoc();
                    echo json_encode($dans);
                } else {
                    echo json_encode(["error" => "Dans bulunamadı"]);
                }
                exit;
            } else {
                // Tüm dansları getir (limit desteği ile)
                $limit = isset($_GET["limit"]) ? (int)$_GET["limit"] : 0;
                $query = "SELECT * FROM danslar ORDER BY id DESC";
                if ($limit > 0) {
                    $query .= " LIMIT $limit";
                }
                error_log("SQL sorgusu: " . $query);
                $sonuc = $baglanti->query($query);
                
                if (!$sonuc) {
                    error_log("❌ SQL hatası: " . $baglanti->error);
                    echo json_encode([]);
                    exit;
                }
                
                error_log("✅ SQL sorgusu başarılı");
                error_log("📊 Bulunan satır sayısı: " . $sonuc->num_rows);
                
                $danslar = [];
                while ($satir = $sonuc->fetch_assoc()) {
                    $danslar[] = $satir;
                    error_log("💃 Dans verisi: " . json_encode($satir));
                }
                
                error_log("✅ Bulunan dans sayısı: " . count($danslar));
                error_log("📤 JSON yanıtı: " . json_encode($danslar));
                echo json_encode($danslar);
                error_log("=== DANSLAR ENDPOINT BİTTİ ===");
                exit;
            }
        }

        // YEMEKLER ENDPOINT'LERİ
        if (isset($_GET["yemek"])) {
            error_log("=== YEMEKLER ENDPOINT BAŞLADI ===");
            error_log("Yemekler endpoint çağrıldı");
            if (isset($_GET["id"])) {
                // Belirli yemeği getir
                $id = (int)$_GET["id"];
                $sonuc = $baglanti->query("SELECT * FROM yemekler WHERE id = $id");
                if ($sonuc && $sonuc->num_rows > 0) {
                    $yemek = $sonuc->fetch_assoc();
                    echo json_encode($yemek);
                } else {
                    echo json_encode(["error" => "Yemek bulunamadı"]);
                }
                exit;
            } else {
                // Tüm yemekleri getir (limit desteği ile)
                $limit = isset($_GET["limit"]) ? (int)$_GET["limit"] : 0;
                $query = "SELECT * FROM yemekler ORDER BY id DESC";
                if ($limit > 0) {
                    $query .= " LIMIT $limit";
                }
                error_log("SQL sorgusu: " . $query);
                $sonuc = $baglanti->query($query);
                
                if (!$sonuc) {
                    error_log("❌ SQL hatası: " . $baglanti->error);
                    echo json_encode([]);
                    exit;
                }
                
                error_log("✅ SQL sorgusu başarılı");
                error_log("📊 Bulunan satır sayısı: " . $sonuc->num_rows);
                
                $yemekler = [];
                while ($satir = $sonuc->fetch_assoc()) {
                    $yemekler[] = $satir;
                    error_log("🍽️ Yemek verisi: " . json_encode($satir));
                }
                
                error_log("✅ Bulunan yemek sayısı: " . count($yemekler));
                error_log("📤 JSON yanıtı: " . json_encode($yemekler));
                echo json_encode($yemekler);
                error_log("=== YEMEKLER ENDPOINT BİTTİ ===");
                exit;
            }
        }

        // DÜNYA MUTFAĞI ENDPOINT'LERİ
        if (isset($_GET["dunya_mutfagi"])) {
            error_log("=== DÜNYA MUTFAĞI ENDPOINT BAŞLADI ===");
            error_log("Dünya mutfağı endpoint çağrıldı");
            if (isset($_GET["id"])) {
                // Belirli yemeği getir
                $id = (int)$_GET["id"];
                $sonuc = $baglanti->query("SELECT * FROM dunya_mutfagi WHERE id = $id");
                if ($sonuc && $sonuc->num_rows > 0) {
                    $yemek = $sonuc->fetch_assoc();
                    echo json_encode($yemek);
                } else {
                    echo json_encode(["error" => "Yemek bulunamadı"]);
                }
                exit;
            } else {
                // Tüm yemekleri getir (limit desteği ile)
                $limit = isset($_GET["limit"]) ? (int)$_GET["limit"] : 0;
                $query = "SELECT * FROM dunya_mutfagi ORDER BY id DESC";
                if ($limit > 0) {
                    $query .= " LIMIT $limit";
                }
                error_log("SQL sorgusu: " . $query);
                $sonuc = $baglanti->query($query);
                
                if (!$sonuc) {
                    error_log("❌ SQL hatası: " . $baglanti->error);
                    echo json_encode([]);
                    exit;
                }
                
                error_log("✅ SQL sorgusu başarılı");
                error_log("📊 Bulunan satır sayısı: " . $sonuc->num_rows);
                
                $yemekler = [];
                while ($satir = $sonuc->fetch_assoc()) {
                    $yemekler[] = $satir;
                    error_log("🌍 Dünya mutfağı verisi: " . json_encode($satir));
                }
                
                error_log("✅ Bulunan yemek sayısı: " . count($yemekler));
                error_log("📤 JSON yanıtı: " . json_encode($yemekler));
                echo json_encode($yemekler);
                error_log("=== DÜNYA MUTFAĞI ENDPOINT BİTTİ ===");
                exit;
            }
        }

        // TATLILAR VE HAMUR İŞLERİ ENDPOINT'LERİ
        if (isset($_GET["tatlilar_hamur"])) {
            error_log("=== TATLILAR VE HAMUR İŞLERİ ENDPOINT BAŞLADI ===");
            error_log("Tatlılar ve hamur işleri endpoint çağrıldı");
            if (isset($_GET["id"])) {
                // Belirli tatlıyı getir
                $id = (int)$_GET["id"];
                $sonuc = $baglanti->query("SELECT * FROM tatlilar_hamur WHERE id = $id");
                if ($sonuc && $sonuc->num_rows > 0) {
                    $tatli = $sonuc->fetch_assoc();
                    echo json_encode($tatli);
                } else {
                    echo json_encode(["error" => "Tatlı bulunamadı"]);
                }
                exit;
            } else {
                // Tüm tatlıları getir (limit desteği ile)
                $limit = isset($_GET["limit"]) ? (int)$_GET["limit"] : 0;
                $query = "SELECT * FROM tatlilar_hamur ORDER BY id DESC";
                if ($limit > 0) {
                    $query .= " LIMIT $limit";
                }
                error_log("SQL sorgusu: " . $query);
                $sonuc = $baglanti->query($query);
                
                if (!$sonuc) {
                    error_log("❌ SQL hatası: " . $baglanti->error);
                    echo json_encode([]);
                    exit;
                }
                
                error_log("✅ SQL sorgusu başarılı");
                error_log("📊 Bulunan satır sayısı: " . $sonuc->num_rows);
                
                $tatlilar = [];
                while ($satir = $sonuc->fetch_assoc()) {
                    $tatlilar[] = $satir;
                    error_log("🍰 Tatlı verisi: " . json_encode($satir));
                }
                
                error_log("✅ Bulunan tatlı sayısı: " . count($tatlilar));
                error_log("📤 JSON yanıtı: " . json_encode($tatlilar));
                echo json_encode($tatlilar);
                error_log("=== TATLILAR VE HAMUR İŞLERİ ENDPOINT BİTTİ ===");
                exit;
            }
        }

        // PRATİK TARİFLER ENDPOINT'LERİ
        if (isset($_GET["pratik_tarifler"])) {
            error_log("=== PRATİK TARİFLER ENDPOINT BAŞLADI ===");
            error_log("Pratik tarifler endpoint çağrıldı");
            if (isset($_GET["id"])) {
                // Belirli tarifi getir
                $id = (int)$_GET["id"];
                $sonuc = $baglanti->query("SELECT * FROM pratik_tarifler WHERE id = $id");
                if ($sonuc && $sonuc->num_rows > 0) {
                    $tarif = $sonuc->fetch_assoc();
                    echo json_encode($tarif);
                } else {
                    echo json_encode(["error" => "Tarif bulunamadı"]);
                }
                exit;
            } else {
                // Tüm tarifleri getir (limit desteği ile)
                $limit = isset($_GET["limit"]) ? (int)$_GET["limit"] : 0;
                $query = "SELECT * FROM pratik_tarifler ORDER BY id DESC";
                if ($limit > 0) {
                    $query .= " LIMIT $limit";
                }
                error_log("SQL sorgusu: " . $query);
                $sonuc = $baglanti->query($query);
                
                if (!$sonuc) {
                    error_log("❌ SQL hatası: " . $baglanti->error);
                    echo json_encode([]);
                    exit;
                }
                
                error_log("✅ SQL sorgusu başarılı");
                error_log("📊 Bulunan satır sayısı: " . $sonuc->num_rows);
                
                $tarifler = [];
                while ($satir = $sonuc->fetch_assoc()) {
                    $tarifler[] = $satir;
                    error_log("⚡ Pratik tarif verisi: " . json_encode($satir));
                }
                
                error_log("✅ Bulunan tarif sayısı: " . count($tarifler));
                error_log("📤 JSON yanıtı: " . json_encode($tarifler));
                echo json_encode($tarifler);
                error_log("=== PRATİK TARİFLER ENDPOINT BİTTİ ===");
                exit;
            }
        }

        // SAĞLIKLI BESİNLER ENDPOINT'LERİ
        if (isset($_GET["saglikli_besinler"])) {
            error_log("=== SAĞLIKLI BESİNLER ENDPOINT BAŞLADI ===");
            error_log("Sağlıklı besinler endpoint çağrıldı");
            if (isset($_GET["id"])) {
                // Belirli besini getir
                $id = (int)$_GET["id"];
                $sonuc = $baglanti->query("SELECT * FROM saglikli_besinler WHERE id = $id");
                if ($sonuc && $sonuc->num_rows > 0) {
                    $besin = $sonuc->fetch_assoc();
                    echo json_encode($besin);
                } else {
                    echo json_encode(["error" => "Besin bulunamadı"]);
                }
                exit;
            } else {
                // Tüm besinleri getir (limit desteği ile)
                $limit = isset($_GET["limit"]) ? (int)$_GET["limit"] : 0;
                $query = "SELECT * FROM saglikli_besinler ORDER BY id DESC";
                if ($limit > 0) {
                    $query .= " LIMIT $limit";
                }
                error_log("SQL sorgusu: " . $query);
                $sonuc = $baglanti->query($query);
                
                if (!$sonuc) {
                    error_log("❌ SQL hatası: " . $baglanti->error);
                    echo json_encode([]);
                    exit;
                }
                
                error_log("✅ SQL sorgusu başarılı");
                error_log("📊 Bulunan satır sayısı: " . $sonuc->num_rows);
                
                $besinler = [];
                while ($satir = $sonuc->fetch_assoc()) {
                    $besinler[] = $satir;
                    error_log("🥗 Sağlıklı besin verisi: " . json_encode($satir));
                }
                
                error_log("✅ Bulunan besin sayısı: " . count($besinler));
                error_log("📤 JSON yanıtı: " . json_encode($besinler));
                echo json_encode($besinler);
                error_log("=== SAĞLIKLI BESİNLER ENDPOINT BİTTİ ===");
                exit;
            }
        }



// DELETE: Mesaj sil
if ($_SERVER["REQUEST_METHOD"] === "DELETE" && isset($_GET["mesaj"])) {
    header("Content-Type: application/json");
    error_log("=== MESAJ SİLME BAŞLADI ===");
    
    $mesaj_id = (int)$_GET["id"];
    error_log("Silinecek mesaj ID: $mesaj_id");
    
    // Mesajın var olup olmadığını kontrol et
    $kontrol_sql = "SELECT id FROM iletisim_formu WHERE id = $mesaj_id";
    error_log("Kontrol SQL: " . $kontrol_sql);
    $kontrol = $baglanti->query($kontrol_sql);
    
    if ($kontrol && $kontrol->num_rows > 0) {
        error_log("✅ Mesaj bulundu, silme işlemi başlıyor");
        
        // Silme işlemi
        $sql = "DELETE FROM iletisim_formu WHERE id = $mesaj_id";
        error_log("Silme SQL: " . $sql);
        
        $silme_sonuc = $baglanti->query($sql);
        error_log("Silme sonucu: " . ($silme_sonuc ? "true" : "false"));
        error_log("Etkilenen satır sayısı: " . $baglanti->affected_rows);
        
        if ($silme_sonuc && $baglanti->affected_rows > 0) {
            error_log("✅ Mesaj silindi");
            echo json_encode(["success" => true, "message" => "Mesaj başarıyla silindi"]);
        } else {
            error_log("❌ Mesaj silinirken hata: " . $baglanti->error);
            http_response_code(500);
            echo json_encode(["success" => false, "message" => "Mesaj silinirken hata: " . $baglanti->error]);
        }
    } else {
        error_log("❌ Mesaj bulunamadı (ID: $mesaj_id)");
        http_response_code(404);
        echo json_encode(["success" => false, "message" => "Mesaj bulunamadı"]);
    }
    error_log("=== MESAJ SİLME BİTTİ ===");
    exit;
}

?>