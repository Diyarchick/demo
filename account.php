<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <section id="account">
            <h2>Личный кабинет</h2>
            <div id="login-form">
                <input type="text" id="username" placeholder="Имя пользователя">
                <input type="password" id="password" placeholder="Пароль">
                <button id="login-button">Войти</button>
                <button id="register-button">Регистрация</button>
            </div>
            <div id="user-info" style="display: none;">
                <p>Добро пожаловать, <span id="user-name"></span>!</p>
                <button id="logout-button">Выйти</button>
            </div>
        </section>
    </main>
    <script src="account.js"></script>
</body>
</html>
