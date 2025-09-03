document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("newsletterForm");
  const msgBox = document.getElementById("newsMsg");

  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const formData = new FormData(form);

    try {
      const response = await fetch("newsletter.php", {
        method: "POST",
        body: formData,
      });

      const data = await response.json();

      msgBox.className = "form-msg " + (data.status === "success" ? "success" : "error");
      msgBox.innerText = data.message;

      if (data.status === "success") {
        form.reset();
      }
    } catch (error) {
      msgBox.className = "form-msg error";
      msgBox.innerText = "Please try again";
    }
  });
});
