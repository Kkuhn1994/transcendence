<?php

$data = json_decode(file_get_contents("php://input"), true);
$username = $data['username'];
$password = $data['password'];
$data = $username . "\n" . $password;

try {
    // // Datenbankdatei im Docker-Volume (wird von beiden Containern verwendet)
    $db = new PDO('sqlite:/app/data/database.db'); // Ändere den Pfad nach Bedarf
    
    // Bereite die SQL-Abfrage vor, um den Benutzer zu speichern
    $stmt = $db->prepare("INSERT INTO users (name) VALUES (:username)");
    
    // Binde die Parameter
    $stmt->bindParam(':username', $username);
    // $stmt->bindParam(':password', $password);
    
    // Führe die Abfrage aus
    $stmt->execute();
    
    // Gib eine Erfolgsmeldung zurück
    echo json_encode(['message' => 'Benutzer erfolgreich gespeichert!']);
} catch (PDOException $e) {
    // Fehlerbehandlung, falls die Verbindung oder Abfrage fehlschlägt
    echo json_encode(['message' => 'Fehler: ' . $e->getMessage()]);
}
// echo json_encode(['message' => $data]);
// }
