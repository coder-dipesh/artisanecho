document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("filterForm");
  const selects = form.querySelectorAll("select");
  const productList = document.getElementById("productList");

  const fetchProducts = () => {
    const params = new URLSearchParams(new FormData(form));

    fetch("fetch_products.php?" + params.toString())
      .then((res) => res.text())
      .then((data) => {
        productList.innerHTML = data;
      })
      .catch((err) => {
        productList.innerHTML = "<p class='error'>⚠️ Failed to load products.</p>";
        console.error(err);
      });
  };

  fetchProducts();

  selects.forEach((select) => {
    select.addEventListener("change", fetchProducts);
  });
});
