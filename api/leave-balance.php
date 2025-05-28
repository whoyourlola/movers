<?php
header('Content-Type: application/json');
include '../includes/config.php';

if (isset($_GET['emp_id'])) {
    $emp_id = $_GET['emp_id'];

    // Get employee info
    $empStmt = $pdo->prepare("SELECT * FROM employees_hr1 WHERE id = :emp_id");
    $empStmt->execute(['emp_id' => $emp_id]);
    $emp = $empStmt->fetch(PDO::FETCH_ASSOC);

    // Get leave balances
    $balanceStmt = $pdo->prepare("
        SELECT lb.*, lt.name AS leave_type
        FROM leave_balances lb
        JOIN leave_types lt ON lb.leave_type_id = lt.id
        WHERE lb.emp_id = :emp_id
    ");
    $balanceStmt->execute(['emp_id' => $emp_id]);
    $balances = $balanceStmt->fetchAll(PDO::FETCH_ASSOC);

    // Get all leave types
    $typesStmt = $pdo->query("SELECT * FROM leave_types");
    $types = $typesStmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'employee' => $emp,
        'balances' => $balances,
        'types' => $types
    ]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emp_id = $_POST['emp_id'];
    $balances = $_POST['balances'];

    foreach ($balances as $b) {
        $stmt = $pdo->prepare("
            INSERT INTO leave_balances (emp_id, leave_type_id, balance)
            VALUES (:emp_id, :leave_type_id, :balance)
            ON DUPLICATE KEY UPDATE balance = VALUES(balance)
        ");
        $stmt->execute([
            'emp_id' => $emp_id,
            'leave_type_id' => $b['leave_type_id'],
            'balance' => $b['balance']
        ]);
    }

    echo json_encode(['success' => true]);
    exit;
}
?>
