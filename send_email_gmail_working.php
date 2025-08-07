<?php
header("Content-Type: application/json; charset=UTF-8");

// Gmail SMTP ile e-posta gönderme
function sendEmailGmail($to, $subject, $message, $from_name = "GLOW Sitesi") {
    // Gmail SMTP ayarları
    $smtp_host = 'smtp.gmail.com';
    $smtp_port = 587;
    $smtp_username = 'your-email@gmail.com'; // Gmail adresiniz
    $smtp_password = 'your-app-password'; // App Password
    
    // E-posta içeriği
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
            .reply-box { background: #fff; border: 2px solid #4caf50; border-radius: 8px; padding: 15px; margin: 15px 0; }
            .admin-info { background: #e8f5e8; padding: 10px; border-radius: 6px; margin: 10px 0; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h2>💬 GLOW - Mesaj Cevabı</h2>
            </div>
            <div class='content'>
                <p>Merhaba,</p>
                <p>İletişim formunuz için gönderdiğiniz mesaja cevap verilmiştir.</p>
                
                <div class='reply-box'>
                    <h4>💬 Cevabımız:</h4>
                    <div class='admin-info'>
                        <p><strong>👤 Admin:</strong> GLOW Yönetimi</p>
                        <p><strong>📅 Tarih:</strong> " . date('d.m.Y H:i') . "</p>
                    </div>
                    <p>$message</p>
                </div>
                
                <p>Başka sorularınız için bizimle iletişime geçebilirsiniz.</p>
                <p>Teşekkürler,<br><strong>GLOW Ekibi</strong></p>
            </div>
            <div class='footer'>
                <p>Bu e-posta otomatik olarak gönderilmiştir. Lütfen cevaplamayınız.</p>
            </div>
        </div>
    </body>
    </html>";
    
    // Basit mail() fonksiyonu ile gönder (Gmail ayarları ile)
    $headers = array(
        'MIME-Version: 1.0',
        'Content-type: text/html; charset=UTF-8',
        'From: ' . $from_name . ' <' . $smtp_username . '>',
        'Reply-To: ' . $smtp_username,
        'X-Mailer: PHP/' . phpversion()
    );
    
    // Gmail SMTP ayarlarını zorla
    ini_set('SMTP', $smtp_host);
    ini_set('smtp_port', $smtp_port);
    ini_set('sendmail_from', $smtp_username);
    
    return mail($to, $subject, $html_message, implode("\r\n", $headers));
}

// GET: Test sayfası göster
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    header("Content-Type: text/html; charset=UTF-8");
    
    echo "<h2>📧 Gmail SMTP E-posta Testi</h2>";
    echo "<p>Bu sayfa Gmail SMTP ile e-posta gönderir.</p>";
    
    echo "<h3>⚙️ Kurulum Adımları:</h3>";
    echo "<ol>";
    echo "<li>Gmail hesabınızda <strong>2 Adımlı Doğrulama</strong> açın</li>";
    echo "<li><strong>App Password</strong> oluşturun</li>";
    echo "<li>Dosyada Gmail bilgilerinizi girin</li>";
    echo "<li>Test edin!</li>";
    echo "</ol>";
    
    echo "<h3>🔧 Gmail App Password Nasıl Alınır:</h3>";
    echo "<ol>";
    echo "<li>Gmail → Google Hesabı → Güvenlik</li>";
    echo "<li>2 Adımlı Doğrulama → Açık</li>";
    echo "<li>Uygulama Şifreleri → Yeni</li>";
    echo "<li>Şifreyi kopyalayın</li>";
    echo "</ol>";
    
    echo "<h3>📝 Dosyada Değiştirilecek Yerler:</h3>";
    echo "<p><strong>Line 8:</strong> your-email@gmail.com → Gmail adresiniz</p>";
    echo "<p><strong>Line 9:</strong> your-app-password → App Password</p>";
    
    echo "<h3>🧪 Test E-posta Gönder:</h3>";
    echo "<form method='POST'>";
    echo "<p><strong>E-posta:</strong> <input type='email' name='email' value='emresabahat@outlook.com' required></p>";
    echo "<p><strong>Mesaj:</strong> <textarea name='message' required>Bu bir Gmail SMTP test e-postasıdır!</textarea></p>";
    echo "<p><input type='submit' value='E-posta Gönder'></p>";
    echo "</form>";
    
    exit;
}

// POST: E-posta gönder
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST["message"]);
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["success" => false, "message" => "Geçersiz e-posta adresi"]);
        exit;
    }
    
    $subject = "GLOW - Gmail SMTP Testi";
    $result = sendEmailGmail($email, $subject, $message);
    
    if ($result) {
        echo json_encode(["success" => true, "message" => "E-posta başarıyla gönderildi!"]);
    } else {
        echo json_encode(["success" => false, "message" => "E-posta gönderilirken hata oluştu"]);
    }
} else {
    http_response_code(405);
    echo json_encode(["success" => false, "message" => "Sadece GET ve POST metodu desteklenir"]);
}
?> 