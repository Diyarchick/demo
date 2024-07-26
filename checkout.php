<?php
include 'db.php';

header('Content-Type: application/json');

$userId = 1; // Замените на реальный ID пользователя из сессии

$response = [];

try {
    $stmt = $pdo->prepare('DELETE FROM cart_items WHERE user_id = ?');
    $stmt->execute([$userId]);

    $response = ['success' => true];
} catch (PDOException $e) {
    $response = ['success' => false, 'message' => $e->getMessage()];
}

echo json_encode($response);
?>
