    // Login-Formular Event-Listener
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('loginForm') as HTMLFormElement;

    form.addEventListener('submit', async (event: Event) => {
        event.preventDefault();  // Verhindert das Standard-Formular-Submit

        const formData = new FormData(form);  // Holt die Formulardaten

        try {
            const response = await fetch('/login.php', {
                method: 'POST',          // POST-Methode
                body: formData           // Formulardaten
            });

            if (!response.ok) {
                throw new Error('Fehler bei der Anfrage');
            }

            const result = await response.text();  // Antwort als Text
            document.getElementById('response')!.innerHTML = result;  // Antwort im div anzeigen
        } catch (error) {
            console.error('Fehler bei der Anfrage:', error);
        }
    });
});