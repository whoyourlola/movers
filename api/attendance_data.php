<?php
header('Content-Type: application/json');
include '../includes/config.php'; // This should initialize $pdo (a PDO instance)

// Get filter parameters
$emp_id = $_GET['emp_id'] ?? '';
$date = $_GET['date'] ?? date('Y-m-d'); // Default to today's date if no date is provided
$ot_status = $_GET['ot_status'] ?? '';

// Build the base SQL
$sql = "
    SELECT 
        a.user_id,
        a.ai_ver,
        CONCAT(e.first_name, ' ', e.last_name) AS emp_name,
        COALESCE(MAX(CASE WHEN a.log_type = 1 THEN a.log_time END), 'N/A') AS time_in,
        COALESCE(MAX(CASE WHEN a.log_type = 2 THEN a.log_time END), 'N/A') AS lunch_out,
        COALESCE(MAX(CASE WHEN a.log_type = 3 THEN a.log_time END), 'N/A') AS lunch_in,
        COALESCE(MAX(CASE WHEN a.log_type = 4 THEN a.log_time END), 'N/A') AS time_out,
        COALESCE(a.log_date, 'No Date') AS log_date,
        CASE 
            WHEN TIMESTAMPDIFF(MINUTE, 
                COALESCE(MAX(CASE WHEN a.log_type = 1 THEN a.log_time END), '2000-01-01 00:00:00'), 
                COALESCE(MAX(CASE WHEN a.log_type = 4 THEN a.log_time END), '2000-01-01 00:00:00')
            ) > 480 THEN 'Yes'
            ELSE 'No'
        END AS ot_status
    FROM time_logs a
    JOIN employees_hr1 e ON a.user_id = e.id
    WHERE 1=1
";

$params = [];

// Add filters for emp_id, date, and ot_status
if (!empty($emp_id)) {
    $sql .= " AND a.user_id = :emp_id";
    $params[':emp_id'] = $emp_id;
}

if (!empty($date)) {
    $sql .= " AND a.log_date = :log_date";
    $params[':log_date'] = $date;
}

// Handle OT filter with HAVING clause
if (!empty($ot_status)) {
    $sql .= " HAVING ot_status = :ot_status";
    $params[':ot_status'] = $ot_status;
}

$sql .= " GROUP BY a.user_id, a.log_date ORDER BY a.log_date DESC";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
