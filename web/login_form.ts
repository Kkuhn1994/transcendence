document.addEventListener('DOMContentLoaded', () => {
  const form = document.querySelector('form');
  
  if (form) {
    form.addEventListener('submit', (event: Event) => {
      event.preventDefault();
      
      // Formulardaten abfragen
      const formData = new FormData(form);
      const username = formData.get('username') as string;
      const password = formData.get('password') as string;

      // Alte Callback-basierte Login-Logik
      submitLogin(username, password, (response));
    });
  }
});

function submitLogin(username: string, password: string): void {
  // Erstelle die Daten für den POST-Request
  const data = {
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
    .then((response) => response.json()) // Antworte mit JSON
    .then((data) => {
      // Verarbeite die Antwort
      if (data.success) {
        alert('Erfolgreich eingeloggt!');
      } else {
        alert('Login fehlgeschlagen!');
      }
    .catch((error) => {
      console.error('Fehler beim Senden der Anfrage:', error);
    });
};);

