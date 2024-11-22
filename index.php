<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'components/connector.php'; 

// Query for events
$sql_events = "SELECT event_id, event_name, event_date, event_organizer FROM events_table";
$result_events = $conn->query($sql_events);

// Query for total employees
$sql_total = "SELECT COUNT(*) AS total_staffs FROM staffs_table";
$result_total = $conn->query($sql_total);

$row_total = $result_total->fetch_assoc();
$total_count = $row_total['total_staffs'];

// Query for present today
$sql_active_today = "SELECT COUNT(*) AS active_today FROM staffs_table WHERE status = 'active'";
$result_active_today = $conn->query($sql_active_today);

$row_active_today = $result_active_today->fetch_assoc();
$active_today_count = $row_active_today['active_today'];

// Query for absent today
$sql_absent_today = "SELECT COUNT(*) AS absent_today FROM staffs_table WHERE status = 'absent'";
$result_absent_today = $conn->query($sql_absent_today);

$row_absent_today = $result_absent_today->fetch_assoc();
$absent_today_count = $row_absent_today['absent_today'];

//Query for on-leave today
$sql_leave_today = "SELECT COUNT(*) AS leave_today FROM staffs_table WHERE status = 'onleave'";
$result_leave_today = $conn->query($sql_leave_today);

$row_leave_today = $result_leave_today->fetch_assoc();
$leave_today_count = $row_leave_today['leave_today'];


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="styles.css" />
</head>

<body>
    <?php include 'components/sidebar.php'; ?>
    <main style="margin-left: 85px">
        <div class="breadcrumbs">
            <div class="left">
                <p>Admin > <span>DASHBOARD</span></p>
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

        <section class="dashboard-analytics">
            <div class="dashboard">
                <div class="dashboard-card card-1">
                    <div>
                        <h2>Total Employees</h2>
                        <p><?php echo $total_count; ?></p>
                    </div>
                </div>
                <div class="dashboard-card card-2">
                    <div>
                        <h2>Present Today</h2>
                        <p><?php echo $active_today_count; ?></p>
                    </div>
                </div>
                <div class="dashboard-card card-3">
                    <div>
                        <h2>Total Absents</h2>
                        <p><?php echo $absent_today_count; ?></p>
                    </div>
                </div>
                <div class="dashboard-card card-4">
                    <div>
                        <h2>On-Leave Today</h2>
                        <p><?php echo $leave_today_count;?></p>
                    </div>
                </div>
            </div>
        </section>

        <section class="event-section">
            <div class="events-container">
                <div class="events-panel">
                    <h1>Events</h1>
                    <?php 
                    
                    if ($result_events -> num_rows > 0) {
                        while($row = $result_events -> fetch_assoc()) {?>

                    <a href="#" class="event-card">
                        <span class="material-symbols-outlined">event</span>
                        <h3 class="event-name">
                            <?= htmlspecialchars($row['event_name']);?>
                        </h3>
                        <p class="event-date"><?= date("F j, Y", strtotime($row['event_date']))?></p>
                        <p class="event-coordinator"><?= htmlspecialchars($row['event_organizer'])?></p>
                    </a>

                    <?php }
                        } else {?>
                    <p>No events found</p>
                    <?php }?>
                </div>
            </div>

            <div class="activity-log-container">
                <h1>Activity Log</h1>
                <div class="activity-flex">
                    <div class="activity-card">
                        <p class="activity-name">Sample Activity</p>
                        <div class="activity-date">
                            <p>October 21, 2024</p>
                            <p>10:24AM</p>
                        </div>
                    </div>

                    <div class="activity-card">
                        <p class="activity-name">Sample Activity</p>
                        <div class="activity-date">
                            <p>October 21, 2024</p>
                            <p>10:24AM</p>
                        </div>
                    </div>

                    <div class="activity-card">
                        <p class="activity-name">Sample Activity</p>
                        <div class="activity-date">
                            <p>October 21, 2024</p>
                            <p>10:24AM</p>
                        </div>
                    </div>

                    <div class="activity-card">
                        <p class="activity-name">Sample Activity</p>
                        <div class="activity-date">
                            <p>October 21, 2024</p>
                            <p>10:24AM</p>
                        </div>
                    </div>

                    <div class="activity-card">
                        <p class="activity-name">Sample Activity</p>
                        <div class="activity-date">
                            <p>October 21, 2024</p>
                            <p>10:24AM</p>
                        </div>
                    </div>

                    <div class="activity-card">
                        <p class="activity-name">Sample Activity</p>
                        <div class="activity-date">
                            <p>October 21, 2024</p>
                            <p>10:24AM</p>
                        </div>
                    </div>

                    <div class="activity-card">
                        <p class="activity-name">Sample Activity</p>
                        <div class="activity-date">
                            <p>October 21, 2024</p>
                            <p>10:24AM</p>
                        </div>
                    </div>

                    <div class="activity-card">
                        <p class="activity-name">Sample Activity</p>
                        <div class="activity-date">
                            <p>October 21, 2024</p>
                            <p>10:24AM</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>