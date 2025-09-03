document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("registerForm");

  form.addEventListener("submit", (e) => {
    let valid = true;

    // Reset error messages
    document.querySelectorAll(".error-text").forEach((el) => (el.innerText = ""));
    form.querySelectorAll("input").forEach((el) => el.classList.remove("error", "success"));

    // Name validation
    const name = document.getElementById("full_name");
    if (name.value.trim().length < 3) {
      document.getElementById("err-name").innerText = "Name must be at least 3 characters.";
      name.classList.add("error");
      valid = false;
    } else {
      name.classList.add("success");
    }

    // Email validation
    const email = document.getElementById("email");
    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,}$/;
    if (!emailPattern.test(email.value.trim())) {
      document.getElementById("err-email").innerText = "Enter a valid email address.";
      email.classList.add("error");
      valid = false;
    } else {
      email.classList.add("success");
    }

    // Password validation
    const pass = document.getElementById("password");
    if (pass.value.length < 6) {
      document.getElementById("err-pass").innerText = "Password must be at least 6 characters.";
      pass.classList.add("error");
      valid = false;
    } else {
      pass.classList.add("success");
    }

    if (!valid) e.preventDefault();
  });

  // Live validation on typing
  form.querySelectorAll("input").forEach((input) => {
    input.addEventListener("input", () => {
      form.dispatchEvent(new Event("submit", { cancelable: true }));
    });
  });
});
