<!-- <?php
if(isset($_REQUEST['id']))
{
    $res = $db->query("SELECT name FROM users WHERE id = ". $_REQUEST['id'])->fetch(PDO::FETCH_ASSOC); 
    echo "Willkommen ". $res['name'] ." <a href='/delete'>(Account löschen)</a>";
}
else
{
    echo "Willkommen Gast";
}
?> -->
