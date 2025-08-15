<?php
header('Content-Type: application/json; charset=utf-8mb4');
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
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES utf8mb4");
} catch(PDOException $e) {
    echo json_encode(['error' => 'Veritabanı bağlantı hatası: ' . $e->getMessage()]);
    exit;
}

// HTTP metodunu al
$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
    case 'GET':
        try {
            // Seyahat adı, kategori ve şehir parametrelerini kontrol et
            $seyahatAd = $_GET['seyahat'] ?? null;
            $kategori = $_GET['kategori'] ?? null;
            $sehir = $_GET['sehir'] ?? null;
            
            if ($seyahatAd) {
                // Belirli bir seyahat ara - daha esnek arama
                $cleanSeyahatAd = trim($seyahatAd);
                
                // Önce exact match dene
                $stmt = $pdo->prepare("SELECT * FROM seyahatler WHERE ad = ?");
                $stmt->execute([$cleanSeyahatAd]);
                $seyahatler = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                // Eğer bulunamazsa, LIKE ile ara
                if (count($seyahatler) == 0) {
                    $stmt = $pdo->prepare("SELECT * FROM seyahatler WHERE ad LIKE ?");
                    $likeSeyahatAd = '%' . $cleanSeyahatAd . '%';
                    $stmt->execute([$likeSeyahatAd]);
                    $seyahatler = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
                
                // Hala bulunamazsa, case-insensitive ara
                if (count($seyahatler) == 0) {
                    $stmt = $pdo->prepare("SELECT * FROM seyahatler WHERE LOWER(ad) = LOWER(?)");
                    $stmt->execute([$cleanSeyahatAd]);
                    $seyahatler = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
                
                echo json_encode([
                    'success' => true,
                    'seyahatler' => $seyahatler,
                    'searched_for' => $seyahatAd,
                    'found_count' => count($seyahatler)
                ]);
            } elseif ($kategori) {
                // Kategoriye göre seyahatler ara
                $cleanKategori = trim($kategori);
                
                // Önce exact match dene
                $stmt = $pdo->prepare("SELECT * FROM seyahatler WHERE kategori = ?");
                $stmt->execute([$cleanKategori]);
                $seyahatler = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                // Eğer bulunamazsa, LIKE ile ara
                if (count($seyahatler) == 0) {
                    $stmt = $pdo->prepare("SELECT * FROM seyahatler WHERE kategori LIKE ?");
                    $likeKategori = '%' . $cleanKategori . '%';
                    $stmt->execute([$likeKategori]);
                    $seyahatler = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
                
                // Hala bulunamazsa, & ve ve değişimini dene
                if (count($seyahatler) == 0) {
                    $altKategori = str_replace(' & ', ' ve ', $cleanKategori);
                    $stmt = $pdo->prepare("SELECT * FROM seyahatler WHERE kategori = ?");
                    $stmt->execute([$altKategori]);
                    $seyahatler = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
                
                echo json_encode([
                    'success' => true,
                    'seyahatler' => $seyahatler,
                    'searched_for_category' => $kategori
                ]);
            } elseif ($sehir) {
                // Belirli bir şehir ara - daha esnek arama
                $cleanSehir = trim($sehir);
                
                // URL'den gelen tire işaretlerini boşluğa çevir
                $cleanSehir = str_replace('-', ' ', $cleanSehir);
                
                // Önce exact match dene
                $stmt = $pdo->prepare("SELECT * FROM seyahatler WHERE ad = ?");
                $stmt->execute([$cleanSehir]);
                $seyahatler = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                // Eğer bulunamazsa, LIKE ile ara
                if (count($seyahatler) == 0) {
                    $stmt = $pdo->prepare("SELECT * FROM seyahatler WHERE ad LIKE ?");
                    $likeSehir = '%' . $cleanSehir . '%';
                    $stmt->execute([$likeSehir]);
                    $seyahatler = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
                
                // Hala bulunamazsa, case-insensitive ara
                if (count($seyahatler) == 0) {
                    $stmt = $pdo->prepare("SELECT * FROM seyahatler WHERE LOWER(ad) = LOWER(?)");
                    $stmt->execute([$cleanSehir]);
                    $seyahatler = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
                
                // Hala bulunamazsa, kelime bazlı ara
                if (count($seyahatler) == 0) {
                    $words = explode(' ', $cleanSehir);
                    $conditions = [];
                    $params = [];
                    
                    foreach ($words as $word) {
                        if (strlen($word) > 2) {
                            $conditions[] = "LOWER(ad) LIKE LOWER(?)";
                            $params[] = '%' . $word . '%';
                        }
                    }
                    
                    if (!empty($conditions)) {
                        $sql = "SELECT * FROM seyahatler WHERE " . implode(' OR ', $conditions);
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute($params);
                        $seyahatler = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    }
                }
                
                echo json_encode([
                    'success' => true,
                    'seyahatler' => $seyahatler,
                    'searched_for_city' => $sehir,
                    'clean_search' => $cleanSehir,
                    'found_count' => count($seyahatler)
                ]);
            } elseif (isset($_GET['avrupa'])) {
                // Avrupa seyahatleri için özel endpoint
                $stmt = $pdo->prepare("SELECT * FROM seyahatler WHERE kategori = 'Avrupa Seyahatleri' ORDER BY id ASC");
                $stmt->execute();
                $seyahatler = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                echo json_encode([
                    'success' => true,
                    'seyahatler' => $seyahatler,
                    'kategori' => 'Avrupa Seyahatleri',
                    'count' => count($seyahatler)
                ]);
            } elseif (isset($_GET['asya'])) {
                // Asya seyahatleri için özel endpoint
                $stmt = $pdo->prepare("SELECT * FROM seyahatler WHERE kategori = 'Asya Seyahatleri' ORDER BY id ASC");
                $stmt->execute();
                $seyahatler = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                echo json_encode([
                    'success' => true,
                    'seyahatler' => $seyahatler,
                    'kategori' => 'Asya Seyahatleri',
                    'count' => count($seyahatler)
                ]);
            } elseif (isset($_GET['amerika'])) {
                // Amerika seyahatleri için özel endpoint
                $stmt = $pdo->prepare("SELECT * FROM seyahatler WHERE kategori = 'Amerika Seyahatleri' ORDER BY id ASC");
                $stmt->execute();
                $seyahatler = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                echo json_encode([
                    'success' => true,
                    'seyahatler' => $seyahatler,
                    'kategori' => 'Amerika Seyahatleri',
                    'count' => count($seyahatler)
                ]);
            } elseif (isset($_GET['afrika'])) {
                // Afrika seyahatleri için özel endpoint
                $stmt = $pdo->prepare("SELECT * FROM seyahatler WHERE kategori = 'Afrika Seyahatleri' ORDER BY id ASC");
                $stmt->execute();
                $seyahatler = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                echo json_encode([
                    'success' => true,
                    'seyahatler' => $seyahatler,
                    'kategori' => 'Afrika Seyahatleri',
                    'count' => count($seyahatler)
                ]);
            } elseif (isset($_GET['turkiye'])) {
                // Türkiye seyahatleri için özel endpoint
                $stmt = $pdo->prepare("SELECT * FROM seyahatler WHERE kategori = 'Türkiye Seyahatleri' ORDER BY id ASC");
                $stmt->execute();
                $seyahatler = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                echo json_encode([
                    'success' => true,
                    'seyahatler' => $seyahatler,
                    'kategori' => 'Türkiye Seyahatleri',
                    'count' => count($seyahatler)
                ]);
            } elseif (isset($_GET['deniz'])) {
                // Deniz seyahatleri için özel endpoint
                $stmt = $pdo->prepare("SELECT * FROM seyahatler WHERE kategori = 'Deniz Seyahatleri' ORDER BY id ASC");
                $stmt->execute();
                $seyahatler = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                echo json_encode([
                    'success' => true,
                    'seyahatler' => $seyahatler,
                    'kategori' => 'Deniz Seyahatleri',
                    'count' => count($seyahatler)
                ]);
            } elseif (isset($_GET['kamp'])) {
                // Kamp ve doğa için özel endpoint
                $stmt = $pdo->prepare("SELECT * FROM seyahatler WHERE kategori = 'Kamp ve Doğa' ORDER BY id ASC");
                $stmt->execute();
                $seyahatler = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                echo json_encode([
                    'success' => true,
                    'seyahatler' => $seyahatler,
                    'kategori' => 'Kamp ve Doğa',
                    'count' => count($seyahatler)
                ]);

            } else {
                // Her çağrıda rastgele 8 seyahat getir
                $randomSeed = time() . rand(1, 10000); // Daha güçlü rastgele seçim
                $stmt = $pdo->query("SELECT id, ad, ulke, icon, foto, aciklama, kategori FROM seyahatler ORDER BY RAND($randomSeed) LIMIT 8");
                $seyahatler = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                echo json_encode([
                    'success' => true,
                    'seyahatler' => $seyahatler,
                    'timestamp' => time(),
                    'random_seed' => $randomSeed,
                    'count' => count($seyahatler)
                ]);
            }
        } catch(PDOException $e) {
            echo json_encode([
                'error' => 'Seyahatler getirilirken hata: ' . $e->getMessage()
            ]);
        }
        break;
        
    case 'POST':
        // Yeni seyahat ekle
        $data = json_decode(file_get_contents('php://input'), true);
        
        if (!$data) {
            echo json_encode(['error' => 'Geçersiz veri']);
            break;
        }
        
        try {
            $stmt = $pdo->prepare("INSERT INTO seyahatler (ad, ulke, icon, foto, aciklama, gorulecekYerler, etkinlikler, restoranlar, kategori) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            
            $stmt->execute([
                $data['ad'] ?? '',
                $data['ulke'] ?? '',
                $data['icon'] ?? '',
                $data['foto'] ?? '',
                $data['aciklama'] ?? '',
                $data['gorulecekYerler'] ?? '',
                $data['etkinlikler'] ?? '',
                $data['restoranlar'] ?? '',
                $data['kategori'] ?? ''
            ]);
            
            echo json_encode([
                'success' => true,
                'message' => 'Seyahat başarıyla eklendi',
                'id' => $pdo->lastInsertId()
            ]);
        } catch(PDOException $e) {
            echo json_encode([
                'error' => 'Seyahat eklenirken hata: ' . $e->getMessage()
            ]);
        }
        break;
        
    default:
        echo json_encode(['error' => 'Desteklenmeyen HTTP metodu']);
        break;
}
?>
