<?php
include '../includes/config.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

date_default_timezone_set('Asia/Manila');

// Expected Attendance (all employees)
$stmt1 = $pdo->prepare("SELECT id as emp_id FROM employees_hr1");
$stmt1->execute();
$employees = $stmt1->fetchAll(PDO::FETCH_ASSOC);

// Prepare the data array
$data = [];

for ($i = 0; $i < 7; $i++) {
    $date = date('Y-m-d', strtotime("-$i days"));

    // Time In on this date
    $stmt2 = $pdo->prepare("SELECT DISTINCT user_id as emp_id, log_time FROM time_logs WHERE log_type = 1 AND DATE(log_date) = ?");
    $stmt2->execute([$date]);
    $timeInToday = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    // Leave on this date
    $stmt3 = $pdo->prepare("SELECT emp_id FROM leave_requests WHERE ? BETWEEN leave_date AND leave_date");
    $stmt3->execute([$date]);
    $onLeave = $stmt3->fetchAll(PDO::FETCH_COLUMN);

    // Late List
    $stmt4 = $pdo->prepare("SELECT user_id as emp_id, log_time FROM time_logs WHERE log_type = 1 AND DATE(log_date) = ?");
    $stmt4->execute([$date]);
    $lateList = [];
    while ($row = $stmt4->fetch(PDO::FETCH_ASSOC)) {
        $time = date('H:i:s', strtotime($row['log_time']));
        if ($time > '08:10:00') {
            $lateList[] = $row['emp_id'];
        }
    }

    // Evaluate each employee
    foreach ($employees as $emp) {
        $empId = $emp['emp_id'];
        $status = "Absent";
        $timeIn = null;

        // Check if the employee clocked in on this date
        foreach ($timeInToday as $entry) {
            if ($entry['emp_id'] == $empId) {
                $status = "Present";
                $timeIn = $entry['log_time'];  // Store the clock-in time
                break;
            }
        }

        if (in_array($empId, $lateList)) {
            $status = "Late";
        } elseif (in_array($empId, $onLeave)) {
            $status = "Leave";
        }

        $data[] = [
            'emp_id' => $empId,
            'status' => $status,
            'date' => $date,
            'time_in' => $timeIn,  // Include time_in in the response
        ];
    }
}

echo json_encode($data);
?>
