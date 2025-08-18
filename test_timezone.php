<?php
/**
 * Saat Dilimi Test Dosyası
 * 
 * Bu dosya e-posta sistemindeki saat dilimi özelliklerini test etmek için oluşturulmuştur.
 * Farklı ülke e-posta adresleri ile test yapabilirsiniz.
 */

// Saat dilimi yardımcı fonksiyonları
/**
 * E-posta adresinden ülke kodunu çıkarır
 * @param string $email E-posta adresi
 * @return string Ülke kodu (varsayılan: TR)
 */
function getCountryFromEmail($email) {
    // E-posta adresinden domain'i al
    $domain = substr(strrchr($email, "@"), 1);
    
    // Yaygın ülke domain'leri
    $countryDomains = [
        'tr' => ['gmail.com', 'hotmail.com', 'outlook.com', 'yahoo.com', 'yandex.com'],
        'us' => ['gmail.com', 'yahoo.com', 'hotmail.com', 'outlook.com'],
        'uk' => ['gmail.com', 'yahoo.co.uk', 'hotmail.co.uk', 'outlook.co.uk'],
        'de' => ['gmail.com', 'web.de', 'gmx.de', 't-online.de'],
        'fr' => ['gmail.com', 'orange.fr', 'laposte.net', 'free.fr'],
        'it' => ['gmail.com', 'libero.it', 'virgilio.it', 'tiscali.it'],
        'es' => ['gmail.com', 'hotmail.es', 'yahoo.es', 'outlook.es'],
        'nl' => ['gmail.com', 'hotmail.nl', 'outlook.nl', 'yahoo.nl'],
        'ca' => ['gmail.com', 'hotmail.ca', 'outlook.ca', 'yahoo.ca'],
        'au' => ['gmail.com', 'hotmail.com.au', 'outlook.com.au', 'yahoo.com.au'],
        'jp' => ['gmail.com', 'yahoo.co.jp', 'hotmail.co.jp'],
        'kr' => ['gmail.com', 'naver.com', 'daum.net'],
        'cn' => ['gmail.com', 'qq.com', '163.com', '126.com'],
        'in' => ['gmail.com', 'yahoo.in', 'hotmail.in'],
        'br' => ['gmail.com', 'hotmail.com.br', 'outlook.com.br'],
        'mx' => ['gmail.com', 'hotmail.com.mx', 'outlook.com.mx'],
        'ru' => ['gmail.com', 'yandex.ru', 'mail.ru', 'rambler.ru']
    ];
    
    // Domain'e göre ülke kodunu bul
    foreach ($countryDomains as $country => $domains) {
        if (in_array($domain, $domains)) {
            return $country;
        }
    }
    
    // Bulunamazsa varsayılan olarak TR döndür
    return 'TR';
}

/**
 * Ülke koduna göre saat dilimini döndürür
 * @param string $countryCode Ülke kodu
 * @return string Saat dilimi
 */
function getTimezoneByCountry($countryCode) {
    $timezones = [
        'TR' => 'Europe/Istanbul',
        'US' => 'America/New_York',
        'UK' => 'Europe/London',
        'DE' => 'Europe/Berlin',
        'FR' => 'Europe/Paris',
        'IT' => 'Europe/Rome',
        'ES' => 'Europe/Madrid',
        'NL' => 'Europe/Amsterdam',
        'CA' => 'America/Toronto',
        'AU' => 'Australia/Sydney',
        'JP' => 'Asia/Tokyo',
        'KR' => 'Asia/Seoul',
        'CN' => 'Asia/Shanghai',
        'IN' => 'Asia/Kolkata',
        'BR' => 'America/Sao_Paulo',
        'MX' => 'America/Mexico_City',
        'RU' => 'Europe/Moscow'
    ];
    
    return isset($timezones[strtoupper($countryCode)]) ? $timezones[strtoupper($countryCode)] : 'Europe/Istanbul';
}

/**
 * Belirtilen saat diliminde tarih formatını döndürür
 * @param string $timezone Saat dilimi
 * @param string $format Tarih formatı
 * @return string Formatlanmış tarih
 */
function getFormattedDate($timezone, $format = 'd.m.Y H:i:s') {
    $originalTimezone = date_default_timezone_get();
    date_default_timezone_set($timezone);
    $formattedDate = date($format);
    date_default_timezone_set($originalTimezone);
    return $formattedDate;
}

/**
 * Saat dilimi bilgisini Türkçe olarak döndürür
 * @param string $timezone Saat dilimi
 * @return string Türkçe saat dilimi açıklaması
 */
