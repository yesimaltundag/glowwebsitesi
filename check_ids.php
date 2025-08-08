<?php
header("Content-Type: text/html; charset=UTF-8");

$baglanti = new mysqli("localhost", "root", "", "basit_sistem");

if ($baglanti->connect_error) {
    echo "Veritabanı bağlantı hatası: " . $baglanti->connect_error;
    exit;
}

echo "<h2>Film ID'leri:</h2>";
$sonuc = $baglanti->query("SELECT id, film_adi, kategori FROM filmler ORDER BY id");
while ($satir = $sonuc->fetch_assoc()) {
    echo "ID: " . $satir['id'] . " - " . $satir['film_adi'] . " (" . $satir['kategori'] . ")<br>";
}

echo "<h2>Tiyatro ID'leri:</h2>";
$sonuc = $baglanti->query("SELECT id, eser_adi, tur FROM tiyatro_eserleri ORDER BY id");
while ($satir = $sonuc->fetch_assoc()) {
    echo "ID: " . $satir['id'] . " - " . $satir['eser_adi'] . " (" . $satir['tur'] . ")<br>";
}
?>
