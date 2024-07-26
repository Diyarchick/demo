<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог товаров</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <div id="search">
            <input type="text" id="search-input" placeholder="Поиск игр">
            <button id="search-button">Поиск</button>
        </div>
        <section id="catalog">
            <h2>Каталог товаров</h2>
            <div class="game-list">
                <!-- Игры будут добавляться здесь динамически -->
            </div>
        </section>
    </main>
    <script src="catalog.js"></script>
</body>
</html>
