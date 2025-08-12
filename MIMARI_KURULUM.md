# 🏗️ Mimari Modülü - Kurulum ve Test Rehberi

## 📋 Durum Özeti

✅ **Veritabanı**: `mimari` tablosu oluşturuldu ve 9 adet eser eklendi  
✅ **API**: `api.php?mimari=1` endpoint'i hazır  
✅ **Frontend**: `mimari.html` sayfası veritabanından veri çekiyor  
✅ **Controller**: `MimariController` app.js'de tanımlı  
✅ **Detay Sayfası**: `mimari-detay.html` hazır

## 🚀 Test Adımları

### 1. Veritabanı Kontrolü

```
http://localhost/test2/test_mimari_api.php
```

- Veritabanı bağlantısını kontrol eder
- Tablo yapısını gösterir
- Verileri listeler

### 2. API Test

```
http://localhost/test2/api.php?mimari=1
```

- JSON formatında tüm mimari eserleri döner
- Tarayıcıda açarak kontrol edin

### 3. Debug Sayfası

```
http://localhost/test2/debug_mimari.html
```

- Controller durumunu gösterir
- API bağlantısını test eder
- Ham veriyi JSON olarak gösterir

### 4. Ana Sayfa Test

```
http://localhost/test2/mimari.html
```

- Veritabanından veri çeker
- Loading göstergesi var
- Hata durumunda tekrar deneme butonu

### 5. Detay Sayfası Test

```
http://localhost/test2/mimari-detay.html?id=1
```

- Belirli eserin detaylarını gösterir
- URL parametresi ile çalışır

## 🔧 Sorun Giderme

### Veri Yüklenmiyor

1. **XAMPP/WAMP çalışıyor mu?**
2. **Veritabanı bağlantısı doğru mu?**
3. **API endpoint çalışıyor mu?**
4. **Console'da hata var mı? (F12)**

### API Hatası

1. `test_mimari_api.php` sayfasını açın
2. Veritabanı bağlantısını kontrol edin
3. Tablo adının `mimari` olduğundan emin olun

### Frontend Hatası

1. `debug_mimari.html` sayfasını açın
2. Controller durumunu kontrol edin
3. Network sekmesinde API çağrısını inceleyin

## 📊 Veritabanı Yapısı

```sql
CREATE TABLE mimari (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ad VARCHAR(255) NOT NULL,
    mimar VARCHAR(255) NOT NULL,
    tarih VARCHAR(100) NOT NULL,
    yer VARCHAR(255) NOT NULL,
    stil VARCHAR(100) NOT NULL,
    aciklama TEXT NOT NULL,
    resim VARCHAR(500) NOT NULL,
    kapak_url VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

## 🎯 API Endpoint'leri

- `GET api.php?mimari=1` - Tüm eserler
- `GET api.php?mimari=1&id=X` - Belirli eser
- `GET api.php?mimari=1&limit=X` - Limit ile eserler

## 📁 Dosya Listesi

```
test2/
├── mimari.html              # Ana sayfa
├── mimari-detay.html        # Detay sayfası
├── debug_mimari.html        # Debug sayfası
├── test_mimari_api.php      # API test
├── api.php                  # API endpoint'leri
├── assets/js/app.js         # Controller'lar
└── MIMARI_KURULUM.md        # Bu dosya
```

## 🎉 Başarı Kriterleri

- [ ] Veritabanında 9 adet eser var
- [ ] API endpoint JSON döndürüyor
- [ ] Ana sayfa verileri gösteriyor
- [ ] Loading göstergesi çalışıyor
- [ ] Detay sayfası açılıyor
- [ ] Responsive tasarım çalışıyor

## 🔄 Güncelleme

Veritabanına yeni eser eklemek için:

1. phpMyAdmin'de `mimari` tablosunu açın
2. "Ekle" sekmesine tıklayın
3. Gerekli alanları doldurun
4. Kaydedin

---

**Son Güncelleme**: Veritabanı entegrasyonu tamamlandı ✅
