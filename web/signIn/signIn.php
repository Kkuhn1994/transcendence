<?php

// Funktion zum Dekodieren von Base32
function base32_decode($base32) {
    $base32chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
    $base32 = strtoupper(preg_replace('/[^A-Z2-7]/', '', $base32));
    $bits = '';
    foreach (str_split($base32) as $char) {
        $value = strpos($base32chars, $char);
        $bits .= str_pad(decbin($value), 5, '0', STR_PAD_LEFT);
    }
    $bytes = [];
    for ($i = 0; $i < strlen($bits); $i += 8) {
        $chunk = substr($bits, $i, 8);
        if (strlen($chunk) == 8) {
            $bytes[] = chr(bindec($chunk));
        }
    }
    return implode('', $bytes);
}

// Funktion zur Generierung des TOTP-Codes
function generate_totp($secret, $time = null, $digits = 6, $period = 30) {
    if ($time === null) {
        $time = time();
    }
    // Zeit-Counter: floor(current_timestamp / period)
    $time_counter = floor($time / $period);
    // Konvertiere Counter in 8-Byte-Binärstring
    $time_bytes = pack('N*', 0) . pack('N*', $time_counter);
    // Dekodiere Base32-Secret
    $key = base32_decode($secret);
    // Berechne HMAC-SHA1
    $hmac = hash_hmac('sha1', $time_bytes, $key, true);
    // Dynamischen Offset berechnen
    $offset = ord(substr($hmac, -1)) & 0x0F;
    // Extrahiere 4 Bytes ab Offset
    $hashpart = substr($hmac, $offset, 4);
    // Konvertiere in Integer
    $value = unpack('N', $hashpart)[1];
    // Maskiere oberstes Bit
    $value = $value & 0x7FFFFFFF;
    // Generiere 6-stelligen Code
    $code = $value % (10 ** $digits);
    return str_pad($code, $digits, '0', STR_PAD_LEFT);
}

// Funktion zur Verifizierung des TOTP-Codes
function verify_totp($secret, $code, $window = 2, $period = 30) {
    $current_time = time();
    // Prüfe innerhalb des Zeitfensters (±window * period Sekunden)
    for ($i = -$window; $i <= $window; $i++) {
        $check_time = $current_time + ($i * $period);
        $generated_code = generate_totp($secret, $check_time);
        if ($generated_code === $code) {
            return true;
        }
    }
    return false;
}

$password = $_POST['password'];
$username = $_POST['username'];
$totp = $_POST['otp'];

try {
    // // Datenbankdatei im Docker-Volume (wird von beiden Containern verwendet)
    $db = new PDO('sqlite:/app/data/database.db'); // Ändere den Pfad nach Bedarf
    // Bereite die SQL-Abfrage vor, um den Benutzer zu speichern
    $stmt = $db->prepare("SELECT * FROM users WHERE name = ?;");
    $stmt->execute([$username]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $passwd = $result['password'];
    $secret = $result['secret'];
    if(password_verify($password, $passwd) && verify_totp($secret, $totp, 2))
    {
        // Den Inhalt mit echo ausgeben
        $cookie = uniqid('cookie_', true);
        $stmt2 = $db->prepare("UPDATE users SET cookie = ? WHERE name = ?;");
        $stmt2->execute([$cookie, $username]);
        echo json_encode(['username' => $username, 'cookie' => $cookie]);
    }
    else{
        echo json_encode(['username' =>  'r', 'cookie' => 'ferger']);
    }
} catch (PDOException $e) {
    // Fehlerbehandlung, falls die Verbindung oder Abfrage fehlschlägt
    echo json_encode(['username' => 'Fehler: ' . $e->getMessage(), 'cookie' => '']);
}
?>