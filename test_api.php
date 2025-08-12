<?php
// API test dosyası
header('Content-Type: application/json');

$baglanti = new mysqli("localhost", "root", "", "basit_sistem");

if ($baglanti->connect_error) {
    echo json_encode(["error" => "Veritabanı bağlantı hatası: " . $baglanti->connect_error]);
    exit;
}

// Klasik müzik şarkılarını getir
$tur = "Klasik";
$query = "SELECT * FROM muzikler WHERE tur = '$tur' ORDER BY yayin_yili DESC";
$sonuc = $baglanti->query($query);

if (!$sonuc) {
    echo json_encode(["error" => "SQL hatası: " . $baglanti->error]);
    exit;
}

$sarkilar = [];
while ($satir = $sonuc->fetch_assoc()) {
    $sarkilar[] = $satir;
}

echo json_encode([
    "success" => true,
    "count" => count($sarkilar),
    "data" => $sarkilar
]);

$baglanti->close();
?>
