var form = document.getElementById("user");
    var nameInput = document.getElementById("name");
    var messageParagraph = document.getElementById("message");

    form.onsubmit = function(e) {
    e.preventDefault(); // Empêche l'envoi du formulaire par défaut

    // Validation côté client
    if (nameInput.value.trim() === "") {
        messageParagraph.textContent = "Vous devez remplir tous les champs !";
    } else {
        // Envoi des données au serveur via fetch
        fetch('http://localhost/code/_api/api.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                name: nameInput.value,
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur HTTP, statut ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            if (data.status === 'success') {
                    console.log(data);
                    localStorage.setItem('userName', data.user); 
                    window.location.href = './exercises.html';
                } else {
                    document.getElementById('message').textContent = data.message;
                }
        })
        .catch(error => {
            console.error('Erreur:', error);
            messageParagraph.textContent = "Une erreur s'est produite lors de l'envoi des données.";
        });
    }
};
