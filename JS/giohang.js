function update() {
  let tong_Products = 0;
  let tong_Price = 0;

  document.querySelectorAll(".danhmuc tr").forEach((row) => {
    const soluong = parseInt(row.querySelector(".soluong").value);
    const price = parseFloat(row.querySelector(".price").innerText);

    tong_Products += soluong;
    tong_Price += price;
  });

  document.getElementById("total-products").innerText = tong_Products;
  document.getElementById("total-price").innerText =
    tong_Price.toLocaleString() + "đ";
  document.getElementById("subtotal").innerText =
    tong_Price.toLocaleString() + "đ";
}

document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".quantity").forEach((input) => {
    input.addEventListener("change", update);
  });

  update(); // Initial calculation on page load
});
