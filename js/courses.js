document.addEventListener("DOMContentLoaded", () => {
  const instrument = document.getElementById("fInstrument");
  const level = document.getElementById("fLevel");
  const age = document.getElementById("fAge");
  const courseList = document.getElementById("courseList");

  const modal = document.getElementById("courseModal");
  const modalTitle = document.getElementById("courseTitle");
  const modalDesc = document.getElementById("courseDesc");
  const modalActions = document.getElementById("courseActions");
  const modalClose = document.querySelector(".modal-close");

  function fetchCourses() {
    const params = new URLSearchParams({
      instrument: instrument.value,
      level: level.value,
      age: age.value,
    });

    courseList.innerHTML = "<p>Loading courses...</p>";

    fetch("fetch_courses.php?" + params.toString())
      .then((res) => res.text())
      .then((data) => {
        courseList.innerHTML = data;

        // Attach modal listeners
        document.querySelectorAll(".learn-more").forEach((btn) => {
          btn.addEventListener("click", (e) => {
            e.preventDefault();
            openModal(btn.dataset.courseId);
          });
        });
      })
      .catch((err) => {
        courseList.innerHTML = "<p class='error'>⚠️ Failed to load courses.</p>";
        console.error(err);
      });
  }

  function openModal(courseId) {
    fetch("course_details.php?id=" + courseId)
      .then((res) => res.json())
      .then((data) => {
        if (data.error) {
          modalTitle.textContent = "Not found";
          modalDesc.textContent = "This course could not be loaded.";
          modalActions.innerHTML = "";
        } else {
          modalTitle.textContent = data.title;
          modalDesc.innerHTML = `
            <p><strong>Instrument:</strong> ${data.instrument}</p>
            <p><strong>Level:</strong> ${data.level}</p>
            <p><strong>Duration:</strong> ${data.duration}</p>
            <p><strong>Age Group:</strong> ${data.age_group}</p>
            <p>${data.description}</p>
          `;

          // // Enroll button (depends on session)
          // <?php if (isset($_SESSION['user_id'])): ?>
          //   modalActions.innerHTML = `<a href="enroll.php?course_id=${data.id}" class="btn btn-primary">Enroll Now</a>`;
          // <?php else: ?>
          //   modalActions.innerHTML = `<a href="login.php" class="btn btn-primary">Login to Enroll</a>`;
          // <? php endif; ?>
        }
        modal.removeAttribute("hidden");
      })
      .catch((err) => {
        modalTitle.textContent = "Error";
        modalDesc.textContent = "Could not load course details.";
        modalActions.innerHTML = "";
        modal.removeAttribute("hidden");
      });
  }

  modalClose.addEventListener("click", () => modal.setAttribute("hidden", true));
  modal.addEventListener("click", (e) => {
    if (e.target === modal) modal.setAttribute("hidden", true);
  });

  // Initial load
  fetchCourses();

  // Refetch when filters change
  [instrument, level, age].forEach((sel) => sel.addEventListener("change", fetchCourses));
});
