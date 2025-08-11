<!DOCTYPE html>
<html>
<head>
    <title>API Test</title>
    <meta charset="UTF-8">
</head>
<body>
    <h1>📚 Kitaplar API Test</h1>
    
    <h2>🔍 Kategorileri Test Et:</h2>
    <ul>
        <li><a href="kitaplar_yazilar_api.php?kategori=Kişisel Gelişim" target="_blank">Kişisel Gelişim</a></li>
        <li><a href="kitaplar_yazilar_api.php?kategori=Kültür & Toplum" target="_blank">Kültür & Toplum</a></li>
        <li><a href="kitaplar_yazilar_api.php?kategori=Teknoloji" target="_blank">Teknoloji</a></li>
        <li><a href="kitaplar_yazilar_api.php?kategori=Sanat" target="_blank">Sanat</a></li>
        <li><a href="kitaplar_yazilar_api.php?kategori=Eğitim" target="_blank">Eğitim</a></li>
        <li><a href="kitaplar_yazilar_api.php?kategori=Yaşam Tarzı" target="_blank">Yaşam Tarzı</a></li>
        <li><a href="kitaplar_yazilar_api.php?kategori=Klasik Edebiyat" target="_blank">Klasik Edebiyat</a></li>
        <li><a href="kitaplar_yazilar_api.php?kategori=Türk Edebiyatı" target="_blank">Türk Edebiyatı</a></li>
    </ul>
    
    <h2>📊 Veritabanı Kontrolü:</h2>
    <a href="kategori_kontrol.php" target="_blank">Kategorileri Kontrol Et</a>
    
    <h2>🎯 Test Sonuçları:</h2>
    <div id="results"></div>
    
    <script>
        // API'leri test et
        const kategoriler = [
            'Kişisel Gelişim',
            'Kültür & Toplum',
            'Teknoloji', 
            'Sanat',
            'Eğitim',
            'Yaşam Tarzı',
            'Klasik Edebiyat',
            'Türk Edebiyatı'
        ];
        
        async function testAPI(kategori) {
            try {
                const response = await fetch(`kitaplar_yazilar_api.php?kategori=${encodeURIComponent(kategori)}`);
                const data = await response.json();
                return {
                    kategori: kategori,
                    success: data.success,
                    count: data.kitaplar ? data.kitaplar.length : 0,
                    error: data.error
                };
            } catch (error) {
                return {
                    kategori: kategori,
                    success: false,
                    count: 0,
                    error: error.message
                };
            }
        }
        
        async function testAllAPIs() {
            const results = [];
            for (const kategori of kategoriler) {
                const result = await testAPI(kategori);
                results.push(result);
            }
            
            const resultsDiv = document.getElementById('results');
            let html = '<table border="1" style="border-collapse: collapse; width: 100%;">';
            html += '<tr><th>Kategori</th><th>Durum</th><th>Kitap Sayısı</th><th>Hata</th></tr>';
            
            results.forEach(result => {
                const status = result.success ? '✅ Başarılı' : '❌ Hata';
                const error = result.error || '-';
                html += `<tr>
                    <td>${result.kategori}</td>
                    <td>${status}</td>
                    <td>${result.count}</td>
                    <td>${error}</td>
                </tr>`;
            });
            
            html += '</table>';
            resultsDiv.innerHTML = html;
        }
        
        // Sayfa yüklendiğinde test et
        window.onload = testAllAPIs;
    </script>
</body>
</html>
