-- Filmler tablosu oluşturma
CREATE TABLE filmler (
    id INT AUTO_INCREMENT PRIMARY KEY,
    film_adi VARCHAR(255) NOT NULL,
    yil INT NOT NULL,
    sure VARCHAR(50) NOT NULL,
    imdb_puani DECIMAL(3,1) NOT NULL,
    poster_url TEXT NOT NULL,
    ozet TEXT NOT NULL,
    yonetmen VARCHAR(255) NOT NULL,
    oyuncular TEXT NOT NULL,
    tur VARCHAR(255) NOT NULL,
    ulke VARCHAR(255) NOT NULL,
    fragman_url TEXT NOT NULL,
    kategori VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tiyatro eserleri tablosu oluşturma
CREATE TABLE tiyatro_eserleri (
    id INT AUTO_INCREMENT PRIMARY KEY,
    eser_adi VARCHAR(255) NOT NULL,
    yazar VARCHAR(255) NOT NULL,
    yil INT NOT NULL,
    tur ENUM('Tragedya', 'Komedi', 'Dram', 'Müzikal') NOT NULL,
    puan DECIMAL(3,1) DEFAULT 0.0,
    aciklama TEXT NOT NULL,
    sure VARCHAR(50),
    karakter_sayisi INT,
    dil VARCHAR(100) DEFAULT 'Türkçe',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Kullanıcılar tablosu oluşturma
CREATE TABLE kisiler (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    adsoyad VARCHAR(100) NOT NULL,
    sifre VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'kullanici') DEFAULT 'kullanici',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Yorumlar tablosu oluşturma
CREATE TABLE yorumlar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    icerik_id INT NOT NULL,
    kullanici_id INT NOT NULL,
    kullanici_adi VARCHAR(100) NOT NULL,
    yorum TEXT NOT NULL,
    tur ENUM('film', 'dizi', 'tiyatro') NOT NULL,
    tarih TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (kullanici_id) REFERENCES kisiler(id) ON DELETE CASCADE
);

-- Yorum reaksiyonları tablosu oluşturma
CREATE TABLE yorum_reaksiyonlar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    yorum_id INT NOT NULL,
    kullanici_id INT NOT NULL,
    reaksiyon_tipi ENUM('like', 'dislike') NOT NULL,
    tarih TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (yorum_id) REFERENCES yorumlar(id) ON DELETE CASCADE,
    FOREIGN KEY (kullanici_id) REFERENCES kisiler(id) ON DELETE CASCADE,
    UNIQUE KEY unique_reaksiyon (yorum_id, kullanici_id)
);

