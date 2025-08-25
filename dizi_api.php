<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

$baglanti = new mysqli("localhost", "root", "", "basit_sistem");

if ($baglanti->connect_error) {
    echo json_encode(["success" => false, "message" => "DB bağlantı hatası: " . $baglanti->connect_error]);
    exit;
}

// GET: Dizileri getir
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $kategori = isset($_GET['kategori']) ? $_GET['kategori'] : null;
    $id = isset($_GET['id']) ? (int)$_GET['id'] : null;
    $search = isset($_GET['search']) ? $_GET['search'] : null;
    $test = isset($_GET['test']) ? $_GET['test'] : null;
    
    // Test endpoint - veritabanı durumunu kontrol et
    if ($test === 'db') {
        $tables = [];
        $result = $baglanti->query("SHOW TABLES");
        while ($row = $result->fetch_array()) {
            $tables[] = $row[0];
        }
        
        $diziCount = 0;
        if (in_array('diziler', $tables)) {
            $countResult = $baglanti->query("SELECT COUNT(*) as count FROM diziler");
            if ($countResult) {
                $diziCount = $countResult->fetch_assoc()['count'];
            }
        }
        
        echo json_encode([
            "success" => true,
            "tables" => $tables,
            "diziler_table_exists" => in_array('diziler', $tables),
            "dizi_count" => $diziCount,
            "db_name" => "basit_sistem"
        ]);
        exit;
    }
    
    if ($id) {
        // Tek dizi getir
        $sql = "SELECT * FROM diziler WHERE id = $id";
        $sonuc = $baglanti->query($sql);
        
        if ($sonuc && $sonuc->num_rows > 0) {
            $dizi = $sonuc->fetch_assoc();
            echo json_encode(["success" => true, "dizi" => $dizi]);
        } else {
            echo json_encode(["success" => false, "message" => "Dizi bulunamadı"]);
        }
    } elseif ($search) {
        // Arama yap
        error_log("🔍 Dizi arama isteği: " . $search);
        $search = $baglanti->real_escape_string($search);
        $sql = "SELECT * FROM diziler WHERE 
                dizi_adi LIKE '%$search%' OR 
                yonetmen LIKE '%$search%' OR 
                aciklama LIKE '%$search%' OR 
                kategori LIKE '%$search%'
                ORDER BY yil DESC, dizi_adi ASC";
        
        error_log("🔍 SQL sorgusu: " . $sql);
        
        $sonuc = $baglanti->query($sql);
        
        if (!$sonuc) {
            error_log("❌ SQL hatası: " . $baglanti->error);
            echo json_encode(["success" => false, "message" => "SQL hatası: " . $baglanti->error]);
            exit;
        }
        
        $diziler = [];
        while ($satir = $sonuc->fetch_assoc()) {
            $diziler[] = $satir;
        }
        
        error_log("🔍 Bulunan dizi sayısı: " . count($diziler));
        
        echo json_encode([
            "success" => true,
            "diziler" => $diziler,
            "toplam_dizi" => count($diziler)
        ]);
    } else {
        // Tüm dizileri veya kategoriye göre getir
        $sql = "SELECT * FROM diziler";
        if ($kategori) {
            $kategori = $baglanti->real_escape_string($kategori);
            $sql .= " WHERE kategori = '$kategori'";
        }
        $sql .= " ORDER BY yil DESC, dizi_adi ASC";
        
        $sonuc = $baglanti->query($sql);
        
        if (!$sonuc) {
            echo json_encode(["success" => false, "message" => "SQL hatası: " . $baglanti->error]);
            exit;
        }
        
        $diziler = [];
        while ($satir = $sonuc->fetch_assoc()) {
            $diziler[] = $satir;
        }
        
        echo json_encode([
            "success" => true,
            "diziler" => $diziler,
            "toplam_dizi" => count($diziler)
        ]);
    }
}

$baglanti->close();
?> 