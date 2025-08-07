<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

// Veritabanı bağlantısı
$baglanti = new mysqli("localhost", "root", "", "basit_sistem");

if ($baglanti->connect_error) {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Veritabanı bağlantı hatası: " . $baglanti->connect_error]);
    exit;
}

$baglanti->set_charset("utf8");

// GET: Cevap listesi veya belirli bir cevap
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    
    // Belirli bir mesajın cevaplarını getir
    if (isset($_GET["iletisim_id"])) {
        $iletisim_id = (int)$_GET["iletisim_id"];
        
        $sql = "SELECT mc.*, k.adsoyad as yonetici_adi, k.username as yonetici_username
                FROM mesaj_cevaplari mc 
                LEFT JOIN kisiler k ON mc.cevap_veren_yonetici_user_id = k.id 
                WHERE mc.iletisim_formu_id = ?
                ORDER BY mc.created_at ASC";
        
        $stmt = $baglanti->prepare($sql);
        $stmt->bind_param("i", $iletisim_id);
        $stmt->execute();
        $sonuc = $stmt->get_result();
        
        $cevaplar = [];
        while ($cevap = $sonuc->fetch_assoc()) {
            $cevaplar[] = $cevap;
        }
        
        echo json_encode(["success" => true, "cevaplar" => $cevaplar]);
        exit;
    }
    
    // Tüm cevapları getir
    if (isset($_GET["tum_cevaplar"])) {
        $sql = "SELECT mc.*, k.adsoyad as yonetici_adi, k.username as yonetici_username,
                       if.adisoyadi as mesaj_gonderen, if.konu as mesaj_konu
                FROM mesaj_cevaplari mc 
                LEFT JOIN kisiler k ON mc.cevap_veren_yonetici_user_id = k.id 
                LEFT JOIN iletisim_formu if ON mc.iletisim_formu_id = if.id 
                ORDER BY mc.created_at DESC";
        
        $sonuc = $baglanti->query($sql);
        $cevaplar = [];
        while ($cevap = $sonuc->fetch_assoc()) {
            $cevaplar[] = $cevap;
        }
        
        echo json_encode(["success" => true, "cevaplar" => $cevaplar]);
        exit;
    }
    
    // Belirli bir cevabı getir
    if (isset($_GET["cevap_id"])) {
        $cevap_id = (int)$_GET["cevap_id"];
        
        $sql = "SELECT mc.*, k.adsoyad as yonetici_adi, k.username as yonetici_username
                FROM mesaj_cevaplari mc 
                LEFT JOIN kisiler k ON mc.cevap_veren_yonetici_user_id = k.id 
                WHERE mc.id = ?";
        
        $stmt = $baglanti->prepare($sql);
        $stmt->bind_param("i", $cevap_id);
        $stmt->execute();
        $sonuc = $stmt->get_result();
        
        if ($sonuc->num_rows > 0) {
            $cevap = $sonuc->fetch_assoc();
            echo json_encode(["success" => true, "cevap" => $cevap]);
        } else {
            echo json_encode(["success" => false, "message" => "Cevap bulunamadı"]);
        }
        exit;
    }
    
    // Varsayılan: Tüm cevapları getir
    $sql = "SELECT mc.*, k.adsoyad as yonetici_adi, k.username as yonetici_username,
                   if.adisoyadi as mesaj_gonderen, if.konu as mesaj_konu
            FROM mesaj_cevaplari mc 
            LEFT JOIN kisiler k ON mc.cevap_veren_yonetici_user_id = k.id 
            LEFT JOIN iletisim_formu if ON mc.iletisim_formu_id = if.id 
            ORDER BY mc.created_at DESC";
    
    $sonuc = $baglanti->query($sql);
    $cevaplar = [];
    while ($cevap = $sonuc->fetch_assoc()) {
        $cevaplar[] = $cevap;
    }
    
    echo json_encode(["success" => true, "cevaplar" => $cevaplar]);
    exit;
}

