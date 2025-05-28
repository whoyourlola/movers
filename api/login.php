<?php
header('Content-Type: application/json');
include '../includes/config.php';
require '../includes/PHPMailer/src/PHPMailer.php';
require '../includes/PHPMailer/src/SMTP.php';
require '../includes/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Parse JSON input
$input = json_decode(file_get_contents("php://input"), true);
$username = filter_var($input['username'] ?? '', FILTER_SANITIZE_EMAIL);
$password = $input['password'] ?? '';

// Validate input
if (!$username || !$password) {
    echo json_encode(['status' => 'fail', 'message' => 'Username and password required.']);
    exit();
}

try {
    $stmt = $pdo->prepare("SELECT 
    u.emp_id,u.id, u.username, u.password, u.role,
    e.first_name, e.last_name
FROM 
    users u
LEFT JOIN 
    employees_hr1 e ON u.emp_id = e.id
WHERE 
    u.username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo json_encode(['status' => 'fail', 'message' => 'User not found.']);
        exit();
    }

    if (empty($user['password'])) {
        // Generate and hash a new password
        $newPassword = bin2hex(random_bytes(4));
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update password in DB
        $updateStmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
        $updateStmt->execute([$hashedPassword, $user['id']]);

        // Send password via email
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'ramosbactol@gmail.com'; // SMTP user
            $mail->Password   = 'knfaslhctrlsboev';      // App password (do NOT hardcode in production)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('no-reply@moverstaxi.com', 'Movers HR');
            $mail->addAddress($user['username']);
            $mail->isHTML(false);
            $mail->Subject = 'Your Login Password';
            $mail->Body    = "Hi,\n\nYour login password is: $newPassword\n\nPlease login and change your password immediately.";

            $mail->send();

            echo json_encode([
                'status' => 'email_sent',
                'message' => 'A new password has been sent to your email.',
                'data' => [
                    'id' => $user['id'],
                    'emp_id' => $user['emp_id'],
                    'username' => $user['username'],
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name'],
                    'role' => $user['role']
                ]
            ]);
            exit();
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'fail',
                'message' => 'Failed to send email: ' . $mail->ErrorInfo
            ]);
            exit();
        }
    }

    // Normal login
    if (password_verify($password, $user['password'])) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Login successful.',
            'data' => [
                'id' => $user['id'],
                'emp_id' => $user['emp_id'],
                'username' => $user['username'],
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'role' => $user['role']
            ]
        ]);
    } else {
        echo json_encode(['status' => 'fail', 'message' => 'Invalid password.']);
    }

} catch (PDOException $e) {
    echo json_encode(['status' => 'fail', 'message' => 'Server error: ' . $e->getMessage()]);
}
?>
