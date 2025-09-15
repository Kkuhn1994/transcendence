<?php

$password = $_POST['password'];
$username = $_POST['username'];
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

try {
    // // Datenbankdatei im Docker-Volume (wird von beiden Containern verwendet)
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567'; // RFC 4648 base32
    $secret = '';
    $issuer = 'MyPong';
    for ($i = 0; $i < 16; $i++) {
        $secret .= $chars[random_int(0, strlen($chars) - 1)];
    }
    $account = 'benutzer@example.com';
    $label = urlencode("$issuer:$account");
    $otpAuthUrl = "otpauth://totp/{$label}?secret={$secret}&issuer=" . urlencode($issuer);
    $qrImageUrl = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=" . urlencode($otpAuthUrl);
    $db = new PDO('sqlite:/app/data/database.db'); // Ändere den Pfad nach Bedarf
    $stmt = $db->prepare("INSERT INTO users (name, password, secret) VALUES (?, ? ,?)");
    $stmt->execute([$username, $hashedPassword, $secret]);
    echo <<<HTML
    <div class="otp-container">
        <h2>Scanne den QR-Code mit FreeOTP oder Google Authenticator:</h2>
        <img src='$qrImageUrl' />
        <p>Oder gib den Secret manuell ein: <strong>$secret</strong></p>
    </div>
    <p id='responseMessage'></p>  
    HTML;
} catch (PDOException $e) {
    // Fehlerbehandlung, falls die Verbindung oder Abfrage fehlschlägt
    echo json_encode(['message' => 'Fehler: ' . $e->getMessage()]);
}
?>