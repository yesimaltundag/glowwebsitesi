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

// GET: Kullanıcıları getir
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["kisiler"])) {
    header("Content-Type: application/json");
    error_log("Kisiler endpoint çağrıldı");
    
    $sonuc = $baglanti->query("SELECT id, username, adsoyad, e_posta, rol FROM kisiler ORDER BY id ASC");
    $kisiler = [];
    while ($satir = $sonuc->fetch_assoc()) {
        $kisiler[] = $satir;
    }
    error_log("Bulunan kullanıcı sayısı: " . count($kisiler));
    echo json_encode($kisiler);
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
        // Tüm tiyatro eserlerini getir
        $sonuc = $baglanti->query("SELECT * FROM tiyatro_eserleri ORDER BY puan DESC");
        $tiyatro_eserleri = [];
        while ($satir = $sonuc->fetch_assoc()) {
            $tiyatro_eserleri[] = $satir;
        }
        echo json_encode($tiyatro_eserleri);
        exit;
    }
}

// Belgesel API endpoint'leri
if (isset($_GET["belgesel"])) {
    if (isset($_GET["id"])) {
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
        // Tüm belgeselleri getir
        $sonuc = $baglanti->query("SELECT * FROM belgeseller ORDER BY puan DESC");
        $belgeseller = [];
        while ($satir = $sonuc->fetch_assoc()) {
            $belgeseller[] = $satir;
        }
        echo json_encode($belgeseller);
        exit;
    }
}

// Anime API endpoint'leri
if (isset($_GET["anime"])) {
    if (isset($_GET["id"])) {
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
        // Tüm animeleri getir
        $sonuc = $baglanti->query("SELECT * FROM animeler ORDER BY puan DESC");
        $animeler = [];
        while ($satir = $sonuc->fetch_assoc()) {
            $animeler[] = $satir;
        }
        echo json_encode($animeler);
        exit;
    }
}

// GET: Listeleme (varsayılan) - Sadece belirli parametreler yoksa
if ($_SERVER["REQUEST_METHOD"] === "GET" && !isset($_GET["yorum"]) && !isset($_GET["films"]) && !isset($_GET["tiyatro"]) && !isset($_GET["belgesel"]) && !isset($_GET["anime"]) && !isset($_GET["son_yorumlar"]) && !isset($_GET["tum_yorumlar"]) && !isset($_GET["kisiler"])) {
    $sonuc = $baglanti->query("SELECT id, username, adsoyad, e_posta, rol FROM kisiler ORDER BY id ASC");
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
    $yorum = $baglanti->real_escape_string($girdi["yorum"]);
    $puan = (int)$girdi["puan"];
    
    // Validasyon
    if ($puan < 1 || $puan > 10) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Puan 1-10 arasında olmalıdır"]);
        exit;
    }
    
    if (strlen($yorum) < 10) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Yorum en az 10 karakter olmalıdır"]);
        exit;
    }
    
    $sql = "INSERT INTO yorumlar (kullanici_id, kullanici_adi, tur, icerik_id, icerik_adi, yorum, puan, created_at) 
            VALUES ($kullanici_id, '$kullanici_adi', '$tur', $icerik_id, '$icerik_adi', '$yorum', $puan, NOW())";
    
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
                    VALUES ('$username', '$email', '$message', 'İletişim Formu')";
    
    if ($baglanti->query($insert_sql)) {
        echo json_encode(["success" => true, "message" => "Mesaj başarıyla gönderildi."]);
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