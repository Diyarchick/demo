<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Онлайн магазин компьютерных игр</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <section>
            <h2>Добро пожаловать в наш магазин!</h2>
            <p>Найдите лучшие компьютерные игры здесь.</p>
        </section>
    </main>
    <div id="chat-box">
        <div id="messages"></div>
        <input type="text" id="chat-input" placeholder="Введите сообщение">
        <button id="send-button">Отправить</button>
    </div>
    <script src="scripts.js"></script>
</body>
</html>
