<!-- pages/training-certification.php -->
<h2>Training & Certification</h2>

<ul class="nav nav-tabs mb-3" id="trainingTabs" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="track-tab" data-bs-toggle="tab" data-bs-target="#track" type="button" role="tab">📊 Track Training</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="reminders-tab" data-bs-toggle="tab" data-bs-target="#reminders" type="button" role="tab">⏰ Reminders</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="upload-tab" data-bs-toggle="tab" data-bs-target="#upload" type="button" role="tab">📁 Upload Materials</button>
  </li>
</ul>

<div class="tab-content border p-3 bg-white rounded shadow-sm" id="trainingTabsContent">
  <!-- Tab 1: Track Training -->
  <div class="tab-pane fade show active" id="track" role="tabpanel">
    <h5>Track Employee Training</h5>
    <form>
      <div class="mb-3">
        <label for="employee_name" class="form-label">Employee Name</label>
        <input type="text" class="form-control" id="employee_name" placeholder="e.g. Jane Smith">
      </div>
      <div class="mb-3">
        <label for="training_title" class="form-label">Training Title</label>
        <input type="text" class="form-control" id="training_title" placeholder="e.g. Fire Safety Level 2">
      </div>
      <div class="mb-3">
        <label for="training_date" class="form-label">Training Date</label>
        <input type="date" class="form-control" id="training_date">
      </div>
      <div class="mb-3">
        <label for="valid_until" class="form-label">Valid Until</label>
        <input type="date" class="form-control" id="valid_until">
      </div>
      <button type="submit" class="btn btn-primary">Record Training</button>
    </form>
  </div>

  <!-- Tab 2: Reminders -->
  <div class="tab-pane fade" id="reminders" role="tabpanel">
    <h5>Upcoming Expirations</h5>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Employee</th>
          <th>Training</th>
          <th>Valid Until</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <!-- Example static data, can be made dynamic -->
        <tr>
          <td>John Doe</td>
          <td>First Aid</td>
          <td>2025-06-01</td>
          <td><span class="badge bg-warning text-dark">Expiring Soon</span></td>
        </tr>
        <tr>
          <td>Jane Smith</td>
          <td>Fire Drill</td>
          <td>2024-12-30</td>
          <td><span class="badge bg-danger">Expired</span></td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Tab 3: Upload Materials -->
  <div class="tab-pane fade" id="upload" role="tabpanel">
    <h5>Upload Training Materials & Attendance</h5>
    <form enctype="multipart/form-data">
      <div class="mb-3">
        <label for="material_title" class="form-label">Material Title</label>
        <input type="text" class="form-control" id="material_title" placeholder="e.g. Forklift Operation Manual">
      </div>
      <div class="mb-3">
        <label for="material_file" class="form-label">Upload File</label>
        <input type="file" class="form-control" id="material_file">
      </div>
      <div class="mb-3">
        <label for="attendance_log" class="form-label">Attendance Log</label>
        <input type="file" class="form-control" id="attendance_log">
      </div>
      <button type="submit" class="btn btn-success">Upload</button>
    </form>
  </div>
</div>
