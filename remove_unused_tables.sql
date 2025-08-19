-- Kullanılmayan tabloları kaldır
-- Bu komutları phpMyAdmin'de veya MySQL komut satırında çalıştırın

-- Film etiketleri tablosunu kaldır
DROP TABLE IF EXISTS `film_etiketleri`;

-- Film izleme geçmişi tablosunu kaldır  
DROP TABLE IF EXISTS `film_izleme_gecmisi`;

-- Kaldırılan tablolar:
-- ✅ film_etiketleri - Kullanılmıyordu, kaldırıldı
-- ✅ film_izleme_gecmisi - Kullanılmıyordu, kaldırıldı

-- Kalan aktif tablolar:
-- ✅ film_takip - Aktif olarak kullanılıyor
-- ✅ film_listeleri - Mevcut (kullanım durumu kontrol edilmeli)
-- ✅ filmler - Ana film tablosu
-- ✅ kullanicilar - Kullanıcı tablosu
-- ✅ diğer tablolar...
