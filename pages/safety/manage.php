<!-- pages/safety-audits.php -->
<h2>Safety Audits & Inspections</h2>

<ul class="nav nav-tabs mb-3" id="auditTabs" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="schedule-tab" data-bs-toggle="tab" data-bs-target="#schedule" type="button" role="tab">📅 Schedule Inspection</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="checklist-tab" data-bs-toggle="tab" data-bs-target="#checklist" type="button" role="tab">📋 Upload Checklist</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="actions-tab" data-bs-toggle="tab" data-bs-target="#actions" type="button" role="tab">✅ Assign Actions</button>
  </li>
</ul>

<div class="tab-content border p-3 bg-white rounded shadow-sm" id="auditTabsContent">
  <!-- Tab 1: Schedule Inspection -->
  <div class="tab-pane fade show active" id="schedule" role="tabpanel">
    <h5>Schedule Site Inspection</h5>
    <form>
      <div class="mb-3">
        <label for="inspection_site" class="form-label">Site/Area</label>
        <input type="text" class="form-control" id="inspection_site" placeholder="e.g. Warehouse, Plant 2">
      </div>
      <div class="mb-3">
        <label for="inspection_date" class="form-label">Inspection Date</label>
        <input type="date" class="form-control" id="inspection_date">
      </div>
      <div class="mb-3">
        <label for="inspector_name" class="form-label">Inspector</label>
        <input type="text" class="form-control" id="inspector_name" placeholder="e.g. John Doe">
      </div>
      <button type="submit" class="btn btn-primary">Schedule</button>
    </form>
  </div>

  <!-- Tab 2: Upload Checklist -->
  <div class="tab-pane fade" id="checklist" role="tabpanel">
    <h5>Upload Inspection Checklist & Findings</h5>
    <form enctype="multipart/form-data">
      <div class="mb-3">
        <label for="checklist_title" class="form-label">Checklist Title</label>
        <input type="text" class="form-control" id="checklist_title" placeholder="e.g. Monthly Safety Checklist">
      </div>
      <div class="mb-3">
        <label for="checklist_file" class="form-label">Upload Checklist File</label>
        <input type="file" class="form-control" id="checklist_file">
      </div>
      <div class="mb-3">
        <label for="findings" class="form-label">Findings</label>
        <textarea class="form-control" id="findings" rows="3" placeholder="e.g. Blocked emergency exits, missing PPE..."></textarea>
      </div>
      <button type="submit" class="btn btn-warning">Upload</button>
    </form>
  </div>

  <!-- Tab 3: Assign Actions -->
  <div class="tab-pane fade" id="actions" role="tabpanel">
    <h5>Assign Follow-Up Actions</h5>
    <form>
      <div class="mb-3">
        <label for="action_description" class="form-label">Action Description</label>
        <input type="text" class="form-control" id="action_description" placeholder="e.g. Clear fire exit path">
      </div>
      <div class="mb-3">
        <label for="assigned_to" class="form-label">Assign To</label>
        <input type="text" class="form-control" id="assigned_to" placeholder="e.g. Maintenance Team">
      </div>
      <div class="mb-3">
        <label for="due_date" class="form-label">Due Date</label>
        <input type="date" class="form-control" id="due_date">
      </div>
      <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" id="status">
          <option value="Pending">Pending</option>
          <option value="In Progress">In Progress</option>
          <option value="Completed">Completed</option>
        </select>
      </div>
      <button type="submit" class="btn btn-success">Save Action</button>
    </form>
  </div>
</div>
