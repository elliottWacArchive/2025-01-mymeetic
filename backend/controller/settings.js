async function changeUsername(event) {
    event.preventDefault();
    const username = event.target.username.value;
    if (username.length < 1 || await usernameExist(username)) {
        event.target.username.style.border = 'solid 2px red';
    } else {
        fetch(`backend/functions/phpCaller.php?function=setUser`, {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                token: getCookie('token'),
                param: 'username',
                value: username,
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.result) {
                setCookie('username', username);
                event.target.username.style.border = 'solid 2px var(--m-d-green)';
            } else {
                event.target.username.style.border = 'solid 2px red';
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
}

async function changePassword(event) {
    event.preventDefault();
    const password = event.target.password.value;
    if (password.length < 1) {
        event.target.password.style.border = 'solid 2px red';
    } else {
        fetch(`backend/functions/phpCaller.php?function=setPassword`, {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                token: getCookie('token'),
                value: password,
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.result) {
                event.target.password.style.border = 'solid 2px var(--m-d-green)';
            } else {
                event.target.password.style.border = 'solid 2px red';
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
}

async function changeMail(event) {
    event.preventDefault();
    const mail = event.target.email.value;
    if (mail.length < 1 || await mailExist(mail)) {
        event.target.email.style.border = 'solid 2px red';
    } else {
        fetch(`backend/functions/phpCaller.php?function=setUser`, {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                token: getCookie('token'),
                param: 'mail',
                value: mail,
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.result) {
                setCookie('mail', mail);
                event.target.email.style.border = 'solid 2px var(--m-d-green)';
            } else {
                event.target.email.style.border = 'solid 2px red';
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
}

function changePP(event) {
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

function deleteAccount(event) {
    event.preventDefault();
    if (!confirm('Voulez-vous vraiment supprimer votre compte?')) {
        return;
    }
    fetch(`backend/functions/phpCaller.php?function=deleteAccount`, {
        method: 'POST',
        headers: {
        'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            token: getCookie('token'),
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.result) {
            deleteAllCookies();
            window.location.href = '/';
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}



async function mailExist(mail) {
	try {
		const response = await fetch(`backend/functions/phpCaller.php?function=mailExist&mail=${mail}`);
		const data = await response.json();
		return data.result;
	} catch (error) {
		console.error('Error:', error);
		return false;
	}
}

async function usernameExist(username) {
    try {
        const response = await fetch(`backend/functions/phpCaller.php?function=usernameExist&username=${username}`);
        const data = await response.json();
        return data.result;
    } catch (error) {
        console.error('Error:', error);
        return false;
    }
}
