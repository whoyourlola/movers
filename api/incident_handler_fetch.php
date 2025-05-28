<?php
require_once '../includes/config.php';
header('Content-Type: application/json');
if ($_GET['action'] === 'fetch_all') {
    $stmt = $pdo->query("
        SELECT 
            i.incident_id,
            i.incident_type,
            i.description,
            i.incident_datetime,
            rc.root_cause,
            ia.file_path,
            ia.witness_statement,
            ists.status,
            ists.corrective_action
        FROM incidents i
        LEFT JOIN root_causes rc ON i.incident_id = rc.incident_id
        LEFT JOIN incident_attachments ia ON i.incident_id = ia.incident_id
        LEFT JOIN incident_status ists ON i.incident_id = ists.incident_id
        ORDER BY i.incident_datetime DESC
    ");

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Add full file URL if file exists
    foreach ($data as &$row) {
        $row['file_url'] = $row['file_path'] ? 'uploads/' . $row['file_path'] : null;
    }

    echo json_encode([
        'status' => 'success',
        'records' => $data
    ]);
    exit;
}

?>
