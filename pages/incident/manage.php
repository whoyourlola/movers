
<!-- HTML PART -->
<h2>Incident Management</h2>
<div id="messageBox"></div>

<ul class="nav nav-tabs mb-3" id="incidentTabs" role="tablist">
  <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#report">📋 Report Incident</button></li>
  <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#rootcause">🔍 Root Cause Analysis</button></li>
  <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#attachments">📎 Attachments</button></li>
  <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#status">✅ Status & Actions</button></li>
</ul>

<div class="tab-content border p-3 bg-white rounded shadow-sm" id="incidentTabsContent">
  <!-- Report -->
  <div class="tab-pane fade show active" id="report">
    <form id="formReport">
      <input type="hidden" name="action" value="submit_report">
      <div class="mb-3">
        <label class="form-label">Incident Type</label>
        <input type="text" name="incident_type" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="incident_description" class="form-control" rows="3" required></textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Date & Time</label>
        <input type="datetime-local" name="incident_date" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary">Submit Report</button>
    </form>
  </div>

  <!-- Root Cause -->
  <div class="tab-pane fade" id="rootcause">
    <form id="formRootCause">
      <input type="hidden" name="action" value="submit_rootcause">
      <div class="mb-3">
        <label class="form-label">Incident ID</label>
        <input type="number" name="incident_id_root" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Identify Root Cause</label>
        <textarea name="root_cause" class="form-control" rows="4" required></textarea>
      </div>
      <button type="submit" class="btn btn-success">Save Analysis</button>
    </form>
  </div>

  <!-- Attachments -->
  <div class="tab-pane fade" id="attachments">
    <form id="formAttachment" enctype="multipart/form-data">
      <input type="hidden" name="action" value="submit_attachment">
      <div class="mb-3">
        <label class="form-label">Incident ID</label>
        <input type="number" name="incident_id_attach" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Upload Image or File</label>
        <input type="file" name="incident_file" class="form-control">
      </div>
      <div class="mb-3">
        <label class="form-label">Witness Statement</label>
        <textarea name="witness_statement" class="form-control" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-secondary">Upload</button>
    </form>
  </div>

  <!-- Status -->
  <div class="tab-pane fade" id="status">
    <form id="formStatus">
      <input type="hidden" name="action" value="submit_status">
      <div class="mb-3">
        <label class="form-label">Incident ID</label>
        <input type="number" name="incident_id_status" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="incident_status" class="form-select">
          <option value="Open">Open</option>
          <option value="In Progress">In Progress</option>
          <option value="Resolved">Resolved</option>
          <option value="Closed">Closed</option>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Corrective Action</label>
        <textarea name="corrective_action" class="form-control" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-info">Update Status</button>
    </form>
  </div>
</div>

<h3 class="mt-4">📋 All Reported Incidents</h3>
<div class="table-responsive">
  <table class="table table-bordered table-striped" id="incidentTable">
    <thead class="table-light">
      <tr>
        <th>ID</th>
        <th>Type</th>
        <th>Description</th>
        <th>Date & Time</th>
        <th>Root Cause</th>
        <th>Attachment</th>
        <th>Witness Statement</th>
        <th>Status</th>
        <th>Corrective Action</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>
</div>
<!-- jQuery + AJAX Script -->
<script>
function loadIncidentRecords() {
  fetch('api/incident_handler_fetch.php?action=fetch_all')
 .then(res => res.json())
 .then(data => {
   console.log(data); // Log data to the console for debugging

   const tbody = document.querySelector('#incidentTable tbody');
   tbody.innerHTML = '';

   if (data.status === 'success' && data.records.length > 0) {
     data.records.forEach(inc => {
       const row = `
         <tr>
           <td>${inc.incident_id}</td>
           <td>${inc.incident_type || '-'}</td>
           <td>${inc.description || '-'}</td>
           <td>${inc.incident_datetime || '-'}</td>
           <td>${inc.root_cause || '-'}</td>
           <td>${inc.file_url ? `<a href="${inc.file_url}" target="_blank">View</a>` : '-'}</td>
           <td>${inc.witness_statement || '-'}</td>
           <td>${inc.status || '-'}</td>
           <td>${inc.corrective_action || '-'}</td>
         </tr>
       `;
       tbody.innerHTML += row;
     });
   } else {
     tbody.innerHTML = '<tr><td colspan="9" class="text-center text-muted">No incidents found</td></tr>';
   }
 })
 .catch(err => {
   console.error('Error loading incidents:', err);
   const tbody = document.querySelector('#incidentTable tbody');
   tbody.innerHTML = '<tr><td colspan="9" class="text-center text-danger">Failed to load data.</td></tr>';
 });
}
$(document).ready(function() {
    loadIncidentRecords(); // Load today's data initially

        // Reload the data when the filter form is submitted
       
    });

function showMessage(message, type = 'success') {
  const box = document.getElementById('messageBox');
  box.innerHTML = `<div class="alert alert-${type} alert-dismissible fade show" role="alert">
    ${message}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>`;
}

// Helper for AJAX submission (non-file forms)
function submitForm(formId, apiUrl) {
  const form = document.getElementById(formId);
  form.addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(form);

    fetch(apiUrl, {
      method: 'POST',
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      showMessage(data.message, data.status === 'success' ? 'success' : 'danger');
      if (data.status === 'success') form.reset();
      loadIncidentRecords();
    })
    .catch(err => showMessage('Network error!', 'danger'));
  });
}

// Separate handler for file upload
function submitFileForm(formId, apiUrl) {
  const form = document.getElementById(formId);
  form.addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(form);

    fetch(apiUrl, {
      method: 'POST',
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      showMessage(data.message, data.status === 'success' ? 'success' : 'danger');
      if (data.status === 'success') form.reset();
    })
    .catch(err => showMessage('Upload failed!', 'danger'));
  });
}

// Set your API endpoint here
const API_URL = 'api/incident_handler.php';

// Hook up all forms
submitForm('formReport', API_URL);
submitForm('formRootCause', API_URL);
submitForm('formStatus', API_URL);
submitFileForm('formAttachment', API_URL);
</script>



