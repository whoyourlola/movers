<?php
// Check if the user is logged in and user_type is set in session
$user_type = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : 'User'; // Default to 'User' if not set
?>
<style>
    .nav-link.text-dark:hover,
    .nav-link.text-dark:focus {
        background-color: #f8f9fa; /* Light gray hover effect */
        color: #000; /* Keep text dark */
    }

    .nav-link.active {
        background-color: #0d6efd !important; /* Bootstrap primary */
        color: #fff !important;
    }

    .nav .nav-link {
        border-radius: 0.375rem; /* rounded-md */
        transition: background-color 0.2s ease;
    }
</style>

<div class="d-flex flex-column flex-shrink-0 p-3 bg-white text-dark" style="width: 300px; height: 100vh;">
    <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <img src="logo_movers.jpg" alt="WeMovers Logo" style="height: 80px;">
    </a>

    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <!-- Dashboard Link -->
        <li class="nav-item">
            <a onclick="setActive(this); loadPage('dashboard')" class="nav-link text-dark" data-page="dashboard">🏠 Dashboard</a>
        </li>

        <!-- Attendance Section -->
        <li class="nav-item">
            <a class="nav-link text-dark" data-bs-toggle="collapse" href="#attendanceSubmenu" role="button" aria-expanded="false" aria-controls="attendanceSubmenu">
                📁 Attendance 
            </a>
            <div class="collapse" id="attendanceSubmenu">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                        <a onclick="setActive(this); loadPage('attendance')" class="nav-link text-dark" data-page="attendance-records">📄 Records</a>
                    </li>
                    <?php if ($user_type == 'admin'): ?>
                    <li class="nav-item">
                        <a onclick="setActive(this); loadPage('/attendance/adjustment')" class="nav-link text-dark" data-page="attendance-adjustment">✏️ Adjustment</a>
                    </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a onclick="setActive(this); loadPage('/attendance/report')" class="nav-link text-dark" data-page="attendance-report">📊 Report</a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Leave Filing Section -->
        <li class="nav-item">
            <a class="nav-link text-dark" data-bs-toggle="collapse" href="#leaveSubmenu" role="button" aria-expanded="false" aria-controls="leaveSubmenu">
                📝 Leave Filing
            </a>
            <div class="collapse" id="leaveSubmenu">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                        <a onclick="setActive(this); loadPage('leave-form')" class="nav-link text-dark" data-page="leave-form">🧾 Leave Form</a>
                    </li>
                    <li class="nav-item">
                        <a onclick="setActive(this); loadPage('filed-leave')" class="nav-link text-dark" data-page="filed-leave">📂 Filed Leave</a>
                    </li>
                    <li class="nav-item">
                        <a onclick="setActive(this); loadPage('leave-report')" class="nav-link text-dark" data-page="leave-report">📊 Leave Report</a>
                    </li>
                    <li class="nav-item">
                        <a onclick="setActive(this); loadPage('leave-balance')" class="nav-link text-dark" data-page="leave-balance">Leave Balance</a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Health & Safety Section -->
        <li class="nav-item">
            <a class="nav-link text-dark" data-bs-toggle="collapse" href="#healthSafetySubmenu" role="button" aria-expanded="false" aria-controls="healthSafetySubmenu">
                🛡️ Health & Safety
            </a>
            <div class="collapse" id="healthSafetySubmenu">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                        <a onclick="setActive(this); loadPage('incident/manage')" class="nav-link text-dark" data-page="incident-management">📋 Incident Management</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a onclick="setActive(this); loadPage('risk/manage')" class="nav-link text-dark" data-page="risk-assessment">⚠️ Risk Assessment</a>
                    </li>
                    <li class="nav-item">
                        <a onclick="setActive(this); loadPage('safety/manage')" class="nav-link text-dark" data-page="safety-audits">🔍 Safety Audits & Inspections</a>
                    </li>
                    <li class="nav-item">
                        <a onclick="setActive(this); loadPage('training/manage')" class="nav-link text-dark" data-page="training-certification">🎓 Training & Certification</a>
                    </li>
                    <li class="nav-item">
                        <a onclick="setActive(this); loadPage('ppe/manage')" class="nav-link text-dark" data-page="ppe-management">🧤 PPE Management</a>
                    </li>
                    <li class="nav-item">
                        <a onclick="setActive(this); loadPage('emergency/manage')" class="nav-link text-dark" data-page="emergency-preparedness">🚨 Emergency Preparedness</a>
                    </li>
                    <li class="nav-item">
                        <a onclick="setActive(this); loadPage('legal/manage')" class="nav-link text-dark" data-page="legal-compliance">📚 Legal & Compliance</a>
                    </li>
                    <li class="nav-item">
                        <a onclick="setActive(this); loadPage('health/manage')" class="nav-link text-dark" data-page="employee-health-records">🩺 Employee Health Records</a>
                    </li> -->
                </ul>
            </div>
        </li>
    </ul>

    <hr>
    <div>
        <a href="api/logout.php" class="btn btn-danger w-100">Logout</a>
    </div>
</div>

<script>
    // Handle active state
    function setActive(element) {
        document.querySelectorAll('.nav-link').forEach(link => {
            link.classList.remove('active');
        });
        element.classList.add('active');
    }
</script>
