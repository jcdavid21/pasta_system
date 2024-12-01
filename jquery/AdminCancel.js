// When the cancel button is clicked, set the item ID in the modal
$('#cancelRemarksModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // The button that triggered the modal
    var itemId = button.data('item-id'); // Get the item_id from data-item-id

    // Set the item ID in the hidden input field
    var modal = $(this);
    modal.find('#cancelItemId').val(itemId);
  });

  // Handle the Cancel order confirmation
  $('#confirmCancel').on('click', function() {
    var itemId = $('#cancelItemId').val();
    var cancelRemarks = $('#cancelRemarks').val();

    if (cancelRemarks.trim() === '') {
      alert('Please enter remarks before canceling.');
      return;
    }

    // Send the cancellation request with the remarks via AJAX
    $.ajax({
      url: '../backend/admin/AdminCancel.php',
      method: 'POST',
      data: {
        item_id: itemId,
        cancel_remarks: cancelRemarks
      },
      success: function(response) {
         if(response === 'Order canceled successfully'){
            Swal.fire({
                title: "Order Canceled",
                text: "Order has been canceled.",
                showConfirmButton: false,
                timer: 2000
            }).then((result)=>{
                window.location.reload();;
            })
         }
      },
      error: function() {
        alert('There was an error canceling the order. Please try again.');
      }
    });
  });