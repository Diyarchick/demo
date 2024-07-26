<?php
include 'db.php';

header('Content-Type: application/json');

try {
    $stmt = $pdo->query('SELECT * FROM games');
    $games = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Ensure rating is a number
    foreach ($games as &$game) {
        $game['rating'] = (float)$game['rating'];
    }

    echo json_encode($games);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
