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

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
    <script>
    document.addEventListener("DOMConatentLoaded", function() {
        var calendarEl = document.getElementById("calendar");
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: "dayGridMonth",
        });
        calendar.render();
    });
    </script>
</head>

<body>
    <?php include "components/sidebar.php"; ?>

    <main style="margin-left: 85px">
        <div class="breadcrumbs">
            <div class="left">
                <p>Admin > <span>CALENDAR</span></p>
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

        <section class="calendar-section">
            <div class="calendar-container">
                <div class="events-list-container">
                    <h1>Events</h1>
                    <div class="events-cards">
                        <div class="event-card">
                            <span class="material-symbols-outlined">event</span>
                            <p class="calendar-event-name">Event Sample</p>
                            <p class="calendar-event-date">October 21, 2024</p>
                        </div>

                        <div class="event-card">
                            <span class="material-symbols-outlined">event</span>
                            <p class="calendar-event-name">Event Sample</p>
                            <p class="calendar-event-date">October 21, 2024</p>
                        </div>

                        <div class="event-card">
                            <span class="material-symbols-outlined">event</span>
                            <p class="calendar-event-name">Event Sample</p>
                            <p class="calendar-event-date">October 21, 2024</p>
                        </div>
                    </div>
                </div>
                <div id="calendar" class="calendar"></div>
            </div>
        </section>
    </main>
</body>
<script src="script.js"></script>
<script src=" https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js "></script>

</html>

<div class="payslip-table">
            <h1>Payslip</h1>
            <div class="payslip-grid">
                <p>Basic</p>
                <span><?php echo htmlspecialchars($salary['basic'] ?? '0.00'); ?></span>
                <p>Incentives</p>
                <span><?php echo htmlspecialchars($salary['incentives'] ?? '0.00'); ?></span>
                <p>Overtime</p>
                <span><?php echo htmlspecialchars($salary['overtime'] ?? '0.00'); ?></span>
                <p class="total-qty">Total</p>
                <span class="total-qty">
                    <?php
                    echo htmlspecialchars(
                        number_format(
                            ($salary['basic'] ?? 0) +
                            ($salary['incentives'] ?? 0) +
                            ($salary['overtime'] ?? 0),
                            2
                        )
                    );
                    ?>
                </span>
            </div>

            <h3>Benefits</h3>
            <div class="payslip-grid">
                <p>SSS</p>
                <span><?php echo htmlspecialchars($salary['sss'] ?? '0.00'); ?></span>
                <p>PAGIBIG</p>
                <span><?php echo htmlspecialchars($salary['pagibig'] ?? '0.00'); ?></span>
                <p>PhilHealth</p>
                <span><?php echo htmlspecialchars($salary['philhealth'] ?? '0.00'); ?></span>
                <p class="total-qty">Total</p>
                <span class="total-qty" style="margin-bottom: 2rem">
                    <?php
                    echo htmlspecialchars(
                        number_format(
                            ($salary['sss'] ?? 0) +
                            ($salary['pagibig'] ?? 0) +
                            ($salary['philhealth'] ?? 0),
                            2
                        )
                    );
                    ?>
                </span>
                <div></div>
                <p><?php echo htmlspecialchars($salary['final_pay'] ?? '0.00'); ?></p>
            </div>