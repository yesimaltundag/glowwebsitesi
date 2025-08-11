-- SANAT ESERLERİ TABLOSU İÇİN SQL INSERT KODLARI
-- Bu dosyayı phpMyAdmin'de çalıştırarak sanat eserlerini veritabanına ekleyebilirsin

-- Önce tablo yapısını oluştur (eğer yoksa)
CREATE TABLE IF NOT EXISTS sanat_eserleri (
    id INT AUTO_INCREMENT PRIMARY KEY,
    baslik VARCHAR(255) NOT NULL,
    sanatci VARCHAR(255) NOT NULL,
    tarih VARCHAR(100) NOT NULL,
    resim_url TEXT NOT NULL,
    tarihce TEXT NOT NULL,
    kategori VARCHAR(50) DEFAULT 'resim',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sanat eserlerini ekle
INSERT INTO sanat_eserleri (id, baslik, sanatci, tarih, resim_url, tarihce, kategori) VALUES
(1, 'Mona Lisa', 'Leonardo da Vinci', '1503', 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/ec/Mona_Lisa%2C_by_Leonardo_da_Vinci%2C_from_C2RMF_retouched.jpg/687px-Mona_Lisa%2C_by_Leonardo_da_Vinci%2C_from_C2RMF_retouched.jpg', 'Mona Lisa, Leonardo da Vinci''nin en ünlü eseridir. İtalyan Rönesans döneminde yapılan bu portre, dünya sanat tarihinin en değerli ve en çok tanınan eserlerinden biridir. Eserin gizemli gülümsemesi ve sfumato tekniği ile yapılan yumuşak geçişler, sanat tarihinde devrim yaratmıştır. Şu anda Paris''teki Louvre Müzesi''nde sergilenmektedir.', 'resim'),

(2, 'Yıldızlı Gece', 'Vincent van Gogh', '1889', 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/ea/Van_Gogh_-_Starry_Night_-_Google_Art_Project.jpg/1280px-Van_Gogh_-_Starry_Night_-_Google_Art_Project.jpg', 'Yıldızlı Gece, Van Gogh''un en ünlü eserlerinden biridir. Sanatçının Saint-Rémy-de-Provence''daki akıl hastanesinde kaldığı dönemde yapılmıştır. Eser, gecenin dinamik ve hareketli bir yorumunu sunar. Dönen bulutlar ve parlayan yıldızlar, sanatçının iç dünyasının yoğun duygusal durumunu yansıtır. Modern sanatın en etkili eserlerinden biri olarak kabul edilir.', 'resim'),

(3, 'Guernica', 'Pablo Picasso', '1937', 'https://upload.wikimedia.org/wikipedia/en/7/74/PicassoGuernica.jpg', 'Guernica, Picasso''nun İspanya İç Savaşı sırasında Nazi Almanyası''nın Guernica şehrini bombalaması üzerine yaptığı güçlü bir anti-savaş eseridir. Siyah, beyaz ve gri tonlarında yapılan eser, savaşın dehşetini ve acısını dramatik bir şekilde yansıtır. Modern sanatın en önemli politik eserlerinden biri olarak kabul edilir ve barışın sembolü haline gelmiştir.', 'resim'),

(4, 'Çığlık', 'Edvard Munch', '1893', 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c5/Edvard_Munch%2C_1893%2C_The_Scream%2C_oil%2C_tempera_and_pastel_on_cardboard%2C_91_x_73_cm%2C_National_Gallery_of_Norway.jpg/1280px-Edvard_Munch%2C_1893%2C_The_Scream%2C_oil%2C_tempera_and_pastel_on_cardboard%2C_91_x_73_cm%2C_National_Gallery_of_Norway.jpg', 'Çığlık, Edvard Munch''un en ünlü eseridir ve ekspresyonist sanatın simgesi haline gelmiştir. Eser, modern insanın varoluşsal kaygısını ve yalnızlığını güçlü bir şekilde ifade eder. Dalgalı çizgiler ve yoğun renkler kullanılarak yapılan eser, sanatçının iç dünyasındaki huzursuzluğu ve toplumsal değişimlerin yarattığı stresi yansıtır.', 'resim'),

(5, 'Son Akşam Yemeği', 'Leonardo da Vinci', '1495', 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4b/%C3%9Altima_Cena_-_Da_Vinci_5.jpg/1280px-%C3%9Altima_Cena_-_Da_Vinci_5.jpg', 'Son Akşam Yemeği, Leonardo da Vinci''nin Milano''daki Santa Maria delle Grazie manastırının yemek salonunda yaptığı fresk eseridir. İsa''nın havarileriyle son akşam yemeğini yediği anı tasvir eder. Perspektif kullanımı ve karakterlerin duygusal ifadeleri ile Rönesans sanatının en önemli eserlerinden biri olarak kabul edilir.', 'resim'),

(6, 'Venüs''ün Doğuşu', 'Sandro Botticelli', '1485', 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Sandro_Botticelli_-_La_nascita_di_Venere_-_Google_Art_Project.jpg/1280px-Sandro_Botticelli_-_La_nascita_di_Venere_-_Google_Art_Project.jpg', 'Venüs''ün Doğuşu, Botticelli''nin en ünlü eserlerinden biridir. Antik Yunan mitolojisinden esinlenen eser, güzellik tanrıçası Venüs''ün deniz köpüğünden doğuşunu tasvir eder. Rönesans döneminin en güzel eserlerinden biri olarak kabul edilir ve klasik mitolojinin yeniden canlandırılmasının simgesi haline gelmiştir.', 'resim');

-- Kullanım:
-- 1. Bu dosyayı phpMyAdmin'e kopyala
-- 2. SQL sekmesine yapıştır
-- 3. Çalıştır butonuna tıkla
-- 4. 6 sanat eseri veritabanına eklenecek
