<?php
header('Content-Type: application/json');
include '../includes/config.php';

if (!isset($_GET['emp_id'])) {
    echo json_encode(['success' => false, 'message' => 'emp_id is required']);
    exit;
}

$emp_id = $_GET['emp_id'];

$stmt = $pdo->prepare("
    SELECT lr.*, lt.name AS leave_type
    FROM leave_requests lr
    JOIN leave_types lt ON lr.leave_type_id = lt.id
    WHERE lr.emp_id = :emp_id
    ORDER BY lr.leave_date DESC
");

$stmt->execute(['emp_id' => $emp_id]);
$leaves = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Add full proof file URL if exists
foreach ($leaves as &$leave) {
    if (!empty($leave['proof_file'])) {
        $leave['proof_file_url'] = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/wemovers/' . $leave['proof_file'];
    } else {
        $leave['proof_file_url'] = null;
    }
}

echo json_encode([
    'success' => true,
    'leaves' => $leaves
]);
exit;
