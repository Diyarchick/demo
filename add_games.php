<?php
include 'db.php';

$games = [
    ['name' => 'GTA V', 'price' => 29.99, 'description' => 'Лицензионная копия игры', 'image' => 'game1.jpg', 'rating' => 4.5],
    ['name' => 'ROBLOX CARD', 'price' => 49.99, 'description' => 'Подарочная карта валюты', 'image' => 'game2.jpg', 'rating' => 4.0],
    ['name' => 'FAR CRY 5', 'price' => 19.99, 'description' => 'Лицензионная копия игры', 'image' => 'game3.jpg', 'rating' => 4.3],
    ['name' => 'HELLDIVERS II', 'price' => 39.99, 'description' => 'Лицензионная копия игры', 'image' => 'game4.jpg', 'rating' => 4.6],
    ['name' => 'GENSHIN IMPACT CARD', 'price' => 59.99, 'description' => 'Подарочная карта валюты', 'image' => 'game5.jpg', 'rating' => 4.8],
    ['name' => 'GTA IV', 'price' => 14.99, 'description' => 'Лицензионная копия игры', 'image' => 'game6.png', 'rating' => 4.1],
    ['name' => 'FORTNITE CARD', 'price' => 24.99, 'description' => 'Подарочная карта валюты', 'image' => 'game7.jpg', 'rating' => 4.2],
    ['name' => 'MINECRAFT', 'price' => 44.99, 'description' => 'Лицензионная копия игры', 'image' => 'game8.jpg', 'rating' => 4.9],
    ['name' => 'HAMSTER COIN', 'price' => 34.99, 'description' => 'Внутриигровая валюта', 'image' => 'game9.jpg', 'rating' => 4.0],
    ['name' => 'WAR THUNDER', 'price' => 54.99, 'description' => 'Подарочная карта валюты', 'image' => 'game10.jpg', 'rating' => 4.4],
];

try {
    $pdo->beginTransaction();
    $stmt = $pdo->prepare('INSERT INTO games (name, price, description, image, rating) VALUES (?, ?, ?, ?, ?)');
    foreach ($games as $game) {
        $stmt->execute([$game['name'], $game['price'], $game['description'], $game['image'], $game['rating']]);
    }
    $pdo->commit();
    echo "Данные успешно добавлены!";
} catch (Exception $e) {
    $pdo->rollBack();
    echo "Ошибка: " . $e->getMessage();
}
?>
