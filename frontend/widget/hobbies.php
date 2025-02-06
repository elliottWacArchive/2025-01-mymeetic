<script src="backend/controller/configuration.js"></script>
<script src="backend/controller/hobbies.js"></script>
<div id="profile-form-container">
    <h2>Ajoutez vos hobbies!</h2>
    <form onsubmit="addHobbies(event)" method="GET">
        <div id="hobbies-container"></div>
        <?php include 'frontend/widget/formButton.php'; ?>
    </form>
    <div id='outputMessage'></div>
</div>
