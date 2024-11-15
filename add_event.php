<?php
include "db_connect.php"; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $event_name = $_POST['event_name'];
    $event_date = $_POST['event_date'];
    $description = $_POST['description'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO events (event_name, event_date, description) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $event_name, $event_date, $description);

    if ($stmt->execute()) {
        echo "<script>alert('Event added successfully!'); window.location.href='calendar_page.php';</script>";
    } else {
        echo "<script>alert('Error adding event.'); window.location.href='calendar_page.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>