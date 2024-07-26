<?php
include 'db.php';

$data = json_decode(file_get_contents('php://input'), true);
$gameId = $data['gameId'];
$userId = 1; // Замените на реальный ID пользователя из сессии

$stmt = $pdo->prepare('INSERT INTO cart_items (user_id, game_id) VALUES (?, ?)');
$stmt->execute([$userId, $gameId]);

$stmt = $pdo->prepare('SELECT name FROM games WHERE id = ?');
$stmt->execute([$gameId]);
$game = $stmt->fetch();

echo json_encode(['success' => true, 'gameName' => $game['name']]);
?>
