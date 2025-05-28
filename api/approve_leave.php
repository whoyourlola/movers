<?php
include '../includes/config.php';

// Function to approve or disapprove leave and deduct leave balance if approved
function updateLeaveStatus($leave_id, $status, $emp_id, $leave_type_id) {
    global $pdo;

    // Begin transaction
    $pdo->beginTransaction();

    try {
        // Update leave request status
        $stmt = $pdo->prepare("UPDATE leave_requests SET status = ? WHERE id = ?");
        $stmt->execute([$status, $leave_id]);

        // If approved, deduct from leave balance
        if ($status == 'Approved') {
            // Check if the employee has enough leave balance
            $stmt = $pdo->prepare("SELECT balance FROM leave_balances WHERE emp_id = ? AND leave_type_id = ?");
            $stmt->execute([$emp_id, $leave_type_id]);
            $balance = $stmt->fetchColumn();

            if ($balance > 0) {
                // Deduct 1 day from the balance (adjust this logic to suit your leave type calculation)
                $new_balance = $balance - 1;
                $stmt = $pdo->prepare("UPDATE leave_balances SET balance = ? WHERE emp_id = ? AND leave_type_id = ?");
                $stmt->execute([$new_balance, $emp_id, $leave_type_id]);
            } else {
                throw new Exception("Not enough leave balance.");
            }
        }

        // Commit the transaction
        $pdo->commit();
        return ['success' => true];
    } catch (Exception $e) {
        // Rollback transaction if error occurs
        $pdo->rollBack();
        return ['success' => false, 'message' => $e->getMessage()];
    }
}

// Check if the necessary parameters are provided
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['leave_id'], $_POST['emp_id'], $_POST['leave_type_id'], $_POST['status'])) {
    $leave_id = $_POST['leave_id'];
    $emp_id = $_POST['emp_id'];
    $leave_type_id = $_POST['leave_type_id'];
    $status = $_POST['status']; // "Approved" or "Disapproved"

    // Call the function to update leave status and balance
    $result = updateLeaveStatus($leave_id, $status, $emp_id, $leave_type_id);

    // Return the response in JSON format
    echo json_encode($result);
} else {
    echo json_encode(['success' => false, 'message' => 'Missing required parameters.']);
}
