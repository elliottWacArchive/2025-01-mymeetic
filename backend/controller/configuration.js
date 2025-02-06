function checkPP(event) {
    event.preventDefault();
    const profilePicture = document.getElementById('profilePicture');
    const file = profilePicture.files[0];
    const outputMessage = document.getElementById('outputMessage');
    if (file && file.type.startsWith('image/')) {
        const formData = new FormData();
        formData.append('profilePicture', file);

        fetch('backend/functions/uploadProfilePicture.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            outputMessage.innerHTML = data["echo"];
            if (data["return"]) {
                outputMessage.innerHTML += "<div onclick='next()' id='next'>Suivant -></div>";
                setCookie('pp', getCookie('id') + '.jpg');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            outputMessage.innerHTML = "Une erreur à eut lieu lors de l'envoi du fichier!";
        });
    } else {
        outputMessage.innerHTML = "Aucune image sélectionnée!";
    }
}

function next() {
    const zone = document.getElementById("configuration-container")
    zone.innerHTML = "<div id='configuration-container'><h1>Terminez la configuration de votre compte! 2/2</h1>";
    fetch('/frontend/widget/hobbies.php')
    .then(response => response.text())
    .then(data => {
        var script = document.createElement("script");
        // var script2 = document.createElement("script");
        script.src = "backend/controller/hobbies.js";
        // script2.src = "backend/controller/configuration.js";
        document.body.appendChild(script);
        zone.innerHTML += data;
    })
    .catch(error => console.error('Error fetching the login form:', error));
    zone.innerHTML += "</div>";
}