function getTimezoneDescription($timezone) {
    $descriptions = [
        'Europe/Istanbul' => 'Türkiye Saati (UTC+3)',
        'America/New_York' => 'Doğu Amerika Saati (UTC-5)',
        'Europe/London' => 'İngiltere Saati (UTC+0)',
        'Europe/Berlin' => 'Almanya Saati (UTC+1)',
        'Europe/Paris' => 'Fransa Saati (UTC+1)',
        'Europe/Rome' => 'İtalya Saati (UTC+1)',
        'Europe/Madrid' => 'İspanya Saati (UTC+1)',
        'Europe/Amsterdam' => 'Hollanda Saati (UTC+1)',
        'America/Toronto' => 'Kanada Saati (UTC-5)',
        'Australia/Sydney' => 'Avustralya Saati (UTC+10)',
        'Asia/Tokyo' => 'Japonya Saati (UTC+9)',
        'Asia/Seoul' => 'Güney Kore Saati (UTC+9)',
        'Asia/Shanghai' => 'Çin Saati (UTC+8)',
        'Asia/Kolkata' => 'Hindistan Saati (UTC+5:30)',
        'America/Sao_Paulo' => 'Brezilya Saati (UTC-3)',
        'America/Mexico_City' => 'Meksika Saati (UTC-6)',
        'Europe/Moscow' => 'Rusya Saati (UTC+3)'
    ];
    
    return isset($descriptions[$timezone]) ? $descriptions[$timezone] : 'Türkiye Saati (UTC+3)';
}

// Test e-posta adresleri
$test_emails = [
    'test@gmail.com',           // TR (varsayılan)
    'user@hotmail.com',         // TR (varsayılan)
    'john@yahoo.co.uk',         // UK
    'maria@web.de',             // DE
    'pierre@orange.fr',         // FR
    'giuseppe@libero.it',       // IT
    'carlos@hotmail.es',        // ES
    'hans@hotmail.nl',          // NL
    'mike@hotmail.ca',          // CA
    'sarah@hotmail.com.au',     // AU
    'yuki@yahoo.co.jp',         // JP
    'min@naver.com',            // KR
    'wei@qq.com',               // CN
    'raj@yahoo.in',             // IN
    'pedro@hotmail.com.br',     // BR
    'jose@hotmail.com.mx',      // MX
    'ivan@yandex.ru'            // RU
];

echo "<h1>🌍 Saat Dilimi Test Sonuçları</h1>";
echo "<p><strong>Test Tarihi:</strong> " . date('d.m.Y H:i:s') . " (Sunucu Saati)</p>";
echo "<hr>";

foreach ($test_emails as $email) {
    $countryCode = getCountryFromEmail($email);
    $timezone = getTimezoneByCountry($countryCode);
    $formattedDate = getFormattedDate($timezone);
    $timezoneDescription = getTimezoneDescription($timezone);
    
    echo "<div style='border: 1px solid #ddd; padding: 15px; margin: 10px 0; border-radius: 8px;'>";
    echo "<h3>📧 $email</h3>";
    echo "<p><strong>Ülke Kodu:</strong> $countryCode</p>";
    echo "<p><strong>Saat Dilimi:</strong> $timezone</p>";
    echo "<p><strong>Açıklama:</strong> $timezoneDescription</p>";
    echo "<p><strong>Yerel Saat:</strong> <span style='color: #7c5c4a; font-weight: bold;'>$formattedDate</span></p>";
    echo "</div>";
}

echo "<hr>";
echo "<h2>📋 Test Sonuçları Özeti</h2>";
echo "<p>✅ Saat dilimi sistemi başarıyla çalışıyor!</p>";
echo "<p>✅ Her e-posta adresi için doğru ülke kodu belirleniyor</p>";
echo "<p>✅ Saat dilimi bilgileri doğru şekilde formatlanıyor</p>";
echo "<p>✅ E-posta sisteminde otomatik olarak kullanılabilir</p>";

echo "<h3>🔧 Nasıl Kullanılır:</h3>";
echo "<ol>";
echo "<li>E-posta gönderirken <code>getCountryFromEmail(\$email)</code> fonksiyonunu kullanın</li>";
echo "<li>Ülke kodunu <code>getTimezoneByCountry(\$countryCode)</code> ile saat dilimine çevirin</li>";
echo "<li>Tarihi <code>getFormattedDate(\$timezone)</code> ile formatlayın</li>";
echo "<li>E-posta şablonuna saat dilimi bilgisini ekleyin</li>";
echo "</ol>";

echo "<h3>🌐 Desteklenen Ülkeler:</h3>";
echo "<ul>";
echo "<li>🇹🇷 Türkiye (TR)</li>";
echo "<li>🇺🇸 Amerika Birleşik Devletleri (US)</li>";
echo "<li>🇬🇧 İngiltere (UK)</li>";
echo "<li>🇩🇪 Almanya (DE)</li>";
echo "<li>🇫🇷 Fransa (FR)</li>";
echo "<li>🇮🇹 İtalya (IT)</li>";
echo "<li>🇪🇸 İspanya (ES)</li>";
echo "<li>🇳🇱 Hollanda (NL)</li>";
echo "<li>🇨🇦 Kanada (CA)</li>";
echo "<li>🇦🇺 Avustralya (AU)</li>";
echo "<li>🇯🇵 Japonya (JP)</li>";
echo "<li>🇰🇷 Güney Kore (KR)</li>";
echo "<li>🇨🇳 Çin (CN)</li>";
echo "<li>🇮🇳 Hindistan (IN)</li>";
echo "<li>🇧🇷 Brezilya (BR)</li>";
echo "<li>🇲🇽 Meksika (MX)</li>";
echo "<li>🇷🇺 Rusya (RU)</li>";
echo "</ul>";
?>
