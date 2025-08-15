<?php
/**
 * GLOW İletişim Formu - E-posta Konfigürasyonu
 * 
 * Bu dosyada e-posta gönderme ayarları bulunmaktadır.
 * Gmail kullanarak SMTP üzerinden e-posta gönderimi yapılmaktadır.
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
define('EMAIL_TO_ADDRESS', 'emresabahat@outlook.com'); // Admin e-posta adresi
define('EMAIL_TO_NAME', 'GLOW Admin');

// Gmail App Password Nasıl Alınır:
// 1. Google Hesabınıza gidin
// 2. Güvenlik > 2 Adımlı Doğrulama'yı açın
// 3. Uygulama Şifreleri > Diğer > "GLOW İletişim" yazın
// 4. Oluşturulan 16 haneli şifreyi EMAIL_PASSWORD'e yazın

// E-posta Şablonu
function getEmailTemplate($username, $email, $konu, $message) {
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
                    <strong>Gönderim Tarihi:</strong> " . date('d.m.Y H:i:s') . "<br>
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

Gönderim Tarihi: " . date('d.m.Y H:i:s') . "
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
