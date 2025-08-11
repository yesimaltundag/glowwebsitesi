<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "basit_sistem";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// kapak_url sütunu kontrol et
$check_column = "SHOW COLUMNS FROM animeler LIKE 'kapak_url'";
$result = $conn->query($check_column);

if ($result->num_rows == 0) {
    echo "❌ kapak_url sütunu bulunamadı!<br>";
    exit;
} else {
    echo "✅ kapak_url sütunu mevcut<br>";
}

// Anime poster URL'leri
$anime_posters = [
    'Death Note' => 'https://m.media-amazon.com/images/M/MV5BNjRiNmNjMmMtN2U2Yi00ODgxLTk3OTMtMmI1MTI1NjYyZTEzXkEyXkFqcGdeQXVyNjAwNDUxODI@._V1_SX300.jpg',
    'Attack on Titan' => 'https://m.media-amazon.com/images/M/MV5BNzc5MTczVDQtNmFkMi00YTQ5LjkzN2EtMDRiMDc3NGFjMjIzXkEyXkFqcGdeQXVyNTA4NzY1MzY@._V1_SX300.jpg',
    'Fullmetal Alchemist: Brotherhood' => 'https://m.media-amazon.com/images/M/MV5BZmEzN2YzOTItMDI5MS00MGU4LWI1NWQtOTg5ZTVhYmRkMDRjXkEyXkFqcGdeQXVyNTA4NzY1MzY@._V1_SX300.jpg',
    'Naruto' => 'https://m.media-amazon.com/images/M/MV5BZmQ5NGFiNWEtMmMyMC00MDdiLTg4YWMtOTYzNiRjMDEyZjFjXkEyXkFqcGdeQXVyNTA4NzY1MzY@._V1_SX300.jpg',
    'One Piece' => 'https://m.media-amazon.com/images/M/MV5BODcwNWE3OTMtMDc3MS00NDFjLWE1OTAtNDU3NjgxODMxY2UyXkEyXkFqcGdeQXVyNTAyODkwOQ@@._V1_SX300.jpg',
    'Dragon Ball Z' => 'https://m.media-amazon.com/images/M/MV5BNGM5MTEyZDItZWNhOS00NzNkLTgwZTAtNWIzYzIzMWExOWM2XkEyXkFqcGdeQXVyNTA4NzY1MzY@._V1_SX300.jpg',
    'My Hero Academia' => 'https://m.media-amazon.com/images/M/MV5BNmQzYmE3MDEtMWQ0OC00YzA3LWFjZDUtYzVlZjc5NzQ4N2M3XkEyXkFqcGdeQXVyNTA4NzY1MzY@._V1_SX300.jpg',
    'Demon Slayer' => 'https://m.media-amazon.com/images/M/MV5BZjZjNzI5MDctY2RhYS00YTJkLTk2N2UtOGRjM2M2OTM4YzFhXkEyXkFqcGdeQXVyNTA4NzY1MzY@._V1_SX300.jpg',
    'Hunter x Hunter' => 'https://m.media-amazon.com/images/M/MV5BZjNmZDhkN2QtNDYyZC00YzJmLTg0ODUtN2FjNjhhMzE3ZmUxXkEyXkFqcGdeQXVyNjc2NjA5MTU@._V1_SX300.jpg',
    'Steins;Gate' => 'https://m.media-amazon.com/images/M/MV5BMjUxMzE4ZDctODNjMS00MzIwLThjNDktODkwYjc5YWU0MDc0XkEyXkFqcGdeQXVyNjc3MjQzNTI@._V1_SX300.jpg'
];

echo "<br>🎬 Anime posterleri güncelleniyor...<br><br>";

// Her anime için poster URL'sini güncelle
foreach ($anime_posters as $anime_adi => $poster_url) {
    $anime_adi = $conn->real_escape_string($anime_adi);
    $poster_url = $conn->real_escape_string($poster_url);
    
    $sql = "UPDATE animeler SET kapak_url = '$poster_url' WHERE anime_adi = '$anime_adi'";
    
    if ($conn->query($sql) === TRUE) {
        echo "✅ $anime_adi için poster URL güncellendi<br>";
    } else {
        echo "❌ Hata: $anime_adi - " . $conn->error . "<br>";
    }
}

echo "<br>🎉 Tüm anime posterleri güncellendi!";

$conn->close();
?>
