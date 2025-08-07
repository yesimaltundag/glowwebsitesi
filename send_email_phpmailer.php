<?php
header("Content-Type: text/html; charset=UTF-8");

// PHPMailer kullanarak Gmail SMTP ile e-posta gönderme
function sendEmailPHPMailer($to, $subject, $message, $from_name = "GLOW Sitesi") {
    // PHPMailer sınıflarını dahil et
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';
    require 'PHPMailer/Exception.php';
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    // PHPMailer nesnesi oluştur
    $mail = new PHPMailer(true);
    
    try {
        // Gmail SMTP ayarları
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@gmail.com'; // Gmail adresiniz
        $mail->Password = 'your-app-password'; // App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->CharSet = 'UTF-8';
        
        // Gönderici ve alıcı
        $mail->setFrom('your-email@gmail.com', $from_name);
        $mail->addAddress($to);
        
        // E-posta içeriği
        $mail->isHTML(true);
        $mail->Subject = $subject;
        
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
        
        $mail->Body = $html_message;
        
        // E-postayı gönder
        $mail->send();
        return true;
        
    } catch (Exception $e) {
        return false;
    }
}

// GET: Test sayfası göster
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    echo "<h2>📧 PHPMailer Gmail SMTP Testi</h2>";
    echo "<p>Bu sayfa PHPMailer ile Gmail SMTP e-posta gönderir.</p>";
    
    echo "<h3>⚙️ Kurulum Adımları:</h3>";
    echo "<ol>";
    echo "<li>PHPMailer kütüphanesini indirin</li>";
    echo "<li>PHPMailer klasörünü projeye ekleyin</li>";
    echo "<li>Gmail bilgilerinizi kontrol edin</li>";
    echo "<li>Test edin!</li>";
    echo "</ol>";
    
    echo "<h3>📥 PHPMailer İndirme:</h3>";
    echo "<p><a href='https://github.com/PHPMailer/PHPMailer/archive/refs/heads/master.zip' target='_blank'>PHPMailer İndir</a></p>";
    echo "<p>İndirdikten sonra <strong>PHPMailer</strong> klasörünü projeye ekleyin.</p>";
    
    echo "<h3>🧪 Test E-posta Gönder:</h3>";
    echo "<form method='POST'>";
    echo "<p><strong>E-posta:</strong> <input type='email' name='email' value='emresabahat@outlook.com' required></p>";
    echo "<p><strong>Mesaj:</strong> <textarea name='message' required>Bu bir PHPMailer test e-postasıdır!</textarea></p>";
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
    
    $subject = "GLOW - PHPMailer Testi";
    $result = sendEmailPHPMailer($email, $subject, $message);
    
    if ($result) {
        echo json_encode(["success" => true, "message" => "E-posta başarıyla gönderildi!"]);
    } else {
        echo json_encode(["success" => false, "message" => "E-posta gönderilirken hata oluştu. PHPMailer kurulu mu?"]);
    }
} else {
    http_response_code(405);
    echo json_encode(["success" => false, "message" => "Sadece GET ve POST metodu desteklenir"]);
}
?> 