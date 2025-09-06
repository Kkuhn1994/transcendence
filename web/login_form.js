document.addEventListener('DOMContentLoaded', function () {
    var form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            // Formulardaten abfragen
            var formData = new FormData(form);
            var username = formData.get('username');
            var password = formData.get('password');
            // Alte Callback-basierte Login-Logik
            submitLogin(username, password, (response));
        });
    }
});
function submitLogin(username, password) {
    // Erstelle die Daten für den POST-Request
    var data = {
        username: username,
        password: password
    };
    // Sende den POST-Request mit fetch
    fetch('/login.php', {
        method: 'POST', // HTTP-Methode
        headers: {
            'Content-Type': 'application/json', // Setze den Content-Type auf JSON
        },
        body: JSON.stringify(data) // Konvertiere die Daten in ein JSON-Format
    })
        .then(function (response) { return response.json(); }) // Antworte mit JSON
        .then(function (data) {
        // Verarbeite die Antwort
        if (data.success) {
            alert('Erfolgreich eingeloggt!');
        }
        else {
            alert('Login fehlgeschlagen!');
        }
        try { }
        catch () { }
        (function (error) {
            console.error('Fehler beim Senden der Anfrage:', error);
        });
    });
}
;
;
