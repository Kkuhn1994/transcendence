<?php

$data = json_decode(file_get_contents("php://input"), true);
$username = $data['username'];
$password = $data['password'];
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

try {
    //   echo json_encode(['message' => 'test']);
    // // Datenbankdatei im Docker-Volume (wird von beiden Containern verwendet)
    $db = new PDO('sqlite:/app/data/database.db'); // Ändere den Pfad nach Bedarf
    // Bereite die SQL-Abfrage vor, um den Benutzer zu speichern
    $stmt = $db->prepare("SELECT name,password FROM users WHERE name = :username");
// //    echo json_encode(['message' => 'test']);
//     // Binde die Parameter
    $stmt->bindParam(':username', $username);
//     // $stmt->bindParam(':hashedPassword', $hashedPassword);
    
//     // Führe die Abfrage aus
    $stmt->execute();


    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $hash = $result['name'];
     $passwd = $result['password'];
    // $authenticated = password_verify($password, $hash);
//     // echo json_encode(['message' => $result['name']]);
    if(password_verify($password, $hash))
    {        
    //        ob_start();
    // var_dump($result);
    // $output = ob_get_clean(); // Den Puffer in eine Variable bekommen und gleichzeitig leeren
    
    // Den Inhalt mit echo ausgeben
        // echo json_encode(['message' => "dwhddwefwe"]);
        // $password = var_dump($result);
        echo json_encode(['message' => $debugQuery]);
    }
    // else{
           echo json_encode(['message' =>  'r'.$hash.' '.$passwd]);
    // }

} catch (PDOException $e) {
    // Fehlerbehandlung, falls die Verbindung oder Abfrage fehlschlägt
    echo json_encode(['message' => 'Fehler: ' . $e->getMessage()]);
}