// POST: Yeni cevap ekle
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $girdi = json_decode(file_get_contents("php://input"), true);
    
    // Parametre kontrolü
    if (!isset($girdi["iletisim_formu_id"]) || empty($girdi["iletisim_formu_id"])) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "İletişim formu ID'si gerekli"]);
        exit;
    }
    
    if (!isset($girdi["cevap_mesaji"]) || empty($girdi["cevap_mesaji"])) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Cevap mesajı gerekli"]);
        exit;
    }
    
    // Admin kullanıcısının ID'sini otomatik al
    $admin_sql = "SELECT id FROM kisiler WHERE rol = 'admin' LIMIT 1";
    $admin_result = $baglanti->query($admin_sql);
    if ($admin_result && $admin_result->num_rows > 0) {
        $admin = $admin_result->fetch_assoc();
        $cevap_veren_yonetici_user_id = (int)$admin['id'];
    } else {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Admin kullanıcısı bulunamadı"]);
        exit;
    }
    
    $iletisim_formu_id = (int)$girdi["iletisim_formu_id"];
    $cevap_mesaji = $baglanti->real_escape_string($girdi["cevap_mesaji"]);
    
    // Cevap ID'sini hesapla (aynı mesaj için kaçıncı cevap)
    $cevap_id_sql = "SELECT COUNT(*) as cevap_sayisi FROM mesaj_cevaplari WHERE iletisim_formu_id = ?";
    $stmt = $baglanti->prepare($cevap_id_sql);
    $stmt->bind_param("i", $iletisim_formu_id);
    $stmt->execute();
    $cevap_sayisi = $stmt->get_result()->fetch_assoc()["cevap_sayisi"];
    $cevap_id = $cevap_sayisi + 1;
    
    // Cevabı ekle
    $sql = "INSERT INTO mesaj_cevaplari (iletisim_formu_id, cevap_id, cevap_mesaji, cevap_veren_yonetici_user_id) 
            VALUES (?, ?, ?, ?)";
    
    $stmt = $baglanti->prepare($sql);
    $stmt->bind_param("iisi", $iletisim_formu_id, $cevap_id, $cevap_mesaji, $cevap_veren_yonetici_user_id);
    
    if ($stmt->execute()) {
        $yeni_cevap_id = $baglanti->insert_id;
        echo json_encode([
            "success" => true, 
            "message" => "Cevap başarıyla eklendi",
            "cevap_id" => $yeni_cevap_id,
            "cevap_no" => $cevap_id
        ]);
    } else {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Cevap eklenirken hata: " . $baglanti->error]);
    }
    exit;
}

// PUT: Cevap güncelle
if ($_SERVER["REQUEST_METHOD"] === "PUT") {
    $girdi = json_decode(file_get_contents("php://input"), true);
    
    if (!isset($girdi["cevap_id"]) || empty($girdi["cevap_id"])) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Cevap ID'si gerekli"]);
        exit;
    }
    
    if (!isset($girdi["cevap_mesaji"]) || empty($girdi["cevap_mesaji"])) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Cevap mesajı gerekli"]);
        exit;
    }
    
    $cevap_id = (int)$girdi["cevap_id"];
    $cevap_mesaji = $baglanti->real_escape_string($girdi["cevap_mesaji"]);
    
    $sql = "UPDATE mesaj_cevaplari SET cevap_mesaji = ? WHERE id = ?";
    $stmt = $baglanti->prepare($sql);
    $stmt->bind_param("si", $cevap_mesaji, $cevap_id);
    
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Cevap başarıyla güncellendi"]);
    } else {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Cevap güncellenirken hata: " . $baglanti->error]);
    }
    exit;
}

// DELETE: Cevap sil
if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
    if (!isset($_GET["cevap_id"])) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Cevap ID'si gerekli"]);
        exit;
    }
    
    $cevap_id = (int)$_GET["cevap_id"];
    
    $sql = "DELETE FROM mesaj_cevaplari WHERE id = ?";
    $stmt = $baglanti->prepare($sql);
    $stmt->bind_param("i", $cevap_id);
    
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Cevap başarıyla silindi"]);
    } else {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Cevap silinirken hata: " . $baglanti->error]);
    }
    exit;
}

// Geçersiz istek
http_response_code(405);
echo json_encode(["success" => false, "message" => "Geçersiz istek metodu"]);

$baglanti->close();
?> 