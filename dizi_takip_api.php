<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// OPTIONS request için CORS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Veritabanı bağlantısı
$host = 'localhost';
$dbname = 'basit_sistem';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Veritabanı bağlantı hatası: ' . $e->getMessage()]);
    exit();
}

// Dizi bilgilerini diziler tablosundan al
function getDiziImdbRating($pdo, $diziTitle) {
    try {
        $stmt = $pdo->prepare("SELECT imdb_puani FROM diziler WHERE dizi_adi = ? LIMIT 1");
        $stmt->execute([$diziTitle]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? floatval($result['imdb_puani']) : 0;
    } catch(PDOException $e) {
        return 0; // Hata durumunda 0 döndür
    }
}

// Dizi tablosunu oluştur (eğer yoksa)
try {
    // Tabloyu sadece yoksa oluştur
    $pdo->exec("CREATE TABLE IF NOT EXISTS dizi_takip (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        title VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
        year INT,
        genre VARCHAR(100) COLLATE utf8mb4_unicode_ci,
        poster TEXT COLLATE utf8mb4_unicode_ci,
        rating DECIMAL(3,1) DEFAULT 0.0,
        review TEXT COLLATE utf8mb4_unicode_ci,
        season_count INT DEFAULT 1,
        episode_count INT DEFAULT 1,
        current_season INT DEFAULT 1,
        current_episode INT DEFAULT 1,
        is_watched BOOLEAN DEFAULT FALSE,
        is_favorite BOOLEAN DEFAULT FALSE,
        is_watchlist BOOLEAN DEFAULT FALSE,
        is_watching BOOLEAN DEFAULT FALSE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        INDEX idx_user_id (user_id)
    ) ENGINE=InnoDB CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
    
    // Mevcut tabloya eksik alanları ekle (eğer yoksa)
    $columns = ['is_watchlist', 'is_watching', 'season_count', 'episode_count', 'current_season', 'current_episode'];
    
    foreach ($columns as $column) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = ? AND TABLE_NAME = 'dizi_takip' AND COLUMN_NAME = ?");
        $stmt->execute(['basit_sistem', $column]);
        $columnExists = $stmt->fetchColumn() > 0;
        
        if (!$columnExists) {
            switch ($column) {
                case 'is_watchlist':
                case 'is_watching':
                    $pdo->exec("ALTER TABLE dizi_takip ADD COLUMN $column BOOLEAN DEFAULT FALSE");
                    break;
                case 'season_count':
                case 'episode_count':
                case 'current_season':
                case 'current_episode':
                    $pdo->exec("ALTER TABLE dizi_takip ADD COLUMN $column INT DEFAULT 1");
                    break;
            }
        }
    }
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Tablo oluşturma hatası: ' . $e->getMessage()]);
    exit();
}

