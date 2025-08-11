<?php
header('Content-Type: text/html; charset=utf-8');

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'basit_sistem';

function h($s){return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');}

// Sayfa listelerinde hedeflediğimiz kitaplar (manifests)
$manifest = [
  'Kişisel Gelişim' => [
    'Rich Dad Poor Dad',
    'Think and Grow Rich',
    'The 7 Habits of Highly Effective People',
    'Deep Work',
    'Mindset',
    'Atomic Habits',
    'How to Win Friends and Influence People',
    'Zero to One',
    'Güç', // Robert Greene Power (Türkçe)
  ],
  'Kültür & Toplum' => [
    'Sapiens',
    'Homo Deus',
    'Culture and Society',
    'Culture and Imperialism',
    'The Social Contract',
    'Sociology',
    'Medeniyetler Çatışması',
  ],
  'Teknoloji' => [
    'The Innovators',
    'Hooked',
    'The Singularity is Near',
    'The Second Machine Age',
    'The Future of the Mind',
    'Dijital Dönüşüm',
    'Siber Güvenlik',
    'Teknoloji ve Toplum',
  ],
  'Sanat' => [
    'The Story of Art',
    'Ways of Seeing',
    'Art History',
    'The Art Book',
    'Modern Art',
    'Türk Sanatı Tarihi',
    'Osmanlı Sanatı',
    'Çağdaş Türk Sanatı',
    'İslam Sanatı',
    'Mimari ve Sanat',
  ],
  'Eğitim' => [
    'Pedagogy of the Oppressed',
    'The Art of Learning',
    'Mindset: The New Psychology of Success',
    'How Children Learn',
    'The Montessori Method',
    'Eğitim Psikolojisi',
    'Öğretim İlke ve Yöntemleri',
    'Eğitimde Program Geliştirme',
    'Öğrenme ve Öğretme',
    'Eğitim Yönetimi',
  ],
  'Yaşam Tarzı' => [
    'The Life-Changing Magic of Tidying Up',
    'Atomic Habits',
    'The Power of Now',
    'The 4-Hour Workweek',
    'Essentialism',
    'Minimalism',
    'Mindful Yaşam',
    'Dijital Detoks',
    'Sürdürülebilir Yaşam',
    'Sağlıklı Yaşam Rehberi',
  ],
  'Klasik Edebiyat' => [
    'War and Peace',
    'Les Misérables',
    'Crime and Punishment',
    'Anna Karenina',
  ],
  'Türk Edebiyatı' => [
    'Çalıkuşu',
    'Tutunamayanlar',
    'Kürk Mantolu Madonna',
  ],
];

try {
  $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ]);

  // Yardımcı sorgu
  $qExact = $pdo->prepare('SELECT COUNT(*) AS c FROM kitaplar WHERE kitap_adi = ?');
  $qLike  = $pdo->prepare('SELECT COUNT(*) AS c FROM kitaplar WHERE kitap_adi LIKE ?');

  $missing = [];
  $present = [];

  foreach ($manifest as $kategori => $books) {
    foreach ($books as $book) {
      // Önce tam eşleşme
      $qExact->execute([$book]);
      $c = (int)$qExact->fetch()['c'];

      if ($c === 0) {
        // Küçük farklılıklar için LIKE denemesi
        $qLike->execute(['%' . $book . '%']);
        $c2 = (int)$qLike->fetch()['c'];
        if ($c2 === 0) {
          $missing[$kategori][] = $book;
        } else {
          $present[$kategori][] = $book . ' (LIKE)';
        }
      } else {
        $present[$kategori][] = $book;
      }
    }
  }

  // Çıktı
  echo '<h1>Eksik Kitaplar Raporu</h1>';
  echo '<p>Bu rapor, sayfa listelerinde hedeflenen kitap adlarını veritabanındaki `kitaplar` tablosu ile karşılaştırır.</p>';

  // JSON mod isteğe bağlı
  if (isset($_GET['json'])) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['missing' => $missing, 'present' => $present], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
  }

  echo '<h2>❌ Eksik Olanlar</h2>';
  if (empty($missing)) {
    echo '<p>Hepsi mevcut görünüyor. ✅</p>';
  } else {
    foreach ($missing as $kategori => $items) {
      echo '<h3>' . h($kategori) . '</h3><ul>';
      foreach ($items as $it) {
        echo '<li>' . h($it) . '</li>';
      }
      echo '</ul>';
    }
  }

  echo '<h2>✅ Veritabanında Bulunanlar</h2>';
  foreach ($present as $kategori => $items) {
    echo '<details><summary>' . h($kategori) . ' (' . count($items) . ')</summary><ul>';
    foreach ($items as $it) {
      echo '<li>' . h($it) . '</li>';
    }
    echo '</ul></details>';
  }

  echo '<hr><p>İpucu: JSON çıktı için `?json=1` ekleyin.</p>';

} catch (PDOException $e) {
  http_response_code(500);
  echo 'Hata: ' . h($e->getMessage());
}
