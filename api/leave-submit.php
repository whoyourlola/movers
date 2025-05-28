<?php
include '../includes/config.php';

$emp_id = $_POST['emp_id'];
$leave_date = $_POST['leave_date'];
$reason = $_POST['reason'];
$leave_type_id = $_POST['leave_type_id'];

$file_path = null;

if (isset($_FILES['sick_proof']) && $_FILES['sick_proof']['error'] === UPLOAD_ERR_OK) {
    $targetDir = "../uploads/sick_certificates/";
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    $fileName = time() . '_' . basename($_FILES["sick_proof"]["name"]);
    $targetFile = $targetDir . $fileName;

    if (move_uploaded_file($_FILES["sick_proof"]["tmp_name"], $targetFile)) {
        $file_path = "uploads/sick_certificates/" . $fileName;
    }
}

// Insert into leave_requests with file path
$sql = "INSERT INTO leave_requests (emp_id, leave_type_id, leave_date, reason, proof_file, status) 
        VALUES (?, ?, ?, ?, ?, 'Pending')";

$stmt = $pdo->prepare($sql);
$stmt->execute([$emp_id, $leave_type_id, $leave_date, $reason, $file_path]);

echo "Leave request submitted.";
?>
