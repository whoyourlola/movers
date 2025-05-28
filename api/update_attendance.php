<?php
header('Content-Type: application/json');
include '../includes/config.php'; // This should initialize $pdo

// Inputs
$emp_id = $_POST['user_id'] ?? null;
$log_date = $_POST['log_date'] ?? null;  // Ensure this is being passed
$time_in_id = $_POST['time_in_id'] ?? null;
$lunch_out_id = $_POST['lunch_out_id'] ?? null;
$lunch_in_id = $_POST['lunch_in_id'] ?? null;
$time_out_id = $_POST['time_out_id'] ?? null;

$time_in = $_POST['time_in'] ?? null;
$lunch_out = $_POST['lunch_out'] ?? null;
$lunch_in = $_POST['lunch_in'] ?? null;
$time_out = $_POST['time_out'] ?? null;

// Check if required parameters are present
if (!$emp_id || !$log_date) {
    echo json_encode(['success' => false, 'message' => 'Missing employee ID or log date']);
    exit();
}

try {
    $pdo->beginTransaction();

    // Reusable update/insert function
    function upsertLog($pdo, $id, $emp_id, $log_date, $log_type, $log_time) {
        if ($id) {
            // Update log time if record exists
            $stmt = $pdo->prepare("UPDATE time_logs SET log_time = :log_time WHERE id = :id");
            $stmt->execute([':log_time' => $log_time, ':id' => $id]);
        } else if ($emp_id && $log_date && $log_time !== null) {
            // Insert new log if no record exists
            $stmt = $pdo->prepare("INSERT INTO time_logs (user_id, log_date, log_type, log_time) VALUES (:emp_id, :log_date, :log_type, :log_time)");
            $stmt->execute([
                ':emp_id' => $emp_id,
                ':log_date' => $log_date,
                ':log_type' => $log_type,
                ':log_time' => $log_time
            ]);
        }
    }

    // Handle each log type: time_in, lunch_out, lunch_in, time_out
    upsertLog($pdo, $time_in_id, $emp_id, $log_date, 1, $time_in);
    upsertLog($pdo, $lunch_out_id, $emp_id, $log_date, 2, $lunch_out);
    upsertLog($pdo, $lunch_in_id, $emp_id, $log_date, 3, $lunch_in);
    upsertLog($pdo, $time_out_id, $emp_id, $log_date, 4, $time_out);

    $pdo->commit();
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    $pdo->rollBack();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
