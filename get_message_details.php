<?php
header("Content-Type: application/json; charset=UTF-8");

// Veritabanı bağlantısı
$baglanti = new mysqli("localhost", "root", "", "basit_sistem");

if ($baglanti->connect_error) {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Veritabanı bağlantı hatası: " . $baglanti->connect_error]);
    exit;
}

$baglanti->set_charset("utf8");

// Mesaj ID'sini al
if (!isset($_GET["id"])) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Mesaj ID'si gerekli"]);
    exit;
}

$message_id = (int)$_GET["id"];

// Mesaj detaylarını getir
$message_sql = "SELECT * FROM iletisim_formu WHERE id = ?";
$stmt = $baglanti->prepare($message_sql);
$stmt->bind_param("i", $message_id);
$stmt->execute();
$message_result = $stmt->get_result();

if ($message_result->num_rows === 0) {
    echo json_encode(["success" => false, "message" => "Mesaj bulunamadı"]);
    exit;
}

$message = $message_result->fetch_assoc();

// Bu mesajın cevaplarını getir
$replies_sql = "SELECT mc.*, k.adsoyad as yonetici_adi, k.username as yonetici_username
                 FROM mesaj_cevaplari mc 
                 LEFT JOIN kisiler k ON mc.cevap_veren_yonetici_user_id = k.id 
                 WHERE mc.iletisim_formu_id = ?
                 ORDER BY mc.created_at ASC";

$stmt = $baglanti->prepare($replies_sql);
$stmt->bind_param("i", $message_id);
$stmt->execute();
$replies_result = $stmt->get_result();

$replies = [];
while ($reply = $replies_result->fetch_assoc()) {
    $replies[] = $reply;
}

// Sonucu döndür
echo json_encode([
    "success" => true,
    "message" => $message,
    "replies" => $replies
]);

$baglanti->close();
?> 