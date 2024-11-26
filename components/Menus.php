<?php require_once("../backend/config/config.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/general.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/navbar.css">
    <link rel="stylesheet" href="../styles/products.css">
    <script src="../jquery/jquery.js"></script>
    <script src="../scripts/sweetalert2.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Products</title>
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
                            <div class="content">
                                <div class="grid">
                                    <div class="img-con">
                                        <img src="../assets/products/palabok.png" alt="">
                                    </div>
                                    <div class="details">
                                        <div class="center">
                                            <div class="name">Pansit</div>
                                        </div>
                                        <div class="text">
                                            <div class="title">
                                                Pansit, etc...
                                            </div>
                                            Pansit is a Filipino noodle dish that is a staple in every Filipino gathering. It is a symbol of long life and good health, which is why it is commonly served during birthdays and special occasions.
                                        </div>
                                        <div class="center">
                                            <button class="view-all" data-id="1">VIEW ALL</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="content">
                                <div class="grid">
                                    <div class="img-con">
                                        <img src="../assets/products/prod-1.jpg" alt="">
                                    </div>
                                    <div class="details">
                                        <div class="center">
                                            <div class="name">Pasta</div>
                                        </div>
                                        <div class="text">
                                            <div class="title">
                                                Pasta, etc...
                                            </div>
                                            Pasta is a type of Italian food typically made from an unleavened dough of durum wheat flour mixed with water or eggs, and formed into sheets or various shapes, then cooked by boiling or baking.
                                        </div>
                                        <div class="center">
                                            <button class="view-all" data-id="2">VIEW ALL</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="content">
                                <div class="grid">
                                    <div class="img-con">
                                        <img src="../assets/products/maha-biko.png" alt="">
                                    </div>
                                    <div class="details">
                                        <div class="center">
                                            <div class="name">Desert</div>
                                        </div>
                                        <div class="text">
                                            <div class="title">
                                                Maha Biko, etc...
                                            </div>
                                            Filipino dessert made from sticky rice, coconut milk, and brown sugar. It is a type of kakanin (rice cake) that is usually served as a snack or dessert.
                                        </div>
                                        <div class="center">
                                            <button class="view-all" data-id="3">VIEW ALL</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
            if(!empty($_SESSION["user_id"])){
        ?>
            <div class="grid">
                <?php 
                    // Fetch all products that match the query
                    $query = "SELECT tp.*, tpt.prod_type_name, SUM(tc.prod_qnty) AS total_quantity
                                FROM tbl_cart tc
                                INNER JOIN tbl_products tp ON tc.prod_id = tp.prod_id
                                INNER JOIN tbl_product_type tpt ON tp.prod_type = tpt.prod_type_id
                                WHERE tc.account_id = ? 
                                GROUP BY tc.prod_id
                                ORDER BY total_quantity DESC, tc.order_date DESC
                                LIMIT 3;";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("i", $_SESSION["user_id"]);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while ($data = $result->fetch_assoc()) {
                ?>
                <div class="center">
                    <div class="con">
                        <div class="header-con">
                            <h1>Your Favorites</h1>
                        </div>
                        <div class="container" id="product-container">

                            <div class="con-items">
                                <div class="center grid-container">
                                    <div class="content">
                                        <div class="grid">
                                            <div class="img-con">
                                                <img src="../assets/products/<?php echo $data["prod_img"] ?>" alt="">
                                            </div>
                                            <div class="details">
                                                <div class="center">
                                                    <div class="name">
                                                        <?php echo $data["prod_name"] ?>
                                                    </div>
                                                </div>
                                                <div class="text">
                                                    <div class="title">
                                                        <?php echo $data["prod_type_name"] ?>, etc...
                                                    </div>
                                                    <?php echo $data["prod_description"] ?>
                                                </div>
                                                <div class="center">
                                                    <button class="view-item" data-item-id="
                                                    <?php echo $data["prod_id"] ?>">View Item</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }} ?>
    </main>
    <?php include "./footer.php" ?>
    <script>
        $(document).ready(function() {
            $(".view-all").click(function() {
                const id = $(this).data("id");
                window.location.href = `./fetch_products.php?type=${id}`;
            }); 
        });
    </script>
    <script>
    $('.view-item').click(function() {
        var typeId = $(this).data("item-id");
        const url = `fetch_item.php?type=${typeId}`;
        window.open(url, "_blank");
    });
</script>
    <script src="../scripts/navbar.js"></script>
</body>
</html>
