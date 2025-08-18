<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

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

    function sendMail($mailAddres, $konu ,$icerik){
        // E-posta adresinden saat dilimini belirle
        $countryCode = getCountryFromEmail($mailAddres);
        $timezone = getTimezoneByCountry($countryCode);
        $formattedDate = getFormattedDate($timezone);
        $timezoneDescription = getTimezoneDescription($timezone);
        
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'stajteknoprosis@gmail.com';                     //SMTP username
            $mail->Password   = 'keey ejmo fsvd mrii';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            
            // Türkçe karakter ayarları
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';
            
            //Recipients
            $mail->setFrom('stajteknoprosis@gmail.com', 'GLOW Sistem');
            $mail->addAddress($mailAddres);     //Add a recipient
            $mail->addReplyTo('stajteknoprosis@gmail.com', 'GLOW Destek');

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $konu;
            
            // E-posta içeriğine saat dilimi bilgisini ekle
            $enhancedContent = "
            <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f9f9f9;'>
                <div style='background-color: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);'>
                    $icerik
                    
                    <div style='margin-top: 20px; padding: 15px; background-color: #f8f9fa; border-radius: 5px; border-left: 4px solid #7c5c4a;'>
                        <p style='margin: 0; color: #666; font-size: 14px;'>
                            <strong>Gönderim Tarihi:</strong> $formattedDate<br>
                            <strong>Saat Dilimi:</strong> $timezoneDescription
                        </p>
                    </div>
                </div>
            </div>";
            
            $mail->Body = $enhancedContent;
            $mail->AltBody = strip_tags($icerik) . "\n\nGönderim Tarihi: $formattedDate\nSaat Dilimi: $timezoneDescription";

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
?>