<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "basit_sistem";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES utf8");
    
    // Debug: Veritabanı bağlantısını test et
    $testStmt = $pdo->query("SELECT COUNT(*) as total FROM filmler");
    $totalCount = $testStmt->fetch(PDO::FETCH_ASSOC)['total'];
    error_log("Filmler API - Veritabanı bağlantısı başarılı. Toplam film sayısı: " . $totalCount);
    
} catch(PDOException $e) {
    error_log("Filmler API - Veritabanı bağlantı hatası: " . $e->getMessage());
    echo json_encode(['error' => 'Veritabanı bağlantı hatası: ' . $e->getMessage()]);
    exit;
}

// HTTP metodunu al
$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
    case 'GET':
        try {
            // Film adı ve kategori parametrelerini kontrol et
            $filmAd = $_GET['film'] ?? null;
            $kategori = $_GET['kategori'] ?? null;
            
            if ($filmAd) {
                // Belirli bir film ara
                $stmt = $pdo->prepare("SELECT id, film_adi, yonetmen, poster_url, imdb_puani, yil, tur as kategori, ozet as tanitim FROM filmler WHERE film_adi = ?");
                $stmt->execute([$filmAd]);
                $filmler = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                echo json_encode([
                    'success' => true,
                    'filmler' => $filmler,
                    'searched_for' => $filmAd
                ]);
            } elseif ($kategori) {
                // Kategoriye göre filmler ara
                $cleanKategori = trim($kategori);
                
                $stmt = $pdo->prepare("SELECT id, film_adi, yonetmen, poster_url, imdb_puani, yil, tur as kategori, ozet as tanitim FROM filmler WHERE tur = ?");
                $stmt->execute([$cleanKategori]);
                $filmler = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                echo json_encode([
                    'success' => true,
                    'filmler' => $filmler,
                    'searched_for_category' => $kategori
                ]);
            } else {
                // Her çağrıda rastgele 8 film getir
                $randomSeed = time() . rand(1, 10000);
                
                // Debug: SQL sorgusunu logla
                $sql = "SELECT id, film_adi, yonetmen, poster_url, imdb_puani, yil, tur as kategori, ozet as tanitim FROM filmler ORDER BY RAND($randomSeed) LIMIT 8";
                
                $stmt = $pdo->query($sql);
                $filmler = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                // Debug: Sonuçları logla
                error_log("Filmler API - SQL: " . $sql);
                error_log("Filmler API - Bulunan film sayısı: " . count($filmler));
                
                echo json_encode([
                    'success' => true,
                    'filmler' => $filmler,
                    'timestamp' => time(),
                    'random_seed' => $randomSeed,
                    'count' => count($filmler),
                    'debug_sql' => $sql,
                    'debug_count' => count($filmler)
                ]);
            }
        } catch(PDOException $e) {
            echo json_encode([
                'error' => 'Filmler getirilirken hata: ' . $e->getMessage()
            ]);
        }
        break;
        
    default:
        echo json_encode(['error' => 'Desteklenmeyen HTTP metodu']);
        break;
}
?>