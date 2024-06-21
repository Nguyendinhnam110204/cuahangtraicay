document.addEventListener("DOMContentLoaded", function () {
  var form = document.getElementById("checkoutForm");
  var provinceSelect = document.getElementById("province");
  var districtSelect = document.getEleamentById("district");
  var wardSelect = document.getElementById("wards");

  // Lưu giá trị của province vào localStorage khi thay đổi
  provinceSelect.addEventListener("change", function () {
    localStorage.setItem("selectedProvince", this.value);
  });

  // Phục hồi giá trị của province từ localStorage
  var selectedProvince = localStorage.getItem("selectedProvince");
  if (selectedProvince) {
    provinceSelect.value = selectedProvince;

    // Gọi AJAX để load danh sách quận huyện dựa trên tỉnh thành đã chọn
    $.ajax({
      url: "getDistricts.php", // Thay đổi đường dẫn và file xử lý AJAX của bạn tại đây
      method: "POST",
      data: { province_id: selectedProvince },
      success: function (data) {
        districtSelect.innerHTML = data;
      },
    });
  }

  // Lưu giá trị của district vào localStorage khi thay đổi
  districtSelect.addEventListener("change", function () {
    localStorage.setItem("selectedDistrict", this.value);
  });

  // Phục hồi giá trị của district từ localStorage
  var selectedDistrict = localStorage.getItem("selectedDistrict");
  if (selectedDistrict) {
    districtSelect.value = selectedDistrict;

    // Gọi AJAX để load danh sách phường xã dựa trên quận huyện đã chọn
    $.ajax({
      url: "./ajax_get_district.php", // Thay đổi đường dẫn và file xử lý AJAX của bạn tại đây
      method: "POST",
      data: { district_id: selectedDistrict },
      success: function (data) {
        wardSelect.innerHTML = data;
      },
    });
  }

  // Lưu giá trị của ward vào localStorage khi thay đổi
  wardSelect.addEventListener("change", function () {
    localStorage.setItem("selectedWard", this.value);
  });

  // Phục hồi giá trị của ward từ localStorage
  var selectedWard = localStorage.getItem("selectedWard");
  if (selectedWard) {
    wardSelect.value = selectedWard;
  }

  // Xử lý việc gửi biểu mẫu
  form.addEventListener("submit", function (event) {
    // Xóa localStorage sau khi submit để không lưu lại giá trị cũ
    localStorage.removeItem("selectedProvince");
    localStorage.removeItem("selectedDistrict");
    localStorage.removeItem("selectedWard");
  });
});
