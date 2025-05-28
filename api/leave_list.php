<?php
header('Content-Type: application/json');
require '../includes/config.php'; // Adjust path to your DB connection

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Invalid request method. Use POST.']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$date_from = $data['leave_date_from'] ?? null;
$date_to = $data['leave_date_to'] ?? null;

if (!$date_from || !$date_to) {
    echo json_encode(['error' => 'Missing leave_date_from or leave_date_to.']);
    exit;
}

try {
    $stmt = $pdo->prepare("
        SELECT 
    lr.id,
    lr.emp_id,
    CONCAT(e.fname, ' ', e.mname, ' ', e.lname) AS employee_name,
    lr.leave_date,
    lr.leave_date,
    lr.reason,
    lr.status,
    lt.name AS leave_type
FROM leave_requests lr
JOIN leave_types lt ON lr.leave_type_id = lt.id
JOIN employees e ON lr.emp_id = e.id
WHERE DATE(lr.leave_date) BETWEEN :date_from AND :date_to
ORDER BY lr.leave_date DESC;
    ");

    $stmt->execute([
        ':date_from' => $date_from,
        ':date_to' => $date_to
    ]);

    $leave_requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'success' => true,
        'data' => $leave_requests
    ]);

} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Database error: ' . $e->getMessage()
    ]);
}
