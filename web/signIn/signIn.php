<?php

$password = $_POST['password'];
$username = $_POST['username'];

try {
    // // Datenbankdatei im Docker-Volume (wird von beiden Containern verwendet)
    $db = new PDO('sqlite:/app/data/database.db'); // Ändere den Pfad nach Bedarf
    // Bereite die SQL-Abfrage vor, um den Benutzer zu speichern
    $stmt = $db->prepare("SELECT name, password FROM users WHERE name = ?;");
    $stmt->execute([$username]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $passwd = $result['password'];
    if(password_verify($password, $passwd))
    {       
        // Den Inhalt mit echo ausgeben
        $cookie = 'test';
        $stmt2 = $db->prepare("UPDATE users SET cookie = ? WHERE name = ?;");
        $stmt2->execute([$cookie, $username]);
        echo json_encode(['username' => $username, 'cookie' => $cookie]);
    }
    else{
        echo json_encode(['username' =>  'r', 'cookie' => '']);
    }
} catch (PDOException $e) {
    // Fehlerbehandlung, falls die Verbindung oder Abfrage fehlschlägt
    echo json_encode(['username' => 'Fehler: ' . $e->getMessage(), 'cookie' => '']);
}
?>