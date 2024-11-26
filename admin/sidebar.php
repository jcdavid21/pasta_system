<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../scripts/font-awesome.js"></script>
</head>
<body>
    <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-text mx-1">Maristel's Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="./index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Manage</div>

    <!-- Nav Item - Flower Lists Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fa-solid fa-fw fa-wheat-awn"></i>
            <span>Products</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <?php
                    $query = "SELECT * FROM tbl_product_type";
                    $stmt = $conn->prepare($query);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while ($data = $result->fetch_assoc()) {
                        $prodId = $data["prod_type_id"];
                        $prodName = $data["prod_type_name"];
                        echo '<a class="nav-link prod-type text-dark" data-type-id="'.$prodId. '" href="#">' . $prodName . '</a>';
                    }
                ?>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="nav-link text-dark" href="addprod.php">Add Product</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="./generateIdeaPage.php">
            <i class="fa-solid fa-fw fa-lightbulb"></i>
            <span>Generate Idea</span></a>
    </li>

    <!-- Nav Item - Receipt -->
    <li class="nav-item">
        <a class="nav-link" href="./receipt.php">
        <i class="fa-solid fa-fw fa-file-invoice-dollar"></i>
            <span>Receipt</span></a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-table"></i>
            <span>Orders</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage Orders:</h6>
                <a class="collapse-item status-order" data-status-id="3" href="#">Pending Orders</a>
                <a class="collapse-item status-order" data-status-id="4" href="#">Out For Delivery Orders</a>
                <a class="collapse-item status-order" data-status-id="2" href="#">Delivered</a>
                <a class="collapse-item status-order" data-status-id="5" href="#">Cancelled</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Modify</div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Accounts</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Account:</h6>
                <a class="collapse-item" href="./customers.php">Active</a>
                <a class="collapse-item" href="./deactivated.php">Not Active</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="./createAccount.php">Create Account</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./reports.php">
            <i class="fas fa-fw fa-envelope"></i>
            <span>Feedbacks</span></a>
    </li>
    <!-- 
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Transaction History</span></a>
    </li> -->


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    </ul>

</body>
</html>