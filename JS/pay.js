document.addEventListener("DOMContentLoaded", function () {
  const checkphuongthuc = document.getElementById("bidvqr");
  const mabidv = document.getElementById("bidv");
  const anbidv = document.getElementById("bidvqr_row");

  document.addEventListener("change", function () {
    if (checkphuongthuc.checked) {
      mabidv.style.display = "flex";
    } else {
      mabidv.style.display = "none";
    }
  });
});
