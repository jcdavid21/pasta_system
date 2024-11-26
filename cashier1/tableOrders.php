<?php
session_start();
if (empty($_SESSION["cashier_id"])) {
  header('Location: logout.php');
  exit(); // Prevent further script execution after redirection
}

require_once("../backend/config/config.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Cashier Panel</title>
    <!-- DataTables -->
    <link href="../plugins/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="../plugins/responsive.bootstrap5.min.css" rel="stylesheet" />
    <link href="../styles/bootstrap5-min.css" rel="stylesheet" />
    <link href="../styles/card-general.css" rel="stylesheet" />
    <script src="../scripts/sweetalert2.js"></script>
    <script src="../scripts/font-awesome.js" crossorigin="anonymous"></script>
  </head>
  <body class="sb-nav-fixed">
    <!-- Navbar -->
    <?php require_once("./navbar.php"); ?>
    <!-- Sidebar -->
    <div id="layoutSidenav">
      <?php require_once("./sidebar.php"); ?>
      <!-- Content -->
      <div id="layoutSidenav_content">
        <main>
          <div class="container-fluid px-4">
            <!-- Page indicator -->
            <h1 class="mt-4" id="full_name">Cashier,</h1>
            <ol class="breadcrumb mb-4">
              <li class="breadcrumb-item active">Sales</li>
            </ol>

            <!-- Pending Orders Card -->
            <div class="card mb-5">
              <div class="card-header bg-secondary pt-3">
                <div class="text-center">
                  <p class="card-title text-light">Online Pending Orders</p>
                </div>
              </div>
              <div class="card-body">
                <table id="residenceAccounts" class="table table-striped nowrap" style="width:100%">
                  <thead>
                    <tr>
                      <th>Order Id</th>
                      <th>Customer Name</th>
                      <th>Order Price</th>
                      <th>Order Quantity</th>
                      <th>Order Type</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $query = "SELECT tc.item_id, tc.account_id, tc.prod_id, tc.prod_qnty, tc.status_id,
                                      tp.prod_name, tp.prod_price, 
                                      CONCAT(ta.first_name, ' ', ta.middle_name, ' ', ta.last_name) as full_name,
                                      ta.contact, ta.address, tn.prod_type_name
                              FROM tbl_cart tc 
                              INNER JOIN tbl_products tp ON tp.prod_id = tc.prod_id 
                              INNER JOIN tbl_account_details ta ON ta.account_id = tc.account_id 
                              LEFT JOIN tbl_product_type tn ON tn.prod_type_id = tp.prod_type
                              WHERE tc.status_id = 3;";

                    $stmt = $conn->prepare($query);
                    if ($stmt === false) {
                      die("Error preparing statement: " . $conn->error);
                    }

                    $stmt->execute();
                    $result = $stmt->get_result();

                    while ($data = $result->fetch_assoc()) {
                      $total = $data["prod_qnty"] * $data["prod_price"];
                    ?>
                      <tr>
                        <td><?php echo htmlspecialchars($data['item_id']); ?></td>
                        <td><?php echo htmlspecialchars($data['full_name']); ?></td>
                        <td>₱<?php echo number_format($data['prod_price'], 2); ?></td>
                        <td><?php echo htmlspecialchars($data['prod_qnty']); ?></td>
                        <td><?php echo htmlspecialchars($data['prod_type_name']); ?></td>
                        <td>
                        <button type="button" class="btn btn-primary" id="<?php echo htmlspecialchars($data['item_id']); ?>" 
                          data-bs-toggle="modal" data-bs-target="#productDetails<?php echo htmlspecialchars($data['item_id']); ?>" 
                          data-bs-whatever="@getbootstrap">
                      <i class="fa-solid fa-eye" style="color: #fcfcfc;"></i>
                  </button>

                          <button type="button" class="btn btn-success updateBtn" id="<?php echo htmlspecialchars($data['item_id']); ?>" data-status-id="<?php echo $data["status_id"] ?>">
                            <i class="fa-solid fa-check" style="color: #fcfcfc;"></i>
                          </button>

                          <button type="button" class="btn btn-danger delete-js" id="<?php echo htmlspecialchars($data['item_id']); ?>">
                            <i class="fa-solid fa-ban" style="color: #fcfcfc;"></i>
                          </button>
                        </td>
                      </tr>

                      <!-- Modal for product details -->
                      <div class="modal fade" id="productDetails<?php echo htmlspecialchars($data['item_id']); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Product Details</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form method="post">
                                <div class="mb-3">
                                  <label class="col-form-label">Customer Name</label>
                                  <input type="text" class="form-control updatedName" value="<?php echo htmlspecialchars($data['full_name']); ?>" disabled>
                                </div>
                                <div class="mb-3">
                                  <label class="col-form-label">Customer Address</label>
                                  <input type="text" class="form-control updatedName" value="<?php echo htmlspecialchars($data['address']); ?>" disabled>
                                </div>
                                <div class="mb-3">
                                  <label class="col-form-label">Customer Contact</label>
                                  <input type="text" class="form-control updatedName" value="<?php echo htmlspecialchars($data['contact']); ?>" disabled>
                                </div>
                                <div class="mb-3">
                                  <label class="col-form-label">Order Name</label>
                                  <input type="text" class="form-control updatedName" value="<?php echo htmlspecialchars($data['prod_name']); ?>" disabled>
                                </div>
                                <div class="mb-3">
                                  <label class="col-form-label">Order Price</label>
                                  <input type="text" class="form-control updatedPrice" value="₱<?php echo number_format($data['prod_price'], 2); ?>" disabled>
                                </div>
                                <div class="mb-3">
                                  <label class="col-form-label">Total</label>
                                  <input type="text" class="form-control updatedPrice" value="₱<?php echo number_format($total, 2); ?>" disabled>
                                </div>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php
                    } // end while
                    ?>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Delivery Orders Card -->
            <div class="card mb-5">
              <div class="card-header bg-secondary pt-3">
                <div class="text-center">
                  <p class="card-title text-light">Online Pending Orders</p>
                </div>
              </div>
              <div class="card-body">
                <table id="residenceAccounts" class="table table-striped nowrap" style="width:100%">
                  <thead>
                    <tr>
                      <th>Order Id</th>
                      <th>Customer Name</th>
                      <th>Order Price</th>
                      <th>Order Quantity</th>
                      <th>Order Type</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $query = "SELECT tc.item_id, tc.account_id, tc.prod_id, tc.prod_qnty, tc.status_id,
                                      tp.prod_name, tp.prod_price, 
                                      CONCAT(ta.first_name, ' ', ta.middle_name, ' ', ta.last_name) as full_name,
                                      ta.contact, ta.address, tn.prod_type_name
                              FROM tbl_cart tc 
                              INNER JOIN tbl_products tp ON tp.prod_id = tc.prod_id 
                              INNER JOIN tbl_account_details ta ON ta.account_id = tc.account_id 
                              LEFT JOIN tbl_product_type tn ON tn.prod_type_id = tp.prod_type
                              WHERE tc.status_id = 4;";

                    $stmt = $conn->prepare($query);
                    if ($stmt === false) {
                      die("Error preparing statement: " . $conn->error);
                    }

                    $stmt->execute();
                    $result = $stmt->get_result();

                    while ($data = $result->fetch_assoc()) {
                      $total = $data["prod_qnty"] * $data["prod_price"];
                    ?>
                      <tr>
                        <td><?php echo htmlspecialchars($data['item_id']); ?></td>
                        <td><?php echo htmlspecialchars($data['full_name']); ?></td>
                        <td>₱<?php echo number_format($data['prod_price'], 2); ?></td>
                        <td><?php echo htmlspecialchars($data['prod_qnty']); ?></td>
                        <td><?php echo htmlspecialchars($data['prod_type_name']); ?></td>
                        <td>
                        <button type="button" class="btn btn-primary" id="<?php echo htmlspecialchars($data['item_id']); ?>" 
                          data-bs-toggle="modal" data-bs-target="#productDetails<?php echo htmlspecialchars($data['item_id']); ?>" 
                          data-bs-whatever="@getbootstrap">
                      <i class="fa-solid fa-eye" style="color: #fcfcfc;"></i>
                  </button>

                          <button type="button" class="btn btn-success updateBtn" id="<?php echo htmlspecialchars($data['item_id']); ?>"
                          date-status-id="<?php echo $data["status_id"] ?>">
                            <i class="fa-solid fa-check" style="color: #fcfcfc;"></i>
                          </button>

                        </td>
                      </tr>

                      <!-- Modal for product details -->
                      <div class="modal fade" id="productDetails<?php echo htmlspecialchars($data['item_id']); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Product Details</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form method="post">
                                <div class="mb-3">
                                  <label class="col-form-label">Customer Name</label>
                                  <input type="text" class="form-control updatedName" value="<?php echo htmlspecialchars($data['full_name']); ?>" disabled>
                                </div>
                                <div class="mb-3">
                                  <label class="col-form-label">Customer Address</label>
                                  <input type="text" class="form-control updatedName" value="<?php echo htmlspecialchars($data['address']); ?>" disabled>
                                </div>
                                <div class="mb-3">
                                  <label class="col-form-label">Customer Contact</label>
                                  <input type="text" class="form-control updatedName" value="<?php echo htmlspecialchars($data['contact']); ?>" disabled>
                                </div>
                                <div class="mb-3">
                                  <label class="col-form-label">Order Name</label>
                                  <input type="text" class="form-control updatedName" value="<?php echo htmlspecialchars($data['prod_name']); ?>" disabled>
                                </div>
                                <div class="mb-3">
                                  <label class="col-form-label">Order Price</label>
                                  <input type="text" class="form-control updatedPrice" value="₱<?php echo number_format($data['prod_price'], 2); ?>" disabled>
                                </div>
                                <div class="mb-3">
                                  <label class="col-form-label">Total</label>
                                  <input type="text" class="form-control updatedPrice" value="₱<?php echo number_format($total, 2); ?>" disabled>
                                </div>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php
                    } // end while
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>

    <script
      src="../scripts/bootstrap.bundle.min.js"
    ></script>
    <script src="../scripts/jquery.js"></script>
    <script src="../scripts/toggle.js"></script>
    <script src="../jquery/updatePending.js"></script>
    <!-- DataTables Scripts -->
    <script src="../plugins/js/jquery.dataTables.min.js"></script>
    <script src="../plugins/js/dataTables.bootstrap5.min.js"></script>
    <script src="../plugins/js/dataTables.responsive.min.js"></script>
    <script src="../plugins/js/responsive.bootstrap5.min.js"></script>

    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" href="../styles/dataTables.min.css">

    <!-- DataTables Buttons JavaScript -->
    <script src="../scripts/dataTables.js"></script>
    <script src="../scripts/ajax.make.min.js"></script>
    <script src="../scripts/ajax.fonts.js"></script>
    <script src="../scripts/dtBtn.html5.js"></script>

    <script src="../jquery/cancelOrder.js"></script>
    <script>
      $(document).ready(function() {
        $("#residenceAccounts").DataTable();
        $("#toClaimOrders").DataTable();
      });

      const cashierDetails = localStorage.getItem("cashierDetails");
      if (cashierDetails) {
        const cashierData = JSON.parse(cashierDetails);
        document.getElementById("full_name").innerHTML = `Hi, ${cashierData.full_name}`;
      } else {
        console.error("Cashier details not found in local storage.");
      }
    </script>
  </body>
</html>
