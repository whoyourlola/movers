<?php
require_once 'includes/config.php';
if (!is_logged_in()) {
    header("Location: includes/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            overflow-x: hidden;
        }
        .sidebar {
            min-height: 100vh;
        }
        .content-area {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>
<body>

<div class="d-flex" style="min-height: 100vh;">
    <!-- Sidebar -->
    <div class="bg-white text-white p-3" style="width: 300px;">
        <?php include 'includes/navbar.php'; ?>
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1 p-3" style="background-color: rgb(36, 49, 84);">
        <div id="content-area" class="border rounded bg-white shadow-sm p-4">
            Loading...
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="assets/js/app.js"></script>
</body>
</html>
