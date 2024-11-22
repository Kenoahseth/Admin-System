<?php
include "components/connector.php";

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['document_file'])) {
    $documentName = $_POST['document_name'];
    $file = $_FILES['document_file'];

    $uploadDir = '../uploads/';
    $filePath = $uploadDir . basename($file['name']);

    // Ensure the uploads directory exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // Move the uploaded file to the uploads directory
    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        // Insert document information into the database
        $stmt = $conn->prepare("INSERT INTO documents_table (docu_name, docu_type) VALUES (?, ?)");
        $docuType = 'file'; // Assuming it's a file; adjust logic as needed
        $stmt->bind_param("ss", $documentName, $docuType);

        if ($stmt->execute()) {
            echo "<script>alert('Document added successfully!');</script>";
        } else {
            echo "<script>alert('Failed to save document information to the database.');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Failed to upload file.');</script>";
    }
}

// Fetch documents
$query = "SELECT docu_id, docu_name, docu_type FROM documents_table ORDER BY docu_name ASC";
$result = $conn->query($query);
$documents = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $documents[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Documents</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="styles.css" />
</head>

<body>
    <?php include "components/sidebar.php"; ?>

    <main style="margin-left: 85px">
        <div class="breadcrumbs">
            <div class="left">
                <p>Admin > <span>DOCUMENTS</span></p>
            </div>
            <div class="right">
                <a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-user" aria-hidden="true"></i></a>
            </div>
        </div>

        <section class="documents-section">
            <div class="documents-container">
                <div class="documents-menu">
                    <button class="add-btn" id="addDocumentButton">Add Document</button>

                    <select id="sortSelect" class="sort-select">
                        <option value="" selected disabled>Sort Options</option>
                        <option value="date">Date Added</option>
                        <option value="name">Alphabetical</option>
                    </select>

                    <div class="search-bar">
                        <input type="text" id="searchBar" placeholder="Search something..." />
                        <span><i class="fa fa-search" aria-hidden="true"></i></span>
                    </div>

                    <a href="archives.php" class="archive-btn">Archives</a>
                </div>

                <div id="documentsList" class="documents-list">
                    <?php foreach ($documents as $document): ?>
                        <div class="document-card">
                            <span class="material-symbols-outlined">
                                <?php echo $document['docu_type'] === 'folder' ? 'folder' : 'description'; ?>
                            </span>
                            <p class="filename"><?php echo htmlspecialchars($document['docu_name']); ?></p>
                            <div class="dropdown">
                                <span class="material-symbols-outlined dropdown-btn">more_vert</span>
                                <div class="dropdown-content">
                                    <form action="download.php" method="POST">
                                        <input type="hidden" name="document_id" value="<?php echo $document['docu_id']; ?>">
                                        <button type="submit"><span class="material-symbols-outlined">download</span>Download</button>
                                    </form>
                                    <form action="delete.php" method="POST">
                                        <input type="hidden" name="document_id" value="<?php echo $document['docu_id']; ?>">
                                        <button type="submit"><span class="material-symbols-outlined">delete</span>Delete</button>
                                    </form>
                                    <form action="archive.php" method="POST">
                                        <input type="hidden" name="document_id" value="<?php echo $document['docu_id']; ?>">
                                        <button type="submit"><span class="material-symbols-outlined">archive</span>Archive</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </main>

    <!-- Add Document Modal -->
    <div id="addDocumentModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" id="closeModal">&times;</span>
        <h2>Add Document</h2>
        <form id="addDocumentForm" method="POST" enctype="multipart/form-data">
            <?php if (!empty($message)): ?>
                <p style="color: red; margin-bottom: 10px;"><?php echo htmlspecialchars($message); ?></p>
            <?php endif; ?>

            <label for="fileInput" class="file-chooser-btn">
                <center><img src="../images/upload-file.png" alt="Upload Icon" style="width:200px;"/></center>
              <p class="choose-btn-txt">Click to choose a file</p>
            </label>
            <input
                type="file"
                name="document_file"
                id="fileInput"
                style="display: none;"
                onchange="displayFileName()"
                required
            />
            <p class="file-name" id="file-name">No file chosen</p>

            <label for="documentName">Document Name:</label>
            <input
                type="text"
                name="document_name"
                id="documentName"
                placeholder="Enter document name"
                required
            />

            <button type="submit" class="upload-btn">
                <p class="upload-btn-txt">Upload Document</p>
            </button>
        </form>
    </div>
</div>

<script>
    // Display chosen file name
    function displayFileName() {
        const fileInput = document.getElementById('fileInput');
        const fileName = document.getElementById('file-name');
        fileName.textContent = fileInput.files[0]?.name || 'No file chosen';
    }

    // Modal logic
    const addDocumentButton = document.getElementById('addDocumentButton');
    const addDocumentModal = document.getElementById('addDocumentModal');
    const closeModal = document.getElementById('closeModal');

    addDocumentButton.addEventListener('click', () => {
        addDocumentModal.style.display = 'block';
    });

    closeModal.addEventListener('click', () => {
        addDocumentModal.style.display = 'none';
    });

    window.addEventListener('click', (e) => {
        if (e.target === addDocumentModal) {
            addDocumentModal.style.display = 'none';
        }
    });
</script>