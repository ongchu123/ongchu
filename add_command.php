<?php
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$response = ['success' => false'];

if (!empty($input['command']) && !empty($input['description'])) {
    try {
        $db = new PDO('sqlite:/var/www/html/commands.db');
        $stmt = $db->prepare('INSERT INTO commands (command, description) VALUES (:command, :description)');
        $stmt->bindParam(':command', $input['command']);
        $stmt->bindParam(':description', $input['description']);
        $stmt->execute();
        $response['success'] = true;
    } catch (PDOException $e) {
        error_log($e->getMessage());
    }
}

echo json_encode($response);
?>

