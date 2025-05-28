<?php
header('Content-Type: application/json');
include '../includes/config.php';

// Get date filter parameters
$from = $_GET['from'] ?? '';
$to = $_GET['to'] ?? '';

// Initialize parameters for the SQL query
$params = [];
$where = "";

// Add date filter if both 'from' and 'to' dates are provided
if (!empty($from) && !empty($to)) {
    $where = "WHERE t.log_date BETWEEN :from AND :to";
    $params[':from'] = $from;
    $params[':to'] = $to;
}

$sql = "
    SELECT DISTINCT u.id AS emp_id, u.first_name, u.last_name
    FROM employees_hr1 u
    JOIN time_logs t ON u.id = t.user_id
    $where
    ORDER BY u.last_name ASC
";

// Prepare and execute the query
$stmt = $pdo->prepare($sql);
$stmt->execute($params);

// Fetch the result
$employees = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return the result as JSON
echo json_encode($employees);
