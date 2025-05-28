<?php
include '../../includes/config.php'; // Database connection
?>
<!-- Filter Form -->
<form id="filter-form" class="mb-3">
    <div class="row">
        <div class="col-md-3">
            <label for="emp_id">Employee ID</label>
            <input type="text" class="form-control" id="emp_id" placeholder="Enter Emp ID">
        </div>
        <div class="col-md-3">
            <label for="from_date">From Date</label>
            <input type="date" class="form-control" id="from_date">
        </div>
        <div class="col-md-3">
            <label for="to_date">To Date</label>
            <input type="date" class="form-control" id="to_date">
        </div>
        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </div>
</form>

<!-- Attendance Table -->
<table class="table table-bordered" id="attendance-table">
    <thead>
        <tr>
            <th>EmpID</th>
            <th>Emp Name</th>
            <th>Time In</th>
            <th>Lunch Out</th>
            <th>Lunch In</th>
            <th>Time Out</th>
            <th>Log Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <!-- Data populated by JS -->
    </tbody>
</table>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function loadAttendanceData() {
    const emp_id = $('#emp_id').val();
    const from_date = $('#from_date').val();
    const to_date = $('#to_date').val();

    $.getJSON('api/attendance_data_adjustment.php', {
        emp_id: emp_id,
        date_from: from_date,
        date_to: to_date
    }, function(data) {
        let html = '';
        data.forEach(item => {
            html += `
                <tr data-userid="${item.user_id}">
                    <td>${item.user_id}</td>
                    <td>${item.emp_name}</td>
                    <td><input type="time" class="form-control" value="${item.time_in}" data-id="${item.maxtime_in_id}" data-field="time_in"></td>
                    <td><input type="time" class="form-control" value="${item.lunch_out}" data-id="${item.maxtime_lunch_out_id}" data-field="lunch_out"></td>
                    <td><input type="time" class="form-control" value="${item.lunch_in}" data-id="${item.maxtime_lunch_in_id}" data-field="lunch_in"></td>
                    <td><input type="time" class="form-control" value="${item.time_out}" data-id="${item.maxtime_out_id}" data-field="time_out"></td>
                    <td>${item.log_date}</td>
                    <td><button class="btn btn-success save-btn">Save</button></td>
                </tr>
            `;
        });
        $('#attendance-table tbody').html(html);
    });
}

// Save button click handler
$(document).on('click', '.save-btn', function() {
    
    const row = $(this).closest('tr');
    const user_id = row.data('userid'); // from <tr data-userid="">
    const time_in = row.find("input[data-field='time_in']").val();
    const time_in_id = row.find("input[data-field='time_in']").data('id');

    const lunch_out = row.find("input[data-field='lunch_out']").val();
    const lunch_out_id = row.find("input[data-field='lunch_out']").data('id');

    const lunch_in = row.find("input[data-field='lunch_in']").val();
    const lunch_in_id = row.find("input[data-field='lunch_in']").data('id');

    const time_out = row.find("input[data-field='time_out']").val();
    const time_out_id = row.find("input[data-field='time_out']").data('id');
    const log_date = row.find('td:nth-child(7)').text();
        if (!user_id) {
            alert("Error: User ID is missing.");
            return; // Exit if user_id is not present
        }
    // Debug check
    console.log({user_id,
        time_in_id, time_in,
        lunch_out_id, lunch_out,
        lunch_in_id, lunch_in,
        time_out_id, time_out,log_date
    });
    
    // POST update
    $.post('api/update_attendance.php', {
        user_id, // required for insert
        time_in_id, time_in,
        lunch_out_id, lunch_out,
        lunch_in_id, lunch_in,
        time_out_id, time_out,log_date
    }, function(response) {
        if (response.success) {
            alert("Attendance updated successfully.");
            loadAttendanceData();
        } else {
            alert("Error: " + response.message);
        }
    }, 'json');
});

$(document).ready(function() {
    loadAttendanceData();
    $('#filter-form').on('submit', function(e) {
        e.preventDefault();
        loadAttendanceData();
    });
});
</script>
