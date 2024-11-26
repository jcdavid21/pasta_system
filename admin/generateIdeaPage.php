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

                    <!-- Page Heading -->
                    <!-- DataTales Example -->
                    <div class="card my-4">
                        <div class="card-header bg-white">
                            <h4 class="card-title
                            ">Generate Idea</h4>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive  overflow-hidden p-0">
                                <form class="row justify-content-center g-4 p-4" method="post" id="addProdMain">
                                    <div class="col-md-6">
                                        <label for="prod_description" class="form-label">Response Here</label>
                                        <textarea class="form-control" style="height: 80%;" id="prod_description" rows="10" cols="10" placeholder="Generated Response" required disabled></textarea>
                                    </div>

                                    <div class="col-12 text-center mt-4">
                                        <!-- Add a loading spinner -->
                                        <div id="loading-spinner" style="display: none;">
                                            <div class="spinner-border text-dark" role="status">

                                            </div>
                                        </div>
                                        <button type="submit" id="submit-main" class="btn btn-dark btn-lg px-5">Generate Idea</button>
                                    </div>

                                </form>
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

    <script>
       $('#submit-main').on('click', function(e) {
    e.preventDefault();

    const loadingSpinner = $('#loading-spinner');
    const submitButton = $('#submit-main');

    // Disable the button and show the loading spinner
    submitButton.prop('disabled', true);
    loadingSpinner.show();

    // Add a delay before making the AJAX call (e.g., 1 second)
    setTimeout(() => {
        // Send the prompt to the backend API
        $.ajax({
            url: './generateIdea.php',
            method: 'POST',
            success: function(response) {
                try {
                    const data = JSON.parse(response);
                    console.log(data)
                    if (data.status === 'success') {
                        $('#prod_description').val(data.generated_text);
                        $('#prod_description').css('line-height', '1.5');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message || 'Failed to generate flavor idea!',
                        });
                    }
                } catch (err) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Invalid response from the server!',
                    });
                    console.error(err);
                }
            },
            error: function(jqXHR) {
                if (jqXHR.status === 429) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Rate Limit Exceeded',
                        text: 'You have exceeded the rate limit for API requests. Please try again later.',
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'An error occurred while processing your request. Please try again.',
                    });
                }
            },
            complete: function() {
                // Enable the button and hide the loading spinner
                submitButton.prop('disabled', false);
                loadingSpinner.hide();
            }
        });
    }, 1000); // 1-second delay
});
</script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>
    

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
     
    <script src="../jquery/sideBarProd.js"></script>
    <script src="../scripts/toggle.js"></script>


  </body>
</html>
