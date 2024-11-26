<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/general.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/navbar.css">
    <link rel="stylesheet" href="../styles/fetch_item.css">
    <script src="../jquery/jquery.js"></script>
    <script src="../scripts/sweetalert2.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Item</title>
</head>
<body>
<?php 
require_once("../backend/config/config.php");

if(isset($_GET["type"])){
    $query = "SELECT tp.*, tpt.prod_type_name FROM tbl_products tp 
    INNER JOIN tbl_product_type tpt ON tp.prod_type = tpt.prod_type_id
    WHERE tp.prod_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $_GET["type"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $products = [];
    while($row = $result->fetch_assoc()){
        $products[] = $row;
        $path = $row["prod_img"];
    }
}else{
    header("Location: ./Menus.php");
}
?>
<?php include "./navbar.php" ?>
    <main>
        <div class="con-items">
            <?php if (!empty($products)) { ?>
            <div class="center">
                <div class="content">
                    <div class="grid">
                        <div class="img-con">
                            <img src="../assets/products/<?php echo $path; ?>" alt="">
                        </div>
                        <div class="details">
                            <div class="center">
                                <div class="name"><?php echo $products[0]["prod_name"] ?></div>
                            </div>
                            <div class="text">
                            <div class="price-con">
                                <div class="size-12">
                                    <div class="title">
                                        <input type="radio" name="prod-size" value="small">
                                        <label for="size-12">12" - ₱<?php echo $products[0]["prod_price_small"]; ?></label>
                                    </div>
                                </div>
                                <div class="size-14">
                                    <div class="title">
                                        <input type="radio" name="prod-size" value="medium">
                                        <label for="size-14">14" - ₱<?php echo $products[0]["prod_price_medium"]; ?></label>
                                    </div>
                                </div>
                                <div class="size-16">
                                    <div class="title">
                                        <input type="radio" name="prod-size" value="large">
                                        <label for="size-16">16" - ₱<?php echo $products[0]["prod_price_large"]; ?></label>
                                    </div>
                                </div>
                            </div>

                            <div class="qnty-con">
                                <div class="title">Quantity</div>
                                <div class="center">
                                    <button class="decrement">-</button>
                                    <input type="number" name="quantity" value="1" min="1" max="10"
                                    id="quantity">
                                    <button class="increment">+</button>
                                </div>
                            </div>

                                <div class="title">
                                    <?php echo $products[0]["prod_type_name"] ?>
                                </div>
                                <?php echo $products[0]["prod_description"] ?>

                                <div class="center" style=" justify-content:end;">
                                    <button class="add-to-cart" data-prod-id="<?php echo $products[0]["prod_id"] ?>">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="slide-div">
                        <div class="feedback-container">
                            <!-- Left: Feedbacks Section -->
                            <div class="feedbacks">
                                <div class="title">Feedbacks</div>
                                <?php 
                                    $queryFd = "SELECT tf.*, CONCAT(td.first_name, ' ', td.last_name) AS full_name FROM tbl_item_feedback tf
                                    INNER JOIN tbl_account_details td ON tf.account_id = td.account_id
                                     WHERE tf.prod_id = ?";
                                    $stmtFd = $conn->prepare($queryFd);
                                    $stmtFd->bind_param("i", $_GET["type"]);
                                    $stmtFd->execute();
                                    $resultFd = $stmtFd->get_result();
                                    if($resultFd->num_rows == 0){
                                        echo "<p>No feedbacks available at the moment.</p>";
                                    }
                                    while($row = $resultFd->fetch_assoc()){
                                        $date = new DateTime($row["fd_date"]);
                                ?>
                                <!-- Individual feedback item -->
                                <div class="feedback-item">
                                    <div class="name">
                                        <?php echo $row["full_name"] ?>
                                        <span class="date">
                                            <?php echo $date->format("F d, Y") ?>
                                        </span>
                                    </div>
                                    <div class="text">
                                        <?php echo $row["fd_comment"] ?>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            
                            <!-- Right: Submit Feedback Form -->
                            <div class="feedback-form">
                                <div class="title">Submit Feedback</div>
                                
                                <form method="POST">
                                    <!-- Feedback Text Field -->
                                    <div class="form-group">
                                        <label for="feedback">Your Feedback</label>
                                        <textarea id="feedback" name="feedback" rows="4" required></textarea>
                                    </div>
                                    
                                    <!-- Submit Button -->
                                    <div class="form-group">
                                        <button class="button" data-prod-id="<?php echo $_GET["type"] ?>">Submit Feedback</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- <div class="title">Suggestion</div>
                        <div class="grid">
                            <?php 
                            // Fetch all products that match the query
                            $query = "SELECT tp.*, tpt.prod_type_name FROM tbl_products tp 
                            INNER JOIN tbl_product_type tpt ON tp.prod_type = tpt.prod_type_id
                            WHERE tp.prod_type = ? AND tp.prod_id != ?";

                            $stmt = $conn->prepare($query);
                            $stmt->bind_param("ii", $products[0]["prod_type"], $_GET["type"]);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            $rows = [];
                            // Fetch all rows into an array
                            while($row = $result->fetch_assoc()){
                                $rows[] = $row;
                            }

                            // If there are more than 3 products, randomly select 3
                            if(count($rows) > 3) {
                                $random_keys = array_rand($rows, 3);
                                $random_rows = [$rows[$random_keys[0]], $rows[$random_keys[1]], $rows[$random_keys[2]]];
                            } else {
                                // If fewer than 3 products, show all
                                $random_rows = $rows;
                            }

                            // Loop through the selected random rows to display them
                            foreach($random_rows as $row) {
                                $path = $row["prod_img"];
                            ?>
                            <div class="con img-con-click" data-item-id="<?php echo $row["prod_id"] ?>">
                            <div class="img-con">
                                <img src="../assets/products/<?php echo $path; ?>" alt="">
                            </div>
                                <div class="details-item">
                                    <div class="title"><?php echo $row["prod_name"] ?>
                                    </div>
                                    <div class="center">
                                        <button class="view-item" data-item-id="
                                        <?php echo $row["prod_id"] ?>">View Item</button>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div> -->
                    </div>
                </div>
            </div>

            <?php } else { ?>
                <div class="no-products-message">
                    <p>No products available at the moment.</p>
                </div>
            <?php } ?>
        </div>
    </main>
    <?php include "./footer.php" ?>
</body>
</html>
<script src="../scripts/navbar.js"></script>
<script>
    $('.img-con-click').click(function() {
        var typeId = $(this).data("item-id");
        const url = `fetch_item.php?type=${typeId}`;
        window.open(url, "_self");
    });
</script>
<script>
    $('.increment').click(function() {
        var quantity = parseInt($('#quantity').val());
        if (quantity < 10) {
            $('#quantity').val(quantity + 1);
        }
    });

    $('.decrement').click(function() {
        var quantity = parseInt($('#quantity').val());
        if (quantity > 1) {
            $('#quantity').val(quantity - 1);
        }
    });
</script>
<script src="../jquery/submitFeedback.js"></script>
<script src="../jquery/addtocart.js"></script>
