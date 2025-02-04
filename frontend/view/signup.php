<head>
	<title>Inscription</title>
	<script src="backend/controller/signup.js" defer></script>
    <script src="backend/controller/button.js" defer></script>
    <link rel="stylesheet" href="frontend/css/signup.css">
</head>
<body>
    <div id="signup-container">
        <div id="illustration-container">
            <h1>Bienvenue sur MyVocaloid!</h1>
            <h2>Venez vous enfermer dans des relations inexistantes avec des personnages fictifs!</h2>
            <p><i>"ça va bientôt faire 2 ans que je ne suis pas sorti de chez moi et j'ai trouvé la paix"</i> - Lucas</p>
            <p><i>"J'ai plus d'amis, plus de famille mais j'ai MyVocaloid!"</i> - Alex</p>
        </div>
        <div id="form-container">
            <h1>Créer un compte!</h1>
            <p>Déjà un compte ? <a href="/login">Connectez-vous</a>
        </p>
            <form onsubmit="submitValidation(event)" method="GET">
                <div class="inline">
                    <input type="text" id="firstname" placeholder="Prénom">
                    <input type="text" id="lastname" placeholder="Nom">
                </div>
                <input type="text" id="username" placeholder="Pseudo">
                <input type="email" id="mail" placeholder="Mail">
                <input type="password" id="password" placeholder="Mot de passe">
                <div class="inline">
                    <input type="date" id="birthdate" placeholder="Date de naissance">
                    <input type="text" id="city" placeholder="Ville">
                </div>
                <select name="gender" id="gender">
                    <option value="male">Homme</option>
                    <option value="female">Femme</option>
                    <option value="other">Autre</option>
                </select>
                <div id="errorMessage"></div>
                <?php include 'frontend/widget/formButton.php'; ?>
            </form>
        </div>
    </div>
</body>