-- ===== BELGESELLER TABLOSU =====
CREATE TABLE belgeseller (
    id INT AUTO_INCREMENT PRIMARY KEY,
    belgesel_adi VARCHAR(200) NOT NULL,
    yonetmen VARCHAR(100) NOT NULL,
    yil INT NOT NULL,
    tur VARCHAR(50) NOT NULL,
    puan DECIMAL(3,1) DEFAULT 0.0,
    aciklama TEXT,
    sure VARCHAR(20),
    ulke VARCHAR(50),
    dil VARCHAR(50),
    konu VARCHAR(200),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Örnek kullanıcı ekleme
INSERT INTO kisiler (username, adsoyad, sifre, rol) VALUES
('admin', 'Yönetici', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
('test', 'Test Kullanıcı', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'kullanici');

-- Örnek tiyatro eserleri ekleme
INSERT INTO tiyatro_eserleri (eser_adi, yazar, yil, tur, puan, aciklama, sure, karakter_sayisi) VALUES
('Hamlet', 'William Shakespeare', 1603, 'Tragedya', 9.5, 'Danimarka prensi Hamlet''in babasının ölümünün ardından yaşadığı trajik hikayesi. ''Olmak ya da olmamak, işte bütün mesele bu!''', '3 saat', 15),
('Romeo ve Juliet', 'William Shakespeare', 1597, 'Tragedya', 9.3, 'İki düşman ailenin çocukları arasında yaşanan büyük aşk hikayesi. Dünya edebiyatının en ünlü aşk destanı.', '2.5 saat', 12),
('Macbeth', 'William Shakespeare', 1606, 'Tragedya', 9.1, 'İktidar hırsıyla kör olan Macbeth''in trajik düşüşü. Ambisyon ve ihanetin bedeli.', '2.5 saat', 18),
('Kral Lear', 'William Shakespeare', 1606, 'Tragedya', 9.0, 'Yaşlı kralın kızları arasında krallığını bölüştürmesi ve sonrasında yaşanan trajik olaylar.', '3.5 saat', 20),
('Othello', 'William Shakespeare', 1604, 'Tragedya', 8.9, 'Kıskançlık ve ihanetin yok ettiği büyük bir aşk hikayesi. Othello''nun trajik sonu.', '2.5 saat', 14),
('Antigone', 'Sophokles', 441, 'Tragedya', 8.8, 'Antik Yunan''da aile bağları ve devlet yasaları arasındaki çatışmayı anlatan trajik eser.', '1.5 saat', 8),
('Kral Oidipus', 'Sophokles', 429, 'Tragedya', 8.7, 'Kaderin kaçınılmazlığını ve insanın kendi yazgısıyla mücadelesini anlatan klasik tragedya.', '2 saat', 10),
('Medea', 'Euripides', 431, 'Tragedya', 8.6, 'Aşk, ihanet ve intikamın en korkunç hikayesi. Medea''nın trajik intikamı.', '2 saat', 9),
('Venedik Taciri', 'William Shakespeare', 1600, 'Komedi', 8.5, 'Venedik''te geçen, aşk, dostluk ve adalet temalarını işleyen ünlü komedi.', '2.5 saat', 16),
('Bir Yaz Gecesi Rüyası', 'William Shakespeare', 1596, 'Komedi', 8.4, 'Büyülü bir ormanda geçen, aşk ve büyünün iç içe geçtiği eğlenceli komedi.', '2.5 saat', 15),
('Cyrano de Bergerac', 'Edmond Rostand', 1897, 'Tragedya', 8.3, 'Büyük burnu yüzünden aşkını gizleyen Cyrano''nun romantik ve trajik hikayesi.', '2.5 saat', 12),
('Faust', 'Johann Wolfgang von Goethe', 1808, 'Tragedya', 8.2, 'Şeytanla anlaşma yapan bilgin Faust''un arayışı ve trajik sonu.', '3 saat', 25),
('Don Juan', 'Molière', 1665, 'Komedi', 8.1, 'Kadın avcısı Don Juan''ın maceraları ve sonunda karşılaştığı kader.', '2 saat', 14),
('Tartuffe', 'Molière', 1664, 'Komedi', 8.0, 'Dindar görünümlü sahtekar Tartuffe''ün bir aileyi nasıl kandırdığını anlatan komedi.', '2 saat', 12),
('Hedda Gabler', 'Henrik Ibsen', 1890, 'Tragedya', 7.9, 'Sıkıcı evlilik hayatından bunalan Hedda''nın trajik sonu.', '2.5 saat', 8),
('Nora', 'Henrik Ibsen', 1879, 'Dram', 7.8, 'Kadın hakları ve evlilik kurumunu sorgulayan devrimci eser.', '2.5 saat', 9),
('Sezuan''ın İyi İnsanı', 'Bertolt Brecht', 1943, 'Dram', 7.7, 'Kapitalist sistemde iyi olmanın zorluğunu anlatan epik tiyatro eseri.', '3 saat', 20),
('Üç Kız Kardeş', 'Anton Çehov', 1901, 'Dram', 7.6, 'Moskova''ya dönme hayali kuran üç kız kardeşin umutsuz bekleyişi.', '2.5 saat', 10),
('Vanya Dayı', 'Anton Çehov', 1899, 'Dram', 7.5, 'Hayatın anlamsızlığı ve umutsuzluğu üzerine derin bir dram.', '2.5 saat', 8),
('Martı', 'Anton Çehov', 1896, 'Dram', 7.4, 'Sanat, aşk ve hayatın anlamı üzerine düşündüren modern dram.', '2 saat', 12);

-- Örnek veriler ekleme
INSERT INTO filmler (film_adi, yil, sure, imdb_puani, poster_url, ozet, yonetmen, oyuncular, tur, ulke, fragman_url, kategori) VALUES
-- Aksiyon Filmleri
('Die Hard', 1988, '132 dk', 8.2, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTL6o0em-GcedqO__CLcSkvhrtqfGOhjKspeQiDE7PuKvBArfPdmGOxZKBtvdxQ4f5xiMeVYHzYnlsEgvmCPkBGAUimFOpX6yQmI0EUnfBFVw', 'John McClane, Los Angeles\'taki Nakatomi Plaza\'da Noel partisi sırasında teröristler tarafından rehin alınır. Tek başına teröristleri alt etmeye çalışan McClane\'in mücadelesi başlar.', 'John McTiernan', 'Bruce Willis, Alan Rickman, Bonnie Bedelia', 'Aksiyon, Gerilim', 'ABD', 'https://www.youtube.com/embed/2TQ-pOvI6Xo', 'Aksiyon'),

('Mad Max: Fury Road', 2015, '120 dk', 8.1, 'https://m.media-amazon.com/images/M/MV5BN2EwM2I5OWMtMGQyMi00Zjg1LWJkNTctZTdjYTA4OGUwZjMyXkEyXkFqcGdeQXVyMTMxODk2OTU@._V1_SX300.jpg', 'Post-apokaliptik dünyada Max ve Furiosa, Immortan Joe\'nun elinden kaçmaya çalışan kadınları kurtarmak için tehlikeli bir yolculuğa çıkar.', 'George Miller', 'Tom Hardy, Charlize Theron, Nicholas Hoult', 'Aksiyon, Macera', 'Avustralya, ABD', 'https://www.youtube.com/embed/hA2ple9fkcc', 'Aksiyon'),

('John Wick', 2014, '101 dk', 7.4, 'https://m.media-amazon.com/images/M/MV5BMTU2NjA1ODgzMF5BMl5BanBnXkFtZTgwMTM2MTI4MjE@._V1_SX300.jpg', 'Emekli suikastçı John Wick, köpeğini öldüren ve arabasını çalan gangsterlerden intikam almak için eski mesleğine geri döner.', 'Chad Stahelski', 'Keanu Reeves, Michael Nyqvist, Alfie Allen', 'Aksiyon, Suç', 'ABD', 'https://www.youtube.com/embed/2AUmvWm5ZDQ', 'Aksiyon'),

-- Macera Filmleri
('Indiana Jones: Raiders of the Lost Ark', 1981, '115 dk', 8.4, 'https://m.media-amazon.com/images/M/MV5BMjA0ODEzMTc2Nl5BMl5BanBnXkFtZTcwODM2MjAxNA@@._V1_SX300.jpg', 'Arkeolog Indiana Jones, Kayıp Ahit Sandığı\'nı bulmak için Nazi\'lerle yarışır. Steven Spielberg\'in yönettiği macera klasiği.', 'Steven Spielberg', 'Harrison Ford, Karen Allen, Paul Freeman', 'Macera, Aksiyon', 'ABD', 'https://www.youtube.com/embed/XkkzKHCx154', 'Macera'),

('The Lord of the Rings: The Fellowship of the Ring', 2001, '178 dk', 8.8, 'https://m.media-amazon.com/images/M/MV5BN2EyZjM3NzUtNWUzMi00MTgxLWI0NTctMzY4M2VlMWQ4M2NkXkEyXkFqcGdeQXVyNDUzOTQ5MjY@._V1_SX300.jpg', 'Frodo Baggins, Yüzük\'ü yok etmek için tehlikeli bir yolculuğa çıkar. Orta Dünya\'nın kaderi Yüzük Taşıyıcısı\'nın elinde.', 'Peter Jackson', 'Elijah Wood, Ian McKellen, Viggo Mortensen', 'Macera, Fantastik', 'ABD, Yeni Zelanda', 'https://www.youtube.com/embed/V75dMMIW2B4', 'Macera'),

-- Dram Filmleri
('The Shawshank Redemption', 1994, '142 dk', 9.3, 'https://m.media-amazon.com/images/M/MV5BNDE3ODcxYzMtY2YzZC00NmNlLWJiNDMtZDViZWM2MzIxZDYwXkEyXkFqcGdeQXVyNjAwNDUxODI@._V1_SX300.jpg', 'Andy Dufresne, karısını öldürmekle suçlanır ve Shawshank Hapishanesi\'ne gönderilir. Orada Red ile dostluk kurar ve umut dolu bir hikaye başlar.', 'Frank Darabont', 'Tim Robbins, Morgan Freeman, Bob Gunton', 'Dram', 'ABD', 'https://www.youtube.com/embed/6hB3S9bIaco', 'Dram'),

('Forrest Gump', 1994, '142 dk', 8.8, 'https://m.media-amazon.com/images/M/MV5BNWIwODRlZTUtY2U3ZS00Yzg1LWJhNzYtMmZiYmEyNmU1NjMzXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg', 'Forrest Gump, düşük IQ\'lu ama iyi kalpli bir adamın hayatı. Vietnam Savaşı\'ndan ping pong şampiyonluğuna kadar birçok macera yaşar.', 'Robert Zemeckis', 'Tom Hanks, Robin Wright, Gary Sinise', 'Dram, Komedi', 'ABD', 'https://www.youtube.com/embed/bLvqoHBptjg', 'Dram'),

-- Komedi Filmleri
('The Grand Budapest Hotel', 2014, '99 dk', 8.1, 'https://m.media-amazon.com/images/M/MV5BMzM5NjUxOTEyMl5BMl5BanBnXkFtZTgwNjEyMDM0MDE@._V1_SX300.jpg', 'Wes Anderson\'ın yönettiği, Grand Budapest Hotel\'in efsanevi kapıcısı Gustave H. ve çırağı Zero\'nun maceraları.', 'Wes Anderson', 'Ralph Fiennes, Tony Revolori, F. Murray Abraham', 'Komedi, Macera', 'ABD, Almanya', 'https://www.youtube.com/embed/1Fg5iWmQjwk', 'Komedi'),

('The Hangover', 2009, '100 dk', 7.7, 'https://m.media-amazon.com/images/M/MV5BNGQwZjg5YmYtY2VkNC00NzliLTljYTctNzI5NmU3MjE2ODQzXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SX300.jpg', 'Dört arkadaş Las Vegas\'ta düğün öncesi parti yapar. Ertesi sabah damat kayıptır ve geceyi hatırlamıyorlardır.', 'Todd Phillips', 'Bradley Cooper, Ed Helms, Zach Galifianakis', 'Komedi', 'ABD', 'https://www.youtube.com/embed/tcdUhdOlz9M', 'Komedi'),

-- Romantik Filmleri
('The Notebook', 2004, '123 dk', 7.8, 'https://m.media-amazon.com/images/M/MV5BMTk3OTM5Njg5M15BMl5BanBnXkFtZTYwMzA0ODI3._V1_SX300.jpg', 'Noah ve Allie\'nin aşk hikayesi. Farklı sosyal sınıflardan gelen iki gencin yasak aşkı ve hayat boyu süren bağları.', 'Nick Cassavetes', 'Ryan Gosling, Rachel McAdams, James Garner', 'Romantik, Dram', 'ABD', 'https://www.youtube.com/embed/FC6biTjZyZw', 'Romantik'),

('La La Land', 2016, '128 dk', 8.0, 'https://m.media-amazon.com/images/M/MV5BMzUzNDM2NzM2MV5BMl5BanBnXkFtZTgwNTM3NTg4OTE@._V1_SX300.jpg', 'Los Angeles\'ta bir aktris ve müzisyenin aşk hikayesi. Damien Chazelle\'in yönettiği Oscar ödüllü müzikal.', 'Damien Chazelle', 'Ryan Gosling, Emma Stone, John Legend', 'Romantik, Komedi, Müzikal', 'ABD', 'https://www.youtube.com/embed/0pdqf4P9MB8', 'Romantik'),

-- Korku Filmleri
('The Shining', 1980, '146 dk', 8.4, 'https://m.media-amazon.com/images/M/MV5BZWFlYmY2MGEtZjVkYS00YzU4LTg0YjQtYzY1ZGE3NTA5NGQxXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg', 'Stanley Kubrick\'in yönettiği, Jack Nicholson\'ın oynadığı korku klasiği. Overlook Hotel\'de geçen paranormal olaylar.', 'Stanley Kubrick', 'Jack Nicholson, Shelley Duvall, Danny Lloyd', 'Korku, Gerilim', 'ABD, İngiltere', 'https://www.youtube.com/embed/S014oGZiSdI', 'Korku'),

('A Quiet Place', 2018, '90 dk', 7.5, 'https://m.media-amazon.com/images/M/MV5BMjI0MDMzNTQ0M15BMl5BanBnXkFtZTgwMTM5NzM3NDM@._V1_SX300.jpg', 'Ses duyarlı yaratıkların dünyayı ele geçirdiği bir dünyada, sessizlik hayatta kalmanın tek yoludur.', 'John Krasinski', 'Emily Blunt, John Krasinski, Millicent Simmonds', 'Korku, Gerilim', 'ABD', 'https://www.youtube.com/embed/WR7cc5t7tv8', 'Korku'),

-- Gerilim Filmleri
('Inception', 2010, '148 dk', 8.8, 'https://m.media-amazon.com/images/M/MV5BMjAxMzY3NjcxNF5BMl5BanBnXkFtZTcwNTI5OTM0Mw@@._V1_SX300.jpg', 'Christopher Nolan\'ın yönettiği, rüya içinde rüya konseptini işleyen bilim kurgu gerilim filmi.', 'Christopher Nolan', 'Leonardo DiCaprio, Joseph Gordon-Levitt, Ellen Page', 'Gerilim, Bilim Kurgu', 'ABD, İngiltere', 'https://www.youtube.com/embed/YoHD9XEInc0', 'Gerilim'),

('The Silence of the Lambs', 1991, '118 dk', 8.6, 'https://m.media-amazon.com/images/M/MV5BNjNhZTk0ZmEtNjJhMi00YzFlLWE1MmEtYzM1M2ZmMGMwMTU4XkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_SX300.jpg', 'FBI ajanı Clarice Starling, seri katil Buffalo Bill\'i yakalamak için Hannibal Lecter\'dan yardım ister.', 'Jonathan Demme', 'Jodie Foster, Anthony Hopkins, Scott Glenn', 'Gerilim, Suç', 'ABD', 'https://www.youtube.com/embed/W6Mm8Sbe__o', 'Gerilim'),

-- Bilim Kurgu Filmleri
('Blade Runner', 1982, '117 dk', 8.1, 'https://m.media-amazon.com/images/M/MV5BNzQzMzJhZTEtOWM4NS00MTdhLTg0YjgtMjM4MDRkZjUwZDBlXkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_SX300.jpg', 'Harrison Ford\'un oynadığı, Ridley Scott\'ın yönettiği distopik bilim kurgu filmi. Replicant avcısı Deckard\'ın hikayesi.', 'Ridley Scott', 'Harrison Ford, Rutger Hauer, Sean Young', 'Bilim Kurgu, Gerilim', 'ABD', 'https://www.youtube.com/embed/eogpIG53Cis', 'Bilim Kurgu'),

('2001: A Space Odyssey', 1968, '149 dk', 8.3, 'https://m.media-amazon.com/images/M/MV5BMmNlYzRiNDctZWNhMi00MzI4LThkZTctMTUzMmZkMmFmNThmXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SX300.jpg', 'Stanley Kubrick\'in yönettiği, insanlığın evrimini ve yapay zeka ile ilişkisini anlatan bilim kurgu klasiği.', 'Stanley Kubrick', 'Keir Dullea, Gary Lockwood, William Sylvester', 'Bilim Kurgu, Macera', 'ABD, İngiltere', 'https://www.youtube.com/embed/oR_e9y-bka0', 'Bilim Kurgu'),

-- Fantastik Filmleri
('The Lord of the Rings: The Return of the King', 2003, '201 dk', 9.0, 'https://m.media-amazon.com/images/M/MV5BNzA5ZDNlZWMtM2NhNS00NDJjLTk4NDItYTRmY2EwMWZlMTY3XkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SX300.jpg', 'Yüzük Kardeşliği\'nin son filmi. Frodo ve Sam Yüzük\'ü yok etmek için Mordor\'a giderken, diğerleri Gondor\'u savunur.', 'Peter Jackson', 'Elijah Wood, Ian McKellen, Viggo Mortensen', 'Fantastik, Macera', 'ABD, Yeni Zelanda', 'https://www.youtube.com/embed/r5X-hFf6Bwo', 'Fantastik'),

('Pan\'s Labyrinth', 2006, '118 dk', 8.2, 'https://m.media-amazon.com/images/M/MV5BMTU3ODg2NjQ5NF5BMl5BanBnXkFtZTcwMDEwODgzMQ@@._V1_SX300.jpg', 'Guillermo del Toro\'nun yönettiği, İspanya İç Savaşı sırasında geçen fantastik film. Ofelia\'nın büyülü dünyası.', 'Guillermo del Toro', 'Ivana Baquero, Sergi López, Maribel Verdú', 'Fantastik, Dram', 'İspanya, Meksika', 'https://www.youtube.com/embed/E7XGNPXdlGQ', 'Fantastik'),

-- Animasyon Filmleri
('Spirited Away', 2001, '125 dk', 8.6, 'https://m.media-amazon.com/images/M/MV5BMjlmZmI5MDctNDE2YS00YWE0LWE5ZWItZDBhYWQ0NTcxNTcyXkEyXkFqcGdeQXVyMTMxODk2OTU@._V1_SX300.jpg', 'Hayao Miyazaki\'nin yönettiği, Studio Ghibli\'nin en sevilen filmlerinden. Chihiro\'nun büyülü dünyadaki macerası.', 'Hayao Miyazaki', 'Rumi Hiiragi, Miyu Irino, Mari Natsuki', 'Animasyon, Fantastik', 'Japonya', 'https://www.youtube.com/embed/ByXuk9QqQkk', 'Animasyon'),

('Up', 2009, '96 dk', 8.3, 'https://m.media-amazon.com/images/M/MV5BMTk3NDE2NzI4NF5BMl5BanBnXkFtZTgwNzE1MzEyMTE@._V1_SX300.jpg', 'Pixar\'ın yönettiği, Carl Fredricksen\'in evini balonlarla uçurarak maceraya çıkması. Dokunaklı bir dostluk hikayesi.', 'Pete Docter', 'Edward Asner, Jordan Nagai, John Ratzenberger', 'Animasyon, Macera', 'ABD', 'https://www.youtube.com/embed/qas5lWp7_R0', 'Animasyon'),

-- Belgesel Filmleri
('Planet Earth', 2006, '550 dk', 9.4, 'https://m.media-amazon.com/images/M/MV5BY2NjNDUzOTgtMDFmNC00ZGQ4LWE5MDctMzczNGVlOGU1N2MyXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 'BBC\'nin doğa belgeseli serisi, dünyanın en etkileyici manzaralarını gösteren. David Attenborough\'nun anlatımıyla doğanın muhteşemliği.', 'Alastair Fothergill', 'David Attenborough, Sigourney Weaver', 'Belgesel, Doğa', 'İngiltere', 'https://www.youtube.com/embed/aETNYyrqNYE', 'Belgesel'),

('The Act of Killing', 2012, '115 dk', 8.2, 'https://m.media-amazon.com/images/S/pv-target-images/cb78a0c078369a1b45956ce379de226593c1e02b65746eac4d1c5330adb6ce31.jpg', 'Joshua Oppenheimer\'ın yönettiği, Endonezya\'daki katliamları anlatan belgesel. Katillerin kendi suçlarını yeniden canlandırması.', 'Joshua Oppenheimer', 'Anwar Congo, Herman Koto, Syamsul Arifin', 'Belgesel, Suç', 'Endonezya, Danimarka', 'https://www.youtube.com/embed/8eJQK4U_6X4', 'Belgesel'),

-- Suç/Polisiye Filmleri
('The Godfather', 1972, '175 dk', 9.2, 'https://m.media-amazon.com/images/M/MV5BM2MyNjYxNmUtYTAwNi00MTYxLWJmNWYtYzZlODY3ZTk3OTFlXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SX300.jpg', 'Francis Ford Coppola\'nın yönettiği, Corleone ailesinin hikayesi. Marlon Brando ve Al Pacino\'nun unutulmaz performansları.', 'Francis Ford Coppola', 'Marlon Brando, Al Pacino, James Caan', 'Suç, Dram', 'ABD', 'https://www.youtube.com/embed/sY1S34973zA', 'Suç / Polisiye'),

('Goodfellas', 1990, '146 dk', 8.7, 'https://m.media-amazon.com/images/M/MV5BY2NkZjEzMDgtN2RjYy00YzM1LWI4ZmQtMjIwYjFjNmI3ZGEwXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SX300.jpg', 'Martin Scorsese\'nin yönettiği, New York mafyasının gerçek hikayesi. Ray Liotta, Robert De Niro ve Joe Pesci\'nin oyunculuğu.', 'Martin Scorsese', 'Ray Liotta, Robert De Niro, Joe Pesci', 'Suç, Biyografi', 'ABD', 'https://www.youtube.com/embed/qo5jJpHtI1Y', 'Suç / Polisiye'),

-- Savaş Filmleri
('Saving Private Ryan', 1998, '169 dk', 8.6, 'https://m.media-amazon.com/images/M/MV5BZjhkMDM4MWItZTVjOC00ZDRhLThmYTAtM2I5NzBmNmNlMzI1XkEyXkFqcGdeQXVyNDYyMDk5MTU@._V1_SX300.jpg', 'Steven Spielberg\'in yönettiği, II. Dünya Savaşı\'nın en kanlı çıkarması olan Omaha Beach\'i konu alan film.', 'Steven Spielberg', 'Tom Hanks, Matt Damon, Tom Sizemore', 'Savaş, Dram', 'ABD', 'https://www.youtube.com/embed/9CiW_DgxCnQ', 'Savaş'),

('Apocalypse Now', 1979, '147 dk', 8.4, 'https://m.media-amazon.com/images/M/MV5BMDdhODg0MjYtYzBiOS00ZmI5LWEwZGYtZDEyNDU4MmQyNzFkXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SX300.jpg', 'Francis Ford Coppola\'nın yönettiği, Vietnam Savaşı\'nın psikolojik etkilerini anlatan film.', 'Francis Ford Coppola', 'Marlon Brando, Martin Sheen, Robert Duvall', 'Savaş, Dram', 'ABD', 'https://www.youtube.com/embed/FTjG-Afu_yU', 'Savaş'),

-- Yerli Filmleri
('Babam ve Oğlum', 2005, '112 dk', 8.3, 'https://upload.wikimedia.org/wikipedia/tr/8/8a/Babam_ve_O%C4%9Flum_film_posteri.jpg', 'Çağan Irmak\'ın yönettiği, Türk sinemasının en etkileyici dram filmlerinden. Sadık\'ın babasıyla yeniden buluşması ve aile bağlarının gücü.', 'Çağan Irmak', 'Fikret Kuşkan, Çetin Tekindor, Hümeyra', 'Dram, Aile', 'Türkiye', 'https://www.youtube.com/embed/8X5gYQZQZQZ', 'Yerli'),

('Recep İvedik', 2008, '100 dk', 6.8, 'https://upload.wikimedia.org/wikipedia/tr/8/8a/Recep_%C4%B0vedik_film_posteri.jpg', 'Togan Gökbakar\'ın yönettiği, Şahan Gökbakar\'ın yarattığı Recep İvedik karakterinin ilk filmi. Türkiye\'nin en çok izlenen komedi serilerinden biri.', 'Togan Gökbakar', 'Şahan Gökbakar, Nurullah Çelebi, Ahmet Kural', 'Komedi', 'Türkiye', 'https://www.youtube.com/embed/9Y5gYQZQZQZ', 'Yerli');

-- ===== BELGESEL ÖRNEK VERİLERİ =====
INSERT INTO belgeseller (belgesel_adi, yonetmen, yil, tur, puan, aciklama, sure, ulke, dil, konu) VALUES
('Planet Earth', 'Alastair Fothergill', 2006, 'Doğa', 9.4, 'Dünya gezegeninin muhteşem doğal yaşamını gözler önüne seren efsanevi belgesel serisi.', '11 Bölüm', 'İngiltere', 'İngilizce', 'Doğa ve Vahşi Yaşam'),
('Cosmos: A Spacetime Odyssey', 'Ann Druyan', 2014, 'Bilim', 9.3, 'Neil deGrasse Tyson tarafından sunulan, evrenin sırlarını keşfeden bilimsel belgesel.', '13 Bölüm', 'ABD', 'İngilizce', 'Uzay ve Bilim'),
('The Blue Planet', 'Alastair Fothergill', 2001, 'Deniz', 9.0, 'Okyanusların derinliklerindeki yaşamı anlatan görsel şölen niteliğinde belgesel.', '8 Bölüm', 'İngiltere', 'İngilizce', 'Deniz Yaşamı'),
('Human Planet', 'Tom Hugh-Jones', 2011, 'İnsan', 8.8, 'İnsanların dünyanın farklı bölgelerinde nasıl yaşadığını gösteren etkileyici belgesel.', '8 Bölüm', 'İngiltere', 'İngilizce', 'İnsan Yaşamı'),
('Frozen Planet', 'Alastair Fothergill', 2011, 'Kutup', 9.0, 'Kutuplardaki yaşamı ve iklim değişikliklerini anlatan çarpıcı belgesel.', '7 Bölüm', 'İngiltere', 'İngilizce', 'Kutup Bölgeleri'),
('Life', 'Martha Holmes', 2009, 'Doğa', 9.1, 'Dünya üzerindeki çeşitli yaşam formlarını inceleyen kapsamlı belgesel serisi.', '10 Bölüm', 'İngiltere', 'İngilizce', 'Yaşam Çeşitliliği'),
('The Civil War', 'Ken Burns', 1990, 'Tarih', 9.1, 'Amerikan İç Savaşının detaylı analizini yapan tarihi belgesel.', '9 Bölüm', 'ABD', 'İngilizce', 'Tarih'),
('March of the Penguins', 'Luc Jacquet', 2005, 'Hayvan', 7.6, 'İmparator penguenlerinin zorlu yaşam mücadelesini anlatan dokunaklı belgesel.', '85 dk', 'Fransa', 'Fransızca', 'Penguen Yaşamı'),
('An Inconvenient Truth', 'Davis Guggenheim', 2006, 'Çevre', 7.4, 'Al Gore tarafından sunulan küresel ısınma hakkında uyarı niteliğinde belgesel.', '96 dk', 'ABD', 'İngilizce', 'Küresel Isınma'),
('The Last Dance', 'Jason Hehir', 2020, 'Spor', 9.1, 'Michael Jordan ve Chicago Bulls\'un 1997-98 sezonunu anlatan spor belgeseli.', '10 Bölüm', 'ABD', 'İngilizce', 'Basketbol Tarihi'); 