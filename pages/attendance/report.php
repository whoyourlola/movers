<div class="container mt-5">
    <h3>Attendance Report</h3>
    <div class="row mb-3">
        <div class="col-md-3">
            <label>Start Date</label>
            <input type="date" id="startDate" class="form-control">
        </div>
        <div class="col-md-3">
            <label>End Date</label>
            <input type="date" id="endDate" class="form-control">
        </div>
        <div class="col-md-6 align-self-end">
            <button class="btn btn-primary" id="loadEmployees">Load Employees</button>
        </div>
    </div>

    <table class="table table-bordered" id="employeeTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="reportModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Attendance Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <table class="table table-sm table-bordered" id="reportTable">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                            <th>Total Hours (8–5)</th>
                            <th>Lates (mins)</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                        <tr class="fw-bold">
                            <td colspan="3">Summary</td>
                            <td id="totalHours">0</td>
                            <td id="totalLates">0</td>
                        </tr>
                        <tr class="fw-bold">
                            <td colspan="5" id="totalAbsences">Absences: 0</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
if (typeof window.loadEmployeesList !== 'function') {
    window.loadEmployeesList = function () {
        const from = $('#startDate').val();
        const to = $('#endDate').val();

        if (!from || !to) return alert("Please select both start and end dates.");

        $.getJSON(`api/employee_list.php?start=${from}&end=${to}`, function(data) {
            const tbody = $('#employeeTable tbody').empty();
            if (data.length === 0) {
                tbody.append('<tr><td colspan="2" class="text-center">No employees found for the selected dates.</td></tr>');
                return;
            }
            data.forEach(emp => {
                const fullName = `${emp.first_name} ${emp.last_name}`;
                tbody.append(`
                    <tr>
                        <td>${fullName}</td>
                        <td><button class="btn btn-sm btn-info" onclick="viewReport(${emp.emp_id}, '${fullName}')">View Report</button></td>
                    </tr>
                `);
            });
        });
    };
}

if (typeof window.viewReport !== 'function') {
    window.viewReport = function (emp_id, name) {
        const start = $('#startDate').val();
        const end = $('#endDate').val();
        if (!start || !end) return alert("Please select start and end dates.");

        $.getJSON(`api/attendance_summary.php?emp_id=${emp_id}&start=${start}&end=${end}`, function(response) {
            const tbody = $('#reportTable tbody').empty();
            let totalHours = 0, totalLates = 0;
            console.log(response.sql); // Optional for debugging
            response.logs.forEach(log => {
                totalHours += parseFloat(log.hours_worked);
                totalLates += parseInt(log.late_mins);
                tbody.append(`
                    <tr>
                        <td>${log.date}</td>
                        <td>${log.time_in}</td>
                        <td>${log.time_out}</td>
                        <td>${log.hours_worked}</td>
                        <td>${log.late_mins}</td>
                    </tr>
                `);
            });

            $('#totalHours').text(totalHours.toFixed(2));
            $('#totalLates').text(totalLates);
            $('#totalAbsences').text('Absences: ' + response.absences);
            $('#reportModal .modal-title').text(`Attendance Report for ${name}`);
            $('#reportModal').modal('show');
        });
    };
}

$('#loadEmployees').off('click').on('click', loadEmployeesList);
</script>
