<?php
include "components/connector.php"; // Include your database connection file

// Fetch events from the database
$query = "SELECT event_name, event_date, event_organizer FROM events_table ORDER BY event_date ASC";
$result = $conn->query($query);
$events = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $events[] = $row; // Add each event to the array
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Calendar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="styles.css" />

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
   
</head>
<div>
<?php include "components/sidebar.php"; ?>

<main style="margin-left: 85px">
    <div class="breadcrumbs">
        <div class="left">
            <p>Admin > <span>CALENDAR</span></p>
        </div>
        <div class="right">
            <a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-user" aria-hidden="true"></i></a>
        </div>
    </div>

    <section class="calendar-section">
        <div class="calendar-container">
            
            <div class="events-list-container">
                <h1>Events</h1>
                <div class="events-cards">
                    <?php foreach ($events as $event): ?>
                        <div class="event-card">
                            <span class="material-symbols-outlined">event</span>
                            <p class="calendar-event-name"><?php echo htmlspecialchars($event['event_name']); ?></p>
                            <p class="calendar-event-date"><?php echo date("F j, Y", strtotime($event['event_date'])); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div id="calendar" class="calendar"></div>
        </div>
       <button id="addEventButton" class="add-event-btn">Add Event</button>
   
    </section>
</main>

<!-- Modal -->

<div id="addEventModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Add Event</h2>
        <form action="add_event.php" method="POST">
            <label for="event_name">Event Name:</label>
            <input type="text" id="event_name" name="event_name" required>

            <label for="event_date">Event Date:</label>
            <input type="date" id="event_date" name="event_date" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description"></textarea>

            <label for="event_date">Event Organizer:</label>
            <input type="text" id="event_organizer" name="event_organizer" required>

            <button type="submit" class="add-btn">Add Event</button>
        </form>
    </div>
</div>
                

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var calendarEl = document.getElementById("calendar");
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: "dayGridMonth",
            events: [
                <?php foreach ($events as $event): ?>
                {
                    title: "<?php echo htmlspecialchars($event['event_name']); ?>",
                    start: "<?php echo $event['event_date']; ?>"
                },
                <?php endforeach; ?>
            ]
        });
        calendar.render();

        // Modal logic
        var modal = document.getElementById("addEventModal");
        var btn = document.getElementById("addEventButton");
        var span = document.getElementsByClassName("close")[0];

        btn.onclick = function() {
            modal.style.display = "block";
        };

        span.onclick = function() {
            modal.style.display = "none";
        };

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };
    });
</script>
</body>
</html>