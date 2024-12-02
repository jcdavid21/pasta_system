<?php
session_start();
if (empty($_SESSION["admin_id"])) {
    header('Location:logout.php');
    exit;
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

    <title>Admin Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../styles/sb-admin-2.min.css" rel="stylesheet">

    <style>
        .statistics-details {
    background: linear-gradient(135deg, #f9f9f9, #e0e0e0);
    padding: 20px; 
    border-radius: 10px; 
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
    margin-bottom: 20px;
}
.statistics-details div {
    background: #ffffff; 
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    text-align: center;
}
.statistics-title {
    font-size: 14px;
    color: #6c757d;
    margin-bottom: 10px;
}
.rate-percentage {
    font-size: 24px;
    color: #343a40;
    font-weight: bold;
}

    </style>

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
                    <div class="statistics-details d-flex align-items-center justify-content-between">
                        <!-- Total Sales -->
                        <div>
                            <?php
                            $query = "SELECT SUM(td.prod_price * tc.prod_qnty) AS total_sales FROM tbl_cart tc INNER JOIN tbl_delivered_orders td ON tc.item_id = td.item_id";
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $data = $result->fetch_assoc();
                            ?>
                            <p class="statistics-title">Total Sales</p>
                            <h3 class="rate-percentage">₱<?php echo !empty($data["total_sales"]) ? number_format($data["total_sales"], 2) : "0.00"; ?></h3>
                        </div>

                        <!-- Pending Orders -->
                        <div>
                            <?php
                            $query = "SELECT COUNT(item_id) AS total_pending FROM tbl_cart WHERE status_id = 3";
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $data = $result->fetch_assoc();
                            ?>
                            <p class="statistics-title">Pending Orders</p>
                            <h3 class="rate-percentage"><?php echo !empty($data["total_pending"]) ? $data["total_pending"] : "0"; ?></h3>
                        </div>

                        <!-- Success Orders -->
                        <div>
                            <?php
                            $query = "SELECT COUNT(item_id) AS total_claimed FROM tbl_cart WHERE status_id = 2";
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $data = $result->fetch_assoc();
                            ?>
                            <p class="statistics-title">Success Orders</p>
                            <h3 class="rate-percentage"><?php echo $data["total_claimed"]; ?></h3>
                        </div>

                        <!-- Cancelled Orders -->
                        <div>
                            <?php
                            $query = "SELECT COUNT(item_id) AS cancelled_orders FROM tbl_cart WHERE status_id = 5";
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $data = $result->fetch_assoc();
                            ?>
                            <p class="statistics-title">Cancelled Orders</p>
                            <h3 class="rate-percentage"><?php echo !empty($data["cancelled_orders"]) ? $data["cancelled_orders"] : "0"; ?></h3>
                        </div>

                        <!-- Number of Users -->
                        <div>
                            <?php
                            $query = "SELECT COUNT(account_id) AS total_users FROM tbl_account WHERE role_id = 1";
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $data = $result->fetch_assoc();
                            ?>
                            <p class="statistics-title">Number of Users</p>
                            <h3 class="rate-percentage"><?php echo $data["total_users"]; ?></h3>
                        </div>
                    </div>

                    <!-- Monthly Sales -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-7">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Monthly Sales</h6>
                                </div>
                                <div class="card-body">
                                    <?php
                                    $currentYear = date("Y");
                                    $monthlyQuery = "SELECT 
                                                        m.MonthName AS Dates,
                                                        IFNULL(SUM(
                                                            td.prod_price * tc.prod_qnty
                                                        ), 0) AS serviceRequestBcCount
                                                    FROM
                                                        (SELECT 'January' AS MonthName, 1 AS MonthNumber UNION ALL
                                                        SELECT 'February', 2 UNION ALL
                                                        SELECT 'March', 3 UNION ALL
                                                        SELECT 'April', 4 UNION ALL
                                                        SELECT 'May', 5 UNION ALL
                                                        SELECT 'June', 6 UNION ALL
                                                        SELECT 'July', 7 UNION ALL
                                                        SELECT 'August', 8 UNION ALL
                                                        SELECT 'September', 9 UNION ALL
                                                        SELECT 'October', 10 UNION ALL
                                                        SELECT 'November', 11 UNION ALL
                                                        SELECT 'December', 12) AS m
                                                    LEFT JOIN tbl_cart tc ON MONTH(tc.order_date) = m.MonthNumber 
                                                        AND YEAR(tc.order_date) = ?
                                                        AND tc.status_id = 2
                                                    LEFT JOIN tbl_delivered_orders td ON tc.item_id = td.item_id
                                                    GROUP BY m.MonthNumber
                                                    ORDER BY m.MonthNumber;";
                                    $stmt = $conn->prepare($monthlyQuery);
                                    $stmt->bind_param("i", $currentYear);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    $monthlyBc = [];
                                    $serviceRequestBcCount = [];
                                    while ($row = $result->fetch_assoc()) {
                                        $monthlyBc[] = $row['Dates'];
                                        $serviceRequestBcCount[] = $row['serviceRequestBcCount'];
                                    }
                                    ?>
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                    <hr>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <script>
        var monthlyBc = <?php echo json_encode($monthlyBc); ?>;
        var serviceRequestBcCount = <?php echo json_encode($serviceRequestBcCount); ?>;
    </script>
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../jquery/sideBarProd.js"></script>
</body>

</html>
