<?php
header('Content-Type: application/json');
include '../includes/config.php';

// Get employee ID from GET parameters
$emp_id = $_GET['emp_id'] ?? null;

if (!$emp_id) {
    echo json_encode(['error' => 'Missing employee ID']);
    exit;
}

try {
    // Fetch employee details
    $empStmt = $pdo->prepare("SELECT id, first_name, last_name, position, gender FROM employees_hr1 WHERE id = :emp_id");
    $empStmt->execute(['emp_id' => $emp_id]);
    $employee = $empStmt->fetch(PDO::FETCH_ASSOC);

    if (!$employee) {
        echo json_encode(['error' => 'Employee not found']);
        exit;
    }

    // --- Delete duplicate leave balances (keeping the one with the lowest ID) ---
    $deleteDuplicates = "
        DELETE lb1 FROM leave_balances lb1
        JOIN leave_balances lb2 
        ON lb1.emp_id = lb2.emp_id 
        AND lb1.leave_type_id = lb2.leave_type_id 
        AND lb1.id > lb2.id
        WHERE lb1.emp_id = :emp_id
    ";
    $deleteStmt = $pdo->prepare($deleteDuplicates);
    $deleteStmt->execute(['emp_id' => $emp_id]);

    // Build leave balance query based on gender
    $query = "
        SELECT 
            lb.leave_type_id, 
            lt.name AS leave_type, 
            lb.balance 
        FROM leave_balances lb
        JOIN leave_types lt ON lb.leave_type_id = lt.id
        WHERE lb.emp_id = :emp_id
    ";

    if ($employee['gender'] === 'Male') {
        // Exclude Maternity leave for males
        $query .= " AND lt.name != 'MATERNITY LEAVE'";
    } else {
        // Exclude Paternity leave for females
        $query .= " AND lt.name != 'Paternity Leave'";
    }

    $balanceStmt = $pdo->prepare($query);
    $balanceStmt->execute(['emp_id' => $emp_id]);
    $leave_balances = $balanceStmt->fetchAll(PDO::FETCH_ASSOC);

    // Return JSON response
    echo json_encode([
        'employee' => $employee,
        'leave_balances' => $leave_balances
    ]);

} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
