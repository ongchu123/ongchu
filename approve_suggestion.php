<?php
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$response = ['success' => false];

if (!empty($input['id'])) {
    // Simulate approving the suggestion in a database
    // For now, we'll just return success
    $response['success'] = true;
}

echo json_encode($response);
?>