$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
    case 'GET':
        // Dizi listesini getir
        if (isset($_GET['user_id'])) {
            $user_id = intval($_GET['user_id']);
            
            try {
                $stmt = $pdo->prepare("SELECT dt.*, d.id as dizi_id FROM dizi_takip dt LEFT JOIN diziler d ON dt.title = d.dizi_adi WHERE dt.user_id = ? ORDER BY dt.created_at DESC");
                $stmt->execute([$user_id]);
                $dizis = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                // Boolean değerleri dönüştür
                foreach ($dizis as &$dizi) {
                    $dizi['isWatched'] = (bool)$dizi['is_watched'];
                    $dizi['isFavorite'] = (bool)$dizi['is_favorite'];
                    $dizi['isWatchlist'] = (bool)$dizi['is_watchlist'];
                    $dizi['isWatching'] = (bool)$dizi['is_watching'];
                    $dizi['rating'] = floatval($dizi['rating']);
                    $dizi['year'] = intval($dizi['year']);
                    $dizi['season_count'] = intval($dizi['season_count']);
                    $dizi['episode_count'] = intval($dizi['episode_count']);
                    $dizi['current_season'] = intval($dizi['current_season']);
                    $dizi['current_episode'] = intval($dizi['current_episode']);
                    // Dizi detay sayfası için dizi_id'yi kullan
                    $dizi['dizi_id'] = intval($dizi['dizi_id']);
                }
                
                echo json_encode($dizis);
            } catch(PDOException $e) {
                error_log("Dizi Takip API Hatası: " . $e->getMessage());
                echo json_encode(['success' => false, 'message' => 'Diziler getirilirken hata: ' . $e->getMessage(), 'debug' => $e->getTraceAsString()]);
            }
        } elseif (isset($_GET['check_dizi'])) {
            // Belirli bir diziyi kontrol et
            $user_id = intval($_GET['user_id']);
            $dizi_title = $_GET['check_dizi'];
            
            try {
                $stmt = $pdo->prepare("SELECT * FROM dizi_takip WHERE user_id = ? AND title = ?");
                $stmt->execute([$user_id, $dizi_title]);
                $dizi = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($dizi) {
                    $dizi['isWatched'] = (bool)$dizi['is_watched'];
                    $dizi['isFavorite'] = (bool)$dizi['is_favorite'];
                    $dizi['isWatchlist'] = (bool)$dizi['is_watchlist'];
                    $dizi['isWatching'] = (bool)$dizi['is_watching'];
                    $dizi['rating'] = floatval($dizi['rating']);
                    $dizi['year'] = intval($dizi['year']);
                    $dizi['season_count'] = intval($dizi['season_count']);
                    $dizi['episode_count'] = intval($dizi['episode_count']);
                    $dizi['current_season'] = intval($dizi['current_season']);
                    $dizi['current_episode'] = intval($dizi['current_episode']);
                    echo json_encode($dizi);
                } else {
                    echo json_encode(null);
                }
            } catch(PDOException $e) {
                echo json_encode(['success' => false, 'message' => 'Dizi kontrol edilirken hata: ' . $e->getMessage()]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'user_id parametresi gerekli']);
        }
        break;
        
    case 'POST':
        // Yeni dizi ekle veya güncelle
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (!$input) {
            echo json_encode(['success' => false, 'message' => 'Geçersiz JSON verisi']);
            break;
        }
        
        $required_fields = ['user_id', 'title'];
        foreach ($required_fields as $field) {
            if (!isset($input[$field]) || empty($input[$field])) {
                echo json_encode(['success' => false, 'message' => $field . ' alanı gerekli']);
                break 2;
            }
        }
        
        try {
            // IMDb puanını diziler tablosundan al
            $imdbRating = getDiziImdbRating($pdo, $input['title']);
            
            // Önce diziyi kontrol et
            $stmt = $pdo->prepare("SELECT id FROM dizi_takip WHERE user_id = ? AND title = ?");
            $stmt->execute([intval($input['user_id']), $input['title']]);
            $existingDizi = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($existingDizi) {
                // Mevcut diziyi güncelle - IMDb puanını güncelle
                $stmt = $pdo->prepare("UPDATE dizi_takip SET year = ?, genre = ?, poster = ?, rating = ?, review = ?, season_count = ?, episode_count = ?, current_season = ?, current_episode = ?, is_watched = ?, is_favorite = ?, is_watchlist = ?, is_watching = ? WHERE id = ?");
                
                $result = $stmt->execute([
                    isset($input['year']) ? intval($input['year']) : null,
                    isset($input['genre']) ? $input['genre'] : null,
                    isset($input['poster']) ? $input['poster'] : null,
                    $imdbRating, // IMDb puanını otomatik olarak set et
                    isset($input['review']) ? $input['review'] : null,
                    isset($input['season_count']) ? intval($input['season_count']) : 1,
                    isset($input['episode_count']) ? intval($input['episode_count']) : 1,
                    isset($input['current_season']) ? intval($input['current_season']) : 1,
                    isset($input['current_episode']) ? intval($input['current_episode']) : 1,
                    isset($input['isWatched']) ? (bool)$input['isWatched'] : false,
                    isset($input['isFavorite']) ? (bool)$input['isFavorite'] : false,
                    isset($input['isWatchlist']) ? (bool)$input['isWatchlist'] : false,
                    isset($input['isWatching']) ? (bool)$input['isWatching'] : false,
                    $existingDizi['id']
                ]);
                
                if ($result) {
                    echo json_encode(['success' => true, 'message' => 'Dizi başarıyla güncellendi (IMDb: ' . $imdbRating . ')', 'id' => $existingDizi['id']]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Dizi güncellenirken hata oluştu']);
                }
            } else {
                // Yeni dizi ekle - IMDb puanı ile
                $stmt = $pdo->prepare("INSERT INTO dizi_takip (user_id, title, year, genre, poster, rating, review, season_count, episode_count, current_season, current_episode, is_watched, is_favorite, is_watchlist, is_watching) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                
                $result = $stmt->execute([
                    intval($input['user_id']),
                    $input['title'],
                    isset($input['year']) ? intval($input['year']) : null,
                    isset($input['genre']) ? $input['genre'] : null,
                    isset($input['poster']) ? $input['poster'] : null,
                    $imdbRating, // IMDb puanını otomatik olarak set et
                    isset($input['review']) ? $input['review'] : null,
                    isset($input['season_count']) ? intval($input['season_count']) : 1,
                    isset($input['episode_count']) ? intval($input['episode_count']) : 1,
                    isset($input['current_season']) ? intval($input['current_season']) : 1,
                    isset($input['current_episode']) ? intval($input['current_episode']) : 1,
                    isset($input['isWatched']) ? (bool)$input['isWatched'] : false,
                    isset($input['isFavorite']) ? (bool)$input['isFavorite'] : false,
                    isset($input['isWatchlist']) ? (bool)$input['isWatchlist'] : false,
                    isset($input['isWatching']) ? (bool)$input['isWatching'] : false
                ]);
                
                if ($result) {
                    echo json_encode(['success' => true, 'message' => 'Dizi başarıyla eklendi (IMDb: ' . $imdbRating . ')', 'id' => $pdo->lastInsertId()]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Dizi eklenirken hata oluştu']);
                }
            }
        } catch(PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Dizi eklenirken hata: ' . $e->getMessage()]);
        }
        break;
        
    case 'PUT':
        // Dizi güncelle
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (!$input) {
            echo json_encode(['success' => false, 'message' => 'Geçersiz JSON verisi']);
            break;
        }
        
        try {
            // IMDb puanını diziler tablosundan al
            $imdbRating = getDiziImdbRating($pdo, $input['title']);
            
            // Önce diziyi bul
            $stmt = $pdo->prepare("SELECT id FROM dizi_takip WHERE user_id = ? AND title = ?");
            $stmt->execute([intval($input['user_id']), $input['title']]);
            $existingDizi = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($existingDizi) {
                // Mevcut diziyi güncelle - IMDb puanını güncelle
                $stmt = $pdo->prepare("UPDATE dizi_takip SET year = ?, genre = ?, poster = ?, rating = ?, review = ?, season_count = ?, episode_count = ?, current_season = ?, current_episode = ?, is_watched = ?, is_favorite = ?, is_watchlist = ?, is_watching = ? WHERE id = ?");
                
                $result = $stmt->execute([
                    isset($input['year']) ? intval($input['year']) : null,
                    isset($input['genre']) ? $input['genre'] : null,
                    isset($input['poster']) ? $input['poster'] : null,
                    $imdbRating, // IMDb puanını otomatik olarak set et
                    isset($input['review']) ? $input['review'] : null,
                    isset($input['season_count']) ? intval($input['season_count']) : 1,
                    isset($input['episode_count']) ? intval($input['episode_count']) : 1,
                    isset($input['current_season']) ? intval($input['current_season']) : 1,
                    isset($input['current_episode']) ? intval($input['current_episode']) : 1,
                    isset($input['isWatched']) ? (bool)$input['isWatched'] : false,
                    isset($input['isFavorite']) ? (bool)$input['isFavorite'] : false,
                    isset($input['isWatchlist']) ? (bool)$input['isWatchlist'] : false,
                    isset($input['isWatching']) ? (bool)$input['isWatching'] : false,
                    $existingDizi['id']
                ]);
                
                if ($result) {
                    echo json_encode(['success' => true, 'message' => 'Dizi başarıyla güncellendi (IMDb: ' . $imdbRating . ')']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Dizi güncellenirken hata oluştu']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Dizi bulunamadı']);
            }
        } catch(PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Dizi güncellenirken hata: ' . $e->getMessage()]);
        }
        break;
        
    case 'DELETE':
        // Dizi sil
        if (isset($_GET['id'])) {
            $dizi_id = intval($_GET['id']);
            
            try {
                $stmt = $pdo->prepare("DELETE FROM dizi_takip WHERE id = ?");
                $result = $stmt->execute([$dizi_id]);
                
                if ($result) {
                    echo json_encode(['success' => true, 'message' => 'Dizi başarıyla silindi']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Dizi silinirken hata oluştu']);
                }
            } catch(PDOException $e) {
                echo json_encode(['success' => false, 'message' => 'Dizi silinirken hata: ' . $e->getMessage()]);
            }
        } elseif (isset($_GET['user_id']) && isset($_GET['title'])) {
            // Dizi adına göre sil
            $user_id = intval($_GET['user_id']);
            $dizi_title = $_GET['title'];
            
            try {
                $stmt = $pdo->prepare("DELETE FROM dizi_takip WHERE user_id = ? AND title = ?");
                $result = $stmt->execute([$user_id, $dizi_title]);
                
                if ($result) {
                    echo json_encode(['success' => true, 'message' => 'Dizi başarıyla silindi']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Dizi silinirken hata oluştu']);
                }
            } catch(PDOException $e) {
                echo json_encode(['success' => false, 'message' => 'Dizi silinirken hata: ' . $e->getMessage()]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Dizi ID veya user_id ve title gerekli']);
        }
        break;
        
    default:
        echo json_encode(['success' => false, 'message' => 'Desteklenmeyen HTTP metodu']);
        break;
}
?>
