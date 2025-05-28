<h2>Attendance</h2>

<!-- Filter Form -->
<form id="filter-form" class="mb-3">
    <div class="row">
        <div class="col-md-3">
            <label for="emp_id">Employee ID</label>
            <input type="text" class="form-control" id="emp_id" placeholder="Enter Emp ID">
        </div>
        <div class="col-md-3">
            <label for="date">Date</label>
            <input type="date" class="form-control" id="date">
        </div>
        <div class="col-md-3">
            <label for="ot_status">OT Status</label>
            <select class="form-control" id="ot_status">
                <option value="">Select OT Status</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>
        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </div>
</form>

<!-- Table for Attendance Data -->
<table class="table table-bordered" id="attendance-table">
    <thead>
        <tr>
            <th>EmpID</th>
            <th>Emp Name</th>
            <th>Time In</th>
            <th>Lunch Out</th>
            <th>Lunch In</th>
            <th>Time Out</th>
            <th>OT Status</th>
            <th>Date</th>
            <th>AI VER</th>
        </tr>
    </thead>
    <tbody>
        <!-- Data will be inserted here by JS -->
    </tbody>
</table>

<script>
    // Function to load the attendance data
    function loadAttendanceData() {
        // Get the filter values
        const emp_id = $('#emp_id').val();
        const date = $('#date').val() || new Date().toISOString().split('T')[0]; // Use today's date if no date is selected
        const ot_status = $('#ot_status').val();

        // Send a GET request to the API with the filter parameters
        $.getJSON('api/attendance_data.php', { emp_id: emp_id, date: date, ot_status: ot_status }, function(data) {
            let html = '';
            data.forEach(item => {
                html += `
                    <tr>
                        <td>${item.user_id}</td>
                        <td>${item.emp_name}</td>
                        <td>${item.time_in}</td>
                        <td>${item.lunch_out}</td>
                        <td>${item.lunch_in}</td>
                        <td>${item.time_out}</td>
                        <td>${item.ot_status}</td>
                        <td>${item.log_date}</td>
                        <td>${item.ai_ver}</td>
                    </tr>
                `;
            });

            // Update the table with the new rows
            $('#attendance-table tbody').html(html);
        });
    }

    // Call the loadAttendanceData function on page load
    $(document).ready(function() {
        loadAttendanceData(); // Load today's data initially

        // Reload the data when the filter form is submitted
        $('#filter-form').on('submit', function(e) {
            e.preventDefault();  // Prevent the default form submission
            loadAttendanceData();  // Reload the attendance data with filters
        });
    });
</script>

