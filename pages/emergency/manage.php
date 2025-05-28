<!-- pages/emergency-preparedness.php -->
<h2>Emergency Preparedness</h2>

<ul class="nav nav-tabs mb-3" id="emergencyTabs" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="contacts-tab" data-bs-toggle="tab" data-bs-target="#contacts" type="button" role="tab">📞 Contacts & Procedures</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="drills-tab" data-bs-toggle="tab" data-bs-target="#drills" type="button" role="tab">🚨 Drill Logs</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="firstaid-tab" data-bs-toggle="tab" data-bs-target="#firstaid" type="button" role="tab">🩺 First-aid & Evacuation</button>
  </li>
</ul>

<div class="tab-content border p-3 bg-white rounded shadow-sm" id="emergencyTabsContent">
  <!-- Tab 1: Emergency Contacts & Procedures -->
  <div class="tab-pane fade show active" id="contacts" role="tabpanel">
    <h5>Emergency Contacts & Procedures</h5>
    <form>
      <div class="mb-3">
        <label for="contact_name" class="form-label">Contact Name</label>
        <input type="text" class="form-control" id="contact_name">
      </div>
      <div class="mb-3">
        <label for="contact_number" class="form-label">Contact Number</label>
        <input type="tel" class="form-control" id="contact_number">
      </div>
      <div class="mb-3">
        <label for="emergency_role" class="form-label">Role/Responsibility</label>
        <input type="text" class="form-control" id="emergency_role">
      </div>
      <div class="mb-3">
        <label for="procedure_file" class="form-label">Upload Procedure Document</label>
        <input type="file" class="form-control" id="procedure_file">
      </div>
      <button type="submit" class="btn btn-primary">Save Contact & Procedure</button>
    </form>
  </div>

  <!-- Tab 2: Drill Logs -->
  <div class="tab-pane fade" id="drills" role="tabpanel">
    <h5>Drill Logs & Evaluations</h5>
    <form>
      <div class="mb-3">
        <label for="drill_type" class="form-label">Drill Type</label>
        <select class="form-select" id="drill_type">
          <option value="fire">Fire Drill</option>
          <option value="earthquake">Earthquake Drill</option>
          <option value="evacuation">Evacuation Drill</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="drill_date" class="form-label">Date Conducted</label>
        <input type="date" class="form-control" id="drill_date">
      </div>
      <div class="mb-3">
        <label for="evaluation" class="form-label">Evaluation/Notes</label>
        <textarea class="form-control" id="evaluation" rows="3"></textarea>
      </div>
      <div class="mb-3">
        <label for="drill_file" class="form-label">Upload Log (PDF, DOC)</label>
        <input type="file" class="form-control" id="drill_file">
      </div>
      <button type="submit" class="btn btn-success">Submit Drill Record</button>
    </form>
  </div>

  <!-- Tab 3: First-aid & Evacuation Plans -->
  <div class="tab-pane fade" id="firstaid" role="tabpanel">
    <h5>First-aid & Evacuation Plans</h5>
    <form>
      <div class="mb-3">
        <label for="plan_title" class="form-label">Plan Title</label>
        <input type="text" class="form-control" id="plan_title">
      </div>
      <div class="mb-3">
        <label for="plan_type" class="form-label">Type</label>
        <select class="form-select" id="plan_type">
          <option>First-aid Plan</option>
          <option>Evacuation Plan</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="plan_file" class="form-label">Upload Plan Document</label>
        <input type="file" class="form-control" id="plan_file">
      </div>
      <button type="submit" class="btn btn-info">Upload Plan</button>
    </form>
  </div>
</div>
