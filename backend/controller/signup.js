function signup(mail, username, password, firstname, lastname, birthdate, city, gender) {
	console.log('signup');
    const age = getAge(birthdate);
	fetch(`backend/functions/phpCaller.php?function=addUser&username=${username}&firstname=${firstname}&lastname=${lastname}&mail=${mail}&password=${password}&birthdate=${birthdate}&age=${age}&city=${city}&gender=${gender}`)
	.then(response => response.json())
	.then(data => {
		console.log(data);
		if (data.result) { // A OPTIMISER
			alert('Signup success');
		} else {
			alert('Signup failed');
		}
	})
	.catch(error => console.error('Error:', error));
}

async function submitValidation(event) { // A OPTIMISER
	event.preventDefault();
	const mail = document.getElementById('mail');
	const username = document.getElementById('username');
	const password = document.getElementById('password');
	const firstname = document.getElementById('firstname');
	const lastname = document.getElementById('lastname');
	const birthdate = document.getElementById('birthdate');
	const city = document.getElementById('city');
	const gender = document.getElementById('gender');
    const errorMessage = document.getElementById('errorMessage');
	const data = [mail, username, password, firstname, lastname, birthdate, city, gender];
	let error = [];
    data.forEach(element => {
		element.style.border = '';
	});
	if (firstname.value.length < 1) {
		firstname.style.border = 'solid 2px red';
        error.push('Le prénom est vide');
	} if (username.value.length < 1 || await usernameExist(username.value)) {
		username.style.border = 'solid 2px red';
        error.push('Le nom d\'utilisateur est vide ou déjà utilisé');
	} if (lastname.value.length < 1) {
		lastname.style.border = 'solid 2px red';
        error.push('Le nom est vide');
	} if (mail.value === '' || !mail.value.includes('@') || !mail.value.includes('.') || await mailExist(mail.value)) {
		mail.style.border = 'solid 2px red';
        error.push('L\'adresse mail est vide, incorrecte ou déjà utilisée');
	} if (password.value.length < 1) {
		password.style.border = 'solid 2px red';
        error.push('Le mot de passe est vide');
	} if (birthdate.value === '') {
		birthdate.style.border = 'solid 2px red';
        error.push('La date de naissance est vide');
	} if (getAge(birthdate.value) < 18) {
        birthdate.style.border = 'solid 2px red';
        error.push('Vous devez avoir plus de 18 ans');
    }
    if (city.value.length < 1) {
		city.style.border = 'solid 2px red';
        error.push('La ville est vide');
	}
    if (error.length == 0) {
		signup(mail.value, username.value, password.value, firstname.value, lastname.value, birthdate.value, city.value, gender.value);
	} else if (error.length == 1) {
        errorMessage.innerHTML = error[0];
    } else if (error.length > 1) {
        errorMessage.innerHTML = 'Les champs en rouges sont incorrects';
    }
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

async function usernameExist(username) { // pas encore utilisé
    try {
        const response = await fetch(`backend/functions/phpCaller.php?function=usernameExist&username=${username}`);
        const data = await response.json();
        return data.result;
    } catch (error) {
        console.error('Error:', error);
        return false;
    }
}

function getAge(date) {
    const today = new Date();
    const date = new Date(date);
    let age = today.getFullYear() - date.getFullYear();
    const monthDifference = today.getMonth() - date.getMonth();
    if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < date.getDate())) {
        age--;
    }
}