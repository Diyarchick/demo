<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина товаров</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <section id="cart">
            <h2>Корзина товаров</h2>
            <div class="cart-items">
                <!-- Товары в корзине будут отображаться здесь -->
            </div>
            <div class="total-cost">
                <!-- Общая стоимость корзины будет отображаться здесь -->
            </div>
            <button id="checkout-button">Оформить заказ</button>
        </section>
    </main>
    <script src="cart.js"></script>
</body>
</html>
