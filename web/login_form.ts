document.getElementById('loginForm').addEventListener('submit', function(event)) {
  event.preventDefault();
  

    const data = {
      username: event.target.username.value,
      password: event.target.password.value,
    };

    submitLogin(data.username, data.password);
};

function submitLogin(username: string, password: string): void {
  // Erstelle die Daten für den POST-Request
  // const data = {
  //   username: username,
  //   password: password
  // };

  // // Sende den POST-Request mit fetch
  // fetch('/login.php', {
  //   method: 'POST', // HTTP-Methode
  //   headers: {
  //     'Content-Type': 'application/json', // Setze den Content-Type auf JSON
  //   },
  //   body: JSON.stringify(data) // Konvertiere die Daten in ein JSON-Format
  // })
  //   .then((response) => response.text) // Antworte mit JSON
  //   .then(text => console.log('Raw response:', text));
};

