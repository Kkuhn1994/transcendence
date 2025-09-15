<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .input-field {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .login-button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }
        .login-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

        <ul>
            <li><a href="#signUp">Registrieren</a></li>
            <li><a href="#signIn">Registrieren</a></li>
        </ul>
        <?php
            if($_POST['state'] == 'signUp')
            {
             echo <<<HTML
                <div class="login-container">
                    <h2>Registrieren</h2>
                    <form id="signUpForm">
                        <input type="text" class="input-field" name="username" placeholder="Benutzername" required>
                        <input type="password" class="input-field" name="password" placeholder="Passwort" required>
                        <button type="submit" class="login-button">Registrieren</button>
                    </form>
                </div>
                <p id='responseMessage'></p>  
                HTML;
            }
            else if($_POST['state'] == 'loggedIn')
            {
                $cookie = $_COOKIE['usercookie'];
                $name = $_POST['name'];
                $db = new PDO('sqlite:/app/data/database.db'); // Ändere den Pfad nach Bedarf
                // // Bereite die SQL-Abfrage vor, um den Benutzer zu speichern
                $stmt = $db->prepare("SELECT cookie FROM users WHERE name = ?;");
                $stmt->execute([$name]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $safed_cookie = $result['cookie'];
                if($cookie == $safed_cookie)
                {
                    echo <<<HTML
                        <div class="loggedIn">
                        <h2>Welcome $name</h2>
                        </div>
                    HTML;   
                }
                else
                {
                    echo <<<HTML
                        <div class="malicious">
                        <h2>malicious behaviour suspected</h2>
                        </div>
                    HTML;   
                }
            }
            else
            {
                echo <<<HTML
                    <div class="login-container">
                    <h2>Login</h2>
                    <form id = "signInForm">
                        <input type="text" class="input-field" name="username" placeholder="Benutzername" required>
                        <input type="password" class="input-field" name="password" placeholder="Passwort" required>
                        <button type="submit" class="login-button">Einloggen</button>
                    </form>
                    </div>
                    <p id='responseMessage'></p>  
                HTML;
                 
            }
        ?>
</body>
<script src="signUp.js"></script>
<script src="signIn.js"></script>
<script src="routing.js"></script>
</html>
