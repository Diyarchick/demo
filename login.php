<?php
include 'db.php';
$data = json_decode(file_get_contents('php://input'), true);

$username = $data['username'];
$password = $data['password'];

$stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
$stmt->execute([$username]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
    echo json_encode(['success' => true, 'username' => $username]);
} else {
    echo json_encode(['success' => false, 'message' => 'Неверное имя пользователя или пароль']);
}
?>
