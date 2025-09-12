<?php

$password = $_POST['password'];
$username = $_POST['username'];
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

try {
    // // Datenbankdatei im Docker-Volume (wird von beiden Containern verwendet)
    $db = new PDO('sqlite:/app/data/database.db'); // Ändere den Pfad nach Bedarf
    $stmt = $db->prepare("INSERT INTO users (name, password) VALUES (?, ?)");
    $stmt->execute([$username, $hashedPassword]);
    echo json_encode(['message' => 'Benutzer erfolgreich gespeichert!']);
} catch (PDOException $e) {
    // Fehlerbehandlung, falls die Verbindung oder Abfrage fehlschlägt
    echo json_encode(['message' => 'Fehler: ' . $e->getMessage()]);
}
?>