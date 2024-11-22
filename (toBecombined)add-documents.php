<?php
// Database connection
include "components/connector.php";

// Handle form submission
$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['document_file']) && isset($_POST['document_name'])) {
    $documentName = htmlspecialchars($_POST['document_name']);
    $uploadDir = "uploads/";
    $file = $_FILES['document_file'];

    // Validate file
    $allowedTypes = ['application/pdf', 'image/jpeg', 'image/png', 'application/msword'];
    if (!in_array($file['type'], $allowedTypes)) {
        $message = "Invalid file type. Please upload PDF, DOC, JPG, or PNG files.";
    } else {
        $uploadPath = $uploadDir . basename($file['name']);

        // Move uploaded file to the server
        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            // Save file info to database
            $stmt = $conn->prepare("INSERT INTO documents_table (docu_name, docu_path, docu_type) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $documentName, $uploadPath, $file['type']);

            if ($stmt->execute()) {
                $message = "Document uploaded successfully.";
            } else {
                $message = "Failed to save document information in the database.";
            }

            $stmt->close();
        } else {
            $message = "Failed to upload the file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../styles.css" />
</head>
<body>
    <?php include "components/sidebar.php"; ?>

    <main style="margin-left: 85px">
        <div class="breadcrumbs">
            <div class="left">
                <p>Admin > <span>Documents</span> > Add Document</p>
            </div>
            <div class="right">
                <a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-user" aria-hidden="true"></i></a>
            </div>
        </div>

        <section class="add-documents-section">
            <div class="add-documents-container">
                <?php if ($message): ?>
                    <p style="color: red;"><?php echo $message; ?></p>
                <?php endif; ?>

                <form id="addDocumentForm" action="" method="POST" enctype="multipart/form-data">
                    <label for="fileInput" class="file-chooser-btn">
                        <img src="../images/upload-file.png" alt="Upload Icon" />
                        <p class="choose-btn-txt">Click to choose a file</p>
                    </label>
                    <input type="file" name="document_file" id="fileInput" style="display: none" onchange="displayFileName()" required />

                    <p class="file-name" id="file-name">No file chosen</p>

                    <label for="documentName">Document Name:</label>
                    <input type="text" name="document_name" id="documentName" placeholder="Enter document name" required />

                    <button type="submit" class="upload-btn">
                        <p class="upload-btn-txt">Upload Document</p>
                    </button>
                </form>
            </div>
        </section>
    </main>

    <script>
        function displayFileName() {
            const fileInput = document.getElementById('fileInput');
            const fileName = document.getElementById('file-name');
            fileName.textContent = fileInput.files[0]?.name || 'No file chosen';
        }
    </script>
</body>
</html>
