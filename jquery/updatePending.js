$(document).ready(() => {
  $('.updateBtn').on('click', function () {
    const item_id = $(this).attr('id');
    const current_status = $(this).data('status-id');
    let status_id = 0;

    if (current_status == 3) {
      status_id = 4;
    } else {
      status_id = 2;
    }

    Swal.fire({
      title: "Are you sure?",
      text: "This item will update the order status.",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes!",
    }).then((result) => {
      if (result.isConfirmed) {
        // If moving to "Driver Details" status
        if (current_status == 3) {
          Swal.fire({
            title: "Driver Details",
            html: `
              <input type="text" id="driverName" class="swal2-input" placeholder="Driver's Name">
              <input type="text" id="driverContact" class="swal2-input" placeholder="Driver's Contact Number">
              <input type="text" id="driverRemarks" class="swal2-input" placeholder="Driver's Remarks">
            `,
            showCancelButton: true,
            confirmButtonText: "Save",
          }).then((driverResult) => {
            if (driverResult.isConfirmed) {
              const driverName = $('#driverName').val();
              const driverContact = $('#driverContact').val();
              const driverRemarks = $('#driverRemarks').val();

              // Validate the driver details
              if (!driverName || !driverContact) {
                Swal.fire({
                  title: "Error!",
                  text: "Driver Name and Contact are required.",
                  icon: "error",
                  confirmButtonText: "OK",
                });
                return; // Stop the process if validation fails
              }

              // Save driver details to the database
              $.ajax({
                url: "../backend/admin/saveDriverDetails.php", // New endpoint for driver details
                method: "POST",
                data: {
                  item_id,
                  driverName,
                  driverContact,
                  driverRemarks,
                },
                success: function (driverResponse) {
                  if (driverResponse === 'success') {
                    // Proceed to update the order status after driver details are saved
                    $.ajax({
                      url: "../backend/cashier/updatePending.php",
                      method: "POST",
                      data: {
                        item_id,
                        status_id,
                      },
                      success: function (response) {
                        if (response === 'success') {
                          window.location.reload();
                        } else if (response === 'exceeds') {
                          Swal.fire({
                            title: "Invalid stocks!",
                            text: "Quantity requested exceeds available stock.",
                            showConfirmButton: false,
                            timer: 2000,
                          });
                        }
                      },
                      error: function () {
                        alert("Connection Error");
                      },
                    });
                  } else {
                    Swal.fire({
                      title: "Error!",
                      text: "Failed to save driver details. Please try again.",
                      icon: "error",
                      confirmButtonText: "OK",
                    });
                  }
                },
                error: function () {
                  alert("Error connecting to server for driver details.");
                },
              });
            }
          });
        } else {
          // For other statuses, directly update the order status
          $.ajax({
            url: "../backend/cashier/updatePending.php",
            method: "POST",
            data: {
              item_id,
              status_id,
            },
            success: function (response) {
              if (response === 'success') {
                window.location.reload();
              } else if (response === 'exceeds') {
                Swal.fire({
                  title: "Invalid stocks!",
                  text: "Quantity requested exceeds available stock.",
                  showConfirmButton: false,
                  timer: 2000,
                });
              }
            },
            error: function () {
              alert("Connection Error");
            },
          });
        }
      }
    });
  });

  // $('.acceptBtn').on('click', function () {
  //   const item_id = $(this).attr('id');
  //   const status_id = 2;
  //   const prod_id = $(this).data('prod-id');
  //   const prod_qnty = $(this).data('prod-qnty');

  //   Swal.fire({
  //     title: "Are you sure?",
  //     text: "This item will proceed to claim.",
  //     showCancelButton: true,
  //     confirmButtonColor: "#3085d6",
  //     cancelButtonColor: "#d33",
  //     confirmButtonText: "Yes!",
  //   }).then((result) => {
  //     if (result.isConfirmed) {
  //       $.ajax({
  //         url: "../backend/cashier/updatePending.php",
  //         method: "POST",
  //         data: {
  //           item_id,
  //           status_id,
  //           prod_id,
  //           prod_qnty,
  //         },
  //         success: function (response) {
  //           if (response === 'success') {
  //             window.location.reload();
  //           } else if (response === 'exceeds') {
  //             Swal.fire({
  //               title: "Invalid stocks!",
  //               text: "Quantity requested exceeds available stock.",
  //               showConfirmButton: false,
  //               timer: 2000,
  //             });
  //           }
  //         },
  //         error: function () {
  //           alert("Connection Error");
  //         },
  //       });
  //     }
  //   });
  // });
});
