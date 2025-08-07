<?php
header("Content-Type: text/html; charset=UTF-8");

echo "<h2>📧 Basit E-posta Test Sayfası</h2>";

// WAMP mail ayarlarını kontrol et
echo "<h3>📋 Mevcut Mail Ayarları:</h3>";
echo "<p><strong>SMTP:</strong> " . ini_get('SMTP') . "</p>";
echo "<p><strong>SMTP Port:</strong> " . ini_get('smtp_port') . "</p>";
echo "<p><strong>Sendmail From:</strong> " . ini_get('sendmail_from') . "</p>";

// Mail ayarlarını dinamik olarak değiştir
echo "<h3>⚙️ Mail Ayarlarını Değiştiriyorum...</h3>";

ini_set('SMTP', 'localhost');
ini_set('smtp_port', '25');
ini_set('sendmail_from', 'noreply@glow.com');

echo "<p>✅ SMTP: localhost</p>";
echo "<p>✅ SMTP Port: 25</p>";
echo "<p>✅ Sendmail From: noreply@glow.com</p>";

// Test e-posta gönder
echo "<h3>🧪 Test E-posta Gönderiyorum...</h3>";

$test_email = "emresabahat@outlook.com"; // Test e-posta adresi
$subject = "GLOW - Basit Mail Testi";
$message = "Bu bir basit test e-postasıdır. WAMP mail ayarları çalışıyor!";

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
            <h2>🧪 GLOW - Basit Mail Testi</h2>
        </div>
        <div class='content'>
            <p>Merhaba,</p>
            <p>Bu bir basit test e-postasıdır. WAMP mail ayarları çalışıyor!</p>
            <p><strong>Test Tarihi:</strong> " . date('d.m.Y H:i:s') . "</p>
            <p>Teşekkürler,<br><strong>GLOW Ekibi</strong></p>
        </div>
        <div class='footer'>
            <p>Bu e-posta test amaçlı gönderilmiştir.</p>
        </div>
    </div>
</body>
</html>";

$result = mail($test_email, $subject, $html_message, implode("\r\n", $headers));

if ($result) {
    echo "<p style='color: green;'>✅ Test e-postası başarıyla gönderildi!</p>";
    echo "<p>E-posta adresinizi kontrol edin: <strong>$test_email</strong></p>";
    echo "<p><strong>Spam/Junk klasörlerini de kontrol edin!</strong></p>";
} else {
    echo "<p style='color: red;'>❌ Test e-postası gönderilemedi!</p>";
    echo "<p>WAMP mail server çalışmıyor olabilir.</p>";
}

echo "<h3>📋 Manuel Ayarlar (Gerekirse):</h3>";
echo "<p>1. <strong>C:\\wamp64\\bin\\php\\php8.x.x\\php.ini</strong> dosyasını açın</p>";
echo "<p>2. [mail function] bölümünde şunları ekleyin:</p>";
echo "<pre>";
echo "[mail function]\n";
echo "SMTP = localhost\n";
echo "smtp_port = 25\n";
echo "sendmail_from = noreply@glow.com\n";
echo "</pre>";
echo "<p>3. WAMP'ı yeniden başlatın</p>";

echo "<h3>🔗 Test Linkleri:</h3>";
echo "<p><a href='send_email_wamp_simple.php' target='_blank'>📧 WAMP Mail Test</a></p>";
echo "<p><a href='mesaj-yonetimi.php' target='_blank'>💬 Mesaj Yönetimi</a></p>";
?> 