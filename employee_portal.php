<?php
date_default_timezone_set('Asia/Manila');


include "components/connector.php"; 
$staff = [];
$attendance_records = [];


if (isset($_GET['employee_id'])) {
    $employee_id = intval($_GET['employee_id']);
    
    // Fetch staff details
    $sql = "SELECT * FROM staffs_table WHERE assigned_id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $employee_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $staff = $result->fetch_assoc();
        }
        $stmt->close();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $assigned_id = intval($_POST['assigned_id']);
    $current_time = date('H:i:s');
    $current_date = date('Y-m-d');

    if (isset($_POST['time_in'])) {
        // Insert or update Time In and set recorded_status to Active
        $sql = "INSERT INTO attendance_table (assigned_id, time_in, date, recorded_status) 
                VALUES (?, ?, ?, 'Active') 
                ON DUPLICATE KEY UPDATE time_in = VALUES(time_in), recorded_status = 'Active'";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("iss", $assigned_id, $current_time, $current_date);
            $stmt->execute();
            $stmt->close();
        }

        // Update status to Active in staffs_table
        $update_status_sql = "UPDATE staffs_table SET status = 'Active' WHERE assigned_id = ?";
        $stmt = $conn->prepare($update_status_sql);
        if ($stmt) {
            $stmt->bind_param("i", $assigned_id);
            $stmt->execute();
            $stmt->close();
        }
    }

    if (isset($_POST['time_out'])) {
        // Update Time Out for the existing record
        $sql = "UPDATE attendance_table SET time_out = ? WHERE assigned_id = ? AND date = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("sis", $current_time, $assigned_id, $current_date);
            $stmt->execute();
            $stmt->close();
        }

        // Update status to Inactive in staffs_table
        $update_status_sql = "UPDATE staffs_table SET status = 'Inactive' WHERE assigned_id = ?";
        $stmt = $conn->prepare($update_status_sql);
        if ($stmt) {
            $stmt->bind_param("i", $assigned_id);
            $stmt->execute();
            $stmt->close();
        }
    }
}



// Handle API request for fetching attendance records
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['fetch_attendance'])) {
    $assigned_id = intval($_GET['assigned_id']);
    $attendance_records = [];

    // Fetch attendance records
    $sql = "SELECT at.date, st.status, at.time_in, at.time_out, at.recorded_status,
                SEC_TO_TIME(TIMESTAMPDIFF(SECOND, at.time_in, at.time_out)) AS overtime,
                SEC_TO_TIME(TIMESTAMPDIFF(SECOND, st.shift_start, at.time_in)) AS undertime
            FROM attendance_table at
            JOIN staffs_table st ON at.assigned_id = st.assigned_id
            WHERE at.assigned_id = ?
            ORDER BY at.date DESC";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $assigned_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()) {
            $attendance_records[] = $row;
        }
        $stmt->close();
    }

    // Return JSON response
    echo json_encode($attendance_records);
    exit;
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Employee Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../styles.css" />
    <script src="attendance.js"></script>
</head>

