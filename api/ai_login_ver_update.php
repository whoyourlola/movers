<?php
include '../includes/config.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["error" => "Only POST method allowed"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

// Check if 'time_logs_id' and 'ai_ver' are provided in the request body
if (!isset($data['time_logs_id'], $data['ai_ver'])) {
    http_response_code(400);
    echo json_encode(["error" => "Missing required fields: 'time_logs_id' or 'ai_ver'"]);
    exit;
}

$time_logs_id = $data['time_logs_id'];
$ai_ver = $data['ai_ver'];

// Validate the time_logs_id (make sure it's a positive integer)
if (!filter_var($time_logs_id, FILTER_VALIDATE_INT) || $time_logs_id <= 0) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid 'time_logs_id'"]);
    exit;
}

try {
    // Prepare the SQL query to update the 'ai_ver' field for the given 'time_logs_id'
    $stmt = $pdo->prepare("UPDATE time_logs SET ai_ver = ? WHERE id = ?");
    
    // Execute the query with the provided 'ai_ver' and 'time_logs_id'
    $stmt->execute([$ai_ver, $time_logs_id]);

    // Check if the update was successful
    if ($stmt->rowCount() > 0) {
        echo json_encode([
            "status" => "success",
            "message" => "AI version updated successfully"
        ]);
    } else {
        echo json_encode([
            "status" => "failure",
            "message" => "No records updated. Check if the time_logs_id is correct."
        ]);
    }

} catch (PDOException $e) {
    // Handle any errors
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Database error: " . $e->getMessage()
    ]);
}
?>
