<?php
// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);

// Check if 'imageUrl' is provided
if (!isset($input['imageUrl'])) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => 'Missing imageUrl in request.'
    ]);
    exit;
}
$imageUrl = $input['imageUrl'];
$uploadDir = 'uploads/';
$savePath = $uploadDir . 'Capture.PNG';

// Create uploads directory if it doesn't exist
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true); // true = recursive
}
// Download the image
$imageContent = file_get_contents($imageUrl);
if ($imageContent === false) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to download image from URL.'
    ]);
    exit;
}

// Save the image locally
file_put_contents($savePath, $imageContent);

// Escape the saved path for shell command
$escapedPath = escapeshellarg($savePath);
$command = escapeshellcmd("python recognize.py $escapedPath");
$output = shell_exec($command);

// Prepare response
$response = [];

if (strpos($output, 'MATCH:') === 0) {
    $userId = trim(str_replace('MATCH:', '', $output));
    $response['status'] = 'success';
    $response['message'] = 'User matched';
    $response['userId'] = $userId;
} elseif (strpos($output, 'NO_MATCH') !== false) {
    $response['status'] = 'error';
    $response['message'] = 'No matching user found.';
} elseif (strpos($output, 'ERROR:') !== false) {
    $response['status'] = 'error';
    $response['message'] = str_replace('ERROR:', '', $output);
} else {
    $response['status'] = 'error';
    $response['message'] = 'Unknown response: ' . $output;
}

// Return JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
