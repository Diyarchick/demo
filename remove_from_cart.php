<?php
include 'db.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$index = $data['index'];
$userId = 1; // Замените на реальный ID пользователя из сессии

$response = [];

try {
    // Получаем id товара для удаления
    $stmt = $pdo->prepare('SELECT id FROM cart_items WHERE user_id = ? LIMIT 1 OFFSET ?');
    $stmt->bindParam(1, $userId, PDO::PARAM_INT);
    $stmt->bindParam(2, $index, PDO::PARAM_INT);
    $stmt->execute();
    $item = $stmt->fetch();

    if ($item) {
        $stmt = $pdo->prepare('DELETE FROM cart_items WHERE id = ?');
        $stmt->bindParam(1, $item['id'], PDO::PARAM_INT);
        $stmt->execute();
        $response = ['success' => true];
    } else {
        $response = ['success' => false, 'message' => 'Товар не найден'];
    }
} catch (PDOException $e) {
    $response = ['success' => false, 'message' => $e->getMessage()];
}

echo json_encode($response);
?>
