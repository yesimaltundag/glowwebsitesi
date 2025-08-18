<?php
// Hata mesajlarını engelle
error_reporting(0);
ini_set('display_errors', 0);

// Output buffering başlat
ob_start();

// PHPMailer kütüphanesini dahil et
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Saat dilimi yardımcı fonksiyonları
/**
 * E-posta adresinden ülke kodunu çıkarır
 * @param string $email E-posta adresi
 * @return string Ülke kodu (varsayılan: TR)
 */
function getCountryFromEmail($email) {
    // E-posta adresinden domain'i al
    $domain = substr(strrchr($email, "@"), 1);
    
    // Yaygın ülke domain'leri
    $countryDomains = [
        'tr' => ['gmail.com', 'hotmail.com', 'outlook.com', 'yahoo.com', 'yandex.com'],
        'us' => ['gmail.com', 'yahoo.com', 'hotmail.com', 'outlook.com'],
        'uk' => ['gmail.com', 'yahoo.co.uk', 'hotmail.co.uk', 'outlook.co.uk'],
        'de' => ['gmail.com', 'web.de', 'gmx.de', 't-online.de'],
        'fr' => ['gmail.com', 'orange.fr', 'laposte.net', 'free.fr'],
        'it' => ['gmail.com', 'libero.it', 'virgilio.it', 'tiscali.it'],
        'es' => ['gmail.com', 'hotmail.es', 'yahoo.es', 'outlook.es'],
        'nl' => ['gmail.com', 'hotmail.nl', 'outlook.nl', 'yahoo.nl'],
        'ca' => ['gmail.com', 'hotmail.ca', 'outlook.ca', 'yahoo.ca'],
        'au' => ['gmail.com', 'hotmail.com.au', 'outlook.com.au', 'yahoo.com.au'],
        'jp' => ['gmail.com', 'yahoo.co.jp', 'hotmail.co.jp'],
        'kr' => ['gmail.com', 'naver.com', 'daum.net'],
        'cn' => ['gmail.com', 'qq.com', '163.com', '126.com'],
        'in' => ['gmail.com', 'yahoo.in', 'hotmail.in'],
        'br' => ['gmail.com', 'hotmail.com.br', 'outlook.com.br'],
        'mx' => ['gmail.com', 'hotmail.com.mx', 'outlook.com.mx'],
        'ru' => ['gmail.com', 'yandex.ru', 'mail.ru', 'rambler.ru']
    ];
    
    // Domain'e göre ülke kodunu bul
    foreach ($countryDomains as $country => $domains) {
        if (in_array($domain, $domains)) {
            return $country;
        }
    }
    
    // Bulunamazsa varsayılan olarak TR döndür
    return 'TR';
}

/**
 * Ülke koduna göre saat dilimini döndürür
 * @param string $countryCode Ülke kodu
 * @return string Saat dilimi
 */
function getTimezoneByCountry($countryCode) {
    $timezones = [
        'TR' => 'Europe/Istanbul',
        'US' => 'America/New_York',
        'UK' => 'Europe/London',
        'DE' => 'Europe/Berlin',
        'FR' => 'Europe/Paris',
        'IT' => 'Europe/Rome',
        'ES' => 'Europe/Madrid',
        'NL' => 'Europe/Amsterdam',
        'CA' => 'America/Toronto',
        'AU' => 'Australia/Sydney',
        'JP' => 'Asia/Tokyo',
        'KR' => 'Asia/Seoul',
        'CN' => 'Asia/Shanghai',
        'IN' => 'Asia/Kolkata',
        'BR' => 'America/Sao_Paulo',
        'MX' => 'America/Mexico_City',
        'RU' => 'Europe/Moscow'
    ];
    
    return isset($timezones[strtoupper($countryCode)]) ? $timezones[strtoupper($countryCode)] : 'Europe/Istanbul';
}

/**
 * Belirtilen saat diliminde tarih formatını döndürür
 * @param string $timezone Saat dilimi
 * @param string $format Tarih formatı
 * @return string Formatlanmış tarih
 */
function getFormattedDate($timezone, $format = 'd.m.Y H:i:s') {
    $originalTimezone = date_default_timezone_get();
    date_default_timezone_set($timezone);
    $formattedDate = date($format);
    date_default_timezone_set($originalTimezone);
    return $formattedDate;
}

/**
 * Saat dilimi bilgisini Türkçe olarak döndürür
 * @param string $timezone Saat dilimi
 * @return string Türkçe saat dilimi açıklaması
 */
