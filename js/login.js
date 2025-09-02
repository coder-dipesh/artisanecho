document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");
  const email = document.getElementById("email");
  const pass = document.getElementById("password");
  const toggleBtn = document.getElementById("togglePassword");

  // Toggle password visibility
  toggleBtn.addEventListener("click", () => {
    const isText = pass.type === "text";
    pass.type = isText ? "password" : "text";
    toggleBtn.textContent = isText ? "👁" : "🙈";
  });

  // Validation helpers
  const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,}$/;

  function setError(input, msgId, message) {
    input.classList.remove("success");
    input.classList.add("error");
    document.getElementById(msgId).innerText = message;
  }

  function setSuccess(input, msgId) {
    input.classList.remove("error");
    input.classList.add("success");
    document.getElementById(msgId).innerText = "";
  }

  function validateEmail() {
    if (!emailPattern.test(email.value.trim())) {
      setError(email, "err-email", "Enter a valid email address.");
      return false;
    }
    setSuccess(email, "err-email");
    return true;
  }

  function validatePass() {
    if (pass.value.trim().length < 6) {
      setError(pass, "err-pass", "Password must be at least 6 characters.");
      return false;
    }
    setSuccess(pass, "err-pass");
    return true;
  }

  // On submit: validate both
  form.addEventListener("submit", function (e) {
    const okEmail = validateEmail();
    const okPass = validatePass();
    if (!okEmail || !okPass) e.preventDefault();
  });

  // Live validation
  email.addEventListener("input", validateEmail);
  pass.addEventListener("input", validatePass);
});
