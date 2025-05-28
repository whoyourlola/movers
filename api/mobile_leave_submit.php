<?php
header('Content-Type: application/json');
include '../includes/config.php';

// Read the JSON body
$input = json_decode(file_get_contents('php://input'), true);

if (!$input || !isset($input['emp_id'], $input['leave_date'], $input['reason'], $input['leave_type_id'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
    exit;
}

$emp_id = $input['emp_id'];
$leave_date = $input['leave_date'];
$reason = $input['reason'];
$leave_type_id = $input['leave_type_id'];
$proof_file = $input['proof_file'] ?? null; // Optional (base64 string or null)

// Handle base64 file upload (if any)
$file_path = null;

if ($proof_file) {
    $targetDir = "../uploads/sick_certificates/";
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $fileData = base64_decode($proof_file['data']);
    $extension = pathinfo($proof_file['filename'], PATHINFO_EXTENSION);
    $fileName = time() . '_' . preg_replace("/[^a-zA-Z0-9_\-\.]/", "", $proof_file['filename']);
    $filePath = $targetDir . $fileName;

    if (file_put_contents($filePath, $fileData)) {
        $file_path = "uploads/sick_certificates/" . $fileName;
    } else {
        echo json_encode(['success' => false, 'message' => 'File upload failed']);
        exit;
    }
}

// Insert the leave request
$sql = "INSERT INTO leave_requests (emp_id, leave_type_id, leave_date, reason, proof_file, status) 
        VALUES (?, ?, ?, ?, ?, 'Pending')";

$stmt = $pdo->prepare($sql);
$stmt->execute([$emp_id, $leave_type_id, $leave_date, $reason, $file_path]);

echo json_encode(['success' => true, 'message' => 'Leave request submitted']);
