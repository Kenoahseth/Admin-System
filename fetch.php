<?php
include "components/connector.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['event_id'])) {
        $event_id = intval($data['event_id']);

        $sql = "DELETE FROM events_table WHERE event_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $event_id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false]);
    }
}

$conn->close();
?>
