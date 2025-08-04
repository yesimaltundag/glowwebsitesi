# 🚀 GLOW Projesi - Hızlı Referans

## 📋 **Proje Özeti**
Modern component tabanlı web uygulaması. Header/footer her sayfada sabit, responsive tasarım, AngularJS + PHP + MySQL.

## 🎯 **Ana Sorun & Çözüm**
**Sorun**: Header/footer sadece index.html'de görünüyordu
**Çözüm**: Component tabanlı yapıya geçiş, her sayfada sabit header/footer

## 📁 **Kritik Dosyalar**
- `api.php` - Backend API (kullanıcı yönetimi)
- `components/header.html` - Sabit header component
- `components/footer.html` - Sabit footer component  
- `assets/css/style.css` - Temiz, modüler CSS
- `assets/js/app.js` - Tüm AngularJS controller'lar

## 🔧 **Teknoloji Stack**
- **Frontend**: AngularJS 1.8.2
- **Backend**: PHP 7.4+
- **Database**: MySQL
- **CSS**: Modern CSS3 (Glassmorphism)
- **JS**: ES6+ Syntax

## 🎨 **Tasarım Özellikleri**
- ✅ Sabit header/footer her sayfada
- ✅ Responsive tasarım (mobile-first)
- ✅ Modern glassmorphism efektleri
- ✅ Gradient animasyonları
- ✅ Smooth hover efektleri

## 📱 **Sayfalar**
- `index.html` - Giriş sayfası
- `anasayfa.html` - Ana sayfa
- `kayit.html` - Kayıt sayfası
- `hakkimizda.html` - Hakkımızda
- `iletisim.html` - İletişim
- `profil.html` - Profil sayfası
- `liste.html` - Admin paneli

## 🔄 **API Endpoints**
- `GET api.php` - Kullanıcı listesi
- `POST api.php` - Yeni kullanıcı
- `POST api.php?login=1` - Giriş
- `PUT api.php` - Güncelleme
- `DELETE api.php?id=X` - Silme

## 🚀 **Kurulum**
```bash
# 1. XAMPP/WAMP başlat
# 2. Projeyi htdocs klasörüne kopyala
# 3. MySQL veritabanını oluştur
# 4. api.php'deki veritabanı ayarlarını kontrol et
# 5. index.html'i aç
```

## 📊 **Veritabanı**
```sql
CREATE TABLE kullanicilar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    adsoyad VARCHAR(100) NOT NULL,
    sifre VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'kullanici') DEFAULT 'kullanici',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

## 🎯 **Geliştirme Kuralları**
1. Component yapısını koru
2. CSS modülerliğini sürdür
3. JavaScript temizliğini koru
4. Responsive tasarımı koru
5. Modern UI/UX'i sürdür

## ⚠️ **Önemli Notlar**
- Header/footer her sayfada sabit olmalı
- Gereksiz CSS kodları kaldırıldı
- Tüm controller'lar app.js'de
- Mobile-first responsive tasarım
- Glassmorphism modern efektler

## 🔧 **Cursor AI Kuralları**
- Türkçe iletişim
- Emoji kullanımı (✅❌)
- Terminal komutları string olarak ver
- Proje odaklı yaklaşım

---
**Versiyon**: 2.0 (Modern Component Yapısı)
**Durum**: ✅ Tamamlandı 