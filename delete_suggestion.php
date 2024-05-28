<?php
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$response = ['success' => false];

if (!empty($input['id'])) {
    // Simulate deleting the suggestion from a database
    // For now, we'll just return success
    $response['success'] = true;
}

echo json_encode($response);
?>

