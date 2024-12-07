<?php
include 'components/connector.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $staff_id = intval($_GET['id']);

    date_default_timezone_set('Asia/Manila');

    // Fetch staff details including assigned_id
    $staff_sql = "SELECT * FROM staffs_table WHERE staff_id = ?";
    $staff_stmt = $conn->prepare($staff_sql);
    $staff_stmt->bind_param("i", $staff_id);
    $staff_stmt->execute();
    $staff_result = $staff_stmt->get_result();
    $staff = $staff_result->num_rows > 0 ? $staff_result->fetch_assoc() : null;
    $staff_stmt->close();

    $assigned_id = $staff['assigned_id'];

    // Fetch salary details
    $staff_id = intval($_GET['id']); 
    $salary_sql = "SELECT * FROM salary_table WHERE staff_id = ? ORDER BY pay_id DESC LIMIT 1"; 
    $salary_stmt = $conn->prepare($salary_sql); 
    $salary_stmt->bind_param("i", $staff_id);
     $salary_stmt->execute(); 
    $salary_result = $salary_stmt->get_result(); $salary = $salary_result->num_rows > 0 ? $salary_result->fetch_assoc() : null;
    
    $salary_stmt->close();



    // Fetch attendance records

    $attendance_records = [];
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

    // Handle payslip save
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_payslip'])) {
        $basic = floatval($_POST['basic']);
        $incentives = floatval($_POST['incentives']);
        $overtime = floatval($_POST['overtime']);
        $sss = floatval($_POST['sss']);
        $pagibig = floatval($_POST['pagibig']);
        $philhealth = floatval($_POST['philhealth']);
        $total = $basic + $incentives + $overtime;
        $grand_total = $total - ($sss + $pagibig + $philhealth);

        $insert_sql = "INSERT INTO salary_table (staff_id, basic, incentives, overtime, sss, pagibig, philhealth, total, grand_total) 
                       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        if ($insert_stmt) {
            $insert_stmt->bind_param("idddddddd", $staff_id, $basic, $incentives, $overtime, $sss, $pagibig, $philhealth, $total, $grand_total);
            $insert_stmt->execute();
            $insert_stmt->close();
        }
    }
} 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['event_id'])) {
        $event_id = intval($data['event_id']);
        
        $sql = "DELETE FROM events_table WHERE event_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $event_id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false]);
    }
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
                    <button onclick="showSection('personal-info')">Personal Info</button>
                    <button onclick="showSection('attendance')">Attendance</button>
                    <button onclick="showSection('payslip')">Payroll</button>
                </div>

                <div class="section" id="personal-info" style="display: block">
                    <div class="personal-info-window">
                        <div class="profile-card">
                            <img src="<?= !empty($staff['profile_picture']) ? htmlspecialchars($staff['profile_picture']) : '../images/default-profile.png'; ?>" alt="Profile Picture" />
                            <p class="employee-name"><?php echo htmlspecialchars($staff['firstname'] . ' ' . $staff['lastname']); ?></p>
                            <p class="employee-role"><?php echo htmlspecialchars($staff['status']); ?></p>
                            <div class="profile-info">
                                <p>Status: <span><?php echo htmlspecialchars($staff['status']); ?></span></p>
                                <p>Email: <span><?php echo htmlspecialchars($staff['email']); ?></span></p>
                                <p>Contact Number: <span><?php echo htmlspecialchars($staff['cnum']); ?></span></p>
                            </div>
                        </div>

                        <div class="basic-information">                   
                            <h1>Basic Information
                                <?php if ($assigned_id): ?> <a href="edit-employees.php?employee_id=<?= htmlspecialchars($assigned_id); ?>" class="edit-link" style="font-size: 13px; margin-left: 300px;">Edit Profile</a>
                                <?php endif; ?>
                            </h1>
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
                        <img src="<?= !empty($staff['profile_picture']) ? htmlspecialchars($staff['profile_picture']) : '../images/default-profile.png'; ?>" alt="Profile Picture" />
                            <p class="employee-name"><?php echo htmlspecialchars($staff['firstname'] . ' ' . $staff['lastname']); ?></p>
                            <p class="employee-role"><?php echo htmlspecialchars($staff['status']); ?></p>
                            <div class="profile-info">
                                <p>Status: <span><?php echo htmlspecialchars($staff['status']); ?></span></p>
                                <p>Email: <span><?php echo htmlspecialchars($staff['email']); ?></span></p>
                                <p>Contact Number: <span><?php echo htmlspecialchars($staff['cnum']); ?></span></p>
                            </div>
                        </div>

                        <form method="POST" action="">
                            <div class="payslip-table">
                                <h1>Payslip</h1>
                                <div class="payslip-grid">
                                    <p>Basic</p>
                                    <input type="text" name="basic" id="basic" value="<?php echo htmlspecialchars($salary['basic'] ?? ''); ?>" />
                                    <p>Incentives</p>
                                    <input type="text" name="incentives" id="incentives" value="<?php echo htmlspecialchars($salary['incentives'] ?? ''); ?>" />
                                    <p>Overtime</p>
                                    <input type="text" name="overtime" id="overtime" value="<?php echo htmlspecialchars($salary['overtime'] ?? ''); ?>" />
                                    <p class="total-qty">Total</p>
                                    <input type="text" name="total" id="total" value="<?php echo htmlspecialchars($salary['total'] ?? ''); ?>" readonly />
                                </div>
                                <h3>Benefits</h3>
                                <div class="payslip-grid">
                                    <p>SSS</p>
                                    <input type="text" name="sss" id="sss" value="<?php echo htmlspecialchars($salary['sss'] ?? ''); ?>" />
                                    <p>PAGIBIG</p>
                                    <input type="text" name="pagibig" id="pagibig" value="<?php echo htmlspecialchars($salary['pagibig'] ?? ''); ?>" />
                                    <p>PhilHealth</p>
                                    <input type="text" name="philhealth" id="philhealth" value="<?php echo htmlspecialchars($salary['philhealth'] ?? ''); ?>" />
                                    <p class="total-qty">Grand Total</p>
                                    <input type="text" name="grand_total" id="grand_total" value="<?php echo htmlspecialchars($salary['grand_total'] ?? ''); ?>" readonly />
                                </div>
                                <div class="button-container">
                                    <button type="submit" name="save_payslip" class="portal-btn">Save</button>
                                    <button type="button" id="payButton" class="portal-btn">Pay</button>
                                </div>
                            </div>
                        </form>
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

    <script src="script.js"></script>
    <script>
        function updateTotals() {
            const basic = parseFloat(document.getElementById('basic').value) || 0;
            const incentives = parseFloat(document.getElementById('incentives').value) || 0;
            const overtime = parseFloat(document.getElementById('overtime').value) || 0;
            const sss = parseFloat(document.getElementById('sss').value) || 0;
            const pagibig = parseFloat(document.getElementById('pagibig').value) || 0;
            const philhealth = parseFloat(document.getElementById('philhealth').value) || 0;

            const total = basic + incentives + overtime;
            const grandTotal = total + sss + pagibig + philhealth;

            document.getElementById('total').value = total.toFixed(2);
            document.getElementById('grand_total').value = grandTotal.toFixed(2);
        }

        document.querySelectorAll('#basic, #incentives, #overtime, #sss, #pagibig, #philhealth')
            .forEach(input => input.addEventListener('input', updateTotals));

        // Pay button click handler
        document.getElementById('payButton').addEventListener('click', function() {
            showModal('Payment successful!');
        });

        function showSection(sectionId) {
            document.querySelectorAll('.section').forEach(section => {
                section.style.display = 'none';
            });
            document.getElementById(sectionId).style.display = 'block';
        }

        function showModal(message) {
            const modal = document.getElementById('modal');
            const modalText = document.getElementById('modalText');
            const successButton = document.getElementById('successButton');
            const confirmationButtons = document.getElementById('confirmationButtons');

            modalText.textContent = message;
            successButton.style.display = 'block';
            confirmationButtons.style.display = 'none';
            modal.style.display = 'block';

            document.getElementById('okButton').addEventListener('click', function() {
                modal.style.display = 'none';
            });

            document.getElementById('closeModal').addEventListener('click', function() {
                modal.style.display = 'none';
            });

            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        }
    </script>

    <script>
        document.getElementById('deleteEventButton').addEventListener('click', function() {
    const eventId = getCurrentEventId(); // Assume this function retrieves the current event ID

    if (confirm('Are you sure you want to delete this event?')) {
        fetch('delete_event.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ event_id: eventId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Event deleted successfully');
                location.reload(); // Refresh the page to reflect changes
            } else {
                alert('Failed to delete event');
            }
        })
        .catch(error => console.error('Error:', error));
    }
});

    </script>
</body>
</html>

