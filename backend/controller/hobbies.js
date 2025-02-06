var hobbyList = [];

document.addEventListener('DOMContentLoaded', function () {
    const hobbiesContainer = document.getElementById('hobbies-container');
    fetch ('/backend/functions/listHobbies.php')
    .then(response => response.json())
    .then(data => {
        data.forEach(hobby => {
            console.log(hobby.id, hobby.name);
            hobbiesContainer.innerHTML += `<div class='hobby' id='${hobby.id}'>${hobby.name}</div>`;
        });
    })

    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('hobby')) {
            if (event.target.classList.contains('clicked')) {
                event.target.style.border = "";
                event.target.style.margin = "";
                event.target.classList.remove('clicked');
                hobbyList = hobbyList.filter(hobbyId => hobbyId !== event.target.id);
                console.log(hobbyList);
            } else {
                event.target.style.border = "2px solid var(--m-l-pink)";
                event.target.style.margin = "3px";
                event.target.classList.add('clicked');
                hobbyList.push(event.target.id);
            }
        }
    });
});
console.log(hobbyList);

function addHobbies(event) {
    const output = document.getElementById('outputMessage');
    event.preventDefault();
    if (hobbyList.length > 0) {
        hobbyList.forEach((hobby) => addHobby(hobby));
        output.innerHTML = "hobbies ajoutés! <div onclick='finish()' id='next'>Fermer</div>";
    } else {
        output.innerText = "aucun hobby sélectionné!";
    }
}

function addHobby(hobby) {
    token = getCookie("token");
    fetch(`/backend/functions/phpCallerHobbies.php?function=addHobby&token=${token}&hobby=${hobby}`)
    .then(response => response.json())
    .then(data => {
        console.log(data);
        if (data.result) {
            return true;
        } else {
            return false;
        }
    });
}

function finish() {
    token = getCookie("token");
    const zone = document.getElementById("configuration-container")
    zone.innerHTML = "<div id='configuration-container'><h1>Configuration terminée!</h1>";
    zone.innerHTML += "</div>";
    fetch(`/backend/functions/phpCaller.php?function=setUser&token=${token}&param=isConfigure&value=1`)
    .then(response => response.json())
    .then(data => {
        console.log(data);
        if (data.result) {
            return true;
        } else {
            return false;
        }
    });
}