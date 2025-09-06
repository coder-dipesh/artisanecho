document.addEventListener("DOMContentLoaded", () => {
  const chips = document.querySelectorAll(".chip");
  const items = document.querySelectorAll(".gallery-item");
  const lightbox = document.getElementById("lightbox");
  const lightboxImg = document.getElementById("lightboxImg");
  const lightboxCap = document.getElementById("lightboxCap");
  const closeBtn = document.querySelector(".lightbox-close");

  // Filtering
  chips.forEach((chip) => {
    chip.addEventListener("click", () => {
      chips.forEach((c) => c.classList.remove("active"));
      chip.classList.add("active");
      const filter = chip.dataset.filter;

      items.forEach((item) => {
        if (filter === "all" || item.dataset.cat === filter) {
          item.style.display = "block";
        } else {
          item.style.display = "none";
        }
      });
    });
  });

  // Lightbox
  items.forEach((item) => {
    item.addEventListener("click", (e) => {
      e.preventDefault();
      lightboxImg.src = item.href;
      lightboxCap.textContent = item.dataset.caption;
      lightbox.removeAttribute("hidden");
    });
  });

  closeBtn.addEventListener("click", () => lightbox.setAttribute("hidden", true));
  lightbox.addEventListener("click", (e) => {
    if (e.target === lightbox) lightbox.setAttribute("hidden", true);
  });
});
