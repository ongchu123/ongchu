<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

try {
    $db = new PDO('sqlite:/var/www/html/commands.db');
    $stmt = $db->prepare('SELECT id, command, description FROM suggestions WHERE approved = 0');
    $stmt->execute();
    $suggestions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(['suggestions' => $suggestions]);
} catch (PDOException $e) {
    echo json_encode(['suggestions' => [], 'message' => 'Database error: ' . $e->getMessage()]);
    error_log($e->getMessage());
}
?>

