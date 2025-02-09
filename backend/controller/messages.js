document.addEventListener('DOMContentLoaded', () => {
    const conv = document.getElementById('conv-container');

    fetch('/backend/functions/messageCaller.php?function=getConversations', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            id: getCookie('id'),
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.result) {
            data.result.forEach(element => {
                fetch(`/backend/functions/listConversation.php?id=${element.id}&user1=${element.user1}&user2=${element.user2}`)
                .then(response => response.text())
                .then(data => {
                    conv.innerHTML += data;
                });
            });
        }
    });
});

function openConversation(id) {
    fetch(`/backend/functions/messageCaller.php?function=getMessages&id=${id}`)
    .then(response => response.json())
    .then(data => {
        if (data.result) {
            const messages = document.getElementById('messages-content');
            const send = document.getElementById('send-container');
            messages.innerHTML = '';
            data.result.forEach(element => {
                messages.innerHTML += `<div class="message ${element.sender == getCookie('id') ? 'me' : 'you'}">${element.message}</div>`;
            });
            send.innerHTML = '<input type="text" id="message" placeholder="Message"><button id="send" onclick="sendMessage(' + id + ')">Send</button>';

            document.querySelectorAll('.conv').forEach(conv => {
                if (conv.id == id) {
                    conv.classList.add('active-conversation');
                } else {
                    conv.classList.remove('active-conversation');
                }
            });
        }
    });
}

function loadConversation(id) {
    fetch(`/backend/functions/messageCaller.php?function=getMessages&id=${id}`)
    .then(response => response.json())
    .then(data => {
        if (data.result) {
            const messages = document.getElementById('messages-content');
            messages.innerHTML = '';
            data.result.forEach(element => {
                messages.innerHTML += `<div class="message ${element.sender == getCookie('id') ? 'me' : 'you'}">${element.message}</div>`;
            });
        }
    });
}

function sendMessage(id) {
    const message = document.getElementById('message').value;

    fetch('/backend/functions/messageCaller.php?function=sendMessage', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            sender: getCookie('id'),
            id: id,
            message: message
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.result) {
            openConversation(id);
        }
    });
}

setInterval(() => {
    const activeConversation = document.querySelector('.active-conversation');
    if (activeConversation) {
        const conversationId = activeConversation.id;
        loadConversation(conversationId);
    }
}, 1000);