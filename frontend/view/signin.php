<head>
	<title>Inscription</title>
	<script src="backend/controller/signin.js" defer></script>
</head>
<body>
	<form onsubmit="submitValidation(event)" method="GET">
		<input type="text" id="username" placeholder="Pseudo">
		<input type="text" id="firstname" placeholder="Prénom">
		<input type="text" id="lastname" placeholder="Nom">
		<input type="email" id="mail" placeholder="Mail">
		<input type="password" id="password" placeholder="Mot de passe">
		<input type="date" id="birthdate" placeholder="Date de naissance">
		<input type="text" id="city" placeholder="Ville">
		<select name="gender" id="gender">
			<option value="male">Homme</option>
			<option value="female">Femme</option>
			<option value="other">Autre</option>
		</select>
		<input type="Submit" value="Validation">
	</form>
</body>
