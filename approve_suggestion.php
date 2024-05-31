<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$input = json_decode(file_get_contents('php://input'), true);
$response = ['success' => false];

if (!empty($input['id'])) {
    try {
        $db = new PDO('sqlite:/var/www/html/commands.db');
        $stmt = $db->prepare('UPDATE suggestions SET approved = 1 WHERE id = :id');
        $stmt->bindParam(':id', $input['id']);
        $stmt->execute();
        $response['success'] = true;
    } catch (PDOException $e) {
        $response['message'] = 'Database error: ' . $e->getMessage();
        error_log($e->getMessage());
    }
}

echo json_encode($response);
?>

