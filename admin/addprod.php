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
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Add Product</title>
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
                <div class="container-fluid px-4">

                    <div class="card mb-5">
                        <div class="card-body">
                        <form class="row g-3" method="post" id="addProd">
                                <div class="col-md-4">
                                    <label for="prod_name" class="form-label">Product Name</label>
                                    <input type="text" class="form-control" id="prod_name" >
                                </div>

                                <div class="col-md-4">
                                    <label for="prod_price" class="form-label">Product Price Small</label>
                                    <input type="text" class="form-control" id="prod_price_small" oninput="validateNumberInput(this)">
                                </div>

                                <div class="col-md-4">
                                    <label for="prod_price" class="form-label">Product Price Medium</label>
                                    <input type="text" class="form-control" id="prod_price_medium" oninput="validateNumberInput(this)">
                                </div>

                                <div class="col-md-4">
                                    <label for="prod_price" class="form-label">Product Price Large</label>
                                    <input type="text" class="form-control" id="prod_price_large" oninput="validateNumberInput(this)">
                                </div>

                                <div class="col-md-4 mb-2">
                                    <label for="prod_type" class="form-label">Product Type</label>
                                    <select id="prod_type" class="form-control">
                                        <option value="" disabled selected>Select Product</option>
                                        <?php
                                        $query = "SELECT * FROM tbl_product_type";
                                        $stmt = $conn->prepare($query);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        while($data = $result->fetch_assoc()){
                                        ?>
                                        <option value="<?php echo $data["prod_type_id"]; ?>">
                                        <?php echo $data["prod_type_name"];  ?>    
                                        </option>
                                        <?php } ?>
                                    </select>      
                                </div>
                                <div class="col-md-4">
                                    <label for="prod_img" class="form-label">Product Image</label>
                                    <input type="file" class="form-control" id="prod_img">
                                </div>
                                <div class="col-12 text-center mb-4 mt-5">
                                    <button type="submit" id="submit" class="btn btn-primary btn-lg">Add Product</button>
                                </div>

                            </form>
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
    <script src="../jquery/sideBarProd.js"></script>
    <script src="../jquery/addprod.js"></script>
    <script src="../scripts/toggle.js"></script>
    <script>
function validateNumberInput(input) {
    input.value = input.value.replace(/[^0-9]/g, '');
}
</script>

  </body>
</html>
