<?php
// Gib die gesamten Request-Daten aus
echo "<h2>Empfangene Request-Daten</h2>";

echo "<pre>";
// Zeige alle Daten, die in $_REQUEST enthalten sind
print_r($_REQUEST); // $_REQUEST enthält sowohl GET, POST als auch COOKIE Daten
echo "</pre>";

// Wenn du speziell GET oder POST sehen möchtest:
echo "<h3>GET-Daten:</h3>";
echo "<pre>";
print_r($_GET);
echo "</pre>";

echo "<h3>POST-Daten:</h3>";
echo "<pre>";
print_r($_POST);
echo "</pre>";

echo "<h3>Cookie-Daten:</h3>";
echo "<pre>";
print_r($_COOKIE);
echo "</pre>";

// Weitere nützliche Informationen
echo "<h3>Server-Daten:</h3>";
echo "<pre>";
print_r($_SERVER); // Zeigt Informationen über den Server und den Request (z.B. HTTP-Header)
echo "</pre>";
?>
