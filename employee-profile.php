<?php
include 'components/connector.php';



if (isset($_GET['id']) && !empty($_GET['id'])) {
    $staff_id = intval($_GET['id']); 


    $sql = "SELECT * FROM staffs_table WHERE staff_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $staff_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $staff = $result->fetch_assoc();
    } else {
        $staff = null; 
    }

    $stmt->close();
} else {
    $staff = null; 
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Employee Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../styles.css" />
</head>

<body>
    <?php include 'components/sidebar.php'; ?>

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

        <section class="employee-profile-section">
            <div class="profile-container">
                <div class="menu-buttons">
                    <button onclick="showSection('personal-info')">
                        Personal Info
                    </button>
                    <button onclick="showSection('attendance')">Attendance</button>
                    <button onclick="showSection('payslip')">Payroll</button>
                    <button onclick="showSection('documents')">Documents</button>
                </div>

                <div class="section" id="personal-info" style="display: block">
                    <div class="personal-info-window">
                        <div class="profile-card">
                            <img src="../images/default-profile.png" alt="" />
                            <p class="employee-name"><?php echo $staff['firstname'] . ' ' . $staff['lastname']; ?></p>
                            <p class="employee-role"><?php echo $staff['status']; ?></p>
                            <div class="profile-info">
                                <p>Status: <span><?php echo $staff['status']; ?></span></p>
                                <p>Email: <span><?php echo $staff['email']; ?></span></p>
                                <p>Contact Number: <span><?php echo $staff['cnum']; ?></span></p>
                            </div>
                        </div>

                        <div class="basic-information">
                                <h1>Basic Information</h1>
                                <br />
                                <div class="basic-info-field">
                                    <div>
                                        <p>First Name:</p>
                                        <p>Last Name:</p>
                                        <p>Sex:</p>
                                        <p>Age:</p>
                                        <p>Shift:</p>
                                    </div>
                                    <div>
                                        <p><?php echo htmlspecialchars($staff['firstname']); ?></p>
                                        <p><?php echo htmlspecialchars($staff['lastname']); ?></p>
                                        <p><?php echo htmlspecialchars($staff['sex']); ?></p>
                                        <p><?php echo htmlspecialchars($staff['age']); ?></p>
                                        <p><?php echo htmlspecialchars($staff['shift_start']) .' - '. htmlspecialchars($staff['shift_end']); ?></p>
                                    </div>
                                </div>

                                <h1>Personal Information</h1>
                                <br />
                                <div class="personal-information-field">
                                    <div>
                                        <p>Date of birth</p>
                                        <p>Height</p>
                                        <p>Weight</p>
                                        <p>Civil Status</p>
                                        <p>Nationality</p>
                                        <p>Address</p>
                                        <p>Languages Known</p>
                                        <p>Educational Attainment</p>
                                        <p>Religion</p>
                                        <p>Contact Number</p>


                                    </div>
                                    <div>
                                        <p><?php echo htmlspecialchars($staff['bdate']); ?></p>
                                        <p><?php echo htmlspecialchars($staff['height']); ?></p>
                                        <p><?php echo htmlspecialchars($staff['weight']); ?></p>
                                        <p><?php echo htmlspecialchars($staff['civ_stat']); ?></p>
                                        <p><?php echo htmlspecialchars($staff['nationality']); ?></p>
                                        <p><?php echo htmlspecialchars($staff['address']); ?></p>
                                        <p><?php echo htmlspecialchars($staff['languages']); ?></p>
                                        <p><?php echo htmlspecialchars($staff['educational_attainment']); ?></p>
                                        <p><?php echo htmlspecialchars($staff['religion']); ?></p>
                                        <p><?php echo htmlspecialchars($staff['cnum']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section" id="attendance" style="display: none">
                    <div class="attendance-window">
                        <div>
                            <div class="attendance-header">
                                <h1>Daily Time Records</h1>
                                <div class="search-bar">
                                    <input type="text" name="search-bar" id="search-bar"
                                        placeholder="Search something..." />
                                    <span><i class="fa fa-search" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>
                            <table class="attendance-table">
                                <thead>
                                    <tr>
                                        <th>DATE</th>
                                        <th>STATUS</th>
                                        <th>SCHEDULE</th>
                                        <th>CLOCK IN</th>
                                        <th>CLOCK OUT</th>
                                        <th>LATE</th>
                                        <th>BREAK</th>
                                        <th>UNDERTIME</th>
                                        <th>OVERTIME</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <td colspan="10">
                                            <div class="links">
                                                <a href="#">&laquo;</a>
                                                <a class="active" href="#">1</a> <a href="#">2</a>
                                                <a href="#">3</a> <a href="#">4</a>
                                                <a href="#">&raquo;</a>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <tr>
                                        <td>cell1_1</td>
                                        <td>cell2_1</td>
                                        <td>cell3_1</td>
                                        <td>cell4_1</td>
                                        <td>cell5_1</td>
                                        <td>cell6_1</td>
                                        <td>cell7_1</td>
                                        <td>cell8_1</td>
                                        <td>cell9_1</td>
                                        <td>cell10_1</td>
                                    </tr>
                                    <tr>
                                        <td>cell1_2</td>
                                        <td>cell2_2</td>
                                        <td>cell3_2</td>
                                        <td>cell4_2</td>
                                        <td>cell5_2</td>
                                        <td>cell6_2</td>
                                        <td>cell7_2</td>
                                        <td>cell8_2</td>
                                        <td>cell9_2</td>
                                        <td>cell10_2</td>
                                    </tr>
                                    <tr>
                                        <td>cell1_3</td>
                                        <td>cell2_3</td>
                                        <td>cell3_3</td>
                                        <td>cell4_3</td>
                                        <td>cell5_3</td>
                                        <td>cell6_3</td>
                                        <td>cell7_3</td>
                                        <td>cell8_3</td>
                                        <td>cell9_3</td>
                                        <td>cell10_3</td>
                                    </tr>
                                    <tr>
                                        <td>cell1_4</td>
                                        <td>cell2_4</td>
                                        <td>cell3_4</td>
                                        <td>cell4_4</td>
                                        <td>cell5_4</td>
                                        <td>cell6_4</td>
                                        <td>cell7_4</td>
                                        <td>cell8_4</td>
                                        <td>cell9_4</td>
                                        <td>cell10_4</td>
                                    </tr>
                                    <tr>
                                        <td>cell1_5</td>
                                        <td>cell2_5</td>
                                        <td>cell3_5</td>
                                        <td>cell4_5</td>
                                        <td>cell5_5</td>
                                        <td>cell6_5</td>
                                        <td>cell7_5</td>
                                        <td>cell8_5</td>
                                        <td>cell9_5</td>
                                        <td>cell10_5</td>
                                    </tr>
                                    <tr>
                                        <td>cell1_6</td>
                                        <td>cell2_6</td>
                                        <td>cell3_6</td>
                                        <td>cell4_6</td>
                                        <td>cell5_6</td>
                                        <td>cell6_6</td>
                                        <td>cell7_6</td>
                                        <td>cell8_6</td>
                                        <td>cell9_6</td>
                                        <td>cell10_6</td>
                                    </tr>
                                    <tr>
                                        <td>cell1_7</td>
                                        <td>cell2_7</td>
                                        <td>cell3_7</td>
                                        <td>cell4_7</td>
                                        <td>cell5_7</td>
                                        <td>cell6_7</td>
                                        <td>cell7_7</td>
                                        <td>cell8_7</td>
                                        <td>cell9_7</td>
                                        <td>cell10_7</td>
                                    </tr>
                                    <tr>
                                        <td>cell1_8</td>
                                        <td>cell2_8</td>
                                        <td>cell3_8</td>
                                        <td>cell4_8</td>
                                        <td>cell5_8</td>
                                        <td>cell6_8</td>
                                        <td>cell7_8</td>
                                        <td>cell8_8</td>
                                        <td>cell9_8</td>
                                        <td>cell10_8</td>
                                    </tr>
                                    <tr>
                                        <td>cell1_9</td>
                                        <td>cell2_9</td>
                                        <td>cell3_9</td>
                                        <td>cell4_9</td>
                                        <td>cell5_9</td>
                                        <td>cell6_9</td>
                                        <td>cell7_9</td>
                                        <td>cell8_9</td>
                                        <td>cell9_9</td>
                                        <td>cell10_9</td>
                                    </tr>
                                    <tr>
                                        <td>cell1_10</td>
                                        <td>cell2_10</td>
                                        <td>cell3_10</td>
                                        <td>cell4_10</td>
                                        <td>cell5_10</td>
                                        <td>cell6_10</td>
                                        <td>cell7_10</td>
                                        <td>cell8_10</td>
                                        <td>cell9_10</td>
                                        <td>cell10_10</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="section" id="payslip" style="display: none">
                    <div class="payslip-window">
                        <div class="profile-card">
                            <img src="../images/room-service.png" alt="" />
                            <p class="employee-name">Sarah DeLapaz</p>
                            <p class="employee-role">Room Service</p>
                            <div class="profile-info">
                                <p>Status: <span>Active</span></p>
                                <p>Email: <span>blahblah@gmail.com</span></p>
                                <p>Contact Number: <span>0912 876 1223</span></p>
                            </div>
                        </div>

                        <div class="payslip-table">
                            <h1>Payslip</h1>
                            <div class="payslip-grid">
                                <p>Basic</p>
                                <span>15,000</span>
                                <p>Incentives</p>
                                <span>0.00</span>
                                <p>Overtime</p>
                                <span>2,017.00</span>
                                <p class="total-qty">Total</p>
                                <span class="total-qty">17,017.00</span>
                            </div>

                            <h3>Benefits</h3>
                            <div class="payslip-grid">
                                <p>SSS</p>
                                <span>800.00</span>
                                <p>PAGIBIG</p>
                                <span>100.00</span>
                                <p>PhilHealth</p>
                                <span>412.50</span>
                                <p class="total-qty">Total</p>
                                <span class="total-qty" style="margin-bottom: 2rem">1,312.50</span>
                                <div></div>
                                <p>17,017.00</p>
                                <div></div>
                                <p>-1,312.00</p>
                                <p class="total-qty">Grand Total</p>
                                <span class="total-qty">15,704.50</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section" id="documents" style="display: none">
                    <div class="documents-window">
                        <div class="documents-menu">
                            <a href="#" class="add-btn">Add</a>
                            <a href="#" class="edit-btn">Edit</a>
                            <select name="document-sort" id="" class="sort-select">
                                <option value="" selected disabled>Sort Options</option>
                                <option value="Date Added">Date Added</option>
                                <option value="Alphabetical">Alphabetical</option>
                            </select>
                            <div class="search-bar">
                                <input type="text" name="search-bar" id="search-bar"
                                    placeholder="Search something..." />
                                <span><i class="fa fa-search" aria-hidden="true"></i> </span>
                            </div>
                        </div>
                        <div class="documents-list">
                            <a href="#" class="document-card">
                                <span class="material-symbols-outlined"> description </span>
                                <p class="filename">Employee_TermsAndRegulations.pdf</p>
                                <span class="material-symbols-outlined setting">
                                    more_vert
                                </span>
                            </a>

                            <a href="#" class="document-card">
                                <span class="material-symbols-outlined"> description </span>
                                <p class="filename">DeLapaz_ApplicationForm.pdf</p>
                                <span class="material-symbols-outlined setting">
                                    more_vert
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
<script src="../script.js"></script>

</html>