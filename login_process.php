<?php
require_once 'includes/config.php';

$user = $_POST['username'];
$pass = $_POST['password'];

if ($user === 'admin' && $pass === 'password') {
    $_SESSION['user'] = $user;
    $_SESSION['userid'] = 1001;
    header("Location: ../index.php");
} else {
    header("Location: includes/login.php?error=1");
}
