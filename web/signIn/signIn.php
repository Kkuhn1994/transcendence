<?php

$data = json_decode(file_get_contents("php://input"), true);
$username = $data['username'];
$password = $data['password'];
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

try {
    // // Datenbankdatei im Docker-Volume (wird von beiden Containern verwendet)
    $db = new PDO('sqlite:/app/data/database.db'); // Ändere den Pfad nach Bedarf
    // Bereite die SQL-Abfrage vor, um den Benutzer zu speichern
    $stmt = $db->prepare("SELECT password FROM users WHERE name=:username");
    
    // Binde die Parameter
    $stmt->bindParam(':username', $username);
    
    // Führe die Abfrage aus
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($result)
    {
        echo json_encode(['message' => $result]);
    }
    // Gib eine Erfolgsmeldung zurück
    echo json_encode(['message' => 'Benutzer erfolgreich gespeichert!']);
} catch (PDOException $e) {
    // Fehlerbehandlung, falls die Verbindung oder Abfrage fehlschlägt
    echo json_encode(['message' => 'Fehler: ' . $e->getMessage()]);
}