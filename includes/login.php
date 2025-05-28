<?php include 'config.php'; 

// echo password_hash('admin123', PASSWORD_DEFAULT);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <!-- Logo -->
    <a href="#" class="d-flex align-items-center mb-3 mb-md-4 text-dark text-decoration-none justify-content-center">
        <img src="../logo_movers.jpg" alt="WeMovers Logo" style="height: 120px;">
    </a>

    <h2 class="text-center">Login</h2>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger">Invalid credentials.</div>
    <?php endif; ?>

    <form action="login_process.php" method="post" class="mx-auto" style="max-width: 400px;">
        <input name="username" class="form-control mb-2" placeholder="Username" required>
        <input name="password" type="password" class="form-control mb-2" placeholder="Password" required>
        <button class="btn btn-primary w-100">Login</button>
    </form>
</body>
</html>
