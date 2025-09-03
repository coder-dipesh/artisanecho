const navToggle = document.querySelector(".nav-toggle");
const nav = document.getElementById("site-nav");

if (navToggle && nav) {
  navToggle.addEventListener("click", () => {
    const expanded = navToggle.getAttribute("aria-expanded") === "true";
    navToggle.setAttribute("aria-expanded", String(expanded));
    nav.classList.toggle("open");
  });
}

// Filter chips (courses, shop, gallery)
function initFilters(containerSelector, itemSelector) {
  const container = document.querySelector(containerSelector);
  if (!container) return;
  const chips = container.querySelectorAll(".chip");
  chips.forEach((chip) => {
    chip.addEventListener("click", () => {
      chips.forEach((c) => c.setAttribute("aria-pressed", "false"));
      chip.setAttribute("aria-pressed", "true");
      const filter = chip.dataset.filter;
      document.querySelectorAll(itemSelector).forEach((item) => {
        if (filter === "all" || item.dataset.cat?.includes(filter)) {
          item.style.display = "";
        } else {
          item.style.display = "none";
        }
      });
    });
  });
}
initFilters(".filters", "[data-cat]");

// Course modal
const modal = document.getElementById("courseModal");
if (modal) {
  const title = modal.querySelector("#courseTitle");
  const desc = modal.querySelector("#courseDesc");
  const closeBtn = modal.querySelector(".modal-close");

  document.querySelectorAll(".learn-more").forEach((btn) => {
    btn.addEventListener("click", () => {
      const courseId = btn.dataset.course;
      const copy = {
        guitar1: {
          t: "Acoustic Guitar Basics",
          d: "Learn open chords, strumming patterns, and your first songs. Includes practice plans and backing tracks.",
        },
        piano1: {
          t: "Piano for Adults",
          d: "Build confidence with reading, rhythm, and technique. Friendly pace and real music from day one.",
        },
        voice1: {
          t: "Kids Vocal Club",
          d: "Sing in a supportive group, learn breathing, pitch, and performance basics.",
        },
      }[courseId] || { t: "Course", d: "Details coming soon." };

      title.textContent = copy.t;
      desc.textContent = copy.d;
      modal.hidden = false;
    });
  });
  closeBtn.addEventListener("click", () => (modal.hidden = true));
  modal.addEventListener("click", (e) => {
    if (e.target === modal) modal.hidden = true;
  });
  document.addEventListener("keydown", (e) => {
    if (!modal.hidden && e.key === "Escape") modal.hidden = true;
  });
}

// Lightbox for gallery images
document.addEventListener("DOMContentLoaded", () => {
  const lb = document.getElementById("lightbox");
  if (!lb) return;

  const lbImg = document.getElementById("lightboxImg");
  const lbCap = document.getElementById("lightboxCap");
  const closeBtn = lb.querySelector(".lightbox-close");

  document.addEventListener("click", (e) => {
    const a = e.target.closest(".gallery-item");
    if (!a) return;

    e.preventDefault();
    const href = a.getAttribute("href");
    if (!href) return; // stop on bad links

    const thumb = a.querySelector("img");
    lbImg.src = href;
    lbImg.alt = thumb ? thumb.alt : "";
    lbCap.textContent = a.dataset.caption || "";

    lb.hidden = false;
    document.body.style.overflow = "hidden";
  });

  function closeLB() {
    lb.hidden = true;
    document.body.style.overflow = "";
  }
  closeBtn.addEventListener("click", closeLB);
  lb.addEventListener("click", (e) => {
    if (e.target === lb) closeLB();
  });
  document.addEventListener("keydown", (e) => {
    if (!lb.hidden && e.key === "Escape") closeLB();
  });
});

// Newsletter form
const newsForm = document.getElementById("newsletterForm");
if (newsForm) {
  const msg = document.getElementById("newsletterMsg");
  newsForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const email = newsForm.email;
    if (!email.checkValidity()) {
      msg.textContent = "Please enter a valid email.";
      msg.className = "form-msg error";
    } else {
      msg.textContent = "Thanks for subscribing.";
      msg.className = "form-msg success";
      newsForm.reset();
    }
  });
}

// Contact form validation
const contactForm = document.getElementById("contactForm");
if (contactForm) {
  const msg = document.getElementById("formMsg");
  contactForm.addEventListener("submit", (e) => {
    if (!contactForm.checkValidity()) {
      e.preventDefault();
      msg.textContent = "Please fix the highlighted fields.";
      msg.className = "form-msg error";
      [...contactForm.elements].forEach((el) =>
        el.setAttribute("aria-invalid", !el.checkValidity() ? "true" : "false")
      );
    } else {
      e.preventDefault();
      msg.textContent = "Thank you. Your message has been sent.";
      msg.className = "form-msg success";
      contactForm.reset();
    }
  });
}

// Courses dropdown filtering
(function () {
  const grid = document.querySelector(".course-grid");
  if (!grid) return;
  const ins = document.getElementById("f-instrument");
  const lvl = document.getElementById("f-level");
  const age = document.getElementById("f-age");
  const run = () => {
    const i = ins.value,
      l = lvl.value,
      a = age.value;
    grid.querySelectorAll(".course").forEach((card) => {
      const ok =
        (i === "all" || card.dataset.instrument === i) &&
        (l === "all" || card.dataset.level === l || card.dataset.level === "all") &&
        (a === "all" || card.dataset.age === a);
      card.style.display = ok ? "" : "none";
    });
  };
  [ins, lvl, age].forEach((s) => s && s.addEventListener("change", run));
})();

// Shop dropdown filtering
(function () {
  const grid = document.querySelector(".product-grid");
  if (!grid) return;
  const type = document.getElementById("s-type");
  const price = document.getElementById("s-price");
  const run = () => {
    const t = type.value,
      p = price.value;
    grid.querySelectorAll(".product").forEach((card) => {
      const ok = (t === "all" || card.dataset.type === t) && (p === "all" || card.dataset.price === p);
      card.style.display = ok ? "" : "none";
    });
  };
  [type, price].forEach((s) => s && s.addEventListener("change", run));
})();
