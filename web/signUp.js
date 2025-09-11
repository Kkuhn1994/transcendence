  document.getElementById('signUpForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Verhindert das Standardverhalten des Formulars

    const data = {
      username: event.target.username.value,
      password: event.target.password.value,
    };
    alert('123');
    fetch('/signUp/', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(data),
    })
    .then(response => response.json())
        .then(data => {
            // Finde das Element, in dem die Antwort angezeigt werden soll
            const responseMessageElement = document.getElementById('responseMessage');
                responseMessageElement.style.color = 'green';
                responseMessageElement.textContent = data.query;
                responseMessageElement.textContent += data.message;

        })
    .catch(error => {
      console.error('Fehler beim Senden der Anfrage:', error);
    });
  });