function getTimezoneDescription($timezone) {
    $descriptions = [
        'Europe/Istanbul' => 'Türkiye Saati (UTC+3)',
        'America/New_York' => 'Doğu Amerika Saati (UTC-5)',
        'Europe/London' => 'İngiltere Saati (UTC+0)',
        'Europe/Berlin' => 'Almanya Saati (UTC+1)',
        'Europe/Paris' => 'Fransa Saati (UTC+1)',
        'Europe/Rome' => 'İtalya Saati (UTC+1)',
        'Europe/Madrid' => 'İspanya Saati (UTC+1)',
        'Europe/Amsterdam' => 'Hollanda Saati (UTC+1)',
        'America/Toronto' => 'Kanada Saati (UTC-5)',
        'Australia/Sydney' => 'Avustralya Saati (UTC+10)',
        'Asia/Tokyo' => 'Japonya Saati (UTC+9)',
        'Asia/Seoul' => 'Güney Kore Saati (UTC+9)',
        'Asia/Shanghai' => 'Çin Saati (UTC+8)',
        'Asia/Kolkata' => 'Hindistan Saati (UTC+5:30)',
        'America/Sao_Paulo' => 'Brezilya Saati (UTC-3)',
        'America/Mexico_City' => 'Meksika Saati (UTC-6)',
        'Europe/Moscow' => 'Rusya Saati (UTC+3)'
    ];
    
    return isset($descriptions[$timezone]) ? $descriptions[$timezone] : 'Türkiye Saati (UTC+3)';
}

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

// Veritabanı bağlantısı
$baglanti = new mysqli("localhost", "root", "", "basit_sistem");

if ($baglanti->connect_error) {
    ob_end_clean(); // Buffer'ı temizle
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
        
        ob_end_clean(); // Buffer'ı temizle
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
        
        ob_end_clean(); // Buffer'ı temizle
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
            ob_end_clean(); // Buffer'ı temizle
            echo json_encode(["success" => true, "cevap" => $cevap]);
        } else {
            ob_end_clean(); // Buffer'ı temizle
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
    
    ob_end_clean(); // Buffer'ı temizle
    echo json_encode(["success" => true, "cevaplar" => $cevaplar]);
    exit;
}

// POST: Yeni cevap ekle
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $girdi = json_decode(file_get_contents("php://input"), true);
    
    // Parametre kontrolü
    if (!isset($girdi["iletisim_formu_id"]) || empty($girdi["iletisim_formu_id"])) {
        ob_end_clean(); // Buffer'ı temizle
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "İletişim formu ID'si gerekli"]);
        exit;
    }
    
    if (!isset($girdi["cevap_mesaji"]) || empty($girdi["cevap_mesaji"])) {
        ob_end_clean(); // Buffer'ı temizle
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
        ob_end_clean(); // Buffer'ı temizle
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
        
        // Müşterinin e-posta adresini ve mesaj içeriğini al
        $email_sql = "SELECT eposta, adisoyadi, konu, mesaj FROM iletisim_formu WHERE id = ?";
        $email_stmt = $baglanti->prepare($email_sql);
        $email_stmt->bind_param("i", $iletisim_formu_id);
        $email_stmt->execute();
        $email_result = $email_stmt->get_result();
        
        if ($email_result && $email_result->num_rows > 0) {
            $musteri_bilgi = $email_result->fetch_assoc();
            $musteri_email = $musteri_bilgi['eposta'];
            $musteri_adi = $musteri_bilgi['adisoyadi'];
            $mesaj_konu = $musteri_bilgi['konu'];
            $mesaj_icerik = $musteri_bilgi['mesaj'];
            
            // Müşterinin saat dilimini belirle
            $countryCode = getCountryFromEmail($musteri_email);
            $timezone = getTimezoneByCountry($countryCode);
            $formattedDate = getFormattedDate($timezone);
            $timezoneDescription = getTimezoneDescription($timezone);
            
            // E-posta gönder
            $email_baslik = "GLOW Sitesi - Mesajınıza Cevap";
            $email_icerik = "
            <html>
            <head>
                <meta charset='UTF-8'>
                <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
            </head>
            <body style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
                <div style='max-width: 600px; margin: 0 auto; padding: 20px; background: #f9f9f9;'>
                    <div style='background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);'>
                        <h2 style='color: #7c5c4a; margin-bottom: 20px;'>GLOW Sitesi</h2>
                        <p>Sayın <strong>{$musteri_adi}</strong>,</p>
                        <p>Gönderdiğiniz mesajınıza cevap verildi:</p>
                        
                        <div style='background: #f5f5f5; padding: 15px; border-radius: 8px; margin: 20px 0;'>
                            <h3 style='color: #7c5c4a; margin-top: 0;'>Mesajınız:</h3>
                            <p><strong>Konu:</strong> {$mesaj_konu}</p>
                            <p><strong>Mesajınız:</strong></p>
                            <div style='background: white; padding: 10px; border-radius: 5px; margin-top: 10px; border-left: 3px solid #7c5c4a;'>
                                " .  nl2br(htmlspecialchars($mesaj_icerik)) . "
                            </div>
                        </div>
                        
                        <div style='background: #e8f4f8; padding: 15px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #7c5c4a;'>
                            <h3 style='color: #7c5c4a; margin-top: 0;'>Cevabımız:</h3>
                            <p>" . nl2br(htmlspecialchars($cevap_mesaji)) . "</p>
                        </div>
                        
                        <div style='margin-top: 20px; padding: 15px; background-color: #f8f9fa; border-radius: 5px; border-left: 4px solid #7c5c4a;'>
                            <p style='margin: 0; color: #666; font-size: 14px;'>
                                <strong>Cevap Tarihi:</strong> $formattedDate<br>
                                <strong>Saat Dilimi:</strong> $timezoneDescription
                            </p>
                        </div>
                        
                        <p style='margin-top: 30px; font-size: 14px; color: #666;'>
                            Bu e-posta GLOW sitesi tarafından otomatik olarak gönderilmiştir.<br>
                            Sorularınız için bize ulaşabilirsiniz.
                        </p>
                    </div>
                </div>
            </body>
            </html>";
            
            // PHPMailer ile e-posta gönder
            $mail = new PHPMailer(true);
            try {
                $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Debug kapalı
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'stajteknoprosis@gmail.com';                     //SMTP username
                $mail->Password   = 'keey ejmo fsvd mrii';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                
                // Türkçe karakter ayarları
                $mail->CharSet = 'UTF-8';
                $mail->Encoding = 'base64';
                
                //Recipients
                $mail->setFrom('stajteknoprosis@gmail.com', 'GLOW Sistem');
                $mail->addAddress($musteri_email, $musteri_adi);     //Müşteri e-posta adresi
                $mail->addReplyTo('stajteknoprosis@gmail.com', 'GLOW Destek');

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = $email_baslik;                               //E-posta konusu
                $mail->Body    = $email_icerik;                             //E-posta içeriği
                $mail->AltBody = strip_tags($email_icerik);                 //HTML etiketleri kaldırılmış metin

                $mail->send();
                $email_gonderildi = true;
            } catch (Exception $e) {
                $email_gonderildi = false;
                error_log("Mail gönderme hatası: {$mail->ErrorInfo}");
            }
            
            ob_end_clean(); // Buffer'ı temizle
            echo json_encode([
                "success" => true, 
                "message" => "Cevap başarıyla eklendi ve e-posta gönderildi",
                "cevap_id" => $yeni_cevap_id,
                "cevap_no" => $cevap_id,
                "email_sent" => $email_gonderildi,
                "customer_email" => $musteri_email
            ]);
        } else {
            ob_end_clean(); // Buffer'ı temizle
            echo json_encode([
                "success" => true, 
                "message" => "Cevap başarıyla eklendi fakat müşteri bilgileri bulunamadı",
                "cevap_id" => $yeni_cevap_id,
                "cevap_no" => $cevap_id,
                "email_sent" => false
            ]);
        }
    } else {
        ob_end_clean(); // Buffer'ı temizle
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Cevap eklenirken hata: " . $baglanti->error]);
    }
    exit;
}

