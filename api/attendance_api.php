<?php
header('Content-Type: application/json');
require '../includes/config.php'; // Adjust path to your DB connection

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Invalid request method. Use POST.']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$date_from = $data['date_from'] ?? null;
$date_to = $data['date_to'] ?? null;

if (!$date_from || !$date_to) {
    echo json_encode(['error' => 'Missing date_from or date_to.']);
    exit;
}

try {
    // Step 1: Generate date range
    $start = new DateTime($date_from);
    $end = new DateTime($date_to);
    $end->modify('+1 day'); // Include end date
    $date_range = [];
    foreach (new DatePeriod($start, new DateInterval('P1D'), $end) as $date) {
        $date_range[] = $date->format('Y-m-d');
    }

    // Step 2: Get all employees
    $stmt = $pdo->prepare("SELECT id AS user_id, last_name as lname, first_name as fname FROM employees_hr1");
    $stmt->execute();
    $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Step 3: Initialize response with empty logs for each date
    $response = [];
    foreach ($employees as $emp) {
        $user_id = $emp['user_id'];
        $full_name = trim($emp['fname'] . ' ' . ($emp['mname'] ?? '') . ' ' . $emp['lname']);

        $response[$user_id] = [
            'name' => $full_name,
            'logs' => []
        ];

        foreach ($date_range as $date) {
            $response[$user_id]['logs'][$date] = [
                'time_in' => null,
                'time_out' => null
            ];
        }
    }

    // Step 4: Fetch time_in (min log_time where log_type = 1) and time_out (max log_time where log_type = 4)
    $stmt = $pdo->prepare("
        SELECT 
            user_id, 
            DATE(log_date) AS log_date,
            MIN(CASE WHEN log_type = 1 THEN TIME(log_time) END) AS time_in,
            MAX(CASE WHEN log_type = 4 THEN TIME(log_time) END) AS time_out
        FROM time_logs
        WHERE DATE(log_date) BETWEEN :date_from AND :date_to
        GROUP BY user_id, DATE(log_date)
    ");
    $stmt->execute([':date_from' => $date_from, ':date_to' => $date_to]);
    $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Step 5: Place time_in and time_out into respective user/date bucket
    foreach ($logs as $log) {
        $user_id = $log['user_id'];
        $log_date = $log['log_date'];
        if (isset($response[$user_id]['logs'][$log_date])) {
            $response[$user_id]['logs'][$log_date] = [
                'time_in' => $log['time_in'],
                'time_out' => $log['time_out']
            ];
        }
    }

    echo json_encode(['success' => true, 'data' => $response]);

} catch (PDOException $e) {
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
