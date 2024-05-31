<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$input = json_decode(file_get_contents('php://input'), true);
$response = ['success' => false];

// Hardcoded admin credentials for demonstration
$adminUsername = 'admin';
$adminPassword = 'password';

// Basic input validation
if (isset($input['username']) && isset($input['password'])) {
    if ($input['username'] === $adminUsername && $input['password'] === $adminPassword) {
        session_start();
        $_SESSION['admin_logged_in'] = true;
        $response['success'] = true;
    } else {
        $response['message'] = 'Invalid credentials';
    }
} else {
    $response['message'] = 'Username and password are required';
}

echo json_encode($response);
?>

