<?php
include 'db.php';

header('Content-Type: application/json');

$userId = 1; // Замените на реальный ID пользователя из сессии

try {
    $stmt = $pdo->prepare('SELECT games.id, games.name, games.price FROM cart_items JOIN games ON cart_items.game_id = games.id WHERE cart_items.user_id = ?');
    $stmt->execute([$userId]);
    $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($cartItems);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
