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
      // Mesaj gösterme fonksiyonu
      function showMessage(message, type) {
        const messageDiv = document.createElement("div");
        messageDiv.className = `message ${type}`;
        messageDiv.textContent = message;
        messageDiv.style.cssText = `
          position: fixed;
          top: 20px;
          right: 20px;
          padding: 15px 25px;
          border-radius: 8px;
          color: white;
          font-weight: 600;
          z-index: 10001;
          animation: slideIn 0.3s ease;
        `;

        if (type === "success") {
          messageDiv.style.background = "#51cf66";
        } else if (type === "error") {
          messageDiv.style.background = "#ff6b6b";
        } else if (type === "warning") {
          messageDiv.style.background = "#ffd43b";
          messageDiv.style.color = "#333";
        }

        document.body.appendChild(messageDiv);

        setTimeout(() => {
          messageDiv.remove();
        }, 4000);
      }

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
              
              // Eğer cevap varsa sadece cevabı göster
              if (data.replies && data.replies.length > 0) {
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
                    <h4>💬 Gönderilen Cevap</h4>
                    <div class="reply-form">
                      <div class="sent-reply">
                        <div class="reply-header">
                          <span class="reply-author">👤 ${data.replies[0].yonetici_adi || 'Admin'}</span>
                          <span class="reply-date">📅 ${data.replies[0].created_at}</span>
                        </div>
                        <div class="reply-text">${data.replies[0].cevap_mesaji}</div>
                      </div>

                    </div>
                  </div>
                `;
              } else {
                // Cevap yoksa cevap formu göster
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
                        <button class="reply-btn" onclick="sendReply(${messageId})">📤 Cevap Gönder</button>
                      </div>
                    </div>
                  </div>
                `;
              }
              
              popup.style.display = 'flex';
            } else {
              alert('Mesaj detayları yüklenirken hata oluştu!');
            }
          })
          .catch(error => {
            console.error('Hata:', error);
            showMessage('Mesaj detayları yüklenirken hata oluştu!', 'error');
          });
      }

      function closeMessagePopup() {
        document.getElementById('messagePopup').style.display = 'none';
      }

      function sendReply(messageId) {
        const replyText = document.getElementById('replyText').value.trim();
        
        if (!replyText) {
          showMessage('Lütfen bir cevap yazın!', 'warning');
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
            showMessage('✅ Cevap başarıyla gönderildi!', 'success');
            closeMessagePopup();
            // Uyarıyı göstermek için 2 saniye bekle, sonra sayfayı yenile
            setTimeout(() => {
              location.reload();
            }, 2000);
          } else {
            showMessage('❌ Cevap gönderilirken hata: ' + data.message, 'error');
          }
        })
        .catch(error => {
          console.error('Hata:', error);
          showMessage('❌ Cevap gönderilirken hata oluştu!', 'error');
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

      /* Dark mode admin header */
      body.dark-theme .admin-header {
        background: rgba(60, 60, 60, 0.9) !important;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4) !important;
        border: 1px solid rgba(212, 165, 116, 0.2) !important;
      }

      .admin-header h1 {
        color: #7c5c4a;
        font-size: 32px;
        margin-bottom: 10px;
        font-weight: 600;
      }

      /* Dark mode admin header title */
      body.dark-theme .admin-header h1 {
        color: #ffffff !important;
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

      /* Dark mode geri button */
      body.dark-theme .geri-btn {
        background: linear-gradient(135deg, #8a6a5a, #6a5445) !important;
        color: #ffffff !important;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.4) !important;
      }

      .geri-btn:hover {
        background: linear-gradient(135deg, #b48a78, #e2d9d0);
        color: #fff;
        transform: scale(1.08);
      }

      /* Dark mode geri button hover */
      body.dark-theme .geri-btn:hover {
        background: linear-gradient(135deg, #6a5445, #5a4435) !important;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.6) !important;
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
        color: #333;
      }

      /* Dark mode search box */
      body.dark-theme .search-box {
        background: rgba(44, 44, 44, 0.9) !important;
        color: #ffffff !important;
        border-color: rgba(212, 165, 116, 0.3) !important;
      }

      .search-box:focus {
        outline: none;
        border-color: #b48a78;
        box-shadow: 0 0 0 3px rgba(180, 138, 120, 0.1);
      }

      /* Dark mode search box focus */
      body.dark-theme .search-box:focus {
        border-color: #d4a574 !important;
        box-shadow: 0 0 0 3px rgba(212, 165, 116, 0.3) !important;
      }

      /* Dark mode search box placeholder */
      body.dark-theme .search-box::placeholder {
        color: #888888 !important;
      }

      .table-container {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        margin: 20px 0;
        backdrop-filter: blur(10px);
      }

      /* Dark mode table container */
      body.dark-theme .table-container {
        background: rgba(60, 60, 60, 0.9) !important;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4) !important;
        border: 1px solid rgba(212, 165, 116, 0.2) !important;
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
        color: #333;
      }

      /* Dark mode table th and td */
      body.dark-theme .table-container th,
      body.dark-theme .table-container td {
        color: #ffffff !important;
        border-bottom-color: rgba(212, 165, 116, 0.3) !important;
      }

      .table-container th {
        background: #7c5c4a;
        color: white;
        font-weight: 600;
      }

      /* Dark mode table th */
      body.dark-theme .table-container th {
        background: #8a6a5a !important;
        color: #ffffff !important;
      }

      .table-container tr:nth-child(even) {
        background: rgba(248, 240, 241, 0.5);
      }

      /* Dark mode table tr even */
      body.dark-theme .table-container tr:nth-child(even) {
        background: rgba(44, 44, 44, 0.5) !important;
      }

      .table-container tr:hover {
        background: rgba(226, 217, 208, 0.3);
        cursor: pointer;
      }

      /* Dark mode table tr hover */
      body.dark-theme .table-container tr:hover {
        background: rgba(60, 60, 60, 0.7) !important;
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

      /* Dark mode message row hover */
      body.dark-theme .message-row:hover {
        background: rgba(212, 165, 116, 0.2) !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4) !important;
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

      /* Dark mode delete button */
      body.dark-theme .delete-btn {
        background: linear-gradient(135deg, #c0392b, #a93226) !important;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.4) !important;
      }

      .delete-btn:hover {
        background: linear-gradient(135deg, #f44336, #ffebee);
        transform: scale(1.02);
      }

      /* Dark mode delete button hover */
      body.dark-theme .delete-btn:hover {
        background: linear-gradient(135deg, #a93226, #8b2a1f) !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.6) !important;
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
        background: rgba(255, 255, 255, 0.9);
        padding: 20px;
        border-radius: 16px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
      }

      /* Dark mode pagination */
      body.dark-theme .pagination {
        background: rgba(60, 60, 60, 0.9) !important;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4) !important;
        border: 1px solid rgba(212, 165, 116, 0.2) !important;
      }

      .pagination button {
        background: linear-gradient(135deg, #e2d9d0, #b48a78);
        color: #7c5c4a;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 600;
        font-size: 14px;
      }

      /* Dark mode pagination button */
      body.dark-theme .pagination button {
        background: linear-gradient(135deg, #8a6a5a, #6a5445) !important;
        color: #ffffff !important;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.4) !important;
      }

      .pagination button:hover:not(:disabled) {
        background: linear-gradient(135deg, #b48a78, #e2d9d0);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(180, 138, 120, 0.3);
      }

      /* Dark mode pagination button hover */
      body.dark-theme .pagination button:hover:not(:disabled) {
        background: linear-gradient(135deg, #6a5445, #5a4435) !important;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.6) !important;
      }

      .pagination button:disabled {
        opacity: 0.5;
        cursor: not-allowed;
      }

      .page-info {
        color: #7c5c4a;
        font-weight: 600;
        font-size: 14px;
        text-align: center;
        padding: 10px 20px;
        background: rgba(226, 217, 208, 0.3);
        border-radius: 8px;
        border: 1px solid #e2d9d0;
      }

      /* Dark mode page info */
      body.dark-theme .page-info {
        color: #ffffff !important;
        background: rgba(60, 60, 60, 0.5) !important;
        border-color: rgba(212, 165, 116, 0.3) !important;
      }

      .message-content {
        max-width: 300px;
        word-wrap: break-word;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        position: relative;
      }

      /* Konu sütunu vurgulama */
      .table-container td:nth-child(4) {
        font-weight: 700 !important;
        color: #7c5c4a !important;
        background: rgba(226, 217, 208, 0.4) !important;
        border-left: 4px solid #b48a78 !important;
        border-right: 4px solid #b48a78 !important;
        font-size: 14px !important;
        text-align: center !important;
        min-width: 120px !important;
      }

      /* Dark mode konu sütunu */
      body.dark-theme .table-container td:nth-child(4) {
        color: #ffffff !important;
        background: rgba(60, 60, 60, 0.6) !important;
        border-left-color: #d4a574 !important;
        border-right-color: #d4a574 !important;
      }

      .table-container th:nth-child(4) {
        background: linear-gradient(135deg, #b48a78, #7c5c4a) !important;
        color: white !important;
        font-weight: 700 !important;
        font-size: 16px !important;
        text-align: center !important;
      }

      /* Dark mode konu sütunu header */
      body.dark-theme .table-container th:nth-child(4) {
        background: linear-gradient(135deg, #8a6a5a, #6a5445) !important;
      }

      /* Tarih sütunu vurgulama */
      .table-container td:nth-child(6) {
        font-weight: 600 !important;
        color: #7c5c4a !important;
        background: rgba(226, 217, 208, 0.3) !important;
        border-left: 3px solid #b48a78 !important;
        border-right: 3px solid #b48a78 !important;
        font-size: 13px !important;
        text-align: center !important;
        min-width: 120px !important;
      }

      /* Dark mode tarih sütunu */
      body.dark-theme .table-container td:nth-child(6) {
        color: #ffffff !important;
        background: rgba(60, 60, 60, 0.5) !important;
        border-left-color: #d4a574 !important;
        border-right-color: #d4a574 !important;
      }

      .table-container th:nth-child(6) {
        background: linear-gradient(135deg, #b48a78, #7c5c4a) !important;
        color: white !important;
        font-weight: 700 !important;
        font-size: 14px !important;
        text-align: center !important;
      }

      /* Dark mode tarih sütunu header */
      body.dark-theme .table-container th:nth-child(6) {
        background: linear-gradient(135deg, #8a6a5a, #6a5445) !important;
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

      /* Dark mode popup content */
      body.dark-theme .popup-content {
        background: rgba(60, 60, 60, 0.98) !important;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.6) !important;
        border: 1px solid rgba(212, 165, 116, 0.2) !important;
      }

      .popup-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid #e0e0e0;
      }

      /* Dark mode popup header */
      body.dark-theme .popup-header {
        border-bottom-color: rgba(212, 165, 116, 0.3) !important;
      }

      .popup-title {
        color: #7c5c4a;
        font-size: 20px;
        font-weight: 600;
        margin: 0;
      }

      /* Dark mode popup title */
      body.dark-theme .popup-title {
        color: #ffffff !important;
      }

      .close-popup {
        background: linear-gradient(135deg, #e2d9d0, #b48a78) !important;
        color: #7c5c4a !important;
        border: none !important;
        border-radius: 4px !important;
        width: 20px !important;
        height: 20px !important;
        font-size: 12px !important;
        cursor: pointer !important;
        transition: all 0.3s ease !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
      }

      /* Dark mode close popup */
      body.dark-theme .close-popup {
        background: linear-gradient(135deg, #8a6a5a, #6a5445) !important;
        color: #ffffff !important;
      }

      .close-popup:hover {
        background: linear-gradient(135deg, #f44336, #ffebee);
        transform: scale(1.1);
      }

      /* Dark mode close popup hover */
      body.dark-theme .close-popup:hover {
        background: linear-gradient(135deg, #c0392b, #a93226) !important;
      }

      .message-details {
        background: rgba(248, 240, 241, 0.5);
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 15px;
        border-left: 3px solid #b48a78;
      }

      /* Dark mode message details */
      body.dark-theme .message-details {
        background: rgba(60, 60, 60, 0.5) !important;
        border-left-color: #d4a574 !important;
      }

      .message-details h4 {
        color: #7c5c4a;
        margin: 0 0 10px 0;
        font-size: 16px;
      }

      /* Dark mode message details h4 */
      body.dark-theme .message-details h4 {
        color: #ffffff !important;
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

      /* Dark mode message info div */
      body.dark-theme .message-info div {
        background: rgba(44, 44, 44, 0.8) !important;
        border-color: rgba(212, 165, 116, 0.3) !important;
      }

      .message-info label {
        font-weight: 600;
        color: #7c5c4a;
        display: block;
        margin-bottom: 3px;
        font-size: 11px;
        text-transform: uppercase;
      }

      /* Dark mode message info label */
      body.dark-theme .message-info label {
        color: #d4a574 !important;
      }

      .message-info span {
        color: #333;
        font-size: 13px;
      }

      /* Dark mode message info span */
      body.dark-theme .message-info span {
        color: #ffffff !important;
      }

      .message-text {
        background: rgba(255, 255, 255, 0.8);
        padding: 10px;
        border-radius: 6px;
        border: 1px solid #e0e0e0;
        margin-top: 8px;
      }

      /* Dark mode message text */
      body.dark-theme .message-text {
        background: rgba(44, 44, 44, 0.8) !important;
        border-color: rgba(212, 165, 116, 0.3) !important;
      }

      .message-text label {
        font-weight: 600;
        color: #7c5c4a;
        display: block;
        margin-bottom: 5px;
        font-size: 11px;
        text-transform: uppercase;
      }

      /* Dark mode message text label */
      body.dark-theme .message-text label {
        color: #d4a574 !important;
      }

      .message-text p {
        margin: 0;
        line-height: 1.5;
        color: #333;
        font-size: 13px;
      }

      /* Dark mode message text p */
      body.dark-theme .message-text p {
        color: #ffffff !important;
      }

      .reply-section {
        margin-top: 15px;
      }

      .reply-section h4 {
        color: #7c5c4a;
        margin: 0 0 10px 0;
        font-size: 16px;
      }

      /* Dark mode reply section h4 */
      body.dark-theme .reply-section h4 {
        color: #ffffff !important;
      }

      .reply-form {
        background: rgba(248, 240, 241, 0.3);
        padding: 15px;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
      }

      /* Dark mode reply form */
      body.dark-theme .reply-form {
        background: rgba(60, 60, 60, 0.3) !important;
        border-color: rgba(212, 165, 116, 0.3) !important;
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
        color: #333;
      }

      /* Dark mode reply textarea */
      body.dark-theme .reply-textarea {
        background: rgba(44, 44, 44, 0.9) !important;
        color: #ffffff !important;
        border-color: rgba(212, 165, 116, 0.3) !important;
      }

      .reply-textarea:focus {
        outline: none;
        border-color: #b48a78;
        box-shadow: 0 0 0 3px rgba(180, 138, 120, 0.1);
      }

      /* Dark mode reply textarea focus */
      body.dark-theme .reply-textarea:focus {
        border-color: #d4a574 !important;
        box-shadow: 0 0 0 3px rgba(212, 165, 116, 0.3) !important;
      }

      /* Dark mode reply textarea placeholder */
      body.dark-theme .reply-textarea::placeholder {
        color: #888888 !important;
      }

      .reply-actions {
        display: flex;
        gap: 10px;
        margin-top: 15px;
        justify-content: center;
      }

      .reply-btn {
        background: linear-gradient(135deg, #4caf50, #45a049);
        color: white;
        border: none;
        padding: 15px 30px;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 100%;
        margin-top: 10px;
      }

      /* Dark mode reply button */
      body.dark-theme .reply-btn {
        background: linear-gradient(135deg, #388e3c, #2e7d32) !important;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.4) !important;
      }

      .reply-btn:hover {
        background: linear-gradient(135deg, #45a049, #4caf50);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
      }

      /* Dark mode reply button hover */
      body.dark-theme .reply-btn:hover {
        background: linear-gradient(135deg, #2e7d32, #1b5e20) !important;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.6) !important;
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

      /* Dark mode cancel button */
      body.dark-theme .cancel-btn {
        background: linear-gradient(135deg, #6c7b7d, #5a6a6c) !important;
        color: #ffffff !important;
      }

      .cancel-btn:hover {
        background: linear-gradient(135deg, #e0e0e0, #f5f5f5);
        transform: translateY(-2px);
      }

      /* Dark mode cancel button hover */
      body.dark-theme .cancel-btn:hover {
        background: linear-gradient(135deg, #5a6a6c, #4a5a5c) !important;
      }

      .existing-replies {
        margin-top: 15px;
        background: rgba(255, 255, 255, 0.8);
        border-radius: 8px;
        padding: 15px;
        border: 1px solid #e0e0e0;
      }

      /* Dark mode existing replies */
      body.dark-theme .existing-replies {
        background: rgba(44, 44, 44, 0.8) !important;
        border-color: rgba(212, 165, 116, 0.3) !important;
      }

      .existing-replies h5 {  
        color: #7c5c4a;
        margin: 0 0 10px 0;
        font-size: 14px;
      }

      /* Dark mode existing replies h5 */
      body.dark-theme .existing-replies h5 {
        color: #ffffff !important;
      }

      .reply-item {
        background: rgba(248, 240, 241, 0.5);
        padding: 10px;
        border-radius: 6px;
        margin-bottom: 8px;
        border-left: 2px solid #b48a78;
      }

      /* Dark mode reply item */
      body.dark-theme .reply-item {
        background: rgba(60, 60, 60, 0.5) !important;
        border-left-color: #d4a574 !important;
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

      /* Dark mode reply author */
      body.dark-theme .reply-author {
        color: #d4a574 !important;
      }

      .reply-date {
        color: #666;
        font-size: 11px;
      }

      /* Dark mode reply date */
      body.dark-theme .reply-date {
        color: #888888 !important;
      }

      .reply-text {
        color: #333;
        line-height: 1.4;
        font-size: 12px;
      }

      /* Dark mode reply text */
      body.dark-theme .reply-text {
        color: #ffffff !important;
      }

      .sent-reply {
        background: rgba(76, 175, 80, 0.1);
        padding: 15px;
        border-radius: 8px;
        border: 2px solid #4caf50;
        margin-bottom: 15px;
      }

      /* Dark mode sent reply */
      body.dark-theme .sent-reply {
        background: rgba(76, 175, 80, 0.2) !important;
        border-color: #4caf50 !important;
      }

      .sent-reply .reply-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
      }

      .sent-reply .reply-author {
        font-weight: 600;
        color: #2e7d32;
        font-size: 13px;
      }

      /* Dark mode sent reply author */
      body.dark-theme .sent-reply .reply-author {
        color: #4caf50 !important;
      }

      .sent-reply .reply-date {
        color: #4caf50;
        font-size: 11px;
      }

      .sent-reply .reply-text {
        color: #1b5e20;
        line-height: 1.5;
        font-size: 13px;
        background: rgba(255, 255, 255, 0.8);
        padding: 10px;
        border-radius: 6px;
        border: 1px solid #c8e6c9;
      }

      /* Dark mode sent reply text */
      body.dark-theme .sent-reply .reply-text {
        color: #ffffff !important;
        background: rgba(44, 44, 44, 0.8) !important;
        border-color: #4caf50 !important;
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

      /* Dark mode cevap sayisi */
      body.dark-theme .cevap-sayisi {
        color: #888888 !important;
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
                  <th>Gönderilme Tarihi</th>
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
                    // Sayfalama ayarları
                    $sayfa_basina = 10; // Her sayfada 10 mesaj
                    $sayfa = isset($_GET['sayfa']) ? (int)$_GET['sayfa'] : 1;
                    $baslangic = ($sayfa - 1) * $sayfa_basina;
                    echo $baslangic;
                    echo $sayfa_basina;
                    
                    // Toplam mesaj sayısını al
                    $toplam_sql = "SELECT COUNT(*) as toplam FROM iletisim_formu";
                    $toplam_sonuc = $baglanti->query($toplam_sql);
                    $toplam_mesaj = $toplam_sonuc->fetch_assoc()['toplam'];
                    $toplam_sayfa = ceil($toplam_mesaj / $sayfa_basina);
                    
                    // iletisim_formu tablosundan verileri getir ve cevap durumunu kontrol et
                    $sql = "SELECT iletisim_formu.*, 
                                   CASE WHEN mc.id IS NOT NULL THEN 'Cevaplandı' ELSE 'Bekliyor' END as durum,
                                   COUNT(mc.id) as cevap_sayisi
                            FROM iletisim_formu 
                            LEFT JOIN mesaj_cevaplari mc ON iletisim_formu.id = mc.iletisim_formu_id 
                            GROUP BY iletisim_formu.id 
                            ORDER BY iletisim_formu.id DESC
                            LIMIT $baslangic, $sayfa_basina";
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
                            echo "<td>" . date('d.m.Y H:i', strtotime($mesaj['created_at'])) . "</td>";
                            echo "<td class='durum-" . $durum_class . "'>";
                            echo "<span class='durum-badge " . $durum_class . "'>" . $mesaj['durum'] . "</span>";
                            if ($mesaj['cevap_sayisi'] > 0) {
                                echo " <span class='cevap-sayisi'>(" . $mesaj['cevap_sayisi'] . ")</span>";
                            }
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7' style='text-align: center; color: #666;'>Henüz hiç mesaj yok</td></tr>";
                    }
                    
                    $baglanti->close();
                }
                ?>
              </tbody>
            </table>
          </div>
          
          <!-- Sayfalama -->
          <?php if (isset($toplam_sayfa) && $toplam_sayfa > 1): ?>
          <div class="pagination">
            <?php if ($sayfa > 1): ?>
              <button onclick="window.location.href='?sayfa=<?php echo $sayfa - 1; ?>'">
                ← Önceki
              </button>
            <?php endif; ?>
            
            <span class="page-info">
              Sayfa <?php echo $sayfa; ?> / <?php echo $toplam_sayfa; ?>
              (Toplam <?php echo $toplam_mesaj; ?> mesaj)
            </span>
            
            <?php if ($sayfa < $toplam_sayfa): ?>
              <button onclick="window.location.href='?sayfa=<?php echo $sayfa + 1; ?>'">
                Sonraki →
              </button>
            <?php endif; ?>
          </div>
          <?php endif; ?>
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
