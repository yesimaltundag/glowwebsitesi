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
# database_setup.sql dosyasını seçin ve "Go" butonuna tıklayın

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
