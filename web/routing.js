// JavaScript zur Navigation
document.getElementById('signUpLink').addEventListener('click', function(e) {
    e.preventDefault(); // Verhindert das Neuladen der Seite
    showSection('signUp');
});


// Funktion, um nur den gewünschten Abschnitt anzuzeigen
function showSection(sectionId) {
    const sections = document.querySelectorAll('section');
    sections.forEach(function(section) {
        section.style.display = 'none'; // Alle Abschnitte ausblenden
    });
    document.getElementById(sectionId).style.display = 'block'; // Den gewünschten Abschnitt anzeigen
}

// Standardmäßig die Home-Seite anzeigen
showSection('signUp');