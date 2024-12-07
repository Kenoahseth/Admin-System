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
<?php 
    include "components/sidebar.php"; 
    include "components/connector.php"; 

    $sql = "SELECT staff_id, firstname, lastname, status, shift_start, shift_end, profile_picture, position FROM staffs_table";
    $result = $conn->query($sql);
    ?>

   <main style="margin-left: 85px">
        <div class="breadcrumbs">
            <div class="left">
                <p>Admin > <span>STAFFS AND EMPLOYEES</span></p>
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

        <section class="employees-list-section">
            <div class="top-buttons">
                <a href="add-employees.php" class="add-btn">Add</a>
                <a href="edit-employees.php" class="edit-btn">Edit</a>
                <select name="sort" id="" class="sort-select">
                    <option value="" selected disabled>Sort</option>
                    <option value="newest">Newest First</option>
                    <option value="oldest">Oldest First</option>
                    <option value="alphabetical">Alphabetical</option>
                </select>
            </div>

            <div class="employees-grid">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $fullName = htmlspecialchars($row['firstname'] . ' ' . $row['lastname']);
                        $statusColor = ($row['status'] === 'Active') ? 'green' : 'red';

                        $profilePicture = !empty($row['profile_picture']) ? htmlspecialchars($row['profile_picture']) : 'images/default-profile.png';

                        echo '<a href="employee-profile.php?id=' . $row['staff_id'] . '">
                                <div class="employee-card">
                                    <img src="' . $profilePicture . '" alt="Employee Image" class="employee-img" />
                                    <div class="employee-info">
                                        <div class="employee-flex">
                                            <p class="employee-name">' . $fullName . '</p>
                                            <span class="employee-status" style="color: ' . $statusColor . '">' . htmlspecialchars($row['status']) . '</span>
                                        </div>
                                        <p class="employee-position">' . htmlspecialchars($row['position']) . '</p>
                                        <p class="employee-schedule">Shift: ' . htmlspecialchars($row['shift_start']).' - '.htmlspecialchars($row['shift_end']) . '</p>
                                    </div>
                                </div>
                              </a>';
                    }
                } else {
                    echo '<p>No employees found.</p>';
                }

                $conn->close();
                ?>
            </div>
        </section>
    </main>
</body>

</html>
