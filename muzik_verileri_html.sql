-- HTML'deki müzik verilerini tabloya uygun hale getirme
-- Tablo yapısı: id, muzik_adi, tur, sure, yayin_yili, spotify_url, sanatci, foto_url

INSERT INTO muzikler (muzik_adi, tur, sure, yayin_yili, spotify_url, sanatci, foto_url) VALUES
-- KLASİK MÜZİK (12 şarkı)
('Moonlight Sonata', 'Klasik', 879, '1801', 'https://open.spotify.com/track/4CzN9rdDKNcyVNDpPIJh9L', 'Ludwig van Beethoven', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Symphony No. 5', 'Klasik', 2007, '1808', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Ludwig van Beethoven', 'https://images.unsplash.com/photo-1516280440614-37939bbacd81?w=80&h=80&fit=crop&crop=center'),
('The Four Seasons', 'Klasik', 2535, '1723', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Antonio Vivaldi', 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=80&h=80&fit=crop&crop=center'),
('Eine kleine Nachtmusik', 'Klasik', 1012, '1787', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Wolfgang Amadeus Mozart', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Toccata and Fugue in D minor', 'Klasik', 525, '1704', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Johann Sebastian Bach', 'https://images.unsplash.com/photo-1516280440614-37939bbacd81?w=80&h=80&fit=crop&crop=center'),
('Prelude in C Major', 'Klasik', 138, '1722', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Johann Sebastian Bach', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Symphony No. 9 Choral', 'Klasik', 4440, '1824', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Ludwig van Beethoven', 'https://images.unsplash.com/photo-1516280440614-37939bbacd81?w=80&h=80&fit=crop&crop=center'),
('Piano Concerto No. 21', 'Klasik', 1710, '1785', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Wolfgang Amadeus Mozart', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Canon in D', 'Klasik', 320, '1680', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Johann Pachelbel', 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=80&h=80&fit=crop&crop=center'),
('Symphony No. 40', 'Klasik', 1785, '1788', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Wolfgang Amadeus Mozart', 'https://images.unsplash.com/photo-1516280440614-37939bbacd81?w=80&h=80&fit=crop&crop=center'),
('Für Elise', 'Klasik', 190, '1810', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Ludwig van Beethoven', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Air on the G String', 'Klasik', 255, '1723', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Johann Sebastian Bach', 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=80&h=80&fit=crop&crop=center'),

-- JAZZ (6 şarkı)
('Take Five', 'Jazz', 324, '1959', 'https://open.spotify.com/track/1YQWosTIljIvxAgHWTp7KP', 'Dave Brubeck Quartet', 'https://images.unsplash.com/photo-1511379938547-c1f69419868d?w=80&h=80&fit=crop&crop=center'),
('So What', 'Jazz', 567, '1959', 'https://open.spotify.com/track/4vq49ovV9wDgfmrDvZvl2Q', 'Miles Davis', 'https://images.unsplash.com/photo-1511379938547-c1f69419868d?w=80&h=80&fit=crop&crop=center'),
('What a Wonderful World', 'Jazz', 139, '1967', 'https://open.spotify.com/track/29U7stRjqHU6rMiS8BfaI9', 'Louis Armstrong', 'https://images.unsplash.com/photo-1511379938547-c1f69419868d?w=80&h=80&fit=crop&crop=center'),
('Take the A Train', 'Jazz', 180, '1941', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Duke Ellington', 'https://images.unsplash.com/photo-1511379938547-c1f69419868d?w=80&h=80&fit=crop&crop=center'),
('Blue in Green', 'Jazz', 338, '1959', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Miles Davis', 'https://images.unsplash.com/photo-1511379938547-c1f69419868d?w=80&h=80&fit=crop&crop=center'),
('Giant Steps', 'Jazz', 293, '1960', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'John Coltrane', 'https://images.unsplash.com/photo-1511379938547-c1f69419868d?w=80&h=80&fit=crop&crop=center'),

-- ROCK (6 şarkı)
('Bohemian Rhapsody', 'Rock', 354, '1975', 'https://open.spotify.com/track/3z8h0TU7ReDPLIbEnYhWZb', 'Queen', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Stairway to Heaven', 'Rock', 482, '1971', 'https://open.spotify.com/track/5CQ30WqJwcep0pYcV4AMNc', 'Led Zeppelin', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Hotel California', 'Rock', 391, '1976', 'https://open.spotify.com/track/40riOy7x9W7GXjyGp4pjAv', 'Eagles', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Sweet Child O Mine', 'Rock', 356, '1987', 'https://open.spotify.com/track/7snQQk1zcKl8gZ92AnuZWg', 'Guns N Roses', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Smells Like Teen Spirit', 'Rock', 301, '1991', 'https://open.spotify.com/track/5ghIJDpPoe3CfHMGu71E6T', 'Nirvana', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Wonderwall', 'Rock', 259, '1995', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Oasis', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),

-- POP (6 şarkı)
('Blinding Lights', 'Pop', 200, '2019', 'https://open.spotify.com/track/0VjIjW4GlUZAMYd2vXMi3b', 'The Weeknd', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Levitating', 'Pop', 203, '2020', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Dua Lipa', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('As It Was', 'Pop', 167, '2022', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Harry Styles', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Flowers', 'Pop', 200, '2023', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Miley Cyrus', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Vampire', 'Pop', 219, '2023', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Olivia Rodrigo', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Cruel Summer', 'Pop', 178, '2019', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Taylor Swift', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),

-- FOLK (6 şarkı)
('The Sound of Silence', 'Folk', 184, '1964', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Simon & Garfunkel', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Blowin in the Wind', 'Folk', 165, '1963', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Bob Dylan', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('House of the Rising Sun', 'Folk', 259, '1964', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'The Animals', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Scarborough Fair', 'Folk', 195, '1966', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Simon & Garfunkel', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Mr. Tambourine Man', 'Folk', 310, '1965', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Bob Dylan', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('California Dreamin', 'Folk', 174, '1965', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'The Mamas & The Papas', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),

-- ELEKTRONİK (6 şarkı)
('Strobe', 'Elektronik', 639, '2009', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Deadmau5', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Levels', 'Elektronik', 342, '2011', 'https://open.spotify.com/track/1rfOFabJT42IMJP9N8b5qh', 'Avicii', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Animals', 'Elektronik', 342, '2013', 'https://open.spotify.com/track/65hdgOfz1IZ1dXIfanGs2h', 'Martin Garrix', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Faded', 'Elektronik', 212, '2015', 'https://open.spotify.com/track/7gHs73wELdeycvS48RfYPG', 'Alan Walker', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Clarity', 'Elektronik', 271, '2012', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Zedd ft. Foxes', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Wake Me Up', 'Elektronik', 247, '2013', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Avicii', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),

-- BLUES (6 şarkı)
('The Thrill Is Gone', 'Blues', 314, '1969', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'B.B. King', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Hoochie Coochie Man', 'Blues', 165, '1954', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Muddy Waters', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Red House', 'Blues', 198, '1967', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Jimi Hendrix', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Born Under a Bad Sign', 'Blues', 168, '1967', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Albert King', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Pride and Joy', 'Blues', 235, '1983', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Stevie Ray Vaughan', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Sweet Home Chicago', 'Blues', 180, '1936', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Robert Johnson', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),

-- COUNTRY (6 şarkı)
('Old Town Road', 'Country', 157, '2019', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Lil Nas X ft. Billy Ray Cyrus', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('The Bones', 'Country', 209, '2019', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Maren Morris', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Tennessee Whiskey', 'Country', 240, '2015', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Chris Stapleton', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Die a Happy Man', 'Country', 219, '2015', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Thomas Rhett', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Humble and Kind', 'Country', 264, '2016', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Tim McGraw', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Meant to Be', 'Country', 193, '2017', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Bebe Rexha ft. Florida Georgia Line', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),

-- REGGAE (6 şarkı)
('One Love', 'Reggae', 167, '1977', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Bob Marley & The Wailers', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('No Woman, No Cry', 'Reggae', 263, '1974', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Bob Marley & The Wailers', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Buffalo Soldier', 'Reggae', 261, '1983', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Bob Marley & The Wailers', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Three Little Birds', 'Reggae', 181, '1977', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Bob Marley & The Wailers', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Is This Love', 'Reggae', 234, '1978', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Bob Marley & The Wailers', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Jamming', 'Reggae', 193, '1977', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Bob Marley & The Wailers', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),

-- HIP HOP (6 şarkı)
('Gods Plan', 'Hip Hop', 198, '2018', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Drake', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Sicko Mode', 'Hip Hop', 312, '2018', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Travis Scott', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Old Town Road', 'Hip Hop', 157, '2019', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Lil Nas X', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Bad Guy', 'Hip Hop', 194, '2019', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Billie Eilish', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Blinding Lights', 'Hip Hop', 200, '2019', 'https://open.spotify.com/track/0VjIjW4GlUZAMYd2vXMi3b', 'The Weeknd', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Mood', 'Hip Hop', 140, '2020', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', '24kGoldn ft. Iann Dior', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),

-- WORLD (6 şarkı)
('Despacito', 'World', 229, '2017', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Luis Fonsi ft. Daddy Yankee', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Gangnam Style', 'World', 252, '2012', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'PSY', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Havana', 'World', 217, '2017', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Camila Cabello', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Shape of You', 'World', 233, '2017', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Ed Sheeran', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Mi Gente', 'World', 185, '2017', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'J Balvin, Willy William', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Con Calma', 'World', 193, '2019', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Daddy Yankee ft. Snow', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),

-- AMBIENT (6 şarkı)
('Claire de Lune', 'Ambient', 300, '1905', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Debussy', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Weightless', 'Ambient', 480, '2011', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Marconi Union', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Echoes', 'Ambient', 1383, '1971', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Pink Floyd', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('The Great Gig in the Sky', 'Ambient', 284, '1973', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Pink Floyd', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Shine On You Crazy Diamond', 'Ambient', 1380, '1975', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Pink Floyd', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center'),
('Comfortably Numb', 'Ambient', 382, '1979', 'https://open.spotify.com/track/3Cdpnq7NaJUyujB1WHmxhq', 'Pink Floyd', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=80&h=80&fit=crop&crop=center');
