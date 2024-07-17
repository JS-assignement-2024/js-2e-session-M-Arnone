<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form id="user" method="POST">
        <label for="name">Ton prénom : </label>
        <input type ="text" id="name" name="name" required/> 
        <button type="submit">Start</button>
    </form>

    <p id="message"></p>

<script>
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
            // Affichage de la réponse du serveur
            console.log(data); // Vérifiez la réponse du serveur
            messageParagraph.textContent = data.message;
        })
        .catch(error => {
            console.error('Erreur:', error);
            messageParagraph.textContent = "Une erreur s'est produite lors de l'envoi des données.";
        });
    }
};

</script>
</body>
</html>