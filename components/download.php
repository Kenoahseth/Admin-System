<?php
include "connector.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['document_id'])) {
    $documentId = intval($_POST['document_id']);

    // Fetch the document details to get the file path
    $stmt = $conn->prepare("SELECT docu_name, docu_path FROM documents_table WHERE docu_id = ?");
    $stmt->bind_param("i", $documentId);
    $stmt->execute();
    $stmt->bind_result($docuName, $filePath);
    $stmt->fetch();
    $stmt->close();

    // Set headers to prompt download
    if (file_exists($filePath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($docuName) . '"');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit();
    } else {
        echo "<script>alert('File not found.'); window.location.href='../documents.php';</script>";
    }
}
?>
