<?php
header("Content-Type: application/json; charset=UTF-8");

$baglanti = new mysqli("localhost", "root", "", "basit_sistem");

if ($baglanti->connect_error) {
    echo json_encode(["error" => "Veritabanı bağlantı hatası: " . $baglanti->connect_error]);
    exit;
}

// Carousel'deki filmlerin ID'lerini bul
$carousel_filmler = ['Die Hard', 'Inception', 'The Shawshank Redemption'];
$film_ids = [];

foreach ($carousel_filmler as $film_adi) {
    $film_adi_escaped = $baglanti->real_escape_string($film_adi);
    $sonuc = $baglanti->query("SELECT id, film_adi FROM filmler WHERE film_adi = '$film_adi_escaped'");
    if ($sonuc && $sonuc->num_rows > 0) {
        $film = $sonuc->fetch_assoc();
        $film_ids[$film_adi] = $film['id'];
    }
}

// Carousel'deki tiyatro eserlerinin ID'lerini bul
$carousel_tiyatro = ['Hamlet', 'Romeo ve Juliet', 'Macbeth'];
$tiyatro_ids = [];

foreach ($carousel_tiyatro as $eser_adi) {
    $eser_adi_escaped = $baglanti->real_escape_string($eser_adi);
    $sonuc = $baglanti->query("SELECT id, eser_adi FROM tiyatro_eserleri WHERE eser_adi = '$eser_adi_escaped'");
    if ($sonuc && $sonuc->num_rows > 0) {
        $eser = $sonuc->fetch_assoc();
        $tiyatro_ids[$eser_adi] = $eser['id'];
    }
}

echo json_encode([
    "film_ids" => $film_ids,
    "tiyatro_ids" => $tiyatro_ids
], JSON_UNESCAPED_UNICODE);
?>
