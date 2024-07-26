<?php
include 'db.php';
$data = json_decode(file_get_contents('php://input'), true);

$username = $data['username'];
$password = password_hash($data['password'], PASSWORD_DEFAULT);

$stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
$stmt->execute([$username]);
$user = $stmt->fetch();

if ($user) {
    echo json_encode(['success' => false, 'message' => 'Пользователь с таким именем уже существует']);
} else {
    $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
    $stmt->execute([$username, $password]);
    echo json_encode(['success' => true]);
}
?>
