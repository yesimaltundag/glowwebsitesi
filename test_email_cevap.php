<?php
// E-posta gönderme testi
echo "<h2>📧 E-posta Gönderme Testi</h2>";

// PHP mail ayarlarını kontrol et
echo "<h3>🔧 PHP Mail Ayarları:</h3>";
echo "<p><strong>SMTP:</strong> " . ini_get('SMTP') . "</p>";
echo "<p><strong>smtp_port:</strong> " . ini_get('smtp_port') . "</p>";
echo "<p><strong>sendmail_from:</strong> " . ini_get('sendmail_from') . "</p>";
echo "<p><strong>sendmail_path:</strong> " . ini_get('sendmail_path') . "</p>";

// Test e-postası gönder
$to = "test@example.com"; // Test e-postası
$subject = "GLOW Sitesi - E-posta Testi";
$message = "
<html>
<body style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
    <div style='max-width: 600px; margin: 0 auto; padding: 20px; background: #f9f9f9;'>
        <div style='background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);'>
            <h2 style='color: #7c5c4a; margin-bottom: 20px;'>GLOW Sitesi</h2>
            <p>Bu bir test e-postasıdır.</p>
            <p>E-posta gönderme sistemi çalışıyor!</p>
            <p style='margin-top: 30px; font-size: 14px; color: #666;'>
                Gönderilme zamanı: " . date('d.m.Y H:i:s') . "
            </p>
        </div>
    </div>
</body>
</html>";

$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
$headers .= "From: GLOW Sitesi <noreply@glow.com>\r\n";
$headers .= "Reply-To: noreply@glow.com\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

echo "<h3>📤 Test E-postası Gönderiliyor...</h3>";

$result = mail($to, $subject, $message, $headers);

if ($result) {
    echo "<p style='color: green;'>✅ E-posta başarıyla gönderildi!</p>";
    echo "<p><strong>Alıcı:</strong> $to</p>";
    echo "<p><strong>Konu:</strong> $subject</p>";
} else {
    echo "<p style='color: red;'>❌ E-posta gönderilemedi!</p>";
}

echo "<h3>📋 WAMP Mail Ayarları:</h3>";
echo "<p>WAMP'ta e-posta göndermek için şu ayarları yapmanız gerekebilir:</p>";
echo "<ol>";
echo "<li>WAMP'ı yönetici olarak çalıştırın</li>";
echo "<li>php.ini dosyasını düzenleyin (C:\\wamp64\\bin\\php\\php8.x.x\\php.ini)</li>";
echo "<li>SMTP = localhost</li>";
echo "<li>smtp_port = 25</li>";
echo "<li>sendmail_from = your-email@domain.com</li>";
echo "<li>sendmail_path = \"C:\\wamp64\\bin\\sendmail\\sendmail.exe -t\"</li>";
echo "</ol>";

echo "<h3>🔗 Test Linkleri:</h3>";
echo "<p><a href='http://localhost/test2/mesaj-yonetimi.php' target='_blank'>Mesaj Yönetimi</a></p>";
echo "<p><a href='http://localhost/test2/iletisim.html' target='_blank'>İletişim Formu</a></p>";
?> 