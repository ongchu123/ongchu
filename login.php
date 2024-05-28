<?php
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$response = ['success' => false];

// Hardcoded admin credentials for demonstration
$adminUsername = 'admin';
$adminPassword = 'password';

if ($input['username'] === $adminUsername && $input['password'] === $adminPassword) {
    session_start();
    $_SESSION['admin_logged_in'] = true;
    $response['success'] = true;
}

echo json_encode($response);
?>

