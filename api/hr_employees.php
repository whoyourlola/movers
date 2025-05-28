<?php
header('Content-Type: application/json');
require '../includes/config.php'; // Update to your config path

$token = "5|iS3lDEpHD8mMMWmUIpM8r5H8v52JuhxQFXWOZjE7decf6ee4";

try {
    $options = [
        "http" => [
            "header" => [
                "Accept: application/json",
                "Content-Type: application/json",
                "Authorization: Bearer $token"
            ],
            "method" => "GET"
        ]
    ];

    $context = stream_context_create($options);
    $json = file_get_contents("https://hr1.moverstaxi.com/api/v1/employees", false, $context);

    if ($json === FALSE) {
        throw new Exception("Unable to fetch employee data from API.");
    }

    $employees = json_decode($json, true);
    if (!is_array($employees)) {
        throw new Exception("Invalid JSON response.");
    }

    $stmt_insert_emp = $pdo->prepare("
        INSERT INTO employees (
            id, first_name, last_name, email, department, position,
            bdate, job_type, gender, status, contact, created_at, updated_at
        ) VALUES (
            :id, :first_name, :last_name, :email, :department, :position,
            :bdate, :job_type, :gender, :status, :contact, :created_at, :updated_at
        )
    ");

    $stmt_insert_user = $pdo->prepare("INSERT INTO users (emp_id,username, role) VALUES (:emp_id, :username, 'User')");

    $inserted = 0;
    $users_created = 0;
    $errors_skipped = 0;

    foreach ($employees as $emp) {
        try {
            // Insert employee
            $stmt_insert_emp->execute([
                ':id' => $emp['id'],
                ':first_name' => $emp['first_name'],
                ':last_name' => $emp['last_name'],
                ':email' => $emp['email'],
                ':department' => $emp['department'],
                ':position' => $emp['position'],
                ':bdate' => $emp['bdate'],
                ':job_type' => $emp['job_type'],
                ':gender' => $emp['gender'],
                ':status' => $emp['status'],
                ':contact' => $emp['contact'],
                ':created_at' => $emp['created_at'],
                ':updated_at' => $emp['updated_at']
            ]);
            $inserted++;
        } catch (PDOException $e) {
            $errors_skipped++; // Skip if employee already exists
        }

        try {
            // Insert user
            $stmt_insert_user->execute([
                ':emp_id' => $emp['id'],
                ':username' => $emp['email']
            ]);
            $users_created++;
        } catch (PDOException $e) {
            $errors_skipped++; // Skip if user already exists
        }
    }

    echo json_encode([
        'success' => true,
        'employees_inserted' => $inserted,
        'users_created' => $users_created,
        'skipped_due_to_errors' => $errors_skipped,
        'message' => "$inserted employees inserted, $users_created users created. $errors_skipped skipped due to duplicate or constraint errors."
    ]);

} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
