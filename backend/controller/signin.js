function signin(mail, username, password, firstname, lastname, birthdate, city, gender) {
	console.log('signin');
	fetch(`backend/functions/signin.php?mail=${mail}&username=${username}&password=${password}&firstname=${firstname}&lastname=${lastname}&birthdate=${birthdate}&city=${city}&gender=${gender}`)
	.then(response => response.json())
	.then(data => {
		console.log(data);
		if (data.result) {
			alert('Signin success');
		} else {
			alert('Signin failed');
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
	const data = [mail, username, password, firstname, lastname, birthdate, city, gender];
	data.forEach(element => {
		element.style.border = '';
	});
	if (username.value.length < 1 || await usernameExist(username.value)) {
		username.style.border = 'solid 1px red';
		console.log('username error');
	} else if (firstname.value.length < 1) {
		firstname.style.border = 'solid 1px red';
		console.log('firstname error');
	} else if (lastname.value.length < 1) {
		lastname.style.border = 'solid 1px red';
		console.log('lastname error');
	} else if (mail.value === '' || !mail.value.includes('@') || !mail.value.includes('.') || await mailExist(mail.value)) {
		mail.style.border = 'solid 1px red';
		console.log('mail error');
	} else if (password.value.length < 1) {
		password.style.border = 'solid 1px red';
		console.log('password error');
	} else if (birthdate.value === '' || new Date(birthdate.value) >= new Date(new Date().setFullYear(new Date().getFullYear() - 18))) {
		birthdate.style.border = 'solid 1px red';
		console.log('birthdate error');
	} else if (city.value.length < 1) {
		city.style.border = 'solid 1px red';
		console.log('city error');
	} else {
		signin(mail.value, username.value, password.value, firstname.value, lastname.value, birthdate.value, city.value, gender.value);
	}
}

async function mailExist(mail) {
	try {
		const response = await fetch(`backend/functions/mailExist.php?mail=${mail}`);
		const data = await response.json();
		return data.result;
	} catch (error) {
		console.error('Error:', error);
		return false;
	}
}

async function usernameExist(username) { // pas encore utilisé
    try {
        const response = await fetch(`backend/functions/usernameExist.php?username=${username}`);
        const data = await response.json();
        return data.result;
    } catch (error) {
        console.error('Error:', error);
        return false;
    }
}