<body>
    <script>
       function displayTime() {
    const now = new Date();
    const options = {
        hour: 'numeric',
        minute: 'numeric',
        second: 'numeric',
        timeZone: 'Asia/Manila',
        hour12: true
    };
    const formattedTime = now.toLocaleTimeString('en-US', options);
    document.getElementById('currentTime').textContent = formattedTime;
}
setInterval(displayTime, 1000);
displayTime();

    </script>
    <main>
        <div class="breadcrumbs">
            <div class="left">
                <span>STAFFS AND EMPLOYEES</span>
            </div>

            <!-- Employee ID Form -->
            <form class="emp-id" method="GET" action="">
                <input class="emp-input" type="number" name="employee_id" placeholder="Enter Employee ID" required>
                <button type="submit"></button>
            </form>

            <div class="right">
                <div id="currentTime"></div>
            </div>
        </div>

        <section class="employee-profile-section">
            <div class="profile-container">
                <div class="menu-buttons">
                    <button onclick="showSection('personal-info')">Personal Info</button>
                    <button onclick="showSection('attendance')">Attendance</button>
                    <button onclick="showSection('payslip')">Payroll</button>
                </div>

                <div class="section" id="personal-info" style="display: block;">
                    <div class="personal-info-window">
                        <!-- Profile Card -->
                        <div class="profile-card">
                            <img src="../images/default-profile.png" alt="Profile Picture" />
                            <p class="employee-name">
                                <?= htmlspecialchars($staff['firstname'] ?? 'Employee name') . ' ' . htmlspecialchars($staff['lastname'] ?? ''); ?>
                            </p>
                            <p class="employee-role"><?= htmlspecialchars($staff['status'] ?? 'Role'); ?></p>
                            <div class="profile-info">
                                <p>Status: <span><?= htmlspecialchars($staff['status'] ?? ''); ?></span></p>
                                <p>Email: <span><?= htmlspecialchars($staff['email'] ?? ''); ?></span></p>
                                <p>Contact Number: <span><?= htmlspecialchars($staff['cnum'] ?? ''); ?></span></p>
                            </div>
                        </div>

                        <!-- Basic Information -->
                        <div class="basic-information">
                            <h1>Basic Information</h1>
                            <div class="basic-info-field">
                                <div>
                                    <p>First Name:</p>
                                    <p>Last Name:</p>
                                    <p>Sex:</p>
                                    <p>Age:</p>
                                    <p>Shift:</p>
                                </div>
                                <div>
                                    <p><?= htmlspecialchars($staff['firstname'] ?? ''); ?></p>
                                    <p><?= htmlspecialchars($staff['lastname'] ?? ''); ?></p>
                                    <p><?= htmlspecialchars($staff['sex'] ?? ''); ?></p>
                                    <p><?= htmlspecialchars($staff['age'] ?? ''); ?></p>
                                    <p><?= htmlspecialchars($staff['shift_start'] ?? '') . ' - ' . htmlspecialchars($staff['shift_end'] ?? ''); ?></p>
                                </div>
                            </div>

                            <!-- Personal Information -->
                            <h1>Personal Information</h1>
                            <div class="personal-information-field">
                                <div>
                                    <p>Date of birth:</p>
                                    <p>Height:</p>
                                    <p>Weight:</p>
                                    <p>Civil Status:</p>
                                    <p>Nationality:</p>
                                    <p>Address:</p>
                                    <p>Languages Known:</p>
                                    <p>Educational Attainment:</p>
                                    <p>Religion:</p>
                                    <p>Contact Number:</p>
                                </div>
                                <div>
                                    <p><?= htmlspecialchars($staff['bdate'] ?? ''); ?></p>
                                    <p><?= htmlspecialchars($staff['height'] ?? ''); ?></p>
                                    <p><?= htmlspecialchars($staff['weight'] ?? ''); ?></p>
                                    <p><?= htmlspecialchars($staff['civ_stat'] ?? ''); ?></p>
                                    <p><?= htmlspecialchars($staff['nationality'] ?? ''); ?></p>
                                    <p><?= htmlspecialchars($staff['address'] ?? ''); ?></p>
                                    <p><?= htmlspecialchars($staff['languages'] ?? ''); ?></p>
                                    <p><?= htmlspecialchars($staff['educational_attainment'] ?? ''); ?></p>
                                    <p><?= htmlspecialchars($staff['religion'] ?? ''); ?></p>
                                    <p><?= htmlspecialchars($staff['cnum'] ?? ''); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="attendance-buttons">
                            <form method="POST" action="">
                                <input type="hidden" name="assigned_id" value="<?= htmlspecialchars($staff['assigned_id'] ?? 0); ?>">
                                <button id="timeInButton" class="portal-btn">Time In</button>
                                <button id="timeOutButton" class="portal-btn">Time Out</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="section" id="attendance" style="display: none">
                    <div class="attendance-window">
                        <div>
                            <div class="attendance-header">
                                <h1>Daily Time Records</h1>
                                <div class="search-bar">
                                    <input type="text" name="search-bar" id="search-bar" placeholder="Search something..." />
                                    <span><i class="fa fa-search" aria-hidden="true"></i></span>
                                </div>
                            </div>
                            <table class="attendance-table">
                                <thead>
                                    <tr>
                                        <th>DATE</th>
                                        <th>RECORDED STATUS</th><!-- from attendance_table -->
                                        <th>CLOCK IN</th>
                                        <th>CLOCK OUT</th>
                                        <th>OVERTIME</th>
                                        <th>UNDERTIME</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($attendance_records)) : ?>
                                        <?php foreach ($attendance_records as $record) : ?>
                                            <tr>
                                                <td><?= htmlspecialchars($record['date']); ?></td>
                                                <td><?= htmlspecialchars($record['recorded_status']); ?></td>
                                                <td><?= htmlspecialchars($record['time_in'] ?? '-'); ?></td>
                                                <td><?= htmlspecialchars($record['time_out'] ?? '-'); ?></td>
                                                <td><?= htmlspecialchars($record['overtime'] ?? '-'); ?></td>
                                                <td><?= htmlspecialchars($record['undertime'] ?? '-'); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="7">No attendance records found.</td>
                                        </tr>
                                    <?php endif; ?>
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
            </div>
        </section>
    </main>

    <!-- Modal for confirmation and success -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <p id="modalText"></p>
            <div id="confirmationButtons" style="display: none;">
                <button class="button" id="confirmYes">Yes</button>
                <button class="button" id="confirmNo">No</button>
            </div>
            <div id="successButton" style="display: none;">
                <button class="button" id="okButton">OK</button>
            </div>
        </div>
    </div>
</body>
<script src="../script.js"></script>
</html>
