<?php
header("Content-Type: text/html; charset=UTF-8");

$baglanti = new mysqli("localhost", "root", "", "basit_sistem");

if ($baglanti->connect_error) {
    echo "Veritabanı bağlantı hatası: " . $baglanti->connect_error;
    exit;
}

echo "<h2>Film ID'leri (Sıralı):</h2>";
$sonuc = $baglanti->query("SELECT id, film_adi, kategori FROM filmler ORDER BY id");
$filmler = [];
while ($satir = $sonuc->fetch_assoc()) {
    $filmler[] = $satir;
    echo "ID: " . $satir['id'] . " - " . $satir['film_adi'] . " (" . $satir['kategori'] . ")<br>";
}

echo "<h2>Tiyatro ID'leri (Sıralı):</h2>";
$sonuc = $baglanti->query("SELECT id, eser_adi, tur FROM tiyatro_eserleri ORDER BY id");
$tiyatro_eserleri = [];
while ($satir = $sonuc->fetch_assoc()) {
    $tiyatro_eserleri[] = $satir;
    echo "ID: " . $satir['id'] . " - " . $satir['eser_adi'] . " (" . $satir['tur'] . ")<br>";
}

echo "<h2>Carousel için gerekli ID'ler:</h2>";
echo "<h3>Filmler:</h3>";
foreach ($filmler as $film) {
    if (in_array($film['film_adi'], ['Die Hard', 'Inception', 'The Shawshank Redemption'])) {
        echo $film['film_adi'] . " → ID: " . $film['id'] . "<br>";
    }
}

echo "<h3>Tiyatro Eserleri:</h3>";
foreach ($tiyatro_eserleri as $eser) {
    if (in_array($eser['eser_adi'], ['Hamlet', 'Romeo ve Juliet', 'Macbeth'])) {
        echo $eser['eser_adi'] . " → ID: " . $eser['id'] . "<br>";
    }
}
?>
