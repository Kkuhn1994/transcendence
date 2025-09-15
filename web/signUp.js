  document.getElementById('signUpForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Verhindert das Standardverhalten des Formulars

   
const formData = new FormData();
formData.append('username', event.target.username.value);
formData.append('password', event.target.password.value);
alert('signUp');
const responseMessageElement = document.getElementById('responseMessage');
responseMessageElement.textContent = 'hallo';
fetch('/signUp/', {
    method: 'POST',
    headers: {
    },
    body: formData
})
.then(response => response.text())
.then(html => {
    document.open();
    document.write(html);
    document.close();
})
.catch(error => {
    console.error('Fehler beim Senden der Anfrage:', error);
});
  });