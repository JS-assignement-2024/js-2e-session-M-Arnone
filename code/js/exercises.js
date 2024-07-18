document.addEventListener('DOMContentLoaded', function() {
    const userName = localStorage.getItem('userName');
    const userWelcome = document.getElementById('user-welcome');
    userWelcome.textContent = `Bienvenue, ${userName}!`;
});
