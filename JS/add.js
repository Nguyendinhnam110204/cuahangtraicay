document.addEventListener("DOMContentLoaded", function () {
  // Function to load districts based on selected province
  function loadDistricts(provinceId, selectedDistrict) {
    $.ajax({
      url: "ajax_get_district.php",
      type: "POST",
      data: { province_id: provinceId },
      success: function (data) {
        const districts = JSON.parse(data);
        const districtSelect = document.getElementById("district");
        districtSelect.innerHTML = ""; // Clear existing options
        districts.forEach(function (district) {
          const option = document.createElement("option");
          option.value = district.id;
          option.textContent = district.name;
          if (district.id == selectedDistrict) {
            option.selected = true;
          }
          districtSelect.appendChild(option);
        });
        // Trigger load wards if a district is selected
        if (selectedDistrict) {
          loadWards(selectedDistrict, selectedWard);
        }
      },
    });
  }

  // Function to load wards based on selected district
  function loadWards(districtId, selectedWard) {
    $.ajax({
      url: "ajax_get_wards.php",
      type: "POST",
      data: { district_id: districtId },
      success: function (data) {
        const wards = JSON.parse(data);
        const wardsSelect = document.getElementById("wards");
        wardsSelect.innerHTML = ""; // Clear existing options
        wards.forEach(function (ward) {
          const option = document.createElement("option");
          option.value = ward.id;
          option.textContent = ward.name;
          if (ward.id == selectedWard) {
            option.selected = true;
          }
          wardsSelect.appendChild(option);
        });
      },
    });
  }

  // Event listeners for province and district changes
  document.getElementById("province").addEventListener("change", function () {
    loadDistricts(this.value, null);
  });

  document.getElementById("district").addEventListener("change", function () {
    loadWards(this.value, null);
  });

  // Restore the selected values after form submission
  if (selectedProvince) {
    loadDistricts(selectedProvince, selectedDistrict);
  }

  if (selectedDistrict) {
    loadWards(selectedDistrict, selectedWard);
  }
});
