-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 22 Ağu 2025, 08:09:58
-- Sunucu sürümü: 9.1.0
-- PHP Sürümü: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `basit_sistem`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `animeler`
--

DROP TABLE IF EXISTS `animeler`;
CREATE TABLE IF NOT EXISTS `animeler` (
  `id` int NOT NULL AUTO_INCREMENT,
  `anime_adi` varchar(200) NOT NULL,
  `yonetmen` varchar(100) NOT NULL,
  `yil` int NOT NULL,
  `tur` varchar(100) NOT NULL,
  `puan` decimal(3,1) DEFAULT '0.0',
  `aciklama` text,
  `bolum_sayisi` varchar(20) DEFAULT NULL,
  `sure` varchar(20) DEFAULT NULL,
  `stüdyo` varchar(100) DEFAULT NULL,
  `durum` varchar(50) DEFAULT NULL,
  `izlenme_sayisi` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `kapak_url` varchar(255) NOT NULL,
  `onizleme` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `animeler`
--

INSERT INTO `animeler` (`id`, `anime_adi`, `yonetmen`, `yil`, `tur`, `puan`, `aciklama`, `bolum_sayisi`, `sure`, `stüdyo`, `durum`, `izlenme_sayisi`, `created_at`, `kapak_url`, `onizleme`) VALUES
(1, 'Attack on Titan', 'Tetsurō Araki', 2013, 'Aksiyon, Dram, Fantastik', 9.0, 'İnsanlığın dev duvarların arkasında yaşadığı bir dünyada, devler insanları yemeye başlar. Eren Yeager ve arkadaşları, insanlığı kurtarmak için savaşır.', '25 Bölüm', '24 dk', 'Wit Studio', 'Tamamlandı', 15000000, '2025-07-31 06:42:38', 'https://m.media-amazon.com/images/I/71oYp0Y7bxL._UF1000,1000_QL80_.jpg', 'https://www.youtube.com/embed/MGRm4IzK1SQ'),
(2, 'Death Note', 'Tetsurō Araki', 2006, 'Gerilim, Psikolojik, Gizem', 8.9, 'Light Yagami, ölüm defterini bulur ve dünyayı suçlulardan temizlemeye karar verir. Ancak L adlı dedektif onu durdurmaya çalışır.', '37 Bölüm', '23 dk', 'Madhouse', 'Tamamlandı', 12000000, '2025-07-31 06:42:38', 'https://img.kitapyurdu.com/v1/getImage/fn:21859/wh:true/wi:500', 'https://www.youtube.com/embed/NlJZ-YgAt-c'),
(3, 'Fullmetal Alchemist: Brotherhood', 'Yasuhiro Irie', 2009, 'Aksiyon, Macera, Dram', 9.1, 'Edward ve Alphonse Elric kardeşler, annelerini geri getirmek için simya kullanır ama bedel ağır olur. Şimdi bedenlerini geri almak için mücadele ederler.', '64 Bölüm', '24 dk', 'Bones', 'Tamamlandı', 11000000, '2025-07-31 06:42:38', 'https://cdn.kobo.com/book-images/1df4ff0d-3708-435b-ae3a-54b67f006bc0/1200/1200/False/fullmetal-alchemist-vol-1-2.jpg', 'https://www.youtube.com/embed/RNwNA1M8A94'),
(4, 'One Punch Man', 'Shingo Natsume', 2015, 'Aksiyon, Komedi, Süper Güç', 8.7, 'Saitama, tek yumrukla herkesi yenen bir süper kahraman. Ancak gücü nedeniyle sıkılır ve gerçek bir meydan okuma arar.', '12 Bölüm', '24 dk', 'Madhouse', 'Tamamlandı', 10000000, '2025-07-31 06:42:38', 'https://cdn.kobo.com/book-images/795d78ec-0caf-4c2b-9301-b388622ec93d/353/569/90/False/one-punch-man-vol-21.jpg', 'https://www.youtube.com/embed/Poo5lqoWSGw'),
(5, 'Demon Slayer', 'Haruo Sotozaki', 2019, 'Aksiyon, Fantastik, Tarih', 8.9, 'Tanjiro Kamado, ailesini öldüren şeytanları avlamak ve kız kardeşini insana döndürmek için yola çıkar.', '26 Bölüm', '24 dk', 'ufotable', 'Devam Ediyor', 9500000, '2025-07-31 06:42:38', 'https://tr.web.img4.acsta.net/c_310_420/img/e2/9b/e29bebc80ef7e480f5ab8562e9ab42eb.jpg', 'https://www.youtube.com/embed/x7uLutVRBfI'),
(6, 'My Hero Academia', 'Kenji Nagasaki', 2016, 'Aksiyon, Süper Güç, Okul', 8.4, 'Quirk\'sız doğan Izuku Midoriya, en büyük kahraman olma hayaliyle U.A. Lisesi\'ne girer ve One For All gücünü alır.', '25 Bölüm', '24 dk', 'Bones', 'Devam Ediyor', 9000000, '2025-07-31 06:42:38', 'https://www.paribucineverse.com/files/movie_posters/HO00006863_638630534305823242_my-hero-academia-sira-sende.png', 'https://www.youtube.com/embed/22hBq1cvemE'),
(7, 'Naruto', 'Hayato Date', 2002, 'Aksiyon, Macera, Fantastik', 8.3, 'Naruto Uzumaki, köyünün en güçlü ninjası olma hayaliyle yola çıkar. İçindeki dokuz kuyruklu tilki ile birlikte büyük maceralar yaşar.', '220 Bölüm', '23 dk', 'Studio Pierrot', 'Tamamlandı', 8500000, '2025-07-31 06:42:38', 'https://resizing.flixster.com/c2qMEiR98SgnSxxE0XwulbcsfLs=/206x305/v2/https://resizing.flixster.com/-XZAfHZM39UwaGJIFWKAE8fS0ak=/v3/t/assets/p194893_b_v12_aa.jpg', 'https://www.youtube.com/embed/22R0j8UKRzY'),
(8, 'Dragon Ball Z', 'Daisuke Nishio', 1989, 'Aksiyon, Macera, Fantastik', 8.7, 'Goku ve arkadaşları, dünyayı tehdit eden güçlü düşmanlarla savaşır. Süper Saiyan dönüşümleri ve epik savaşlar.', '291 Bölüm', '24 dk', 'Toei Animation', 'Tamamlandı', 8000000, '2025-07-31 06:42:38', 'https://mediaproxy.tvtropes.org/width/1200/https://static.tvtropes.org/pmwiki/pub/images/dbzbig.png', 'https://www.youtube.com/embed/tloraopWVuk'),
(9, 'One Piece', 'Kōnosuke Uda', 1999, 'Aksiyon, Macera, Komedi', 8.8, 'Monkey D. Luffy, Korsanlar Kralı olma hayaliyle yola çıkar. Gomu Gomu meyvesi yemiş ve lastik adam olmuştur.', '1000+ Bölüm', '24 dk', 'Toei Animation', 'Devam Ediyor', 7500000, '2025-07-31 06:42:38', 'https://www.gerekliseyler.com.tr/shop/cd/03/myassets/products/242/one-piece-53-kapak.jpg?revision=1723731746', 'https://www.youtube.com/embed/1KMcoJBMWE4'),
(10, 'Hunter x Hunter', 'Hiroshi Kōjina', 2011, 'Aksiyon, Macera, Fantastik', 9.0, 'Gon Freecss, babası gibi Hunter olmak için sınavlara girer. Arkadaşlarıyla birlikte tehlikeli maceralar yaşar.', '148 Bölüm', '24 dk', 'Madhouse', 'Tamamlandı', 7000000, '2025-07-31 06:42:38', 'https://m.media-amazon.com/images/I/71aoeOhdNnL._AC_SL1000_.jpg', 'https://www.youtube.com/embed/d6kBeJjTGnY'),
(11, 'Tokyo Ghoul', 'Shuhei Morita', 2014, 'Aksiyon, Dram, Korku', 7.8, 'Kaneki Ken, bir ghoul tarafından saldırıya uğrar ve yarı ghoul olur. İnsan ve ghoul dünyası arasında sıkışır.', '12 Bölüm', '24 dk', 'Studio Pierrot', 'Tamamlandı', 6500000, '2025-07-31 06:42:38', 'https://images.justwatch.com/poster/102012613/s718/tokyo-ghoul.jpg', 'https://www.youtube.com/embed/vGuQeQsoRgU'),
(12, 'Steins Gate', 'Hiroshi Hamasaki', 2011, 'Bilim Kurgu, Gerilim, Dram', 8.8, 'Rintaro Okabe, zaman makinesi icat eder ve geçmişi değiştirmeye çalışır. Ancak her değişiklik beklenmedik sonuçlar doğurur.', '24 Bölüm', '24 dk', 'White Fox', 'Tamamlandı', 6000000, '2025-07-31 06:42:38', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT87i1y_-CTEA4IM6wh38c7DqvSZn3IW6UXsg&s', 'https://www.youtube.com/embed/uMYhjVwp0Fk');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `basari_rozetleri`
--

DROP TABLE IF EXISTS `basari_rozetleri`;
CREATE TABLE IF NOT EXISTS `basari_rozetleri` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'Benzersiz rozet kimliği',
  `kullanici_id` int NOT NULL COMMENT 'Kullanıcı kimliği',
  `rozet_adi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Rozet adı',
  `rozet_aciklama` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Rozet açıklaması',
  `rozet_ikonu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Rozet ikonu URL',
  `kazanma_tarihi` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Rozet kazanma tarihi',
  `rozet_tipi` enum('izleme','puanlama','liste','ozel') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'izleme' COMMENT 'Rozet tipi',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_user_badge` (`kullanici_id`,`rozet_adi`),
  KEY `idx_kullanici_id` (`kullanici_id`),
  KEY `idx_rozet_tipi` (`rozet_tipi`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Başarı rozetleri tablosu';

--
-- Tablo döküm verisi `basari_rozetleri`
--

INSERT INTO `basari_rozetleri` (`id`, `kullanici_id`, `rozet_adi`, `rozet_aciklama`, `rozet_ikonu`, `kazanma_tarihi`, `rozet_tipi`) VALUES
(1, 104, 'İlk Film', 'İlk filmini izledin!', '🎬', '2025-08-18 10:54:38', 'izleme'),
(2, 104, 'Film Sever', '10 film izledin!', '🎭', '2025-08-18 10:54:38', 'izleme'),
(3, 104, 'Kritik Göz', '5 film puanladın!', '⭐', '2025-08-18 10:54:38', 'puanlama'),
(4, 104, 'Liste Yaratıcısı', 'İlk listeni oluşturdun!', '📝', '2025-08-18 10:54:38', 'liste');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `belgeseller`
--

DROP TABLE IF EXISTS `belgeseller`;
CREATE TABLE IF NOT EXISTS `belgeseller` (
  `id` int NOT NULL AUTO_INCREMENT,
  `belgesel_adi` varchar(255) NOT NULL,
  `yonetmen` varchar(255) NOT NULL,
  `tur` varchar(100) DEFAULT NULL,
  `puan` decimal(3,1) DEFAULT '0.0',
  `kapak_url` varchar(500) DEFAULT NULL,
  `aciklama` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `belgeseller`
--

INSERT INTO `belgeseller` (`id`, `belgesel_adi`, `yonetmen`, `tur`, `puan`, `kapak_url`, `aciklama`, `created_at`) VALUES
(1, 'Planet Earth', 'Alastair Fothergill', 'Doğa', 9.4, 'https://images.justwatch.com/poster/307029557/s332/season-1', NULL, '2025-08-13 10:14:51'),
(2, 'Cosmos', 'Carl Sagan', 'Bilim', 9.6, 'https://thumbor.evrimagaci.org/fpkmJqoOXWG9iW7DewXsUPD9bv0=/300x0/old%2Fmi_media%2F36eec2fd1526cae7598d863383fad317.jpeg', NULL, '2025-08-13 10:14:51'),
(3, 'Blue Planet II', 'James Honeyborne', 'Doğa', 9.7, 'https://play-lh.googleusercontent.com/oQpKzEGr11Z5m5RWPaZyNCRv6TE9nLtMMk34sv8XdFb0jIgx84X1392wY68aKCZwGk1FKw', 'Okyanusların derinliklerini keşfeden muhteşem bir doğa belgeseli. Deniz yaşamının gizli dünyasını gözler önüne seriyor.', '2025-08-13 10:20:46'),
(4, 'The Last Dance', 'Jason Hehir', 'Spor', 9.1, 'https://upload.wikimedia.org/wikipedia/tr/1/14/The_Last_Dance_2020.jpg', 'Michael Jordan ve Chicago Bulls\'un 1997-98 sezonundaki son şampiyonluk yolculuğunu anlatan efsanevi spor belgeseli.', '2025-08-13 10:20:46'),
(5, 'Our Planet', 'Alastair Fothergill', 'Doğa', 9.3, 'https://m.media-amazon.com/images/I/81GA91C0F7L.jpg', 'Dünyamızın en etkileyici doğal yaşam alanlarını ve hayvanları gösteren çevre bilinci odaklı belgesel serisi.', '2025-08-13 10:20:46'),
(6, 'Making a Murderer', 'Laura Ricciardi', 'Suç', 8.5, 'https://resizing.flixster.com/8x0p2L5pWVqicYoa1yKwjkq6raI=/ems.cHJkLWVtcy1hc3NldHMvdHZzZXJpZXMvUlRUVjE3NzM5NS53ZWJw', 'Steven Avery\'nin gerçek hikayesini anlatan, adalet sistemini sorgulayan çarpıcı suç belgeseli.', '2025-08-13 10:20:46'),
(7, 'The Vietnam War', 'Ken Burns', 'Tarih', 9.0, 'https://m.media-amazon.com/images/M/MV5BYTQ1ZWYzMmQtNWU5OC00YWY0LTkyMWMtMTU0NjYxMjJkMmNjXkEyXkFqcGc@._V1_.jpg', 'Vietnam Savaşı\'nın kapsamlı tarihini, savaşanların gözünden anlatan etkileyici tarih belgeseli.', '2025-08-13 10:20:46'),
(8, 'Planet Earth II', 'David Attenborough', 'Doğa', 9.5, 'https://m.media-amazon.com/images/M/MV5BMzY4NDBkMWYtYzdkYy00YzBjLWJmODctMWM4YjYzZTdjNWE5XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 'Dünyanın en uzak köşelerindeki vahşi yaşamı ultra HD kalitesinde gösteren görsel şölen niteliğinde belgesel.', '2025-08-13 10:20:46');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `danslar`
--

DROP TABLE IF EXISTS `danslar`;
CREATE TABLE IF NOT EXISTS `danslar` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ad` varchar(255) NOT NULL,
  `koreograf` varchar(255) NOT NULL,
  `tarih` varchar(50) NOT NULL,
  `yer` varchar(255) NOT NULL,
  `tur` varchar(100) NOT NULL,
  `aciklama` text NOT NULL,
  `resim` varchar(500) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `danslar`
--

INSERT INTO `danslar` (`id`, `ad`, `koreograf`, `tarih`, `yer`, `tur`, `aciklama`, `resim`, `created_at`, `updated_at`) VALUES
(1, 'Kuğu Gölü', 'Marius Petipa & Lev Ivanov', '1895', 'St. Petersburg, Rusya', 'Klasik Bale', 'Tchaikovsky\'nin müziğiyle Petipa ve Ivanov\'un koreografisini birleştiren bu bale, klasik balenin en önemli eserlerinden biridir. Odette ve Odile karakterlerinin ikili rolü, balerinlerin teknik becerilerini sergiler.', 'https://dunyadans.com/wp-content/uploads/2020/11/WhatsApp-Image-2020-11-04-at-16.12.20.jpeg', '2025-08-12 13:07:06', '2025-08-12 13:24:17'),
(2, 'Giselle', 'Jean Coralli & Jules Perrot', '1841', 'Paris, Fransa', 'Romantik Bale', 'Romantik balenin başyapıtı olan Giselle, aşk, ihanet ve ölüm temalarını işler. İkinci perdedeki Wilis\'lerin dansı, beyaz tütü ve pointe tekniğiyle romantik balenin özelliklerini yansıtır.', 'https://res.cloudinary.com/opera-national-de-paris/image/upload/c_crop%2Ch_1407%2Cw_2500%2Cx_0%2Cy_242/h_547%2Cw_1024/f_auto/v1/user_photos/fdd2q5ifruacu0rcfdp3?_a=E', '2025-08-12 13:07:06', '2025-08-12 13:24:57'),
(3, 'Uyuyan Güzel', 'Marius Petipa', '1890', 'St. Petersburg, Rusya', 'Klasik Bale', 'Tchaikovsky\'nin müziğiyle Petipa\'nın koreografisini birleştiren bu bale, peri masalının bale sahnesine uyarlanmış halidir. Grand pas de two ve solo varyasyonları klasik balenin teknik zirvesini temsil eder.', 'https://www.soylentidergi.com/wp-content/uploads/2024/01/IMG_4364-jpeg.webp', '2025-08-12 13:07:06', '2025-08-12 13:25:53'),
(4, 'Fındıkkıran', 'Marius Petipa & Lev Ivanov', '1892', 'St. Petersburg, Rusya', 'Klasik Bale', 'Tchaikovsky\'nin en sevilen bale müziğiyle Petipa ve Ivanov\'un koreografisini birleştiren bu eser, Noel atmosferini bale sahnesine taşır. Şeker Perisi\'nin pas de two\'su klasik balenin en güzel örneklerindendir.', 'https://www.bolerodans.net/wp-content/uploads/findikkiran-balesinden-bir-kesit-1024x576.jpg', '2025-08-12 13:07:06', '2025-08-12 13:26:45'),
(5, 'Romeo ve Juliet', 'Kenneth MacMillan', '1965', 'Londra, İngiltere', 'Neo-Klasik Bale', 'Prokofiev\'in müziğiyle MacMillan\'ın koreografisini birleştiren bu bale, Shakespeare\'in trajik aşk hikayesini dans diliyle anlatır. Dramatik koreografi ve duygusal yoğunlukla öne çıkar.', 'https://www.aa.com.tr/uploads/userFiles/ff7c844b-c626-46a5-aafd-41e9da639227/2025%2F12%2F20250313_2_68121023_110621689.jpg', '2025-08-12 13:07:06', '2025-08-12 13:27:46'),
(6, 'Don Quixote', 'Marius Petipa', '1869', 'Moskova, Rusya', 'Klasik Bale', 'Cervantes\'in romanından esinlenen bu bale, İspanya\'nın renkli atmosferini bale sahnesine taşır. Kitri\'nin solo varyasyonları ve Grand pas de two\'su teknik zorluklarıyla ünlüdür.', 'https://upload.wikimedia.org/wikipedia/commons/0/0b/Don_Quijote_Compa%C3%B1%C3%ADa_Nacional_de_Danza.jpg', '2025-08-12 13:07:06', '2025-08-12 13:28:09'),
(7, 'La Bayadère', 'Marius Petipa', '1877', 'St. Petersburg, Rusya', 'Klasik Bale', 'Hindistan\'da geçen bu bale, egzotik atmosferi ve teknik zorluklarıyla öne çıkar. \'Gölgeler Sahnesi\' klasik balenin en etkileyici toplu dans sahnelerinden biridir.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR8D3heAWF0jW_Fb5w6LTD0aKTZdV9-U2GrPg&s', '2025-08-12 13:07:06', '2025-08-12 13:28:35'),
(8, 'Coppélia', 'Arthur Saint-Léon', '1870', 'Paris, Fransa', 'Klasik Bale', 'Léo Delibes\'in müziğiyle Saint-Léon\'un koreografisini birleştiren bu bale, komik bir hikaye anlatır. Franz ve Swanilda\'nın dansları klasik balenin neşeli yönünü yansıtır.', 'https://www.ballet.org.uk/wp-content/uploads/2021/06/Shiori-Kase-in-English-National-Ballets-Coppelia-C-David-Jensen-5.jpg', '2025-08-12 13:07:06', '2025-08-12 13:28:51'),
(9, 'La Sylphide', 'August Bournonville', '1836', 'Kopenhag, Danimarka', 'Romantik Bale', 'Romantik balenin ilk örneklerinden biri olan La Sylphide, doğaüstü varlıklarla insan aşkını konu alır. Bournonville tekniği ve zarif koreografisiyle Danimarka balesinin temelini oluşturur.', 'https://ondemand.ballet.org.uk/wp-content/uploads/2020/10/Jurgita-Dronina-and-Isaac-Hernandez-in-La-Sylphide-%C2%A9-Laurent-Liotardo-3-2500x1514-1.jpg', '2025-08-12 13:07:06', '2025-08-12 13:29:06');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `diziler`
--

DROP TABLE IF EXISTS `diziler`;
CREATE TABLE IF NOT EXISTS `diziler` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dizi_adi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `aciklama` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `yonetmen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `oyuncular` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `dil` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ulke` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kategori` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `yil` int DEFAULT NULL,
  `sezon_sayisi` int DEFAULT '1',
  `bolum_sayisi` int DEFAULT '1',
  `imdb_puani` decimal(3,1) DEFAULT NULL,
  `poster_url` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trailer_url` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `durum` enum('devam_ediyor','tamamlandi','iptal_edildi') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'devam_ediyor',
  `yayin_kanali` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `toplam_sezon_sayisi` int DEFAULT '1',
  `toplam_bolum_sayisi` int DEFAULT '1',
  `ortalama_bolum_suresi` int DEFAULT '45',
  `cekim_yeri` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `muzik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `yapimci` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `senaryo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `yayin_tarihi` date DEFAULT NULL,
  `bitis_tarihi` date DEFAULT NULL,
  `oduller` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `etiketler` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_kategori` (`kategori`),
  KEY `idx_yil` (`yil`),
  KEY `idx_durum` (`durum`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `diziler`
--

INSERT INTO `diziler` (`id`, `dizi_adi`, `aciklama`, `yonetmen`, `oyuncular`, `dil`, `ulke`, `kategori`, `yil`, `sezon_sayisi`, `bolum_sayisi`, `imdb_puani`, `poster_url`, `trailer_url`, `durum`, `yayin_kanali`, `toplam_sezon_sayisi`, `toplam_bolum_sayisi`, `ortalama_bolum_suresi`, `cekim_yeri`, `muzik`, `yapimci`, `senaryo`, `yayin_tarihi`, `bitis_tarihi`, `oduller`, `etiketler`, `created_at`, `updated_at`) VALUES
(1, 'Breaking Bad', 'Kimya öğretmeni Walter White\'ın kanser teşhisi sonrası uyuşturucu üretimine başlaması ve suç dünyasına adım atması.', 'Vince Gilligan', 'Bryan Cranston, Aaron Paul, Anna Gunn, RJ Mitte, Dean Norris, Betsy Brandt, Bob Odenkirk', 'İngilizce', 'ABD', 'dram', 2008, 5, 62, 9.5, 'https://thumbor.evrimagaci.org/QESXEkks0JE4VVm7Evgv_9aI-tc=/old%2Fmi_media%2Fa3bb95fb0057fdc5eb4685f6ad39e7ee.jpeg', 'https://www.youtube.com/embed/HhesaQXLuRY', 'tamamlandi', 'AMC', 5, 62, 47, 'Albuquerque, New Mexico, ABD', 'Dave Porter', 'Vince Gilligan, Mark Johnson, Michelle MacLaren', 'Vince Gilligan', '2008-01-20', '2013-09-29', NULL, 'dram, suç, uyuşturucu, aile, dönüşüm', '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(2, 'The Crown', 'İngiltere Kraliçesi II. Elizabeth\'in hayatını ve saltanatını anlatan dizi.', NULL, NULL, NULL, NULL, 'dram', 2016, 6, 60, 8.7, 'https://m.media-amazon.com/images/M/MV5BMGU2MjdjODQtZDk5Ny00NzgwLWI2MTMtYzViNDU5MDNjMGU2XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 'https://www.youtube.com/embed/JWtnJjn6ng0', 'tamamlandi', NULL, 6, 60, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(3, 'Narcos', 'Kolombiyalı uyuşturucu baronu Pablo Escobar\'ın hayatını anlatan dizi.', NULL, NULL, NULL, NULL, 'dram', 2015, 3, 30, 8.8, 'https://m.media-amazon.com/images/I/91jkF8kLQqL.jpg', 'https://www.youtube.com/embed/xl8zdCY-abw', 'tamamlandi', NULL, 3, 30, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(4, 'Ozark', 'Para aklama işine bulaşan bir ailenin hayatta kalma mücadelesini anlatan dizi.', NULL, NULL, NULL, NULL, 'dram', 2017, 4, 44, 8.5, 'https://m.media-amazon.com/images/M/MV5BZDk1ZTdjOWItNTJmYS00MGIzLThmY2ItZWNiOGY5MzJlNTA5XkEyXkFqcGc@._V1_.jpg', 'https://www.youtube.com/embed/5hAXVqrljbs', 'tamamlandi', NULL, 4, 44, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(5, 'The Queen\'s Gambit', 'Satranç dahisi Beth Harmon\'ın hayatını anlatan dizi.', NULL, NULL, NULL, NULL, 'dram', 2020, 1, 7, 8.6, 'https://m.media-amazon.com/images/M/MV5BMmRlNjQxNWQtMjk1OS00N2QxLTk0YWQtMzRhYjY5YTFhNjMxXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 'https://www.youtube.com/embed/oZn3qSgmLqI', 'tamamlandi', NULL, 1, 7, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(6, 'Friends', 'Altı arkadaşın New York\'ta yaşadığı eğlenceli ve duygusal maceralar.', 'David Crane, Marta Kauffman', 'Jennifer Aniston, Courteney Cox, Lisa Kudrow, Matt LeBlanc, Matthew Perry, David Schwimmer', 'İngilizce', 'ABD', 'komedi', 1994, 10, 236, 8.9, 'https://diziyleogren.com/img/BFriends.c05b593a.jpg', 'https://www.youtube.com/embed/IEEbUzffzrk', 'tamamlandi', 'NBC', 10, 236, 22, 'Los Angeles, California, ABD', 'Michael Skloff, Allee Willis', 'David Crane, Marta Kauffman, Kevin S. Bright', 'David Crane, Marta Kauffman', '1994-09-22', '2004-05-06', NULL, 'komedi, arkadaşlık, romantik, New York, 90lar', '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(7, 'The Office', 'Bir ofis ortamında geçen mokümanter tarzı komedi dizisi.', NULL, NULL, NULL, NULL, 'komedi', 2005, 9, 201, 8.9, 'https://m.media-amazon.com/images/M/MV5BZjQwYzBlYzUtZjhhOS00ZDQ0LWE0NzAtYTk4MjgzZTNkZWEzXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 'https://www.youtube.com/embed/LHOtME2DL4g', 'tamamlandi', NULL, 9, 201, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(8, 'Brooklyn Nine-Nine', 'Brooklyn\'deki bir polis karakolunda geçen komedi dizisi.', NULL, NULL, NULL, NULL, 'komedi', 2013, 8, 153, 8.4, 'https://m.media-amazon.com/images/M/MV5BNzBiODQxZTUtNjc0MC00Yzc1LThmYTMtN2YwYTU3NjgxMmI4XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 'https://www.youtube.com/embed/sEOuJ4z5aTc', 'tamamlandi', NULL, 8, 153, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(9, 'Parks and Recreation', 'Küçük bir kasabanın park ve rekreasyon departmanında geçen komedi dizisi. Leslie Knope\'un belediye başkanı olma hayali ve arkadaşlarıyla yaşadığı eğlenceli maceralar.', 'Greg Daniels, Michael Schur', 'Amy Poehler, Nick Offerman, Aziz Ansari, Aubrey Plaza, Chris Pratt, Adam Scott, Rob Lowe, Rashida Jones', 'İngilizce', 'ABD', 'komedi', 2009, 7, 125, 8.6, 'https://m.media-amazon.com/images/M/MV5BNDlhMzAwNTAtNTk2NS00MTdkLWE3ZWYtMDU0MTFiYmU2ZTc0XkEyXkFqcGc@._V1_.jpg', 'https://www.youtube.com/embed/5IZWeAwdJ-s', 'tamamlandi', 'NBC', 7, 125, 22, 'Pasadena, California, ABD', 'Gaby Moreno, Vincent Jones', 'Greg Daniels, Michael Schur, Howard Klein', 'Greg Daniels, Michael Schur', '2009-04-09', '2015-02-24', NULL, 'komedi, belediye, arkadaşlık, iyimserlik, hükümet', '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(10, 'The Good Place', 'Ölümden sonraki hayatı anlatan felsefi komedi dizisi.', NULL, NULL, NULL, NULL, 'komedi', 2016, 4, 53, 8.2, 'https://m.media-amazon.com/images/M/MV5BNjI3ZGRhNDYtNDFjOS00OGFlLTg4NTEtYjZjYTViY2ZiMzBkXkEyXkFqcGc@._V1_.jpg', 'https://www.youtube.com/embed/9QxRbzFk3zk', 'tamamlandi', NULL, 4, 53, 20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(11, 'The Boys', 'Süper kahramanların karanlık yüzünü gösteren aksiyon dizisi.', NULL, NULL, NULL, NULL, 'aksiyon', 2019, 4, 32, 8.7, 'https://preview.redd.it/2kzjj8l0om391.jpg?width=640&crop=smart&auto=webp&s=c3b05285bc3be26a383e2c4f4ec30024221a6016', 'https://www.youtube.com/embed/koiPxheoIPQ', 'devam_ediyor', NULL, 4, 32, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(12, 'Daredevil', 'Kör bir avukatın gece süper kahraman olarak mücadele ettiği dizi.', NULL, NULL, NULL, NULL, 'aksiyon', 2015, 3, 39, 8.6, 'https://m.media-amazon.com/images/M/MV5BMDRiNTBlY2EtZmRiZC00Mzc4LTljZDctNWQ5ZGY2NjUwNjE4XkEyXkFqcGc@._V1_.jpg', 'https://www.youtube.com/embed/koiPxheoIPQ', 'iptal_edildi', NULL, 3, 39, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(13, 'Punisher', 'Frank Castle\'ın intikam hikayesini anlatan aksiyon dizisi.', NULL, NULL, NULL, NULL, 'aksiyon', 2017, 2, 26, 8.5, 'https://m.media-amazon.com/images/M/MV5BZTI2NDllMjgtOWEyYi00Y2YxLThhYjQtNTQ0NTgwNDE1YmYzXkEyXkFqcGc@._V1_.jpg', 'https://www.youtube.com/embed/koiPxheoIPQ', 'iptal_edildi', NULL, 2, 26, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(14, 'Arrow', 'Oliver Queen\'in Green Arrow olarak mücadele ettiği dizi.', NULL, NULL, NULL, NULL, 'aksiyon', 2012, 8, 170, 7.5, 'https://m.media-amazon.com/images/I/817wYg0c57L._UF1000,1000_QL80_.jpg', 'https://www.youtube.com/embed/hTvNXTxXXkM', 'tamamlandi', NULL, 8, 170, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(15, 'The Flash', 'Barry Allen\'in Flash olarak süper hızla mücadele ettiği dizi.', NULL, NULL, NULL, NULL, 'aksiyon', 2014, 9, 184, 7.6, 'https://m.media-amazon.com/images/M/MV5BMjU0ZjZhNDQtMDhkYi00OWQyLWE3NGYtNzBlY2VmM2I4ZDg5XkEyXkFqcGc@._V1_.jpg', 'https://www.youtube.com/embed/Yj0l7iGKh8g', 'devam_ediyor', NULL, 9, 184, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(16, 'Stranger Things', '1980\'lerde kaybolan bir çocuğu arayan arkadaşlarının karşılaştığı doğaüstü olayları anlatır.', NULL, NULL, NULL, NULL, 'bilim_kurgu', 2016, 4, 34, 8.7, 'https://m.media-amazon.com/images/M/MV5BMjg2NmM0MTEtYWY2Yy00NmFlLTllNTMtMjVkZjEwMGVlNzdjXkEyXkFqcGc@._V1_.jpg', 'https://www.youtube.com/embed/b9EkMc79ZSU', 'devam_ediyor', NULL, 4, 34, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(17, 'Black Mirror', 'Yedi krallığın tahtı için verilen mücadele ve fantastik dünyada geçen epik hikaye.', 'David Benioff, D.B. Weiss', 'Peter Dinklage, Emilia Clarke, Kit Harington, Lena Headey, Nikolaj Coster-Waldau, Maisie Williams, Sophie Turner', 'İngilizce', 'ABD', 'bilim_kurgu', 2011, 8, 73, 8.8, 'https://resizing.flixster.com/yL-MXHM_ttXdnKBofDnTdOQf_WE=/ems.cHJkLWVtcy1hc3NldHMvdHZzZXJpZXMvZmQ5YTcxMDgtZWI5My00MmQzLWI1OGMtNTI0Zjk1NGYyYTBhLmpwZw==', 'https://www.youtube.com/embed/jDiYGjp5iFg', 'tamamlandi', 'HBO', 8, 73, 60, 'Kuzey İrlanda, Malta, İspanya, Hırvatistan', 'Ramin Djawadi', 'David Benioff, D.B. Weiss, George R.R. Martin', 'David Benioff, D.B. Weiss', '2011-04-17', '2019-05-19', NULL, 'fantastik, dram, savaş, taht mücadelesi, epik', '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(18, 'The Mandalorian', 'Star Wars evreninde geçen, bir ödül avcısının maceralarını anlatan dizi.', NULL, NULL, NULL, NULL, 'bilim_kurgu', 2019, 3, 24, 8.8, 'https://cdn.apollo.ee/o/apollo/e/c/d/e/ecdea1313691f1efe87313609227e0fc8dd2e283_9781419756511.jpg', 'https://www.youtube.com/embed/b9EkMc79ZSU', 'devam_ediyor', NULL, 3, 24, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(19, 'Westworld', 'Yapay zeka ve bilinç konularını işleyen bilim kurgu dizisi.', NULL, NULL, NULL, NULL, 'bilim_kurgu', 2016, 4, 36, 8.6, 'https://m.media-amazon.com/images/I/81Xpd7dGVmL._UF894,1000_QL80_.jpg', 'https://www.youtube.com/embed/0zZcBv0gPKs', 'tamamlandi', NULL, 4, 36, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(20, 'Altered Carbon', 'Beyin yükleme teknolojisi ile ölümsüzlüğü konu alan dizi.', NULL, NULL, NULL, NULL, 'bilim_kurgu', 2018, 2, 18, 8.0, 'https://m.media-amazon.com/images/I/81cBfx1WC+L._UF1000,1000_QL80_.jpg', 'https://www.youtube.com/embed/ehM5s7qXjVk', 'iptal_edildi', NULL, 2, 18, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(21, 'The Walking Dead', '1980\'lerde geçen, doğaüstü güçler ve gizli devlet deneyleriyle dolu bilim kurgu dizisi.', 'The Duffer Brothers', 'Millie Bobby Brown, Finn Wolfhard, Noah Schnapp, Caleb McLaughlin, Gaten Matarazzo, Winona Ryder, David Harbour', 'İngilizce', 'ABD', 'gerilim', 2010, 4, 34, 8.2, 'https://upload.wikimedia.org/wikipedia/en/thumb/4/4f/TWD_Season_11_poster.jpg/250px-TWD_Season_11_poster.jpg', 'https://www.youtube.com/embed/R1v0uFms68U', 'devam_ediyor', 'Netflix', 4, 34, 50, 'Atlanta, Georgia, ABD', 'Kyle Dixon, Michael Stein', 'The Duffer Brothers, Shawn Levy, Dan Cohen', 'The Duffer Brothers', '2016-07-15', NULL, NULL, 'bilim kurgu, 80ler, çocuklar, doğaüstü, retro', '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(22, 'The Haunting of Hill House', 'Bir ailenin hayaletli evde yaşadığı korku dolu deneyimleri anlatan dizi.', NULL, NULL, NULL, NULL, 'gerilim', 2018, 1, 10, 8.6, 'https://m.media-amazon.com/images/M/MV5BMTU4NzA4MDEwNF5BMl5BanBnXkFtZTgwMTQxODYzNjM@._V1_FMjpg_UX1000_.jpg', 'https://www.youtube.com/embed/R1v0uFms68U', 'tamamlandi', NULL, 1, 10, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(23, 'American Horror Story', 'Her sezonu farklı korku hikayesi anlatan antoloji dizisi.', NULL, NULL, NULL, NULL, 'gerilim', 2011, 12, 130, 8.0, 'https://m.media-amazon.com/images/M/MV5BZmU1NWFhODQtZjgyNy00NDg0LTk5MDQtYzc5ZGEzYzZmMGIyXkEyXkFqcGc@._V1_.jpg', 'https://www.youtube.com/embed/R1v0uFms68U', 'devam_ediyor', NULL, 12, 130, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(24, 'The Haunting of Bly Manor', 'İngiltere\'de geçen hayalet hikayesi.', NULL, NULL, NULL, NULL, 'gerilim', 2020, 1, 9, 7.4, 'https://dnm.nflximg.net/api/v6/mAcAr9TxZIVbINe88xb3Teg5_OA/AAAABXGLJzhRg2kvnsYAHuI1cGcTqEJnejJfuXxh-Pu0h-7ma_DOyBsZT37-znb7Hal9W2FAqMoA6YdH9FfLX2UT4BTOv8CSm3U5NQe8t_KxF7A5KcqtVn465GhGOnRhR4_I0TTOHQ.jpg?r=d89', 'https://www.youtube.com/embed/R1v0uFms68U', 'tamamlandi', NULL, 1, 9, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(25, 'Midnight Mass', 'Küçük bir adada geçen dini korku hikayesi.', NULL, NULL, NULL, NULL, 'gerilim', 2021, 1, 7, 7.7, 'https://m.media-amazon.com/images/M/MV5BYWFjMDM5MzgtZWI3OC00ZWRmLThlNTktN2ZkMTc3ZTA5NGEzXkEyXkFqcGc@._V1_.jpg', 'https://www.youtube.com/embed/R1v0uFms68U', 'tamamlandi', NULL, 1, 7, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(26, 'Game of Thrones', 'Yedi krallığın tahtı için verilen mücadeleyi anlatan epik fantastik dizi.', NULL, NULL, NULL, NULL, 'fantastik', 2011, 8, 73, 9.3, 'https://m.media-amazon.com/images/M/MV5BMTNhMDJmNmYtNDQ5OS00ODdlLWE0ZDAtZTgyYTIwNDY3OTU3XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 'https://www.youtube.com/embed/BpJYNVhGf1s', 'tamamlandi', NULL, 8, 73, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(27, 'The Witcher', 'Fantastik dünyada geçen, canavar avcısı Geralt\'ın maceralarını anlatan dizi.', NULL, NULL, NULL, NULL, 'fantastik', 2019, 3, 24, 8.0, 'https://m.media-amazon.com/images/M/MV5BMTQ5MDU5MTktMDZkMy00NDU1LWIxM2UtODg5OGFiNmRhNDBjXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 'https://www.youtube.com/embed/ndl1W4ltcmg', 'devam_ediyor', NULL, 3, 24, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(28, 'Wednesday', 'Addams Ailesi\'nin kızı Wednesday\'in hayatını anlatan fantastik dizi.', NULL, NULL, NULL, NULL, 'fantastik', 2022, 1, 8, 8.1, 'https://m.media-amazon.com/images/M/MV5BZGQxYWFlNzgtODZjMS00YmM5LWEzZWMtOGVmODMzYjIyODZiXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 'https://www.youtube.com/embed/BpJYNVhGf1s', 'devam_ediyor', NULL, 1, 8, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(29, 'Shadow and Bone', 'Grishaverse evreninde geçen fantastik dizi.', NULL, NULL, NULL, NULL, 'fantastik', 2021, 2, 16, 7.6, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS3YOsrkLsWniNOMzPCVtHQyLX2ZOeLGrH8rw&s', 'https://www.youtube.com/embed/b1WHQTbJ7vE', 'devam_ediyor', NULL, 2, 16, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(30, 'The Wheel of Time', 'Robert Jordan\'ın fantastik roman serisinden uyarlanan dizi.', NULL, NULL, NULL, NULL, 'fantastik', 2021, 2, 16, 7.1, 'https://m.media-amazon.com/images/M/MV5BNmQ5Y2U2MWYtZDcyMi00YTk5LWEyYjItNTI3ODg4MTdlMjYwXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 'https://www.youtube.com/embed/4M7LIcH16C0', 'devam_ediyor', NULL, 2, 16, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(31, 'True Detective', 'Her sezonu farklı cinayet vakası anlatan polisiye dizi.', NULL, NULL, NULL, NULL, 'polisiye', 2014, 4, 30, 8.9, 'https://m.media-amazon.com/images/M/MV5BYjgwYzA1NWMtNDYyZi00ZGQyLWI5NTktMDYwZjE2OTIwZWEwXkEyXkFqcGc@._V1_.jpg', 'https://www.youtube.com/embed/TXwCoNwBSkQ', 'devam_ediyor', NULL, 4, 30, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(32, 'Mindhunter', 'FBI\'ın seri katilleri anlamaya çalıştığı dizi.', NULL, NULL, NULL, NULL, 'polisiye', 2017, 2, 19, 8.6, 'https://m.media-amazon.com/images/M/MV5BYTk4NDA4MGMtNjliOC00MjExLWI1YzctOTc4NWIxM2I1YjM5XkEyXkFqcGc@._V1_.jpg', 'https://www.youtube.com/embed/evd8j6K6obM', 'iptal_edildi', NULL, 2, 19, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(33, 'Broadchurch', 'Küçük bir kasabada geçen cinayet vakası.', NULL, NULL, NULL, NULL, 'polisiye', 2013, 3, 24, 8.4, 'https://image.pbs.org/contentchannels/XcQa04i-show-poster2x3-5cvWGhZ.jpg', 'https://www.youtube.com/embed/4M7LIcH16C0', 'tamamlandi', NULL, 3, 24, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(34, 'The Killing', 'Seattle\'da geçen cinayet vakası.', NULL, NULL, NULL, NULL, 'polisiye', 2011, 4, 44, 8.3, 'https://m.media-amazon.com/images/M/MV5BMTQ5MTUxMzU3Ml5BMl5BanBnXkFtZTgwMDU3NDYxMjE@._V1_.jpg', 'https://www.youtube.com/embed/4M7LIcH16C0', 'tamamlandi', NULL, 4, 44, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(35, 'Luther', 'Londra\'da geçen polisiye dizi.', NULL, NULL, NULL, NULL, 'polisiye', 2010, 5, 20, 8.4, 'https://m.media-amazon.com/images/M/MV5BNmViZjE1MjEtZjRlZC00MWMzLTg0ODItYjI1ODZiNzk5YzBiXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 'https://www.youtube.com/embed/4M7LIcH16C0', 'tamamlandi', NULL, 5, 20, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(36, 'Diriliş Ertuğrul', 'Osmanlı İmparatorluğu\'nun kuruluş dönemini anlatan tarihi dizi.', NULL, NULL, NULL, NULL, 'yerli', 2014, 5, 150, 8.3, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTHqr0n5VqIihxVYPIzeiPXbYx0VHNPd69M3g&s', 'https://www.youtube.com/embed/4M7LIcH16C0', 'tamamlandi', NULL, 5, 150, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(37, 'Kuruluş Osman', 'Osman Bey\'in hayatını anlatan tarihi dizi.', NULL, NULL, NULL, NULL, 'yerli', 2019, 4, 120, 7.8, 'https://yt3.googleusercontent.com/t0Mglt5gjtPzlc0vd5H5Q6HB2BLlVYj3F8KrWV5RKPAdR0AvpYQJrYji0AKU58GQBo6WNrMU5As=s900-c-k-c0x00ffffff-no-rj', 'https://www.youtube.com/embed/8jLOx1hD3_o', 'devam_ediyor', NULL, 4, 120, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(38, 'Çukur', 'İstanbul\'da geçen mafya dizisi.', NULL, NULL, NULL, NULL, 'yerli', 2017, 4, 131, 8.1, 'https://www.ayyapim.com/media/images/posterler/cukur-f71c6546a18ecb1376ca1af80deff3c5.jpg', 'https://www.youtube.com/embed/4M7LIcH16C0', 'tamamlandi', NULL, 4, 131, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(39, 'Eşkıya Dünyaya Hükümdar Olmaz', 'Eşkıya Baran\'ın hikayesini anlatan dizi.', NULL, NULL, NULL, NULL, 'yerli', 2015, 6, 200, 8.0, 'https://m.media-amazon.com/images/M/MV5BYTEwYWIzM2YtNTcwYy00NDRmLWFiOWYtNjE1MzYwZWU0OTEyXkEyXkFqcGc@._V1_QL75_UX190_CR0,27,190,281_.jpg', 'https://www.youtube.com/embed/8jLOx1hD3_o', 'tamamlandi', NULL, 6, 200, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(40, 'Kara Para Aşk', 'Polis memuru Elif ile mafya babası Ömer\'in aşk hikayesi.', NULL, NULL, NULL, NULL, 'yerli', 2014, 2, 54, 7.9, 'https://iaatv.tmgrup.com.tr/d6515a/0/0/0/0/0/0?u=https://iatv.tmgrup.com.tr/2021/06/24/500x268/1624538401048.jpg', 'https://www.youtube.com/embed/8jLOx1hD3_o', 'tamamlandi', NULL, 2, 54, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(41, 'Outlander', 'Zaman yolculuğu ile geçmişte yaşanan aşk hikayesi.', NULL, NULL, NULL, NULL, 'romantik', 2014, 7, 83, 8.4, 'https://m.media-amazon.com/images/I/81RzXWg9GiL._UF1000,1000_QL80_.jpg', 'https://www.youtube.com/embed/1Cjj89czelE', 'devam_ediyor', NULL, 7, 83, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(42, 'Bridgerton', 'Regency döneminde geçen romantik dizi.', NULL, NULL, NULL, NULL, 'romantik', 2020, 3, 24, 7.3, 'https://resizing.flixster.com/Zdvk-xZ3cN7uIJGvqPcuAijAb1U=/ems.cHJkLWVtcy1hc3NldHMvdHZzZXJpZXMvOWQyNzdiMGEtZmZhYi00YmZjLTkxZDktNDFlMjFhNjZkZmYwLmpwZw==', 'https://www.youtube.com/embed/q1zk8vW2YtI', 'devam_ediyor', NULL, 3, 24, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(43, 'Virgin River', 'Küçük bir kasabada geçen romantik dizi.', NULL, NULL, NULL, NULL, 'romantik', 2019, 5, 50, 7.4, 'https://m.media-amazon.com/images/M/MV5BMWYyOTU0ZWMtMzEzOS00NWZlLTg2NzYtNTk5ZWQyZmVmOTk4XkEyXkFqcGc@._V1_.jpg', 'https://www.youtube.com/embed/4M7LIcH16C0', 'devam_ediyor', NULL, 5, 50, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(44, 'Sweet Magnolias', 'Güney kasabasında geçen romantik dizi.', NULL, NULL, NULL, NULL, 'romantik', 2020, 3, 30, 7.3, 'https://m.media-amazon.com/images/M/MV5BNDRmZWEyY2MtMmM5Mi00N2UwLWE2MzQtZGU0OWJhY2IxNThmXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 'https://www.youtube.com/embed/q1zk8vW2YtI', 'devam_ediyor', NULL, 3, 30, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(45, 'Emily in Paris', 'Paris\'te yaşayan Amerikalı kızın romantik maceraları.', NULL, NULL, NULL, NULL, 'romantik', 2020, 3, 30, 7.1, 'https://m.media-amazon.com/images/M/MV5BODI5Y2YxM2UtZjhjYy00ZjM0LTg3NjQtYjQxMTBmZjM4ZTlkXkEyXkFqcGc@._V1_.jpg', 'https://www.youtube.com/embed/q1zk8vW2YtI', 'devam_ediyor', NULL, 3, 30, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-30 07:08:14', '2025-08-20 22:26:21'),
(46, 'How I Met Your Mother', 'Dizi, 2030 yılında, Ted Mosby\'nin çocuklarına anneleri (kendi eşi) ile nasıl tanıştığını anlatmasıyla başlar. Bob Saget\'in seslendirmesiyle asıl karakteri Ted \"Size annenizle nasıl tanıştığımı anlatacağım.\" der ve dizi 2005 yılına döner.', 'Pamela Fryman', '', 'İngilizce', 'ABD', 'Komedi', 2005, 9, 208, 8.3, 'https://disney.images.edge.bamgrid.com/ripcut-delivery/v2/variant/disney/559b4b05-9c8e-4e19-89d2-30a74febb0c0/compose?aspectRatio=1.78&format=webp&width=1200', 'https://www.youtube.com/embed/cjJLEYMzpjc', 'tamamlandi', NULL, 9, 208, 20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-05 14:34:15', '2025-08-13 09:06:27');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `dizi_sezonlar`
--

DROP TABLE IF EXISTS `dizi_sezonlar`;
CREATE TABLE IF NOT EXISTS `dizi_sezonlar` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dizi_id` int NOT NULL,
  `sezon_no` int NOT NULL,
  `bolum_sayisi` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_dizi_sezon` (`dizi_id`,`sezon_no`)
) ENGINE=InnoDB AUTO_INCREMENT=209 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `dizi_sezonlar`
--

INSERT INTO `dizi_sezonlar` (`id`, `dizi_id`, `sezon_no`, `bolum_sayisi`, `created_at`) VALUES
(1, 1, 1, 7, '2025-08-22 07:45:30'),
(2, 1, 2, 13, '2025-08-22 07:45:30'),
(3, 1, 3, 13, '2025-08-22 07:45:30'),
(4, 1, 4, 13, '2025-08-22 07:45:30'),
(5, 1, 5, 16, '2025-08-22 07:45:30'),
(6, 6, 1, 24, '2025-08-22 07:45:30'),
(7, 6, 2, 24, '2025-08-22 07:45:30'),
(8, 6, 3, 25, '2025-08-22 07:45:30'),
(9, 6, 4, 24, '2025-08-22 07:45:30'),
(10, 6, 5, 22, '2025-08-22 07:45:30'),
(11, 6, 6, 25, '2025-08-22 07:45:30'),
(12, 6, 7, 24, '2025-08-22 07:45:30'),
(13, 6, 8, 24, '2025-08-22 07:45:30'),
(14, 6, 9, 24, '2025-08-22 07:45:30'),
(15, 6, 10, 18, '2025-08-22 07:45:30'),
(16, 26, 1, 10, '2025-08-22 07:45:30'),
(17, 26, 2, 10, '2025-08-22 07:45:30'),
(18, 26, 3, 10, '2025-08-22 07:45:30'),
(19, 26, 4, 10, '2025-08-22 07:45:30'),
(20, 26, 5, 10, '2025-08-22 07:45:30'),
(21, 26, 6, 10, '2025-08-22 07:45:30'),
(22, 26, 7, 7, '2025-08-22 07:45:30'),
(23, 26, 8, 6, '2025-08-22 07:45:30'),
(24, 7, 1, 6, '2025-08-22 07:45:30'),
(25, 7, 2, 22, '2025-08-22 07:45:30'),
(26, 7, 3, 25, '2025-08-22 07:45:30'),
(27, 7, 4, 19, '2025-08-22 07:45:30'),
(28, 7, 5, 28, '2025-08-22 07:45:30'),
(29, 7, 6, 26, '2025-08-22 07:45:30'),
(30, 7, 7, 24, '2025-08-22 07:45:30'),
(31, 7, 8, 24, '2025-08-22 07:45:30'),
(32, 7, 9, 25, '2025-08-22 07:45:30'),
(33, 16, 1, 8, '2025-08-22 07:45:30'),
(34, 16, 2, 9, '2025-08-22 07:45:30'),
(35, 16, 3, 8, '2025-08-22 07:45:30'),
(36, 16, 4, 9, '2025-08-22 07:45:30'),
(37, 2, 1, 10, '2025-08-22 07:45:30'),
(38, 2, 2, 10, '2025-08-22 07:45:30'),
(39, 2, 3, 10, '2025-08-22 07:45:30'),
(40, 2, 4, 10, '2025-08-22 07:45:30'),
(41, 2, 5, 10, '2025-08-22 07:45:30'),
(42, 2, 6, 10, '2025-08-22 07:45:30'),
(43, 3, 1, 10, '2025-08-22 07:45:30'),
(44, 3, 2, 10, '2025-08-22 07:45:30'),
(45, 3, 3, 10, '2025-08-22 07:45:30'),
(46, 4, 1, 10, '2025-08-22 07:45:30'),
(47, 4, 2, 10, '2025-08-22 07:45:30'),
(48, 4, 3, 10, '2025-08-22 07:45:30'),
(49, 4, 4, 14, '2025-08-22 07:45:30'),
(50, 5, 1, 7, '2025-08-22 07:45:30'),
(51, 8, 1, 22, '2025-08-22 07:45:30'),
(52, 8, 2, 23, '2025-08-22 07:45:30'),
(53, 8, 3, 23, '2025-08-22 07:45:30'),
(54, 8, 4, 22, '2025-08-22 07:45:30'),
(55, 8, 5, 22, '2025-08-22 07:45:30'),
(56, 8, 6, 18, '2025-08-22 07:45:30'),
(57, 8, 7, 13, '2025-08-22 07:45:30'),
(58, 8, 8, 10, '2025-08-22 07:45:30'),
(59, 9, 1, 6, '2025-08-22 07:45:30'),
(60, 9, 2, 24, '2025-08-22 07:45:30'),
(61, 9, 3, 16, '2025-08-22 07:45:30'),
(62, 9, 4, 22, '2025-08-22 07:45:30'),
(63, 9, 5, 22, '2025-08-22 07:45:30'),
(64, 9, 6, 22, '2025-08-22 07:45:30'),
(65, 9, 7, 13, '2025-08-22 07:45:30'),
(66, 10, 1, 13, '2025-08-22 07:45:30'),
(67, 10, 2, 13, '2025-08-22 07:45:30'),
(68, 10, 3, 14, '2025-08-22 07:45:30'),
(69, 10, 4, 13, '2025-08-22 07:45:30'),
(70, 11, 1, 8, '2025-08-22 07:45:30'),
(71, 11, 2, 8, '2025-08-22 07:45:30'),
(72, 11, 3, 8, '2025-08-22 07:45:30'),
(73, 11, 4, 8, '2025-08-22 07:45:30'),
(74, 12, 1, 13, '2025-08-22 07:45:30'),
(75, 12, 2, 13, '2025-08-22 07:45:30'),
(76, 12, 3, 13, '2025-08-22 07:45:30'),
(77, 13, 1, 13, '2025-08-22 07:45:30'),
(78, 13, 2, 13, '2025-08-22 07:45:30'),
(79, 14, 1, 23, '2025-08-22 07:45:30'),
(80, 14, 2, 23, '2025-08-22 07:45:30'),
(81, 14, 3, 23, '2025-08-22 07:45:30'),
(82, 14, 4, 23, '2025-08-22 07:45:30'),
(83, 14, 5, 23, '2025-08-22 07:45:30'),
(84, 14, 6, 23, '2025-08-22 07:45:30'),
(85, 14, 7, 22, '2025-08-22 07:45:30'),
(86, 14, 8, 10, '2025-08-22 07:45:30'),
(87, 15, 1, 23, '2025-08-22 07:45:30'),
(88, 15, 2, 23, '2025-08-22 07:45:30'),
(89, 15, 3, 23, '2025-08-22 07:45:30'),
(90, 15, 4, 23, '2025-08-22 07:45:30'),
(91, 15, 5, 22, '2025-08-22 07:45:30'),
(92, 15, 6, 22, '2025-08-22 07:45:30'),
(93, 15, 7, 18, '2025-08-22 07:45:30'),
(94, 15, 8, 20, '2025-08-22 07:45:30'),
(95, 15, 9, 13, '2025-08-22 07:45:30'),
(96, 17, 1, 3, '2025-08-22 07:45:30'),
(97, 17, 2, 3, '2025-08-22 07:45:30'),
(98, 17, 3, 6, '2025-08-22 07:45:30'),
(99, 17, 4, 6, '2025-08-22 07:45:30'),
(100, 17, 5, 3, '2025-08-22 07:45:30'),
(101, 17, 6, 5, '2025-08-22 07:45:30'),
(102, 17, 7, 6, '2025-08-22 07:45:30'),
(103, 17, 8, 5, '2025-08-22 07:45:30'),
(104, 18, 1, 8, '2025-08-22 07:45:30'),
(105, 18, 2, 8, '2025-08-22 07:45:30'),
(106, 18, 3, 8, '2025-08-22 07:45:30'),
(107, 19, 1, 10, '2025-08-22 07:45:30'),
(108, 19, 2, 10, '2025-08-22 07:45:30'),
(109, 19, 3, 8, '2025-08-22 07:45:30'),
(110, 19, 4, 8, '2025-08-22 07:45:30'),
(111, 20, 1, 10, '2025-08-22 07:45:31'),
(112, 20, 2, 8, '2025-08-22 07:45:31'),
(113, 21, 1, 8, '2025-08-22 07:45:31'),
(114, 21, 2, 9, '2025-08-22 07:45:31'),
(115, 21, 3, 8, '2025-08-22 07:45:31'),
(116, 21, 4, 9, '2025-08-22 07:45:31'),
(117, 22, 1, 10, '2025-08-22 07:45:31'),
(118, 23, 1, 12, '2025-08-22 07:45:31'),
(119, 23, 2, 13, '2025-08-22 07:45:31'),
(120, 23, 3, 13, '2025-08-22 07:45:31'),
(121, 23, 4, 13, '2025-08-22 07:45:31'),
(122, 23, 5, 12, '2025-08-22 07:45:31'),
(123, 23, 6, 10, '2025-08-22 07:45:31'),
(124, 23, 7, 11, '2025-08-22 07:45:31'),
(125, 23, 8, 10, '2025-08-22 07:45:31'),
(126, 23, 9, 9, '2025-08-22 07:45:31'),
(127, 23, 10, 10, '2025-08-22 07:45:31'),
(128, 23, 11, 10, '2025-08-22 07:45:31'),
(129, 23, 12, 10, '2025-08-22 07:45:31'),
(130, 24, 1, 9, '2025-08-22 07:45:31'),
(131, 25, 1, 7, '2025-08-22 07:45:31'),
(132, 27, 1, 8, '2025-08-22 07:45:31'),
(133, 27, 2, 8, '2025-08-22 07:45:31'),
(134, 27, 3, 8, '2025-08-22 07:45:31'),
(135, 28, 1, 8, '2025-08-22 07:45:31'),
(136, 29, 1, 8, '2025-08-22 07:45:31'),
(137, 29, 2, 8, '2025-08-22 07:45:31'),
(138, 30, 1, 8, '2025-08-22 07:45:31'),
(139, 30, 2, 8, '2025-08-22 07:45:31'),
(140, 31, 1, 8, '2025-08-22 07:45:31'),
(141, 31, 2, 8, '2025-08-22 07:45:31'),
(142, 31, 3, 8, '2025-08-22 07:45:31'),
(143, 31, 4, 6, '2025-08-22 07:45:31'),
(144, 32, 1, 10, '2025-08-22 07:45:31'),
(145, 32, 2, 9, '2025-08-22 07:45:31'),
(146, 33, 1, 8, '2025-08-22 07:45:31'),
(147, 33, 2, 8, '2025-08-22 07:45:31'),
(148, 33, 3, 8, '2025-08-22 07:45:31'),
(149, 34, 1, 13, '2025-08-22 07:45:31'),
(150, 34, 2, 13, '2025-08-22 07:45:31'),
(151, 34, 3, 12, '2025-08-22 07:45:31'),
(152, 34, 4, 6, '2025-08-22 07:45:31'),
(153, 35, 1, 6, '2025-08-22 07:45:31'),
(154, 35, 2, 6, '2025-08-22 07:45:31'),
(155, 35, 3, 6, '2025-08-22 07:45:31'),
(156, 35, 4, 6, '2025-08-22 07:45:31'),
(157, 35, 5, 4, '2025-08-22 07:45:31'),
(158, 36, 1, 30, '2025-08-22 07:45:31'),
(159, 36, 2, 30, '2025-08-22 07:45:31'),
(160, 36, 3, 30, '2025-08-22 07:45:31'),
(161, 36, 4, 30, '2025-08-22 07:45:31'),
(162, 36, 5, 30, '2025-08-22 07:45:31'),
(163, 37, 1, 30, '2025-08-22 07:45:31'),
(164, 37, 2, 30, '2025-08-22 07:45:31'),
(165, 37, 3, 30, '2025-08-22 07:45:31'),
(166, 37, 4, 30, '2025-08-22 07:45:31'),
(167, 38, 1, 32, '2025-08-22 07:45:31'),
(168, 38, 2, 33, '2025-08-22 07:45:31'),
(169, 38, 3, 33, '2025-08-22 07:45:31'),
(170, 38, 4, 33, '2025-08-22 07:45:31'),
(171, 39, 1, 33, '2025-08-22 07:45:31'),
(172, 39, 2, 33, '2025-08-22 07:45:31'),
(173, 39, 3, 33, '2025-08-22 07:45:31'),
(174, 39, 4, 33, '2025-08-22 07:45:31'),
(175, 39, 5, 33, '2025-08-22 07:45:31'),
(176, 39, 6, 35, '2025-08-22 07:45:31'),
(177, 40, 1, 27, '2025-08-22 07:45:31'),
(178, 40, 2, 27, '2025-08-22 07:45:31'),
(179, 41, 1, 16, '2025-08-22 07:45:31'),
(180, 41, 2, 13, '2025-08-22 07:45:31'),
(181, 41, 3, 13, '2025-08-22 07:45:31'),
(182, 41, 4, 13, '2025-08-22 07:45:31'),
(183, 41, 5, 12, '2025-08-22 07:45:31'),
(184, 41, 6, 8, '2025-08-22 07:45:31'),
(185, 41, 7, 16, '2025-08-22 07:45:31'),
(186, 42, 1, 8, '2025-08-22 07:45:31'),
(187, 42, 2, 8, '2025-08-22 07:45:31'),
(188, 42, 3, 8, '2025-08-22 07:45:31'),
(189, 43, 1, 10, '2025-08-22 07:45:31'),
(190, 43, 2, 10, '2025-08-22 07:45:31'),
(191, 43, 3, 10, '2025-08-22 07:45:31'),
(192, 43, 4, 12, '2025-08-22 07:45:31'),
(193, 43, 5, 10, '2025-08-22 07:45:31'),
(194, 44, 1, 10, '2025-08-22 07:45:31'),
(195, 44, 2, 10, '2025-08-22 07:45:31'),
(196, 44, 3, 10, '2025-08-22 07:45:31'),
(197, 45, 1, 10, '2025-08-22 07:45:31'),
(198, 45, 2, 10, '2025-08-22 07:45:31'),
(199, 45, 3, 10, '2025-08-22 07:45:31'),
(200, 46, 1, 22, '2025-08-22 07:45:31'),
(201, 46, 2, 22, '2025-08-22 07:45:31'),
(202, 46, 3, 20, '2025-08-22 07:45:31'),
(203, 46, 4, 24, '2025-08-22 07:45:31'),
(204, 46, 5, 24, '2025-08-22 07:45:31'),
(205, 46, 6, 24, '2025-08-22 07:45:31'),
(206, 46, 7, 24, '2025-08-22 07:45:31'),
(207, 46, 8, 24, '2025-08-22 07:45:31'),
(208, 46, 9, 24, '2025-08-22 07:45:31');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `dizi_takip`
--

DROP TABLE IF EXISTS `dizi_takip`;
CREATE TABLE IF NOT EXISTS `dizi_takip` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `year` int DEFAULT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `poster` text,
  `rating` decimal(3,1) DEFAULT '0.0',
  `review` text,
  `season_count` int DEFAULT '1',
  `episode_count` int DEFAULT '1',
  `current_season` int DEFAULT '1',
  `current_episode` int DEFAULT '1',
  `is_watched` tinyint(1) DEFAULT '0',
  `is_favorite` tinyint(1) DEFAULT '0',
  `is_watchlist` tinyint(1) DEFAULT '0',
  `is_watching` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `dizi_takip`
--

INSERT INTO `dizi_takip` (`id`, `user_id`, `title`, `year`, `genre`, `poster`, `rating`, `review`, `season_count`, `episode_count`, `current_season`, `current_episode`, `is_watched`, `is_favorite`, `is_watchlist`, `is_watching`, `created_at`, `updated_at`) VALUES
(10, 104, 'Friends', 1994, 'komedi', 'https://diziyleogren.com/img/BFriends.c05b593a.jpg', 8.9, '', 10, 236, 10, 2, 0, 0, 1, 0, '2025-08-20 22:27:32', '2025-08-20 22:31:14'),
(11, 104, 'Game of Thrones', 2011, 'fantastik', 'https://m.media-amazon.com/images/M/MV5BMTNhMDJmNmYtNDQ5OS00ODdlLWE0ZDAtZTgyYTIwNDY3OTU3XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 9.3, '', 8, 73, 1, 1, 0, 1, 0, 0, '2025-08-20 22:31:51', '2025-08-20 22:31:51'),
(12, 118, 'The Queen\'s Gambit', 2020, 'dram', 'https://m.media-amazon.com/images/M/MV5BMmRlNjQxNWQtMjk1OS00N2QxLTk0YWQtMzRhYjY5YTFhNjMxXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 8.6, '', 1, 7, 1, 7, 1, 0, 0, 0, '2025-08-21 10:59:57', '2025-08-21 10:59:57'),
(13, 118, 'Breaking Bad', 2008, 'dram', 'https://thumbor.evrimagaci.org/QESXEkks0JE4VVm7Evgv_9aI-tc=/old%2Fmi_media%2Fa3bb95fb0057fdc5eb4685f6ad39e7ee.jpeg', 9.5, '', 5, 62, 5, 62, 1, 0, 0, 0, '2025-08-21 11:00:07', '2025-08-21 11:00:07'),
(14, 118, 'How I Met Your Mother', 2005, 'Komedi', 'https://disney.images.edge.bamgrid.com/ripcut-delivery/v2/variant/disney/559b4b05-9c8e-4e19-89d2-30a74febb0c0/compose?aspectRatio=1.78&format=webp&width=1200', 8.3, '', 9, 208, 9, 208, 1, 0, 0, 0, '2025-08-21 11:00:15', '2025-08-21 11:00:15'),
(15, 118, 'The Office', 2005, 'komedi', 'https://m.media-amazon.com/images/M/MV5BZjQwYzBlYzUtZjhhOS00ZDQ0LWE0NzAtYTk4MjgzZTNkZWEzXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 8.9, '', 9, 201, 9, 201, 1, 0, 0, 0, '2025-08-21 11:00:19', '2025-08-21 11:00:19'),
(16, 118, 'Friends', 1994, 'komedi', 'https://diziyleogren.com/img/BFriends.c05b593a.jpg', 8.9, '', 10, 236, 10, 236, 1, 1, 0, 0, '2025-08-21 11:00:22', '2025-08-21 11:01:29'),
(17, 118, 'The Boys', 2019, 'aksiyon', 'https://preview.redd.it/2kzjj8l0om391.jpg?width=640&crop=smart&auto=webp&s=c3b05285bc3be26a383e2c4f4ec30024221a6016', 8.7, '', 4, 32, 4, 32, 1, 0, 0, 0, '2025-08-21 11:00:32', '2025-08-21 11:00:32'),
(18, 118, 'The Witcher', 2019, 'fantastik', 'https://m.media-amazon.com/images/M/MV5BMTQ5MDU5MTktMDZkMy00NDU1LWIxM2UtODg5OGFiNmRhNDBjXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 8.0, '', 3, 24, 3, 24, 1, 0, 0, 0, '2025-08-21 11:01:07', '2025-08-21 11:01:07'),
(19, 104, 'Brooklyn Nine-Nine', 2013, 'komedi', 'https://m.media-amazon.com/images/M/MV5BNzBiODQxZTUtNjc0MC00Yzc1LThmYTMtN2YwYTU3NjgxMmI4XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 8.4, '', 8, 153, 8, 153, 0, 0, 0, 0, '2025-08-21 13:31:42', '2025-08-21 13:31:54'),
(21, 104, 'Breaking Bad', 2008, 'dram', 'https://thumbor.evrimagaci.org/QESXEkks0JE4VVm7Evgv_9aI-tc=/old%2Fmi_media%2Fa3bb95fb0057fdc5eb4685f6ad39e7ee.jpeg', 9.5, '', 5, 62, 2, 10, 0, 0, 0, 1, '2025-08-22 07:58:41', '2025-08-22 08:09:04');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `dunya_mutfagi`
--

DROP TABLE IF EXISTS `dunya_mutfagi`;
CREATE TABLE IF NOT EXISTS `dunya_mutfagi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ad` varchar(255) NOT NULL,
  `ulke` varchar(255) NOT NULL,
  `malzemeler` text NOT NULL,
  `hazirlanis` text NOT NULL,
  `sure` varchar(100) NOT NULL,
  `zorluk` enum('Kolay','Orta','Zor') DEFAULT 'Orta',
  `porsiyon` varchar(50) NOT NULL,
  `kalori` varchar(50) DEFAULT NULL,
  `resim` varchar(500) NOT NULL,
  `aciklama` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `dunya_mutfagi`
--

INSERT INTO `dunya_mutfagi` (`id`, `ad`, `ulke`, `malzemeler`, `hazirlanis`, `sure`, `zorluk`, `porsiyon`, `kalori`, `resim`, `aciklama`, `created_at`, `updated_at`) VALUES
(1, 'Pizza Margherita', 'İtalya', 'Un, maya, domates sosu, mozzarella peyniri, fesleğen, zeytinyağı, tuz', 'Hamur yoğrulur ve mayalandırılır, ince açılır, domates sosu ve mozzarella ile kaplanır, fırında pişirilir.', '60 dakika', 'Orta', '4 kişilik', '285 kcal', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRP0HbRY0SsECXq3XHqjXUBw3CqK1VfE5PX1w&s', 'İtalya\'nın geleneksel pizzası, taze mozzarella ve fesleğen ile.', '2025-08-12 14:03:24', '2025-08-12 14:04:57'),
(2, 'Sushi Nigiri', 'Japonya', 'Sushi pirinci, somon, nori, wasabi, soya sosu, zencefil turşusu', 'Pirinç pişirilir ve sirke ile karıştırılır, somon dilimleri ile şekillendirilir.', '45 dakika', 'Zor', '6 adet', '180 kcal', 'https://www.yummymummykitchen.com/wp-content/uploads/2021/10/sashimi-vs-nigiri-1.jpg', 'Japon mutfağının en popüler yemeği, taze somon ile hazırlanır.', '2025-08-12 14:03:24', '2025-08-12 14:05:56'),
(3, 'Paella', 'İspanya', 'Bomba pirinci, karides, midye, safran, domates, soğan, sarımsak, zeytinyağı', 'Safranlı su hazırlanır, pirinç ve deniz ürünleri ile paella tavasında pişirilir.', '75 dakika', 'Zor', '6 kişilik', '420 kcal', 'https://assets.tmecosys.com/image/upload/t_web_rdp_recipe_584x480_1_5x/img/recipe/ras/Assets/d1bddb460487bad93ad5f7d28ff04db5/Derivates/445eb9ff2df8686c2bc965666d5613cea2aae79c.jpg', 'Valencia\'nın meşhur paellası, safran ve deniz ürünleri ile.', '2025-08-12 14:03:24', '2025-08-12 14:06:30'),
(4, 'Pad Thai', 'Tayland', 'Pirinç eriştesi, karides, tofu, yumurta, soya filizi, yer fıstığı, limon, balık sosu', 'Erişte haşlanır, wok tavasında karides ve tofu ile sote edilir, yumurta eklenir.', '30 dakika', 'Orta', '4 kişilik', '380 kcal', 'https://assets.tmecosys.com/image/upload/t_web_rdp_recipe_584x480_1_5x/img/recipe/ras/Assets/2444133e36d6ef3d18ae420b902eac16/Derivates/ccb327e468e55307e3abfe511b69744fb3431eee.jpg', 'Tayland\'ın ulusal yemeği, ekşi-tatlı sos ile hazırlanır.', '2025-08-12 14:03:24', '2025-08-12 14:06:58'),
(5, 'Hamburger', 'Amerika', 'Dana kıyma, hamburger ekmeği, marul, domates, soğan, peynir, ketçap, mayonez', 'Kıyma köfte haline getirilir, ızgarada pişirilir, ekmek arası sebzelerle servis edilir.', '25 dakika', 'Kolay', '4 adet', '550 kcal', 'https://www.washingtonpost.com/wp-apps/imrs.php?src=https://arc-anglerfish-washpost-prod-washpost.s3.amazonaws.com/public/M6HASPARCZHYNN4XTUYT7H6PTE.jpg&w=800&h=600', 'Amerikan fast food kültürünün simgesi, özel soslarla.', '2025-08-12 14:03:24', '2025-08-12 14:07:24'),
(6, 'Ratatouille', 'Fransa', 'Patlıcan, kabak, domates, biber, soğan, sarımsak, zeytinyağı, kekik, fesleğen', 'Sebzeler dilimlenir, katmanlar halinde dizilir ve fırında yavaşça pişirilir.', '90 dakika', 'Orta', '6 kişilik', '180 kcal', 'https://assets.tmecosys.com/image/upload/t_web_rdp_recipe_584x480/img/recipe/ras/Assets/9cffafab1d5436c0695bd417c6200a19/Derivates/400b7cd10996dc118063ff8c2028e2627e28bd36.jpg', 'Provence bölgesinin geleneksel sebze yemeği, zeytinyağı ile.', '2025-08-12 14:03:24', '2025-08-12 14:07:56'),
(7, 'Tacos', 'Meksika', 'Mısır tortilla, dana eti, soğan, domates, marul, peynir, salsa, ekşi krema', 'Et baharatlarla pişirilir, tortilla üzerine konur, sebzeler ve soslarla servis edilir.', '40 dakika', 'Kolay', '8 adet', '320 kcal', 'https://danosseasoning.com/wp-content/uploads/2022/03/Beef-Tacos-1024x767.jpg', 'Meksika\'nın geleneksel yemeği, baharatlı et ve taze sebzelerle.', '2025-08-12 14:03:24', '2025-08-12 14:08:22'),
(8, 'Köfte', 'Türkiye', 'Dana kıyma, soğan, ekmek içi, yumurta, maydanoz, baharatlar, zeytinyağı', 'Kıyma ve malzemeler yoğrulur, köfte şekli verilir, ızgarada pişirilir.', '35 dakika', 'Kolay', '6 kişilik', '280 kcal', 'https://www.yemekolay.com/wp-content/uploads/2023/07/kofte-tarifi.webp', 'Türk mutfağının vazgeçilmezi, özel baharatlarla hazırlanır.', '2025-08-12 14:03:24', '2025-08-15 09:47:44');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `filmler`
--

DROP TABLE IF EXISTS `filmler`;
CREATE TABLE IF NOT EXISTS `filmler` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'Film benzersiz kimliği',
  `film_adi` varchar(255) NOT NULL COMMENT 'Filmin adı',
  `yil` int NOT NULL COMMENT 'Yapım yılı',
  `sure` varchar(50) NOT NULL COMMENT 'Film süresi',
  `imdb_puani` decimal(3,1) NOT NULL COMMENT 'IMDb puanı',
  `poster_url` text NOT NULL COMMENT 'Film posteri resim linki',
  `ozet` text NOT NULL COMMENT 'Film özeti',
  `yonetmen` varchar(255) NOT NULL COMMENT 'Film yönetmeni',
  `oyuncular` text NOT NULL COMMENT 'Oyuncu listesi',
  `tur` varchar(255) NOT NULL COMMENT 'Film türü',
  `ulke` varchar(255) NOT NULL COMMENT 'Yapım ülkesi',
  `fragman_url` text NOT NULL COMMENT 'YouTube fragman linki',
  `kategori` varchar(100) NOT NULL COMMENT 'Film kategorisi',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Oluşturulma tarihi',
  `yorum_sayisi` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `filmler`
--

INSERT INTO `filmler` (`id`, `film_adi`, `yil`, `sure`, `imdb_puani`, `poster_url`, `ozet`, `yonetmen`, `oyuncular`, `tur`, `ulke`, `fragman_url`, `kategori`, `created_at`, `yorum_sayisi`) VALUES
(28, 'The Godfather', 1972, '175 dk', 9.2, 'https://m.media-amazon.com/images/M/MV5BM2MyNjYxNmUtYTAwNi00MTYxLWJmNWYtYzZlODY3ZTk3OTFlXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SX300.jpg', 'Corleone ailesinin mafya dünyasındaki yaşamı. Aile bağları, güç mücadelesi ve suç dünyasının gerçekleri.', 'Francis Ford Coppola', 'Marlon Brando, Al Pacino, James Caan', 'Dram, Suç', 'ABD', 'https://www.youtube.com/embed/sY1S34973zA', 'Dram', '2025-07-29 11:32:29', 0),
(29, '12 Angry Men', 1957, '96 dk', 8.9, 'https://m.media-amazon.com/images/M/MV5BMWU4N2FjNzYtNTVkNC00NzQ0LTg0MjAtYTJlMjFhNGUxZDFmXkEyXkFqcGdeQXVyNjc1NTYyMjg@._V1_SX300.jpg', 'Jüri üyelerinin bir cinayet davasında karar verme süreci. Adalet, önyargı ve insan psikolojisi.', 'Sidney Lumet', 'Henry Fonda, Lee J. Cobb, Martin Balsam', 'Dram, Suç', 'ABD', 'https://www.youtube.com/embed/TEN-2uTi2c0', 'Dram', '2025-07-29 11:32:29', 0),
(27, 'Schindler\'s List', 1993, '195 dk', 8.9, 'https://m.media-amazon.com/images/M/MV5BNDE4OTMxMTctNmRhYy00NWE2LTg3YzItYTk3M2UwOTU5Njg4XkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_SX300.jpg', 'Oskar Schindler\'in II. Dünya Savaşı sırasında Yahudileri kurtarma çabası. Tarihi dram ve insanlık mücadelesi.', 'Steven Spielberg', 'Liam Neeson, Ben Kingsley, Ralph Fiennes', 'Dram, Tarih', 'ABD', 'https://www.youtube.com/embed/gG22XNhtnoY', 'Dram', '2025-07-29 11:32:29', 0),
(26, 'The Green Mile', 1999, '189 dk', 8.6, 'https://images.plex.tv/photo?size=large-1920&scale=1&url=https%3A%2F%2Fmetadata-static.plex.tv%2Fd%2Fgracenote%2Fd725648c20cb167cc7a5487c4948b984.jpg', 'Death Row\'da çalışan gardiyan Paul Edgecomb\'un John Coffey ile tanışması. Mucizevi olaylar ve derin dostluk.', 'Frank Darabont', 'Tom Hanks, Michael Clarke Duncan, David Morse', 'Dram, Suç', 'ABD', 'https://www.youtube.com/embed/Ki4haFrqSrw', 'Dram', '2025-07-29 11:32:29', 0),
(25, 'Forrest Gump', 1994, '142 dk', 8.8, 'https://m.media-amazon.com/images/M/MV5BNWIwODRlZTUtY2U3ZS00Yzg1LWJhNzYtMmZiYmEyNmU1NjMzXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg', 'Forrest Gump\'ın hayatından kesitler. Basit bir adamın karmaşık dünyada yaşadığı deneyimler ve tarihi olaylara tanıklığı.', 'Robert Zemeckis', 'Tom Hanks, Robin Wright, Gary Sinise', 'Dram, Romantik', 'ABD', 'https://www.youtube.com/embed/bLvqoHBptjg', 'Dram', '2025-07-29 11:32:29', 0),
(18, 'Indiana Jones: Raiders of the Lost Ark', 1981, '115 dk', 8.4, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS4J0wi7PNihB9DjU0ozmCZIJm-Z1SXJ6lGnw&s', 'Arkeolog Indiana Jones, Ahit Sandığı\'nı bulmak için Nazi\'lerle yarışır. Tehlikeli maceralar ve heyecan verici aksiyon sahneleri.', 'Steven Spielberg', 'Harrison Ford, Karen Allen, Paul Freeman', 'Macera, Aksiyon', 'ABD', 'https://www.youtube.com/embed/XkkzKHCx154', 'Macera', '2025-07-29 11:31:14', 0),
(19, 'The Lord of the Rings: The Fellowship of the Ring', 2001, '178 dk', 8.8, 'https://m.media-amazon.com/images/M/MV5BN2EyZjM3NzUtNWUzMi00MTgxLWI0NTctMzY4M2VlOTdjZWRiXkEyXkFqcGdeQXVyNDUzOTQ5MjY@._V1_SX300.jpg', 'Frodo Baggins, Yüzük\'ü yok etmek için tehlikeli bir yolculuğa çıkar. Orta Dünya\'nın kaderi bu macerada şekillenir.', 'Peter Jackson', 'Elijah Wood, Ian McKellen, Viggo Mortensen', 'Macera, Fantastik', 'ABD, Yeni Zelanda', 'https://www.youtube.com/embed/V75dMMIW2B4', 'Macera', '2025-07-29 11:31:14', 0),
(20, 'Jurassic Park', 1993, '127 dk', 8.5, 'https://m.media-amazon.com/images/M/MV5BMjM2MDgxMDg0Nl5BMl5BanBnXkFtZTgwNTM2OTM5NDE@._V1_FMjpg_UX1000_.jpg', 'Dinozorların klonlandığı bir adada yaşanan macera. Bilim ve doğanın çarpışması, heyecan verici kaçış sahneleri.', 'Steven Spielberg', 'Sam Neill, Laura Dern, Jeff Goldblum', 'Macera, Bilim Kurgu', 'ABD', 'https://www.youtube.com/embed/lc0UehYemQA', 'Macera', '2025-07-29 11:31:14', 0),
(21, 'Pirates of the Caribbean: The Curse of the Black Pearl', 2003, '143 dk', 8.0, 'https://m.media-amazon.com/images/M/MV5BNGYyZGM5MGMtYTY2Ni00M2Y1LWIzNjQtYWUzM2VlNGVhMDNhXkEyXkFqcGdeQXVyMTMxODk2OTU@._V1_SX300.jpg', 'Kaptan Jack Sparrow\'un maceraları. Lanetli korsanlar ve hazine avı. Denizlerde geçen heyecan verici macera.', 'Gore Verbinski', 'Johnny Depp, Orlando Bloom, Keira Knightley', 'Macera, Fantastik', 'ABD', 'https://www.youtube.com/embed/naQr0uTrH_s', 'Macera', '2025-07-29 11:31:14', 0),
(22, 'The Princess Bride', 1987, '98 dk', 8.0, 'https://m.media-amazon.com/images/M/MV5BMGM4M2Q5N2MtNThkZS00NTc1LTk1NTItNWEyZjJjNDRmNDk5XkEyXkFqcGdeQXVyMjA0MDQ0Mjc@._V1_SX300.jpg', 'Prenses Buttercup\'ı kurtarmak için çıktığı yolculukta Westley\'in yaşadığı maceralar. Romantik ve komik bir macera.', 'Rob Reiner', 'Cary Elwes, Robin Wright, Mandy Patinkin', 'Macera, Romantik', 'ABD', 'https://www.youtube.com/embed/WNNUcHRiPS8', 'Macera', '2025-07-29 11:31:14', 0),
(23, 'The Goonies', 1985, '114 dk', 7.7, 'https://m.media-amazon.com/images/M/MV5BMjE1OWU4ODEtZmEzMC00NTcwLWFlMWUtYjhlNzExOTIxYzVlXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 'Bir grup çocuğun hazine haritası bulduktan sonra çıktığı macera. Tehlikeli mağaralar ve heyecan verici keşifler.', 'Richard Donner', 'Sean Astin, Josh Brolin, Corey Feldman', 'Macera, Komedi', 'ABD', 'https://www.youtube.com/embed/hJ2j4oWdQtU', 'Macera', '2025-07-29 11:31:14', 0),
(24, 'The Shawshank Redemption', 1994, '142 dk', 9.3, 'https://m.media-amazon.com/images/M/MV5BNDE3ODcxYzMtY2YzZC00NmNlLWJiNDMtZDViZWM2MzIxZDYwXkEyXkFqcGdeQXVyNjAwNDUxODI@._V1_SX300.jpg', 'Andy Dufresne\'in Shawshank Hapishanesi\'ndeki yaşamı ve umut dolu mücadelesi. Dostluk, umut ve özgürlük teması.', 'Frank Darabont', 'Tim Robbins, Morgan Freeman, Bob Gunton', 'Dram', 'ABD', 'https://www.youtube.com/embed/6hB3S9bIaco', 'Dram', '2025-07-29 11:32:29', 1),
(12, 'Die Hard', 1988, '132 dk', 8.2, 'https://media.posterlounge.com/img/products/710000/705263/705263_poster.jpg', 'John McClane, Los Angeles\'taki Nakatomi Plaza\'da Noel partisi sırasında teröristler tarafından rehin alınır. Tek başına teröristleri alt etmeye çalışan McClane\'in mücadelesi başlar.', 'John McTiernan', 'Bruce Willis, Alan Rickman, Bonnie Bedelia', 'Aksiyon, Gerilim', 'ABD', 'https://www.youtube.com/embed/2TQ-pOvI6Xo', 'Aksiyon', '2025-07-29 11:29:26', 0),
(13, 'Mad Max: Fury Road', 2015, '120 dk', 8.1, 'https://m.media-amazon.com/images/M/MV5BN2EwM2I5OWMtMGQyMi00Zjg1LWJkNTctZTdjYTA4OGUwZjMyXkEyXkFqcGdeQXVyMTMxODk2OTU@._V1_SX300.jpg', 'Post-apokaliptik dünyada Max ve Furiosa, Immortan Joe\'nun elinden kaçmaya çalışan kadınları kurtarmak için tehlikeli bir yolculuğa çıkar.', 'George Miller', 'Tom Hardy, Charlize Theron, Nicholas Hoult', 'Aksiyon, Macera', 'Avustralya, ABD', 'https://www.youtube.com/embed/hEJnMQG9ev8', 'Aksiyon', '2025-07-29 11:29:26', 0),
(14, 'John Wick', 2014, '101 dk', 7.4, 'https://m.media-amazon.com/images/M/MV5BMTU2NjA1ODgzMF5BMl5BanBnXkFtZTgwMTM2MTI4MjE@._V1_SX300.jpg', 'Emekli suikastçı John Wick, köpeğini öldüren ve arabasını çalan gangsterlerden intikam almak için eski mesleğine geri döner.', 'Chad Stahelski', 'Keanu Reeves, Michael Nyqvist, Alfie Allen', 'Aksiyon, Suç', 'ABD', 'https://www.youtube.com/embed/2AUmvWm5ZDQ', 'Aksiyon', '2025-07-29 11:29:26', 0),
(15, 'Mission: Impossible - Fallout', 2018, '147 dk', 7.7, 'https://play-lh.googleusercontent.com/ibLPWUi77ykXK8Km_8I3rTLYUEFVpqtDhH4dWGVz3xY5fH2zq4q47xa5xtYvGI_BIFBNxMezb9YEvD452TA', 'Ethan Hunt ve ekibinin nükleer silahları ele geçirmeye çalışan teröristleri durdurma görevi. Tehlikeli dublör sahneleri ve heyecan verici aksiyon.', 'Christopher McQuarrie', 'Tom Cruise, Henry Cavill, Ving Rhames', 'Aksiyon, Macera', 'ABD', 'https://www.youtube.com/embed/wb49-oV0F78', 'Aksiyon', '2025-07-29 11:29:26', 0),
(16, 'The Dark Knight', 2008, '152 dk', 9.0, 'https://m.media-amazon.com/images/M/MV5BMTMxNTMwODM0NF5BMl5BanBnXkFtZTcwODAyMTk2Mw@@._V1_SX300.jpg', 'Batman\'in Joker ile mücadelesi. Gotham şehrini kurtarmak için verdiği savaş. Aksiyon ve dramın mükemmel birleşimi.', 'Christopher Nolan', 'Christian Bale, Heath Ledger, Aaron Eckhart', 'Aksiyon, Dram', 'ABD', 'https://www.youtube.com/embed/EXeTwQWrcwY', 'Aksiyon', '2025-07-29 11:29:26', 1),
(17, 'The Matrix', 1999, '136 dk', 8.7, 'https://m.media-amazon.com/images/M/MV5BNzQzOTk3OTAtNDQ0Zi00ZTVkLWI0MTEtMDllZjNkYzNjNTc4L2ltYWdlXkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_SX300.jpg', 'Neo\'nun gerçek dünyayı keşfetmesi ve Matrix\'i yenme mücadelesi. Devrim niteliğinde aksiyon sahneleri ve özel efektler.', 'Lana Wachowski, Lilly Wachowski', 'Keanu Reeves, Laurence Fishburne, Carrie-Anne Moss', 'Aksiyon, Bilim Kurgu', 'ABD', 'https://www.youtube.com/embed/m8e-FF8MsqU', 'Aksiyon', '2025-07-29 11:29:26', 1),
(30, 'The Grand Budapest Hotel', 2014, '99 dk', 8.1, 'https://m.media-amazon.com/images/M/MV5BMzM5NjUxOTEyMl5BMl5BanBnXkFtZTgwNjEyMDM0MDE@._V1_SX300.jpg', 'Grand Budapest Hotel\'in efsanevi concierge\'i Gustave H. ve çırağı Zero\'nun maceraları. Eksantrik karakterler ve komik durumlar.', 'Wes Anderson', 'Ralph Fiennes, Tony Revolori, F. Murray Abraham', 'Komedi, Macera', 'ABD, Almanya', 'https://www.youtube.com/embed/1Fg5iWmQjwk', 'Komedi', '2025-07-29 11:33:28', 0),
(31, 'Shaun of the Dead', 2004, '99 dk', 7.9, 'https://m.media-amazon.com/images/I/71zyRZjUhRL._UF894,1000_QL80_.jpg', 'Zombi istilası sırasında Shaun ve arkadaşlarının hayatta kalma mücadelesi. İngiliz mizahı ve zombi komedisi.', 'Edgar Wright', 'Simon Pegg, Nick Frost, Kate Ashfield', 'Komedi, Korku', 'İngiltere', 'https://www.youtube.com/embed/LIfcaZ4pC-4', 'Komedi', '2025-07-29 11:33:28', 0),
(32, 'The Big Lebowski', 1998, '117 dk', 8.1, 'https://play-lh.googleusercontent.com/F6j_I4alSic18_Qvo39zNM9IeAJ93kjvnpupzgKyEqVu80lpqm9gyTWO14TqLFDQqyPy', 'Jeff \"The Dude\" Lebowski\'nin yanlış kimlik karışıklığı sonucu başına gelen olaylar. Absürt komedi ve kült film.', 'Joel Coen, Ethan Coen', 'Jeff Bridges, John Goodman, Julianne Moore', 'Komedi, Suç', 'ABD', 'https://www.youtube.com/embed/ngV0RBhGZmE', 'Komedi', '2025-07-29 11:33:28', 0),
(33, 'Groundhog Day', 1993, '101 dk', 8.0, 'https://m.media-amazon.com/images/M/MV5BZWIxNzM5YzQtY2FmMS00Yjc3LWI1ZjUtNGVjMjMzZTIxZTIxXkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_SX300.jpg', 'Phil Connors\'ın aynı günü tekrar tekrar yaşaması. Zaman döngüsü komedisi ve kişisel gelişim teması.', 'Harold Ramis', 'Bill Murray, Andie MacDowell, Chris Elliott', 'Komedi, Romantik', 'ABD', 'https://www.youtube.com/embed/GncQtURdcE4', 'Komedi', '2025-07-29 11:33:28', 0),
(34, 'Monty Python and the Holy Grail', 1975, '91 dk', 8.2, 'https://m.media-amazon.com/images/M/MV5BN2IyNTE4YzUtZWU0Mi00MGIwLTgyMmQtMzQ4YzQxYWNlYWE2XkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_SX300.jpg', 'Kral Arthur ve şövalyelerinin Kutsal Kase\'yi arama macerası. Absürt İngiliz komedisi ve parodi.', 'Terry Gilliam, Terry Jones', 'Graham Chapman, John Cleese, Eric Idle', 'Komedi, Macera', 'İngiltere', 'https://www.youtube.com/embed/scD4_ZVDD-8', 'Komedi', '2025-07-29 11:33:28', 0),
(35, 'The Princess Bride', 1987, '98 dk', 8.0, 'https://m.media-amazon.com/images/M/MV5BMGM4M2Q5N2MtNThkZS00NTc1LTk1NTItNWEyZjJjNDRmNDk5XkEyXkFqcGdeQXVyMjA0MDQ0Mjc@._V1_SX300.jpg', 'Prenses Buttercup\'ı kurtarmak için çıktığı yolculukta Westley\'in yaşadığı maceralar. Romantik komedi ve macera.', 'Rob Reiner', 'Cary Elwes, Robin Wright, Mandy Patinkin', 'Komedi, Romantik', 'ABD', 'https://www.youtube.com/embed/WNNUcHRiPS8', 'Komedi', '2025-07-29 11:33:28', 0),
(36, 'The Notebook', 2004, '123 dk', 7.8, 'https://m.media-amazon.com/images/M/MV5BMTk3OTM5Njg5M15BMl5BanBnXkFtZTYwMzA0ODI3._V1_SX300.jpg', 'Noah ve Allie\'nin yasak aşkı ve ayrılık sonrası yeniden buluşmaları. Duygusal bir aşk hikayesi.', 'Nick Cassavetes', 'Ryan Gosling, Rachel McAdams, James Garner', 'Romantik, Dram', 'ABD', 'https://www.youtube.com/embed/BjJcYdEOI0', 'Romantik', '2025-07-29 11:34:31', 0),
(37, 'La La Land', 2016, '128 dk', 8.0, 'https://m.media-amazon.com/images/M/MV5BMzUzNDM2NzM2MV5BMl5BanBnXkFtZTgwNTM3NTg4OTE@._V1_SX300.jpg', 'Mia ve Sebastian\'ın Los Angeles\'ta aşk ve kariyer arasında yaşadığı mücadele. Müzikal romantik komedi.', 'Damien Chazelle', 'Ryan Gosling, Emma Stone, John Legend', 'Romantik, Müzikal', 'ABD', 'https://www.youtube.com/embed/0pdqf4P9MB8', 'Romantik', '2025-07-29 11:34:31', 0),
(38, 'Eternal Sunshine of the Spotless Mind', 2004, '108 dk', 8.3, 'https://m.media-amazon.com/images/M/MV5BYzE2MzI2NTUtMmFlNS00ZTY5LTkxOTgtODVmZDc4ODhkMWM0XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 'Joel ve Clementine\'in aşk anılarını silme kararı ve sonrasında yaşadıkları. Bilim kurgu romantik film.', 'Michel Gondry', 'Jim Carrey, Kate Winslet, Kirsten Dunst', 'Romantik, Bilim Kurgu', 'ABD', 'https://www.youtube.com/embed/6MUcuqbGTxc', 'Romantik', '2025-07-29 11:34:31', 0),
(39, 'Before Sunrise', 1995, '101 dk', 8.1, 'https://m.media-amazon.com/images/M/MV5BZDZhZmI1ZTUtYWI3NC00NTMwLTk3NWMtNDc0OGNjM2I0ZjlmXkEyXkFqcGc@._V1_.jpg', 'Viyana\'da tanışan Jesse ve Celine\'in bir gece boyunca yaşadığı romantik macera. Derin sohbetler ve aşk.', 'Richard Linklater', 'Ethan Hawke, Julie Delpy, Andrea Eckert', 'Romantik, Dram', 'ABD, Avusturya', 'https://www.youtube.com/embed/9v6X-Dytlko', 'Romantik', '2025-07-29 11:34:31', 0),
(40, '500 Days of Summer', 2009, '95 dk', 7.7, 'https://m.media-amazon.com/images/M/MV5BMTk5MjM4OTU1OV5BMl5BanBnXkFtZTcwODkzNDIzMw@@._V1_SX300.jpg', 'Tom ve Summer\'ın 500 günlük ilişkisinin kronolojik olmayan anlatımı. Gerçekçi aşk hikayesi.', 'Marc Webb', 'Joseph Gordon-Levitt, Zooey Deschanel, Geoffrey Arend', 'Romantik, Komedi', 'ABD', 'https://www.youtube.com/embed/PsD0NpFSADM', 'Romantik', '2025-07-29 11:34:31', 0),
(41, 'Amélie', 2001, '122 dk', 8.3, 'https://m.media-amazon.com/images/M/MV5BOTNmYzY0MWQtZGZmNy00Y2Y4LWFmMDQtMTZjYTdiYzEwZGQ2XkEyXkFqcGc@._V1_.jpg', 'Amélie\'nin Paris\'te insanların hayatlarını iyileştirme çabası ve kendi aşkını bulma macerası.', 'Jean-Pierre Jeunet', 'Audrey Tautou, Mathieu Kassovitz, Rufus', 'Romantik, Komedi', 'Fransa', 'https://www.youtube.com/embed/HUECWi5pX7o', 'Romantik', '2025-07-29 11:34:31', 0),
(42, 'The Shining', 1980, '146 dk', 8.4, 'https://m.media-amazon.com/images/M/MV5BZWFlYmY2MGEtZjVkYS00YzU4LTg0YjQtYzY1ZGE3NTA5NGQxXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg', 'Overlook Hotel\'de kış bekçisi olarak çalışan Jack Torrance\'ın giderek çılgınlaşması. Psikolojik korku.', 'Stanley Kubrick', 'Jack Nicholson, Shelley Duvall, Danny Lloyd', 'Korku, Gerilim', 'ABD, İngiltere', 'https://www.youtube.com/embed/S014oGZiSdI', 'Korku', '2025-07-29 11:35:02', 0),
(43, 'A Nightmare on Elm Street', 1984, '91 dk', 7.4, 'https://s3.amazonaws.com/nightjarprod/content/uploads/sites/192/2021/10/29134017/wGTpGGRMZmyFCcrY2YoxVTIBlli-683x1024.jpg', 'Freddy Krueger\'ın rüyalarda gençleri öldürme hikayesi. Klasik slasher film ve korku ikonu.', 'Wes Craven', 'Heather Langenkamp, Johnny Depp, Robert Englund', 'Korku, Gerilim', 'ABD', 'https://www.youtube.com/embed/dCVh4lBfW-c', 'Korku', '2025-07-29 11:35:02', 0),
(44, 'The Exorcist', 1973, '122 dk', 8.0, 'https://m.media-amazon.com/images/M/MV5BZjg3YjE4ZjAtYTdmYS00ZTBkLWE1ZjgtNzAzODUwNzRiYjlmXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 'Regan\'ın şeytan tarafından ele geçirilmesi ve rahiplerin onu kurtarma mücadelesi. Klasik korku filmi.', 'William Friedkin', 'Ellen Burstyn, Max von Sydow, Linda Blair', 'Korku, Dram', 'ABD', 'https://www.youtube.com/embed/YDGw1MTEe9k', 'Korku', '2025-07-29 11:35:02', 0),
(45, 'Halloween', 1978, '91 dk', 7.7, 'https://upload.wikimedia.org/wikipedia/en/thumb/a/af/Halloween_%281978%29_theatrical_poster.jpg/250px-Halloween_%281978%29_theatrical_poster.jpg', 'Michael Myers\'ın Halloween gecesi Haddonfield\'a dönmesi ve terör estirmesi. Slasher film türünün başlangıcı.', 'John Carpenter', 'Donald Pleasence, Jamie Lee Curtis, Tony Moran', 'Korku, Gerilim', 'ABD', 'https://www.youtube.com/embed/ek1ePFp-nBI', 'Korku', '2025-07-29 11:35:02', 0),
(46, 'The Silence of the Lambs', 1991, '118 dk', 8.6, 'https://m.media-amazon.com/images/M/MV5BNjNhZTk0ZmEtNjJhMi00YzFlLWE1MmEtYzM1M2ZmMGMwMTU4XkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_SX300.jpg', 'Clarice Starling\'in seri katil Buffalo Bill\'i yakalamak için Hannibal Lecter\'dan yardım alması.', 'Jonathan Demme', 'Jodie Foster, Anthony Hopkins, Scott Glenn', 'Korku, Gerilim', 'ABD', 'https://www.youtube.com/embed/6iB21hsprAQ', 'Korku', '2025-07-29 11:35:02', 0),
(47, 'Get Out', 2017, '104 dk', 7.7, 'https://m.media-amazon.com/images/M/MV5BMjUxMDQwNjcyNl5BMl5BanBnXkFtZTgwNzcwMzc0MTI@._V1_.jpg', 'Chris\'in beyaz arkadaşının ailesiyle tanışmaya gittiğinde yaşadığı korkunç olaylar. Sosyal korku filmi.', 'Jordan Peele', 'Daniel Kaluuya, Allison Williams, Bradley Whitford', 'Korku, Gerilim', 'ABD', 'https://www.youtube.com/embed/DzfpyUB60YY', 'Korku', '2025-07-29 11:35:02', 0),
(48, 'Se7en', 1995, '127 dk', 8.6, 'https://m.media-amazon.com/images/S/pv-target-images/9a1f76c8ebf47d788ae303713f73a7afd6576142d4292a7008e2657f266f824c.jpg', 'İki dedektifin yedi ölümcül günah temalı cinayetleri çözme mücadelesi. Karanlık ve gerilim dolu.', 'David Fincher', 'Morgan Freeman, Brad Pitt, Kevin Spacey', 'Gerilim, Suç', 'ABD', 'https://www.youtube.com/embed/znmZoVkCjpI', 'Gerilim', '2025-07-29 11:36:17', 0),
(49, 'Gone Girl', 2014, '149 dk', 8.1, 'https://m.media-amazon.com/images/M/MV5BMTk0MDQ3MzAzOV5BMl5BanBnXkFtZTgwNzU1NzE3MjE@._V1_SX300.jpg', 'Nick Dunne\'ın karısının kaybolması ve medyanın onu şüpheli haline getirmesi. Psikolojik gerilim.', 'David Fincher', 'Ben Affleck, Rosamund Pike, Neil Patrick Harris', 'Gerilim, Dram', 'ABD', 'https://www.youtube.com/embed/2-_-1nJf8Vg', 'Gerilim', '2025-07-29 11:36:17', 0),
(50, 'Zodiac', 2007, '157 dk', 7.7, 'https://m.media-amazon.com/images/I/91gYQOSys6L._UF894,1000_QL80_.jpg', 'Zodiac katilinin gerçek hikayesi. Gazeteciler ve polislerin katili bulma mücadelesi.', 'David Fincher', 'Jake Gyllenhaal, Mark Ruffalo, Robert Downey Jr.', 'Gerilim, Suç', 'ABD', 'https://www.youtube.com/embed/yNncHPl1UXg', 'Gerilim', '2025-07-29 11:36:17', 0),
(51, 'Memento', 2000, '113 dk', 8.4, 'https://m.media-amazon.com/images/M/MV5BZTcyNjk1MjgtOWI3Mi00YzQwLWI5MTktMzY4ZmI2NDAyNzYzXkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_SX300.jpg', 'Kısa süreli hafıza kaybı olan Leonard\'ın karısının katilini bulma çabası. Ters kronolojik anlatım.', 'Christopher Nolan', 'Guy Pearce, Carrie-Anne Moss, Joe Pantoliano', 'Gerilim, Suç', 'ABD', 'https://www.youtube.com/embed/0vS0E9bBSL0', 'Gerilim', '2025-07-29 11:36:17', 0),
(52, 'The Usual Suspects', 1995, '106 dk', 8.5, 'https://m.media-amazon.com/images/M/MV5BYTViNjMyNmUtNDFkNC00ZDRlLThmMDUtZDU2YWE4NGI2ZjVmXkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_SX300.jpg', 'Beş suçlunun bir araya gelmesi ve Keyser Söze\'nin kimliğini çözme mücadelesi. Klasik gerilim.', 'Bryan Singer', 'Kevin Spacey, Gabriel Byrne, Chazz Palminteri', 'Gerilim, Suç', 'ABD, Almanya', 'https://www.youtube.com/embed/oiXdPolca5w', 'Gerilim', '2025-07-29 11:36:17', 0),
(53, 'Prisoners', 2013, '153 dk', 8.1, 'https://m.media-amazon.com/images/M/MV5BMTg0NTIzMjQ1NV5BMl5BanBnXkFtZTcwNDc3MzM5OQ@@._V1_SX300.jpg', 'İki kızın kaçırılması ve babalarının adaleti kendi ellerine alma kararı. Ahlaki ikilemler.', 'Denis Villeneuve', 'Hugh Jackman, Jake Gyllenhaal, Viola Davis', 'Gerilim, Suç', 'ABD', 'https://www.youtube.com/embed/bpXfcTF6iVk\\', 'Gerilim', '2025-07-29 11:36:17', 0),
(54, 'Inception', 2010, '148 dk', 8.8, 'https://m.media-amazon.com/images/M/MV5BMjAxMzY3NjcxNF5BMl5BanBnXkFtZTcwNTI5OTM0Mw@@._V1_SX300.jpg', 'Rüya içinde rüya konseptiyle bilgi çalma işlemi. Cobb ve ekibinin karmaşık görevi.', 'Christopher Nolan', 'Leonardo DiCaprio, Joseph Gordon-Levitt, Ellen Page', 'Bilim Kurgu, Aksiyon', 'ABD, İngiltere', 'https://www.youtube.com/embed/YoHD9XEInc0', 'Bilim Kurgu', '2025-07-29 11:38:08', 0),
(55, 'Interstellar', 2014, '169 dk', 8.6, 'https://m.media-amazon.com/images/M/MV5BZjdkOTU3MDktN2IxOS00OGEyLWFmMjktY2FiMmZkNWIyODZiXkEyXkFqcGdeQXVyMTMxODk2OTU@._V1_SX300.jpg', 'Cooper\'ın insanlığı kurtarmak için uzay yolculuğuna çıkması. Zaman, yerçekimi ve aşk teması.', 'Christopher Nolan', 'Matthew McConaughey, Anne Hathaway, Jessica Chastain', 'Bilim Kurgu, Dram', 'ABD, İngiltere', 'https://www.youtube.com/embed/2LqzF5WauAw', 'Bilim Kurgu', '2025-07-29 11:38:08', 0),
(56, 'Blade Runner 2049', 2017, '164 dk', 8.0, 'https://m.media-amazon.com/images/M/MV5BNzA1Njg4NzYxOV5BMl5BanBnXkFtZTgwODk5NjU3MzI@._V1_SX300.jpg', 'K\'nin replikant geçmişini araştırması ve gizli bir sırrı ortaya çıkarması. Neo-noir bilim kurgu.', 'Denis Villeneuve', 'Ryan Gosling, Harrison Ford, Ana de Armas', 'Bilim Kurgu, Aksiyon', 'ABD, İngiltere', 'https://www.youtube.com/embed/gCcx85zbxz4', 'Bilim Kurgu', '2025-07-29 11:38:08', 0),
(57, 'Arrival', 2016, '116 dk', 7.9, 'https://m.media-amazon.com/images/M/MV5BMTExMzU0ODcxNDheQTJeQWpwZ15BbWU4MDE1OTI4MzAy._V1_SX300.jpg', 'Uzaylıların dünyaya gelmesi ve dilbilimci Louise\'in onlarla iletişim kurma çabası.', 'Denis Villeneuve', 'Amy Adams, Jeremy Renner, Forest Whitaker', 'Bilim Kurgu, Dram', 'ABD', 'https://www.youtube.com/embed/tFMo3UJ4B4g', 'Bilim Kurgu', '2025-07-29 11:38:08', 0),
(58, 'Ex Machina', 2014, '108 dk', 7.7, 'https://m.media-amazon.com/images/M/MV5BMTUxNzc0OTIxMV5BMl5BanBnXkFtZTgwNDI3NzU2NDE@._V1_FMjpg_UX1000_.jpg', 'Programcı Caleb\'in yapay zeka testi için uzak bir laboratuvara gitmesi. Turing testi ve ahlak.', 'Alex Garland', 'Domhnall Gleeson, Alicia Vikander, Oscar Isaac', 'Bilim Kurgu, Gerilim', 'İngiltere', 'https://www.youtube.com/embed/fquzEZLAGDg', 'Bilim Kurgu', '2025-07-29 11:38:08', 0),
(59, 'Her', 2013, '126 dk', 8.0, 'https://m.media-amazon.com/images/M/MV5BMjA1Nzk0OTM2OF5BMl5BanBnXkFtZTgwNjU2NjEwMDE@._V1_SX300.jpg', 'Theodore\'un yapay zeka işletim sistemi Samantha ile aşk yaşaması. Modern aşk ve teknoloji.', 'Spike Jonze', 'Joaquin Phoenix, Amy Adams, Scarlett Johansson', 'Bilim Kurgu, Romantik', 'ABD', 'https://www.youtube.com/embed/dJTU48_yghs', 'Bilim Kurgu', '2025-07-29 11:38:08', 0),
(60, 'The Lord of the Rings: The Return of the King', 2003, '201 dk', 8.9, 'https://m.media-amazon.com/images/M/MV5BNzA5ZDNlZWMtM2NhNS00NDJjLTk4NDItYTRmY2EwMWZlMTY3XkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SX300.jpg', 'Frodo\'nun Yüzük\'ü yok etme görevi ve Orta Dünya\'nın kaderi. Epik fantastik macera.', 'Peter Jackson', 'Elijah Wood, Viggo Mortensen, Ian McKellen', 'Fantastik, Macera', 'ABD, Yeni Zelanda', 'https://www.youtube.com/embed/r5X-hFf6Bwo', 'Fantastik', '2025-07-29 11:39:11', 0),
(61, 'Pan\'s Labyrinth', 2006, '118 dk', 8.2, 'https://m.media-amazon.com/images/M/MV5BOTc1NTAxMWItMWFlNy00MmU2LTkwMTMtNzMwOTg5OTQ5YTFiXkEyXkFqcGc@._V1_.jpg', 'Ofelia\'nın fantastik dünyada yaşadığı maceralar. Gerçek dünya ile masal dünyasının kesişimi.', 'Guillermo del Toro', 'Ivana Baquero, Ariadna Gil, Sergi López', 'Fantastik, Dram', 'İspanya, Meksika', 'https://www.youtube.com/embed/E7XGNPXdlGQ', 'Fantastik', '2025-07-29 11:39:11', 0),
(62, 'The Princess Bride', 1987, '98 dk', 8.0, 'https://m.media-amazon.com/images/M/MV5BMGM4M2Q5N2MtNThkZS00NTc1LTk1NTItNWEyZjJjNDRmNDk5XkEyXkFqcGdeQXVyMjA0MDQ0Mjc@._V1_SX300.jpg', 'Prenses Buttercup\'ı kurtarmak için çıktığı yolculukta Westley\'in yaşadığı maceralar.', 'Rob Reiner', 'Cary Elwes, Robin Wright, Mandy Patinkin', 'Fantastik, Romantik', 'ABD', 'https://www.youtube.com/embed/WNNUcHRiPS8', 'Fantastik', '2025-07-29 11:39:11', 0),
(63, 'Stardust', 2007, '127 dk', 7.6, 'https://m.media-amazon.com/images/I/91eaYQC7jAL._UF1000,1000_QL80_.jpg', 'Tristan\'ın yıldızdan yapılmış bir kızı bulmak için fantastik dünyaya yolculuğu.', 'Matthew Vaughn', 'Charlie Cox, Claire Danes, Michelle Pfeiffer', 'Fantastik, Romantik', 'ABD, İngiltere', 'https://www.youtube.com/embed/VfYBKDyF-Dk', 'Fantastik', '2025-07-29 11:39:11', 0),
(64, 'The NeverEnding Story', 1984, '102 dk', 7.4, 'https://m.media-amazon.com/images/M/MV5BNzk4NmJkNzgtMDdiNy00OTJkLWE2ODItZGVhNTMzZmQ1NzdmXkEyXkFqcGc@._V1_.jpg', 'Bastian\'ın Fantasia dünyasını kurtarmak için okuduğu kitabın içine girmesi.', 'Wolfgang Petersen', 'Barret Oliver, Noah Hathaway, Tami Stronach', 'Fantastik, Macera', 'Almanya, ABD', 'https://www.youtube.com/embed/IN02NqddSCk', 'Fantastik', '2025-07-29 11:39:11', 0),
(65, 'Big Fish', 2003, '125 dk', 8.0, 'https://upload.wikimedia.org/wikipedia/en/thumb/4/41/Big_Fish_movie_poster.png/250px-Big_Fish_movie_poster.png', 'Edward Bloom\'un oğluna anlattığı fantastik hayat hikayeleri. Gerçek ve hayal arasındaki çizgi.', 'Tim Burton', 'Ewan McGregor, Albert Finney, Billy Crudup', 'Fantastik, Dram', 'ABD', 'https://www.youtube.com/embed/iyVoCcxZGWs', 'Fantastik', '2025-07-29 11:39:11', 0),
(66, 'Spirited Away', 2001, '125 dk', 8.6, 'https://m.media-amazon.com/images/M/MV5BMjlmZmI5MDctNDE2YS00YWE0LWE5ZWItZDBhYWQ0NTcxNWRhXkEyXkFqcGdeQXVyMTMxODk2OTU@._V1_SX300.jpg', 'Chihiro\'nun büyülü dünyada yaşadığı maceralar. Japon animasyonunun başyapıtı.', 'Hayao Miyazaki', 'Rumi Hiiragi, Miyu Irino, Mari Natsuki', 'Animasyon, Fantastik', 'Japonya', 'https://www.youtube.com/embed/ByXuk9QqQkk', 'Animasyon', '2025-07-29 11:39:56', 0),
(67, 'Toy Story 3', 2010, '103 dk', 8.3, 'https://m.media-amazon.com/images/M/MV5BMTgxOTY4Mjc0MF5BMl5BanBnXkFtZTcwNTA4MDQyMw@@._V1_SX300.jpg', 'Oyuncakların sahipleri büyüdüğünde yaşadıkları duygusal macera. Dostluk ve ayrılık teması.', 'Lee Unkrich', 'Tom Hanks, Tim Allen, Joan Cusack', 'Animasyon, Macera', 'ABD', 'https://www.youtube.com/embed/wTy-MSfC8tA', 'Animasyon', '2025-07-29 11:39:56', 0),
(68, 'Up', 2009, '96 dk', 8.2, 'https://upload.wikimedia.org/wikipedia/en/0/05/Up_%282009_film%29.jpg', 'Carl Fredricksen\'in evini balonlarla uçurarak macera araması. Duygusal ve komik animasyon.', 'Pete Docter', 'Edward Asner, Jordan Nagai, John Ratzenberger', 'Animasyon, Macera', 'ABD', 'https://www.youtube.com/embed/qas5lWp7_R0', 'Animasyon', '2025-07-29 11:39:56', 0),
(69, 'The Lion King', 1994, '88 dk', 8.5, 'https://m.media-amazon.com/images/M/MV5BYTYxNGMyZTYtMjE3MS00MzNjLWFjNmYtMDk3N2FmM2JiM2M1XkEyXkFqcGdeQXVyNjY5NDU4NzI@._V1_SX300.jpg', 'Simba\'nın krallığını geri alma mücadelesi. Klasik Disney animasyonu.', 'Roger Allers, Rob Minkoff', 'Matthew Broderick, Jeremy Irons, James Earl Jones', 'Animasyon, Macera', 'ABD', 'https://www.youtube.com/embed/4sj1MT05lAA', 'Animasyon', '2025-07-29 11:39:56', 0),
(70, 'Spider-Man: Into the Spider-Verse', 2018, '117 dk', 8.4, 'https://m.media-amazon.com/images/M/MV5BMjMwNDkxMTgzOF5BMl5BanBnXkFtZTgwNTkwNTQ3NjM@._V1_SX300.jpg', 'Miles Morales\'in Spider-Man olma yolculuğu. Çoklu evren konsepti ve yenilikçi animasyon.', 'Bob Persichetti, Peter Ramsey, Rodney Rothman', 'Shameik Moore, Jake Johnson, Hailee Steinfeld', 'Animasyon, Aksiyon', 'ABD', 'https://www.youtube.com/embed/g4Hbz2jLxvQ', 'Animasyon', '2025-07-29 11:39:56', 0),
(71, 'Coco', 2017, '105 dk', 8.4, 'https://kocaelipsikolojievi.com/wp-content/uploads/2024/04/coco.jpg', 'Miguel\'in Ölüler Diyarı\'nda yaşadığı macera. Meksika kültürü ve aile teması.', 'Lee Unkrich, Adrian Molina', 'Anthony Gonzalez, Gael García Bernal, Benjamin Bratt', 'Animasyon, Macera', 'ABD', 'https://www.youtube.com/embed/Rvr68u6k5sI', 'Animasyon', '2025-07-29 11:39:56', 0),
(72, 'Planet Earth II', 2016, '360 dk', 9.5, 'https://m.media-amazon.com/images/M/MV5BMzY4NDBkMWYtYzdkYy00YzBjLWJmODctMWM4YjYzZTdjNWE5XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 'Dünya\'nın en muhteşem doğal ortamlarının keşfi. Yüksek çözünürlüklü görüntülerle doğa belgeseli.', 'David Attenborough', 'David Attenborough', 'Belgesel, Doğa', 'İngiltere', 'https://www.youtube.com/embed/c8aFcHFu8QM', 'Belgesel', '2025-07-29 11:40:37', 0),
(73, 'The Last Dance', 2020, '600 dk', 9.1, 'https://m.media-amazon.com/images/M/MV5BY2U1ZTU4OWItNGU2MC00MTg1LTk4NzUtYTk3ODhjYjI0MzlmXkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_SX300.jpg', 'Michael Jordan ve Chicago Bulls\'un 1997-98 sezonundaki son şampiyonluk yolculuğu.', 'Jason Hehir', 'Michael Jordan, Scottie Pippen, Dennis Rodman', 'Belgesel, Spor', 'ABD', 'https://www.youtube.com/embed/N9Z9JtNcCWY', 'Belgesel', '2025-07-29 11:40:37', 0),
(74, 'Free Solo', 2018, '100 dk', 8.1, 'https://m.media-amazon.com/images/M/MV5BMjA2YTAxMzMtNzA2Mi00NTcyLTg4NzUtODIxYzFiYzdiNWNlXkEyXkFqcGc@._V1_.jpg', 'Alex Honnold\'un El Capitan\'ı ip kullanmadan tırmanma denemesi. Tehlikeli spor belgeseli.', 'Elizabeth Chai Vasarhelyi, Jimmy Chin', 'Alex Honnold, Tommy Caldwell, Jimmy Chin', 'Belgesel, Spor', 'ABD', 'https://www.youtube.com/embed/urRVZ4SW7WU', 'Belgesel', '2025-07-29 11:40:37', 0),
(75, 'Won\'t You Be My Neighbor?', 2018, '94 dk', 8.3, 'https://m.media-amazon.com/images/M/MV5BZWU5ZjJkNTQtMzQwOS00ZGE4LWJkMWUtMGQ5YjdiM2FhYmRhXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 'Fred Rogers\'ın Mister Rogers\' Neighborhood programının arkasındaki hikaye.', 'Morgan Neville', 'Fred Rogers, Joanne Rogers, Yo-Yo Ma', 'Belgesel, Biyografi', 'ABD', 'https://www.youtube.com/embed/FhwktRDG_aQ', 'Belgesel', '2025-07-29 11:40:37', 0),
(76, 'My Octopus Teacher', 2020, '85 dk', 8.1, 'https://m.media-amazon.com/images/M/MV5BYWU5OGMxYjktMWY5Ny00NDJhLTgwMDktNjVmMTExZGIyODljXkEyXkFqcGc@._V1_.jpg', 'Craig Foster\'ın bir ahtapotla geliştirdiği dostluk. Doğa ve insan bağlantısı.', 'Pippa Ehrlich, James Reed', 'Craig Foster, Tom Foster', 'Belgesel, Doğa', 'Güney Afrika', 'https://www.youtube.com/embed/eReZr2VRCVE', 'Belgesel', '2025-07-29 11:40:37', 0),
(77, 'The Act of Killing', 2012, '115 dk', 8.2, 'https://m.media-amazon.com/images/S/pv-target-images/cb78a0c078369a1b45956ce379de226593c1e02b65746eac4d1c5330adb6ce31.jpg', 'Endonezya\'daki katliamların faillerinin kendi suçlarını yeniden canlandırması.', 'Joshua Oppenheimer', 'Anwar Congo, Herman Koto, Syamsul Arifin', 'Belgesel, Tarih', 'Danimarka, Norveç', 'https://www.youtube.com/embed/Q3FcB1UZHlg', 'Belgesel', '2025-07-29 11:40:37', 0),
(78, 'The Godfather', 1972, '175 dk', 9.2, 'https://m.media-amazon.com/images/M/MV5BM2MyNjYxNmUtYTAwNi00MTYxLWJmNWYtYzZlODY3ZTk3OTFlXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SX300.jpg', 'Corleone ailesinin mafya dünyasındaki yaşamı. Aile bağları, güç mücadelesi ve suç dünyasının gerçekleri.', 'Francis Ford Coppola', 'Marlon Brando, Al Pacino, James Caan', 'Suç, Dram', 'ABD', 'https://www.youtube.com/embed/sY1S34973zA', 'Suç / Polisiye', '2025-07-29 11:41:21', 0),
(79, 'Goodfellas', 1990, '146 dk', 8.7, 'https://m.media-amazon.com/images/M/MV5BY2NkZjEzMDgtN2RjYy00YzM1LWI4ZmQtMjIwYjFjNmI3ZGEwXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SX300.jpg', 'Henry Hill\'in mafya dünyasındaki yükselişi ve düşüşü. Gerçek hikayeden uyarlanan suç filmi.', 'Martin Scorsese', 'Robert De Niro, Ray Liotta, Joe Pesci', 'Suç, Dram', 'ABD', 'https://www.youtube.com/embed/qo5jJpHtI1Y', 'Suç / Polisiye', '2025-07-29 11:41:21', 0),
(80, 'Pulp Fiction', 1994, '154 dk', 8.9, 'https://m.media-amazon.com/images/M/MV5BNGNhMDIzZTUtNTBlZi00MTRlLWFjM2ItYzViMjE3YzI5MjljXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SX300.jpg', 'Los Angeles suç dünyasından birbirine bağlı hikayeler. Kült film ve suç komedisi.', 'Quentin Tarantino', 'John Travolta, Uma Thurman, Samuel L. Jackson', 'Suç, Dram', 'ABD', 'https://www.youtube.com/embed/s7EdQ4FqbhY', 'Suç / Polisiye', '2025-07-29 11:41:21', 0),
(81, 'The Departed', 2006, '151 dk', 8.5, 'https://m.media-amazon.com/images/M/MV5BMTI1MTY2OTIxNV5BMl5BanBnXkFtZTYwNjQ4NjY3._V1_SX300.jpg', 'Boston polis departmanında çifte ajanların mücadelesi. Gerilim dolu suç filmi.', 'Martin Scorsese', 'Leonardo DiCaprio, Matt Damon, Jack Nicholson', 'Suç, Gerilim', 'ABD', 'https://www.youtube.com/embed/auYbpnEwBBg', 'Suç / Polisiye', '2025-07-29 11:41:21', 0),
(82, 'Heat', 1995, '170 dk', 8.2, 'https://m.media-amazon.com/images/M/MV5BMTkxYjU1OTMtYWViZC00ZjAzLWI3MDktZGQ2N2VmMjVjNDRlXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 'Neil McCauley ve Vincent Hanna arasındaki kedi-fare oyunu. Profesyonel suç ve polis mücadelesi.', 'Michael Mann', 'Al Pacino, Robert De Niro, Val Kilmer', 'Suç, Aksiyon', 'ABD', 'https://www.youtube.com/embed/PpAhjOvQVj0', 'Suç / Polisiye', '2025-07-29 11:41:21', 0),
(83, 'L.A. Confidential', 1997, '138 dk', 8.2, 'https://play-lh.googleusercontent.com/vIKfbRgzh8ir-vBOVWqgD3DOvZEr0nobBd40km9R1Ihvasqffom1ORG-la3wg3gft4FLtA', '1950\'ler Los Angeles\'ında polis departmanındaki yolsuzluk ve cinayetler. Neo-noir suç filmi.', 'Curtis Hanson', 'Kevin Spacey, Russell Crowe, Guy Pearce', 'Suç, Dram', 'ABD', 'https://www.youtube.com/embed/6sOXrY5yV4g', 'Suç / Polisiye', '2025-07-29 11:41:21', 0),
(84, 'Saving Private Ryan', 1998, '169 dk', 8.6, 'https://m.media-amazon.com/images/M/MV5BZjhkMDM4MWItZTVjOC00ZDRhLThmYTAtM2I5NzBmNmNlMzI1XkEyXkFqcGdeQXVyNDYyMDk5MTU@._V1_SX300.jpg', 'II. Dünya Savaşı\'nda Ryan kardeşi kurtarmak için görevlendirilen askerlerin mücadelesi.', 'Steven Spielberg', 'Tom Hanks, Matt Damon, Tom Sizemore', 'Savaş, Dram', 'ABD', 'https://www.youtube.com/embed/9CiW_DgxCnQ', 'Savaş', '2025-07-29 11:41:50', 0),
(85, 'Apocalypse Now', 1979, '147 dk', 8.4, 'https://resizing.flixster.com/-XZAfHZM39UwaGJIFWKAE8fS0ak=/v3/t/assets/p5545_p_v13_at.jpg', 'Vietnam Savaşı\'nda Kurtz\'u bulmak için görevlendirilen kaptanın yolculuğu.', 'Francis Ford Coppola', 'Marlon Brando, Martin Sheen, Robert Duvall', 'Savaş, Dram', 'ABD', 'https://www.youtube.com/embed/FTjG-Aux_yQ', 'Savaş', '2025-07-29 11:41:50', 0),
(86, 'Full Metal Jacket', 1987, '116 dk', 8.3, 'https://m.media-amazon.com/images/M/MV5BNzkxODk0NjEtYjc4Mi00ZDI0LTgyYjEtYzc1NDkxY2YzYTgyXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SX300.jpg', 'Vietnam Savaşı\'nda askerlerin eğitimi ve savaş alanındaki deneyimleri.', 'Stanley Kubrick', 'Matthew Modine, R. Lee Ermey, Vincent D\'Onofrio', 'Savaş, Dram', 'ABD, İngiltere', 'https://www.youtube.com/embed/n2i917l5RFc', 'Savaş', '2025-07-29 11:41:50', 0),
(87, 'Dunkirk', 2017, '106 dk', 7.8, 'https://ipa.org.au/wp-content/uploads/2019/01/dunkirk.png', 'II. Dünya Savaşı\'nda Dunkirk tahliyesi. Kara, deniz ve hava perspektifinden anlatım.', 'Christopher Nolan', 'Fionn Whitehead, Barry Keoghan, Mark Rylance', 'Savaş, Aksiyon', 'ABD, İngiltere', 'https://www.youtube.com/embed/F-eMt3SrfFU', 'Savaş', '2025-07-29 11:41:50', 0),
(88, '1917', 2019, '119 dk', 8.3, 'https://m.media-amazon.com/images/M/MV5BYzkxZjg2NDQtMGVjMy00NWZkLTk0ZDEtZWE3NDYwYjAyMTg1XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 'I. Dünya Savaşı\'nda iki askerin hayat kurtarmak için tehlikeli görevi.', 'Sam Mendes', 'George MacKay, Dean-Charles Chapman, Mark Strong', 'Savaş, Aksiyon', 'ABD, İngiltere', 'https://www.youtube.com/embed/YqNYrYUiMfg', 'Savaş', '2025-07-29 11:41:50', 0),
(89, 'Platoon', 1986, '120 dk', 8.1, 'https://upload.wikimedia.org/wikipedia/tr/0/05/Platoon_afis.jpg', 'Vietnam Savaşı\'nda genç askerin deneyimleri ve savaşın gerçek yüzü.', 'Oliver Stone', 'Charlie Sheen, Tom Berenger, Willem Dafoe', 'Savaş, Dram', 'ABD', 'https://www.youtube.com/embed/R8weLPF4qBQ', 'Savaş', '2025-07-29 11:41:50', 0),
(90, 'Babam ve Oğlum', 2005, '112 dk', 8.3, 'https://upload.wikimedia.org/wikipedia/tr/e/e5/Babam_ve_O%C4%9Flum.jpg', 'Sadık\'ın babasıyla olan ilişkisi ve aile bağlarının önemi. Duygusal Türk filmi.', 'Çağan Irmak', 'Fikret Kuşkan, Çetin Tekindor, Hümeyra', 'Dram, Aile', 'Türkiye', 'https://www.youtube.com/embed/k0fzRVX_ptM', 'Yerli', '2025-07-29 11:42:09', 0),
(91, 'Recep İvedik', 2008, '90 dk', 6.8, 'https://www.hdfilmcehennemi.ltd/wp-content/uploads/2023/11/recep-ivedik-2008-izle.webp', 'Recep İvedik\'in komik maceraları ve toplumsal olaylara bakış açısı.', 'Togan Gökbakar', 'Şahan Gökbakar, Nurullah Çelebi, Ahmet Mümtaz Taylan', 'Komedi', 'Türkiye', 'https://www.youtube.com/embed/ite5gbn55TQ', 'Yerli', '2025-07-29 11:42:09', 0),
(92, 'Kurtlar Vadisi: Irak', 2006, '122 dk', 6.5, 'https://upload.wikimedia.org/wikipedia/tr/thumb/b/b1/Kurtlar_Vadisi_Irak.jpg/250px-Kurtlar_Vadisi_Irak.jpg', 'Polat Alemdar\'ın Irak\'taki maceraları. Aksiyon ve gerilim dolu Türk filmi.', 'Serdar Akar', 'Necati Şaşmaz, Gürkan Uygun, Kenan Çoban', 'Aksiyon, Gerilim', 'Türkiye', 'https://www.youtube.com/embed/rmsHO9puwD0', 'Yerli', '2025-07-29 11:42:09', 0),
(93, 'Ayla', 2017, '124 dk', 7.8, 'https://upload.wikimedia.org/wikipedia/tr/thumb/6/69/Ayla_Film_Afi%C5%9Fi.jpg/250px-Ayla_Film_Afi%C5%9Fi.jpg', 'Kore Savaşı\'nda Türk askeri ile Koreli kız çocuğu arasındaki dostluk.', 'Can Ulkay', 'Çetin Tekindor, İsmail Hacıoğlu, Kyung-jin Lee', 'Dram, Savaş', 'Türkiye', 'https://www.youtube.com/embed/8PELOIYaEiw', 'Yerli', '2025-07-29 11:42:09', 0),
(94, 'Mucize', 2015, '137 dk', 8.1, 'https://play-lh.googleusercontent.com/ya7GuQ-0udmrWtF06zJmFIzX9TYG_oEyTuhsQ87DJEgX0stDJsvAHPcE0Tx5sCtTvun4-Q', 'Mahir\'in köy okulunda öğretmenlik yapması ve öğrencilerle yaşadığı deneyimler.', 'Mahsun Kırmızıgül', 'Mahsun Kırmızıgül, Mert Fırat, Talat Bulut', 'Dram, Komedi', 'Türkiye', 'https://www.youtube.com/embed/CwQsmRDRdMc', 'Yerli', '2025-07-29 11:42:09', 0),
(95, 'Eşkıya', 1996, '128 dk', 8.3, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRQvsUVoArMZa3cMA8WHRRO7NPOFFXdNhRkMw&s', 'Barut\'un İstanbul\'a gelişi ve geçmişiyle yüzleşmesi. Klasik Türk sineması.', 'Yavuz Turgul', 'Şener Şen, Uğur Yücel, Yeşim Salkım', 'Dram, Suç', 'Türkiye', 'https://www.youtube.com/embed/WAZTmWj9jiM', 'Yerli', '2025-07-29 11:42:09', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `film_listeleri`
--

DROP TABLE IF EXISTS `film_listeleri`;
CREATE TABLE IF NOT EXISTS `film_listeleri` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'Benzersiz liste kimliği',
  `kullanici_id` int NOT NULL COMMENT 'Liste sahibi kullanıcı kimliği',
  `liste_adi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Liste adı',
  `aciklama` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Liste açıklaması',
  `gizli` tinyint(1) DEFAULT '0' COMMENT 'Liste gizli mi?',
  `film_sayisi` int DEFAULT '0' COMMENT 'Listedeki film sayısı',
  `begeni_sayisi` int DEFAULT '0' COMMENT 'Liste beğeni sayısı',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Liste oluşturma tarihi',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Son güncelleme tarihi',
  PRIMARY KEY (`id`),
  KEY `idx_kullanici_id` (`kullanici_id`),
  KEY `idx_gizli` (`gizli`),
  KEY `idx_created_at` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Film listeleri tablosu';

--
-- Tablo döküm verisi `film_listeleri`
--

INSERT INTO `film_listeleri` (`id`, `kullanici_id`, `liste_adi`, `aciklama`, `gizli`, `film_sayisi`, `begeni_sayisi`, `created_at`, `updated_at`) VALUES
(1, 104, 'En Sevdiğim Filmler', 'Tüm zamanların en sevdiğim filmleri', 0, 0, 0, '2025-08-18 10:54:38', '2025-08-18 10:54:38'),
(2, 104, 'İzleyeceklerim', 'Bu ay izlemeyi planladığım filmler', 0, 0, 0, '2025-08-18 10:54:38', '2025-08-18 10:54:38'),
(3, 104, 'Klasikler', 'Mutlaka izlenmesi gereken klasik filmler', 0, 0, 0, '2025-08-18 10:54:38', '2025-08-18 10:54:38'),
(4, 103, 'Aksiyon Filmleri', 'En iyi aksiyon filmleri listesi', 0, 0, 0, '2025-08-18 10:54:38', '2025-08-18 10:54:38');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `film_takip`
--

DROP TABLE IF EXISTS `film_takip`;
CREATE TABLE IF NOT EXISTS `film_takip` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `year` int DEFAULT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `poster` text,
  `rating` int DEFAULT '0',
  `review` text,
  `is_watched` tinyint(1) DEFAULT '0',
  `is_favorite` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_watchlist` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `film_takip`
--

INSERT INTO `film_takip` (`id`, `user_id`, `title`, `year`, `genre`, `poster`, `rating`, `review`, `is_watched`, `is_favorite`, `created_at`, `updated_at`, `is_watchlist`) VALUES
(1, 106, 'The Dark Knight', 2008, 'Aksiyon, Dram', 'https://m.media-amazon.com/images/M/MV5BMTMxNTMwODM0NF5BMl5BanBnXkFtZTcwODAyMTk2Mw@@._V1_SX300.jpg', 0, '', 0, 1, '2025-08-18 11:46:34', '2025-08-18 11:47:12', 0),
(4, 114, 'Jurassic Park', 1993, 'Macera, Bilim Kurgu', 'https://m.media-amazon.com/images/M/MV5BMjM2MDgxMDg0Nl5BMl5BanBnXkFtZTgwNTM2OTM5NDE@._V1_FMjpg_UX1000_.jpg', 0, '', 0, 0, '2025-08-18 13:45:36', '2025-08-18 13:45:48', 0),
(9, 114, 'The Dark Knight', 2008, 'Aksiyon, Dram', 'https://m.media-amazon.com/images/M/MV5BMTMxNTMwODM0NF5BMl5BanBnXkFtZTcwODAyMTk2Mw@@._V1_SX300.jpg', 0, '', 0, 1, '2025-08-18 14:35:01', '2025-08-18 14:35:01', 0),
(6, 114, 'The Matrix', 1999, 'Aksiyon, Bilim Kurgu', 'https://m.media-amazon.com/images/M/MV5BNzQzOTk3OTAtNDQ0Zi00ZTVkLWI0MTEtMDllZjNkYzNjNTc4L2ltYWdlXkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_SX300.jpg', 0, '', 0, 0, '2025-08-18 13:51:35', '2025-08-18 13:51:35', 0),
(7, 114, 'Die Hard', 1988, 'Aksiyon, Gerilim', 'https://media.posterlounge.com/img/products/710000/705263/705263_poster.jpg', 0, '', 0, 0, '2025-08-18 13:51:41', '2025-08-18 13:51:41', 0),
(8, 114, 'Mad Max: Fury Road', 2015, 'Aksiyon, Macera', 'https://m.media-amazon.com/images/M/MV5BN2EwM2I5OWMtMGQyMi00Zjg1LWJkNTctZTdjYTA4OGUwZjMyXkEyXkFqcGdeQXVyMTMxODk2OTU@._V1_SX300.jpg', 0, '', 0, 0, '2025-08-18 13:51:51', '2025-08-18 13:51:51', 0),
(12, 118, 'The Dark Knight', 2008, 'Aksiyon, Dram', 'https://m.media-amazon.com/images/M/MV5BMTMxNTMwODM0NF5BMl5BanBnXkFtZTcwODAyMTk2Mw@@._V1_SX300.jpg', 9, '', 1, 0, '2025-08-21 11:02:04', '2025-08-21 11:02:04', 0),
(13, 118, 'The Matrix', 1999, 'Aksiyon, Bilim Kurgu', 'https://m.media-amazon.com/images/M/MV5BNzQzOTk3OTAtNDQ0Zi00ZTVkLWI0MTEtMDllZjNkYzNjNTc4L2ltYWdlXkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_SX300.jpg', 9, '', 1, 0, '2025-08-21 11:02:07', '2025-08-21 11:02:07', 0),
(14, 118, 'The Godfather', 1972, 'Dram, Suç', 'https://m.media-amazon.com/images/M/MV5BM2MyNjYxNmUtYTAwNi00MTYxLWJmNWYtYzZlODY3ZTk3OTFlXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SX300.jpg', 9, '', 1, 0, '2025-08-21 11:02:25', '2025-08-21 11:02:25', 0),
(15, 118, '12 Angry Men', 1957, 'Dram, Suç', 'https://m.media-amazon.com/images/M/MV5BMWU4N2FjNzYtNTVkNC00NzQ0LTg0MjAtYTJlMjFhNGUxZDFmXkEyXkFqcGdeQXVyNjc1NTYyMjg@._V1_SX300.jpg', 9, '', 1, 0, '2025-08-21 11:02:29', '2025-08-21 11:02:29', 0),
(16, 118, 'Forrest Gump', 1994, 'Dram, Romantik', 'https://m.media-amazon.com/images/M/MV5BNWIwODRlZTUtY2U3ZS00Yzg1LWJhNzYtMmZiYmEyNmU1NjMzXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg', 9, '', 1, 0, '2025-08-21 11:02:36', '2025-08-21 11:02:36', 0),
(17, 118, 'The Green Mile', 1999, 'Dram, Suç', 'https://images.plex.tv/photo?size=large-1920&scale=1&url=https%3A%2F%2Fmetadata-static.plex.tv%2Fd%2Fgracenote%2Fd725648c20cb167cc7a5487c4948b984.jpg', 9, '', 1, 0, '2025-08-21 11:02:39', '2025-08-21 11:02:39', 0),
(18, 118, 'Eternal Sunshine of the Spotless Mind', 2004, 'Romantik, Bilim Kurgu', 'https://m.media-amazon.com/images/M/MV5BYzE2MzI2NTUtMmFlNS00ZTY5LTkxOTgtODVmZDc4ODhkMWM0XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 8, '', 1, 0, '2025-08-21 11:02:52', '2025-08-21 11:02:52', 0),
(19, 118, 'Se7en', 1995, 'Gerilim, Suç', 'https://m.media-amazon.com/images/S/pv-target-images/9a1f76c8ebf47d788ae303713f73a7afd6576142d4292a7008e2657f266f824c.jpg', 9, '', 1, 0, '2025-08-21 11:03:12', '2025-08-21 11:03:12', 0),
(20, 118, 'Memento', 2000, 'Gerilim, Suç', 'https://m.media-amazon.com/images/M/MV5BZTcyNjk1MjgtOWI3Mi00YzQwLWI5MTktMzY4ZmI2NDAyNzYzXkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_SX300.jpg', 8, '', 1, 0, '2025-08-21 11:03:16', '2025-08-21 11:03:16', 0),
(21, 118, 'Inception', 2010, 'Bilim Kurgu, Aksiyon', 'https://m.media-amazon.com/images/M/MV5BMjAxMzY3NjcxNF5BMl5BanBnXkFtZTcwNTI5OTM0Mw@@._V1_SX300.jpg', 9, '', 1, 0, '2025-08-21 11:03:26', '2025-08-21 11:03:26', 0),
(22, 118, 'Interstellar', 2014, 'Bilim Kurgu, Dram', 'https://m.media-amazon.com/images/M/MV5BZjdkOTU3MDktN2IxOS00OGEyLWFmMjktY2FiMmZkNWIyODZiXkEyXkFqcGdeQXVyMTMxODk2OTU@._V1_SX300.jpg', 9, '', 1, 0, '2025-08-21 11:03:29', '2025-08-21 11:03:29', 0),
(23, 118, 'The Lord of the Rings: The Return of the King', 2003, 'Fantastik, Macera', 'https://m.media-amazon.com/images/M/MV5BNzA5ZDNlZWMtM2NhNS00NDJjLTk4NDItYTRmY2EwMWZlMTY3XkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SX300.jpg', 9, '', 1, 0, '2025-08-21 11:03:44', '2025-08-21 11:03:44', 0),
(24, 118, 'Toy Story 3', 2010, 'Animasyon, Macera', 'https://m.media-amazon.com/images/M/MV5BMTgxOTY4Mjc0MF5BMl5BanBnXkFtZTcwNTA4MDQyMw@@._V1_SX300.jpg', 8, '', 1, 0, '2025-08-21 11:03:59', '2025-08-21 11:03:59', 0),
(25, 118, 'Up', 2009, 'Animasyon, Macera', 'https://upload.wikimedia.org/wikipedia/en/0/05/Up_%282009_film%29.jpg', 8, '', 1, 0, '2025-08-21 11:04:02', '2025-08-21 11:04:02', 0),
(26, 118, 'Pulp Fiction', 1994, 'Suç, Dram', 'https://m.media-amazon.com/images/M/MV5BNGNhMDIzZTUtNTBlZi00MTRlLWFjM2ItYzViMjE3YzI5MjljXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SX300.jpg', 9, '', 1, 0, '2025-08-21 11:04:18', '2025-08-21 11:04:18', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `fotograflar`
--

DROP TABLE IF EXISTS `fotograflar`;
CREATE TABLE IF NOT EXISTS `fotograflar` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ad` varchar(255) NOT NULL,
  `fotografci` varchar(255) NOT NULL,
  `tarih` varchar(50) NOT NULL,
  `yer` varchar(255) NOT NULL,
  `tur` varchar(100) NOT NULL,
  `aciklama` text NOT NULL,
  `resim` varchar(500) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `fotograflar`
--

INSERT INTO `fotograflar` (`id`, `ad`, `fotografci`, `tarih`, `yer`, `tur`, `aciklama`, `resim`, `created_at`, `updated_at`) VALUES
(1, 'Afghan Girl', 'Steve McCurry', '1984', 'Pakistan', 'Portre', 'National Geographic\'in en ikonik fotoğraflarından biri. Yeşil gözleriyle dünyayı büyüleyen Afgan kızı Sharbat Gula\'nın hikayesi, savaşın masum kurbanlarını simgeler.', 'https://upload.wikimedia.org/wikipedia/en/b/b4/Sharbat_Gula.jpg', '2025-08-12 12:46:40', '2025-08-12 13:23:05'),
(2, 'Migrant Mother', 'Dorothea Lange', '1936', 'Kaliforniya, ABD', 'Belgesel', 'Büyük Buhran döneminin en etkileyici fotoğraflarından biri. Florence Owens Thompson\'ın endişeli yüzü, o dönemin zorluklarını mükemmel şekilde yansıtır.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/54/Lange-MigrantMother02.jpg/1200px-Lange-MigrantMother02.jpg', '2025-08-12 12:46:40', '2025-08-12 13:22:37'),
(3, 'The Kiss', 'Alfred Eisenstaedt', '1945', 'New York, ABD', 'Sokak', 'II. Dünya Savaşı\'nın sona erdiği gün Times Square\'de çekilen bu fotoğraf, zaferin ve sevincin en güzel anlarından birini ölümsüzleştirir.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTGQSZ1xhcn62hCL0vtkrbBBo6ugIhWCbH24g&s', '2025-08-12 12:46:40', '2025-08-12 13:19:32'),
(4, 'Earthrise', 'William Anders', '1968', 'Ay Yörüngesi', 'Uzay', 'Apollo 8 görevi sırasında çekilen bu fotoğraf, insanlığın Dünya\'yı uzaydan ilk kez gördüğü anı yakalar. Çevre bilincinin doğuşuna katkı sağlamıştır.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a8/NASA-Apollo8-Dec24-Earthrise.jpg/960px-NASA-Apollo8-Dec24-Earthrise.jpg', '2025-08-12 12:46:40', '2025-08-12 13:19:50'),
(5, 'V-J Day in Times Square', 'Alfred Eisenstaedt', '1945', 'New York, ABD', 'Sokak', 'Japonya\'nın teslim olduğu gün Times Square\'de çekilen bu fotoğraf, savaşın sona ermesinin verdiği sevinci ve özgürlüğü simgeler.', 'https://upload.wikimedia.org/wikipedia/en/9/95/Legendary_kiss_V%E2%80%93J_day_in_Times_Square_Alfred_Eisenstaedt.jpg', '2025-08-12 12:46:40', '2025-08-12 13:20:04'),
(6, 'The Falling Man', 'Richard Drew', '2001', 'New York, ABD', 'Gazetecilik', '11 Eylül saldırıları sırasında çekilen bu fotoğraf, o günün trajedisini en çarpıcı şekilde yansıtır. Tarihin en acı anlarından birini belgeler.', 'https://hips.hearstapps.com/hmg-prod/images/longform-falling-man-ap-1536604107.jpg?crop=0.564xw:1.00xh;0.224xw,0&resize=1200:*', '2025-08-12 12:46:40', '2025-08-12 13:20:24'),
(7, 'Tank Man', 'Jeff Widener', '1989', 'Pekin, Çin', 'Gazetecilik', 'Tiananmen Meydanı protestoları sırasında çekilen bu fotoğraf, bir adamın tank kolonunu durdurmaya çalıştığı anı yakalar. Cesaretin ve direnişin simgesi haline gelmiştir.', 'https://upload.wikimedia.org/wikipedia/tr/thumb/d/d8/Tianasquare.jpg/500px-Tianasquare.jpg', '2025-08-12 12:46:40', '2025-08-12 13:21:38'),
(8, 'The Blue Marble', 'Apollo 17 Mürettebatı', '1972', 'Uzay', 'Uzay', 'Dünya\'nın tam güneş ışığında çekilen ilk fotoğrafı. Mavi gezegenimizin güzelliğini ve kırılganlığını gösteren bu görüntü, çevre hareketinin sembolü haline gelmiştir.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/70/The_Blue_Marble%2C_AS17-148-22727.jpg/1200px-The_Blue_Marble%2C_AS17-148-22727.jpg', '2025-08-12 12:46:40', '2025-08-12 13:21:54'),
(9, 'Lunch A top a Skyscraper', 'Charles C. Ebbets', '1932', 'New York, ABD', 'Endüstriyel', 'Rockefeller Center inşaatı sırasında çekilen bu fotoğraf, işçilerin cesaretini ve o dönemin çalışma koşullarını gösterir. İkonik bir görüntü haline gelmiştir.', 'https://upload.wikimedia.org/wikipedia/commons/9/9c/Lunch_atop_a_Skyscraper_-_Charles_Clyde_Ebbets.jpg', '2025-08-12 12:46:40', '2025-08-12 13:22:02');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `heykeller`
--

DROP TABLE IF EXISTS `heykeller`;
CREATE TABLE IF NOT EXISTS `heykeller` (
  `id` int NOT NULL AUTO_INCREMENT,
  `heykel_adi` varchar(255) NOT NULL,
  `yapim_yili` int NOT NULL,
  `sanatcisi` varchar(255) NOT NULL,
  `heykel_url` varchar(255) NOT NULL,
  `aciklama` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `heykeller`
--

INSERT INTO `heykeller` (`id`, `heykel_adi`, `yapim_yili`, `sanatcisi`, `heykel_url`, `aciklama`) VALUES
(1, 'David', 1501, 'Michelangelo', 'https://www.artkolik.net/wp-content/uploads/2018/12/davut.jpg', 'Michelangelo\'nun en ünlü eseri olan David heykeli, İncil\'deki Davut ve Golyat hikayesinden esinlenilmiştir. 5.17 metre yüksekliğindeki bu mermer heykel, Rönesans sanatının en önemli başarılarından biri olarak kabul edilir. Heykel, Davut\'un Golyat\'ı taşla vurmadan önceki anını, yoğun konsantrasyon ve kararlılık haliyle tasvir eder.'),
(2, 'Venüs de Milo', 0, 'Aleksandros', 'https://upload.wikimedia.org/wikipedia/commons/3/3d/Aphrodite_of_Milos.jpg', 'Antik Yunan\'ın en ünlü heykellerinden biri olan Venüs de Milo, 1820\'de Yunanistan\'ın Milos adasında keşfedilmiştir. Heykel, güzellik ve aşk tanrıçası Afrodit\'i tasvir eder. Kolları eksik olmasına rağmen, zarif duruşu ve idealize edilmiş güzelliği ile dünya sanat tarihinin en değerli eserlerinden biri haline gelmiştir.'),
(3, 'Düşünen Adam', 1880, 'Auguste Rodin', 'https://miro.medium.com/1*GsJqTF63aiFIw-8VIfGkCQ.jpeg', 'Auguste Rodin\'in en tanınmış eseri olan Düşünen Adam, derin düşünce halindeki çıplak bir adamı tasvir eder. Heykel, Dante\'nin İlahi Komedya\'sındaki \'Cehennem Kapısı\' adlı büyük projesinin bir parçası olarak tasarlanmıştır. Modern heykel sanatının en önemli örneklerinden biri olarak kabul edilir ve insan düşüncesinin evrensel sembolü haline gelmiştir.'),
(4, 'Özgürlük Heykeli', 1886, 'Frédéric Auguste Bartholdi', 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/dd/Lady_Liberty_under_a_blue_sky_%28cropped%29.jpg/250px-Lady_Liberty_under_a_blue_sky_%28cropped%29.jpg', 'Fransa tarafından ABD\'ye hediye edilen Özgürlük Heykeli, 1886\'da New York Limanı\'nda açılmıştır. 93 metre yüksekliğindeki heykel, özgürlük tanrıçası Libertas\'ı tasvir eder. Sağ elinde meşale, sol elinde ise ABD Bağımsızlık Bildirgesi\'ni tutar. Dünya çapında özgürlük ve demokrasinin sembolü haline gelmiştir.'),
(5, 'Pieta', 1498, 'Michelangelo', 'https://lh3.googleusercontent.com/proxy/yXI7v0NgTbr1IDsbf4Kq7ZaQHDHWMypDV2_Rth5skOg17W1jpDXAr009_c6NQvUAGn26GtwlU3XUU0KGtC_DnFYq-4YRqKEt4ZS9kvjBRPir', 'Michelangelo\'nun 24 yaşında tamamladığı Pieta, Hz. İsa\'nın çarmıhtan indirildikten sonra annesi Meryem\'in kucağında yatışını tasvir eder. Vatikan\'daki Aziz Petrus Bazilikası\'nda bulunan bu eser, Rönesans sanatının en etkileyici örneklerinden biridir. Mermerin yumuşak dokusu ve detaylı işçiliği ile dikkat çeker.'),
(6, 'Nike (Zafer Tanrıçası)', 0, 'Bilinmeyen', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ_a5irwn8hjjc2klIO3c83cYuoAqb8f2HEQQ&s', 'Helenistik dönemin en önemli heykellerinden biri olan Nike (Zafer Tanrıçası), 1863\'te Yunanistan\'ın Samothrace adasında keşfedilmiştir. Heykel, zafer tanrıçası Nike\'yi kanatları açık, geminin pruvasında dururken tasvir eder. Dinamik duruşu ve zarif kanatları ile Helenistik sanatın en etkileyici örneklerinden biridir.');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `iletisim_formu`
--

DROP TABLE IF EXISTS `iletisim_formu`;
CREATE TABLE IF NOT EXISTS `iletisim_formu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `konu` varchar(255) NOT NULL,
  `mesaj` varchar(1500) NOT NULL,
  `eposta` varchar(255) NOT NULL,
  `adisoyadi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `iletisim_formu`
--

INSERT INTO `iletisim_formu` (`id`, `konu`, `mesaj`, `eposta`, `adisoyadi`, `created_at`) VALUES
(3, 'İletişim Formu', '444444444ttyht', 'erayalttttttttt44t@posta.com', 'eray', '2025-08-07 10:51:45'),
(2, 'İletişim Formu', 'bu bir mesaj metnidir', 'yesimalt@posta.com', 'yeşim', '2025-08-07 10:51:45'),
(5, 'İletişim Formu', '4444444444444444444444', 'erayalt@posta.com', 'eray', '2025-08-07 10:51:45'),
(6, 'İletişim Formu', 'dasdasdasdasdsadas', 'sadsadsdsa@posta.com', 'emre', '2025-08-07 10:51:45'),
(7, 'İletişim Formu', 'sadsadsadsadsa', 'dsadsadsa@posta.com', 'dsadsadsa', '2025-08-07 10:51:45'),
(8, 'İletişim Formu', 'testestetete', 'test@outlook.com', 'test test', '2025-08-07 10:51:45'),
(9, 'İletişim Formu', 'merhaba sitenizi test ediyorum.', 'yesimaltundag00@gmail.com', 'yeşim altundağ', '2025-08-07 10:51:45'),
(10, 'İletişim Formu', 'dasdsadasdsadsadsadsa', 'emresabahat@outlook.com', 'dsadsadsaddsa', '2025-08-07 10:51:45'),
(11, 'İletişim Formu', 'faqwewqfawewaewa', 'emresabahat@outlook.com', 'emre', '2025-08-07 10:51:45'),
(12, 'İletişim Formu', '23213213213213213213', 'emresabahat@outlook.com', 'emre', '2025-08-07 10:51:45'),
(13, 'İletişim Formu', '3213213232121321', 'yesimaltundag00@gmail.com', 'a', '2025-08-07 10:51:45'),
(14, 'İletişim Formu', 'sadsadsadsadsa', 'emresabahat@outlook.com', 'sadadsa', '2025-08-07 10:51:45'),
(15, 'İletişim Formu', 'sdadsadsadsadsa', 'emresabahat@outlook.com', 'sadsa', '2025-08-07 10:51:45'),
(16, 'İletişim Formu', '213h21k3h21k3h21k31', 'emresabahat@outlook.com', 'emre', '2025-08-07 10:51:45'),
(17, '321321321321', '321321321321', 'sadsadsadsa@posta.com', 'dsadsaddsa', '2025-08-07 10:51:45'),
(18, '21321321321321', '21523t32tdsd', 'emresabahat@outlook.com', 'emre', '2025-08-07 11:17:59'),
(19, 'safsafsafsafsa', 'ewqewqfsawq', 'emresabahat@outlook.com', 'emre', '2025-08-07 11:19:40'),
(20, 'dsadsadsadsdsa', 'dsadsadsadsasa', 'emresabahat@outlook.com', 'emre', '2025-08-07 11:26:47'),
(21, 'sadsadsadsa', 'dsadsadsadsa', 'emresabahat@outlook.com', 'emre', '2025-08-11 11:33:18'),
(22, 'sadsadsadsad', 'asdsadsadsadsa', 'emresabahat@outlook.com', 'emre', '2025-08-12 06:36:38'),
(23, 'sadsadasdsa', 'dsadsadsadsa', 'emresabahat@outlook.com', 'emre', '2025-08-12 06:51:59'),
(24, 'dsadsddsads', 'dsadsadasdsa', 'yesimaltundag00@gmail.com', 'yeşim', '2025-08-12 06:53:08'),
(25, 'staj', 'tekprosis1111', 'yesimaltundag00@gmail.com', 'yeşim', '2025-08-12 06:53:52'),
(26, 'survivor başvuru', 'survivor ne zaman başlayacak çok seviyorum', 'info@acunmedyaakademi.com', 'glow tech', '2025-08-12 09:53:43'),
(27, 'dsadsadsadas', 'dsadsadsadsadsa', 'emresabahat@outlook.com', 'emre', '2025-08-13 07:16:04'),
(28, 'adsadasdsa', 'dsadasdsadsad', 'dsadsadsa@outlook.com', 'tech', '2025-08-14 08:37:43'),
(29, 'dsadsadsadsa', 'sadsaddsadsadsa', 'dsadsadsadsa@hotmail.com', 'dsadsadsa', '2025-08-15 12:48:00'),
(30, 'dsaddsadsa', 'sadsadsadsa', 'sadsadsadsa@outlook.com', 'dsadsadsa', '2025-08-15 13:28:58'),
(31, 'test', 'test', 'test@outlook.com', 'test', '2025-08-18 09:40:57'),
(32, 'test', 'test', 'test@outlook.com', 'test', '2025-08-18 09:44:20'),
(33, 'test', 'test', 'emresabahat@outlook.com', 'test', '2025-08-18 09:44:38'),
(34, 'dsa', 'asdsadsadasdsa', 'dsadsad@outlook.com', 'dsadas', '2025-08-18 10:19:32'),
(35, 'asdsadsa', 'dasdsadasdas', 'dsadsadsa@outlook.com', 'dsadsa', '2025-08-21 12:39:59'),
(36, 'asdsdas', 'dasdsadasdasdas', 'emresabahat@outlook.com', 'test', '2025-08-21 12:41:11');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kisiler`
--

DROP TABLE IF EXISTS `kisiler`;
CREATE TABLE IF NOT EXISTS `kisiler` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `adsoyad` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `sifre` varchar(255) DEFAULT NULL,
  `rol` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `e_posta` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=120 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `kisiler`
--

INSERT INTO `kisiler` (`id`, `username`, `adsoyad`, `sifre`, `rol`, `e_posta`) VALUES
(104, 'yeşim', 'altundağ', '$2y$10$1UBmeKf4OPoKM79FKBt0TesmWhOjksbjy3FdLBVdBaZKCoV4qLfpW', 'admin', 'yesimaltundag00@gmail.com'),
(103, 'eray', 'altundağ', '$2y$10$Ef2MGTDKTviUE7gv93LTpu67Q.ai6k3m04p2W/CLpDGfSqcgJuSHe', 'kullanici', 'erayalt@posta.com'),
(105, 'irem', 'altundağ', '$2y$10$03FZx.W19rPAhrygVdB5xOWTg9pVl1efrE.WxXTq4PYQUp0lVwg3a', 'kullanici', 'iremalt@posta.com'),
(118, 'emre', 'şabahat', '$2y$10$vBXcWQLWjlxJEUkd2QFuKeubdv/9He3UJ3JB5FSaHOIXNhPlorXQC', 'admin', 'emresabahat@outlook.com'),
(107, 'gizem', 'alt', '$2y$10$SqXUXB3WlDTfX2L0wrbieekl7uqa9haQXvvkzOVTSZNyCCdIPyWMm', 'kullanici', 'gizemalt@posta.com'),
(108, 'ekber', 'ekber h', '$2y$10$7S/0Ng/m.8AzUUWxT3FU5eGihxZ2MmbqosIPcHT459eNsZVVLuyiO', 'kullanici', 'ekhas@posta.com.tr'),
(114, 'test2', 'test', '$2y$10$ayjqBbCnMFjXohH38.ZSi.kfozFVr2zggqHe5bcDPuNkMb140iQge', 'kullanici', 'test@test.com'),
(115, 'testt', 'test', '$2y$10$lcTrrMpiFTrf9P8aZ75kK.QqU7hdbYbVA7AHH2xwyqLyUPLuTKEc.', 'kullanici', 'test@posta.com'),
(116, 'testtt', 'test', '$2y$10$wU.yJ4INADPsc2SwYMIB1.PkveEcKk4JcxD0Y4qn.RNp7IXC6RX1a', 'kullanici', 'testt@posta.com'),
(117, 'test2', 'test', '$2y$10$4QCZVYOIUqHJUIAXk3E6zeN0HWfr2lmU7BVfz9Egvx1ghy7aGk3Qa', 'kullanici', 'testtt@posta.com');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kitaplar`
--

DROP TABLE IF EXISTS `kitaplar`;
CREATE TABLE IF NOT EXISTS `kitaplar` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kitap_adi` varchar(255) NOT NULL,
  `yazar` varchar(255) NOT NULL,
  `basim_yili` int NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `sayfa_sayisi` int NOT NULL,
  `basim_yeri` varchar(255) NOT NULL,
  `isbn` int NOT NULL,
  `tanitim` varchar(1000) NOT NULL,
  `kapak_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `kitaplar`
--

INSERT INTO `kitaplar` (`id`, `kitap_adi`, `yazar`, `basim_yili`, `kategori`, `sayfa_sayisi`, `basim_yeri`, `isbn`, `tanitim`, `kapak_url`) VALUES
(6, 'Suç ve Ceza', 'Fyodor Dostoyevski', 1866, 'Klasik Edebiyat', 671, 'Sankt Petersburg, Rusya', 2147483647, 'Dünya edebiyatının başyapıtlarından biri. Rodion Raskolnikov adlı genç bir öğrencinin işlediği cinayet sonrası yaşadığı psikolojik çöküşü ve vicdani hesaplaşmasını anlatan bu roman, dünya edebiyatının en derin psikolojik analizlerinden biridir.', 'https://img.kitapyurdu.com/v1/getImage/fn:11318194/wh:true/wi:800'),
(7, 'Sefiller', 'Victor Hugo', 1862, 'Klasik Edebiyat', 1488, 'Paris, Fransa', 2147483647, 'Fransız edebiyatının en önemli eserlerinden biri. Jean Valjean\'ın hayatındaki dönüşümü ve 19. yüzyıl Fransa\'sının toplumsal sorunlarını anlatan bu dev roman, dünya edebiyatının en etkileyici eserlerinden biridir.', 'https://img.kitapyurdu.com/v1/getImage/fn:11572198/wh:true/wi:800'),
(8, 'Anna Karenina', 'Lev Tolstoy', 1877, 'Klasik Edebiyat', 864, 'Moskova, Rusya', 2147483647, 'Rus edebiyatının en büyük eserlerinden biri. Anna Karenina\'nın aşk ve evlilik arasında yaşadığı trajik çelişkiyi anlatan bu roman, dünya edebiyatının en derin psikolojik analizlerinden biridir.', 'https://img.kitapyurdu.com/v1/getImage/fn:6828407/wh:true/wi:800'),
(9, 'Büyük Umutlar', 'Charles Dickens', 1861, 'Klasik Edebiyat', 544, 'Londra, İngiltere', 2147483647, 'İngiliz edebiyatının önemli eserlerinden biri. Pip adlı yetim bir çocuğun hayatındaki değişimleri ve sosyal sınıf farklılıklarının insan üzerindeki etkisini anlatan bu roman, dünya edebiyatının en etkileyici eserlerinden biridir.', 'https://img.kitapyurdu.com/v1/getImage/fn:3518241/wh:true/miw:200/mih:200'),
(10, 'Karamazov Kardeşler', 'Fyodor Dostoyevski', 1880, 'Klasik Edebiyat', 796, 'Sankt Petersburg, Rusya', 2147483647, 'Dostoyevski\'nin son ve en önemli eseridir. Karamazov ailesinin dört oğlunun babalarının ölümü etrafında yaşadığı dramı anlatan bu roman, dünya edebiyatının en derin felsefi analizlerinden biridir.', 'https://i.dr.com.tr/cache/500x400-0/originals/0001803800001-1.jpg'),
(12, 'Tutunamayanlar', 'Oğuz Atay', 1972, 'Türk Edebiyatı', 724, 'İstanbul, Türkiye', 2147483647, 'Türk edebiyatında postmodern akımın öncü eserlerinden biridir. Turgut Özben\'in arkadaşı Selim Işık\'ın intiharından sonra onun geçmişini araştırması ve kendini keşfetmesi sürecini anlatan bu roman, Türk edebiyatının en önemli eserlerinden biri kabul edilir.', 'https://img.kitapyurdu.com/v1/getImage/fn:11462655/wh:true/wi:800'),
(13, 'Kürk Mantolu Madonna', 'Sabahattin Ali', 1943, 'Türk Edebiyatı', 160, 'İstanbul, Türkiye', 2147483647, 'Türk edebiyatının en önemli eserlerinden biridir. Raif Efendi\'nin Berlin\'de yaşadığı aşk hikayesini anlatan bu roman, Türk edebiyatının en etkileyici aşk hikayelerinden biridir.', 'https://img.kitapyurdu.com/v1/getImage/fn:1207631/wh:true/wi:800'),
(15, 'Kara Kitap', 'Orhan Pamuk', 1990, 'Türk Edebiyatı', 448, 'İstanbul, Türkiye', 2147483647, 'Postmodern Türk edebiyatının önemli örneklerinden biridir. Galip\'in kaybolan eşi Rüya\'yı arama sürecinde İstanbul\'un gizemli sokaklarında yaşadığı maceraları anlatan bu roman, Türk edebiyatının önemli eserlerinden biridir.', 'https://covers.openlibrary.org/b/id/12297420-M.jpg'),
(23, 'Atomic Habits', 'James Clear', 2018, 'Kişisel Gelişim', 320, 'New York, ABD', 2147483647, 'Küçük alışkanlıkların büyük değişimlere yol açabileceğini anlatan bu kitap, etkili alışkanlık oluşturma yöntemlerini sunar.', 'https://m.media-amazon.com/images/I/81F90H7hnML._UF1000,1000_QL80_.jpg'),
(24, 'Deep Work', 'Cal Newport', 2016, 'Kişisel Gelişim', 304, 'New York, ABD', 2147483647, 'Dikkat dağınıklığı çağında odaklanma sanatını anlatan bu kitap, derin çalışma tekniklerini öğretir.', 'https://target.scene7.com/is/image/Target/GUEST_de8c9d7e-9578-449a-92b1-cf4b18ecc2d0'),
(25, 'Mindset', 'Carol S. Dweck', 2006, 'Kişisel Gelişim', 288, 'New York, ABD', 2147483647, 'Sabit ve gelişim odaklı zihniyet türlerini inceleyen bu kitap, başarı ve öğrenme süreçlerini anlatır.', 'https://m.media-amazon.com/images/I/61y1U-lPl5L.jpg'),
(31, 'The Innovators', 'Walter Isaacson', 2014, 'Teknoloji', 560, 'New York, ABD', 2147483647, 'Dijital devrimin öncülerinin hikayelerini anlatan bu kitap, bilgisayar ve internet çağının nasıl başladığını anlatır.', 'https://m.media-amazon.com/images/I/71LOesgcrUL.jpg'),
(36, 'The Story of Art', 'E.H. Gombrich', 1950, 'Sanat', 688, 'Londra, İngiltere', 2147483647, 'Sanat tarihinin en kapsamlı eserlerinden biri. İlk çağlardan günümüze kadar sanatın gelişimini anlatır.', 'https://www.phaidon.com/images/9780714832470/main-mobile-x1-jpg/9780714832470.jpg'),
(37, 'Ways of Seeing', 'John Berger', 1972, 'Sanat', 176, 'Londra, İngiltere', 2147483647, 'Görsel sanatları nasıl yorumlayacağımızı öğreten bu kitap, sanat eleştirisi alanında çığır açan bir eser.', 'https://m.media-amazon.com/images/I/61rbO4IAa4L._UF350,350_QL50_.jpg'),
(38, 'The Art Book', 'Phaidon Editors', 1994, 'Sanat', 512, 'Londra, İngiltere', 2147483647, '500 büyük sanatçının eserlerini tanıtan bu kitap, sanat tarihinin en önemli yapıtlarını gözler önüne serer.', 'https://productimages.hepsiburada.net/s/312/375-375/110000305424864.jpg'),
(39, 'Art and Visual Perception', 'Rudolf Arnheim', 1954, 'Sanat', 508, 'California, ABD', 2147483647, 'Görsel algı ve sanat arasındaki ilişkiyi inceleyen bu kitap, psikoloji ve sanatın kesişim noktalarını araştırır.', 'https://m.media-amazon.com/images/I/710lDxIVPcL._UF1000,1000_QL80_.jpg'),
(40, 'The Art of Color', 'Johannes Itten', 1961, 'Sanat', 96, 'Zürih, İsviçre', 2147483647, 'Renk teorisi ve uygulamasını anlatan bu kitap, sanatçılar ve tasarımcılar için temel bir kaynak.', 'https://imgv2-2-f.scribdassets.com/img/document/461680459/original/076660fb60/1?v=1'),
(41, 'Pedagogy of the Oppressed', 'Paulo Freire', 1968, 'Eğitim', 184, 'São Paulo, Brezilya', 2147483647, 'Eğitim felsefesi alanında çığır açan bu kitap, ezilenlerin eğitimi konusunu ele alır ve özgürleştirici eğitim yöntemlerini önerir.', 'https://m.media-amazon.com/images/I/713wv6K-ZlL.jpg'),
(42, 'How Children Learn', 'John Holt', 1967, 'Eğitim', 320, 'New York, ABD', 2147483647, 'Çocukların doğal öğrenme süreçlerini inceleyen bu kitap, geleneksel eğitim sisteminin eleştirisini yapar.', 'https://m.media-amazon.com/images/I/61DrOde5h1L._UF1000,1000_QL80_.jpg'),
(43, 'The Montessori Method', 'Maria Montessori', 1909, 'Eğitim', 416, 'Roma, İtalya', 2147483647, 'Montessori eğitim yönteminin temellerini anlatan bu kitap, çocuk merkezli eğitim yaklaşımını detaylandırır.', 'https://m.media-amazon.com/images/I/717cVektsaL._UF1000,1000_QL80_.jpg'),
(45, 'The Art of Learning', 'Josh Waitzkin', 2007, 'Eğitim', 288, 'New York, ABD', 2147483647, 'Satranç şampiyonu ve dövüş sanatları ustası olan yazarın öğrenme süreçlerini anlatan bu kitap, performans psikolojisini inceler.', 'https://m.media-amazon.com/images/I/81AFeNm3OSL._UF1000,1000_QL80_.jpg'),
(46, 'The Life Changing Magic of Tidying Up', 'Marie Kondo', 2010, 'Yaşam Tarzı', 224, 'Tokyo, Japonya', 2147483647, 'KonMari yöntemi olarak bilinen düzenleme tekniğini anlatan bu kitap, sadece sevdiğiniz eşyaları tutma felsefesini öğretir.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQYRIZy06AA7Roxu-QEF1wPItnFCXu_DGVhdQ&s'),
(48, 'The 4-Hour Workweek', 'Timothy Ferriss', 2007, 'Yaşam Tarzı', 308, 'New York, ABD', 2147483647, 'Çalışma hayatını optimize etme ve daha fazla zaman kazanma yöntemlerini anlatan bu kitap, yaşam tarzı tasarımı konusunu ele alır.', 'https://m.media-amazon.com/images/I/71vO9Tbf4-L.jpg'),
(49, 'Essentialism', 'Greg McKeown', 2014, 'Yaşam Tarzı', 272, 'New York, ABD', 2147483647, 'Sadece önemli şeylere odaklanma sanatını anlatan bu kitap, hayatı sadeleştirme ve öncelikleri belirleme konusunda rehberlik eder.', 'https://m.media-amazon.com/images/I/61QfKSGnwEL.jpg'),
(86, 'Türk Kültür Tarihi', 'Bahaeddin Ögel', 1971, 'Kültür ve Toplum', 640, 'Ankara', 321321321, 'Türk Kültür Tarihi, Bahaeddin Ögel\'in Türk kültürünün\r\ngelişimini kronolojik olarak ele aldığı kapsamlı bir eserdir.\r\nBu kitap, Türk kültürünün en eski dönemlerinden günümüze kadar\r\nolan evrimini inceler.\r\n\r\nÖgel, Türk kültürünü sadece sanat ve edebiyat açısından değil,\r\naynı zamanda günlük yaşam, inanç sistemleri, sosyal yapı ve\r\nteknoloji açısından da ele alır. Kitap, Türk kültürünün\r\nzenginliğini ve çeşitliliğini gösterir.\r\n\r\nKitapta ele alınan temel konular arasında: Türk mitolojisi,\r\nsanat, müzik, edebiyat, mimari, el sanatları, gelenekler ve\r\ngörenekler yer alır. Ögel, kültürel unsurları tarihsel\r\nbağlamlarıyla birlikte sunar.\r\n\r\nBu kitap, sadece kültür tarihi meraklıları için değil,\r\naynı zamanda Türk kimliğini anlamak isteyen herkes için\r\ndeğerli bir kaynaktır. Türk kültür tarihinin en kapsamlı\r\nçalışmalarından biridir.', 'https://img.kitapyurdu.com/v1/getImage/fn:11575927/wh:true/wi:500'),
(95, 'Memleketimden İnsan Manzaraları', 'Nazım Hikmet', 1966, 'Türk Edebiyatı', 544, 'İstanbul', 321321321, 'Memleketimden İnsan Manzaraları, Nâzım Hikmet\'in en önemli eserlerinden biridir. Türk toplumunun farklı kesimlerinden insanların hikayelerini anlatan bu destansı şiir, Türk edebiyatının en kapsamlı toplumsal analizlerinden biridir.\r\n\r\n              Kitap, 20. yüzyılın ilk yarısında Türkiye\'de yaşayan farklı sosyal sınıflardan insanların yaşamlarını, umutlarını, hayal kırıklıklarını ve mücadelelerini anlatır. Nâzım Hikmet, toplumun her kesiminden insanı şiirine dahil ederek, Türk toplumunun geniş bir panoramasını çizer.\r\n\r\n              Memleketimden İnsan Manzaraları, sadece edebi açıdan değil, aynı zamanda tarihi ve sosyolojik açıdan da önemli bir eserdir. Hikmet\'in güçlü lirizmi ve toplumsal duyarlılığı, eseri Türk edebiyatının en önemli yapıtlarından biri haline getirmiştir.', 'https://nazimhikmetmerkezi.com/wp-content/uploads/2017/12/Memleketimden-Insan-Manzaralari.jpg'),
(55, 'Rich Dad Poor Dad', 'Robert T. Kiyosaki', 1997, 'Kişisel Gelişim', 336, 'Hawaii, ABD', 2147483647, 'İki farklı babanın para ve yatırım konusundaki farklı yaklaşımlarını anlatan bu kitap, finansal okuryazarlık konusunda rehberlik eder.', 'https://m.media-amazon.com/images/I/81bsw6fnUiL._UF1000,1000_QL80_.jpg'),
(56, 'Think and Grow Rich', 'Napoleon Hill', 1937, 'Kişisel Gelişim', 256, 'New York, ABD', 2147483647, 'Başarılı insanların ortak özelliklerini inceleyen bu klasik eser, zihinsel güç ve başarı prensiplerini öğretir.', 'https://m.media-amazon.com/images/I/61IxJuRI39L.jpg'),
(58, 'The 7 Habits of Highly Effective People', 'Stephen R. Covey', 1989, 'Kişisel Gelişim', 432, 'New York, ABD', 2147483647, 'Etkili insanların yedi alışkanlığını anlatan bu kitap, kişisel ve profesyonel başarı için rehberlik eder.', 'https://m.media-amazon.com/images/I/71jBBvNvxoL._UF350,350_QL50_.jpg'),
(92, 'Outliers', 'Malcolm Gladwell', 2008, 'Kültür & Toplum', 309, 'New York, ABD', 2147483647, 'Başarılı insanların hikayelerini inceleyen bu kitap, başarının arkasındaki gizli faktörleri ortaya çıkarır.', 'https://i.dr.com.tr/cache/600x600-0/originals/0000000303463-1.jpg'),
(88, 'Sapiens', 'Yuval Noah Harari', 2011, 'Kültür & Toplum', 464, 'Tel Aviv, İsrail', 2147483647, 'İnsanlığın kısa tarihini anlatan bu kitap, Homo sapiens\'in dünyayı nasıl ele geçirdiğini ve modern toplumları nasıl şekillendirdiğini anlatır.', 'https://m.media-amazon.com/images/I/713jIoMO3UL.jpg'),
(89, 'Homo Deus', 'Yuval Noah Harari', 2015, 'Kültür & Toplum', 448, 'Tel Aviv, İsrail', 2147483647, 'Gelecekte insanlığın nasıl evrileceğini ve yapay zeka çağında insanın rolünü inceleyen bu kitap, gelecek vizyonları sunar.', 'https://m.media-amazon.com/images/I/71N6LbagzSL.jpg'),
(90, 'Guns, Germs, and Steel', 'Jared Diamond', 1997, 'Kültür & Toplum', 480, 'New York, ABD', 2147483647, 'İnsan toplumlarının neden farklı şekillerde geliştiğini açıklayan bu kitap, coğrafya, biyoloji ve kültürün etkileşimini inceler.', 'https://m.media-amazon.com/images/I/81RdveuYXWL.jpg'),
(91, 'The Tipping Point', 'Malcolm Gladwell', 2000, 'Kültür & Toplum', 304, 'New York, ABD', 2147483647, 'Küçük değişikliklerin nasıl büyük etkiler yaratabileceğini anlatan bu kitap, sosyal epidemilerin nasıl yayıldığını inceler.', 'https://m.media-amazon.com/images/I/71Qh0IHtJLL.jpg'),
(65, 'The Singularity Is Near', 'Ray Kurzweil', 2005, 'Teknoloji', 672, 'New York, ABD', 2147483647, 'Teknolojik tekillik kavramını inceleyen bu kitap, yapay zeka ve gelecek teknolojileri hakkında vizyon sunar.', 'https://m.media-amazon.com/images/I/81KoS0S3ozL._UF1000,1000_QL80_.jpg'),
(66, 'The Future of the Mind', 'Michio Kaku', 2014, 'Teknoloji', 400, 'New York, ABD', 2147483647, 'Beyin bilimi ve teknoloji alanındaki gelişmeleri inceleyen bu kitap, zihin kontrolü ve beyin-bilgisayar arayüzleri konularını ele alır.', 'https://m.media-amazon.com/images/I/81h5qTIPigL._UF1000,1000_QL80_.jpg'),
(70, 'The Art of the Deal', 'Donald J. Trump', 1987, 'Sanat', 384, 'New York, ABD', 2147483647, 'İş dünyasında başarılı olma stratejilerini anlatan bu kitap, pazarlık ve iş yapma sanatını öğretir.', 'https://ia801405.us.archive.org/BookReader/BookReaderImages.php?zip=/19/items/TrumpTheArtOfTheDeal/Trump_%20The%20Art%20of%20the%20Deal_jp2.zip&file=Trump_%20The%20Art%20of%20the%20Deal_jp2/Trump_%20The%20Art%20of%20the%20Deal_0000.jp2&id=TrumpTheArtOfThe'),
(71, 'The Art of War', 'Sun Tzu', -500, 'Sanat', 128, 'Çin', 2147483647, 'Antik Çin\'den gelen bu strateji kitabı, savaş sanatının temel prensiplerini öğretir ve günümüzde iş dünyasında da kullanılır.', 'https://m.media-amazon.com/images/I/71MizulW5AL.jpg'),
(72, 'The Art of Happiness', 'Dalai Lama', 1998, 'Sanat', 320, 'New York, ABD', 2147483647, 'Dalai Lama\'nın mutluluk üzerine görüşlerini paylaştığı bu kitap, iç huzur ve mutluluk sanatını öğretir.', 'https://www.ulc.org/assets/ulc/products/the-art-of-happiness-uo.png?t=1707500090000000'),
(73, 'The Art of Loving', 'Erich Fromm', 1956, 'Sanat', 176, 'New York, ABD', 2147483647, 'Sevme sanatını inceleyen bu psikolojik eser, aşk ve insan ilişkileri konularında derinlemesine analiz sunar.', 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1438550243i/14142.jpg'),
(93, 'Çalıkuşu', 'Reşat Nuri Güntekin', 1922, 'Türk Edebiyatı', 448, 'İstanbul', 321321321, 'Çalıkuşu, Reşat Nuri Güntekin\'in en önemli eserlerinden biridir. Feride\'nin öğretmenlik yaparken yaşadığı zorlukları ve aşk hayatındaki trajedileri anlatan bu roman, Türk edebiyatının en sevilen eserlerinden biridir.\r\n\r\nKitap, eğitim, aşk, toplumsal değerler ve kadının toplumdaki yeri temalarını işler. Feride\'nin Anadolu\'nın farklı köşelerinde öğretmenlik yaparken karşılaştığı zorluklar ve Kamran ile yaşadığı büyük aşk, romanın ana eksenini oluşturur. Güntekin, dönemin toplumsal yapısını ve insan ilişkilerini derinlemesine analiz eder.\r\n\r\n              Çalıkuşu, sadece bir aşk romanı değil, aynı zamanda 20. yüzyılın başında Türkiye\'nin sosyal ve kültürel yapısını da gözler önüne seren önemli bir eserdir. Güntekin\'in sıcak üslubu ve gerçekçi anlatımı, eseri Türk edebiyatının klasikleri arasına taşımıştır.\r\n\r\nRoman, eğitim, aile, aşk ve toplumsal değişim gibi evrensel temaları işleyerek, insan yaşamının anlamını sorgular.', 'https://cdn.cimri.io/image/1200x1200/calikusu-resat-nuri-guntekin_126525385.jpg'),
(82, 'The Power of Now', 'Eckhart Tolle', 1997, 'Yaşam Tarzı', 236, 'New York, ABD', 2147483647, 'Şimdiki anın gücünü anlatan bu spiritüel kitap, farkındalık ve iç huzur konularında rehberlik eder.', 'https://m.media-amazon.com/images/I/61Ij8nLooNL.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kitap_takip`
--

DROP TABLE IF EXISTS `kitap_takip`;
CREATE TABLE IF NOT EXISTS `kitap_takip` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` int DEFAULT NULL,
  `genre` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover` text COLLATE utf8mb4_unicode_ci,
  `rating` decimal(3,1) DEFAULT '0.0',
  `review` text COLLATE utf8mb4_unicode_ci,
  `is_read` tinyint(1) DEFAULT '0',
  `is_favorite` tinyint(1) DEFAULT '0',
  `is_wishlist` tinyint(1) DEFAULT '0',
  `pages` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_reading` tinyint(1) DEFAULT '0',
  `current_page` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `liste_filmler`
--

DROP TABLE IF EXISTS `liste_filmler`;
CREATE TABLE IF NOT EXISTS `liste_filmler` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'Benzersiz kayıt kimliği',
  `liste_id` int NOT NULL COMMENT 'Liste kimliği',
  `film_id` int NOT NULL COMMENT 'Film kimliği',
  `sira_no` int DEFAULT '0' COMMENT 'Listedeki sıra numarası',
  `ekleme_tarihi` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Listeye ekleme tarihi',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_liste_film` (`liste_id`,`film_id`),
  KEY `idx_liste_id` (`liste_id`),
  KEY `idx_film_id` (`film_id`),
  KEY `idx_sira_no` (`sira_no`),
  KEY `idx_liste_filmler_ekleme` (`ekleme_tarihi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Liste-film ilişki tablosu';

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mesaj_cevaplari`
--

DROP TABLE IF EXISTS `mesaj_cevaplari`;
CREATE TABLE IF NOT EXISTS `mesaj_cevaplari` (
  `id` int NOT NULL AUTO_INCREMENT,
  `iletisim_formu_id` int NOT NULL,
  `cevap_id` int NOT NULL,
  `cevap_mesaji` text NOT NULL,
  `cevap_veren_yonetici_user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_iletisim_formu_id` (`iletisim_formu_id`),
  KEY `idx_cevap_veren_user_id` (`cevap_veren_yonetici_user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `mesaj_cevaplari`
--

INSERT INTO `mesaj_cevaplari` (`id`, `iletisim_formu_id`, `cevap_id`, `cevap_mesaji`, `cevap_veren_yonetici_user_id`, `created_at`) VALUES
(2, 8, 1, 'dsasadsdsadsa', 1, '2025-08-07 07:44:10'),
(3, 7, 1, 'dsadsadsadsadsa', 104, '2025-08-07 07:53:02'),
(4, 6, 1, 'sadsadsadsa', 104, '2025-08-07 07:55:04'),
(5, 9, 1, 'merhaba iyi kontoller', 104, '2025-08-07 08:21:21'),
(6, 9, 2, 'merhaba iyi kontoller', 104, '2025-08-07 08:21:23'),
(7, 10, 1, 'fsadsadsadsada', 104, '2025-08-07 08:28:47'),
(8, 10, 2, 'fsadsadsadsada', 104, '2025-08-07 08:28:49'),
(9, 10, 3, 'fsadsadsadsada', 104, '2025-08-07 08:28:49'),
(10, 11, 1, '2132132131312', 104, '2025-08-07 08:33:53'),
(11, 11, 2, '2132132131312', 104, '2025-08-07 08:34:05'),
(12, 12, 1, '4215425eressees', 104, '2025-08-07 08:37:20'),
(13, 13, 1, '21321321321', 104, '2025-08-07 08:41:14'),
(14, 14, 1, '21421421421421421', 104, '2025-08-07 08:46:16'),
(15, 15, 1, 'sadsaddsadsadsa', 104, '2025-08-07 09:13:24'),
(16, 16, 1, 'fsfsafsafsafsafsasafsa', 104, '2025-08-07 09:28:14'),
(17, 18, 1, 'dsadsadsadsadsa', 104, '2025-08-07 11:18:42'),
(18, 19, 1, 'sfsafsafsa', 104, '2025-08-07 11:20:04'),
(19, 20, 1, 'dsadsadsasadsadsad', 104, '2025-08-07 11:30:50'),
(20, 17, 1, 'sadsadsadsad', 104, '2025-08-07 11:34:07'),
(21, 5, 1, 'dsadsadsa', 104, '2025-08-09 14:25:27'),
(22, 5, 2, 'dsadsadsa', 104, '2025-08-09 14:25:28'),
(23, 3, 1, 'dsadsadsadsa', 104, '2025-08-09 14:25:43'),
(24, 21, 1, 'dsadsadsadsadsadsa', 104, '2025-08-11 11:33:26'),
(25, 22, 1, 'dasdsadasdas', 104, '2025-08-12 06:49:44'),
(26, 23, 1, 'dsadasdsadas', 104, '2025-08-12 06:52:09'),
(27, 25, 1, 'tekprosis', 104, '2025-08-12 06:54:06'),
(28, 24, 1, 'dsadsadsadsa', 104, '2025-08-12 07:20:56'),
(29, 24, 2, 'dsadsadsadsa', 104, '2025-08-12 07:20:58'),
(30, 26, 1, 'Survivor ne zaman başlayacak acun bey merakla bekliyoruz.', 104, '2025-08-12 09:54:34'),
(31, 26, 2, 'Survivor ne zaman başlayacak acun bey merakla bekliyoruz.', 104, '2025-08-12 09:54:36'),
(32, 27, 1, 'dasdsadsadsadas', 104, '2025-08-13 07:16:13'),
(33, 33, 1, 'test', 104, '2025-08-18 09:44:56'),
(34, 36, 1, 'dsadasdsadsadsa', 104, '2025-08-21 12:41:37'),
(35, 35, 1, 'dasdsadssa', 104, '2025-08-21 12:46:19'),
(36, 34, 1, 'sadsadsadsa', 104, '2025-08-21 12:46:25'),
(37, 32, 1, 'sadsadsa', 104, '2025-08-21 12:48:29');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mimari`
--

DROP TABLE IF EXISTS `mimari`;
CREATE TABLE IF NOT EXISTS `mimari` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ad` varchar(255) NOT NULL,
  `mimar` varchar(255) NOT NULL,
  `tarih` int NOT NULL,
  `yer` varchar(255) NOT NULL,
  `stil` varchar(255) NOT NULL,
  `aciklama` varchar(255) NOT NULL,
  `resim` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `mimari`
--

INSERT INTO `mimari` (`id`, `ad`, `mimar`, `tarih`, `yer`, `stil`, `aciklama`, `resim`) VALUES
(1, 'Tac Mahal', 'Ustad Ahmad Lahauri', 1632, 'Agra, Hindistan', 'Mughal Mimari', 'Beyaz mermerden inşa edilmiş bu muhteşem anıt mezar, dünya mimarisinin en güzel örneklerinden biridir. Şah Cihan\'ın eşi Mümtaz Mahal için yaptırdığı bu eser, aşkın ve sanatın mükemmel birleşimidir.', 'https://arkeofili.com/wp-content/uploads/2021/01/mahal3.jpg'),
(2, 'Sagrada Familia', 'Antoni Gaudí', 1882, 'Barselona, İspanya', 'Art Nouveau', 'Gaudí\'nin en büyük eseri olan bu katedral, doğal formlardan ilham alan organik mimarinin en etkileyici örneğidir. Hala inşaat halinde olan yapı, modern mimarinin başyapıtlarından biridir.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/ee/Sagrada_Familia_01.jpg/1280px-Sagrada_Familia_01.jpg'),
(3, 'Parthenon', 'Iktinos ve Kallikrates', 0, 'Atina, Yunanistan', 'Antik Yunan', 'Antik Yunan mimarisinin en mükemmel örneği olan Parthenon, orantı ve simetri prensiplerinin en güzel uygulamasıdır. Athena Parthenos tapınağı olarak inşa edilmiştir.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/da/The_Parthenon_in_Athens.jpg/960px-The_Parthenon_in_Athens.jpg'),
(4, 'Notre-Dame Katedrali', 'Bilinmeyen', 1163, 'Paris, Fransa', 'Fransız Gotik', 'Fransız Gotik mimarisinin en önemli örneği olan Notre-Dame, Paris\'in kalbinde yükselen muhteşem bir dini yapıdır. Gül pencereleri ve uçan payandalarıyla ünlüdür.', 'https://upload.wikimedia.org/wikipedia/commons/f/f7/Notre-Dame_de_Paris%2C_4_October_2017.jpg'),
(5, 'Sydney Opera House', 'Jørn Utzon', 1959, 'Sidney, Avustralya', 'Modern Dışavurumcu', 'Deniz kabuklarından ilham alan bu ikonik yapı, modern mimarinin en tanınmış örneklerinden biridir. UNESCO Dünya Mirası Listesi\'nde yer alan ve Sidney\'in simgesi haline gelmiştir.', 'https://upload.wikimedia.org/wikipedia/commons/9/92/Sydney_Opera_House_from_Circular_Quay%2C_2023%2C_10.jpg'),
(6, 'Petra Antik Kenti', 'Nabatsanlar', 0, 'Ürdün', 'Kaya Oymacılığı', 'Kaya içine oyulmuş bu antik kent, ticaret yollarının kesişim noktasında kurulmuştur. El-Khazneh (Hazine) binası, kentin en etkileyici yapısıdır ve Helenistik mimari özellikler taşır.', 'https://blog.tatil.com/wp-content/uploads/2023/11/petra-antik-kenti.webp'),
(7, 'Colosseum', 'Bilinmeyen', 0, 'Roma, İtalya', 'Roma İmparatorluk', 'Antik Roma\'nın en büyük amfitiyatrosu olan Colosseum, gladyatör dövüşleri ve halk gösterileri için inşa edilmiştir. Roma mimarisinin bir mühendislik harikasıdır.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/Colosseo_2020.jpg/960px-Colosseo_2020.jpg'),
(8, 'Angkor Wat', 'Suryavarman II', 12, 'Siem Reap, Kamboçya', 'Khmer', 'Dünyanın en büyük dini yapısı olan Angkor Wat, Hindu tanrısı Vişnu\'ya adanmıştır. Karmaşık kabartmaları ve kuleleriyle Khmer mimarisinin en önemli örneğidir.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/41/Angkor_Wat.jpg/1200px-Angkor_Wat.jpg'),
(9, 'Burj Khalifa', 'Adrian Smith', 2004, 'Dubai, BAE', 'Modern', '828 metre yüksekliğindeki Burj Khalifa, dünyanın en yüksek binasıdır. İslami geometrik desenlerden ilham alan tasarımı, modern teknoloji ile geleneksel estetiği birleştirir.', 'https://upload.wikimedia.org/wikipedia/en/thumb/9/93/Burj_Khalifa.jpg/250px-Burj_Khalifa.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `muzikler`
--

DROP TABLE IF EXISTS `muzikler`;
CREATE TABLE IF NOT EXISTS `muzikler` (
  `id` int NOT NULL AUTO_INCREMENT,
  `muzik_adi` varchar(255) NOT NULL,
  `tur` varchar(255) NOT NULL,
  `sure` int NOT NULL,
  `yayin_yili` varchar(255) NOT NULL,
  `spotify_url` varchar(255) NOT NULL,
  `sanatci` varchar(255) NOT NULL,
  `foto_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `muzikler`
--

INSERT INTO `muzikler` (`id`, `muzik_adi`, `tur`, `sure`, `yayin_yili`, `spotify_url`, `sanatci`, `foto_url`) VALUES
(1, 'Moonlight Sonata', 'Klasik', 879, '1801', 'https://open.spotify.com/intl-tr/track/3ilnnpmMMpp863r2X0EHQK', 'Ludwig van Beethoven', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=300&h=300&fit=crop&crop=center'),
(2, 'Symphony No. 5', 'Klasik', 2007, '1808', 'https://open.spotify.com/intl-tr/track/5rkhImAE9y8vHwWPjfkx61?si=d28f7cd7664d48cf', 'Ludwig van Beethoven', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=300&h=300&fit=crop&crop=center'),
(3, 'The Four Seasons', 'Klasik', 2535, '1723', 'https://open.spotify.com/intl-tr/album/1BxxmokA4eBg1EBpfYP1fC?si=VpUlWF3dQo-isGQJOI6ASw', 'Antonio Vivaldi', 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=300&h=300&fit=crop&crop=center'),
(4, 'Eine kleine Nachtmusik', 'Klasik', 1012, '1787', 'https://open.spotify.com/intl-tr/track/4KLVPRo0f6XUJa4t4dnRW6?si=506fac1509564b1e', 'Wolfgang Amadeus Mozart', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=300&h=300&fit=crop&crop=center'),
(5, 'Toccata and Fugue in D minor', 'Klasik', 525, '1704', 'https://open.spotify.com/intl-tr/track/0BWJNm4TrO6H3qgiCmDBjM?si=57fab4fb606a4519', 'Johann Sebastian Bach', 'https://images.unsplash.com/photo-1516280440614-37939bbacd81?w=300&h=300&fit=crop&crop=center'),
(6, 'Prelude in C Major', 'Klasik', 138, '1722', 'https://open.spotify.com/intl-tr/track/2CnZGR5wLmfizXyTM3J94e?si=7cfcb245564449a1', 'Johann Sebastian Bach', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=300&h=300&fit=crop&crop=center'),
(7, 'Symphony No. 9 Choral', 'Klasik', 4440, '1824', 'https://open.spotify.com/intl-tr/track/4E58yUDWs638JHlngLXFYv?si=12f55ea4b7374cec', 'Ludwig van Beethoven', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=300&h=300&fit=crop&crop=center'),
(8, 'Piano Concerto No. 21', 'Klasik', 1710, '1785', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Wolfgang Amadeus Mozart', 'https://images.unsplash.com/photo-1516280440614-37939bbacd81?w=300&h=300&fit=crop&crop=center'),
(9, 'Canon in D', 'Klasik', 320, '1680', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Johann Pachelbel', 'https://images.unsplash.com/photo-1516280440614-37939bbacd81?w=300&h=300&fit=crop&crop=center'),
(10, 'Symphony No. 40', 'Klasik', 1785, '1788', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Wolfgang Amadeus Mozart', 'https://images.unsplash.com/photo-1516280440614-37939bbacd81?w=300&h=300&fit=crop&crop=center'),
(11, 'Für Elise', 'Klasik', 190, '1810', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Ludwig van Beethoven', 'https://images.unsplash.com/photo-1516280440614-37939bbacd81?w=300&h=300&fit=crop&crop=center'),
(12, 'Air on the G String', 'Klasik', 255, '1723', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Johann Sebastian Bach', 'https://images.unsplash.com/photo-1516280440614-37939bbacd81?w=300&h=300&fit=crop&crop=center'),
(13, 'Take Five', 'Jazz', 324, '1959', 'https://open.spotify.com/track/1YQWosTIljIvxAgHWTp7KP', 'Dave Brubeck Quartet', 'https://images.unsplash.com/photo-1511379938547-c1f69419868d?w=80&h=80&fit=crop&crop=center'),
(14, 'So What', 'Jazz', 567, '1959', 'https://open.spotify.com/track/4vq49ovV9wDgfmrDvZvl2Q', 'Miles Davis', 'https://images.unsplash.com/photo-1511379938547-c1f69419868d?w=80&h=80&fit=crop&crop=center'),
(15, 'What a Wonderful World', 'Jazz', 139, '1967', 'https://open.spotify.com/track/29U7stRjqHU6rMiS8BfaI9', 'Louis Armstrong', 'https://images.unsplash.com/photo-1511379938547-c1f69419868d?w=80&h=80&fit=crop&crop=center'),
(16, 'Take the A Train', 'Jazz', 180, '1941', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Duke Ellington', 'https://images.unsplash.com/photo-1511379938547-c1f69419868d?w=80&h=80&fit=crop&crop=center'),
(17, 'Blue in Green', 'Jazz', 338, '1959', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Miles Davis', 'https://images.unsplash.com/photo-1511379938547-c1f69419868d?w=80&h=80&fit=crop&crop=center'),
(18, 'Giant Steps', 'Jazz', 293, '1960', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'John Coltrane', 'https://images.unsplash.com/photo-1511379938547-c1f69419868d?w=80&h=80&fit=crop&crop=center'),
(19, 'Bohemian Rhapsody', 'Rock', 354, '1975', 'https://open.spotify.com/track/3z8h0TU7ReDPLIbEnYhWZb', 'Queen', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(20, 'Stairway to Heaven', 'Rock', 482, '1971', 'https://open.spotify.com/track/5CQ30WqJwcep0pYcV4AMNc', 'Led Zeppelin', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(21, 'Hotel California', 'Rock', 391, '1976', 'https://open.spotify.com/track/40riOy7x9W7GXjyGp4pjAv', 'Eagles', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(22, 'Sweet Child O Mine', 'Rock', 356, '1987', 'https://open.spotify.com/track/7snQQk1zcKl8gZ92AnuZWg', 'Guns N Roses', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(23, 'Smells Like Teen Spirit', 'Rock', 301, '1991', 'https://open.spotify.com/track/5ghIJDpPoe3CfHMGu71E6T', 'Nirvana', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(24, 'Wonderwall', 'Rock', 259, '1995', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Oasis', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(25, 'Blinding Lights', 'Pop', 200, '2019', 'https://open.spotify.com/track/0VjIjW4GlUZAMYd2vXMi3b', 'The Weeknd', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(26, 'Levitating', 'Pop', 203, '2020', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Dua Lipa', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(27, 'As It Was', 'Pop', 167, '2022', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Harry Styles', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(28, 'Flowers', 'Pop', 200, '2023', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Miley Cyrus', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(29, 'Vampire', 'Pop', 219, '2023', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Olivia Rodrigo', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(30, 'Cruel Summer', 'Pop', 178, '2019', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Taylor Swift', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(31, 'The Sound of Silence', 'Folk', 184, '1964', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Simon & Garfunkel', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(32, 'Blowin in the Wind', 'Folk', 165, '1963', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Bob Dylan', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(33, 'House of the Rising Sun', 'Folk', 259, '1964', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'The Animals', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(34, 'Scarborough Fair', 'Folk', 195, '1966', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Simon & Garfunkel', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(35, 'Mr. Tambourine Man', 'Folk', 310, '1965', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Bob Dylan', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(36, 'California Dreamin', 'Folk', 174, '1965', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'The Mamas & The Papas', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(37, 'Strobe', 'Elektronik', 639, '2009', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Deadmau5', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(38, 'Levels', 'Elektronik', 342, '2011', 'https://open.spotify.com/track/1rfOFabJT42IMJP9N8b5qh', 'Avicii', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(39, 'Animals', 'Elektronik', 342, '2013', 'https://open.spotify.com/track/65hdgOfz1IZ1dXIfanGs2h', 'Martin Garrix', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(40, 'Faded', 'Elektronik', 212, '2015', 'https://open.spotify.com/track/7gHs73wELdeycvS48RfYPG', 'Alan Walker', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(41, 'Clarity', 'Elektronik', 271, '2012', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Zedd ft. Foxes', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(42, 'Wake Me Up', 'Elektronik', 247, '2013', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Avicii', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(43, 'The Thrill Is Gone', 'Blues', 314, '1969', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'B.B. King', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(44, 'Hoochie Coochie Man', 'Blues', 165, '1954', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Muddy Waters', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(45, 'Red House', 'Blues', 198, '1967', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Jimi Hendrix', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(46, 'Born Under a Bad Sign', 'Blues', 168, '1967', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Albert King', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(47, 'Pride and Joy', 'Blues', 235, '1983', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Stevie Ray Vaughan', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(48, 'Sweet Home Chicago', 'Blues', 180, '1936', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Robert Johnson', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(49, 'Old Town Road', 'Country', 157, '2019', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Lil Nas X ft. Billy Ray Cyrus', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(50, 'The Bones', 'Country', 209, '2019', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Maren Morris', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(51, 'Tennessee Whiskey', 'Country', 240, '2015', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Chris Stapleton', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(52, 'Die a Happy Man', 'Country', 219, '2015', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Thomas Rhett', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(53, 'Humble and Kind', 'Country', 264, '2016', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Tim McGraw', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(54, 'Meant to Be', 'Country', 193, '2017', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Bebe Rexha ft. Florida Georgia Line', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(55, 'One Love', 'Reggae', 167, '1977', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Bob Marley & The Wailers', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(56, 'No Woman, No Cry', 'Reggae', 263, '1974', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Bob Marley & The Wailers', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(57, 'Buffalo Soldier', 'Reggae', 261, '1983', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Bob Marley & The Wailers', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(58, 'Three Little Birds', 'Reggae', 181, '1977', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Bob Marley & The Wailers', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(59, 'Is This Love', 'Reggae', 234, '1978', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Bob Marley & The Wailers', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(60, 'Jamming', 'Reggae', 193, '1977', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Bob Marley & The Wailers', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(61, 'Gods Plan', 'Hip Hop', 198, '2018', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Drake', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(62, 'Sicko Mode', 'Hip Hop', 312, '2018', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Travis Scott', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(63, 'Old Town Road', 'Hip Hop', 157, '2019', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Lil Nas X', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(64, 'Bad Guy', 'Hip Hop', 194, '2019', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Billie Eilish', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(65, 'Blinding Lights', 'Hip Hop', 200, '2019', 'https://open.spotify.com/track/0VjIjW4GlUZAMYd2vXMi3b', 'The Weeknd', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(66, 'Mood', 'Hip Hop', 140, '2020', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', '24kGoldn ft. Iann Dior', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(67, 'Despacito', 'World', 229, '2017', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Luis Fonsi ft. Daddy Yankee', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(68, 'Gangnam Style', 'World', 252, '2012', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'PSY', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(69, 'Havana', 'World', 217, '2017', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Camila Cabello', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(70, 'Shape of You', 'World', 233, '2017', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Ed Sheeran', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(71, 'Mi Gente', 'World', 185, '2017', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'J Balvin, Willy William', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(72, 'Con Calma', 'World', 193, '2019', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Daddy Yankee ft. Snow', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(73, 'Claire de Lune', 'Ambient', 300, '1905', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Debussy', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(74, 'Weightless', 'Ambient', 480, '2011', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Marconi Union', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(75, 'Echoes', 'Ambient', 1383, '1971', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Pink Floyd', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(76, 'The Great Gig in the Sky', 'Ambient', 284, '1973', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Pink Floyd', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(77, 'Shine On You Crazy Diamond', 'Ambient', 1380, '1975', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Pink Floyd', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
(78, 'Comfortably Numb', 'Ambient', 382, '1979', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Pink Floyd', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pratik_tarifler`
--

DROP TABLE IF EXISTS `pratik_tarifler`;
CREATE TABLE IF NOT EXISTS `pratik_tarifler` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ad` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `malzemeler` text NOT NULL,
  `hazirlanis` text NOT NULL,
  `sure` varchar(100) NOT NULL,
  `zorluk` enum('Kolay','Orta','Zor') DEFAULT 'Kolay',
  `porsiyon` varchar(50) NOT NULL,
  `kalori` varchar(50) DEFAULT NULL,
  `resim` varchar(500) NOT NULL,
  `aciklama` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `pratik_tarifler`
--

INSERT INTO `pratik_tarifler` (`id`, `ad`, `kategori`, `malzemeler`, `hazirlanis`, `sure`, `zorluk`, `porsiyon`, `kalori`, `resim`, `aciklama`, `created_at`, `updated_at`) VALUES
(1, 'Mercimek Çorbası', 'Çorbalar', 'Kırmızı mercimek, soğan, havuç, patates, tereyağı, un, tuz, karabiber, pul biber', 'Soğan ve havuç doğranır, tereyağında kavrulur. Mercimek ve patates eklenir, su ile pişirilir. Blenderdan geçirilir.', '25 dakika', 'Kolay', '4 kişilik', '180 kcal', 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcS5KwqeDEugSnn__Tg53ROinlGZ0n8jNs7RPpXyhEnqRDVfwCPATYrgIGaTCD-qwzr6vWw75qmxaVNmRA-b-CB1ENYvjpUzbmdfCxy8bzGf', 'Hızlı ve besleyici mercimek çorbası, kış günlerinin vazgeçilmezi.', '2025-08-12 14:30:17', '2025-08-12 14:34:46'),
(2, 'Omlet', 'Kahvaltı', 'Yumurta, süt, peynir, domates, biber, tuz, karabiber, tereyağı', 'Yumurtalar çırpılır, malzemeler eklenir. Tereyağında pişirilir, katlanır.', '10 dakika', 'Kolay', '2 kişilik', '220 kcal', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTtnIulCdMnBRw9fsPERtVHrztAl8EeENrdUw&s', 'Kahvaltıların pratik ve lezzetli omleti, sebzelerle zenginleştirilmiş.', '2025-08-12 14:30:17', '2025-08-12 14:31:15'),
(3, 'Makarna Carbonara', 'Makarna', 'Spaghetti, yumurta, peynir, pastırma, karabiber, tuz, zeytinyağı', 'Makarna haşlanır, pastırma kızartılır. Yumurta ve peynir karıştırılır, makarna ile birleştirilir.', '15 dakika', 'Kolay', '4 kişilik', '380 kcal', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRFr2FKGsct23e36BrEKAiat41HmmR7KGoN4g&s', 'İtalyan mutfağının klasik makarnası, hızlı ve lezzetli.', '2025-08-12 14:30:17', '2025-08-12 14:31:32'),
(4, 'Tavuk Sote', 'Ana Yemek', 'Tavuk göğsü, soğan, biber, domates, zeytinyağı, tuz, karabiber, kekik', 'Tavuk kuşbaşı doğranır, sebzelerle birlikte sote edilir. Baharatlar eklenir.', '20 dakika', 'Kolay', '4 kişilik', '280 kcal', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSO2yQyUrgkAW9mjE3qcvkJjSl3sIe83ERG7A&s', 'Pratik tavuk sote, sebzelerle zenginleştirilmiş lezzetli ana yemek.', '2025-08-12 14:30:17', '2025-08-12 14:31:49'),
(5, 'Salata', 'Salata', 'Marul, domates, salatalık, havuç, zeytin, peynir, zeytinyağı, limon, tuz', 'Sebzeler doğranır, karıştırılır. Zeytinyağı ve limon sosu hazırlanır.', '10 dakika', 'Kolay', '4 kişilik', '120 kcal', 'https://i.nefisyemektarifleri.com/2020/05/05/karisik-salata-tarifi.jpg', 'Taze ve sağlıklı salata, her öğünün yanında servis edilebilir.', '2025-08-12 14:30:17', '2025-08-12 14:32:04'),
(6, 'Pilav', 'Garnitür', 'Pirinç, soğan, tereyağı, tuz, karabiber, su', 'Soğan tereyağında kavrulur, pirinç eklenir. Su ile pişirilir.', '25 dakika', 'Kolay', '6 kişilik', '200 kcal', 'https://www.berceste.com.tr/idea/dm/86/myassets/blogs/pilav-tarifi-tane-tane.jpg?revision=1628682122', 'Geleneksel Türk pilavı, her yemeğin yanında mükemmel gider.', '2025-08-12 14:30:17', '2025-08-12 14:32:17'),
(7, 'Sandviç', 'Hızlı Yemek', 'Ekmek, tavuk göğsü, marul, domates, peynir, mayonez, hardal', 'Ekmek arası malzemeler dizilir, soslar eklenir.', '5 dakika', 'Kolay', '2 adet', '320 kcal', 'https://www.unileverfoodsolutions.com.tr/dam/global-ufs/mcos/TURKEY/calcmenu/recipes/TR-recipes/general/fesle%C4%9Fenli-%C5%9Fark%C3%BCteri-sandvi%C3%A7/main-header.jpg', 'Hızlı ve pratik sandviç, acil durumların kurtarıcısı.', '2025-08-12 14:30:17', '2025-08-12 14:37:45'),
(9, 'Kaşarlı Tost', 'Hızlı Yemek', 'Ekmek, peynir, domates, sucuk, tereyağı', 'Ekmek arası malzemeler konur, tost makinesinde pişirilir.', '8 dakika', 'Kolay', '2 adet', '280 kcal', 'https://static.ticimax.cloud/cdn-cgi/image/width=-,quality=99/9247/uploads/urunresimleri/buyuk/kasarli-tost-dcb9.jpg', 'Klasik Türk tostu, kahvaltıların vazgeçilmezi.', '2025-08-12 14:30:17', '2025-08-12 14:37:24'),
(10, 'Meyve Salatası', 'Tatlı', 'Elma, muz, portakal, üzüm, çilek, bal, limon suyu', 'Meyveler doğranır, karıştırılır. Bal ve limon suyu eklenir.', '10 dakika', 'Kolay', '4 kişilik', '120 kcal', 'https://i.tmgrup.com.tr/sfr/2013/07/25/Orjinal/621029954224.jpg', 'Sağlıklı ve lezzetli meyve salatası, tatlı ihtiyacını karşılar.', '2025-08-12 14:30:17', '2025-08-12 14:34:01');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `resimler`
--

DROP TABLE IF EXISTS `resimler`;
CREATE TABLE IF NOT EXISTS `resimler` (
  `id` int NOT NULL AUTO_INCREMENT,
  `resim_adi` varchar(255) NOT NULL,
  `sanatci` varchar(255) NOT NULL,
  `tarih` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `resim_url` varchar(255) NOT NULL,
  `aciklama` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `resimler`
--

INSERT INTO `resimler` (`id`, `resim_adi`, `sanatci`, `tarih`, `resim_url`, `aciklama`) VALUES
(1, 'Mona Lisa', 'Leonardo da Vinci', '1503', 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/ec/Mona_Lisa%2C_by_Leonardo_da_Vinci%2C_from_C2RMF_retouched.jpg/1200px-Mona_Lisa%2C_by_Leonardo_da_Vinci%2C_from_C2RMF_retouched.jpg', 'Mona Lisa, Leonardo da Vinci\'nin en ünlü eseridir. İtalyan Rönesans döneminde yapılan bu portre, dünya sanat tarihinin en değerli ve en çok tanınan eserlerinden biridir. Eserin gizemli gülümsemesi ve sfumato tekniği ile yapılan yumuşak geçişler, sanat tar'),
(2, 'Yıldızlı Gece', 'Vincent van Gogh', '1889', 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/ea/Van_Gogh_-_Starry_Night_-_Google_Art_Project.jpg/1200px-Van_Gogh_-_Starry_Night_-_Google_Art_Project.jpg', 'Yıldızlı Gece, Van Gogh\'un en ünlü eserlerinden biridir. Sanatçının Saint-Rémy-de-Provence\'daki akıl hastanesinde kaldığı dönemde yapılmıştır. Eser, gecenin dinamik ve hareketli bir yorumunu sunar. Dönen bulutlar ve parlayan yıldızlar, sanatçının iç dünya'),
(3, 'Guernica', 'Pablo Picasso', '1937', 'https://hbyazar.com/wp-content/uploads/2020/09/guernica-detay-iki.jpg', 'Guernica, Picasso\'nun İspanya İç Savaşı sırasında Nazi Almanyası\'nın Guernica şehrini bombalaması üzerine yaptığı güçlü bir anti-savaş eseridir. Siyah, beyaz ve gri tonlarında yapılan eser, savaşın dehşetini ve acısını dramatik bir şekilde yansıtır. Moder'),
(4, 'Çığlık', 'Edvard Munch', '1893', 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c5/Edvard_Munch%2C_1893%2C_The_Scream%2C_oil%2C_tempera_and_pastel_on_cardboard%2C_91_x_73_cm%2C_National_Gallery_of_Norway.jpg/960px-Edvard_Munch%2C_1893%2C_The_Scream%2C_oil%2C_tempera_and_pastel_on', 'Çığlık, Edvard Munch\'un en ünlü eseridir ve ekspresyonist sanatın simgesi haline gelmiştir. Eser, modern insanın varoluşsal kaygısını ve yalnızlığını güçlü bir şekilde ifade eder. Dalgalı çizgiler ve yoğun renkler kullanılarak yapılan eser, sanatçının iç '),
(5, 'Son Akşam Yemeği', 'Leonardo da Vinci', '1495', 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/48/The_Last_Supper_-_Leonardo_Da_Vinci_-_High_Resolution_32x16.jpg/960px-The_Last_Supper_-_Leonardo_Da_Vinci_-_High_Resolution_32x16.jpg', 'Son Akşam Yemeği, Leonardo da Vinci\'nin Milano\'daki Santa Maria delle Grazie manastırının yemek salonunda yaptığı fresk eseridir. İsa\'nın havarileriyle son akşam yemeğini yediği anı tasvir eder. Perspektif kullanımı ve karakterlerin duygusal ifadeleri ile'),
(6, 'Venüs\'ün Doğuşu', 'Sandro Botticelli', '1485', 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Sandro_Botticelli_-_La_nascita_di_Venere_-_Google_Art_Project_-_edited.jpg/960px-Sandro_Botticelli_-_La_nascita_di_Venere_-_Google_Art_Project_-_edited.jpg', 'Venüs\'ün Doğuşu, Botticelli\'nin en ünlü eserlerinden biridir. Antik Yunan mitolojisinden esinlenen eser, güzellik tanrıçası Venüs\'ün deniz köpüğünden doğuşunu tasvir eder. Rönesans döneminin en güzel eserlerinden biri olarak kabul edilir ve klasik mitoloj');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `saglikli_besinler`
--

DROP TABLE IF EXISTS `saglikli_besinler`;
CREATE TABLE IF NOT EXISTS `saglikli_besinler` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ad` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `aciklama` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sure` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zorluk` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `porsiyon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kalori` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `protein` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `karbonhidrat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `yag` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lif` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resim` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `malzemeler` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `hazirlanis` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `puf_noktalari` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `saglikli_besinler`
--

INSERT INTO `saglikli_besinler` (`id`, `ad`, `kategori`, `aciklama`, `sure`, `zorluk`, `porsiyon`, `kalori`, `protein`, `karbonhidrat`, `yag`, `lif`, `resim`, `malzemeler`, `hazirlanis`, `puf_noktalari`, `created_at`, `updated_at`) VALUES
(1, 'Quinoa Salatası', 'Salata', 'Protein açısından zengin quinoa ile hazırlanmış besleyici salata', '20 dk', 'Kolay', '4 kişilik', '180 kcal', '8g', '25g', '6g', '4g', 'https://www.tumayinmutfagi.com/wp-content/uploads/2015/03/kinoa.jpg', '1 su bardağı quinoa, 1 adet salatalık, 1 adet domates, 1/2 adet kırmızı soğan, 1/4 demet maydanoz, 2 yemek kaşığı zeytinyağı, 1 adet limon, tuz, karabiber', '1. Quinoa\'yı yıkayın ve süzün. 2. Tencereye alıp 2 su bardağı su ile haşlayın. 3. Sebzeleri doğrayın. 4. Tüm malzemeleri karıştırın. 5. Zeytinyağı ve limon suyu ekleyin.', 'Quinoa\'yı önceden yıkayarak acı tadını alabilirsiniz. Salatayı buzdolabında 2-3 gün saklayabilirsiniz.', '2025-08-13 06:42:55', '2025-08-15 10:53:14'),
(2, 'Avokado Smoothie', 'İçecek', 'Sağlıklı yağlar ve protein içeren besleyici smoothie', '5 dk', 'Çok Kolay', '2 kişilik', '220 kcal', '12g', '15g', '18g', '8g', 'https://splenda.com.tr/wp-content/uploads/2024/04/splenda-tarifler-avokado-ananas-smoothie_1000.jpg', '1 adet olgun avokado, 1 adet muz, 1 su bardağı süt, 1 yemek kaşığı bal, 1/2 çay kaşığı vanilya', '1. Avokado ve muzu soyun. 2. Tüm malzemeleri blender\'a koyun. 3. Pürüzsüz olana kadar çırpın. 4. Soğuk servis yapın.', 'Avokado\'nun olgun olması önemli. Muzu dondurucuda saklayarak daha soğuk bir smoothie elde edebilirsiniz.', '2025-08-13 06:42:55', '2025-08-15 10:52:53'),
(3, 'Mercimek Çorbası', 'Çorba', 'Demir ve protein açısından zengin besleyici çorba', '45 dk', 'Orta', '6 kişilik', '160 kcal', '10g', '28g', '2g', '12g', 'https://cdn.ye-mek.net/App_UI/Img/out/650/2024/02/esnaf-usulu-mercimek-corbasi-resimli-yemek-tarifi(12).jpg', '1 su bardağı kırmızı mercimek, 1 adet soğan, 1 adet havuç, 2 diş sarımsak, 1 yemek kaşığı zeytinyağı, 6 su bardağı su, tuz, karabiber, pul biber', '1. Soğan ve havuçları doğrayın. 2. Zeytinyağında kavurun. 3. Mercimek ve suyu ekleyin. 4. Yumuşayana kadar pişirin. 5. Blender\'dan geçirin.', 'Mercimeği önceden yıkayın. Çorbayı daha kıvamlı yapmak için patates ekleyebilirsiniz.', '2025-08-13 06:42:55', '2025-08-15 10:52:16'),
(4, 'Fırında Somon', 'Ana Yemek', 'Omega-3 açısından zengin sağlıklı balık yemeği', '25 dk', 'Orta', '2 kişilik', '280 kcal', '35g', '5g', '15g', '2g', 'https://cdn.ye-mek.net/App_UI/Img/out/650/2023/12/firinda-somon-resimli-yemek-tarifi(16).jpg', '2 adet somon filetosu, 2 adet limon, 2 yemek kaşığı zeytinyağı, 2 diş sarımsak, tuz, karabiber, kekik', '1. Fırını 200°C\'ye ısıtın. 2. Somonları yağlayın ve baharatlayın. 3. Limon dilimleri ekleyin. 4. 20-25 dakika pişirin.', 'Somonu fazla pişirmeyin, nemli kalması önemli. Limon suyu ile marine edebilirsiniz.', '2025-08-13 06:42:55', '2025-08-15 10:51:55'),
(5, 'Chia Pudding', 'Tatlı', 'Omega-3 ve lif açısından zengin sağlıklı tatlı', '10 dk + 4 saat', 'Kolay', '2 kişilik', '180 kcal', '6g', '20g', '10g', '12g', 'https://booboosbakery.com/wp-content/uploads/2024/03/DSC08479-2.jpg', '1/4 su bardağı chia tohumu, 1 su bardağı süt, 1 yemek kaşığı bal, 1/2 çay kaşığı vanilya, mevsim meyveleri', '1. Tüm malzemeleri karıştırın. 2. 4 saat buzdolabında bekletin. 3. Üzerine meyve ekleyerek servis yapın.', 'Gece boyunca bekletirseniz daha kıvamlı olur. Badem sütü kullanarak vegan yapabilirsiniz.', '2025-08-13 06:42:55', '2025-08-15 10:51:32');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `seyahatler`
--

DROP TABLE IF EXISTS `seyahatler`;
CREATE TABLE IF NOT EXISTS `seyahatler` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ad` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ulke` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aciklama` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `gorulecekYerler` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `etkinlikler` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `restoranlar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `kategori` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `seyahatler`
--

INSERT INTO `seyahatler` (`id`, `ad`, `ulke`, `icon`, `foto`, `aciklama`, `gorulecekYerler`, `etkinlikler`, `restoranlar`, `kategori`, `created_at`) VALUES
(1, 'Paris', 'Fransa', '🗼', 'https://dixifuar.com/wp-content/uploads/2025/05/paris-sehir-rehberi.webp', 'Aşkın, sanatın ve modanın başkenti. Eyfel Kulesi, Louvre Müzesi ve Notre-Dame Katedrali ile dünyanın en romantik şehri.', 'Eyfel Kulesi, Louvre Müzesi, Notre-Dame Katedrali, Arc de Triomphe, Champs-Élysées, Versailles Sarayı, Montmartre, Seine Nehri', 'Paris Fashion Week, Fransız Açık Tenis Turnuvası, Bastille Günü kutlamaları, Paris Jazz Festivali, Nuit Blanche', 'Le Jules Verne, L\'Arpège, Le Comptoir du Relais, Septime, L\'Ami Louis', 'Avrupa Seyahatleri', '2025-08-14 11:29:46'),
(2, 'Roma', 'İtalya', '🏛️', 'https://italyadaegitim.com/wp-content/uploads/2020/11/kolezyum-roma-1-1.jpg', 'Antik Roma İmparatorluğu\'nun kalbi. Colosseum, Vatikan ve tarihi sokaklarıyla binlerce yıllık tarihi yaşatan şehir.', 'Colosseum, Vatikan Müzeleri, Trevi Çeşmesi, Pantheon, Roma Forumu, Villa Borghese, Trastevere, Piazza Navona', 'Roma Film Festivali, Estate Romana, Papa\'nın Paskalya ayini, Roma Opera Festivali, Notte Bianca', 'La Pergola, Roscioli, Armando al Pantheon, Da Enzo al 29, Il Pagliaccio', 'Avrupa Seyahatleri', '2025-08-14 11:29:46'),
(3, 'Barcelona', 'İspanya', '🏰', 'https://images.unsplash.com/photo-1539037116277-4db20889f2d4?w=800&h=600&fit=crop', 'Gaudi\'nin mimari şaheserleri, canlı kültürü ve Akdeniz iklimi ile İspanya\'nın en dinamik şehri.', 'Sagrada Familia, Park Güell, Casa Batlló, La Rambla, Barri Gòtic, Montjuïc, Barceloneta, Parc de la Ciutadella', 'Sonar Festivali, La Mercè Festivali, Barcelona Fashion Week, Primavera Sound, Festa Major de Gràcia', 'El Celler de Can Roca, Tickets, Disfrutar, Cal Pep, Quimet & Quimet', 'Avrupa Seyahatleri', '2025-08-14 11:29:46'),
(4, 'Amsterdam', 'Hollanda', '🌷', 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=800&h=600&fit=crop', 'Kanalları, bisiklet kültürü ve özgürlükçü atmosferi ile Avrupa\'nın en yaşanabilir şehirlerinden biri.', 'Rijksmuseum, Van Gogh Müzesi, Anne Frank Evi, Dam Meydanı, Jordaan, Vondelpark, Red Light District, Canal Ring', 'King\'s Day, Amsterdam Dance Event, Tulip Festivali, Grachtenfestival, Museum Night', 'Restaurant Ciel Bleu, De Kas, Restaurant Floreyn, Moeders, Ciel Bleu', 'Avrupa Seyahatleri', '2025-08-14 11:29:46'),
(5, 'Prag', 'Çek Cumhuriyeti', '🏰', 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a7/Prague_%286365119737%29.jpg/1200px-Prague_%286365119737%29.jpg', 'Orta Çağ mimarisi, büyülü atmosferi ve biraları ile Avrupa\'nın en güzel şehirlerinden biri.', 'Prag Kalesi, Charles Köprüsü, Old Town Square, Astronomical Clock, St. Vitus Cathedral, Jewish Quarter, Petřín Hill, Wenceslas Square', 'Prag Spring Festivali, Prague Fringe Festival, Prague Food Festival, Christmas Markets, Prague Beer Festival', 'La Degustation, Field, U Modré Kachničky, Lokál, Sansho', 'Avrupa Seyahatleri', '2025-08-14 11:29:46'),
(6, 'Viyana', 'Avusturya', '🎭', 'https://images.unsplash.com/photo-1516550893923-42d28e5677af?w=800&h=600&fit=crop', 'Müziğin, sanatın ve imparatorluk ihtişamının şehri. Mozart, Beethoven ve Habsburg hanedanının izleri.', 'Schönbrunn Palace, St. Stephen\'s Cathedral, Belvedere Palace, Hofburg Palace, Vienna State Opera, Prater, Ringstrasse, Museum Quarter', 'Vienna Opera Ball, Vienna Festival, Christmas Markets, Vienna Jazz Festival, Donauinselfest', 'Steirereck, Silvio Nickol, Plachutta, Figlmüller, Café Central', 'Avrupa Seyahatleri', '2025-08-14 11:29:46'),
(7, 'Budapeşte', 'Macaristan', '🏛️', 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=800&h=600&fit=crop', 'Tuna nehrinin iki yakasında kurulu, termal banyoları ve güzel mimarisi ile Doğu Avrupa\'nın incisi.', 'Parliament Building, Buda Castle, Fisherman\'s Bastion, Chain Bridge, St. Stephen\'s Basilica, Széchenyi Baths, Heroes\' Square, Margaret Island', 'Budapest Spring Festival, Sziget Festival, Budapest Wine Festival, Christmas Markets, Budapest International Documentary Festival', 'Costes, Gundel, Menza, Central Market Hall, Ruszwurm', 'Avrupa Seyahatleri', '2025-08-14 11:29:46'),
(8, 'Lizbon', 'Portekiz', '🌊', 'https://images.unsplash.com/photo-1502086223501-7ea6ecd79368?w=800&h=600&fit=crop', 'Tejo nehri kıyısında, fado müziği ve pastel de nata ile Portekiz\'in başkenti.', 'Belém Tower, Jerónimos Monastery, Alfama, Castelo de São Jorge, Tram 28, Baixa, Bairro Alto, Miradouros', 'Fado Festival, Lisbon Book Fair, Santo António Festivali, Lisbon Fish & Flavours, Lisbon Architecture Triennale', 'Belcanto, Alma, A Cevicheria, Time Out Market, Pasteis de Belém', 'Avrupa Seyahatleri', '2025-08-14 11:29:46'),
(9, 'Kopenhag', 'Danimarka', '🧜‍♀️', 'https://images.unsplash.com/photo-1513622470522-26c3c8a854bc?w=800&h=600&fit=crop', 'Hygge kültürü, bisiklet dostu sokakları ve modern tasarımı ile dünyanın en mutlu şehirlerinden biri.', 'Little Mermaid, Nyhavn, Tivoli Gardens, Amalienborg Palace, Rosenborg Castle, Christiansborg Palace, Copenhagen Opera House, Freetown Christiania', 'Copenhagen Jazz Festival, Distortion Festival, Copenhagen Fashion Week, Christmas Markets, Copenhagen Cooking Festival', 'Geranium, Noma, Kødbyens Fiskebar, Torvehallerne, Café Norden', 'Avrupa Seyahatleri', '2025-08-14 11:29:46'),
(10, 'İstanbul', 'Türkiye', '🕌', 'https://images.unsplash.com/photo-1524231757912-21f4fe3a7200?w=800&h=600&fit=crop', 'Doğu ile Batı\'nın buluştuğu şehir. Bizans ve Osmanlı izleri, Boğaz\'ın güzelliği ile benzersiz.', 'Hagia Sophia, Blue Mosque, Topkapi Palace, Grand Bazaar, Bosphorus, Galata Tower, Dolmabahçe Palace, Basilica Cistern', 'İstanbul Film Festivali, İstanbul Müzik Festivali, İstanbul Bienali, Tulip Festivali, İstanbul Jazz Festivali', 'Mikla, Çiya Sofrası, Balıkçı Lokantası, Kebapçı Selim Usta, Pandeli', 'Avrupa Seyahatleri', '2025-08-14 11:29:46'),
(11, 'Tokyo', 'Japonya', '🗾', 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?w=800&h=600&fit=crop', 'Geleceğin şehri. Gelenek ve modernliğin mükemmel uyumu, neon ışıkları ve gelişmiş teknolojisi ile dünyanın en dinamik metropolü.', 'Senso-ji Tapınağı, Tokyo Skytree, Shibuya Crossing, Tsukiji Fish Market, Meiji Shrine, Tokyo Tower, Harajuku, Ueno Park', 'Cherry Blossom Festivali, Tokyo Game Show, Tokyo International Film Festival, Sumidagawa Fireworks, Sanja Matsuri', 'Sukiyabashi Jiro, Narisawa, Ichiran, Gonpachi, Kozasa', 'Asya Seyahatleri', '2025-08-14 11:29:46'),
(12, 'Seul', 'Güney Kore', '🏯', 'https://cdn2.enuygun.com/media/lib/1200x675/uploads/image/sonbaharda-gyeongbokgung-sarayi-seul-guney-kore-65396.webp', 'K-pop kültürü, gelişmiş teknolojisi ve geleneksel tapınakları ile Güney Kore\'nin başkenti.', 'Gyeongbokgung Palace, N Seoul Tower, Myeongdong, Hongdae, Gangnam, Bukchon Hanok Village, Changdeokgung Palace, Dongdaemun Design Plaza', 'Seoul Lantern Festival, Boryeong Mud Festival, Seoul Fashion Week, Cherry Blossom Festival, Seoul International Fireworks Festival', 'Jungsik, Mingles, La Yeon, Gwangjang Market, Myeongdong Kyoja', 'Asya Seyahatleri', '2025-08-14 11:29:46'),
(13, 'Bangkok', 'Tayland', '🏛️', 'https://avusturyagezi.com/assets/uploads/f6d59ad2b77665848f3c168064d02a38.jpg', 'Tayland\'ın başkenti, tapınakları, sokak yemekleri ve canlı gece hayatı ile Asya\'nın en dinamik şehirlerinden biri.', 'Grand Palace, Wat Phra Kaew, Wat Arun, Chatuchak Weekend Market, Khao San Road, Sukhumvit, Siam, Chinatown', 'Songkran Festival, Loy Krathong, Bangkok International Film Festival, Bangkok Fashion Week, Vegetarian Festival', 'Gaggan, Nahm, Bo.lan, Jay Fai, Thip Samai', 'Asya Seyahatleri', '2025-08-14 11:29:46'),
(14, 'Singapur', 'Singapur', '🌆', 'https://www.hostelworld.com/blog/wp-content/uploads/2019/07/hu-chen-__cBlRzLSTg-unsplash.jpg', 'Modern mimarisi, temiz sokakları ve çok kültürlü yapısı ile Asya\'nın en gelişmiş şehirlerinden biri.', 'Marina Bay Sands, Gardens by the Bay, Sentosa Island, Universal Studios, Orchard Road, Chinatown, Little India, Clarke Quay', 'Singapore Food Festival, Great Singapore Sale, Singapore International Film Festival, Singapore Fashion Week, Singapore Art Week', 'Odette, Les Amis, Burnt Ends, Hawker Chan, Jumbo Seafood', 'Asya Seyahatleri', '2025-08-14 11:29:46'),
(15, 'Hong Kong', 'Hong Kong', '🏙️', 'https://images.unsplash.com/photo-1536599018102-9f803c140fc1?w=800&h=600&fit=crop', 'Doğu ile Batı\'nın buluştuğu, gökdelenleri ve limanı ile dünyanın en önemli finans merkezlerinden biri.', 'Victoria Peak, Hong Kong Disneyland, Ocean Park, Tsim Sha Tsui, Central, Causeway Bay, Mong Kok, Lantau Island', 'Hong Kong Arts Festival, Hong Kong International Film Festival, Hong Kong Fashion Week, Chinese New Year, Mid-Autumn Festival', 'Amber, Lung King Heen, Tim Ho Wan, Din Tai Fung, Yung Kee', 'Asya Seyahatleri', '2025-08-14 11:29:46'),
(16, 'Dubai', 'Birleşik Arap Emirlikleri', '🏗️', 'https://images.unsplash.com/photo-1512453979798-5ea266f8880c?w=800&h=600&fit=crop', 'Çölün ortasında yükselen modern şehir. Burj Khalifa, Palm Jumeirah ve lüks alışveriş merkezleri ile dünyanın en etkileyici metropollerinden biri.', 'Burj Khalifa, Palm Jumeirah, Burj Al Arab, Dubai Mall, Dubai Frame, Dubai Miracle Garden, Dubai Creek, Jumeirah Beach', 'Dubai Shopping Festival, Dubai Food Festival, Dubai International Film Festival, Dubai Jazz Festival, Global Village', 'At.mosphere, Nobu Dubai, Zuma, Al Ustad Special Kabab, Ravi Restaurant', 'Asya Seyahatleri', '2025-08-14 11:29:46'),
(17, 'Mumbai', 'Hindistan', '🎬', 'https://images.unsplash.com/photo-1570168007204-dfb528c6958f?w=800&h=600&fit=crop', 'Bollywood\'un evi, Gateway of India ve Marine Drive ile Hindistan\'ın finans ve eğlence başkenti.', 'Gateway of India, Marine Drive, Juhu Beach, Elephanta Caves, Bandra-Worli Sea Link, Colaba Causeway, Crawford Market, Haji Ali Dargah', 'Mumbai Film Festival, Ganesh Chaturthi, Kala Ghoda Arts Festival, Mumbai Marathon, Elephanta Festival', 'Bombay Canteen, Gajalee, Trishna, Britannia & Co., Leopold Café', 'Asya Seyahatleri', '2025-08-14 11:29:46'),
(18, 'Pekin', 'Çin', '🏛️', 'https://images.unsplash.com/photo-1508804185872-d7badad00f7d?w=800&h=600&fit=crop', 'Çin\'in başkenti, Yasak Şehir ve Çin Seddi ile binlerce yıllık tarihi yaşatan antik metropol.', 'Yasak Şehir, Çin Seddi, Tiananmen Meydanı, Temple of Heaven, Summer Palace, Beihai Park, Hutong, 798 Art District', 'Beijing International Film Festival, Beijing Music Festival, Spring Festival, Mid-Autumn Festival, Beijing Design Week', 'Da Dong, Quanjude, Haidilao, Din Tai Fung Beijing, Made in China', 'Asya Seyahatleri', '2025-08-14 11:29:46'),
(19, 'New York', 'ABD', '🗽', 'https://images.unsplash.com/photo-1496442226666-8d4d0e62e6e9?w=800&h=600&fit=crop', 'Dünyanın finans ve kültür başkenti. Times Square, Central Park ve Özgürlük Heykeli ile dünyanın en ünlü şehri.', 'Times Square, Central Park, Statue of Liberty, Empire State Building, Broadway, Brooklyn Bridge, Metropolitan Museum, High Line', 'New York Fashion Week, Tribeca Film Festival, New York Comic Con, Macy\'s Thanksgiving Day Parade, New Year\'s Eve in Times Square', 'Eleven Madison Park, Le Bernardin, Per Se, Katz\'s Delicatessen, Peter Luger Steak House', 'Amerika Seyahatleri', '2025-08-14 11:29:46'),
(20, 'San Francisco', 'ABD', '🌉', 'https://images.unsplash.com/photo-1501594907352-04cda38ebc29?w=800&h=600&fit=crop', 'Silicon Valley\'in kalbi, Golden Gate Köprüsü ve Alcatraz Adası ile Kaliforniya\'nın en güzel şehri.', 'Golden Gate Bridge, Alcatraz Island, Fisherman\'s Wharf, Pier 39, Lombard Street, Chinatown, Haight-Ashbury, Golden Gate Park', 'Outside Lands Music Festival, San Francisco International Film Festival, Pride Parade, Fleet Week, Chinese New Year Parade', 'The French Laundry, Atelier Crenn, Benu, Zuni Café, Swan Oyster Depot', 'Amerika Seyahatleri', '2025-08-14 11:29:46'),
(21, 'Los Angeles', 'ABD', '🌴', 'https://drupal-prod.visitcalifornia.com/sites/default/files/styles/fluid_1920/public/2020-06/VC_PlacesToVisit_LosAngelesCounty_RF_1170794243.jpg.webp?itok=46pJYz8v', 'Hollywood\'un evi, Beverly Hills ve Venice Beach ile eğlence dünyasının merkezi.', 'Hollywood Walk of Fame, Universal Studios, Beverly Hills, Venice Beach, Santa Monica Pier, Griffith Observatory, The Getty Center, Downtown LA', 'Oscars, Coachella Valley Music Festival, LA Film Festival, LA Fashion Week, Rose Parade', 'Providence, n/naka, Osteria Mozza, In-N-Out Burger, Pink\'s Hot Dogs', 'Amerika Seyahatleri', '2025-08-14 11:29:46'),
(22, 'Miami', 'ABD', '🏖️', 'https://images.unsplash.com/photo-1535498730771-e735b998cd64?w=800&h=600&fit=crop', 'Tropikal iklimi, güzel plajları ve Latin kültürü ile Florida\'nın en canlı şehri.', 'South Beach, Art Deco Historic District, Wynwood Walls, Little Havana, Vizcaya Museum, Bayside Marketplace, Miami Beach, Coconut Grove', 'Art Basel Miami Beach, Ultra Music Festival, Miami International Film Festival, Calle Ocho Festival, Miami Fashion Week', 'Joe\'s Stone Crab, Versailles, Yardbird Southern Table, La Mar, Zuma', 'Amerika Seyahatleri', '2025-08-14 11:29:46'),
(23, 'Chicago', 'ABD', '🏙️', 'https://cdn.britannica.com/59/94459-050-DBA42467/Skyline-Chicago.jpg', 'Gökdelenleri, blues müziği ve deep dish pizza\'sı ile Amerika\'nın üçüncü büyük şehri.', 'Millennium Park, Willis Tower, Navy Pier, Art Institute of Chicago, Magnificent Mile, Cloud Gate, Wrigley Field, Lincoln Park', 'Lollapalooza, Chicago Jazz Festival, Taste of Chicago, Chicago Air and Water Show, Chicago Blues Festival', 'Alinea, Girl & the Goat, Lou Malnati\'s, Portillo\'s, Giordano\'s', 'Amerika Seyahatleri', '2025-08-14 11:29:46'),
(24, 'Las Vegas', 'ABD', '🎰', 'https://img.static-kl.com/images/media/4555AD79-58A9-4921-A1BECCD4ADF9EBAC', 'Eğlence dünyasının başkenti, kumarhaneleri, gösterileri ve gece hayatı ile dünyanın en canlı şehri.', 'The Strip, Bellagio Fountains, Fremont Street, Red Rock Canyon, Hoover Dam, High Roller, Neon Museum, Downtown Container Park', 'Electric Daisy Carnival, Life is Beautiful Festival, Las Vegas Food & Wine Festival, CES, World Series of Poker', 'Joël Robuchon, Gordon Ramsay Hell\'s Kitchen, Nobu, In-N-Out Burger, Lotus of Siam', 'Amerika Seyahatleri', '2025-08-14 11:29:46'),
(25, 'Washington DC', 'ABD', '🏛️', 'https://www.newyorkwelcome.net/kimg/1200/Washington_DC_Comprehensive_Guide.png', 'Amerika\'nın başkenti, Beyaz Saray, Capitol ve Smithsonian müzeleri ile tarihi ve politik merkez.', 'White House, Lincoln Memorial, National Mall, Smithsonian Museums, Capitol Hill, Washington Monument, Jefferson Memorial, Georgetown', 'National Cherry Blossom Festival, Smithsonian Folklife Festival, DC Jazz Festival, Capital Pride, Marine Corps Marathon', 'Minibar, Pineapple and Pearls, Rose\'s Luxury, Ben\'s Chili Bowl, Founding Farmers', 'Amerika Seyahatleri', '2025-08-14 11:29:46'),
(26, 'Boston', 'ABD', '🎓', 'https://images.ctfassets.net/szez98lehkfm/1XqeoQ6D14BNVAFKJEAivK/3d2860ee7f59ef8adddacac20b159800/MyIC_Inline_37766', 'Amerikan tarihinin beşiği, Harvard ve MIT üniversiteleri ile eğitim ve kültür merkezi.', 'Freedom Trail, Harvard University, Fenway Park, Boston Common, Quincy Market, USS Constitution, Beacon Hill, North End', 'Boston Marathon, Boston Pops Fireworks, Boston Calling Music Festival, Head of the Charles Regatta, St. Patrick\'s Day Parade', 'O Ya, Menton, Neptune Oyster, Union Oyster House, Mike\'s Pastry', 'Amerika Seyahatleri', '2025-08-14 11:29:46'),
(27, 'New Orleans', 'ABD', '🎷', 'https://www.hoteltonnelle.com/files/6795/22557038_ImageLargeWidth.jpg', 'Jazz müziğinin doğduğu yer, Mardi Gras festivali ve Cajun mutfağı ile Louisiana\'nın en renkli şehri.', 'French Quarter, Bourbon Street, Jackson Square, Garden District, St. Louis Cathedral, Audubon Park, Magazine Street, Frenchmen Street', 'Mardi Gras, New Orleans Jazz & Heritage Festival, French Quarter Festival, Voodoo Music Festival, Essence Festival', 'Commander\'s Palace, Galatoire\'s, Café du Monde, Antoine\'s, Dooky Chase\'s', 'Amerika Seyahatleri', '2025-08-14 11:29:46'),
(28, 'Seattle', 'ABD', '☕', 'https://cms.inspirato.com/ImageGen.ashx?image=%2Fmedia%2F7195464%2FSeattle_Dest_42-52432475.jpg&width=1081.5', 'Starbucks\'ın doğduğu yer, Space Needle ve yağmurlu iklimi ile Pasifik Kuzeybatısının en büyük şehri.', 'Space Needle, Pike Place Market, Chihuly Garden and Glass, Seattle Aquarium, Museum of Pop Culture, Kerry Park, Fremont Troll, Ballard Locks', 'Bumbershoot, Seattle International Film Festival, Seafair, Northwest Folklife Festival, Seattle Pride', 'Canlis, The Walrus and the Carpenter, Paseo, Salumi, Serious Pie', 'Amerika Seyahatleri', '2025-08-14 11:29:46'),
(29, 'Cape Town', 'Güney Afrika', '🏔️', 'https://images.unsplash.com/photo-1506973035872-a4ec16b8e8d9?w=800&h=600&fit=crop', 'Table Mountain, güzel plajları ve şarap bölgeleri ile Güney Afrika\'nın en güzel şehri.', 'Table Mountain, Robben Island, V&A Waterfront, Cape Point, Kirstenbosch Gardens, Bo-Kaap, Camps Bay, Stellenbosch', 'Cape Town International Jazz Festival, Cape Town International Film Festival, Cape Town Fashion Week, Cape Town Carnival, Two Oceans Marathon', 'The Test Kitchen, La Colombe, Pot Luck Club, The Greenhouse, Belthazar', 'Afrika Seyahatleri', '2025-08-14 11:29:46'),
(30, 'Marakeş', 'Fas', '🏺', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTI7HICLjpwtLuMmdbCgI89WWKWZmbLfRJ7nA&s2c735c?w=800&h=600&fit=crop', 'Fas\'ın kırmızı şehri, medina\'sı, bahçeleri ve geleneksel pazarları ile Kuzey Afrika\'nın en büyüleyici şehri.', 'Jemaa el-Fnaa, Bahia Palace, Majorelle Gardens, Koutoubia Mosque, Saadian Tombs, El Badi Palace, Menara Gardens, Atlas Mountains', 'Marrakech International Film Festival, Marrakech Biennale, Gnaoua World Music Festival, Marrakech Popular Arts Festival, Marrakech du Rire', 'La Mamounia, Nomad, Le Jardin, Dar Yacout, Al Fassia', 'Afrika Seyahatleri', '2025-08-14 11:29:46'),
(31, 'Kahire', 'Mısır', '🏛️', 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/db/Cairo_From_Tower_%28cropped%29.jpg/1200px-Cairo_From_Tower_%28cropped%29.jpg', 'Piramitler, Nil Nehri ve antik Mısır tarihi ile dünyanın en eski medeniyetlerinden birinin başkenti.', 'Giza Pyramids, Egyptian Museum, Khan el-Khalili, Cairo Citadel, Al-Azhar Mosque, Coptic Cairo, Nile River, Saqqara', 'Cairo International Film Festival, Cairo Jazz Festival, Cairo Fashion Week, Moulid al-Hussein, Sham el-Nessim', 'Abou El Sid, Felfela, Andrea, Sequoia, Zooba', 'Afrika Seyahatleri', '2025-08-14 11:29:46'),
(32, 'Nairobi', 'Kenya', '🦁', 'https://a.travel-assets.com/findyours-php/viewfinder/images/res70/38000/38950-Nairobi.jpg', 'Kenya\'nın başkenti, safari turları ve doğal yaşam parkları ile Doğu Afrika\'nın önemli merkezi.', 'Nairobi National Park, Giraffe Centre, Karen Blixen Museum, Bomas of Kenya, Nairobi National Museum, Uhuru Park, Westlands, Central Business District', 'Nairobi International Film Festival, Koroga Festival, Nairobi Fashion Week, Jamhuri Day, Mashujaa Day', 'Carnivore, Talisman, About Thyme, Tamarind, Habesha', 'Afrika Seyahatleri', '2025-08-14 11:29:46'),
(33, 'Lagos', 'Nijerya', '🌆', 'https://cms.forbesafrica.com/wp-content/uploads/2021/12/Forbes-Lagos-State-Supplement-Cover-Image-scaled.jpg', 'Nijerya\'nın en büyük şehri, canlı kültürü ve ekonomik dinamizmi ile Batı Afrika\'nın önemli merkezi.', 'Victoria Island, Lekki Conservation Centre, National Museum, Freedom Park, Tarkwa Bay, Nike Art Gallery, Eko Atlantic, Lagos Island', 'Lagos International Jazz Festival, Lagos Fashion Week, Lagos Food Festival, Eyo Festival, Lagos Carnival', 'Sky Restaurant, Yellow Chilli, Terra Kulture, Bogobiri House, Shiro', 'Afrika Seyahatleri', '2025-08-14 11:29:46'),
(34, 'Johannesburg', 'Güney Afrika', '🏙️', 'https://www.andbeyond.com/wp-content/uploads/sites/5/Johannesburg-Skyline.jpg', 'Güney Afrika\'nın en büyük şehri, altın madenleri ve Apartheid müzesi ile tarihi ve ekonomik merkez.', 'Apartheid Museum, Gold Reef City, Constitution Hill, Soweto, Cradle of Humankind, Johannesburg Zoo, Walter Sisulu Botanical Gardens, Sandton City', 'Johannesburg International Film Festival, Joburg Art Fair, Johannesburg Fashion Week, FNB JoburgArtFair, Johannesburg International Comedy Festival', 'The Test Kitchen, La Colombe, Pot Luck Club, The Greenhouse, Belthazar', 'Afrika Seyahatleri', '2025-08-14 11:29:46'),
(35, 'Khartum', 'Sudan', '🏛️', 'https://media.istockphoto.com/id/1494123615/photo/khartoum.jpg?s=612x612&w=0&k=20&c=7apxpNJtjBhR9_uNC5-NVQcT7r4vz9CdbdaZcuFzfpk=', 'Nil nehrinin iki kolu birleştiği yerde kurulu, Sudan\'ın başkenti ve tarihi merkezi.', 'National Museum, Presidential Palace, Omdurman, Khartoum University, Blue Nile Bridge, White Nile Bridge, Tuti Island, Souq Arabi', 'Khartoum International Film Festival, Sudanese Music Festival, Khartoum Fashion Week, Independence Day Celebrations, Eid al-Fitr', 'Al Kababji, Al Shams, Al Zaeem, Al Rawabi, Al Shorouk', 'Afrika Seyahatleri', '2025-08-14 11:29:46'),
(36, 'Dakar', 'Senegal', '🏖️', 'https://www.aviontourism.com/images/1920-900-fix/09108a61-02a2-4266-9a57-945f5403239d', 'Senegal\'in başkenti, Goree Adası ve Dakar Rally\'si ile Batı Afrika\'nın önemli liman şehri.', 'Goree Island, African Renaissance Monument, Dakar Grand Mosque, IFAN Museum, Place de l\'Indépendance, Corniche, Medina, Yoff Beach', 'Dakar International Film Festival, Saint-Louis Jazz Festival, Dakar Fashion Week, Dakar Biennale, Dakar Rally', 'La Galette, Le Lagon, Le Ngor, La Calebasse, Chez Loutcha', 'Afrika Seyahatleri', '2025-08-14 11:29:46'),
(37, 'Addis Ababa', 'Etiyopya', '🏛️', 'https://nomadicsamuel.com/wp-content/uploads/addis-ababa-high-vantage-point-views-of-the-city.jpg', 'Etiyopya\'nın başkenti, Afrika Birliği\'nin merkezi ve Etiyopya Ortodoks Kilisesi ile Doğu Afrika\'nın önemli şehri.', 'National Museum, Holy Trinity Cathedral, Ethnological Museum, Meskel Square, Entoto Hill, Mercato, Unity Park, Addis Mercato', 'Addis International Film Festival, Ethiopian Music Festival, Addis Fashion Week, Timket Festival, Meskel Festival', 'Yod Abyssinia, Habesha, 2000 Habesha, Kategna, Addis Ababa Restaurant', 'Afrika Seyahatleri', '2025-08-14 11:29:46'),
(38, 'Tunus', 'Tunus', '🏺', 'https://magazinebbm.com/assets/img/uploads/2019/10/tunisia.jpg', 'Tunus\'un başkenti, Kartaca antik kenti ve Arap Baharı\'nın başladığı yer ile Kuzey Afrika\'nın tarihi merkezi.', 'Carthage, Bardo Museum, Medina of Tunis, Zitouna Mosque, Habib Bourguiba Avenue, Belvedere Park, Sidi Bou Said, La Goulette', 'Carthage International Festival, Tunis International Film Festival, Tunis Fashion Week, Carthage Film Festival, Tunis Book Fair', 'Dar El Jeld, Le Grand Bleu, Fondouk El Attarine, Dar Bel Hadj, Dar Slah', 'Afrika Seyahatleri', '2025-08-14 11:29:46'),
(39, 'İstanbul', 'Türkiye', '🕌', 'https://images.unsplash.com/photo-1524231757912-21f4fe3a7200?w=800&h=600&fit=crop', 'Doğu ile Batı\'nın buluştuğu şehir. Bizans ve Osmanlı izleri, Boğaz\'ın güzelliği ile benzersiz.', 'Hagia Sophia, Blue Mosque, Topkapi Palace, Grand Bazaar, Bosphorus, Galata Tower, Dolmabahçe Palace, Basilica Cistern', 'İstanbul Film Festivali, İstanbul Müzik Festivali, İstanbul Bienali, Tulip Festivali, İstanbul Jazz Festivali', 'Mikla, Çiya Sofrası, Balıkçı Lokantası, Kebapçı Selim Usta, Pandeli', 'Türkiye Seyahatleri', '2025-08-14 11:29:46'),
(40, 'Antalya', 'Türkiye', '🏖️', 'https://blog.obilet.com/wp-content/uploads/2021/11/anagorsel-min-scaled.jpeg', 'Akdeniz\'in incisi, antik kentleri, güzel plajları ve doğal güzellikleri ile Türkiye\'nin en popüler turizm merkezi.', 'Kaleiçi, Konyaaltı Plajı, Düden Şelaleleri, Perge Antik Kenti, Aspendos, Side, Manavgat Şelalesi, Tahtalı Dağı', 'Antalya Altın Portakal Film Festivali, Antalya Uluslararası Müzik Festivali, Antalya Expo, Antalya Maratonu, Antalya Jazz Festivali', 'Vanilla Restaurant, Seraser Fine Dining, Pasa Bey Kebap, 7 Mehmet, Kral Sofrası', 'Türkiye Seyahatleri', '2025-08-14 11:29:46'),
(41, 'Kapadokya', 'Türkiye', '🎈', 'https://blog.obilet.com/wp-content/uploads/2018/10/kapadokya.jpg', 'Peribacaları, sıcak hava balonları ve yeraltı şehirleri ile dünyanın en büyüleyici doğal oluşumlarından biri.', 'Göreme Açık Hava Müzesi, Uçhisar Kalesi, Derinkuyu Yeraltı Şehri, Ihlara Vadisi, Avanos, Ürgüp, Zelve Vadisi, Paşabağları', 'Kapadokya Balon Festivali, Kapadokya Şarap Festivali, Kapadokya Müzik Festivali, Kapadokya Fotoğraf Festivali, Kapadokya Sanat Festivali', 'Seten Restaurant, Topdeck Cave Restaurant, Dibek Restaurant, Ziggy\'s, Pumpkin Göreme', 'Türkiye Seyahatleri', '2025-08-14 11:29:46'),
(42, 'İzmir', 'Türkiye', '🏖️', 'https://blog.obilet.com/wp-content/uploads/2018/03/izmirgezilecekyerler-min-scaled.jpeg', 'Ege\'nin incisi, Efes antik kenti, güzel koyları ve lezzetli mutfağı ile Türkiye\'nin en yaşanabilir şehirlerinden biri.', 'Efes Antik Kenti, Kemeraltı Çarşısı, Kordon, Kadifekale, Saat Kulesi, Alsancak, Çeşme, Alaçatı', 'İzmir Uluslararası Festivali, İzmir Jazz Festivali, İzmir Maratonu, İzmir Tiyatro Festivali, İzmir Kitap Fuarı', 'Deniz Restaurant, Kordon Balıkçısı, İzmir Köftecisi, Kemeraltı Pidecisi, Alsancak Balıkçısı', 'Türkiye Seyahatleri', '2025-08-14 11:29:46'),
(43, 'Bursa', 'Türkiye', '🏛️', 'https://blog.obilet.com/wp-content/uploads/2018/05/anagorsel-min-min-scaled.jpeg', 'Osmanlı\'nın ilk başkenti, Uludağ\'ı, termal suları ve İskender kebabı ile tarihi ve doğal güzelliklerin buluştuğu şehir.', 'Uludağ, Ulu Cami, Yeşil Cami, Cumalıkızık Köyü, Tophane Saat Kulesi, Oylat Kaplıcaları, Bursa Kalesi, Koza Han', 'Bursa Festivali, Uludağ Kayak Festivali, Bursa Gastronomi Festivali, Bursa Tarih Festivali, Bursa Müzik Festivali', 'İskender Kebapçısı, Bursa İskender, Kebapçı Hüseyin Usta, Bursa Pidecisi, Uludağ Restaurant', 'Türkiye Seyahatleri', '2025-08-14 11:29:46'),
(44, 'Trabzon', 'Türkiye', '🏔️', 'https://www.eaqaratturkia.com/uploads/2024/01/trabzon.jpg', 'Karadeniz\'in incisi, Sümela Manastırı, Uzungöl ve hamsi balığı ile doğal güzelliklerin merkezi.', 'Sümela Manastırı, Uzungöl, Ayasofya Müzesi, Atatürk Köşkü, Boztepe, Gülbahar Hatun Cami, Trabzon Kalesi, Akçaabat', 'Trabzon Festivali, Karadeniz Müzik Festivali, Trabzon Gastronomi Festivali, Trabzon Tarih Festivali, Trabzon Spor Festivali', 'Hamsi Restaurant, Trabzon Balıkçısı, Akçaabat Köftecisi, Trabzon Pidecisi, Uzungöl Restaurant', 'Türkiye Seyahatleri', '2025-08-14 11:29:46'),
(45, 'Konya', 'Türkiye', '🏛️', 'https://karataytermal.com/Upload/Konya3.jpg', 'Mevlana\'nın şehri, Selçuklu mimarisi ve etli ekmek ile tasavvuf ve tarihin buluştuğu yer.', 'Mevlana Müzesi, Alaeddin Cami, İnce Minare Medresesi, Karatay Medresesi, Sırçalı Medrese, Çatalhöyük, Beyşehir Gölü, Tuz Gölü', 'Şeb-i Arus, Konya Tarih Festivali, Konya Gastronomi Festivali, Konya Müzik Festivali, Konya Sanat Festivali', 'Etli Ekmekçi, Konya Mutfağı, Mevlana Restaurant, Konya Pidecisi, Selçuklu Restaurant', 'Türkiye Seyahatleri', '2025-08-14 11:29:46'),
(46, 'Gaziantep', 'Türkiye', '🏛️', 'https://upload.wikimedia.org/wikipedia/commons/9/99/AntepKale2_%28cropped%29.jpg', 'UNESCO Gastronomi Şehri, baklava ve kebap mutfağı ile Güneydoğu Anadolu\'nun lezzet merkezi.', 'Gaziantep Kalesi, Zeugma Mozaik Müzesi, Bakırcılar Çarşısı, Emine Göğüş Mutfak Müzesi, Kurtuluş Cami, Hasan Süzer Etnografya Müzesi, Rumkale, Yesemek', 'Gaziantep Gastronomi Festivali, Gaziantep Tarih Festivali, Gaziantep Müzik Festivali, Gaziantep Sanat Festivali, Gaziantep Spor Festivali', 'İmam Çağdaş, Orkide Restaurant, Kebapçı Halil Usta, Baklava Sarayı, Gaziantep Mutfağı', 'Türkiye Seyahatleri', '2025-08-14 11:29:46'),
(47, 'Safranbolu', 'Türkiye', '🏘️', 'https://www.etstur.com/letsgo/wp-content/uploads/2025/06/01-safranbolu-letsgo.jpg', 'UNESCO Dünya Mirası Listesi\'nde yer alan, geleneksel Osmanlı evleri ile tarihi bir şehir.', 'Safranbolu Evleri, Cinci Hanı, Kaymakamlar Müze Evi, Hıdırlık Tepesi, Bulak Mencilis Mağarası, Tokatlı Kanyonu, Kristal Teras, Safranbolu Kalesi', 'Safranbolu Kültür Festivali, Safranbolu Fotoğraf Festivali, Safranbolu El Sanatları Festivali, Safranbolu Tarih Festivali, Safranbolu Gastronomi Festivali', 'Safranbolu Restaurant, Cinci Han Restaurant, Kaymakamlar Restaurant, Safranbolu Pidecisi, Safranbolu Kebapçısı', 'Türkiye Seyahatleri', '2025-08-14 11:29:46'),
(48, 'Mardin', 'Türkiye', '🏛️', 'https://www.artuklu.edu.tr/dosyalar/iibf_kongre2/02-Mardin.jpg', 'Taş evleri, tarihi sokakları ve çok kültürlü yapısı ile Güneydoğu Anadolu\'nun en büyüleyici şehri.', 'Mardin Kalesi, Deyrulzafaran Manastırı, Kasımiye Medresesi, Zinciriye Medresesi, Mardin Müzesi, Midyat, Hasankeyf, Dara Antik Kenti', 'Mardin Festivali, Mardin Tarih Festivali, Mardin Müzik Festivali, Mardin Sanat Festivali, Mardin Gastronomi Festivali', 'Mardin Mutfağı, Cercis Murat Konağı, Mardin Restaurant, Midyat Restaurant, Hasankeyf Restaurant', 'Türkiye Seyahatleri', '2025-08-14 11:29:46'),
(49, 'Maldivler', 'Maldives', '🏝️', 'https://haydimaldivlere.com/uploads/hotels/images/5-overwater-sunset-pool-villa-oceanview_orig.jpg', 'Turkuaz lagünlerin cenneti. Overwater bungalow\'lar, mercan resifleri ve kristal berraklığındaki sular ile dünyanın en romantik deniz destinasyonu.', 'Male - Başkent adası, Maafushi - Yerel ada yaşamı, Hulhumale - Yapay ada, Vaadhoo - Biyoluminesan plaj, Fuvahmulah - Tek tepe adası', 'Maldives Surf Festival, Maldives Whale Shark Festival, Maldives Underwater Festival, Maldives Food Festival, Maldives Music Festival', 'Ithaa Undersea Restaurant - Denizaltı restoranı, Subsix - Sualtı restoranı, 5.8 Undersea Restaurant - Lüks, The Lighthouse Restaurant - Deniz manzarası, Reethi Restaurant - Geleneksel', 'Deniz Seyahatleri', '2025-08-14 12:45:45'),
(50, 'Santorini', 'Yunanistan', '🌅', 'https://res.cloudinary.com/manawa/image/private/f_auto,c_limit,w_3840,q_auto/uy2qidhrbntj85537glz', 'Mavi kubbelerin adası. Caldera manzarası, beyaz evleri ve gün batımı ile Yunan adalarının en romantik destinasyonu.', 'Oia - Gün batımı noktası, Fira - Ana şehir, Imerovigli - Caldera manzarası, Akrotiri - Antik kent, Red Beach - Kırmızı plaj, Black Beach - Siyah plaj', 'Santorini Wine Festival, Santorini Jazz Festival, Santorini Arts Festival, Santorini Food Festival, Santorini Sunset Festival', 'Ambrosia - Lüks restoran, La Maison - Geleneksel Yunan, Metaxi Mas - Modern, Pyrgos - Şarap restoranı, Dimitris Ammoudi - Deniz ürünleri', 'Deniz Seyahatleri', '2025-08-14 12:45:45'),
(51, 'Bora Bora', 'Fransız Polinezyası', '🏖️', 'https://tahitinuitravel.com/wp-content/uploads/2023/10/1-scaled.jpeg', 'Lagünün incisi. Overwater bungalow\'lar, mercan resifleri ve dağ manzarası ile Fransız Polinezyası\'nın en büyüleyici adası.', 'Matira Beach - Ana plaj, Mount Otemanu - Dağ, Coral Gardens - Mercan bahçeleri, Bora Bora Lagoonarium - Deniz yaşamı, Bloody Mary\'s - Ünlü restoran, Vaitape - Ana köy', 'Bora Bora Pearl Festival, Bora Bora Heiva Festival, Bora Bora Fishing Tournament, Bora Bora Art Festival, Bora Bora Music Festival', 'St. Regis Bora Bora - Lüks, Bloody Mary\'s - Geleneksel, La Villa Mahana - Fransız, Matira Beach Restaurant - Deniz ürünleri, Bora Bora Yacht Club - Marina', 'Deniz Seyahatleri', '2025-08-14 12:45:45'),
(52, 'Amalfi Coast', 'İtalya', '🏔️', 'https://images.squarespace-cdn.com/content/62681a0c1b9b025bc7d3d1cb/1651418142095-9JRJX13GLJ7HAGMUZ7MU/image-asset.jpeg?format=1500w&content-type=image%2Fjpeg', 'İtalya\'nın sahil incisi. Renkli evleri, limon bahçeleri ve muhteşem sahil yolu ile Akdeniz\'in en güzel kıyı şeridi.', 'Amalfi - Ana şehir, Positano - Renkli evler, Ravello - Villa şehri, Sorrento - Limon şehri, Capri - Lüks ada, Ischia - Termal ada, Procida - Geleneksel ada', 'Amalfi Coast Music Festival, Ravello Festival, Lemon Festival, Amalfi Coast Food Festival, Amalfi Coast Art Festival', 'Ristorante Marina Grande - Deniz ürünleri, La Sponda - Lüks, Don Alfonso 1890 - Michelin yıldızlı, Lo Scoglio - Geleneksel, Il San Pietro - Otel restoranı', 'Deniz Seyahatleri', '2025-08-14 12:45:45'),
(53, 'Seychelles', 'Seychelles', '🌴', 'https://lp-cms-production.imgix.net/2024-10/GettyRF482344994.jpg?auto=format,compress&q=72&w=1440&h=810&fit=crop', 'Granit adaların cenneti. Dev kaplumbağalar, tropik ormanlar ve el değmemiş plajları ile Afrika\'nın en güzel ada grubu.', 'Mahe - Ana ada, Praslin - Palmiye adası, La Digue - Bisiklet adası, Aldabra - Kaplumbağa adası, Curieuse - Doğa rezervi, Cousin - Kuş adası, Aride - Vahşi yaşam', 'Seychelles Creole Festival, Seychelles Ocean Festival, Seychelles Arts Festival, Seychelles Food Festival, Seychelles Music Festival', 'Marie-Antoinette - Geleneksel, Le Jardin du Roi - Bahçe restoranı, Kaz Kreol - Yerel mutfak, La Plage - Plaj restoranı, Cap Lazare - Lüks', 'Deniz Seyahatleri', '2025-08-14 12:45:45'),
(54, 'Great Barrier Reef', 'Avustralya', '🐠', 'https://cdn.britannica.com/64/155864-050-34FBD7A2/view-Great-Barrier-Reef-Australia-coast.jpg', 'Dünyanın en büyük mercan resifi. Renkli mercanlar, tropik balıklar ve deniz yaşamı ile Avustralya\'nın deniz cenneti.', 'Cairns - Ana şehir, Whitsunday Islands - Beyaz kum adaları, Heron Island - Kuş adası, Lady Elliot Island - Mercan adası, Lizard Island - Lüks ada, Hamilton Island - Turizm adası', 'Great Barrier Reef Festival, Cairns Indigenous Art Fair, Cairns Festival, Great Barrier Reef Marathon, Cairns Food Festival', 'Ochre Restaurant - Avustralya mutfağı, Waterbar & Grill - Deniz ürünleri, Dundee\'s Restaurant - Geleneksel, Salt House - Modern, Tha Fish - Balık restoranı', 'Deniz Seyahatleri', '2025-08-14 12:45:45'),
(55, 'Dubrovnik', 'Hırvatistan', '🏰', 'https://img.static-kl.com/images/media/FCA64ED7-9AAA-462B-B74A36DCCC8F1349', 'Orta Çağ\'ın incisi. Tarihi surları, kırmızı çatıları ve Adriyatik manzarası ile Hırvatistan\'ın en güzel sahil şehri.', 'Old Town - Eski şehir, City Walls - Şehir surları, Stradun - Ana cadde, Lokrum - Ada, Cable Car - Teleferik, Banje Beach - Şehir plajı, Sponza Palace - Saray', 'Dubrovnik Summer Festival, Dubrovnik Film Festival, Dubrovnik Food Festival, Dubrovnik Music Festival, Dubrovnik Carnival', '360° - Lüks restoran, Lady Pi-Pi - Deniz ürünleri, Nautika - Geleneksel, Azur - Modern, Pantarul - Fine dining', 'Deniz Seyahatleri', '2025-08-14 12:45:45'),
(56, 'Maui', 'Hawaii', '🌺', 'https://www.lovebigisland.com/wp-content/uploads/hana-highway.jpg', 'Hawaii\'nin büyüleyici adası. Haleakala volkanı, Road to Hana ve muhteşem plajları ile macera ve dinlenmenin buluştuğu yer.', 'Haleakala - Volkan, Road to Hana - Sahil yolu, Lahaina - Tarihi şehir, Kaanapali Beach - Ana plaj, Iao Valley - Vadi, Molokini - Mercan adası, Hana - Uzak köy', 'Maui Film Festival, Maui Onion Festival, Maui Ukulele Festival, Maui Whale Festival, Maui Arts Festival', 'Mama\'s Fish House - Deniz ürünleri, Merriman\'s Kapalua - Modern, Lahaina Grill - Geleneksel, Gannon\'s - Lüks, Hali\'imaile General Store - Yerel', 'Deniz Seyahatleri', '2025-08-14 12:45:45'),
(57, 'Cinque Terre', 'İtalya', '🏘️', 'https://cdn.shopify.com/s/files/1/0521/3631/3029/files/Rengarenk-Cinque-Terre5_2048x2048.jpg?v=1612344566', 'Renkli evlerin sahil şeridi. Beş tarihi köy, yürüyüş yolları ve İtalyan Riviera\'sının en güzel manzarası.', 'Monterosso al Mare - En büyük köy, Vernazza - Liman köyü, Corniglia - Tepe köyü, Manarola - Renkli köy, Riomaggiore - Güney köyü, Sentiero Azzurro - Mavi yol', 'Cinque Terre Wine Festival, Cinque Terre Food Festival, Cinque Terre Music Festival, Cinque Terre Art Festival, Cinque Terre Hiking Festival', 'Ristorante Miky - Deniz ürünleri, Trattoria dal Billy - Geleneksel, Ristorante Belforte - Lüks, Il Grottino - Yerel, Ristorante La Torre - Manzara', 'Deniz Seyahatleri', '2025-08-14 12:45:45'),
(58, 'Phi Phi Islands', 'Tayland', '🏊', 'https://upload.wikimedia.org/wikipedia/commons/e/e7/KohPhiPhi.JPG', 'Tayland\'ın tropik cenneti. Maya Bay, kristal sular ve kireçtaşı kayaları ile dünyanın en güzel ada grubu.', 'Phi Phi Don - Ana ada, Maya Bay - Film plajı, Monkey Beach - Maymun plajı, Viking Cave - Mağara, Bamboo Island - Bambu adası, Mosquito Island - Sivrisinek adası', 'Phi Phi Island Festival, Phi Phi Regatta, Phi Phi Beach Party, Phi Phi Food Festival, Phi Phi Music Festival', 'Pee Pee Restaurant - Deniz ürünleri, Le Grand Bleu - Fransız, Unni\'s Restaurant - İskandinav, Papaya Restaurant - Tay mutfağı, Cosmic Restaurant - Uluslararası', 'Deniz Seyahatleri', '2025-08-14 12:45:45'),
(59, 'Yosemite National Park', 'Amerika Birleşik Devletleri', '🏔️', 'https://www.hertz.com/content/dam/hertz/global/blog-articles/planning-a-trip/yosemite/Yosemite-National-Park-Header.jpg', 'Granit kayalıkları, şelaleler ve dev sekoya ağaçları ile dünyanın en büyüleyici milli parklarından biri.', 'El Capitan - Granit duvar, Half Dome - Yarı kubbe, Yosemite Falls - Şelale, Mariposa Grove - Sekoya ormanı, Glacier Point - Buzul noktası, Tuolumne Meadows - Çayırlar', 'Yosemite Climbing Festival, Yosemite Music Festival, Yosemite Photography Workshop, Yosemite Hiking Festival, Yosemite Wildlife Festival', 'The Ahwahnee Dining Room - Lüks, Yosemite Valley Lodge - Geleneksel, Curry Village Pizza Deck - Pizza, Degnan\'s Kitchen - Kahve, Mountain Room Restaurant - Modern', 'Kamp ve Doğa', '2025-08-14 13:05:20'),
(60, 'Banff National Park', 'Kanada', '🏔️', 'https://upload.wikimedia.org/wikipedia/commons/c/c5/Moraine_Lake_17092005.jpg', 'Kanada\'nın ilk milli parkı. Turkuaz göller, buzullar ve Rocky Dağları\'nın muhteşem manzarası.', 'Lake Louise - Turkuaz göl, Moraine Lake - Moraine gölü, Banff Town - Ana şehir, Johnston Canyon - Kanyon, Sulphur Mountain - Kükürt dağı, Icefields Parkway - Buzul yolu', 'Banff Mountain Film Festival, Banff Centre Arts Festival, Banff Hiking Festival, Banff Wildlife Festival, Banff Photography Festival', 'The Bison Restaurant - Kanada mutfağı, Park Distillery - Distillery, The Grizzly House - Fondü, Saltlik - Steakhouse, Tooloulou\'s - Cajun', 'Kamp ve Doğa', '2025-08-14 13:05:20'),
(61, 'Patagonia', 'Şili/Arjantin', '🏔️', 'https://aex-web.imgix.net/getContentAsset/7459a268-28bd-45f9-bce9-73da10fc8ffb/8e265d97-ee24-47b6-a823-0d8b4ca7c908/Torres-del-Paine-over-the-Pehoe-Lake,-Patagonia;-Shutterstock.jpg?language=en&auto=format&w={width}&fit=cover', 'Güney Amerika\'nın vahşi doğası. Torres del Paine, Fitz Roy ve sonsuz stepler.', 'Torres del Paine - Dağ kuleleri, Fitz Roy - Granit dağ, Perito Moreno Glacier - Buzul, Ushuaia - Dünyanın sonu, El Calafate - Buzul şehri, Puerto Natales - Liman şehri', 'Patagonia International Marathon, Patagonia Film Festival, Patagonia Photography Festival, Patagonia Hiking Festival, Patagonia Wildlife Festival', 'La Marmita - Yerel mutfak, El Boliche de Alberto - Geleneksel, La Tablita - Barbekü, Kau Kaleswen - Mapuche mutfağı, La Esquina - Modern', 'Kamp ve Doğa', '2025-08-14 13:05:20'),
(62, 'Swiss Alps', 'İsviçre', '🏔️', 'https://i.natgeofe.com/n/c69de239-9c4b-454e-a411-f51b322e5c16/Haslital_4x3.jpg', 'Alpler\'in kalbi. Jungfrau, Matterhorn ve muhteşem dağ manzaraları.', 'Jungfraujoch - Avrupa\'nın çatısı, Matterhorn - İkonik dağ, Zermatt - Araçsız şehir, Interlaken - İki göl arası, Grindelwald - Dağ köyü, Lauterbrunnen - 72 şelale', 'Zermatt Unplugged Festival, Interlaken Music Festival, Swiss Hiking Festival, Alpine Photography Festival, Swiss Wildlife Festival', 'Chez Vrony - Lüks, Restaurant Schäferstube - Geleneksel, Findlerhof - Modern, Restaurant Capri - İtalyan, Restaurant Taverne - Yerel', 'Kamp ve Doğa', '2025-08-14 13:05:20'),
(63, 'New Zealand', 'Yeni Zelanda', '🏔️', 'https://media.cnn.com/api/v1/images/stellar/prod/20220526-164502-rotomairewhenua-blue-lakcredit-janet-newell.jpg?c=16x9&q=h_720,w_1280,c_fill', 'Orta Dünya\'nın gerçek yurdu. Milford Sound, Tongariro ve vahşi doğa.', 'Milford Sound - Fjord, Tongariro Crossing - Volkanik yürüyüş, Queenstown - Macera şehri, Rotorua - Termal bölge, Abel Tasman - Sahil yolu, Franz Josef Glacier - Buzul', 'Queenstown Winter Festival, Rotorua Maori Festival, New Zealand Hiking Festival, New Zealand Photography Festival, New Zealand Wildlife Festival', 'Fergburger - Burger, The Bunker - Lüks, Botswana Butchery - Steakhouse, Rata - Modern, Amisfield - Şarap restoranı', 'Kamp ve Doğa', '2025-08-14 13:05:20'),
(64, 'Iceland', 'İzlanda', '🏔️', 'https://images.travelandleisureasia.com/wp-content/uploads/sites/3/2024/02/12190030/Kirkjufell-1600x900.jpg', 'Ateş ve buzun ülkesi. Volkanlar, buzullar ve kuzey ışıkları.', 'Golden Circle - Altın halka, Blue Lagoon - Mavi lagün, Vatnajökull - Buzul, Jökulsárlón - Buzul gölü, Reykjavik - Başkent, Akureyri - Kuzey şehri', 'Iceland Airwaves Festival, Secret Solstice Festival, Iceland Hiking Festival, Iceland Photography Festival, Northern Lights Festival', 'Dill Restaurant - Lüks, Fiskmarkaðurinn - Deniz ürünleri, Grillmarkaðurinn - Barbekü, Matur og Drykkur - Geleneksel, Slippurinn - Modern', 'Kamp ve Doğa', '2025-08-14 13:05:20'),
(65, 'Nepal Himalayas', 'Nepal', '🏔️', 'https://cdn.britannica.com/05/58605-050-86F58113/Annapurna-massif-village-Nepal.jpg', 'Dünyanın çatısı. Everest, Annapurna ve mistik dağ köyleri.', 'Everest Base Camp - Ana kamp, Annapurna Circuit - Devre, Kathmandu - Başkent, Pokhara - Göl şehri, Chitwan National Park - Milli park, Lumbini - Buddha\'nın doğum yeri', 'Nepal Hiking Festival, Nepal Photography Festival, Nepal Wildlife Festival, Nepal Cultural Festival, Nepal Adventure Festival', 'Dwarika\'s - Lüks, Bhojan Griha - Geleneksel, OR2K - Orta Doğu, Fire and Ice - Pizza, Himalayan Java - Kahve', 'Kamp ve Doğa', '2025-08-14 13:05:20'),
(66, 'Alaska', 'Amerika Birleşik Devletleri', '🏔️', 'https://static.dw.com/image/73620949_605.jpg', 'Son sınır. Denali, buzullar ve vahşi yaşam.', 'Denali National Park - Milli park, Kenai Fjords - Fjordlar, Anchorage - Ana şehir, Fairbanks - Altın şehri, Juneau - Başkent, Ketchikan - Balık şehri', 'Alaska State Fair, Iditarod Sled Dog Race, Alaska Hiking Festival, Alaska Photography Festival, Alaska Wildlife Festival', 'Simon & Seafort\'s - Deniz ürünleri, Moose\'s Tooth - Pizza, Glacier Brewhouse - Bira, Orso - Modern, 49th State Brewing - Bira', 'Kamp ve Doğa', '2025-08-14 13:05:20'),
(67, 'Tibet', 'Çin', '🏔️', 'https://cdn.britannica.com/79/178679-050-9170BD2A/Potala-Palace-Lhasa-China-Tibet-Autonomous-Region.jpg', 'Dünyanın çatısı. Lhasa, Potala Sarayı ve mistik manastırlar.', 'Lhasa - Başkent, Potala Palace - Saray, Jokhang Temple - Tapınak, Mount Everest - Dünyanın zirvesi, Nam Co Lake - Göl, Tashilhunpo Monastery - Manastır', 'Tibet Cultural Festival, Tibet Photography Festival, Tibet Hiking Festival, Tibet Wildlife Festival, Tibet Spiritual Festival', 'Tibet Kitchen - Tibet mutfağı, Lhasa Kitchen - Geleneksel, Himalaya Restaurant - Hint, Sweet Tea House - Çay evi, Yak Restaurant - Yerel', 'Kamp ve Doğa', '2025-08-14 13:05:20'),
(68, 'Norway Fjords', 'Norveç', '🏔️', 'https://media.cntraveler.com/photos/57966ab10513807b76499bc7/1:1/w_1536,h_1536,c_limit/GettyImages-163687915-norway-fjord2.jpg', 'Fjordların ülkesi. Geiranger, Nærøyfjord ve kuzey ışıkları.', 'Geirangerfjord - Fjord, Nærøyfjord - Dar fjord, Bergen - Balık şehri, Oslo - Başkent, Tromsø - Kuzey şehri, Ålesund - Art Nouveau şehri', 'Bergen International Festival, Northern Lights Festival, Norway Hiking Festival, Norway Photography Festival, Norway Wildlife Festival', 'Maaemo - Lüks, Fisketorget - Deniz ürünleri, Lysverket - Modern, Bryggeloftet - Geleneksel, Bare Vestland - Yerel', 'Kamp ve Doğa', '2025-08-14 13:05:20');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tatlilar_hamur`
--

DROP TABLE IF EXISTS `tatlilar_hamur`;
CREATE TABLE IF NOT EXISTS `tatlilar_hamur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ad` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `malzemeler` text NOT NULL,
  `hazirlanis` text NOT NULL,
  `sure` varchar(100) NOT NULL,
  `zorluk` enum('Kolay','Orta','Zor') DEFAULT 'Orta',
  `porsiyon` varchar(50) NOT NULL,
  `kalori` varchar(50) DEFAULT NULL,
  `resim` varchar(500) NOT NULL,
  `aciklama` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `tatlilar_hamur`
--

INSERT INTO `tatlilar_hamur` (`id`, `ad`, `kategori`, `malzemeler`, `hazirlanis`, `sure`, `zorluk`, `porsiyon`, `kalori`, `resim`, `aciklama`, `created_at`, `updated_at`) VALUES
(1, 'Baklava', 'Geleneksel Tatlılar', 'Yufka, ceviz, tereyağı, şeker, su, limon suyu, gül suyu', 'Yufkalar arasına ceviz serpilir, tereyağı ile yağlanır, fırında pişirilir, şerbeti dökülür.', '120 dakika', 'Zor', '20 adet', '350 kcal', 'https://upload.wikimedia.org/wikipedia/commons/c/c7/Baklava%281%29.png', 'Türk mutfağının en meşhur tatlısı, ince yufka katmanları ve ceviz ile.', '2025-08-12 14:18:41', '2025-08-12 14:24:43'),
(2, 'Künefe', 'Geleneksel Tatlılar', 'Kadayıf, peynir, tereyağı, şeker, su, antep fıstığı', 'Kadayıf arasına peynir konur, tereyağı ile yağlanır, ızgarada pişirilir.', '45 dakika', 'Orta', '6 kişilik', '420 kcal', 'https://i.nefisyemektarifleri.com/2023/02/15/istanbulda-efsane-kunefenin-11-adresi.jpg', 'Antep\'in meşhur künefesi, taze peynir ve kadayıf ile.', '2025-08-12 14:18:41', '2025-08-12 14:24:20'),
(3, 'Tiramisu', 'Modern Tatlılar', 'Mascarpone peyniri, yumurta, şeker, kahve, kakao, ladyfinger bisküvi', 'Krema hazırlanır, bisküviler kahveye batırılır, katmanlar halinde dizilir.', '60 dakika', 'Orta', '8 kişilik', '280 kcal', 'https://i.nefisyemektarifleri.com/2023/04/28/kedidilli-tiramisu.jpg', 'İtalyan mutfağının popüler tatlısı, kahve ve mascarpone ile.', '2025-08-12 14:18:41', '2025-08-12 14:24:16'),
(4, 'Cheesecake', 'Modern Tatlılar', 'Krem peynir, yumurta, şeker, vanilya, bisküvi, tereyağı', 'Bisküvi tabanı hazırlanır, krem peynir karışımı dökülür, fırında pişirilir.', '90 dakika', 'Orta', '12 dilim', '320 kcal', 'https://i.nefisyemektarifleri.com/2018/03/27/firinsiz-cheesecake-tarifi-11-600x400.jpg', 'Amerikan mutfağının klasik tatlısı, krem peynir ve bisküvi tabanı ile.', '2025-08-12 14:18:41', '2025-08-12 14:23:33'),
(5, 'Pogaca', 'Hamur İşleri', 'Un, maya, süt, yumurta, tereyağı, peynir, tuz', 'Hamur yoğrulur, mayalandırılır, iç harcı konur, fırında pişirilir.', '75 dakika', 'Kolay', '12 adet', '180 kcal', 'https://i.ytimg.com/vi/2z1k91GyaV8/maxresdefault.jpg', 'Geleneksel Türk hamur işi, peynirli iç harcı ile.', '2025-08-12 14:18:41', '2025-08-12 14:23:00'),
(6, 'Croissant', 'Hamur İşleri', 'Un, maya, süt, tereyağı, yumurta, tuz, şeker', 'Katmerli hamur hazırlanır, üçgen şeklinde kesilir, rulo yapılır.', '180 dakika', 'Zor', '8 adet', '250 kcal', 'https://www.thekitchenwhisperer.net/wp-content/uploads/2014/02/Croissant-Love4.jpg', 'Fransız mutfağının simgesi, katmerli hamur ve tereyağı ile.', '2025-08-12 14:18:41', '2025-08-12 14:22:38'),
(7, 'Brownie', 'Modern Tatlılar', 'Çikolata, tereyağı, yumurta, şeker, un, kakao, vanilya', 'Çikolata eritilir, malzemeler karıştırılır, fırında pişirilir.', '40 dakika', 'Kolay', '16 parça', '200 kcal', 'https://www.mikro-scope.com/wp-content/uploads/2022/03/Zeynep-Asutay-scaled.jpg', 'Çikolata severlerin favorisi, yoğun çikolata tadı ile.', '2025-08-12 14:18:41', '2025-08-12 14:21:21'),
(8, 'Sufle', 'Modern Tatlılar', 'Çikolata, yumurta, şeker, un, tereyağı, vanilya', 'Çikolata eritilir, yumurta beyazları çırpılır, fırında pişirilir.', '30 dakika', 'Zor', '4 adet', '180 kcal', 'https://cdn.ye-mek.net/App_UI/Img/out/650/2020/05/sufle-resimli-yemek-tarifi(15).jpg', 'Fransız mutfağının zarif tatlısı, sıcak servis edilir.', '2025-08-12 14:18:41', '2025-08-12 14:20:37');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tiyatro_eserleri`
--

DROP TABLE IF EXISTS `tiyatro_eserleri`;
CREATE TABLE IF NOT EXISTS `tiyatro_eserleri` (
  `id` int NOT NULL AUTO_INCREMENT,
  `eser_adi` varchar(255) NOT NULL,
  `yazar` varchar(255) NOT NULL,
  `yil` int NOT NULL,
  `tur` enum('Tragedya','Komedi','Dram','Müzikal') NOT NULL,
  `puan` decimal(3,1) DEFAULT '0.0',
  `aciklama` text NOT NULL,
  `sure` varchar(50) DEFAULT NULL,
  `karakter_sayisi` int DEFAULT NULL,
  `dil` varchar(100) DEFAULT 'Türkçe',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `kapak_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `tiyatro_eserleri`
--

INSERT INTO `tiyatro_eserleri` (`id`, `eser_adi`, `yazar`, `yil`, `tur`, `puan`, `aciklama`, `sure`, `karakter_sayisi`, `dil`, `created_at`, `kapak_url`) VALUES
(1, 'Hamlet', 'William Shakespeare', 1603, 'Tragedya', 9.5, 'Danimarka prensi Hamlet\'in babasının ölümünün ardından yaşadığı trajik hikayesi. \'Olmak ya da olmamak, işte bütün mesele bu!\'', '3 saat', 15, 'Türkçe', '2025-07-30 14:38:32', 'https://cdn.kobo.com/book-images/5fc4252b-1c4f-40ef-9975-22982c94f12c/353/569/90/False/hamlet-prince-of-denmark-23.jpg'),
(2, 'Romeo ve Juliet', 'William Shakespeare', 1597, 'Tragedya', 9.3, 'İki düşman ailenin çocukları arasında yaşanan büyük aşk hikayesi. Dünya edebiyatının en ünlü aşk destanı.', '2.5 saat', 12, 'Türkçe', '2025-07-30 14:38:32', 'https://resizing.flixster.com/-XZAfHZM39UwaGJIFWKAE8fS0ak=/v3/t/assets/p18647_p_v12_bc.jpg'),
(3, 'Macbeth', 'William Shakespeare', 1606, 'Tragedya', 9.1, 'İktidar hırsıyla kör olan Macbeth\'in trajik düşüşü. Ambisyon ve ihanetin bedeli.', '2.5 saat', 18, 'Türkçe', '2025-07-30 14:38:32', 'https://cdn.kobo.com/book-images/20c7461d-88d2-4cee-b0ef-f64c1ffacb73/353/569/90/False/macbeth-14.jpg'),
(4, 'Kral Lear', 'William Shakespeare', 1606, 'Tragedya', 9.0, 'Yaşlı kralın kızları arasında krallığını bölüştürmesi ve sonrasında yaşanan trajik olaylar.', '3.5 saat', 20, 'Türkçe', '2025-07-30 14:38:32', 'https://tr.web.img2.acsta.net/pictures/18/09/07/09/12/4807828.jpg'),
(5, 'Othello', 'William Shakespeare', 1604, 'Tragedya', 8.9, 'Kıskançlık ve ihanetin yok ettiği büyük bir aşk hikayesi. Othello\'nun trajik sonu.', '2.5 saat', 14, 'Türkçe', '2025-07-30 14:38:32', 'https://cdn.kobo.com/book-images/b8a4b6a7-d0c9-4fec-9a99-3e5d24bc16e0/1200/1200/False/othello-the-moor-of-venice.jpg'),
(6, 'Antigone', 'Sophokles', 441, 'Tragedya', 8.8, 'Antik Yunan\'da aile bağları ve devlet yasaları arasındaki çatışmayı anlatan trajik eser.', '1.5 saat', 8, 'Türkçe', '2025-07-30 14:38:32', 'https://i.dr.com.tr/cache/500x400-0/originals/0001922273001-1.jpg'),
(7, 'Kral Oidipus', 'Sophokles', 429, 'Tragedya', 8.7, 'Kaderin kaçınılmazlığını ve insanın kendi yazgısıyla mücadelesini anlatan klasik tragedya.', '2 saat', 10, 'Türkçe', '2025-07-30 14:38:32', 'https://img.kitapyurdu.com/v1/getImage/fn:11401981/wh:true/wi:800'),
(8, 'Medea', 'Euripides', 431, 'Tragedya', 8.6, 'Aşk, ihanet ve intikamın en korkunç hikayesi. Medea\'nın trajik intikamı.', '2 saat', 9, 'Türkçe', '2025-07-30 14:38:32', 'https://cdn.kobo.com/book-images/c5cc77c1-bee1-4fd2-b076-83dd4f06a7fb/1200/1200/False/medea-6.jpg'),
(9, 'Venedik Taciri', 'William Shakespeare', 1600, 'Komedi', 8.5, 'Venedik\'te geçen, aşk, dostluk ve adalet temalarını işleyen ünlü komedi.', '2.5 saat', 16, 'Türkçe', '2025-07-30 14:38:32', 'https://upload.wikimedia.org/wikipedia/tr/c/cd/Venedik_Taciri_%28film%2C_2004%29_TR_afi%C5%9F.jpg'),
(10, 'Bir Yaz Gecesi Rüyası', 'William Shakespeare', 1596, 'Komedi', 8.4, 'Büyülü bir ormanda geçen, aşk ve büyünün iç içe geçtiği eğlenceli komedi.', '2.5 saat', 15, 'Türkçe', '2025-07-30 14:38:32', 'https://tiyatrolar.com.tr/files/activity/b/bir-yaz-gecesi-ruyasi-2/image/bir-yaz-gecesi-ruyasi-2.jpg'),
(11, 'Cyrano de Bergerac', 'Edmond Rostand', 1897, 'Tragedya', 8.3, 'Büyük burnu yüzünden aşkını gizleyen Cyrano\'nun romantik ve trajik hikayesi.', '2.5 saat', 12, 'Türkçe', '2025-07-30 14:38:32', 'https://m.media-amazon.com/images/S/pv-target-images/7d18a0ddea077bd0b3df70968f5e86fedb15ccf27f634fdf9c3b831f96025e0c.jpg'),
(12, 'Faust', 'Johann Wolfgang von Goethe', 1808, 'Tragedya', 8.2, 'Şeytanla anlaşma yapan bilgin Faust\'un arayışı ve trajik sonu.', '3 saat', 25, 'Türkçe', '2025-07-30 14:38:32', 'https://cdn.kobo.com/book-images/ba8ab3db-ea96-41ce-9541-0b0f68c0b80d/1200/1200/False/faust-100.jpg'),
(13, 'Don Juan', 'Molière', 1665, 'Komedi', 8.1, 'Kadın avcısı Don Juan\'ın maceraları ve sonunda karşılaştığı kader.', '2 saat', 14, 'Türkçe', '2025-07-30 14:38:32', 'https://cdn.kobo.com/book-images/8c2991fe-cc5c-4e78-9619-b27319a5244c/1200/1200/False/don-juan-56.jpg'),
(14, 'Tartuffe', 'Molière', 1664, 'Komedi', 8.0, 'Dindar görünümlü sahtekar Tartuffe\'ün bir aileyi nasıl kandırdığını anlatan komedi.', '2 saat', 12, 'Türkçe', '2025-07-30 14:38:32', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcReW5j0iAsBx0WIhj6GZRzkTVMzjt4Hw5KSrg&s'),
(15, 'Hedda Gabler', 'Henrik Ibsen', 1890, 'Tragedya', 7.9, 'Sıkıcı evlilik hayatından bunalan Hedda\'nın trajik sonu.', '2.5 saat', 8, 'Türkçe', '2025-07-30 14:38:32', 'https://covers.storytel.com/jpg-640/9788726552959.3fa9dabf-b92d-43f0-92ab-bea73f19e881?optimize=high&quality=70&width=600'),
(16, 'Nora', 'Henrik Ibsen', 1879, 'Dram', 7.8, 'Kadın hakları ve evlilik kurumunu sorgulayan devrimci eser.', '2.5 saat', 9, 'Türkçe', '2025-07-30 14:38:32', 'https://urladam.com.tr/wp-content/uploads/2025/07/Nora2_70x100_afis-pdf.jpg'),
(17, 'Sezuan\'ın İyi İnsanı', 'Bertolt Brecht', 1943, 'Dram', 7.7, 'Kapitalist sistemde iyi olmanın zorluğunu anlatan epik tiyatro eseri.', '3 saat', 20, 'Türkçe', '2025-07-30 14:38:32', 'https://tiyatrolar.com.tr/files/activity/s/sezuanin-iyi-insani/image/sezuanin-iyi-insani.jpg'),
(18, 'Üç Kız Kardeş', 'Anton Çehov', 1901, 'Dram', 7.6, 'Moskova\'ya dönme hayali kuran üç kız kardeşin umutsuz bekleyişi.', '2.5 saat', 10, 'Türkçe', '2025-07-30 14:38:32', 'https://hayalperdesi.org/wp-content/uploads/2024/04/yeni-poster-3KK-yeni--732x1024.jpg'),
(19, 'Vanya Dayı', 'Anton Çehov', 1899, 'Dram', 7.5, 'Hayatın anlamsızlığı ve umutsuzluğu üzerine derin bir dram.', '2.5 saat', 8, 'Türkçe', '2025-07-30 14:38:32', 'https://www.tiyatropera.com/images/upload/vanyaafissite.jpg'),
(20, 'Martı', 'Anton Çehov', 1896, 'Dram', 7.4, 'Sanat, aşk ve hayatın anlamı üzerine düşündüren modern dram.', '2 saat', 12, 'Türkçe', '2025-07-30 14:38:32', 'https://b6s54eznn8xq.merlincdn.net/Uploads/Films/marti-202311914443546288f22b9684d4c850acc5227ab3a85.jpeg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yemekler`
--

DROP TABLE IF EXISTS `yemekler`;
CREATE TABLE IF NOT EXISTS `yemekler` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ad` varchar(255) NOT NULL,
  `bolge` varchar(255) NOT NULL,
  `malzemeler` text NOT NULL,
  `hazirlanis` text NOT NULL,
  `sure` varchar(100) NOT NULL,
  `zorluk` enum('Kolay','Orta','Zor') DEFAULT 'Orta',
  `porsiyon` varchar(50) NOT NULL,
  `kalori` varchar(50) DEFAULT NULL,
  `resim` varchar(500) NOT NULL,
  `aciklama` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tur` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `yemekler`
--

INSERT INTO `yemekler` (`id`, `ad`, `bolge`, `malzemeler`, `hazirlanis`, `sure`, `zorluk`, `porsiyon`, `kalori`, `resim`, `aciklama`, `created_at`, `updated_at`, `tur`) VALUES
(1, 'İskender Kebap', 'Bursa', 'Dana eti, tereyağı, domates sosu, yoğurt, ekmek, domates, biber', 'Dana eti ızgarada pişirilir, tereyağı ile soslanır, yoğurt ve domates sosu ile servis edilir.', '45 dakika', 'Orta', '4 kişilik', '650 kcal', 'https://upload.wikimedia.org/wikipedia/commons/3/38/Iskender_kebap.jpg', 'Bursa\'nın meşhur iskender kebabı, özel sosu ve tereyağı ile servis edilir.', '2025-08-12 13:34:56', '2025-08-12 13:57:28', ''),
(2, 'Mantı', 'Kayseri', 'Un, yumurta, kıyma, soğan, yoğurt, domates sosu, nane, pul biber', 'Hamur yoğrulur, iç harcı hazırlanır, küçük parçalar halinde şekillendirilir ve haşlanır.', '90 dakika', 'Zor', '6 kişilik', '450 kcal', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSdLhdulTLw9XhtCpkEJQaAcKV4M7LmRUJmNw&s', 'Kayseri mantısı, el açması hamur ve özel sosu ile Türk mutfağının vazgeçilmezidir.', '2025-08-12 13:34:56', '2025-08-12 13:56:48', ''),
(3, 'Lahmacun', 'Gaziantep', 'Un, maya, kıyma, soğan, domates, biber, maydanoz, baharatlar', 'Hamur yoğrulur, ince açılır, üzerine harc yayılır ve odun ateşinde pişirilir.', '60 dakika', 'Orta', '8 adet', '280 kcal', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSdxv_M8Smx9_BU6d7dsiYScmTJ2oRCjhzvLQ&s', 'Gaziantep\'in meşhur lahmacunu, ince hamuru ve özel harcı ile eşsiz lezzet.', '2025-08-12 13:34:56', '2025-08-12 13:55:51', ''),
(4, 'Pide', 'Kastamonu', 'Un, maya, kıyma, soğan, yumurta, tereyağı, tuz', 'Hamur yoğrulur, uzun şekilde açılır, harc yayılır ve odun ateşinde pişirilir.', '45 dakika', 'Kolay', '4 adet', '320 kcal', 'https://images.deliveryhero.io/image/fd-tr/LH/y984-listing.jpg', 'Kastamonu pidesi, geleneksel yapım tekniği ile hazırlanan eşsiz lezzet.', '2025-08-12 13:34:56', '2025-08-12 13:54:23', ''),
(5, 'Hünkar Beğendi', 'İstanbul', 'Kuzu eti, patlıcan, süt, tereyağı, un, soğan, domates, baharatlar', 'Kuzu eti pişirilir, patlıcan közlenir, sütlü sos hazırlanır ve birleştirilir.', '75 dakika', 'Orta', '4 kişilik', '580 kcal', 'https://i.nefisyemektarifleri.com/2020/11/03/asperox-hunkar-begendi-8.jpg', 'Osmanlı mutfağından gelen hünkar beğendi, patlıcan püresi ve kuzu eti ile.', '2025-08-12 13:34:56', '2025-08-12 13:53:35', ''),
(6, 'Çiğ Köfte', 'Şanlıurfa', 'Bulgur, isot, soğan, sarımsak, maydanoz, domates, limon, baharatlar', 'Bulgur ıslatılır, isot ve baharatlarla yoğrulur, marul ve domates ile servis edilir.', '30 dakika', 'Kolay', '6 kişilik', '220 kcal', 'https://panayirgourmet.com/cdn/shop/files/antep-usulu-cig-kofte-703773.jpg?v=1718700529', 'Şanlıurfa\'nın meşhur çiğ köftesi, isot ve özel baharatlarla hazırlanır.', '2025-08-12 13:34:56', '2025-08-12 13:53:03', ''),
(7, 'Karnıyarık', 'Antalya', 'Patlıcan, kıyma, soğan, domates, biber, sarımsak, zeytinyağı', 'Patlıcan közlenir, içi çıkarılır, harc hazırlanır ve fırında pişirilir.', '50 dakika', 'Orta', '4 kişilik', '380 kcal', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTiBKwSM1wXrvoWUqqUaTllCQh7w7juTtxTwg&s', 'Antalya\'nın geleneksel karnıyarık yemeği, közlenmiş patlıcan ile.', '2025-08-12 13:34:56', '2025-08-12 13:47:21', ''),
(8, 'Döner', 'Bursa', 'Kuzu eti, baharatlar, ekmek, soğan, domates, turşu, soslar', 'Et marine edilir, dikey şişe takılır, döner makinesinde pişirilir.', '120 dakika', 'Zor', '8 kişilik', '420 kcal', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTjNVK39PPQqfC0yryQEYUahnPubkHZcR0UdQ&s', 'Bursa\'nın meşhur döneri, özel baharatlarla marine edilmiş et ile.', '2025-08-12 13:34:56', '2025-08-12 13:46:40', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorumlar`
--

DROP TABLE IF EXISTS `yorumlar`;
CREATE TABLE IF NOT EXISTS `yorumlar` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kullanici_id` int NOT NULL,
  `kullanici_adi` varchar(100) NOT NULL,
  `tur` varchar(20) NOT NULL,
  `icerik_id` int NOT NULL,
  `icerik_adi` varchar(200) NOT NULL,
  `yorum` text NOT NULL,
  `puan` int DEFAULT '0',
  `spoiler` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `kullanici_id` (`kullanici_id`)
) ENGINE=MyISAM AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `yorumlar`
--

INSERT INTO `yorumlar` (`id`, `kullanici_id`, `kullanici_adi`, `tur`, `icerik_id`, `icerik_adi`, `yorum`, `puan`, `spoiler`, `created_at`) VALUES
(10, 104, 'yeşim', 'tiyatro', 2, 'Romeo ve Juliet', 'yyyyyyyyyyy', 8, 0, '2025-08-04 06:08:11'),
(11, 104, 'yeşim', 'tiyatro', 2, 'Romeo ve Juliet', 'Bu bir test yorumudur. Tiyatro eseri gerçekten harika!', 8, 0, '2025-08-04 06:08:17'),
(12, 104, 'yeşim', 'tiyatro', 2, 'Romeo ve Juliet', 'Bu bir test yorumudur. Tiyatro eseri gerçekten harika!', 8, 0, '2025-08-04 06:13:05'),
(13, 104, 'yeşim', 'tiyatro', 2, 'Romeo ve Juliet', 'lllllllllllllllll', 6, 0, '2025-08-04 06:13:12'),
(6, 103, 'eray', 'anime', 3, 'Fullmetal Alchemist: Brotherhood', 'iyiye benziyor', 4, 0, '2025-07-31 07:00:26'),
(7, 105, 'irem', 'tiyatro', 1, 'Hamlet', 'my name is good', 6, 0, '2025-07-31 08:58:31'),
(60, 104, 'yeşim', 'film', 16, 'The Dark Knight', 'dsadsadsadsadsa', 9, 0, '2025-08-13 12:01:42'),
(18, 104, 'yeşim', 'tiyatro', 3, 'Macbeth', 'güzel olmuş', 5, 0, '2025-08-04 07:16:23'),
(19, 104, 'yeşim', 'tiyatro', 3, 'Macbeth', 'torum ekleme', 4, 0, '2025-08-04 07:18:43'),
(21, 104, 'yeşim', 'dizi', 12, 'Daredevil', 'deneme yorumudur', 4, 0, '2025-08-04 07:27:08'),
(25, 104, 'yeşim', 'film', 55, 'Interstellar', 'dsadsadsadsadsa', 8, 0, '2025-08-04 07:34:04'),
(26, 104, 'yeşim', 'film', 55, 'Interstellar', 'sdasdsadsadsadsadsads', 4, 0, '2025-08-04 07:36:19'),
(24, 104, 'yeşim', 'film', 55, 'Interstellar', 'dsadsadsadsadsa', 7, 0, '2025-08-04 07:30:34'),
(27, 104, 'yeşim', 'film', 55, 'Interstellar', 'jfchjhuıjnbbrhtyyty', 7, 0, '2025-08-04 07:37:45'),
(28, 104, 'yeşim', 'film', 55, 'Interstellar', 'denemedeneme', 5, 0, '2025-08-04 07:39:46'),
(35, 104, 'yeşim', 'film', 17, 'The Matrix', 'dsadsadsadsadsas', 10, 0, '2025-08-04 10:45:59'),
(36, 104, 'yeşim', 'film', 19, 'The Lord of the Rings: The Fellowship of the Ring', 'fsafsafsafsafafsa', 10, 0, '2025-08-04 10:46:09'),
(37, 104, 'yeşim', 'film', 20, 'Jurassic Park', 'dsadsadsasa', 8, 0, '2025-08-04 11:04:18'),
(38, 104, 'yeşim', 'film', 20, 'Jurassic Park', '312321321321', 6, 0, '2025-08-04 11:11:08'),
(39, 104, 'yeşim', 'film', 20, 'Jurassic Park', 'sadsadsadsadsasa', 5, 0, '2025-08-04 11:28:54'),
(40, 104, 'yeşim', 'film', 30, 'The Grand Budapest Hotel', 'sdasadsadsadsasadsa', 10, 0, '2025-08-04 12:58:27'),
(42, 104, 'yeşim', 'film', 55, 'Interstellar', 'saddsadsadsadsadsa', 10, 0, '2025-08-05 12:09:01'),
(43, 104, 'yeşim', 'film', 17, 'The Matrix', 'fsasafsafsafsa', 10, 0, '2025-08-05 12:28:38'),
(44, 104, 'yeşim', 'film', 17, 'The Matrix', 'sadsadsadsadsada', 5, 0, '2025-08-05 12:28:46'),
(46, 104, 'yeşim', 'tiyatro', 10, 'Bir Yaz Gecesi Rüyası', 'gtgtggrtwrwrqew', 5, 0, '2025-08-05 12:50:48'),
(48, 104, 'yeşim', 'film', 28, 'The Godfather', 'dasdsadsadsadsdsa', 2, 0, '2025-08-06 10:08:43'),
(51, 111, 'test', 'dizi', 2, 'The Crown', 'sadsadsadsad', 10, 0, '2025-08-07 06:53:22'),
(52, 104, 'yeşim', 'dizi', 1, 'Breaking Bad', 'merhbsaaaa', 10, 0, '2025-08-07 10:02:29'),
(53, 104, 'yeşim', 'tiyatro', 4, 'Kral Lear', 'wwwewewwewew', 7, 0, '2025-08-07 10:04:10'),
(57, 104, 'yeşim', 'dizi', 20, 'Altered Carbon', 'sadsadsadsadasds', 10, 0, '2025-08-13 07:07:33'),
(58, 104, 'yeşim', 'anime', 3, 'Fullmetal Alchemist: Brotherhood', 'asdsasdsas', 8, 0, '2025-08-13 11:33:21'),
(61, 104, 'yeşim', 'film', 16, 'The Dark Knight', 'spoilerrrrr', 8, 1, '2025-08-13 12:02:05'),
(62, 104, 'yeşim', 'dizi', 8, 'Brooklyn Nine-Nine', 'sadsdsadasdsadsa', 9, 1, '2025-08-13 12:37:49'),
(63, 104, 'yeşim', 'dizi', 8, 'Brooklyn Nine-Nine', 'dasdasdsdsadas', 10, 0, '2025-08-13 12:37:58'),
(64, 104, 'yeşim', 'film', 16, 'The Dark Knight', 'sadasdsaddsadsa', 10, 1, '2025-08-13 13:16:26'),
(65, 104, 'yeşim', 'film', 16, 'The Dark Knight', 'asdsadsaddsadsa', 10, 0, '2025-08-13 13:18:51'),
(66, 104, 'yeşim', 'film', 16, 'The Dark Knight', 'dsadsadsadasdsa', 9, 0, '2025-08-13 13:21:38'),
(68, 104, 'yeşim', 'film', 16, 'The Dark Knight', 'asdsadsdsadsa', 8, 0, '2025-08-13 13:25:57'),
(69, 104, 'yeşim', 'dizi', 10, 'The Good Place', 'dsadsadasdsd', 8, 0, '2025-08-13 13:26:17'),
(70, 104, 'yeşim', 'belgesel', 2, 'Cosmos', 'spoilerrrrr', 5, 1, '2025-08-13 13:26:55'),
(71, 104, 'yeşim', 'film', 16, 'The Dark Knight', 'dsadsadsadsadsa', 8, 1, '2025-08-13 13:33:35'),
(72, 104, 'yeşim', 'film', 16, 'The Dark Knight', 'dsadsadasdsads', 9, 0, '2025-08-13 13:46:30'),
(73, 104, 'yeşim', 'film', 16, 'The Dark Knight', 'asdsadasds', 7, 0, '2025-08-13 13:58:48'),
(74, 104, 'yeşim', 'film', 16, 'The Dark Knight', 'dsadsdasdsad', 8, 1, '2025-08-13 14:16:22'),
(75, 104, 'yeşim', 'film', 16, 'The Dark Knight', 'dsadsadsadsa', 8, 1, '2025-08-15 13:32:15'),
(76, 104, 'yeşim', 'tiyatro', 2, 'Romeo ve Juliet', 'dasdsa6552525', 8, 0, '2025-08-15 13:33:16'),
(80, 104, 'yeşim', 'dizi', 5, 'The Queen\'s Gambit', 'dsadsa', 5, 0, '2025-08-18 08:03:16'),
(78, 104, 'yeşim', 'dizi', 8, 'Brooklyn Nine-Nine', 'dadsad', 4, 0, '2025-08-18 07:51:08'),
(79, 104, 'yeşim', 'dizi', 8, 'Brooklyn Nine-Nine', 'asdas', 2, 0, '2025-08-18 07:51:14'),
(81, 104, 'yeşim', 'dizi', 5, 'The Queen\'s Gambit', 'dsadds', 4, 0, '2025-08-18 08:04:26'),
(82, 104, 'yeşim', 'film', 16, 'The Dark Knight', 'asdsadsaasdsa', 6, 0, '2025-08-18 08:33:01'),
(83, 104, 'yeşim', 'dizi', 8, 'Brooklyn Nine-Nine', 'dasdasdasdasdsa', 4, 0, '2025-08-18 08:49:49'),
(84, 104, 'yeşim', 'dizi', 8, 'Brooklyn Nine-Nine', 'dasdsadasdsadas', 4, 0, '2025-08-18 09:02:47');

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `dizi_sezonlar`
--
ALTER TABLE `dizi_sezonlar`
  ADD CONSTRAINT `dizi_sezonlar_ibfk_1` FOREIGN KEY (`dizi_id`) REFERENCES `diziler` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
