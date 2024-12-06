<?php
include "components/connector.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['document_id'])) {
    $documentId = intval($_POST['document_id']);

    // Fetch the document details to get the file path
    $stmt = $conn->prepare("SELECT docu_path FROM documents_table WHERE docu_id = ?");
    $stmt->bind_param("i", $documentId);
    $stmt->execute();
    $stmt->bind_result($filePath);
    $stmt->fetch();
    $stmt->close();

    // Log the file path for debugging
    file_put_contents('components\\delete_log.txt', "File path from database: $filePath\n");

    // Path to PowerShell script
    $psScript = "components\\move_to_recycle_bin.ps1";
    $escapedFilePath = escapeshellarg($filePath);

    // Command to execute PowerShell script
    $command = "powershell.exe -File $psScript -FilePath $escapedFilePath";

    // Execute the command and capture the output
    $output = shell_exec($command . ' 2>&1');

    // Log the PowerShell script output for debugging
    file_put_contents('components\\delete_log.txt', $output, FILE_APPEND);

    // Check if the file was successfully moved to the recycling bin
    if (strpos($output, 'Success') !== false) {
        // Log the file path and document ID before attempting to delete the record
        file_put_contents('components\\delete_log.txt', "File: $filePath, Document ID: $documentId", FILE_APPEND);

        // Delete the document record from the database
        $stmt = $conn->prepare("DELETE FROM documents_table WHERE docu_id = ?");
        $stmt->bind_param("i", $documentId);
        $stmt->execute();
        $stmt->close();

        // Log after attempting to delete the record
        file_put_contents('components\\delete_log.txt', "Document record deleted.", FILE_APPEND);

        // Redirect to the documents page
        header("Location: ../documents.php");
        exit();
    } else {
        // Log the error if moving to the recycle bin fails
        file_put_contents('components\\delete_log.txt', "Failed to move to recycle bin. Output: $output", FILE_APPEND);
        echo "<script>alert('Failed to move file to the recycling bin. $output'); window.location.href='../documents.php';</script>";
    }
}
?>
