
<?php
include 'backend/functions/checkIdentification.php';
include 'backend/model/card.php';
?>

<head>
    <title>Settings</title>
    <script src="backend/controller/button.js" defer></script>
    <script src="backend/controller/settings.js" defer></script>
    <!-- <script src="backend/controller/hobbies.js" defer></script> -->
</head>
<body>
    <?php include 'frontend/widget/header.php' ?>
    <div id="center">
        <h1>Mon compte</h1>
        <div id="account">
            <div id="info-container">
                <h2>Information</h2>
                <div id="pp">
                    <?php include 'frontend/widget/profilePicture.php' ?>
                </div>
                <div id="username">
                    <p>Nom d'utilisateur : <?php echo $_COOKIE['username'] ?></p>
                </div>
                <div id="email">
                    <p>Email : <?php echo $_COOKIE['mail'] ?></p>
                </div>
                <div id="firstname">
                    <p>Prénom : <?php echo $_COOKIE['firstname'] ?></p>
                </div>
                <div id="lastname">
                    <p>Nom : <?php echo $_COOKIE['lastname'] ?></p>
                </div>
                <div id="gender">
                    <p>Genre : <?php echo $_COOKIE['gender'] ?></p>
                </div>
                <div id="birthdate">
                    <p>Date de naissance : <?php echo $_COOKIE['birthdate'] ?></p>
                </div>  
                <div id="display-hobbies">
                    <p>Loisirs : <?php include 'backend/functions/listUserHobbies.php';
                    getHobbies($_COOKIE['id']); ?> </p>
                </div>  
            </div>
            <div id="settings-container">
                <h2>Paramètres</h2>
                <div id="change-username">
                    <h3>Changer de pseudo</h3>
                    <form onsubmit="changeUsername(event)" method="get">
                        <input type="text" name="username" placeholder="Nouveau nom d'utilisateur">
                        <?php include 'frontend/widget/formButton.php' ?>
                    </form>
                </div>
                <div id="change-password">
                    <h3>Changer de mot de passe</h3>
                    <form onsubmit="changePassword(event)" method="get">
                        <input type="password" name="password" placeholder="Nouveau mot de passe">
                        <?php include 'frontend/widget/formButton.php' ?>
                    </form>
                </div>
                <div id="change-email">
                    <h3>Changer d'email</h3>
                    <form onsubmit="changeMail(event)" method="get">
                        <input type="email" name="email" placeholder="Nouveau email">
                        <?php include 'frontend/widget/formButton.php' ?>
                    </form>
                </div>
                <div id="change-pp">
                    <h3>Changer de photo de profil</h3>
                    <script src="backend/controller/configuration.js"></script>
                    <script src="backend/controller/button.js"></script>
                    <form onsubmit="changePP(event)" method="GET">
                        <label id="labelFile" for="profilePicture">Sélectionner</label>
                        <div id='shadow' style="margin-bottom: 10px;"></div>
                        <input type="file" id="profilePicture" name="profilePicture">
                        <?php include 'frontend/widget/formButton.php'; ?>
                    </form>
                    <div id='outputMessage'></div>
                </div>
                <div id="delete-account">
                    <h3>Supprimer le compte</h3>
                    <form onsubmit="deleteAccount(event)" method="get">
                        <button style="background-color: #a83232;"
                        id='button' type="Submit" value="Validation">
                            Supprimer le compte
                        </button>
                        <div id='shadow'></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>