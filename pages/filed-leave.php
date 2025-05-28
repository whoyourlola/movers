<?php
include '../includes/config.php';

// Fetch leave requests by status
$approvedStmt = $pdo->query("
    SELECT lr.*, lt.name AS leave_type
    FROM leave_requests lr
    JOIN leave_types lt ON lr.leave_type_id = lt.id
    WHERE lr.status = 'Approved'
    ORDER BY lr.leave_date DESC
");
$approvedLeaves = $approvedStmt->fetchAll();

$disapprovedStmt = $pdo->query("
    SELECT lr.*, lt.name AS leave_type
    FROM leave_requests lr
    JOIN leave_types lt ON lr.leave_type_id = lt.id
    WHERE lr.status = 'Disapproved'
    ORDER BY lr.leave_date DESC
");
$disapprovedLeaves = $disapprovedStmt->fetchAll();

$pendingStmt = $pdo->query("
    SELECT lr.*, lt.name AS leave_type
    FROM leave_requests lr
    JOIN leave_types lt ON lr.leave_type_id = lt.id
    WHERE lr.status = 'Pending'
    ORDER BY lr.leave_date DESC
");
$pendingLeaves = $pendingStmt->fetchAll();
?>

<h2>Filed Leave Requests</h2>

<!-- Approved Requests Table -->
<h3>Approved Requests</h3>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Emp ID</th>
            <th>Leave Date</th>
            <th>Leave Type</th>
            <th>Reason</th>
            <th>Status</th>
            <th>Proof File</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($approvedLeaves as $leave): ?>
        <tr>
            <td><?= htmlspecialchars($leave['emp_id']) ?></td>
            <td><?= htmlspecialchars($leave['leave_date']) ?></td>
            <td><?= htmlspecialchars($leave['leave_type']) ?></td>
            <td><?= htmlspecialchars($leave['reason']) ?></td>
            <td>
                <span class="badge badge-success"><?= htmlspecialchars($leave['status']) ?></span>
            </td>
            <td>
                <?php if (!empty($leave['proof_file'])): ?>
                    <a href="/wemovers/<?= htmlspecialchars($leave['proof_file']) ?>" target="_blank">View File</a>
                <?php else: ?>
                    N/A
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Disapproved Requests Table -->
<h3>Disapproved Requests</h3>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Emp ID</th>
            <th>Leave Date</th>
            <th>Leave Type</th>
            <th>Reason</th>
            <th>Status</th>
            <th>Proof File</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($disapprovedLeaves as $leave): ?>
        <tr>
            <td><?= htmlspecialchars($leave['emp_id']) ?></td>
            <td><?= htmlspecialchars($leave['leave_date']) ?></td>
            <td><?= htmlspecialchars($leave['leave_type']) ?></td>
            <td><?= htmlspecialchars($leave['reason']) ?></td>
            <td>
                <span class="badge badge-danger"><?= htmlspecialchars($leave['status']) ?></span>
            </td>
            <td>
                <?php if (!empty($leave['proof_file'])): ?>
                    <a href="/wemovers/<?= htmlspecialchars($leave['proof_file']) ?>" target="_blank">View File</a>
                <?php else: ?>
                    N/A
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Pending Requests Table -->
<h3>Pending Requests</h3>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Emp ID</th>
            <th>Leave Date</th>
            <th>Leave Type</th>
            <th>Reason</th>
            <th>Status</th>
            <th>Proof File</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pendingLeaves as $leave): ?>
        <tr>
            <td><?= htmlspecialchars($leave['emp_id']) ?></td>
            <td><?= htmlspecialchars($leave['leave_date']) ?></td>
            <td><?= htmlspecialchars($leave['leave_type']) ?></td>
            <td><?= htmlspecialchars($leave['reason']) ?></td>
            <td>
                <span class="badge badge-warning"><?= htmlspecialchars($leave['status']) ?></span>
            </td>
            <td>
                <?php if (!empty($leave['proof_file'])): ?>
                    <a href="/wemovers/<?= htmlspecialchars($leave['proof_file']) ?>" target="_blank">View File</a>
                <?php else: ?>
                    N/A
                <?php endif; ?>
            </td>
            <td>
                <form method="POST" class="approval-form" data-leave-id="<?= $leave['id'] ?>" data-emp-id="<?= $leave['emp_id'] ?>" data-leave-type-id="<?= $leave['leave_type_id'] ?>" style="display:inline;">
                    <input type="hidden" name="status" value="Approved">
                    <button type="submit" class="btn btn-success btn-sm">Approve</button>
                </form>
                <form method="POST" class="approval-form" data-leave-id="<?= $leave['id'] ?>" data-emp-id="<?= $leave['emp_id'] ?>" data-leave-type-id="<?= $leave['leave_type_id'] ?>" style="display:inline;">
                    <input type="hidden" name="status" value="Disapproved">
                    <button type="submit" class="btn btn-danger btn-sm">Disapprove</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    // Handle form submissions for approving/disapproving leave
    $('.approval-form').on('submit', function(e) {
        e.preventDefault();

        const form = $(this);
        const leave_id = form.data('leave-id');
        const emp_id = form.data('emp-id');
        const leave_type_id = form.data('leave-type-id');
        const status = form.find('input[name="status"]').val();

        $.post('api/approve_leave.php', {
            leave_id: leave_id,
            emp_id: emp_id,
            leave_type_id: leave_type_id,
            status: status
        }, function(response) {
            const data = JSON.parse(response);
            if (data.success) {
                alert('Leave request ' + status + ' successfully!');
                location.reload();  // Reload page to update the table
            } else {
                alert('Error: ' + data.message);
            }
        });
    });
</script>
