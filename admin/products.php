<?php
session_start();
if(empty($_SESSION["admin_id"])){
  header('Location:logout.php');
}
require_once("../backend/config/config.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin</title>

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

<body id="page-top">

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

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
                    <!-- DataTales Example -->

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Product Table</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Product ID</th>
                                            <th></th>
                                            <th>Product Name</th>
                                            <th>Product Price (12)</th>
                                            <th>Product Price (14)</th>
                                            <th>Product Price (16)</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Product ID</th>
                                            <th></th>
                                            <th>Product Name</th>
                                            <th>Product Price (12)</th>
                                            <th>Product Price (14)</th>
                                            <th>Product Price (16)</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            if(isset($_GET['type'])){
                                                $prodId = intval($_GET["type"]);
                                                $query = "SELECT * FROM tbl_products WHERE prod_type = ?";
                                                $stmt = $conn->prepare($query);
                                                $stmt->bind_param("i", $prodId);
                                                $stmt->execute();
                                                $result = $stmt->get_result();

                                                while ($data = $result->fetch_assoc()) {
                                        ?>
                                        <tr class="product-row" data-prod-id="<?php echo $data['prod_id']; ?>" data-prod-name="<?php echo $data['prod_name']; ?>">
                                            <td><?php echo $data['prod_id']; ?></td>
                                            <td>
                                                <div class="img-con" style="height: 60px;">
                                                    <img src="../assets/products/<?php echo $data['prod_img']; ?>" alt="item" class="img-fluid"
                                                    style="height: 100%; width: 100%; object-fit:contain;">
                                                </div>
                                            </td>
                                            <td><?php echo $data['prod_name']; ?></td>
                                            <td>₱<?php echo number_format($data['prod_price_small'], 2); ?></td>
                                            <td>₱<?php echo number_format($data['prod_price_medium'], 2); ?></td>
                                            <td>₱<?php echo number_format($data['prod_price_large'], 2); ?></td>
                                            <td>
                                                <button type="button" class="btn btn-primary" id="<?php echo $data["prod_id"] ?>" data-bs-toggle="modal" data-bs-target="#residenceAccountDetails<?php echo $data["prod_id"] ?>" data-bs-whatever="@getbootstrap">
                                                    <i class="fa-solid fa-pen-to-square" style="color: #fcfcfc;"></i>
                                                </button>

                                                <button type="button" class="btn btn-danger deleteProd" value="<?php echo $data["prod_id"] ?>">
                                                    <i class="fa-solid fa-trash" style="color: #fcfcfc;"></i>
                                                </button>
                                            </td>
                                        </tr>
                                            <div class="modal fade" id="residenceAccountDetails<?php echo $data["prod_id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Product Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                <form method="post">
                                                    <div class="mb-3">
                                                    <label class="col-form-label">Product Name</label>
                                                    <input type="text" class="form-control updatedName" value="<?php echo $data["prod_name"]; ?>" >
                                                    </div>
                                                    <div class="mb-3">
                                                    <label class="col-form-label">Product Price (12)</label>
                                                    <input type="number" class="form-control priceSmall" value="<?php echo $data["prod_price_small"]; ?>" >
                                                    </div>

                                                    <div class="mb-3">
                                                    <label class="col-form-label">Product Price (14)</label>
                                                    <input type="number" class="form-control priceMedium" value="<?php echo $data["prod_price_medium"]; ?>" >
                                                    </div>

                                                    <div class="mb-3">
                                                    <label class="col-form-label">Product Price (16)</label>
                                                    <input type="number" class="form-control priceLarge" value="<?php echo $data["prod_price_large"]; ?>" >
                                                    </div>

                                                    <div class="mb-3">
                                                    <label class="col-form-label">Product Description</label>
                                                    <input type="text" class="form-control updatedDesc" value="<?php echo $data["prod_description"]; ?>">
                                                    </div>
                                                </form>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-primary btn-accept updateResBtn" value="<?php echo $data["prod_id"] ?>" >
                                                    Save
                                                </button>
                                                    <button type="button" class="btn btn-secondary " value="<?php echo $data["prod_id"]; ?>" data-bs-dismiss="modal">Close</button>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                        <?php
                                            } }
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
    <script
      src="../scripts/bootstrap.bundle.min.js"
    ></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>
    <script src="../jquery/sideBarProd.js"></script>
    <script src="../jquery/modifyProd.js"></script>
    <script src="../scripts/toggle.js"></script>

</body>

</html>
