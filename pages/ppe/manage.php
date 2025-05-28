<!-- pages/ppe-management.php -->
<h2>PPE Management</h2>

<ul class="nav nav-tabs mb-3" id="ppeTabs" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="issue-tab" data-bs-toggle="tab" data-bs-target="#issue" type="button" role="tab">🎽 Issue & Expiry</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="inventory-tab" data-bs-toggle="tab" data-bs-target="#inventory" type="button" role="tab">📦 Inventory</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="request-tab" data-bs-toggle="tab" data-bs-target="#request" type="button" role="tab">📝 Request PPE</button>
  </li>
</ul>

<div class="tab-content border p-3 bg-white rounded shadow-sm" id="ppeTabsContent">
  <!-- Tab 1: Issue & Expiry -->
  <div class="tab-pane fade show active" id="issue" role="tabpanel">
    <h5>Track PPE Issuance & Expiry</h5>
    <form>
      <div class="mb-3">
        <label for="employee" class="form-label">Employee Name</label>
        <input type="text" class="form-control" id="employee" placeholder="e.g. John Doe">
      </div>
      <div class="mb-3">
        <label for="ppe_item" class="form-label">PPE Item</label>
        <input type="text" class="form-control" id="ppe_item" placeholder="e.g. Safety Helmet">
      </div>
      <div class="mb-3">
        <label for="issue_date" class="form-label">Issue Date</label>
        <input type="date" class="form-control" id="issue_date">
      </div>
      <div class="mb-3">
        <label for="expiry_date" class="form-label">Expiry Date</label>
        <input type="date" class="form-control" id="expiry_date">
      </div>
      <button type="submit" class="btn btn-primary">Record Issuance</button>
    </form>
  </div>

  <!-- Tab 2: Inventory -->
  <div class="tab-pane fade" id="inventory" role="tabpanel">
    <h5>PPE Inventory Overview</h5>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>PPE Item</th>
          <th>Stock Available</th>
          <th>Threshold</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <!-- Sample static data -->
        <tr>
          <td>Safety Helmet</td>
          <td>12</td>
          <td>10</td>
          <td><span class="badge bg-success">Sufficient</span></td>
        </tr>
        <tr>
          <td>Gloves</td>
          <td>5</td>
          <td>10</td>
          <td><span class="badge bg-warning text-dark">Low Stock</span></td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Tab 3: PPE Request Form -->
  <div class="tab-pane fade" id="request" role="tabpanel">
    <h5>PPE Request Form</h5>
    <form>
      <div class="mb-3">
        <label for="request_employee" class="form-label">Employee Name</label>
        <input type="text" class="form-control" id="request_employee">
      </div>
      <div class="mb-3">
        <label for="requested_ppe" class="form-label">PPE Needed</label>
        <input type="text" class="form-control" id="requested_ppe">
      </div>
      <div class="mb-3">
        <label for="request_reason" class="form-label">Reason</label>
        <textarea class="form-control" id="request_reason" rows="2"></textarea>
      </div>
      <button type="submit" class="btn btn-success">Submit Request</button>
    </form>
  </div>
</div>
