function createCards(idList) {
    const resultSection = document.getElementById('result-section');
    const cardContainer = document.getElementById('card-container');
    if (cardContainer) {
        cardContainer.innerHTML = '';
    } else {
        console.error('Error: card-slider element not found');
    }
    if (idList.length > 0) {
        idList.forEach(e => {
            fetch('/backend/functions/userCard.php?id=' + e)
            .then(response => response.text())
            .then(html => {
                cardContainer.innerHTML += html;
            })
            .catch(error => {
                console.error(error);
            });
        });
    } else {
        resultSection.innerHTML = '<p>Aucun résultat (っ◞‸◟ c) ...</p>';
    }
}

function like(id) {
    const likeBtn = document.getElementById('likeImg-' + id);
    if (likeBtn.src.includes('liked')) {
        return;
    }
    likeBtn.src = 'frontend/img/liked.min.svg';
    user_id = getCookie('id');
    cible_id = id;
    fetch('backend/functions/phpCaller.php?function=addMatch', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            user_id: user_id,
            cible_id: cible_id
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.result[1]) {
            matchAlert();
        }
    });
}

function matchAlert() {
    new Audio('frontend/audio/match.mp3').play();
    const matchAlert = document.getElementById('match-alert');
    matchAlert.style.transform = 'scale(1)';
    setTimeout(() => {
        matchAlert.style.transform = '';
    }, 6000);
}

function openConversation(id) {
    fetch('/backend/functions/messageCaller.php?function=createConversation', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            user_id: getCookie('id'),
            cible_id: id
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.result) {
            window.location.href = '/messages';
        } else {
            window.location.href = '/messages';
        }
    });
}