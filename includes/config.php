<?php
session_start();

// Function to check if user is logged in
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

// Database connection settings
$host = 'localhost';
$db   = 'hr3_moversdb'; // Change this to your actual database name
$user = 'hr3_root1';
$pass = '123123';
$charset = 'utf8mb4';

// Data Source Name
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// PDO options for secure, consistent behavior
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

// Create PDO instance (your DB connection)
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}
?>
