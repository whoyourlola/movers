<?php
header('Content-Type: application/json');
include '../includes/config.php'; // This should initialize $pdo (a PDO instance)

$emp_id = $_GET['emp_id'] ?? '';
$date_from = $_GET['date_from'] ?? '';
$date_to = $_GET['date_to'] ?? '';
$ot_status = $_GET['ot_status'] ?? '';
$log_type = $_GET['log_type'] ?? ''; // Optional filter for log_type

// Build the base SQL query
$sql = "
    SELECT 
        a.user_id,
        CONCAT(e.first_name, ' ', e.last_name) AS emp_name,
        a.log_date,

        -- Times
        COALESCE(tin.log_time, 'N/A') AS time_in,
        tin.id AS maxtime_in_id,

        COALESCE(lout.log_time, 'N/A') AS lunch_out,
        lout.id AS maxtime_lunch_out_id,

        COALESCE(lin.log_time, 'N/A') AS lunch_in,
        lin.id AS maxtime_lunch_in_id,

        COALESCE(tout.log_time, 'N/A') AS time_out,
        tout.id AS maxtime_out_id,

        CASE 
            WHEN TIMESTAMPDIFF(MINUTE, tin.log_time, tout.log_time) > 480 THEN 'Yes'
            ELSE 'No'
        END AS ot_status,

        TIMESTAMPDIFF(MINUTE, tin.log_time, tout.log_time) AS worked_minutes

    FROM (
        SELECT user_id, log_date FROM time_logs GROUP BY user_id, log_date
    ) a

    LEFT JOIN employees_hr1 e ON a.user_id = e.id

    LEFT JOIN time_logs tin 
        ON tin.user_id = a.user_id AND tin.log_date = a.log_date AND tin.log_type = 1 
        AND tin.log_time = (
            SELECT MAX(log_time) FROM time_logs 
            WHERE user_id = a.user_id AND log_date = a.log_date AND log_type = 1
        )

    LEFT JOIN time_logs lout 
        ON lout.user_id = a.user_id AND lout.log_date = a.log_date AND lout.log_type = 2 
        AND lout.log_time = (
            SELECT MAX(log_time) FROM time_logs 
            WHERE user_id = a.user_id AND log_date = a.log_date AND log_type = 2
        )

    LEFT JOIN time_logs lin 
        ON lin.user_id = a.user_id AND lin.log_date = a.log_date AND lin.log_type = 3 
        AND lin.log_time = (
            SELECT MAX(log_time) FROM time_logs 
            WHERE user_id = a.user_id AND log_date = a.log_date AND log_type = 3
        )

    LEFT JOIN time_logs tout 
        ON tout.user_id = a.user_id AND tout.log_date = a.log_date AND tout.log_type = 4 
        AND tout.log_time = (
            SELECT MAX(log_time) FROM time_logs 
            WHERE user_id = a.user_id AND log_date = a.log_date AND log_type = 4
        )

    WHERE 1=1
";


// Initialize query parameters array
$params = [];

// Add filters
if (!empty($emp_id)) {
    $sql .= " AND a.user_id = :emp_id";
    $params[':emp_id'] = $emp_id;
}

if (!empty($date_from) && !empty($date_to)) {
    $sql .= " AND a.log_date BETWEEN :date_from AND :date_to";
    $params[':date_from'] = $date_from;
    $params[':date_to'] = $date_to;
} elseif (!empty($date_from)) {
    $sql .= " AND a.log_date >= :date_from";
    $params[':date_from'] = $date_from;
} elseif (!empty($date_to)) {
    $sql .= " AND a.log_date <= :date_to";
    $params[':date_to'] = $date_to;
}

if (!empty($ot_status)) {
    $sql .= " HAVING ot_status = :ot_status";
    $params[':ot_status'] = $ot_status;
}

if (!empty($log_type)) {
    $sql .= " AND a.log_type = :log_type";
    $params[':log_type'] = $log_type;
}

// Group by user and date
$sql .= " GROUP BY a.user_id, a.log_date";

// Order results by date descending
$sql .= " ORDER BY a.log_date DESC";

// Execute query
try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return the results in JSON format
    echo json_encode($data);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
