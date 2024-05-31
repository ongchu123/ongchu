<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$action = $_GET['action'];

try {
    $db = new PDO('sqlite:commands.db');

    if ($action === 'lookup') {
        $command = $_GET['command'];
        $stmt = $db->prepare('SELECT description FROM commands WHERE command = :command');
        $stmt->bindParam(':command', $command);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            echo json_encode(['success' => true, 'description' => $result['description']]);
        } else {
            echo json_encode(['success' => false]);
        }
    } elseif ($action === 'add') {
        $data = json_decode(file_get_contents('php://input'), true);
        $command = $data['command'];
        $description = $data['description'];

        $stmt = $db->prepare('INSERT INTO commands (command, description) VALUES (:command, :description)');
        $stmt->bindParam(':command', $command);
        $stmt->bindParam(':description', $description);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>

