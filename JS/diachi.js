$(document).ready(function () {
  // Listen for changes in the "province" select box
  $("#province").on("change", function () {
    var province_id = $(this).val();
    console.log("Selected province_id: " + province_id); // Debug line
    if (province_id) {
      // If a province is selected, fetch the districts for that province using AJAX
      $.ajax({
        url: "ajax_get_district.php",
        method: "POST",
        dataType: "json",
        data: {
          province_id: province_id,
        },
        success: function (data) {
          console.log("District data received: ", data); // Debug line
          // Clear the current options in the "district" select box
          $("#district").empty();

          // Add the new options for the districts for the selected province
          $.each(data, function (i, district) {
            $("#district").append(
              $("<option>", {
                value: district.id,
                text: district.name,
              })
            );
          });
          // Clear the options in the "wards" select box
          $("#wards").empty();
        },
        error: function (xhr, textStatus, errorThrown) {
          console.log("Error: " + errorThrown);
        },
      });
      $("#wards").empty();
    } else {
      // If no province is selected, clear the options in the "district" and "wards" select boxes
      $("#district").empty();
      $("#wards").empty();
    }
  });

  // Listen for changes in the "district" select box
  $("#district").on("change", function () {
    var district_id = $(this).val();
    console.log("Selected district_id: " + district_id); // Debug line
    if (district_id) {
      // If a district is selected, fetch the awards for that district using AJAX
      $.ajax({
        url: "ajax_get_wards.php",
        method: "POST",
        dataType: "json",
        data: {
          district_id: district_id,
        },
        success: function (data) {
          console.log("Wards data received: ", data); // Debug line
          // Clear the current options in the "wards" select box
          $("#wards").empty();
          // Add the new options for the awards for the selected district
          $.each(data, function (i, wards) {
            $("#wards").append(
              $("<option>", {
                value: wards.id,
                text: wards.name,
              })
            );
          });
        },
        error: function (xhr, textStatus, errorThrown) {
          console.log("Error: " + errorThrown);
        },
      });
    } else {
      // If no district is selected, clear the options in the "award" select box
      $("#wards").empty();
    }
  });
});
