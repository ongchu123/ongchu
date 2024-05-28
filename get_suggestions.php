<?php
header('Content-Type: application/json');

// Simulate fetching suggestions from a database
$suggestions = [
    ['id' => 1, 'command' => 'example', 'description' => 'Example description'],
    // Add more suggestions here
];

echo json_encode(['suggestions' => $suggestions]);
?>

