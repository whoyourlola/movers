<?php
include '../includes/config.php';

$stmt = $pdo->query("SELECT emp_id, COUNT(*) AS total_leaves FROM leave_requests GROUP BY emp_id");
$report = $stmt->fetchAll();
?>

<h2>Leave Report</h2>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Emp ID</th>
            <th>Total Leaves Filed</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($report as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['emp_id']) ?></td>
            <td><?= $row['total_leaves'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
