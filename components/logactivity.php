<?php
// Include your database connection
include 'components/connector.php';

function record_log($conn, $activity_name, $data_recorded, $user_recorded) {
    $stmt = $conn->prepare("INSERT INTO logs_table (activity_name, data_recorded, user_recorded) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $activity_name, $data_recorded, $user_recorded);
    
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}
?>
