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