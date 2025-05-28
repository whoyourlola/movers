<?php
include '../includes/config.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

try {
    // Prepare the SQL query
    $stmt = $pdo->prepare("SELECT id,user_id, login_image, ai_ver 
                           FROM time_logs 
                           WHERE TRIM(login_image) != '' 
                             AND TRIM(ai_ver) = ''");

    // Execute the query
    $stmt->execute();

    // Fetch all the results
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Check if records were found
    if ($records) {
        // Return the results as JSON
        echo json_encode([
            "status" => "success",
            "records" => $records
        ]);
    } else {
        // No records found
        echo json_encode([
            "status" => "success",
            "message" => "No records found"
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
