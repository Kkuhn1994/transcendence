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
// window.location.href = '/?state=loggedIn&name=' + encodeURIComponent(event.target.username.value);
// alert(2);
const formData2 = new FormData();
formData2.append('name', event.target.username.value);
formData2.append('state', 'loggedIn');

fetch('/', {
    method: 'POST',
    headers: {
    },
    body: formData2
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