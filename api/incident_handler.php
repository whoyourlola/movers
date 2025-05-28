<?php
require_once '../includes/config.php';
header('Content-Type: application/json'); 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = ['status' => 'error', 'message' => 'Something went wrong'];

    if (isset($_POST['action'])) {
        try {
            switch ($_POST['action']) {
                case 'submit_report':
                    $stmt = $pdo->prepare("INSERT INTO incidents (incident_type, description, incident_datetime) VALUES (?, ?, ?)");
                    $stmt->execute([$_POST['incident_type'], $_POST['incident_description'], $_POST['incident_date']]);
                    $incident_id = $pdo->lastInsertId();
                    $response = ['status' => 'success', 'message' => "Incident reported successfully (ID: $incident_id)."];
                    break;

                case 'submit_rootcause':
                    $stmt = $pdo->prepare("INSERT INTO root_causes (incident_id, root_cause) VALUES (?, ?)");
                    $stmt->execute([$_POST['incident_id_root'], $_POST['root_cause']]);
                    $response = ['status' => 'success', 'message' => "Root cause saved."];
                    break;

                case 'submit_status':
                    $stmt = $pdo->prepare("INSERT INTO incident_status (incident_id, status, corrective_action) VALUES (?, ?, ?)");
                    $stmt->execute([$_POST['incident_id_status'], $_POST['incident_status'], $_POST['corrective_action']]);
                    $response = ['status' => 'success', 'message' => "Status updated."];
                    break;

                case 'submit_attachment':
                    $file_path = null;
                    if (isset($_FILES['incident_file']) && $_FILES['incident_file']['error'] == 0) {
                        $filename = time() . "_" . basename($_FILES['incident_file']['name']);
                        $target = "../uploads/incidents/" . $filename;
                        move_uploaded_file($_FILES['incident_file']['tmp_name'], $target);
                        $file_path = "incidents/" . $filename;
                    }

                    $stmt = $pdo->prepare("INSERT INTO incident_attachments (incident_id, file_path, witness_statement) VALUES (?, ?, ?)");
                    $stmt->execute([$_POST['incident_id_attach'], $file_path, $_POST['witness_statement']]);
                    $response = ['status' => 'success', 'message' => "Attachment uploaded."];
                    break;
            }
        } catch (Exception $e) {
            $response = ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    echo json_encode($response);
    exit;
}
?>
