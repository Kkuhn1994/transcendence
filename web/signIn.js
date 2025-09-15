  document.getElementById('signInForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Verhindert das Standardverhalten des Formulars

const formData = new FormData();
formData.append('username', event.target.username.value);
formData.append('password', event.target.password.value);

fetch('/signIn/', {
    method: 'POST',
    headers: {
    },
    body: formData
})
.then(response => response.json())
.then(data => {
    // Find the element to display the response
    const responseMessageElement = document.getElementById('responseMessage');
    responseMessageElement.style.color = 'green';
    responseMessageElement.textContent = data.username + data.cookie;
    document.cookie = 'usercookie=' + data.cookie;
})
.catch(error => {
    console.error('Fehler beim Senden der Anfrage:', error);
});
alert(1);
window.location.href = '/?state=loggedIn&name=' + encodeURIComponent(event.target.username.value);
alert(2);
  });