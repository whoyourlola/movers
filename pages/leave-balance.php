<div class="container mt-4">
    <h3>Manage Leave Balances</h3>
    <div class="input-group mb-3">
        <input type="number" id="empIdInput" class="form-control" placeholder="Enter Employee ID">
        <button class="btn btn-primary" onclick="loadEmployee()">Search</button>
    </div>

    <div id="employeeInfo" class="mb-3"></div>

    <form id="balanceForm" style="display: none;">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Leave Type</th>
                    <th>Description</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody id="leaveBalanceRows"></tbody>
        </table>
        <button type="submit" class="btn btn-success">Save Balances</button>
    </form>
</div>

<script>
function loadEmployee() {
    const empId = $('#empIdInput').val();
    if (!empId) return alert("Please enter an employee ID.");

    $.get(`api/leave-balance.php?emp_id=${empId}`, function(res) {
        const data = res;

        if (data.error) {
            $('#employeeInfo').html('<div class="alert alert-danger">' + data.error + '</div>');
            $('#balanceForm').hide();
            return;
        }

        const emp = data.employee;
        $('#employeeInfo').html(`<strong>${emp.first_name} ${emp.last_name}</strong> - ${emp.department}`);
        $('#leaveBalanceRows').empty();

        const existing = {};
        data.balances.forEach(b => {
            existing[b.leave_type_id] = b.balance;
        });

        data.types.forEach(type => {
            $('#leaveBalanceRows').append(`
                <tr>
                    <td>${type.name}</td>
                    <td>${type.description}</td>
                    <td>
                        <input type="number" step="0.5" class="form-control" name="balance[${type.id}]" value="${existing[type.id] ?? 0}">
                    </td>
                </tr>
            `);
        });

        $('#balanceForm').show().data('emp-id', empId);
    });
}

$('#balanceForm').on('submit', function(e) {
    e.preventDefault();
    const emp_id = $(this).data('emp-id');
    const balances = [];

    $(this).find('input[name^="balance"]').each(function() {
        const leave_type_id = $(this).attr('name').match(/\[(\d+)\]/)[1];
        balances.push({ leave_type_id, balance: parseFloat($(this).val()) });
    });

    $.post('api/leave-balance.php', { emp_id, balances }, function(res) {
        if (res.success) {
            alert("Leave balances saved!");
        } else if (res.error) {
            alert("Error: " + res.error);
        }
    });
});
</script>
