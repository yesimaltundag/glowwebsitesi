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
} catch(PDOException $e) {
    echo json_encode(['error' => 'Veritabanı bağlantı hatası: ' . $e->getMessage()]);
    exit;
}

// HTTP metodunu al
$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
    case 'GET':
        try {
            // Kitap adı ve kategori parametrelerini kontrol et
            $kitapAd = $_GET['kitap'] ?? null;
            $kategori = $_GET['kategori'] ?? null;
            
            if ($kitapAd) {
                // Belirli bir kitap ara
                $stmt = $pdo->prepare("SELECT * FROM kitaplar WHERE kitap_adi = ?");
                $stmt->execute([$kitapAd]);
                $kitaplar = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                echo json_encode([
                    'success' => true,
                    'kitaplar' => $kitaplar,
                    'searched_for' => $kitapAd
                ]);
            } elseif ($kategori) {
                // Kategoriye göre kitaplar ara
                $cleanKategori = trim($kategori);
                
                // Önce exact match dene
                $stmt = $pdo->prepare("SELECT * FROM kitaplar WHERE kategori = ?");
                $stmt->execute([$cleanKategori]);
                $kitaplar = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                // Eğer bulunamazsa, LIKE ile ara
                if (count($kitaplar) == 0) {
                    $stmt = $pdo->prepare("SELECT * FROM kitaplar WHERE kategori LIKE ?");
                    $likeKategori = '%' . $cleanKategori . '%';
                    $stmt->execute([$likeKategori]);
                    $kitaplar = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
                
                // Hala bulunamazsa, & ve ve değişimini dene
                if (count($kitaplar) == 0) {
                    $altKategori = str_replace(' & ', ' ve ', $cleanKategori);
                    $stmt = $pdo->prepare("SELECT * FROM kitaplar WHERE kategori = ?");
                    $stmt->execute([$altKategori]);
                    $kitaplar = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
                
                echo json_encode([
                    'success' => true,
                    'kitaplar' => $kitaplar,
                    'searched_for_category' => $kategori
                ]);
            } else {
                // Her çağrıda rastgele kitaplar getir
                $stmt = $pdo->query("SELECT kitap_adi, yazar, kapak_url FROM kitaplar ORDER BY RAND(NOW()) LIMIT 8");
                $kitaplar = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                echo json_encode([
                    'success' => true,
                    'kitaplar' => $kitaplar,
                    'timestamp' => time(),
                    'random_seed' => rand(1, 10000)
                ]);
            }
        } catch(PDOException $e) {
            echo json_encode([
                'error' => 'Kitaplar getirilirken hata: ' . $e->getMessage()
            ]);
        }
        break;
        
    case 'POST':
        // Yeni kitap ekle
        $data = json_decode(file_get_contents('php://input'), true);
        
        if (!$data) {
            echo json_encode(['error' => 'Geçersiz veri']);
            break;
        }
        
        try {
            $stmt = $pdo->prepare("INSERT INTO kitaplar (kitap_adi, yazar, basim_yili, kategori, sayfa_sayisi, basim_yeri, isbn, tanitim, kapak_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            
            $stmt->execute([
                $data['kitap_adi'] ?? '',
                $data['yazar'] ?? '',
                $data['basim_yili'] ?? null,
                $data['kategori'] ?? '',
                $data['sayfa_sayisi'] ?? null,
                $data['basim_yeri'] ?? '',
                $data['isbn'] ?? null,
                $data['tanitim'] ?? '',
                $data['kapak_url'] ?? ''
            ]);
            
            echo json_encode([
                'success' => true,
                'message' => 'Kitap başarıyla eklendi',
                'id' => $pdo->lastInsertId()
            ]);
        } catch(PDOException $e) {
            echo json_encode([
                'error' => 'Kitap eklenirken hata: ' . $e->getMessage()
            ]);
        }
        break;
        
    default:
        echo json_encode(['error' => 'Desteklenmeyen HTTP metodu']);
        break;
}
?>
