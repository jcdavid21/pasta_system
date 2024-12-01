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
                            <h6 class="m-0 font-weight-bold text-primary">Accounts Table</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Role</th>
                                            <th>Name</th>
                                            <th>Contact</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Role</th>
                                            <th>Name</th>
                                            <th>Contact</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            $query = "SELECT ta.account_id, CONCAT(tc.first_name, ' ', tc.middle_name, ' ', tc.last_name) AS full_name, tc.contact, tc.address, tc.first_name, tc.middle_name, tc.last_name, tr.role_name FROM tbl_account ta INNER JOIN tbl_account_details tc ON tc.account_id = ta.account_id
                                            INNER JOIN tbl_role tr ON tr.role_id = ta.role_id 
                                            WHERE ta.account_status_id = 1;";
                                            $stmt = $conn->prepare($query);
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            while ($data = $result->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $data['account_id'];?></td>
                                            <td><?php echo $data['role_name'];?></td>
                                            <td><?php echo $data['full_name'];?></td>
                                            <td><?php echo $data['contact'];?></td>
                                            <td><?php echo $data['address'];?></td>
                                            <td>
                                                <button type="button" class="btn btn-primary" id="<?php echo $data["account_id"] ?>" 
                                                data-bs-toggle="modal" data-bs-target="#accountDetails<?php echo $data["account_id"] ?>" 
                                                data-bs-whatever="@getbootstrap">
                                                    <i class="fa-solid fa-user-pen" style="color: #fcfcfc;"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger deactivateResBtn" id="<?php echo $data["account_id"] ?>" >
                                                <i class="fa-solid fa-user-xmark"  style="color: #fcfcfc;"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="accountDetails<?php echo $data["account_id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">User Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <form method="post">
                                                        <div class="mb-3 col-md-12">
                                                            <label class="col-form-label">User ID</label>
                                                            <input type="text" class="form-control updatedName" value="<?php echo $data['account_id']; ?>" disabled>
                                                        </div>

                                                        <div class="d-flex">
                                                            <div class="mb-3 col-md-6">
                                                                <label class="col-form-label">First Name</label>
                                                                <input type="text" class="form-control updateFname" value="<?php echo htmlspecialchars($data['first_name']); ?>"
                                                                oninput="validateNameInput(this)" >

                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label class="col-form-label">Middle Name</label>
                                                                <input type="text" class="form-control updateMname" value="<?php echo htmlspecialchars($data['middle_name']); ?>"
                                                                oninput="validateNameInput(this)" >
                                                            </div>
                                                        </div>

                                                        <div class="d-flex">
                                                            <div class="mb-3 col-md-6">
                                                                <label class="col-form-label">Last Name</label>
                                                                <input type="text" class="form-control updateLname" value="<?php echo htmlspecialchars($data['last_name']); ?>"
                                                                oninput="validateNameInput(this)" >
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label class="col-form-label">Contact</label>
                                                                <input type="text" class="form-control updateContact" min="11" max="11" value="<?php echo htmlspecialchars($data['contact']); ?>"
                                                                oninput="validateContactInput(this)" >
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-md-12">
                                                            <label class="col-form-label">Address</label>
                                                            <input type="text" class="form-control updateAddress" value="<?php echo htmlspecialchars($data['address']); ?>"  >
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="password" class="form-label">Password</label>
                                                            <div class="input-group">
                                                                <input type="password" class="form-control updatePassword" >
                                                                <span class="input-group-text toggle-password" data-target="updatePassword" style="cursor: pointer;">
                                                                    <i class="fa-solid fa-eye icon"></i>
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 mt-2">
                                                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                                                            <div class="input-group">
                                                                <input type="password" class="form-control updateConfirmpassword" >
                                                                <span class="input-group-text toggle-password" style="cursor: pointer;" data-target="updateConfirmpassword">
                                                                    <i class="fa-solid fa-eye icon"></i>
                                                                </span>
                                                            </div>
                                                        </div>

                                                    </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary updateAccount" id="<?php echo $data["account_id"] ?>">Update</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
    <script src="../jquery/sideBarProd.js"></script>
    <script src="../jquery/deactivate.js"></script>
    <script src="../jquery/AdminUpdateProfile.js"></script>
    <script>
         document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.toggle-password').forEach(toggle => {
                toggle.addEventListener('click', function () {
                    const targetId = this.getAttribute('data-target');
                    const targetInput = $(this).closest('.input-group').find(`.${targetId}`)[0];
                    const icon = this.querySelector('.icon');

                    if (targetInput) {
                        if (targetInput.type === 'password') {
                            targetInput.type = 'text'; // Change input type to text
                            icon.classList.remove('fa-eye'); // Remove eye icon
                            icon.classList.add('fa-eye-slash'); // Add eye-slash icon
                        } else {
                            targetInput.type = 'password'; // Change input type back to password
                            icon.classList.remove('fa-eye-slash'); // Remove eye-slash icon
                            icon.classList.add('fa-eye'); // Add eye icon
                        }
                    } else {
                        console.error(`Input with id '${targetId}' not found.`);
                    }
                });
            });
        });
    </script>
    <script>
        function validateNameInput(input) {
            const regex = /^[A-Za-z\s]*$/; // Allows only letters and spaces
            if (!regex.test(input.value)) {
                input.value = input.value.replace(/[^A-Za-z\s]/g, ''); // Remove invalid characters
            }
        }

        function validateContactInput(input) {
            const regex = /^[0-9]*$/; // Allows only numbers
            if (!regex.test(input.value)) {
                input.value = input.value.replace(/[^0-9]/g, ''); // Remove invalid characters
            }
        }

    </script>
    <script src="../scripts/toggle.js"></script>


  </body>
</html>
