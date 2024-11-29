function showSection(sectionId) {
  const sections = document.querySelectorAll(".section");
  sections.forEach((section) => (section.style.display = "none"));

  document.getElementById(sectionId).style.display = "block";
}

function displayFileName() {
  const fileInput = document.getElementById("fileInput");
  const fileNameDisplay = document.getElementById("file-name");

  if (fileInput.files.length > 0) {
    fileNameDisplay.textContent = fileInput.files[0].name;
  } else {
    fileNameDisplay.textContent = "No file chosen";
  }
}


/* pop-up window add form */
document.addEventListener("DOMContentLoaded", function() {
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



// attendance display
function filterTable() {
    const input = document.getElementById("search-bar");
    const filter = input.value.toLowerCase();
    const table = document.getElementById("attendance-table");
    const rows = table.getElementsByTagName("tr");

    for (let i = 1; i < rows.length; i++) { // Skip the header row
        const cells = rows[i].getElementsByTagName("td");
        let rowContainsFilter = false;

        for (let j = 0; j < cells.length; j++) {
            const cellValue = cells[j].textContent || cells[j].innerText;
            if (cellValue.toLowerCase().includes(filter)) {
                rowContainsFilter = true;
                break;
            }
        }
    }}

  
   document.addEventListener("DOMContentLoaded", function() {
    const modal = document.getElementById("modal");
    const closeModal = document.getElementById("closeModal");
    const modalText = document.getElementById("modalText");
    const confirmationButtons = document.getElementById("confirmationButtons");
    const confirmYes = document.getElementById("confirmYes");
    const confirmNo = document.getElementById("confirmNo");
    const successButton = document.getElementById("successButton");
    const okButton = document.getElementById("okButton");

    function showModal(message, confirm = false, callback) {
        modal.style.display = "block";
        modalText.textContent = message;
        confirmationButtons.style.display = confirm ? "block" : "none";
        successButton.style.display = confirm ? "none" : "block";

        if (confirm) {
            confirmYes.onclick = function() {
                modal.style.display = "none";
                if (callback) callback(true);
            };
            confirmNo.onclick = function() {
                modal.style.display = "none";
                if (callback) callback(false);
            };
        } else {
            okButton.onclick = function() {
                modal.style.display = "none";
            };
        }
    }

    closeModal.onclick = function() {
        modal.style.display = "none";
    };

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };

    function sendPostRequest(action, assignedId) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                showModal(`${action} successful!`);
                // Refresh attendance after recording
                fetchAttendance(assignedId);
            }
        };
        xhr.send(`assigned_id=${assignedId}&${action.toLowerCase()}=true`);
    }

    function fetchAttendance(assignedId) {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", `?fetch_attendance=true&assigned_id=${assignedId}`, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                const attendanceRecords = JSON.parse(xhr.responseText);
                updateAttendanceTable(attendanceRecords);
            }
        };
        xhr.send();
    }

    function updateAttendanceTable(records) {
        const tbody = document.querySelector(".attendance-table tbody");
        tbody.innerHTML = ''; // Clear current rows

        records.forEach(record => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${record.date}</td>
                <td>${record.recorded_status}</td>
                <td>${record.time_in ?? '-'}</td>
                <td>${record.time_out ?? '-'}</td>
                <td>${record.overtime ?? '-'}</td>
                <td>${record.undertime ?? '-'}</td>
            `;
            tbody.appendChild(row);
        });
    }

    document.getElementById("timeInButton").onclick = function(event) {
        event.preventDefault();
        showModal("Are you sure you want to time in?", true, function(confirm) {
            if (confirm) {
                const assignedId = document.querySelector('input[name="assigned_id"]').value;
                sendPostRequest("Time In", assignedId);
            }
        });
    };

    document.getElementById("timeOutButton").onclick = function(event) {
        event.preventDefault();
        showModal("Are you sure you want to time out?", true, function(confirm) {
            if (confirm) {
                const assignedId = document.querySelector('input[name="assigned_id"]').value;
                sendPostRequest("Time Out", assignedId);
            }
        });
    };

    // Automatically refresh attendance every 60 seconds
    const assignedId = document.querySelector('input[name="assigned_id"]').value;
    setInterval(() => {
        fetchAttendance(assignedId);
    }, 60000); // 60,000 milliseconds = 60 seconds

    // Initial fetch to populate the table
    fetchAttendance(assignedId);
});
