  document.getElementById('signUpForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Verhindert das Standardverhalten des Formulars

   
const formData = new FormData();
formData.append('username', event.target.username.value);
formData.append('password', event.target.password.value);
alert('hello');
responseMessageElement.textContent = 'hallo';
fetch('/signUp/', {
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
    responseMessageElement.textContent = data.message;
    responseMessageElement.textContent = 'test';
})
.catch(error => {
    responseMessageElement.textContent = error;
});
  });