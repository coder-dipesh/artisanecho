document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("contactForm");
  const responseBox = document.getElementById("formResponse");

  form.addEventListener("submit", (e) => {
    e.preventDefault();

    const formData = new FormData(form);

    responseBox.innerHTML = "<p>⏳ Sending...</p>";

    fetch("contact_submit.php", {
      method: "POST",
      body: formData,
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.status === "success") {
          responseBox.innerHTML = `<div class="form-msg success">${data.msg}</div>`;
          form.reset();
        } else {
          responseBox.innerHTML = `<div class="form-msg error">${data.msg}</div>`;
        }
      })
      .catch((err) => {
        console.error(err);
        responseBox.innerHTML = `<div class="form-msg error">⚠️ Something went wrong. Please try again.</div>`;
      });
  });
});
