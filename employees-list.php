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
                <a href="components/add-employees.html" class="add-btn">Add</a>
                <a href="components/edit-employees.html" class="edit-btn">Edit</a>
                <select name="sort" id="" class="sort-select">
                    <option value="" selected disabled>Sort</option>
                    <option value="newest">Newest First</option>
                    <option value="oldest">Oldest First</option>
                    <option value="alphabetical">Alphabetical</option>
                </select>
            </div>

            <div class="employees-grid">
                <a href="components/employee-profile.html">
                    <div class="employee-card">
                        <img src="images/room-service.png" alt="" class="employee-img" />
                        <div class="employee-info">
                            <div class="employee-flex">
                                <p class="employee-name">Sarah DeLapaz</p>
                                <span class="employee-status">Active</span>
                            </div>

                            <p class="employee-position">Room Service Staff</p>

                            <p class="employee-schedule">Mon-Fri 10:00PM-5:00AM</p>
                        </div>
                    </div>
                </a>

                <a href="components/employee-profile.html">
                    <div class="employee-card">
                        <img src="images/security.jpg" alt="" class="employee-img" />
                        <div class="employee-info">
                            <div class="employee-flex">
                                <p class="employee-name">Pedro Rosario Matikas</p>
                                <span class="employee-status" style="color: red">On Leave</span>
                            </div>

                            <p class="employee-position">Security</p>

                            <p class="employee-schedule">Mon-Fri 10:00PM-5:00AM</p>
                        </div>
                    </div>
                </a>
            </div>
        </section>
    </main>
</body>

</html>