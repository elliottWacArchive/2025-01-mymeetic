document.addEventListener('DOMContentLoaded', function() {
	const btn = document.getElementById('mikuBtn');
	const img = document.getElementById('mikuImg');
	btn.addEventListener('mouseover', function() {
		img.style.transform = 'translateY(-160px)'
	});
	btn.addEventListener('mouseout', function() {
		img.style.transform = ''
	});
	btn.addEventListener('click', function() {
		img.style.transform = '';
	});
	btn.addEventListener('mouseup', function() {
		btn.style.transform = "";
        if (document.cookie.split(';').some((item) => item.trim().startsWith('token='))) {
            console.log('Token cookie is set');
            const token = document.cookie.split(';').find(item => item.trim().startsWith('token=')).split('=')[1];
            getFromSql(token, 'username');
            getFromSql(token, 'firstname');
            getFromSql(token, 'lastname');
            getFromSql(token, 'mail');
            getFromSql(token, 'city');
            getFromSql(token, 'gender');
            window.location.href = '/home';
        } else {
            console.log('Token cookie is not set');
            fetch('/frontend/widget/loginForm.php')
                .then(response => response.text())
                .then(data => {
                    document.body.innerHTML = data;
                })
                .catch(error => console.error('Error fetching the login form:', error));
        }
	});
	btn.addEventListener('mousedown', function() {
		console.log('Miku clicked!');
		img.style.transform = '';
		btn.style.transform = "translate(5px, 5px)";
	});
});

async function checkPassword(event) {
    console.log('checkPassword');
	event.preventDefault();
    const mail = document.getElementById('mail');
    const password = document.getElementById('password');

    if (mail.value === '' || !mail.value.includes('@') || !mail.value.includes('.')) {
        mail.style.border = 'solid 1px red';
        console.log('mail error');
    } else if (password.value.length < 1) {
        password.style.border = 'solid 1px red';
        console.log('password error');
    } else {
        const response = await fetch(`backend/functions/checkPassword.php?mail=${mail.value}&password=${password.value}`);
        const data = await response.json();
        if (data.result) {
            const token = data.result;
            setCookie('token', token);
            getFromSql(token, 'username');
            getFromSql(token, 'firstname');
            getFromSql(token, 'lastname');
            getFromSql(token, 'mail');
            getFromSql(token, 'city');
            getFromSql(token, 'gender');
            window.location.href = '/home';
        } else {
            console.log('Wrong password');
        }
    }
}