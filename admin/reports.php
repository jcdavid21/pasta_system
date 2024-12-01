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
    <title>Admin Panel</title>
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
                            <h6 class="m-0 font-weight-bold text-primary">Feedback Table</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Product Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Product Name</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                        $query = "SELECT tf.*, CONCAT(td.first_name, ' ', td.last_name) AS full_name, tp.prod_name FROM tbl_item_feedback tf
                                        INNER JOIN tbl_account_details td ON tf.account_id = td.account_id
                                        INNER JOIN tbl_products tp ON tf.prod_id = tp.prod_id";                            
                                        $stmt = $conn->prepare($query);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        while ($data = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?php echo $data['fd_id'];?></td>
                                        <td><?php echo $data['full_name'];?></td>
                                        <td><?php echo $data['prod_name'];?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary" id="<?php echo $data["fd_id"] ?>"  data-bs-toggle="modal" 
                                            data-bs-target="#residenceAccountDetails<?php echo $data["fd_id"] ?>" data-bs-whatever="@getbootstrap">
                                            <i class="fa-solid fa-eye" style="color: #fcfcfc;"></i>
                                            </button>
                                            <button class="btn btn-danger delete" id="<?php echo $data["fd_id"]; ?>" >
                                                <i class="fa-solid fa-trash" style="color: #fcfcfc;"></i>
                                            </button>
                            
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="residenceAccountDetails<?php echo $data["fd_id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Feedback Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <form method="post">
                                                <div class="mb-3">
                                                <label class="col-form-label">Customer Name</label>
                                                <input type="text" class="form-control updatedName" disabled value="<?php echo $data["full_name"]; ?>" >
                                                </div>
                                                <div class="mb-3">
                                                <label class="col-form-label">Customer Message</label>
                                                <textarea class="form-control" id="message-text" disabled ><?php echo $data["fd_comment"]; ?></textarea>
                                                </div>
                                                </form>
                                            </div>
                                    
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        }
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
    <script src="../jquery/deleteFd.js"></script>
    <script src="../jquery/sideBarProd.js"></script>
    <script src="../scripts/toggle.js"></script>
  </body>
</html>
