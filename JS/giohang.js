function update() {
  let tong_Products = 0;
  let tong_Price = 0;

  document.querySelectorAll(".product_rows").forEach((row) => {
    const price = parseFloat(row.querySelector(".price").innerText);
    const productRows = document.querySelectorAll(".product_rows");
    const productcount = productRows.length;
    tong_Products = productcount;
    tong_Price += price;
  });

  document.getElementById("total-products").innerText = tong_Products;
  document.getElementById("total-price").innerText =
    tong_Price.toLocaleString() + "đ";
  document.getElementById("subtotal").innerText =
    tong_Price.toLocaleString() + "đ";

  // Cập nhật số lượng sản phẩm vào local storage
  localStorage.setItem("cartItemCount", tong_Products);
  //cập nhật tổng số tiền
  localStorage.setItem("cartTotalPrice", tong_Price);
  // Cập nhật số lượng sản phẩm trên biểu tượng giỏ hàng
  updateCartIcon();
}

function updateCartIcon() {
  const cartIcon = document.getElementById("cart-icon");
  const productCount = localStorage.getItem("cartItemCount") || 0;
  cartIcon.setAttribute("number", productCount);
}

document.addEventListener("DOMContentLoaded", (event) => {
  document.querySelectorAll(".quantity").forEach((input) => {
    input.addEventListener("change", update);
  });

  update(); // Tính toán ban đầu khi tải trang
  updateCartIcon(); // Cập nhật biểu tượng giỏ hàng khi tải trang
});
