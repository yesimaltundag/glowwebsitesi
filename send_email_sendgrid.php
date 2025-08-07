<?php
header("Content-Type: application/json; charset=UTF-8");

// SendGrid ile e-posta gönderme
function sendEmailSendGrid($to, $subject, $message, $from_name = "GLOW Sitesi") {
    // SendGrid API Key - Ücretsiz hesap için
    $api_key = 'SG.YOUR_API_KEY'; // SendGrid API Key buraya
    
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
    
    // SendGrid API isteği
    $data = array(
        'personalizations' => array(
            array(
                'to' => array(
                    array('email' => $to)
                )
            )
        ),
        'from' => array(
            'email' => 'noreply@glow.com',
            'name' => $from_name
        ),
        'subject' => $subject,
        'content' => array(
            array(
                'type' => 'text/html',
                'value' => $html_message
            )
        )
    );
    
    // cURL ile SendGrid API'ye gönder
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.sendgrid.com/v3/mail/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer ' . $api_key,
        'Content-Type: application/json'
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    return $http_code === 202; // 202 = Başarılı
}

// API endpoint
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $input = json_decode(file_get_contents("php://input"), true);
    
    if (!isset($input["email"]) || !isset($input["message"])) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "E-posta ve mesaj gerekli"]);
        exit;
    }
    
    $email = filter_var($input["email"], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($input["message"]);
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Geçersiz e-posta adresi"]);
        exit;
    }
    
    $subject = "GLOW - Mesajınıza Cevap";
    $result = sendEmailSendGrid($email, $subject, $message);
    
    if ($result) {
        echo json_encode(["success" => true, "message" => "E-posta başarıyla gönderildi"]);
    } else {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "E-posta gönderilirken hata oluştu"]);
    }
} else {
    http_response_code(405);
    echo json_encode(["success" => false, "message" => "Sadece POST metodu desteklenir"]);
}
?> 