<!DOCTYPE html>
<html lang="tr" ng-app="GirisApp">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mesaj Yönetimi - GLOW</title>

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css" />

    <!-- AngularJS -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <script src="assets/js/app.js"></script>

    <!-- Popup JavaScript -->
    <script>
      // Test fonksiyonu
      function testPopup() {
        console.log('Test popup çalışıyor!');
        const popup = document.getElementById('messagePopup');
        if (popup) {
          popup.style.display = 'flex';
          console.log('Popup açıldı!');
        } else {
          console.log('Popup bulunamadı!');
        }
      }

      // Mini Popup işlemleri
      function openMessagePopup(messageId) {
        console.log('openMessagePopup çağrıldı, ID:', messageId);
        // Mesaj detaylarını getir
        fetch(`get_message_details.php?id=${messageId}`)
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              const popup = document.getElementById('messagePopup');
              const popupContent = document.getElementById('popupContent');
              
              popupContent.innerHTML = `
                <div class="message-details">
                  <h4>📧 Gelen Mesaj</h4>
                  <div class="message-info">
                    <div>
                      <label>Konu:</label>
                      <span>${data.message.konu}</span>
                    </div>
                    <div>
                      <label>Gönderen:</label>
                      <span>${data.message.adisoyadi}</span>
                    </div>
                  </div>
                  <div class="message-text">
                    <label>Mesaj:</label>
                    <p>${data.message.mesaj}</p>
                  </div>
                </div>

                <div class="reply-section">
                  <h4>✍️ Cevap Yaz</h4>
                  <div class="reply-form">
                    <textarea 
                      id="replyText" 
                      class="reply-textarea" 
                      placeholder="Cevabınızı buraya yazın..."
                      rows="4"
                    ></textarea>
                    <div class="reply-actions">
                      <button class="cancel-btn" onclick="closeMessagePopup()">❌ İptal</button>
                      <button class="reply-btn" onclick="sendReply(${messageId})">📤 Cevap Gönder</button>
                    </div>
                  </div>
                </div>
              `;
              
              popup.style.display = 'flex';
            } else {
              alert('Mesaj detayları yüklenirken hata oluştu!');
            }
          })
          .catch(error => {
            console.error('Hata:', error);
            alert('Mesaj detayları yüklenirken hata oluştu!');
          });
      }

      function closeMessagePopup() {
        document.getElementById('messagePopup').style.display = 'none';
      }

      function sendReply(messageId) {
        const replyText = document.getElementById('replyText').value.trim();
        
        if (!replyText) {
          alert('Lütfen bir cevap yazın!');
          return;
        }

        // Cevabı gönder
        fetch('mesaj_cevap_api.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            iletisim_formu_id: messageId,
            cevap_mesaji: replyText,
            cevap_veren_yonetici_user_id: <?php 
              // Admin kullanıcısının ID'sini al
              $baglanti = new mysqli("localhost", "root", "", "basit_sistem");
              if (!$baglanti->connect_error) {
                $admin_sql = "SELECT id FROM kisiler WHERE rol = 'admin' LIMIT 1";
                $admin_result = $baglanti->query($admin_sql);
                if ($admin_result && $admin_result->num_rows > 0) {
                  $admin = $admin_result->fetch_assoc();
                  echo $admin['id']; // Admin ID'si (104)
                } else {
                  echo "104"; // Varsayılan admin ID
                }
                $baglanti->close();
              } else {
                echo "104"; // Varsayılan admin ID
              }
            ?>
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            alert('✅ Cevap başarıyla gönderildi!');
            closeMessagePopup();
            // Sayfayı yenile
            location.reload();
          } else {
            alert('❌ Cevap gönderilirken hata: ' + data.message);
          }
        })
        .catch(error => {
          console.error('Hata:', error);
          alert('❌ Cevap gönderilirken hata oluştu!');
        });
      }

      // Popup dışına tıklandığında kapat
      document.addEventListener('DOMContentLoaded', function() {
        const popup = document.getElementById('messagePopup');
        if (popup) {
          popup.addEventListener('click', function(e) {
            if (e.target === this) {
              closeMessagePopup();
            }
          });
        }
      });
    </script>

    <!-- Page Specific CSS -->
    <style>
      .admin-container {
        max-width: 100%;
        margin: 0 auto;
        padding: 20px;
      }

      .admin-header {
        text-align: center;
        margin-bottom: 30px;
        background: rgba(255, 255, 255, 0.9);
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
        position: relative;
      }

      .admin-header h1 {
        color: #7c5c4a;
        font-size: 32px;
        margin-bottom: 10px;
        font-weight: 600;
      }

      .geri-btn {
        background: linear-gradient(135deg, #e2d9d0, #b48a78);
        color: #7c5c4a;
        border: none;
        border-radius: 50%;
        width: 45px;
        height: 45px;
        padding: 0;
        font-size: 18px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
        position: absolute;
        top: 20px;
        left: 20px;
        margin: 0;
      }

      .geri-btn:hover {
        background: linear-gradient(135deg, #b48a78, #e2d9d0);
        color: #fff;
        transform: scale(1.08);
      }

      .search-box {
        width: 100%;
        max-width: 500px;
        padding: 12px 16px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 16px;
        margin-bottom: 20px;
        transition: border-color 0.3s ease;
        background: rgba(255, 255, 255, 0.9);
      }

      .search-box:focus {
        outline: none;
        border-color: #b48a78;
        box-shadow: 0 0 0 3px rgba(180, 138, 120, 0.1);
      }

      .table-container {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        margin: 20px 0;
        backdrop-filter: blur(10px);
      }

      .table-container table {
        width: 100%;
        border-collapse: collapse;
      }

      .table-container th,
      .table-container td {
        padding: 16px;
        text-align: left;
        border-bottom: 1px solid #e0e0e0;
      }

      .table-container th {
        background: #7c5c4a;
        color: white;
        font-weight: 600;
      }

      .table-container tr:nth-child(even) {
        background: rgba(248, 240, 241, 0.5);
      }

      .table-container tr:hover {
        background: rgba(226, 217, 208, 0.3);
        cursor: pointer;
      }

      .message-row {
        cursor: pointer;
        transition: all 0.3s ease;
      }

      .message-row:hover {
        background: rgba(180, 138, 120, 0.1) !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      }

      .action-btn {
        padding: 4px 10px;
        border: none;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        margin: 2px;
      }

      .delete-btn {
        background: linear-gradient(135deg, #ffebee, #f44336);
        color: white;
        box-shadow: 0 2px 8px rgba(244, 67, 54, 0.2);
      }

      .delete-btn:hover {
        background: linear-gradient(135deg, #f44336, #ffebee);
        transform: scale(1.05);
      }

      .action-btn-group {
        display: flex;
        gap: 5px;
      }

      .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
        margin-top: 30px;
      }

      .pagination button {
        background: linear-gradient(135deg, #e2d9d0, #b48a78);
        color: #7c5c4a;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
      }

      .pagination button:hover:not(:disabled) {
        background: linear-gradient(135deg, #b48a78, #e2d9d0);
        color: white;
        transform: translateY(-2px);
      }

      .pagination button:disabled {
        opacity: 0.5;
        cursor: not-allowed;
      }

      .message-content {
        max-width: 300px;
        word-wrap: break-word;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        position: relative;
      }

      /* Mini Popup Styles */
      .popup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .popup-content {
        background: rgba(255, 255, 255, 0.98);
        border-radius: 12px;
        padding: 25px;
        max-width: 450px;
        width: 90%;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(10px);
        position: relative;
      }

      .popup-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid #e0e0e0;
      }

      .popup-title {
        color: #7c5c4a;
        font-size: 20px;
        font-weight: 600;
        margin: 0;
      }

      .close-popup {
        background: linear-gradient(135deg, #ffebee, #f44336);
        color: white;
        border: none;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .close-popup:hover {
        background: linear-gradient(135deg, #f44336, #ffebee);
        transform: scale(1.1);
      }

      .message-details {
        background: rgba(248, 240, 241, 0.5);
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 15px;
        border-left: 3px solid #b48a78;
      }

      .message-details h4 {
        color: #7c5c4a;
        margin: 0 0 10px 0;
        font-size: 16px;
      }

      .message-info {
        margin-bottom: 10px;
      }

      .message-info div {
        background: rgba(255, 255, 255, 0.8);
        padding: 8px;
        border-radius: 6px;
        border: 1px solid #e0e0e0;
        margin-bottom: 8px;
      }

      .message-info label {
        font-weight: 600;
        color: #7c5c4a;
        display: block;
        margin-bottom: 3px;
        font-size: 11px;
        text-transform: uppercase;
      }

      .message-info span {
        color: #333;
        font-size: 13px;
      }

      .message-text {
        background: rgba(255, 255, 255, 0.8);
        padding: 10px;
        border-radius: 6px;
        border: 1px solid #e0e0e0;
        margin-top: 8px;
      }

      .message-text label {
        font-weight: 600;
        color: #7c5c4a;
        display: block;
        margin-bottom: 5px;
        font-size: 11px;
        text-transform: uppercase;
      }

      .message-text p {
        margin: 0;
        line-height: 1.5;
        color: #333;
        font-size: 13px;
      }

      .reply-section {
        margin-top: 15px;
      }

      .reply-section h4 {
        color: #7c5c4a;
        margin: 0 0 10px 0;
        font-size: 16px;
      }

      .reply-form {
        background: rgba(248, 240, 241, 0.3);
        padding: 15px;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
      }

      .reply-textarea {
        width: 100%;
        min-height: 80px;
        padding: 10px;
        border: 2px solid #e0e0e0;
        border-radius: 6px;
        font-size: 13px;
        font-family: inherit;
        resize: vertical;
        transition: border-color 0.3s ease;
        background: rgba(255, 255, 255, 0.9);
      }

      .reply-textarea:focus {
        outline: none;
        border-color: #b48a78;
        box-shadow: 0 0 0 3px rgba(180, 138, 120, 0.1);
      }

      .reply-actions {
        display: flex;
        gap: 10px;
        margin-top: 15px;
        justify-content: flex-end;
      }

      .reply-btn {
        background: linear-gradient(135deg, #4caf50, #45a049);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
      }

      .reply-btn:hover {
        background: linear-gradient(135deg, #45a049, #4caf50);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
      }

      .cancel-btn {
        background: linear-gradient(135deg, #f5f5f5, #e0e0e0);
        color: #666;
        border: none;
        padding: 10px 20px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
      }

      .cancel-btn:hover {
        background: linear-gradient(135deg, #e0e0e0, #f5f5f5);
        transform: translateY(-2px);
      }

      .existing-replies {
        margin-top: 15px;
        background: rgba(255, 255, 255, 0.8);
        border-radius: 8px;
        padding: 15px;
        border: 1px solid #e0e0e0;
      }

      .existing-replies h5 {
        color: #7c5c4a;
        margin: 0 0 10px 0;
        font-size: 14px;
      }

      .reply-item {
        background: rgba(248, 240, 241, 0.5);
        padding: 10px;
        border-radius: 6px;
        margin-bottom: 8px;
        border-left: 2px solid #b48a78;
      }

      .reply-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 5px;
      }

      .reply-author {
        font-weight: 600;
        color: #7c5c4a;
        font-size: 12px;
      }

      .reply-date {
        color: #666;
        font-size: 11px;
      }

      .reply-text {
        color: #333;
        line-height: 1.4;
        font-size: 12px;
      }

      /* Durum Badge'leri */
      .durum-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
      }

      .durum-badge.bekliyor {
        background: linear-gradient(135deg, #fff3e0, #ff9800);
        color: #e65100;
        box-shadow: 0 2px 8px rgba(255, 152, 0, 0.2);
      }

      .durum-badge.cevaplandi {
        background: linear-gradient(135deg, #e8f5e8, #4caf50);
        color: #2e7d32;
        box-shadow: 0 2px 8px rgba(76, 175, 80, 0.2);
      }

      .cevap-sayisi {
        color: #666;
        font-size: 11px;
        margin-left: 5px;
      }

      @media (max-width: 768px) {
        .admin-container {
          padding: 10px;
        }

        .table-container {
          overflow-x: auto;
        }

        .table-container th,
        .table-container td {
          padding: 8px;
          font-size: 14px;
        }

        .action-btn-group {
          flex-direction: column;
        }

        .popup-content {
          width: 95%;
          padding: 20px;
        }

        .message-info {
          grid-template-columns: 1fr;
        }

        .reply-actions {
          flex-direction: column;
        }
      }
    </style>
  </head>
  <body ng-controller="MainController">
    <!-- Header Component -->
    <ng-include src="'components/header.html'"></ng-include>

    <!-- Main Content -->
    <main class="main-content">
      <div ng-controller="MesajYonetimiController">
        <div class="admin-container">
          <div class="admin-header">
            <button
              class="geri-btn"
              ng-click="listeSayfasinaGit()"
              title="Kullanıcı Listesine Dön"
            >
              ←
            </button>
            <h1>📧 Mesaj Yönetimi</h1>
            <p>İletişim formundan gelen mesajları yönetin ve cevap verin</p>
          </div>

          <!-- Mesajlar Tablosu -->
          <div class="table-container">
            <table>
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Ad Soyad</th>
                  <th>E-posta</th>
                  <th>Konu</th>
                  <th>Mesaj</th>
                  <th>Durum</th>
                </tr>
              </thead>
              <tbody>
                <?php
                // Veritabanı bağlantısı
                $baglanti = new mysqli("localhost", "root", "", "basit_sistem");
                
                if ($baglanti->connect_error) {
                    echo "<tr><td colspan='6' style='text-align: center; color: red;'>Veritabanı bağlantı hatası</td></tr>";
                } else {
                    // iletisim_formu tablosundan verileri getir ve cevap durumunu kontrol et
                    $sql = "SELECT iletisim_formu.*, 
                                   CASE WHEN mc.id IS NOT NULL THEN 'Cevaplandı' ELSE 'Bekliyor' END as durum,
                                   COUNT(mc.id) as cevap_sayisi
                            FROM iletisim_formu 
                            LEFT JOIN mesaj_cevaplari mc ON iletisim_formu.id = mc.iletisim_formu_id 
                            GROUP BY iletisim_formu.id 
                            ORDER BY iletisim_formu.id DESC";
                    $sonuc = $baglanti->query($sql);
                    
                    if ($sonuc && $sonuc->num_rows > 0) {
                        while ($mesaj = $sonuc->fetch_assoc()) {
                            $durum_class = $mesaj['durum'] == 'Cevaplandı' ? 'cevaplandi' : 'bekliyor';
                            echo "<tr class='message-row' onclick='openMessagePopup(" . $mesaj['id'] . ")'>";
                            echo "<td>" . $mesaj['id'] . "</td>";
                            echo "<td>" . htmlspecialchars($mesaj['adisoyadi']) . "</td>";
                            echo "<td>" . htmlspecialchars($mesaj['eposta']) . "</td>";
                            echo "<td>" . htmlspecialchars($mesaj['konu']) . "</td>";
                            echo "<td class='message-content' title='" . htmlspecialchars($mesaj['mesaj']) . "'>";
                            echo htmlspecialchars($mesaj['mesaj']);
                            echo "</td>";
                            echo "<td class='durum-" . $durum_class . "'>";
                            echo "<span class='durum-badge " . $durum_class . "'>" . $mesaj['durum'] . "</span>";
                            if ($mesaj['cevap_sayisi'] > 0) {
                                echo " <span class='cevap-sayisi'>(" . $mesaj['cevap_sayisi'] . ")</span>";
                            }
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' style='text-align: center; color: #666;'>Henüz hiç mesaj yok</td></tr>";
                    }
                    
                    $baglanti->close();
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </main>

    <!-- Mini Popup Overlay -->
    <div class="popup-overlay" id="messagePopup" style="display: none;">
      <div class="popup-content">
        <div class="popup-header">
          <h3 class="popup-title">💬 Mesaj Cevabı</h3>
          <button class="close-popup" onclick="closeMessagePopup()">×</button>
        </div>
        
        <div id="popupContent">
          <!-- Mesaj detayları buraya yüklenecek -->
        </div>
      </div>
    </div>

    <!-- Footer Component -->
    <ng-include src="'components/footer.html'"></ng-include>

    <!-- Scroll to Top Button -->
    <button id="scrollTopBtn" title="Yukarı Çık" ng-click="scrollToTop()">
      ↑
    </button>


  </body>
</html>
