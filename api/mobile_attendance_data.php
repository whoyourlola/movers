<?php
header('Content-Type: application/json');
include '../includes/config.php'; // Initialize $pdo

$employee_id = $_GET['id'] ?? '';  // ID from employees_hr1
$date_from = $_GET['date_from'] ?? '';
$date_to = $_GET['date_to'] ?? '';

// Base SQL
$sql = "
    SELECT 
        a.user_id,
        CONCAT(e.first_name, ' ', e.last_name) AS emp_name,
        a.log_date,

        COALESCE(tin.log_time, 'N/A') AS time_in,
        COALESCE(lout.log_time, 'N/A') AS lunch_out,
        COALESCE(lin.log_time, 'N/A') AS lunch_in,
        COALESCE(tout.log_time, 'N/A') AS time_out,

        CASE 
            WHEN TIMESTAMPDIFF(MINUTE, tin.log_time, tout.log_time) > 480 THEN 'Yes'
            ELSE 'No'
        END AS ot_status,

        TIMESTAMPDIFF(MINUTE, tin.log_time, tout.log_time) AS worked_minutes

    FROM (
        SELECT user_id, log_date FROM time_logs GROUP BY user_id, log_date
    ) a

    LEFT JOIN employees_hr1 e ON a.user_id = e.id
    LEFT JOIN time_logs tin ON tin.user_id = a.user_id AND tin.log_date = a.log_date AND tin.log_type = 1 
        AND tin.log_time = (SELECT MAX(log_time) FROM time_logs WHERE user_id = a.user_id AND log_date = a.log_date AND log_type = 1)
    LEFT JOIN time_logs lout ON lout.user_id = a.user_id AND lout.log_date = a.log_date AND lout.log_type = 2 
        AND lout.log_time = (SELECT MAX(log_time) FROM time_logs WHERE user_id = a.user_id AND log_date = a.log_date AND log_type = 2)
    LEFT JOIN time_logs lin ON lin.user_id = a.user_id AND lin.log_date = a.log_date AND lin.log_type = 3 
        AND lin.log_time = (SELECT MAX(log_time) FROM time_logs WHERE user_id = a.user_id AND log_date = a.log_date AND log_type = 3)
    LEFT JOIN time_logs tout ON tout.user_id = a.user_id AND tout.log_date = a.log_date AND tout.log_type = 4 
        AND tout.log_time = (SELECT MAX(log_time) FROM time_logs WHERE user_id = a.user_id AND log_date = a.log_date AND log_type = 4)

    WHERE 1=1
";

$params = [];

if (!empty($employee_id)) {
    $sql .= " AND a.user_id = :employee_id";
    $params[':employee_id'] = $employee_id;
}

if (!empty($date_from) && !empty($date_to)) {
    $sql .= " AND a.log_date BETWEEN :date_from AND :date_to";
    $params[':date_from'] = $date_from;
    $params[':date_to'] = $date_to;
}

$sql .= " GROUP BY a.user_id, a.log_date";
$sql .= " ORDER BY a.log_date DESC";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'status' => 'success',
        'employee_id' => $employee_id,
        'records' => $data
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
