<?php
include '../includes/config.php';

$emp_id = '3'; // Normally from session

// Fetch leave types and balances
$stmt = $pdo->prepare("
    SELECT lt.id, lt.name, lb.balance 
    FROM leave_types lt 
    LEFT JOIN leave_balances lb 
        ON lt.id = lb.leave_type_id AND lb.emp_id = ?
");
$stmt->execute([$emp_id]);
$leaveTypes = $stmt->fetchAll();
?>

<h2>Leave Filing Form</h2>

<form method="POST" action="api/leave-submit.php" class="mb-4" enctype="multipart/form-data">
    <input type="hidden" name="emp_id" value="<?= $emp_id ?>">
    
    <div class="mb-3">
        <label for="leave_type" class="form-label">Leave Type</label>
        <select name="leave_type_id" id="leave_type" class="form-select" required>
            <option value="">-- Select Type --</option>
            <?php foreach ($leaveTypes as $type): ?>
                <option value="<?= $type['id'] ?>" data-name="<?= strtolower($type['name']) ?>">
                    <?= $type['name'] ?> (<?= $type['balance'] ?? 0 ?> days left)
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3" id="sick-proof-div" style="display: none;">
        <label for="sick_proof" class="form-label">Upload Medical Certificate (PDF/IMG)</label>
        <input type="file" class="form-control" id="sick_proof" name="sick_proof" accept=".jpg,.jpeg,.png,.pdf">
    </div>

    <div class="mb-3">
        <label for="leave_date" class="form-label">Leave Date</label>
        <input type="date" class="form-control" id="leave_date" name="leave_date" required>
    </div>

    <div class="mb-3">
        <label for="reason" class="form-label">Reason</label>
        <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary">File Leave</button>
</form>

<script>
    document.getElementById('leave_type').addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const leaveName = selectedOption.getAttribute('data-name');
        const proofDiv = document.getElementById('sick-proof-div');
        proofDiv.style.display = (leaveName === 'sick') ? 'block' : 'none';
    });
</script>

