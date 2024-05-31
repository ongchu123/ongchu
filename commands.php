<?php
header('Content-Type: application/json');
session_start();

// Include necessary files and initialize database connection
try {
    $db = new PDO('sqlite:/var/www/html/commands.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log("PDOException: " . $e->getMessage());
    echo json_encode(["success" => false, "message" => "Database connection failed: " . $e->getMessage()]);
    exit();
}

// Get the action parameter
$action = isset($_GET['action']) ? $_GET['action'] : '';
$input = json_decode(file_get_contents('php://input'), true);

// Route the request to the appropriate function
switch ($action) {
    case 'lookup':
        lookupCommand($db);
        break;
    // Other cases
    default:
        echo json_encode(["success" => false, "message" => "Invalid action"]);
        break;
}

// Function to look up a command
function lookupCommand($db) {
    $command = isset($_GET['command']) ? trim($_GET['command']) : '';
    $response = ['success' => false];

    if ($command) {
        try {
            $stmt = $db->prepare('SELECT description FROM commands WHERE command = :command');
            $stmt->bindParam(':command', $command, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $response = ['success' => true, 'description' => $result['description']];
            } else {
                $response['message'] = 'Command not found';
            }
        } catch (PDOException $e) {
            error_log("PDOException: " . $e->getMessage());
            $response['message'] = 'Database query error';
        }
    } else {
        $response['message'] = 'Command parameter is required';
    }

    echo json_encode($response);
}
?>

