<!-- pages/employee-health.php -->
<h2>Employee Health Records <small class="text-muted">(Confidential)</small></h2>

<ul class="nav nav-tabs mb-3" id="healthTabs" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="occupational-tab" data-bs-toggle="tab" data-bs-target="#occupational" type="button" role="tab">🩺 Occupational Records</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="checkups-tab" data-bs-toggle="tab" data-bs-target="#checkups" type="button" role="tab">💉 Checkups & Vaccinations</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="fitness-tab" data-bs-toggle="tab" data-bs-target="#fitness" type="button" role="tab">✅ Fitness Logs</button>
  </li>
</ul>

<div class="tab-content border p-3 bg-white rounded shadow-sm" id="healthTabsContent">
  <!-- Tab 1: Occupational Records -->
  <div class="tab-pane fade show active" id="occupational" role="tabpanel">
    <h5>Occupational Health Records</h5>
    <form>
      <div class="mb-3">
        <label for="emp_id_occu" class="form-label">Employee ID</label>
        <input type="text" class="form-control" id="emp_id_occu">
      </div>
      <div class="mb-3">
        <label for="record_type" class="form-label">Record Type</label>
        <select class="form-select" id="record_type">
          <option>Initial Assessment</option>
          <option>Workplace Exposure</option>
          <option>Incident Follow-up</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="health_doc" class="form-label">Upload Document</label>
        <input type="file" class="form-control" id="health_doc">
      </div>
      <button type="submit" class="btn btn-primary">Save Record</button>
    </form>
  </div>

  <!-- Tab 2: Checkups & Vaccinations -->
  <div class="tab-pane fade" id="checkups" role="tabpanel">
    <h5>Medical Checkups & Vaccinations</h5>
    <form>
      <div class="mb-3">
        <label for="emp_id_checkup" class="form-label">Employee ID</label>
        <input type="text" class="form-control" id="emp_id_checkup">
      </div>
      <div class="mb-3">
        <label for="checkup_type" class="form-label">Checkup/Vaccine</label>
        <input type="text" class="form-control" id="checkup_type">
      </div>
      <div class="mb-3">
        <label for="checkup_date" class="form-label">Date</label>
        <input type="date" class="form-control" id="checkup_date">
      </div>
      <div class="mb-3">
        <label for="checkup_doc" class="form-label">Upload Proof</label>
        <input type="file" class="form-control" id="checkup_doc">
      </div>
      <button type="submit" class="btn btn-success">Add Record</button>
    </form>
  </div>

  <!-- Tab 3: Fitness for Duty Logs -->
  <div class="tab-pane fade" id="fitness" role="tabpanel">
    <h5>Fitness for Duty Logs</h5>
    <form>
      <div class="mb-3">
        <label for="emp_id_fitness" class="form-label">Employee ID</label>
        <input type="text" class="form-control" id="emp_id_fitness">
      </div>
      <div class="mb-3">
        <label for="assessment_date" class="form-label">Assessment Date</label>
        <input type="date" class="form-control" id="assessment_date">
      </div>
      <div class="mb-3">
        <label for="fitness_status" class="form-label">Status</label>
        <select class="form-select" id="fitness_status">
          <option>Fit</option>
          <option>Fit with Restrictions</option>
          <option>Unfit</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="fitness_doc" class="form-label">Upload Certificate</label>
        <input type="file" class="form-control" id="fitness_doc">
      </div>
      <button type="submit" class="btn btn-warning">Log Fitness</button>
    </form>
  </div>
</div>
