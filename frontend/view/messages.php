
<?php
include 'backend/functions/checkIdentification.php';
?>

<head>
    <title>Messagerie</title>
    <link rel="stylesheet" href="frontend/css/messages.css">
    <script src="backend/controller/messages.js"></script>
</head>
<body>
    <?php include 'frontend/widget/header.php' ?>
    <div id="center">
        <div id="messagerie">
            <div id="conv-container">
            </div>
            <div id="messages">
                <div id="messages-content"></div>
                <div id="send-container">
                    <input type="text" id="message" placeholder="Message">
                    <button id="send" onclick="sendMessage()">Send</button>
                </div>
            </div>
        </div>
    </div>
</body>
