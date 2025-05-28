<!-- pages/risk-assessment.php -->
<h2>Risk Assessment</h2>

<ul class="nav nav-tabs mb-3" id="riskTabs" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="create-tab" data-bs-toggle="tab" data-bs-target="#create" type="button" role="tab">📝 Create Assessment</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="hazard-tab" data-bs-toggle="tab" data-bs-target="#hazard" type="button" role="tab">⚠️ Hazard Identification</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="control-tab" data-bs-toggle="tab" data-bs-target="#control" type="button" role="tab">🛡️ Control Measures</button>
  </li>
</ul>

<div class="tab-content border p-3 bg-white rounded shadow-sm" id="riskTabsContent">
  <div class="tab-pane fade show active" id="create" role="tabpanel">
    <h5>Create & Manage Risk Assessment</h5>
    <form>
      <div class="mb-3">
        <label for="assessment_title" class="form-label">Assessment Title</label>
        <input type="text" class="form-control" id="assessment_title" placeholder="e.g. Electrical Equipment Safety">
      </div>
      <div class="mb-3">
        <label for="assessment_area" class="form-label">Area/Location</label>
        <input type="text" class="form-control" id="assessment_area" placeholder="e.g. Workshop, Server Room">
      </div>
      <div class="mb-3">
        <label for="assessment_date" class="form-label">Date</label>
        <input type="date" class="form-control" id="assessment_date">
      </div>
      <button type="submit" class="btn btn-primary">Save Assessment</button>
    </form>
  </div>

  <div class="tab-pane fade" id="hazard" role="tabpanel">
    <h5>Hazard Identification & Risk Evaluation</h5>
    <form>
      <div class="mb-3">
        <label for="hazard_desc" class="form-label">Hazard Description</label>
        <textarea class="form-control" id="hazard_desc" rows="3" placeholder="e.g. Exposed wiring near workstations"></textarea>
      </div>
      <div class="mb-3">
        <label for="risk_level" class="form-label">Risk Level</label>
        <select class="form-select" id="risk_level">
          <option>Low</option>
          <option>Medium</option>
          <option>High</option>
          <option>Critical</option>
        </select>
      </div>
      <button type="submit" class="btn btn-warning">Add Hazard</button>
    </form>
  </div>

  <div class="tab-pane fade" id="control" role="tabpanel">
    <h5>Control Measures & Reassessment</h5>
    <form>
      <div class="mb-3">
        <label for="control_measures" class="form-label">Control Measures</label>
        <textarea class="form-control" id="control_measures" rows="3" placeholder="e.g. Replace wiring, install covers, schedule weekly checks"></textarea>
      </div>
      <div class="mb-3">
        <label for="reassessment_date" class="form-label">Next Reassessment Date</label>
        <input type="date" class="form-control" id="reassessment_date">
      </div>
      <button type="submit" class="btn btn-success">Save Measures</button>
    </form>
  </div>
</div>
