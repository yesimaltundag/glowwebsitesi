<?php
// API test dosyası
header("Content-Type: application/json; charset=UTF-8");

$baglanti = new mysqli("localhost", "root", "", "basit_sistem");

if ($baglanti->connect_error) {
    echo json_encode([
        "error" => "Veritabanı bağlantı hatası: " . $baglanti->connect_error
    ]);
    exit;
}

// Fotograflar tablosunu kontrol et
$check_table = $baglanti->query("SHOW TABLES LIKE 'fotograflar'");
if ($check_table->num_rows == 0) {
    echo json_encode([
        "error" => "fotograflar tablosu bulunamadı!"
    ]);
    exit;
}

// Verileri çek
$query = "SELECT * FROM fotograflar ORDER BY id DESC";
$sonuc = $baglanti->query($query);

if (!$sonuc) {
    echo json_encode([
        "error" => "SQL hatası: " . $baglanti->error
    ]);
    exit;
}

$fotograflar = [];
while ($satir = $sonuc->fetch_assoc()) {
    $fotograflar[] = $satir;
}

echo json_encode([
    "success" => true,
    "count" => count($fotograflar),
    "data" => $fotograflar
]);

$baglanti->close();
?>
