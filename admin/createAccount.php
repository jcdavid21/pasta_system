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
                <div class="container-fluid px-4">
            <!-- Page indicator -->
            <h1 class="mt-4" id="full_name">Admin</h1>
            <ol class="breadcrumb mb-4">
              <li class="breadcrumb-item active">Create Account</li>
            </ol>

                <div class="card mb-5">
                    <div class="card-body">
                    <form class="row g-3" method="post" id="createEmpAcc">
                            <div class="col-md-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" >
                            </div>

                            <div class="col-md-4">
                                <label for="empPassword" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password">
                            </div>

                            <div class="col-md-4">
                                <label for="empFname" class="form-label">First name</label>
                                <input type="text" class="form-control" id="fname">
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="empLname" class="form-label">Last name</label>
                                <input type="text" class="form-control" id="lname">
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="empMname" class="form-label">Middle name</label>
                                <input type="text" class="form-control" id="mname">
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="empMname" class="form-label">Contact Number</label>
                                <input type="text" class="form-control" id="contact" oninput="validateInput(this)" pattern="\d*" maxlength="11">
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="empAddress" class="form-label">Address</label>
                                <textarea id="address" class="form-control"
                                rows="5" cols="5"></textarea>
                            </div>

                            <div class="col-12 text-start mb-4 mt-5">
                                <button type="submit" id="submit" class="btn btn-primary btn-lg">Sign Up</button>
                            </div>

                        </form>
                    </div>
                </div>
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
    <script src="../jquery/createAccount.js"></script>
    <script src="../scripts/toggle.js"></script>

  </body>
</html>
