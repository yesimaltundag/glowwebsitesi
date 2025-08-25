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

// Kitap bilgilerini kitaplar tablosundan al
function getBookGoodreadsRating($pdo, $bookTitle) {
    try {
        // Önce sütunun varlığını kontrol et
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'kitaplar' AND COLUMN_NAME = 'goodreads_puani'");
        $stmt->execute();
        $columnExists = $stmt->fetchColumn() > 0;
        
        if ($columnExists) {
            $stmt = $pdo->prepare("SELECT goodreads_puani FROM kitaplar WHERE kitap_adi = ? LIMIT 1");
            $stmt->execute([$bookTitle]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? floatval($result['goodreads_puani']) : 0;
        }
        
        return 0; // Sütun yoksa 0 döndür
    } catch(PDOException $e) {
        error_log("Goodreads rating error: " . $e->getMessage());
        return 0; // Hata durumunda 0 döndür
    }
}

// Kitap kategorisini kitaplar tablosundan al
function getBookCategory($pdo, $bookTitle) {
    try {
        // Önce kitaplar tablosunun varlığını kontrol et
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'kitaplar'");
        $stmt->execute();
        $tableExists = $stmt->fetchColumn() > 0;
        
        if ($tableExists) {
            $stmt = $pdo->prepare("SELECT kategori FROM kitaplar WHERE kitap_adi = ? LIMIT 1");
            $stmt->execute([$bookTitle]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result['kategori'] : '';
        }
        
        return ''; // Tablo yoksa boş string döndür
    } catch(PDOException $e) {
        error_log("Book category error: " . $e->getMessage());
        return ''; // Hata durumunda boş string döndür
    }
}

// Kitap takip tablosunu oluştur (eğer yoksa)
try {
    $pdo->exec("CREATE TABLE IF NOT EXISTS kitap_takip (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        title VARCHAR(255) NOT NULL,
        author VARCHAR(255),
        category VARCHAR(100),
        cover TEXT,
        rating DECIMAL(3,1) DEFAULT 0.0,
        review TEXT,
        is_read BOOLEAN DEFAULT FALSE,
        is_favorite BOOLEAN DEFAULT FALSE,
        is_wishlist BOOLEAN DEFAULT FALSE,
        pages_read INT DEFAULT 0,
        total_pages INT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES kullanicilar(id) ON DELETE CASCADE
    )");
    
    // Mevcut tabloya is_wishlist alanını ekle (eğer yoksa)
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = ? AND TABLE_NAME = 'kitap_takip' AND COLUMN_NAME = 'is_wishlist'");
    $stmt->execute(['basit_sistem']);
    $columnExists = $stmt->fetchColumn() > 0;
    
    if (!$columnExists) {
        $pdo->exec("ALTER TABLE kitap_takip ADD COLUMN is_wishlist BOOLEAN DEFAULT FALSE");
    }
    
    // Mevcut tabloya pages_read alanını ekle (eğer yoksa)
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = ? AND TABLE_NAME = 'kitap_takip' AND COLUMN_NAME = 'pages_read'");
    $stmt->execute(['basit_sistem']);
    $pagesReadExists = $stmt->fetchColumn() > 0;
    
    if (!$pagesReadExists) {
        $pdo->exec("ALTER TABLE kitap_takip ADD COLUMN pages_read INT DEFAULT 0");
    }
    
    // Mevcut tabloya total_pages alanını ekle (eğer yoksa)
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = ? AND TABLE_NAME = 'kitap_takip' AND COLUMN_NAME = 'total_pages'");
    $stmt->execute(['basit_sistem']);
    $totalPagesExists = $stmt->fetchColumn() > 0;
    
    if (!$totalPagesExists) {
        $pdo->exec("ALTER TABLE kitap_takip ADD COLUMN total_pages INT DEFAULT 0");
    }
    
    // Mevcut tabloya category alanını ekle (eğer yoksa)
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = ? AND TABLE_NAME = 'kitap_takip' AND COLUMN_NAME = 'category'");
    $stmt->execute(['basit_sistem']);
    $categoryExists = $stmt->fetchColumn() > 0;
    
    if (!$categoryExists) {
        $pdo->exec("ALTER TABLE kitap_takip ADD COLUMN category VARCHAR(100) DEFAULT NULL");
    }
    
    // Mevcut tabloya author alanını ekle (eğer yoksa)
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = ? AND TABLE_NAME = 'kitap_takip' AND COLUMN_NAME = 'author'");
    $stmt->execute(['basit_sistem']);
    $authorExists = $stmt->fetchColumn() > 0;
    
    if (!$authorExists) {
        $pdo->exec("ALTER TABLE kitap_takip ADD COLUMN author VARCHAR(255) DEFAULT NULL");
    }
    
    // Mevcut tabloya cover alanını ekle (eğer yoksa)
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = ? AND TABLE_NAME = 'kitap_takip' AND COLUMN_NAME = 'cover'");
    $stmt->execute(['basit_sistem']);
    $coverExists = $stmt->fetchColumn() > 0;
    
    if (!$coverExists) {
        $pdo->exec("ALTER TABLE kitap_takip ADD COLUMN cover TEXT DEFAULT NULL");
    }
    
    // Mevcut tabloya rating alanını ekle (eğer yoksa)
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = ? AND TABLE_NAME = 'kitap_takip' AND COLUMN_NAME = 'rating'");
    $stmt->execute(['basit_sistem']);
    $ratingExists = $stmt->fetchColumn() > 0;
    
    if (!$ratingExists) {
        $pdo->exec("ALTER TABLE kitap_takip ADD COLUMN rating DECIMAL(3,1) DEFAULT 0.0");
    }
    
    // Mevcut tabloya review alanını ekle (eğer yoksa)
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = ? AND TABLE_NAME = 'kitap_takip' AND COLUMN_NAME = 'review'");
    $stmt->execute(['basit_sistem']);
    $reviewExists = $stmt->fetchColumn() > 0;
    
    if (!$reviewExists) {
        $pdo->exec("ALTER TABLE kitap_takip ADD COLUMN review TEXT DEFAULT NULL");
    }
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Tablo oluşturma hatası: ' . $e->getMessage()]);
    exit();
}

$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
    case 'GET':
        // Kitap listesini getir
        if (isset($_GET['user_id'])) {
            $user_id = intval($_GET['user_id']);
            
            try {
                // Önce sadece kitap_takip tablosundan veri çek (JOIN olmadan)
                $stmt = $pdo->prepare("SELECT * FROM kitap_takip WHERE user_id = ? ORDER BY created_at DESC");
                $stmt->execute([$user_id]);
                $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                // Boolean değerleri dönüştür
                foreach ($books as &$book) {
                    $book['isRead'] = (bool)$book['is_read'];
                    $book['isFavorite'] = (bool)$book['is_favorite'];
                    $book['isWishlist'] = (bool)$book['is_wishlist'];
                    $book['rating'] = floatval($book['rating']);
                    $book['pagesRead'] = intval($book['pages_read']);
                    $book['totalPages'] = intval($book['total_pages']);
                    // Kitap detay sayfası için id'yi kullan (kitap_id artık yok)
                    $book['kitap_id'] = intval($book['id']);
                }
                
                echo json_encode($books);
            } catch(PDOException $e) {
                echo json_encode(['success' => false, 'message' => 'Kitaplar getirilirken hata: ' . $e->getMessage()]);
            }
        } elseif (isset($_GET['check_book'])) {
            // Belirli bir kitabı kontrol et
            $user_id = intval($_GET['user_id']);
            $book_title = $_GET['check_book'];
            
            try {
                $stmt = $pdo->prepare("SELECT * FROM kitap_takip WHERE user_id = ? AND title = ?");
                $stmt->execute([$user_id, $book_title]);
                $book = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($book) {
                    $book['isRead'] = (bool)$book['is_read'];
                    $book['isFavorite'] = (bool)$book['is_favorite'];
                    $book['isWishlist'] = (bool)$book['is_wishlist'];
                    $book['rating'] = floatval($book['rating']);
                    $book['pagesRead'] = intval($book['pages_read']);
                    $book['totalPages'] = intval($book['total_pages']);
                    echo json_encode($book);
                } else {
                    echo json_encode(null);
                }
            } catch(PDOException $e) {
                echo json_encode(['success' => false, 'message' => 'Kitap kontrol edilirken hata: ' . $e->getMessage()]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'user_id parametresi gerekli']);
        }
        break;
        
    case 'POST':
        // Yeni kitap ekle veya güncelle
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
            // Goodreads puanını ve kategoriyi kitaplar tablosundan al
            $goodreadsRating = getBookGoodreadsRating($pdo, $input['title']);
            $bookCategory = getBookCategory($pdo, $input['title']);
            
            // Önce kitabı kontrol et
            $stmt = $pdo->prepare("SELECT id FROM kitap_takip WHERE user_id = ? AND title = ?");
            $stmt->execute([intval($input['user_id']), $input['title']]);
            $existingBook = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($existingBook) {
                // Durumları kontrol et - eğer hepsi false ise kitabı sil
                $isRead = isset($input['isRead']) ? (bool)$input['isRead'] : false;
                $isFavorite = isset($input['isFavorite']) ? (bool)$input['isFavorite'] : false;
                $isWishlist = isset($input['isWishlist']) ? (bool)$input['isWishlist'] : false;
                
                // Eğer hepsi false ise kitabı sil
                if (!$isRead && !$isFavorite && !$isWishlist) {
                    $stmt = $pdo->prepare("DELETE FROM kitap_takip WHERE id = ?");
                    $result = $stmt->execute([$existingBook['id']]);
                    
                    if ($result) {
                        echo json_encode(['success' => true, 'message' => 'Kitap takip listesinden çıkarıldı', 'action' => 'deleted']);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Kitap silinirken hata oluştu']);
                    }
                } else {
                    // Mevcut kitabı güncelle - Goodreads puanını güncelle
                    $stmt = $pdo->prepare("UPDATE kitap_takip SET author = ?, category = ?, cover = ?, rating = ?, review = ?, is_read = ?, is_favorite = ?, is_wishlist = ?, pages_read = ?, total_pages = ? WHERE id = ?");
                    
                    $result = $stmt->execute([
                        isset($input['author']) ? $input['author'] : null,
                        $bookCategory ?: (isset($input['category']) ? $input['category'] : null),
                        isset($input['cover']) ? $input['cover'] : null,
                        $goodreadsRating > 0 ? $goodreadsRating : (isset($input['rating']) ? floatval($input['rating']) : 0),
                        isset($input['review']) ? $input['review'] : null,
                        $isRead,
                        $isFavorite,
                        $isWishlist,
                        isset($input['pagesRead']) ? intval($input['pagesRead']) : 0,
                        isset($input['totalPages']) ? intval($input['totalPages']) : 0,
                        $existingBook['id']
                    ]);
                    
                    if ($result) {
                        echo json_encode(['success' => true, 'message' => 'Kitap başarıyla güncellendi (Goodreads: ' . $goodreadsRating . ')', 'id' => $existingBook['id'], 'action' => 'updated']);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Kitap güncellenirken hata oluştu']);
                    }
                }
            } else {
                // Yeni kitap ekle - ama önce hiç bir durumu true değilse ekleme
                $isRead = isset($input['isRead']) ? (bool)$input['isRead'] : false;
                $isFavorite = isset($input['isFavorite']) ? (bool)$input['isFavorite'] : false;
                $isWishlist = isset($input['isWishlist']) ? (bool)$input['isWishlist'] : false;
                
                // Eğer hiçbir durum true değilse kitabı ekleme
                if (!$isRead && !$isFavorite && !$isWishlist) {
                    echo json_encode(['success' => true, 'message' => 'Kitap takip durumu olmadığı için eklenmedi', 'action' => 'not_added']);
                } else {
                    // Yeni kitap ekle - Goodreads puanı ile
                    $stmt = $pdo->prepare("INSERT INTO kitap_takip (user_id, title, author, category, cover, rating, review, is_read, is_favorite, is_wishlist, pages_read, total_pages) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    
                    $result = $stmt->execute([
                        intval($input['user_id']),
                        $input['title'],
                        isset($input['author']) ? $input['author'] : null,
                        $bookCategory ?: (isset($input['category']) ? $input['category'] : null),
                        isset($input['cover']) ? $input['cover'] : null,
                        $goodreadsRating > 0 ? $goodreadsRating : (isset($input['rating']) ? floatval($input['rating']) : 0),
                        isset($input['review']) ? $input['review'] : null,
                        $isRead,
                        $isFavorite,
                        $isWishlist,
                        isset($input['pagesRead']) ? intval($input['pagesRead']) : 0,
                        isset($input['totalPages']) ? intval($input['totalPages']) : 0
                    ]);
                    
                    if ($result) {
                        echo json_encode(['success' => true, 'message' => 'Kitap başarıyla eklendi (Goodreads: ' . $goodreadsRating . ')', 'id' => $pdo->lastInsertId(), 'action' => 'added']);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Kitap eklenirken hata oluştu']);
                    }
                }
            }
        } catch(PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Kitap eklenirken hata: ' . $e->getMessage()]);
        }
        break;
        
    case 'PUT':
        // Kitap güncelle
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (!$input) {
            echo json_encode(['success' => false, 'message' => 'Geçersiz JSON verisi']);
            break;
        }
        
        try {
            // Goodreads puanını ve kategoriyi kitaplar tablosundan al
            $goodreadsRating = getBookGoodreadsRating($pdo, $input['title']);
            $bookCategory = getBookCategory($pdo, $input['title']);
            
            // Önce kitabı bul
            $stmt = $pdo->prepare("SELECT id FROM kitap_takip WHERE user_id = ? AND title = ?");
            $stmt->execute([intval($input['user_id']), $input['title']]);
            $existingBook = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($existingBook) {
                // Mevcut kitabı güncelle - Goodreads puanını güncelle
                $stmt = $pdo->prepare("UPDATE kitap_takip SET author = ?, category = ?, cover = ?, rating = ?, review = ?, is_read = ?, is_favorite = ?, is_wishlist = ?, pages_read = ?, total_pages = ? WHERE id = ?");
                
                $result = $stmt->execute([
                    isset($input['author']) ? $input['author'] : null,
                    $bookCategory ?: (isset($input['category']) ? $input['category'] : null),
                    isset($input['cover']) ? $input['cover'] : null,
                    $goodreadsRating > 0 ? $goodreadsRating : (isset($input['rating']) ? floatval($input['rating']) : 0),
                    isset($input['review']) ? $input['review'] : null,
                    isset($input['isRead']) ? (bool)$input['isRead'] : false,
                    isset($input['isFavorite']) ? (bool)$input['isFavorite'] : false,
                    isset($input['isWishlist']) ? (bool)$input['isWishlist'] : false,
                    isset($input['pagesRead']) ? intval($input['pagesRead']) : 0,
                    isset($input['totalPages']) ? intval($input['totalPages']) : 0,
                    $existingBook['id']
                ]);
                
                if ($result) {
                    echo json_encode(['success' => true, 'message' => 'Kitap başarıyla güncellendi (Goodreads: ' . $goodreadsRating . ')']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Kitap güncellenirken hata oluştu']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Kitap bulunamadı']);
            }
        } catch(PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Kitap güncellenirken hata: ' . $e->getMessage()]);
        }
        break;
        
    case 'DELETE':
        // Kitap sil
        if (isset($_GET['id'])) {
            $book_id = intval($_GET['id']);
            
            try {
                $stmt = $pdo->prepare("DELETE FROM kitap_takip WHERE id = ?");
                $result = $stmt->execute([$book_id]);
                
                if ($result) {
                    echo json_encode(['success' => true, 'message' => 'Kitap başarıyla silindi']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Kitap silinirken hata oluştu']);
                }
            } catch(PDOException $e) {
                echo json_encode(['success' => false, 'message' => 'Kitap silinirken hata: ' . $e->getMessage()]);
            }
        } elseif (isset($_GET['user_id']) && isset($_GET['title'])) {
            // Kitap adına göre sil
            $user_id = intval($_GET['user_id']);
            $book_title = $_GET['title'];
            
            try {
                $stmt = $pdo->prepare("DELETE FROM kitap_takip WHERE user_id = ? AND title = ?");
                $result = $stmt->execute([$user_id, $book_title]);
                
                if ($result) {
                    echo json_encode(['success' => true, 'message' => 'Kitap başarıyla silindi']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Kitap silinirken hata oluştu']);
                }
            } catch(PDOException $e) {
                echo json_encode(['success' => false, 'message' => 'Kitap silinirken hata: ' . $e->getMessage()]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Kitap ID veya user_id ve title gerekli']);
        }
        break;
        
    default:
        echo json_encode(['success' => false, 'message' => 'Desteklenmeyen HTTP metodu']);
        break;
}
?>
