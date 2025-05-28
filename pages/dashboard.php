<?php
include '../includes/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}
?>

<h2 class="mb-4">Dashboard</h2>

<div class="row" id="dashboard-cards">
    <div class="col-md-3">
        <div class="card text-white bg-success mb-3">
            <div class="card-header">Attendance Today</div>
            <div class="card-body">
                <h5 class="card-title" id="attended">--</h5>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-primary mb-3">
            <div class="card-header">Expected Attendance</div>
            <div class="card-body">
                <h5 class="card-title" id="expected">--</h5>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning mb-3">
            <div class="card-header">Leave Today</div>
            <div class="card-body">
                <h5 class="card-title" id="leave">--</h5>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-danger mb-3">
            <div class="card-header">Late Today</div>
            <div class="card-body">
                <h5 class="card-title" id="late">--</h5>
            </div>
        </div>
    </div>
</div>

<script>
    
    $.getJSON('api/data.php', function(data) {
        let attended = 0, leave = 0, late = 0;
        const expected = data.length;

        data.forEach(person => {
            if (person.status === "Present") attended++;
            if (person.status === "Leave") leave++;
            if (person.status === "Late") late++;
        });

        $('#attended').text(attended);
        $('#expected').text(expected);
        $('#leave').text(leave);
        $('#late').text(late);
    });
</script>
<!-- Attendance Graph -->
<h4 class="mt-5">Attendance Trends</h4>
<canvas id="attendanceChart" height="100"></canvas>

<script>
    function fetchAttendanceTrend() {
        $.getJSON('api/data.php', function(data) {
            // Group attendance by date
            const summary = {};

            data.forEach(entry => {
                const date = entry.date;
                if (!summary[date]) {
                    summary[date] = { present: 0, leave: 0, late: 0 };
                }

                if (entry.status === "Present") summary[date].present++;
                if (entry.status === "Leave") summary[date].leave++;
                if (entry.status === "Late") summary[date].late++;
            });

            const sortedDates = Object.keys(summary).sort();
            const labels = sortedDates.slice(-30); // Show last 30 days (1 month)
            const presentData = labels.map(date => summary[date].present);
            const leaveData = labels.map(date => summary[date].leave);
            const lateData = labels.map(date => summary[date].late);

            renderChart(labels, presentData, leaveData, lateData);
        });
    }

    function renderChart(labels, presentData, leaveData, lateData) {
        const ctx = document.getElementById('attendanceChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Present',
                        data: presentData,
                        borderColor: 'green',
                        fill: false
                    },
                    {
                        label: 'Leave',
                        data: leaveData,
                        borderColor: 'orange',
                        fill: false
                    },
                    {
                        label: 'Late',
                        data: lateData,
                        borderColor: 'red',
                        fill: false
                    }
                ]
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Attendance Report (Last 30 Days)'
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Count'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    }

    fetchAttendanceTrend();
    
</script>

