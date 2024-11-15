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

