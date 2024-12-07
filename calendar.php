<?php
include "components/connector.php";
include "components/logactivity.php";

// Fetch events
$sql_events = "SELECT * FROM events_table";
$result_events = $conn->query($sql_events);

$events = [];
if ($result_events->num_rows > 0) {
    while ($row = $result_events->fetch_assoc()) {
        $events[] = $row;
    }
}

// Add event
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['event_name'])) {
    $event_name = $_POST['event_name'];
    $event_date = $_POST['event_date'];
    $event_description = $_POST['event_description'];
    $event_organizer = $_POST['event_organizer'];
    $user_recorded = 'admin';

    $stmt = $conn->prepare("INSERT INTO events_table (event_name, event_date, event_description, event_organizer) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $event_name, $event_date, $event_description, $event_organizer);

    if ($stmt->execute()) {
        // Log the activity
        $activity_name = "Add Event";
        $data_recorded = "Event: $event_name, Date: $event_date, Organizer: $event_organizer";
        record_log($conn, $activity_name, $data_recorded, $user_recorded);

        echo "<script>alert('Event added successfully!'); window.location.href='calendar.php';</script>";
    } else {
        echo "<script>alert('Error adding event.'); window.location.href='calendar.php';</script>";
    }

    $stmt->close();
}

// Delete event
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_event'], $_POST['event_id'])) {
    $event_id = intval($_POST['event_id']);

    if ($event_id > 0) {
        $sql = "DELETE FROM events_table WHERE event_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $event_id);

        if ($stmt->execute()) {
            die('success');
        } else {
            die('Error deleting event: ' . $stmt->error);
        }
        $stmt->close();
    } else {
        die('Invalid event ID.');
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Calendar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="styles.css" />
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
</head>

<body>
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
                        <?php 
                        if (!empty($events)) {
                            foreach ($events as $event) { ?>
                        <a href="#" class="event-card" data-event_name="<?= htmlspecialchars($event['event_name']); ?>"
                            data-event_date="<?= date("F j, Y", strtotime($event['event_date'])) ?>"
                            data-event_organizer="<?= htmlspecialchars($event['event_organizer']) ?>"
                            data-event_description="<?= htmlspecialchars($event['event_description']) ?>"
                            data-event_id="<?= $event['event_id']; ?>">
                            <span class="material-symbols-outlined">event</span>
                            <p class="calendar-event-name"><?= htmlspecialchars($event['event_name']); ?></p>
                            <p class="calendar-event-date"><?= date("F j, Y", strtotime($event['event_date'])) ?></p>
                        </a>
                        <?php }
                        } else { ?>
                        <p>No events found</p>
                        <?php } ?>
                    </div>
                </div>
                <div id="calendar" class="calendar"></div>
            </div>
            <button id="delete_event" class="add-event-btn">Add Event</button>
        </section>
    </main>

    <!-- Modal Event card pop-up -->
    <div id="eventModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <div class="modal-event-field modal-header">
                <span class="material-symbols-outlined">event</span>
                <h2 id="modalEventName"></h2>
            </div>
            <div class="modal-event-field">
                <span class="modal-event-span">Date: </span>
                <p id="modalEventDate"></p>
            </div>
            <div class="modal-event-field">
                <span class="modal-event-span">Organizer:</span>
                <p id="modalEventOrganizer"></p>
            </div>
            <div class="modal-event-field">
                <span class="modal-event-span">Description:</span>
                <p id="modalEventDescription"></p>
            </div>
            <button id="deleteEventButton" class="delete-btn" onclick="deleteEvent()">Delete Event</button>
        </div>
    </div>

    <!-- add event modal -->
    <div id="addEventModal" class="add-event-modal modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Add Event</h2>
            <form method="POST" class="add-event-form">
                <div>
                    <label for="event_name">Event Name:</label><br>
                    <input type="text" id="event_name" name="event_name" required>
                </div>

                <div>
                    <label for="event_date">Event Date:</label><br>
                    <input type="date" id="event_date" name="event_date" required>
                </div>

                <div>
                    <label for="event_description">Description:</label><br>
                    <textarea id="event_description" name="event_description"></textarea>
                </div>

                <div>
                    <label for="event_organizer">Event Organizer:</label><br>
                    <input type="text" id="event_organizer" name="event_organizer" required>
                </div>

                <button type="submit" class="add-event-btn">Add Event</button>
            </form>
        </div>
    </div>

    <script>
        function deleteEvent() {
        const eventId = document.getElementById("deleteEventButton").dataset.event_id;
        console.log("Deleting event with ID:", eventId); // Debugging

        fetch('calendar.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `delete_event=1&event_id=${eventId}`
        })
        .then(response => response.text())
        .then(responseText => {
            console.log("Server response:", responseText); // Debugging
            if (responseText.includes('success')) {
                alert('Event deleted successfully');
                location.reload();
            } else {
                alert('Failed to delete event');
                console.error('Response:', responseText);
            }
        })
        .catch(error => console.error('Error:', error));
    }



    document.addEventListener("DOMContentLoaded", function() {
        var calendarEl = document.getElementById("calendar");
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: "dayGridMonth",
            events: [
                <?php foreach ($events as $event): ?> {
                    title: "<?php echo htmlspecialchars($event['event_name']); ?>",
                    start: "<?php echo $event['event_date']; ?>"
                },
                <?php endforeach; ?>
            ]
        });
        calendar.render();

        // Modal logic
        var eventModal = document.getElementById("eventModal");
        var addEventModal = document.getElementById("addEventModal");
        var addEventButton = document.getElementById("addEventButton");
        var closeModalBtns = document.querySelectorAll(".modal .close");

        // Event listener for event cards
        document.querySelectorAll(".event-card").forEach(function(card) {
            card.addEventListener("click", function(e) {
                e.preventDefault(); // Prevent default anchor behavior
                document.getElementById("modalEventName").textContent = card.dataset.event_name;
                document.getElementById("modalEventDate").textContent = card.dataset.event_date;
                document.getElementById("modalEventOrganizer").textContent = card.dataset.event_organizer;
                document.getElementById("modalEventDescription").textContent = card.dataset.event_description;
                document.getElementById("deleteEventButton").dataset.event_id = card.dataset.event_id;
                eventModal.style.display = "block";
            });
        });

        // Add Event Button
        addEventButton.onclick = function() {
            addEventModal.style.display = "block";
        };

        // Close Modals
        closeModalBtns.forEach(function(btn) {
            btn.onclick = function() {
                eventModal.style.display = "none";
                addEventModal.style.display = "none";
            };
        });

        window.onclick = function(event) {
            if (event.target == eventModal || event.target == addEventModal) {
                eventModal.style.display = "none";
                addEventModal.style.display = "none";
            }
        };
    });
    </script>
</body>
</html>
