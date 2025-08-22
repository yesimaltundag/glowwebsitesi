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

// GET: Sezon bilgisini getir
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $dizi_id = isset($_GET['dizi_id']) ? (int)$_GET['dizi_id'] : null;
    $sezon = isset($_GET['sezon']) ? (int)$_GET['sezon'] : null;
    
    if ($dizi_id) {
        if ($sezon) {
            // Belirli sezon bilgisini getir
            $sql = "SELECT * FROM dizi_sezonlar WHERE dizi_id = ? AND sezon_no = ?";
            $stmt = $baglanti->prepare($sql);
            $stmt->bind_param("ii", $dizi_id, $sezon);
            $stmt->execute();
            $sonuc = $stmt->get_result();
            
            if ($sonuc && $sonuc->num_rows > 0) {
                $sezonBilgisi = $sonuc->fetch_assoc();
                echo json_encode(["success" => true, "sezon" => $sezonBilgisi]);
            } else {
                echo json_encode(["success" => false, "message" => "Sezon bilgisi bulunamadı"]);
            }
            $stmt->close();
        } else {
            // Tüm sezon bilgilerini getir
            $sql = "SELECT * FROM dizi_sezonlar WHERE dizi_id = ? ORDER BY sezon_no ASC";
            $stmt = $baglanti->prepare($sql);
            $stmt->bind_param("i", $dizi_id);
            $stmt->execute();
            $sonuc = $stmt->get_result();
            
            if ($sonuc && $sonuc->num_rows > 0) {
                $sezonlar = [];
                while ($satir = $sonuc->fetch_assoc()) {
                    $sezonlar[] = $satir;
                }
                echo json_encode(["success" => true, "sezonlar" => $sezonlar]);
            } else {
                echo json_encode(["success" => false, "message" => "Sezon bilgisi bulunamadı"]);
            }
            $stmt->close();
        }
    } else {
        echo json_encode(["success" => false, "message" => "Dizi ID gerekli"]);
    }
}

$baglanti->close();
?>
