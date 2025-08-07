<?php
// E-posta gönderme testi
header("Content-Type: text/html; charset=UTF-8");

echo "<h2>📧 E-posta Gönderme Testi</h2>";

// Test e-posta adresi
$test_email = "test@example.com"; // Buraya gerçek e-posta adresinizi yazın
$test_message = "Bu bir test mesajıdır. E-posta sistemi çalışıyor!";

echo "<p><strong>Test E-posta:</strong> $test_email</p>";
echo "<p><strong>Test Mesaj:</strong> $test_message</p>";

// Basit mail() fonksiyonu ile test
function testEmail($to, $subject, $message) {
    $headers = array(
        'MIME-Version: 1.0',
        'Content-type: text/html; charset=UTF-8',
        'From: GLOW Sitesi <noreply@glow.com>',
        'Reply-To: noreply@glow.com',
        'X-Mailer: PHP/' . phpversion()
    );
    
    $html_message = "
    <html>
    <head>
        <title>$subject</title>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background: linear-gradient(135deg, #e2d9d0, #b48a78); color: #7c5c4a; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
            .content { background: #f9f9f9; padding: 20px; border-radius: 0 0 8px 8px; }
            .footer { text-align: center; margin-top: 20px; color: #666; font-size: 12px; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h2>🧪 GLOW - E-posta Testi</h2>
            </div>
            <div class='content'>
                <p>Merhaba,</p>
                <p>Bu bir test e-postasıdır. E-posta sistemi çalışıyor!</p>
                <p><strong>Test Mesajı:</strong> $message</p>
                <p><strong>Test Tarihi:</strong> " . date('d.m.Y H:i:s') . "</p>
                <p>Teşekkürler,<br><strong>GLOW Ekibi</strong></p>
            </div>
            <div class='footer'>
                <p>Bu e-posta test amaçlı gönderilmiştir.</p>
            </div>
        </div>
    </body>
    </html>";
    
    return mail($to, $subject, $html_message, implode("\r\n", $headers));
}

// Test et
$subject = "GLOW - E-posta Testi";
$result = testEmail($test_email, $subject, $test_message);

if ($result) {
    echo "<p style='color: green;'>✅ E-posta başarıyla gönderildi!</p>";
    echo "<p>E-posta kutunuzu kontrol edin.</p>";
} else {
    echo "<p style='color: red;'>❌ E-posta gönderilemedi!</p>";
    echo "<p>Olası nedenler:</p>";
    echo "<ul>";
    echo "<li>SMTP ayarları eksik</li>";
    echo "<li>Mail server çalışmıyor</li>";
    echo "<li>Firewall engellemesi</li>";
    echo "</ul>";
}

// PHP mail ayarlarını kontrol et
echo "<h3>🔧 PHP Mail Ayarları:</h3>";
echo "<p><strong>SMTP:</strong> " . ini_get('SMTP') . "</p>";
echo "<p><strong>SMTP Port:</strong> " . ini_get('smtp_port') . "</p>";
echo "<p><strong>Sendmail From:</strong> " . ini_get('sendmail_from') . "</p>";

// WAMP mail ayarları
echo "<h3>📋 WAMP Mail Ayarları:</h3>";
echo "<p>1. <strong>C:\\wamp64\\bin\\php\\php8.x.x\\php.ini</strong> dosyasını açın</p>";
echo "<p>2. [mail function] bölümünde şunları ekleyin:</p>";
echo "<pre>";
echo "[mail function]\n";
echo "SMTP = localhost\n";
echo "smtp_port = 25\n";
echo "sendmail_from = noreply@glow.com\n";
echo "</pre>";
echo "<p>3. WAMP'ı yeniden başlatın</p>";
?> 