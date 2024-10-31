<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Employees List</title>
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
                <a href="#">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                </a>
                <a href="#">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </a>
            </div>
        </div>

        <section class="documents-section">
            <div class="documents-container">
                <div class="documents-menu">
                    <a href="components/add-documents.html" class="add-btn">Add Document</a>

                    <select name="document-sort" id="" class="sort-select">
                        <option value="" selected disabled>Sort Options</option>
                        <option value="Date Added">Date Added</option>
                        <option value="Alphabetical">Alphabetical</option>
                    </select>
                    <div class="search-bar">
                        <input type="text" name="search-bar" id="search-bar" placeholder="Search something..." />
                        <span><i class="fa fa-search" aria-hidden="true"></i> </span>
                    </div>
                    <a href="archives.html" class="archive-btn">Archives</a>
                </div>
                <div class="documents-list">
                    <a href="#" class="document-card">
                        <span class="material-symbols-outlined"> description </span>
                        <p class="filename">Employee_TermsAndRegulations.pdf</p>
                        <div class="dropdown">
                            <span class="material-symbols-outlined dropdown-btn">
                                more_vert
                            </span>
                            <div class="dropdown-content">
                                <button><span class="material-symbols-outlined">download</span>Download</button>
                                <button><span class="material-symbols-outlined">delete</span>Delete</button>
                                <button><span class="material-symbols-outlined">archive</span>Archive</button>
                            </div>
                        </div>
                    </a>

                    <a href="#" class="document-card">
                        <span class="material-symbols-outlined"> description </span>
                        <p class="filename">DeLapaz_ApplicationForm.pdf</p>
                        <div class="dropdown">
                            <span class="material-symbols-outlined dropdown-btn">
                                more_vert
                            </span>
                            <div class="dropdown-content">
                                <button><span class="material-symbols-outlined">download</span>Download</button>
                                <button><span class="material-symbols-outlined">delete</span>Delete</button>
                                <button><span class="material-symbols-outlined">archive</span>Archive</button>
                            </div>
                        </div>

                        <a href="#" class="document-card">
                            <span class="material-symbols-outlined"> folder </span>
                            <p class="filename">Admin Files</p>
                            <div class="dropdown">
                                <span class="material-symbols-outlined dropdown-btn">
                                    more_vert
                                </span>
                                <div class="dropdown-content">
                                    <button><span class="material-symbols-outlined">download</span>Download</button>
                                    <button><span class="material-symbols-outlined">delete</span>Delete</button>
                                    <button><span class="material-symbols-outlined">archive</span>Archive</button>
                                </div>
                            </div>
                        </a>

                        <a href="#" class="document-card">
                            <span class="material-symbols-outlined"> folder </span>
                            <p class="filename">Legal Permits</p>
                            <div class="dropdown">
                                <span class="material-symbols-outlined dropdown-btn">
                                    more_vert
                                </span>
                                <div class="dropdown-content">
                                    <button><span class="material-symbols-outlined">download</span>Download</button>
                                    <button><span class="material-symbols-outlined">delete</span>Delete</button>
                                    <button><span class="material-symbols-outlined">archive</span>Archive</button>
                                </div>
                            </div>
                        </a>

                        <a href="#" class="document-card">
                            <span class="material-symbols-outlined"> folder </span>
                            <p class="filename">Taxes</p>
                            <div class="dropdown">
                                <span class="material-symbols-outlined dropdown-btn">
                                    more_vert
                                </span>
                                <div class="dropdown-content">
                                    <button><span class="material-symbols-outlined">download</span>Download</button>
                                    <button><span class="material-symbols-outlined">delete</span>Delete</button>
                                    <button><span class="material-symbols-outlined">archive</span>Archive</button>
                                </div>
                            </div>
                        </a>

                        <a href="#" class="document-card">
                            <span class="material-symbols-outlined"> folder </span>
                            <p class="filename">Complaints and Suggestions</p>
                            <div class="dropdown">
                                <span class="material-symbols-outlined dropdown-btn">
                                    more_vert
                                </span>
                                <div class="dropdown-content">
                                    <button><span class="material-symbols-outlined">download</span>Download</button>
                                    <button><span class="material-symbols-outlined">delete</span>Delete</button>
                                    <button><span class="material-symbols-outlined">archive</span>Archive</button>
                                </div>
                            </div>
                        </a>
                </div>
            </div>
        </section>
    </main>
</body>

</html>