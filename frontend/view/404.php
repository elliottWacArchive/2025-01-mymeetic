<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404</title>
</head>
<body>
    <h1 style="color: #2ecc71">404</h1>
    <?php
    $quotes = [
        "夢を信じて、進んでいけば、きっと未来は開けるよ。",
        "音楽は心を癒してくれる。",
        "自分を大切にして、みんなに優しくね。",
        "未来は、君の手の中にある。",
        "声で世界を変えられるって信じてる！"
    ];

    $random_index = array_rand($quotes);
    echo "<div style='font-size: 24px; text-align: center; color: #2ecc71;'><br><i>{$quotes[$random_index]}</i></div>";
    ?>
</body>
<?php ?>
