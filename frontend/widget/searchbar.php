<div id="searchbar-shadow">
    <div id="filter-container">
        <div class="filter-obj" id="ville">
            <div class="inline"><div class="filter-title">Ville :</div><div id="add"></div></div>
            <div class="filter-content">
            </div>
        </div>
        <div class="filter-obj" id="genre">
            <div id="genre-activator" class="filter-title">Genre :</div>
            <div id="genre-selector" class="multi-selector">
                <div class="select" value="male">Homme</div>
                <div class="select" vale="female">Femme</div>
                <div class="select" value="other">Autre</div>
            </div>
        </div>
        <div class="filter-obj" id="loisir">
            <div id="loisir-activator" class="filter-title">Loisir :</div>
            <div id="loisir-selector" class="multi-selector">
                <?php include 'backend/functions/listHobbiesAff.php'; ?>
            </div>
        </div>
        <div class="filter-obj" id="age">
            <div id="age-activator" class="filter-title">Age :</div>
            <div id="age-selector" class="multi-selector">
                <div class="select" value="18-25">18/25</div>
                <div class="select" value="25-35">25/35</div>
                <div class="select" value="35-45">35/45</div>
                <div class="select" value="45+">45+</div>
            </div>
        </div>
    </div>
</div>
<div id="searchbar-container">
    <button id="filter">
        <img class="icon" src="frontend/img/filter.svg" alt="" draggable="false">
    </button>
    <input type="text" id="searchbar" placeholder="Rechercher un vocaloid...">
    <button id="search">
        <img class="icon" src="frontend/img/search.svg" alt="" draggable="false">
    </button>
</div>