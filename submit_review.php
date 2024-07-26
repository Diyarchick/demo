<?php
include 'db.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$gameId = $data['gameId'];
$name = $data['name'];
$text = $data['text'];
$rating = $data['rating'];

$response = [];

try {
    // Вставка нового отзыва
    $stmt = $pdo->prepare('INSERT INTO reviews (game_id, reviewer_name, review_text, rating) VALUES (?, ?, ?, ?)');
    $stmt->execute([$gameId, $name, $text, $rating]);

    // Обновление среднего рейтинга для игры
    $stmt = $pdo->prepare('SELECT AVG(rating) as avg_rating FROM reviews WHERE game_id = ?');
    $stmt->execute([$gameId]);
    $avgRating = $stmt->fetch()['avg_rating'];

    $stmt = $pdo->prepare('UPDATE games SET rating = ? WHERE id = ?');
    $stmt->execute([$avgRating, $gameId]);

    $response = ['success' => true];
} catch (PDOException $e) {
    $response = ['success' => false, 'message' => $e->getMessage()];
}

echo json_encode($response);
?>