// PUT: Cevap güncelle
if ($_SERVER["REQUEST_METHOD"] === "PUT") {
    $girdi = json_decode(file_get_contents("php://input"), true);
    
    if (!isset($girdi["cevap_id"]) || empty($girdi["cevap_id"])) {
        ob_end_clean(); // Buffer'ı temizle
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Cevap ID'si gerekli"]);
        exit;
    }
    
    if (!isset($girdi["cevap_mesaji"]) || empty($girdi["cevap_mesaji"])) {
        ob_end_clean(); // Buffer'ı temizle
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
        ob_end_clean(); // Buffer'ı temizle
        echo json_encode(["success" => true, "message" => "Cevap başarıyla güncellendi"]);
    } else {
        ob_end_clean(); // Buffer'ı temizle
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Cevap güncellenirken hata: " . $baglanti->error]);
    }
    exit;
}

// DELETE: Cevap sil
if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
    if (!isset($_GET["cevap_id"])) {
        ob_end_clean(); // Buffer'ı temizle
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Cevap ID'si gerekli"]);
        exit;
    }
    
    $cevap_id = (int)$_GET["cevap_id"];
    
    $sql = "DELETE FROM mesaj_cevaplari WHERE id = ?";
    $stmt = $baglanti->prepare($sql);
    $stmt->bind_param("i", $cevap_id);
    
    if ($stmt->execute()) {
        ob_end_clean(); // Buffer'ı temizle
        echo json_encode(["success" => true, "message" => "Cevap başarıyla silindi"]);
    } else {
        ob_end_clean(); // Buffer'ı temizle
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Cevap silinirken hata: " . $baglanti->error]);
    }
    exit;
}

// Geçersiz istek
ob_end_clean(); // Buffer'ı temizle
http_response_code(405);
echo json_encode(["success" => false, "message" => "Geçersiz istek metodu"]);

$baglanti->close();
?> 