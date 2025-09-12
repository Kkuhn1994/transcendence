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
        ob_start();
        var_dump($result);
        $output = ob_get_clean(); // Den Puffer in eine Variable bekommen und gleichzeitig leeren
        // Den Inhalt mit echo ausgeben 
        echo json_encode(['message' => $output]);
    }
    else{
           echo json_encode(['message' =>  'r']);
    }
} catch (PDOException $e) {
    // Fehlerbehandlung, falls die Verbindung oder Abfrage fehlschlägt
    echo json_encode(['message' => 'Fehler: ' . $e->getMessage()]);
}
?>