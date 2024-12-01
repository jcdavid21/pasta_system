<?php
session_start();
if (empty($_SESSION["admin_id"])) {
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
   <!-- Custom fonts for this template -->
   <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="../scripts/font-awesome.js"></script>
    <script src="../scripts/sweetalert2.js"></script>
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../styles/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  </head>
  <body class="page-top">
    
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include "sidebar.php"; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include "navbar.php"; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Order Details Table</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Order Id</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Size</th>
                                            <th>Quantity</th>
                                            <th>Date to Pick up</th>
                                            <th>Address</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Size</th>
                                            <th>Quantity</th>
                                            <th>Date to Pick up</th>
                                            <th>Address</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                        <?php
                            $status_id = isset($_GET["status_id"]) ? $_GET["status_id"] : 3;
                            $query = "SELECT 
                                          tc.item_id, 
                                          tc.account_id, 
                                          tc.prod_id, 
                                          tc.prod_qnty, 
                                          tc.status_id,
                                          tp.prod_name, 
                                          tc.prod_size,
                                          tc.order_date,
                                          tc.claim_date,
                                          CASE 
                                              WHEN tc.prod_size = 'small' THEN tp.prod_price_small
                                              WHEN tc.prod_size = 'medium' THEN tp.prod_price_medium
                                              WHEN tc.prod_size = 'large' THEN tp.prod_price_large
                                          END AS prod_price,
                                          CONCAT(ta.first_name, ' ', IFNULL(ta.middle_name, ''), ' ', ta.last_name) AS full_name,
                                          ta.contact, 
                                          ta.address, 
                                          tn.prod_type_name
                                      FROM tbl_cart tc
                                      INNER JOIN tbl_products tp ON tp.prod_id = tc.prod_id 
                                      INNER JOIN tbl_account_details ta ON ta.account_id = tc.account_id 
                                      LEFT JOIN tbl_product_type tn ON tn.prod_type_id = tp.prod_type
                                      WHERE tc.status_id = ?";
                            $stmt = $conn->prepare($query);
                            $stmt->bind_param("i", $status_id);
                            if ($stmt === false) {
                            die("Error preparing statement: " . $conn->error);
                            }

                            $stmt->execute();
                            $result = $stmt->get_result();

                            while ($data = $result->fetch_assoc()) {
                                $total = $data['prod_price'] * $data['prod_qnty'];
                                $formatted_date = date("F j, Y", strtotime($data['claim_date']));
                                $prod_size = array(
                                  "small" => "12",
                                  "medium" => "14",
                                  "large" => "16"
                              );
                        ?>
                        <tr>
                        <td><?php echo htmlspecialchars($data['item_id']); ?></td>
                        <td><?php echo htmlspecialchars($data['full_name']); ?></td>
                        <td>₱<?php echo number_format($data['prod_price'], 2); ?></td>
                        <td><?php echo $prod_size[$data['prod_size']]; ?>"</td>
                        <td><?php echo htmlspecialchars($data['prod_qnty']); ?></td>
                        <td><?php echo htmlspecialchars($formatted_date); ?></td>
                        <td><?php echo htmlspecialchars($data['address']); ?></td>
                        <td>₱<?php echo number_format($total, 2); ?></td>
                        <td>
                            <button type="button" class="btn btn-primary" id="<?php echo htmlspecialchars($data['item_id']); ?>" 
                            data-bs-toggle="modal" data-bs-target="#productDetails<?php echo htmlspecialchars($data['item_id']); ?>" 
                            data-bs-whatever="@getbootstrap"
                            style="font-size: 12px;">
                                View
                            </button>
                            <?php 
                              if($status_id == 3 || $status_id == 4) {
                            ?>
                            <button type="button" class="btn btn-success updateBtn" id="<?php echo htmlspecialchars($data['item_id']); ?>" data-status-id="<?php echo $data["status_id"] ?>"
                            style="font-size: 12px;" 
                            data-bs-toggle="modal">
                              Update
                            </button>
                          <?php 
                            }?>
                        <?php 
                            if($status_id == 3 || $status_id == 4) {
                        ?>
        
                          <button type="button" class="btn btn-danger delete-js" id="cancel<?php echo htmlspecialchars($data['item_id']); ?>"
                          style="font-size: 12px;" data-bs-toggle="modal" data-bs-target="#cancelRemarksModal"
                          data-item-id="<?php echo htmlspecialchars($data['item_id']); ?>">
                            Cancel
                          </button>
                        </td>
                        <?php
                        } ?>
                      </tr>
                      <!-- Modal for product details -->
                      <div class="modal fade" id="productDetails<?php echo htmlspecialchars($data['item_id']); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form method="post">
                                <div class="d-flex">
                                    <div class="mb-3 col-md-6">
                                    <label class="col-form-label">Customer Name</label>
                                    <input type="text" class="form-control updatedName" value="<?php echo htmlspecialchars($data['full_name']); ?>" disabled>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                    <label class="col-form-label">Customer Contact</label>
                                    <input type="text" class="form-control updatedName" value="<?php echo htmlspecialchars($data['contact']); ?>" disabled>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label class="col-form-label">Customer Address</label>
                                    <input type="text" class="form-control updatedName" value="<?php echo htmlspecialchars($data['address']); ?>" disabled>
                                    </div>
                                <div class="d-flex">
                                
                                    <div class="mb-3 col-md-12">
                                    <label class="col-form-label">Order Name</label>
                                    <input type="text" class="form-control updatedName" value="<?php echo htmlspecialchars($data['prod_name']); ?>" disabled>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="mb-3 col-md-6">
                                      <label class="col-form-label">Order Price</label>
                                      <input type="text" class="form-control updatedPrice" value="₱<?php echo number_format($data['prod_price'], 2); ?>" disabled>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                      <label class="col-form-label">Order Quantity</label>
                                      <input type="text" class="form-control updatedPrice" value="<?php echo htmlspecialchars($data['prod_qnty']); ?>" disabled>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-12">
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

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Cancel Remarks Modal -->
<div class="modal fade" id="cancelRemarksModal" tabindex="-1" aria-labelledby="cancelRemarksLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cancelRemarksLabel">Cancel Order Remarks</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" id="cancelOrderForm">
          <input type="hidden" id="cancelItemId" name="item_id">
          <div class="mb-3">
            <label for="cancelRemarks" class="form-label">Remarks</label>
            <textarea class="form-control" id="cancelRemarks" name="cancel_remarks" rows="3" required></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id="confirmCancel">Cancel Order</button>
      </div>
    </div>
  </div>
</div>

            

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->


    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../scripts/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>
    <script src="../jquery/updatePending.js"></script>
    <script src="../jquery/AdminCancel.js"></script>
    <script src="../jquery/sideBarProd.js"></script>
    <script src="../scripts/toggle.js"></script>

  </body>
</html>
