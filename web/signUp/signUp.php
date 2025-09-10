<?php

$data = json_decode(file_get_contents("php://input"), true);
$username = $data['username'];
$password = $data['password'];
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

try {
    // // Datenbankdatei im Docker-Volume (wird von beiden Containern verwendet)
    $db = new PDO('sqlite:/app/data/database.db'); // Ändere den Pfad nach Bedarf
    
    // Bereite die SQL-Abfrage vor, um den Benutzer zu speichern
    $stmt = $db->prepare("INSERT INTO users (name, password) VALUES (:username, :password)");
    
    // Binde die Parameter
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashedPassword);
    
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
