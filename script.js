function showSection(sectionId) {
  const sections = document.querySelectorAll(".section");
  sections.forEach((section) => (section.style.display = "none"));

  document.getElementById(sectionId).style.display = "block";
}

document.addEventListener("DOMContentLoaded", function () {
  var calendarEl = document.getElementById("calendar");
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: "dayGridMonth",
    events: "load-events.php", // Load events from the server (PHP)
    editable: true, // Allows editing events
    selectable: true, // Allows selecting dates for new events
    select: function (info) {
      var title = prompt("Enter Event Title:");
      if (title) {
        // Send event to the server to save in database
        fetch("add-event.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            title: title,
            start: info.startStr,
            end: info.endStr,
          }),
        })
          .then((response) => response.json())
          .then((event) => {
            calendar.addEvent(event); // Add the event to the calendar
          });
      }
      calendar.unselect();
    },
    eventClick: function (info) {
      if (confirm("Are you sure you want to delete this event?")) {
        fetch("delete-event.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            id: info.event.id,
          }),
        }).then(() => {
          info.event.remove(); // Remove event from the calendar
        });
      }
    },
  });
  calendar.render();
});
