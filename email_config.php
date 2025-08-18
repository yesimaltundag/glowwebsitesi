<?php
/**
 * GLOW İletişim Formu - E-posta Konfigürasyonu
 * 
 * Bu dosyada e-posta gönderme ayarları bulunmaktadır.
 * Gmail kullanarak SMTP üzerinden e-posta gönderimi yapılmaktadır.
 * Saat dilimi desteği eklenmiştir.
 */

// PHPMailer namespace'lerini dahil et
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// E-posta Konfigürasyonu
define('EMAIL_HOST', 'smtp.gmail.com');
define('EMAIL_PORT', 465);
define('EMAIL_USERNAME', 'stajteknoprosis@gmail.com'); // Gmail adresinizi buraya yazın
define('EMAIL_PASSWORD', 'keey ejmo fsvd mrii'); // Gmail App Password buraya
define('EMAIL_FROM_NAME', 'GLOW İletişim Formu');
define('EMAIL_TO_ADDRESS', 'stajteknoprosis@gmail.com'); // Admin e-posta adresi
define('EMAIL_TO_NAME', 'GLOW Admin');

// Gmail App Password Nasıl Alınır:
// 1. Google Hesabınıza gidin
// 2. Güvenlik > 2 Adımlı Doğrulama'yı açın
// 3. Uygulama Şifreleri > Diğer > "GLOW İletişim" yazın
// 4. Oluşturulan 16 haneli şifreyi EMAIL_PASSWORD'e yazın

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

// E-posta Şablonu
function getEmailTemplate($username, $email, $konu, $message) {
    // E-posta adresinden ülke kodunu al
    $countryCode = getCountryFromEmail($email);
    $timezone = getTimezoneByCountry($countryCode);
    $formattedDate = getFormattedDate($timezone);
    $timezoneDescription = getTimezoneDescription($timezone);
    
    $html_body = "
    <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f9f9f9;'>
        <div style='background-color: #7c5c4a; color: white; padding: 20px; text-align: center; border-radius: 8px 8px 0 0;'>
            <h2 style='margin: 0;'>GLOW İletişim Formu</h2>
            <p style='margin: 5px 0 0 0;'>Yeni mesaj alındı</p>
        </div>
        
        <div style='background-color: white; padding: 20px; border-radius: 0 0 8px 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);'>
            <table style='width: 100%; border-collapse: collapse;'>
                <tr>
                    <td style='padding: 10px 0; border-bottom: 1px solid #eee; font-weight: bold; color: #7c5c4a;'>Gönderen:</td>
                    <td style='padding: 10px 0; border-bottom: 1px solid #eee;'>$username</td>
                </tr>
                <tr>
                    <td style='padding: 10px 0; border-bottom: 1px solid #eee; font-weight: bold; color: #7c5c4a;'>E-posta:</td>
                    <td style='padding: 10px 0; border-bottom: 1px solid #eee;'>$email</td>
                </tr>
                <tr>
                    <td style='padding: 10px 0; border-bottom: 1px solid #eee; font-weight: bold; color: #7c5c4a;'>Konu:</td>
                    <td style='padding: 10px 0; border-bottom: 1px solid #eee;'>$konu</td>
                </tr>
                <tr>
                    <td style='padding: 10px 0; font-weight: bold; color: #7c5c4a; vertical-align: top;'>Mesaj:</td>
                    <td style='padding: 10px 0;'>" . nl2br(htmlspecialchars($message)) . "</td>
                </tr>
            </table>
            
            <div style='margin-top: 20px; padding: 15px; background-color: #f8f9fa; border-radius: 5px; border-left: 4px solid #7c5c4a;'>
                <p style='margin: 0; color: #666; font-size: 14px;'>
                    <strong>Gönderim Tarihi:</strong> $formattedDate<br>
                    <strong>Saat Dilimi:</strong> $timezoneDescription<br>
                    <strong>IP Adresi:</strong> " . $_SERVER['REMOTE_ADDR'] . "
                </p>
            </div>
        </div>
        
        <div style='text-align: center; margin-top: 20px; color: #666; font-size: 12px;'>
            <p>Bu e-posta GLOW web sitesi iletişim formundan otomatik olarak gönderilmiştir.</p>
        </div>
    </div>";

    $text_body = "
GLOW İletişim Formu - Yeni Mesaj

Gönderen: $username
E-posta: $email
Konu: $konu
Mesaj: $message

Gönderim Tarihi: $formattedDate
Saat Dilimi: $timezoneDescription
IP Adresi: " . $_SERVER['REMOTE_ADDR'] . "

Bu e-posta GLOW web sitesi iletişim formundan otomatik olarak gönderilmiştir.";

    return [
        'html' => $html_body,
        'text' => $text_body
    ];
}

// E-posta Gönderme Fonksiyonu
function sendContactEmail($username, $email, $konu, $message) {
    try {
        // PHPMailer kütüphanelerini dahil et
        require_once 'PHPMailer/src/Exception.php';
        require_once 'PHPMailer/src/PHPMailer.php';
        require_once 'PHPMailer/src/SMTP.php';

        // PHPMailer instance oluştur
        $mail = new PHPMailer(true);

        // SMTP ayarları
        $mail->isSMTP();
        $mail->Host = EMAIL_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = EMAIL_USERNAME;
        $mail->Password = EMAIL_PASSWORD;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = EMAIL_PORT;
        $mail->CharSet = 'UTF-8';

        // Gönderici ve alıcı ayarları
        $mail->setFrom(EMAIL_USERNAME, EMAIL_FROM_NAME);
        $mail->addAddress(EMAIL_TO_ADDRESS, EMAIL_TO_NAME);
        $mail->addReplyTo($email, $username);

        // E-posta içeriği
        $mail->isHTML(true);
        $mail->Subject = 'GLOW - Yeni İletişim Mesajı: ' . $konu;
        
        // E-posta şablonunu al
        $template = getEmailTemplate($username, $email, $konu, $message);
        $mail->Body = $template['html'];
        $mail->AltBody = $template['text'];

        // E-postayı gönder
        $mail->send();
        error_log("✅ E-posta başarıyla gönderildi: $email");
        return true;
        
    } catch (Exception $e) {
        error_log("❌ E-posta gönderme hatası: " . $mail->ErrorInfo);
        return false;
    }
}
?>
