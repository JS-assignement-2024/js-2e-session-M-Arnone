function handleLogout() {
    localStorage.clear();
    window.location.href = '../index.html'; 
}

document.addEventListener('DOMContentLoaded', function() {
    const logoutButton = document.getElementById('logoutButton');
    if (logoutButton) {
        logoutButton.addEventListener('click', handleLogout);
    }
});