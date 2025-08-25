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

// Film bilgilerini filmler tablosundan al
function getFilmImdbRating($pdo, $filmTitle) {
    try {
        $stmt = $pdo->prepare("SELECT imdb_puani FROM filmler WHERE film_adi = ? LIMIT 1");
        $stmt->execute([$filmTitle]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? floatval($result['imdb_puani']) : 0;
    } catch(PDOException $e) {
        return 0; // Hata durumunda 0 döndür
    }
}

// Film tablosunu oluştur (eğer yoksa)
try {
    $pdo->exec("CREATE TABLE IF NOT EXISTS film_takip (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        title VARCHAR(255) NOT NULL,
        year INT,
        genre VARCHAR(100),
        poster TEXT,
        rating DECIMAL(3,1) DEFAULT 0.0,
        review TEXT,
        is_watched BOOLEAN DEFAULT FALSE,
        is_favorite BOOLEAN DEFAULT FALSE,
        is_watchlist BOOLEAN DEFAULT FALSE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES kullanicilar(id) ON DELETE CASCADE
    )");
    
    // Mevcut tabloya is_watchlist alanını ekle (eğer yoksa)
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = ? AND TABLE_NAME = 'film_takip' AND COLUMN_NAME = 'is_watchlist'");
    $stmt->execute(['basit_sistem']);
    $columnExists = $stmt->fetchColumn() > 0;
    
    if (!$columnExists) {
        $pdo->exec("ALTER TABLE film_takip ADD COLUMN is_watchlist BOOLEAN DEFAULT FALSE");
    }
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Tablo oluşturma hatası: ' . $e->getMessage()]);
    exit();
}

$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
    case 'GET':
        // Film listesini getir
        if (isset($_GET['user_id'])) {
            $user_id = intval($_GET['user_id']);
            
            try {
                $stmt = $pdo->prepare("SELECT ft.*, f.id as film_id, f.imdb_puani FROM film_takip ft LEFT JOIN filmler f ON ft.title = f.film_adi WHERE ft.user_id = ? ORDER BY ft.created_at DESC");
                $stmt->execute([$user_id]);
                $films = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                // Boolean değerleri dönüştür
                foreach ($films as &$film) {
                    $film['isWatched'] = (bool)$film['is_watched'];
                    $film['isFavorite'] = (bool)$film['is_favorite'];
                    $film['isWatchlist'] = (bool)$film['is_watchlist'];
                    $film['rating'] = floatval($film['rating']);
                    $film['year'] = intval($film['year']);
                    // Film detay sayfası için film_id'yi kullan
                    $film['film_id'] = intval($film['film_id']);
                    // IMDB puanını ekle
                    $film['imdbRating'] = floatval($film['imdb_puani']);
                }
                
                echo json_encode($films);
            } catch(PDOException $e) {
                echo json_encode(['success' => false, 'message' => 'Filmler getirilirken hata: ' . $e->getMessage()]);
            }
        } elseif (isset($_GET['check_film'])) {
            // Belirli bir filmi kontrol et
            $user_id = intval($_GET['user_id']);
            $film_title = $_GET['check_film'];
            
            try {
                $stmt = $pdo->prepare("SELECT * FROM film_takip WHERE user_id = ? AND title = ?");
                $stmt->execute([$user_id, $film_title]);
                $film = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($film) {
                    $film['isWatched'] = (bool)$film['is_watched'];
                    $film['isFavorite'] = (bool)$film['is_favorite'];
                    $film['isWatchlist'] = (bool)$film['is_watchlist'];
                    $film['rating'] = floatval($film['rating']);
                    $film['year'] = intval($film['year']);
                    echo json_encode($film);
                } else {
                    echo json_encode(null);
                }
            } catch(PDOException $e) {
                echo json_encode(['success' => false, 'message' => 'Film kontrol edilirken hata: ' . $e->getMessage()]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'user_id parametresi gerekli']);
        }
        break;
        
    case 'POST':
        // Yeni film ekle veya güncelle
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
            // IMDb puanını filmler tablosundan al
            $imdbRating = getFilmImdbRating($pdo, $input['title']);
            
            // Önce filmi kontrol et
            $stmt = $pdo->prepare("SELECT id FROM film_takip WHERE user_id = ? AND title = ?");
            $stmt->execute([intval($input['user_id']), $input['title']]);
            $existingFilm = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($existingFilm) {
                // Mevcut filmi güncelle - IMDb puanını güncelle
                $stmt = $pdo->prepare("UPDATE film_takip SET year = ?, genre = ?, poster = ?, rating = ?, review = ?, is_watched = ?, is_favorite = ?, is_watchlist = ? WHERE id = ?");
                
                $result = $stmt->execute([
                    isset($input['year']) ? intval($input['year']) : null,
                    isset($input['genre']) ? $input['genre'] : null,
                    isset($input['poster']) ? $input['poster'] : null,
                    $imdbRating, // IMDb puanını otomatik olarak set et
                    isset($input['review']) ? $input['review'] : null,
                    isset($input['isWatched']) ? (bool)$input['isWatched'] : false,
                    isset($input['isFavorite']) ? (bool)$input['isFavorite'] : false,
                    isset($input['isWatchlist']) ? (bool)$input['isWatchlist'] : false,
                    $existingFilm['id']
                ]);
                
                if ($result) {
                    echo json_encode(['success' => true, 'message' => 'Film başarıyla güncellendi (IMDb: ' . $imdbRating . ')', 'id' => $existingFilm['id']]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Film güncellenirken hata oluştu']);
                }
            } else {
                // Yeni film ekle - IMDb puanı ile
                $stmt = $pdo->prepare("INSERT INTO film_takip (user_id, title, year, genre, poster, rating, review, is_watched, is_favorite, is_watchlist) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                
                $result = $stmt->execute([
                    intval($input['user_id']),
                    $input['title'],
                    isset($input['year']) ? intval($input['year']) : null,
                    isset($input['genre']) ? $input['genre'] : null,
                    isset($input['poster']) ? $input['poster'] : null,
                    $imdbRating, // IMDb puanını otomatik olarak set et
                    isset($input['review']) ? $input['review'] : null,
                    isset($input['isWatched']) ? (bool)$input['isWatched'] : false,
                    isset($input['isFavorite']) ? (bool)$input['isFavorite'] : false,
                    isset($input['isWatchlist']) ? (bool)$input['isWatchlist'] : false
                ]);
                
                if ($result) {
                    echo json_encode(['success' => true, 'message' => 'Film başarıyla eklendi (IMDb: ' . $imdbRating . ')', 'id' => $pdo->lastInsertId()]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Film eklenirken hata oluştu']);
                }
            }
        } catch(PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Film eklenirken hata: ' . $e->getMessage()]);
        }
        break;
        
    case 'PUT':
        // Film güncelle
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (!$input) {
            echo json_encode(['success' => false, 'message' => 'Geçersiz JSON verisi']);
            break;
        }
        
        try {
            // IMDb puanını filmler tablosundan al
            $imdbRating = getFilmImdbRating($pdo, $input['title']);
            
            // Önce filmi bul
            $stmt = $pdo->prepare("SELECT id FROM film_takip WHERE user_id = ? AND title = ?");
            $stmt->execute([intval($input['user_id']), $input['title']]);
            $existingFilm = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($existingFilm) {
                // Mevcut filmi güncelle - IMDb puanını güncelle
                $stmt = $pdo->prepare("UPDATE film_takip SET year = ?, genre = ?, poster = ?, rating = ?, review = ?, is_watched = ?, is_favorite = ?, is_watchlist = ? WHERE id = ?");
                
                $result = $stmt->execute([
                    isset($input['year']) ? intval($input['year']) : null,
                    isset($input['genre']) ? $input['genre'] : null,
                    isset($input['poster']) ? $input['poster'] : null,
                    $imdbRating, // IMDb puanını otomatik olarak set et
                    isset($input['review']) ? $input['review'] : null,
                    isset($input['isWatched']) ? (bool)$input['isWatched'] : false,
                    isset($input['isFavorite']) ? (bool)$input['isFavorite'] : false,
                    isset($input['isWatchlist']) ? (bool)$input['isWatchlist'] : false,
                    $existingFilm['id']
                ]);
                
                if ($result) {
                    echo json_encode(['success' => true, 'message' => 'Film başarıyla güncellendi (IMDb: ' . $imdbRating . ')']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Film güncellenirken hata oluştu']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Film bulunamadı']);
            }
        } catch(PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Film güncellenirken hata: ' . $e->getMessage()]);
        }
        break;
        
    case 'DELETE':
        // Film sil
        if (isset($_GET['id'])) {
            $film_id = intval($_GET['id']);
            
            try {
                $stmt = $pdo->prepare("DELETE FROM film_takip WHERE id = ?");
                $result = $stmt->execute([$film_id]);
                
                if ($result) {
                    echo json_encode(['success' => true, 'message' => 'Film başarıyla silindi']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Film silinirken hata oluştu']);
                }
            } catch(PDOException $e) {
                echo json_encode(['success' => false, 'message' => 'Film silinirken hata: ' . $e->getMessage()]);
            }
        } elseif (isset($_GET['user_id']) && isset($_GET['title'])) {
            // Film adına göre sil
            $user_id = intval($_GET['user_id']);
            $film_title = $_GET['title'];
            
            try {
                $stmt = $pdo->prepare("DELETE FROM film_takip WHERE user_id = ? AND title = ?");
                $result = $stmt->execute([$user_id, $film_title]);
                
                if ($result) {
                    echo json_encode(['success' => true, 'message' => 'Film başarıyla silindi']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Film silinirken hata oluştu']);
                }
            } catch(PDOException $e) {
                echo json_encode(['success' => false, 'message' => 'Film silinirken hata: ' . $e->getMessage()]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Film ID veya user_id ve title gerekli']);
        }
        break;
        
    default:
        echo json_encode(['success' => false, 'message' => 'Desteklenmeyen HTTP metodu']);
        break;
}
?>
