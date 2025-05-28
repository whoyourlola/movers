<?php
include '../includes/config.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$logFile = '../logs/attendance_logs.txt'; // Make sure this folder exists and is writable

function writeLog($message) {
    global $logFile;
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[$timestamp] $message" . PHP_EOL, FILE_APPEND);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    writeLog("Request rejected: Invalid method " . $_SERVER['REQUEST_METHOD']);
    http_response_code(405);
    echo json_encode(["error" => "Only POST method allowed"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['user_id'], $data['log_date'], $data['log_time'], $data['log_type'], $data['latitude'], $data['longitude'], $data['login_image'])) {
    writeLog("Request failed: Missing required fields. Data: " . json_encode($data));
    http_response_code(400);
    echo json_encode(["error" => "Missing required fields"]);
    exit;
}

$user_id = $data['user_id'];
$log_date = $data['log_date'];
$log_time = $data['log_time'];
$log_type = $data['log_type'];
$latitude = $data['latitude'];
$longitude = $data['longitude'];
$base64_image = $data['login_image'];

function calculateDistanceMeters($lat1, $lon1, $lat2, $lon2) {
    $earthRadius = 6371000;
    $dLat = deg2rad($lat2 - $lat1);
    $dLon = deg2rad($lon2 - $lon1);
    $a = sin($dLat/2) * sin($dLat/2) +
         cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
         sin($dLon/2) * sin($dLon/2);
    $c = 2 * atan2(sqrt($a), sqrt(1-$a));
    return $earthRadius * $c;
}

// Save base64 image
$uploadDir = '../uploads/loginimages/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64_image));
$imageName = 'login_' . $user_id . '_' . time() . '.jpg';
$imagePath = $uploadDir . $imageName;

if (!file_put_contents($imagePath, $imageData)) {
    writeLog("Image save failed for user $user_id");
    http_response_code(500);
    echo json_encode(["error" => "Failed to save image"]);
    exit;
}

$dbImagePath = 'uploads/loginimages/' . $imageName;

try {
    $stmt = $pdo->query("SELECT id, name, latitude, longitude FROM allowed_locations");
    $locations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $matchedLocationId = null;
    $matchedLocationName = null;
    $minDistance = PHP_INT_MAX;

    foreach ($locations as $location) {
        $dist = calculateDistanceMeters($latitude, $longitude, $location['latitude'], $location['longitude']);
        if ($dist <= 100 && $dist < $minDistance) {
            $matchedLocationId = $location['id'];
            $matchedLocationName = $location['name'];
            $minDistance = $dist;
        }
    }

    if ($matchedLocationId === null) {
        writeLog("Location mismatch for user $user_id at [$latitude, $longitude]");
        http_response_code(403);
        echo json_encode([
            "error" => "Location not within allowed range (100m)",
            "submitted_coords" => [$latitude, $longitude]
        ]);
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO time_logs (user_id, log_date, log_time, log_type, latitude, longitude, location_id, login_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$user_id, $log_date, $log_time, $log_type, $latitude, $longitude, $matchedLocationId, $dbImagePath]);

    writeLog("SUCCESS: Log recorded for user $user_id at $log_date $log_time, Location: $matchedLocationName (ID $matchedLocationId)");

    echo json_encode([
        "success" => true,
        "message" => "Time log recorded with image",
        "location_id" => $matchedLocationId,
        "location_name" => $matchedLocationName,
        "distance_meters" => round($minDistance, 2),
        "image_path" => $dbImagePath
    ]);

} catch (PDOException $e) {
    writeLog("DB Error for user $user_id: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(["error" => "Database error", "details" => $e->getMessage()]);
}
?>
