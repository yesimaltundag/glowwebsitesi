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
            // Kitap adı, kategori ve alt kategori parametrelerini kontrol et
            $kitapAd = $_GET['kitap'] ?? null;
            $kategori = $_GET['kategori'] ?? null;
            $altKategori = $_GET['alt_kategori'] ?? null;
            
            if ($kitapAd) {
                // Belirli bir kitap ara - daha esnek arama
                $cleanKitapAd = trim($kitapAd);
                
                // Önce exact match dene
                $stmt = $pdo->prepare("SELECT * FROM kitaplar WHERE kitap_adi = ?");
                $stmt->execute([$cleanKitapAd]);
                $kitaplar = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                // Eğer bulunamazsa, LIKE ile ara
                if (count($kitaplar) == 0) {
                    $stmt = $pdo->prepare("SELECT * FROM kitaplar WHERE kitap_adi LIKE ?");
                    $likeKitapAd = '%' . $cleanKitapAd . '%';
                    $stmt->execute([$likeKitapAd]);
                    $kitaplar = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
                
                // Hala bulunamazsa, case-insensitive ara
                if (count($kitaplar) == 0) {
                    $stmt = $pdo->prepare("SELECT * FROM kitaplar WHERE LOWER(kitap_adi) = LOWER(?)");
                    $stmt->execute([$cleanKitapAd]);
                    $kitaplar = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
                
                echo json_encode([
                    'success' => true,
                    'kitaplar' => $kitaplar,
                    'searched_for' => $kitapAd,
                    'found_count' => count($kitaplar)
                ]);
            } elseif ($kategori && $altKategori) {
                // Alt kategoriye göre kitaplar ara
                $cleanKategori = trim($kategori);
                $cleanAltKategori = trim($altKategori);
                
                // Alt kategori mapping'i
                $altKategoriMapping = [
                    'turk-edebiyati' => 'Türk Edebiyatı',
                    'yabanci-edebiyat' => 'Yabancı Edebiyat',
                    'klasik-edebiyat' => 'Klasik Edebiyat'
                ];
                
                $mappedAltKategori = $altKategoriMapping[$cleanAltKategori] ?? $cleanAltKategori;
                
                // Önce exact match dene
                $stmt = $pdo->prepare("SELECT * FROM kitaplar WHERE kategori = ? AND alt_kategori = ?");
                $stmt->execute([$cleanKategori, $mappedAltKategori]);
                $kitaplar = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                // Eğer bulunamazsa, LIKE ile ara
                if (count($kitaplar) == 0) {
                    $stmt = $pdo->prepare("SELECT * FROM kitaplar WHERE kategori LIKE ? AND alt_kategori LIKE ?");
                    $likeKategori = '%' . $cleanKategori . '%';
                    $likeAltKategori = '%' . $mappedAltKategori . '%';
                    $stmt->execute([$likeKategori, $likeAltKategori]);
                    $kitaplar = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
                
                echo json_encode([
                    'success' => true,
                    'kitaplar' => $kitaplar,
                    'searched_for_category' => $kategori,
                    'searched_for_subcategory' => $mappedAltKategori,
                    'found_count' => count($kitaplar)
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
                    'searched_for_category' => $kategori,
                    'found_count' => count($kitaplar)
                ]);
            } else {
                // Her çağrıda rastgele 8 kitap getir
                $randomSeed = time() . rand(1, 10000); // Daha güçlü rastgele seçim
                $stmt = $pdo->query("SELECT kitap_adi, yazar, kapak_url FROM kitaplar ORDER BY RAND($randomSeed) LIMIT 8");
                $kitaplar = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                echo json_encode([
                    'success' => true,
                    'kitaplar' => $kitaplar,
                    'found_count' => count($kitaplar)
                ]);
            }
        } catch(PDOException $e) {
            echo json_encode([
                'success' => false,
                'error' => 'Veritabanı hatası: ' . $e->getMessage()
            ]);
        }
        break;
        
    default:
        echo json_encode([
            'success' => false,
            'error' => 'Sadece GET metodu destekleniyor'
        ]);
        break;
}
?>
