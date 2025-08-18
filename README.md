# GLOW - Modern Web Uygulaması

## 🚀 **Kurulum Talimatları**

### **1. Veritabanı Kurulumu**

```bash
# XAMPP/WAMP başlatın
# phpMyAdmin'e gidin (http://localhost/phpmyadmin)

# 1. Yeni veritabanı oluşturun
# Veritabanı adı: basit_sistem
# Karakter seti: utf8mb4_unicode_ci

# 2. SQL dosyasını import edin
# basit_sistem.sql dosyasını seçin ve "Go" butonuna tıklayın

# 3. Tabloların oluştuğunu kontrol edin:
# - filmler
# - kisiler
# - yorumlar
# - yorum_reaksiyonlar
```

### **2. Proje Kurulumu**

```bash
# 1. Projeyi htdocs klasörüne kopyalayın
# 2. Tarayıcıda açın: http://localhost/test2/
# 3. İlk kullanıcıyı oluşturun (admin)
```

### **3. Yorum Sistemi Testi**

```bash
# 1. Giriş yapın (test kullanıcısı: test/123456)
# 2. Herhangi bir film detay sayfasına gidin
# 3. Yorum yazın ve gönderin
# 4. Yorumların görüntülendiğini kontrol edin
```

### **4. Sorun Giderme**

```bash
# Eğer yorum sistemi çalışmıyorsa:
# 1. Veritabanı tablolarını kontrol edin
# 2. api.php error loglarını kontrol edin
# 3. Tarayıcı console'unda hataları kontrol edin
```

## 📁 **Proje Yapısı**

```
test2/
├── api.php                 # Backend API
├── index.html             # Ana sayfa
├── film-detay.html        # Film detay sayfası
├── components/            # Component klasörü
│   ├── header.html       # Header component
│   └── footer.html       # Footer component
├── assets/
│   ├── css/style.css     # Ana CSS
│   └── js/app.js         # AngularJS controller'lar
└── database_setup.sql    # Veritabanı kurulum dosyası
```

## 🎯 **Özellikler**

- ✅ Modern Glassmorphism Tasarım
- ✅ Responsive Layout
- ✅ Film Detay Sayfaları
- ✅ Yorum Sistemi
- ✅ Kullanıcı Girişi
- ✅ Like/Dislike Sistemi
- ✅ **🌍 Çok Dilli Saat Dilimi Desteği**
- ✅ **📧 Akıllı E-posta Sistemi**

## 🔧 **Teknolojiler**

- **Frontend**: HTML5, CSS3, AngularJS 1.8.2
- **Backend**: PHP 7.4+
- **Database**: MySQL
- **Design**: Glassmorphism, Gradient Effects

## 📱 **Responsive Breakpoints**

- **Mobile**: < 768px
- **Tablet**: 768px - 1024px
- **Desktop**: > 1024px

## 🎨 **Tasarım Prensipleri**

- Glassmorphism efektleri
- Modern gradient renkler
- Smooth animations
- Clean typography
- Mobile-first yaklaşım

## 🔒 **Güvenlik**

- Password hashing (PHP PASSWORD_DEFAULT)
- Input validation
- E-posta doğrulama sistemi

## 🌍 **Saat Dilimi Sistemi**

### **Özellikler**

- **Otomatik Ülke Tespiti**: E-posta adresinden ülke kodu otomatik belirlenir
- **17 Ülke Desteği**: Türkiye, ABD, İngiltere, Almanya, Fransa, İtalya, İspanya, Hollanda, Kanada, Avustralya, Japonya, Güney Kore, Çin, Hindistan, Brezilya, Meksika, Rusya
- **Akıllı Domain Analizi**: Yaygın e-posta sağlayıcıları için ülke tespiti
- **Türkçe Açıklamalar**: Her saat dilimi için Türkçe açıklama

### **Desteklenen E-posta Sağlayıcıları**

- **Türkiye**: gmail.com, hotmail.com, outlook.com, yahoo.com, yandex.com
- **İngiltere**: yahoo.co.uk, hotmail.co.uk, outlook.co.uk
- **Almanya**: web.de, gmx.de, t-online.de
- **Fransa**: orange.fr, laposte.net, free.fr
- **İtalya**: libero.it, virgilio.it, tiscali.it
- **İspanya**: hotmail.es, yahoo.es, outlook.es
- **Hollanda**: hotmail.nl, outlook.nl, yahoo.nl
- **Kanada**: hotmail.ca, outlook.ca, yahoo.ca
- **Avustralya**: hotmail.com.au, outlook.com.au, yahoo.com.au
- **Japonya**: yahoo.co.jp, hotmail.co.jp
- **Güney Kore**: naver.com, daum.net
- **Çin**: qq.com, 163.com, 126.com
- **Hindistan**: yahoo.in, hotmail.in
- **Brezilya**: hotmail.com.br, outlook.com.br
- **Meksika**: hotmail.com.mx, outlook.com.mx
- **Rusya**: yandex.ru, mail.ru, rambler.ru

### **Kullanım**

```php
// E-posta adresinden ülke kodunu al
$countryCode = getCountryFromEmail($email);

// Ülke kodunu saat dilimine çevir
$timezone = getTimezoneByCountry($countryCode);

// Saat diliminde tarihi formatla
$formattedDate = getFormattedDate($timezone);

// Türkçe açıklamayı al
$description = getTimezoneDescription($timezone);
```

### **Test Etme**

```bash
# Test dosyasını çalıştırın
http://app.test2.local/test_timezone.php
```

- SQL injection koruması
- XSS koruması

## 🚀 **Performans**

- Optimized CSS
- Minified JavaScript
- Efficient API calls
- Fast loading times

---

**Proje**: GLOW - Modern Web Uygulaması  
**Versiyon**: 2.0 (Yorum Sistemi ile)  
**Durum**: ✅ Tamamlandı
