<?php
header("Content-Type: application/json; charset=UTF-8");

$baglanti = new mysqli("localhost", "root", "", "basit_sistem");

if ($baglanti->connect_error) {
    echo json_encode(["error" => "Veritabanı bağlantı hatası: " . $baglanti->connect_error]);
    exit;
}

// Film ID'lerini çek
$filmler = [];
$sonuc = $baglanti->query("SELECT id, film_adi, kategori FROM filmler ORDER BY id");
while ($satir = $sonuc->fetch_assoc()) {
    $filmler[] = $satir;
}

// Tiyatro ID'lerini çek
$tiyatro_eserleri = [];
$sonuc = $baglanti->query("SELECT id, eser_adi, tur FROM tiyatro_eserleri ORDER BY id");
while ($satir = $sonuc->fetch_assoc()) {
    $tiyatro_eserleri[] = $satir;
}

echo json_encode([
    "filmler" => $filmler,
    "tiyatro_eserleri" => $tiyatro_eserleri
], JSON_UNESCAPED_UNICODE);
?>
