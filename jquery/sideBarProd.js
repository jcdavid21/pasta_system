$(document).ready(function() {
  // Click event for product type
  $('.prod-type').click(function(e) {
    e.preventDefault(); // Prevent the default link behavior
    var typeId = $(this).data('type-id');
    loadProducts(typeId);
  });

  // Click event for order status
  $('.status-order').click(function(e) {
    e.preventDefault(); // Prevent the default link behavior
    var status_id = $(this).data('status-id');
    loadOrders(status_id);
  });
});

// Function to load products based on type
function loadProducts(typeId) {
  $.ajax({
    url: 'products.php',
    type: 'GET',
    data: { type: typeId },
    success: function(response) {
      // Redirect to products page with the type ID
      window.location.href = "products.php?type=" + typeId;
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log("Error: " + textStatus, errorThrown);
    }
  });
}

// Function to load orders based on status
function loadOrders(status_id) {
  $.ajax({
    url: 'tableOrders.php',
    type: 'GET',
    data: { status: status_id },
    success: function(response) {
      // Redirect to orders page with the status ID
      window.location.href = "tableOrders.php?status_id=" + status_id;
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log("Error: " + textStatus, errorThrown);
    }
  });
}
