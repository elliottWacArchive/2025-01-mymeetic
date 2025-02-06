<script src="backend/controller/configuration.js"></script>
<script src="backend/controller/button.js"></script>
<div id="profile-form-container">
    <h2>Ajoutez une photo de profil!</h2>
    <form onsubmit="checkPP(event)" method="GET">
        <label id="labelFile" for="profilePicture">Sélectionner</label>
        <div id='shadow'></div>
        <input type="file" id="profilePicture" name="profilePicture">
        <?php include 'frontend/widget/formButton.php'; ?>
    </form>
    <div id='outputMessage'></div>
</div>
