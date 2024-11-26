<?php 
require_once("../backend/config/config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link rel="stylesheet" href="../styles/general.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/navbar.css">
    <link rel="stylesheet" href="../styles/products.css">
    <script src="../jquery/jquery.js"></script>
    <script src="../scripts/sweetalert2.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
<?php include "./navbar.php" ?>
    <main>
    <div class="center">
        <div class="con">
            <div class="header-con">
                <h1>Order Now</h1>
            </div>
            <div class="container" id="product-container">

                <div class="con-items">
                    <div class="center grid-container">
                        <?php 
                            
                        if (isset($_GET['type'])) {
                            $type = intval($_GET['type']);
                            $query = "SELECT pt.prod_type_name, tp.* FROM tbl_products tp INNER JOIN tbl_product_type pt ON tp.prod_type = pt.prod_type_id WHERE tp.prod_type = ?";
                            $stmt = $conn->prepare($query);
                            $stmt->bind_param("i", $type);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            // Store query results in an array
                            $products = [];
                            while ($data = $result->fetch_assoc()) {
                        ?>
                        <div class="content">
                            <div class="grid">
                                <div class="img-con">
                                    <img src="../assets/products/<?php echo $data["prod_img"] ?>" alt="">
                                </div>
                                <div class="details-item">
                                    <div class="center">
                                        <div class="name"><?php echo $data["prod_name"] ?></div>
                                    </div>
                                    <div class="title">Price Starts at ₱<?php echo $data["prod_price_small"] ?>
                                    </div>
                                    <div class="center">
                                        <button class="view-item" data-item-id="
                                        <?php echo $data["prod_id"] ?>">View Item</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } }?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </main>
    <?php include "./footer.php" ?>
</body>
</html>

<script>
    $('.view-item').click(function() {
        var typeId = $(this).data("item-id");
        const url = `fetch_item.php?type=${typeId}`;
        window.open(url, "_blank");
    });
</script>
