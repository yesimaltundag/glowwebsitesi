-- Klasik Müzik Şarkılarının Fotoğraf ve Spotify URL'lerini Güncelleme
-- Bu dosyayı phpMyAdmin'de çalıştırarak kapak resimlerini ve Spotify linklerini güncelleyebilirsiniz

-- 1. Symphony No. 9 Choral (Ludwig van Beethoven)
UPDATE muzikler 
SET foto_url = 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=300&h=300&fit=crop&crop=center',
    spotify_url = 'https://open.spotify.com/track/3ilnnpmMMppHqoNtGDTngT'
WHERE muzik_adi = 'Symphony No. 9 Choral' AND sanatci = 'Ludwig van Beethoven';

-- 2. Für Elise (Ludwig van Beethoven)
UPDATE muzikler 
SET foto_url = 'https://images.unsplash.com/photo-1516280440614-37939bbacd81?w=300&h=300&fit=crop&crop=center',
    spotify_url = 'https://open.spotify.com/track/4CzN9rdDKNcyVNDpPIJh9L'
WHERE muzik_adi = 'Für Elise' AND sanatci = 'Ludwig van Beethoven';

-- 3. Symphony No. 5 (Ludwig van Beethoven)
UPDATE muzikler 
SET foto_url = 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=300&h=300&fit=crop&crop=center',
    spotify_url = 'https://open.spotify.com/track/3z8h0TU7ReDPLIbEnYhWZb'
WHERE muzik_adi = 'Symphony No. 5' AND sanatci = 'Ludwig van Beethoven';

-- 4. Moonlight Sonata (Ludwig van Beethoven)
UPDATE muzikler 
SET foto_url = 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=300&h=300&fit=crop&crop=center',
    spotify_url = 'https://open.spotify.com/track/0B6xJx46RK5xq8QZkOR2jQ'
WHERE muzik_adi = 'Moonlight Sonata' AND sanatci = 'Ludwig van Beethoven';

-- 5. Symphony No. 40 (Wolfgang Amadeus Mozart)
UPDATE muzikler 
SET foto_url = 'https://images.unsplash.com/photo-1516280440614-37939bbacd81?w=300&h=300&fit=crop&crop=center',
    spotify_url = 'https://open.spotify.com/track/3z8h0TU7ReDPLIbEnYhWZb'
WHERE muzik_adi = 'Symphony No. 40' AND sanatci = 'Wolfgang Amadeus Mozart';

-- 6. Eine kleine Nachtmusik (Wolfgang Amadeus Mozart)
UPDATE muzikler 
SET foto_url = 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=300&h=300&fit=crop&crop=center',
    spotify_url = 'https://open.spotify.com/track/0B6xJx46RK5xq8QZkOR2jQ'
WHERE muzik_adi = 'Eine kleine Nachtmusik' AND sanatci = 'Wolfgang Amadeus Mozart';

-- 7. Piano Concerto No. 21 (Wolfgang Amadeus Mozart)
UPDATE muzikler 
SET foto_url = 'https://images.unsplash.com/photo-1516280440614-37939bbacd81?w=300&h=300&fit=crop&crop=center',
    spotify_url = 'https://open.spotify.com/track/4CzN9rdDKNcyVNDpPIJh9L'
WHERE muzik_adi = 'Piano Concerto No. 21' AND sanatci = 'Wolfgang Amadeus Mozart';

-- 8. The Four Seasons (Antonio Vivaldi)
UPDATE muzikler 
SET foto_url = 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=300&h=300&fit=crop&crop=center',
    spotify_url = 'https://open.spotify.com/track/3z8h0TU7ReDPLIbEnYhWZb'
WHERE muzik_adi = 'The Four Seasons' AND sanatci = 'Antonio Vivaldi';

-- 9. Air on the G String (Johann Sebastian Bach)
UPDATE muzikler 
SET foto_url = 'https://images.unsplash.com/photo-1516280440614-37939bbacd81?w=300&h=300&fit=crop&crop=center',
    spotify_url = 'https://open.spotify.com/track/0B6xJx46RK5xq8QZkOR2jQ'
WHERE muzik_adi = 'Air on the G String' AND sanatci = 'Johann Sebastian Bach';

-- 10. Prelude in C Major (Johann Sebastian Bach)
UPDATE muzikler 
SET foto_url = 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=300&h=300&fit=crop&crop=center',
    spotify_url = 'https://open.spotify.com/track/4CzN9rdDKNcyVNDpPIJh9L'
WHERE muzik_adi = 'Prelude in C Major' AND sanatci = 'Johann Sebastian Bach';

-- 11. Toccata and Fugue in D minor (Johann Sebastian Bach)
UPDATE muzikler 
SET foto_url = 'https://images.unsplash.com/photo-1516280440614-37939bbacd81?w=300&h=300&fit=crop&crop=center',
    spotify_url = 'https://open.spotify.com/track/3z8h0TU7ReDPLIbEnYhWZb'
WHERE muzik_adi = 'Toccata and Fugue in D minor' AND sanatci = 'Johann Sebastian Bach';

-- 12. Canon in D (Johann Pachelbel)
UPDATE muzikler 
SET foto_url = 'https://images.unsplash.com/photo-1516280440614-37939bbacd81?w=300&h=300&fit=crop&crop=center',
    spotify_url = 'https://open.spotify.com/track/0B6xJx46RK5xq8QZkOR2jQ'
WHERE muzik_adi = 'Canon in D' AND sanatci = 'Johann Pachelbel';

-- Güncelleme sonrası kontrol sorgusu
SELECT muzik_adi, sanatci, foto_url, spotify_url FROM muzikler WHERE tur = 'Klasik' ORDER BY yayin_yili DESC;
