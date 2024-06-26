<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$command = $_GET['command'];
$response = ['success' => false];

if ($command) {
    try {
        $db = new PDO('sqlite:/var/www/html/commands.db');
        $stmt = $db->prepare('SELECT description FROM commands WHERE command = :command');
        $stmt->bindParam(':command', $command);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $response = ['success' => true, 'description' => $result['description']];
        }
    } catch (PDOException $e) {
        $response['message'] = 'Database error: ' . $e->getMessage();
        error_log($e->getMessage());
    }
}

echo json_encode($response);
?>

