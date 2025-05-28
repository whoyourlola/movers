<!-- pages/legal-compliance.php -->
<h2>Legal & Compliance</h2>

<ul class="nav nav-tabs mb-3" id="legalTabs" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="audit-tab" data-bs-toggle="tab" data-bs-target="#audit" type="button" role="tab">📁 Legal Audit Records</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="policies-tab" data-bs-toggle="tab" data-bs-target="#policies" type="button" role="tab">📚 Policies & Laws</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="compliance-tab" data-bs-toggle="tab" data-bs-target="#compliance" type="button" role="tab">✅ Compliance Tracker</button>
  </li>
</ul>

<div class="tab-content border p-3 bg-white rounded shadow-sm" id="legalTabsContent">
  <!-- Tab 1: Legal Audit Records -->
  <div class="tab-pane fade show active" id="audit" role="tabpanel">
    <h5>Maintain Legal Audit Records</h5>
    <form>
      <div class="mb-3">
        <label for="audit_title" class="form-label">Audit Title</label>
        <input type="text" class="form-control" id="audit_title">
      </div>
      <div class="mb-3">
        <label for="audit_date" class="form-label">Audit Date</label>
        <input type="date" class="form-control" id="audit_date">
      </div>
      <div class="mb-3">
        <label for="audit_file" class="form-label">Upload Audit Report</label>
        <input type="file" class="form-control" id="audit_file">
      </div>
      <button type="submit" class="btn btn-primary">Save Audit Record</button>
    </form>
  </div>

  <!-- Tab 2: Policies, Laws, Regulations -->
  <div class="tab-pane fade" id="policies" role="tabpanel">
    <h5>Store Policies, Laws & Regulations</h5>
    <form>
      <div class="mb-3">
        <label for="policy_name" class="form-label">Policy/Law Title</label>
        <input type="text" class="form-control" id="policy_name">
      </div>
      <div class="mb-3">
        <label for="policy_type" class="form-label">Type</label>
        <select class="form-select" id="policy_type">
          <option>Internal Policy</option>
          <option>Regulation</option>
          <option>Legal Requirement</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="policy_file" class="form-label">Upload Document</label>
        <input type="file" class="form-control" id="policy_file">
      </div>
      <button type="submit" class="btn btn-success">Upload Policy</button>
    </form>
  </div>

  <!-- Tab 3: Compliance Tracking -->
  <div class="tab-pane fade" id="compliance" role="tabpanel">
    <h5>Compliance Tracking & Reporting</h5>
    <form>
      <div class="mb-3">
        <label for="compliance_area" class="form-label">Compliance Area</label>
        <input type="text" class="form-control" id="compliance_area">
      </div>
      <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" id="status">
          <option>Compliant</option>
          <option>Pending</option>
          <option>Non-Compliant</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="remarks" class="form-label">Remarks</label>
        <textarea class="form-control" id="remarks" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-warning">Track Compliance</button>
    </form>
  </div>
</div>
