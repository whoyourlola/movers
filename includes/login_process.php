<?php
include 'config.php';
session_start();

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_EMAIL);
$password = $_POST['password'];

if (!$username || !$password) {
    header("Location: login.php?error=1");
    exit();
}

try {
    $stmt = $pdo->prepare("SELECT id, password,role FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user) {
        if (empty($user['password'])) {
            // Generate password
            $newPassword = bin2hex(random_bytes(4));
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            $updateStmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
            $updateStmt->execute([$hashedPassword, $user['id']]);

            // Send via SMTP
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com'; // e.g., smtp.gmail.com
                $mail->SMTPAuth   = true;
                $mail->Username   = 'ramosbactol@gmail.com';
                $mail->Password   = 'knfaslhctrlsboev';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use TLS encryption
                $mail->Port       = 587; // Port 587 for TLS

                $mail->setFrom('no-reply@moverstaxi.com', 'Movers HR');
                $mail->addAddress($username);
                $mail->isHTML(false);
                $mail->Subject = 'Your Login Password';
                $mail->Body    = "Hi,\n\nYour login password is: $newPassword\n\nPlease login and change your password immediately.";

                $mail->send();
                header("Location: login.php?msg=Password sent to your email.");
            } catch (Exception $e) {
                error_log("Mailer Error: " . $mail->ErrorInfo);
                header("Location: login.php?error=mail" . $mail->ErrorInfo);
            }
            exit();
        }

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_type'] = $user['role'];
            header("Location: ../");
            exit();
        } else {
            header("Location: login.php?error=1");
            exit();
        }

    } else {
        header("Location: login.php?error=1");
        exit();
    }

} catch (PDOException $e) {
    error_log("Login error: " . $e->getMessage());
    die("A server error occurred. Please try again later.");
}
