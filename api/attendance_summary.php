<?php
include '../includes/config.php';

$emp_id = $_GET['emp_id'];
$start = $_GET['start'];
$end = $_GET['end'];

$logs = [];
$startDate = new DateTime($start);
$endDate = new DateTime($end);
$period = new DatePeriod($startDate, new DateInterval('P1D'), $endDate->modify('+1 day'));

$absences = 0;
$debugQueries = [];

foreach ($period as $date) {
    $dayOfWeek = $date->format('w');
    
    // Skip weekends (Sunday = 0, Saturday = 6)
    if ($dayOfWeek == 0 || $dayOfWeek == 6) continue;

    $logDate = $date->format('Y-m-d');

    // SQL Query to get time_in, time_out, and calculate late_minutes directly in SQL
    $sql = "
        SELECT 
            MAX(CASE WHEN log_type = 1 THEN log_time END) AS time_in,
            MAX(CASE WHEN log_type = 4 THEN log_time END) AS time_out,
            TIMESTAMPDIFF(MINUTE, TIME('08:00:00'), TIME(MAX(CASE WHEN log_type = 1 THEN log_time END))) AS late_mins
        FROM time_logs
        WHERE user_id = :emp_id AND log_date = :log_date
    ";

    // Store query for debugging
    $debugQueries[] = [
        'logdate' => $logDate, 
        'empid' => $emp_id, 
        'sql' => $sql
    ];

    // Log the query to the PHP error log for debugging purposes
    error_log("Query: $sql");

    // Execute the query with bound parameters
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['emp_id' => $emp_id, 'log_date' => $logDate]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Handle missing times (if time_in or time_out is missing)
    $time_in = !empty($row['time_in']) ? strtotime($row['time_in']) : null;
    $time_out = !empty($row['time_out']) ? strtotime($row['time_out']) : null;
    $late_mins = !empty($row['late_mins']) ? $row['late_mins'] : 0;

    if ($time_in) {
        // Process if time_in exists, but time_out might be missing
        $startWork = strtotime("$logDate 08:00:00"); // 8:00 AM work start time
        $endWork = strtotime("$logDate 17:00:00");   // 5:00 PM work end time

        // If time_out is missing, assume end of workday (17:00:00)
        if (!$time_out) {
            $time_out = $endWork;
        }

        // Actual in/out times, ensuring they are within work hours (8 AM to 5 PM)
        $actualIn = max($time_in, $startWork);
        $actualOut = min($time_out, $endWork);

        // Calculate worked seconds and then convert to hours
        $workedSecs = max(0, $actualOut - $actualIn);
        $workedHours = round($workedSecs / 3600, 2);

        // Store the log information
        $logs[] = [
            'date' => $logDate,
            'time_in' => date('H:i', $time_in),
            'time_out' => date('H:i', $time_out),
            'hours_worked' => $workedHours,
            'late_mins' => $late_mins
        ];
    } else {
        // If time_in is missing, it's an absence
        $logs[] = [
            'date' => $logDate,
            'time_in' => '--:--',
            'time_out' => '--:--',
            'hours_worked' => 0,
            'late_mins' => 0
        ];
        $absences++;
    }
}

// Output the result including logs, absences, and SQL queries for debugging
echo json_encode([
    'logs' => $logs,
    'absences' => $absences,
    'sql' => $debugQueries // Debugging query log
]);
?>
