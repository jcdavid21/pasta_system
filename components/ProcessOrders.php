<?php
require_once("../backend/config/config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/general.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/navbar.css">
    <link rel="stylesheet" href="../styles/cart.css">
    <script src="../jquery/jquery.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="../scripts/sweetalert2.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Cart</title>
</head>
<body>
    <?php include "./navbar.php"; ?>
    <?php 
        if (empty($_SESSION["user_id"])) {
            header("Location: ./login.php");
            exit();
        }
        
        $current_user = $_SESSION['user_id'];
    ?>

    <div class="center">
        <div class="h1-div">
            <div class="active">
                <a href="./ProcessOrders.php">Pending Orders</a>
            </div>
            <div>
                <a href="./history.php">Orders History</a>
            </div>
        </div>
    </div>

    <?php
    $query = "SELECT tc.*, tp.*, ts.status_name, tpt.prod_type_name
    FROM tbl_cart tc
    JOIN tbl_products tp ON tc.prod_id = tp.prod_id
    JOIN tbl_status ts ON tc.status_id = ts.status_id
    JOIN tbl_product_type tpt ON tp.prod_type = tpt.prod_type_id
    WHERE tc.account_id = ? AND tc.status_id IN (3, 4)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $current_user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $total = 0;
        $subtotalOnly = 0;
        $order_price = 0;
    ?>
    <main>
        <div class="center">
            <div class="div" id="grid-process">
                <div class="left-con">
                    <div class="cart-con">
                        <table class="styled-table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Product</th>
                                    <th>Size</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($data = $result->fetch_assoc()) {
                                    $prod_size = array(
                                        "small" => "12",
                                        "medium" => "14",
                                        "large" => "16"
                                    );
                                    if($data["prod_size"] == "small"){
                                        $subtotal = $data["prod_price_small"] * $data["prod_qnty"];
                                        $order_price = $data["prod_price_small"];
                                    } else if($data["prod_size"] == "medium"){
                                        $subtotal = $data["prod_price_medium"] * $data["prod_qnty"];
                                        $order_price = $data["prod_price_medium"];
                                    } else {
                                        $subtotal = $data["prod_price_large"] * $data["prod_qnty"];
                                        $order_price = $data["prod_price_large"];
                                    }
                                    $total += $subtotal;
                                    $subtotalOnly += round($order_price, 2);
                                ?>
                                <tr>
                                    <td>
                                        <div class="img-con">
                                        <img src="../assets/products/<?php echo $data["prod_img"]; ?>" alt="">
                                        </div>
                                    </td>
                                    <td><?php echo $data["prod_name"]; ?></td>
                                    <td><?php echo $prod_size[$data["prod_size"]]; ?>"</td>
                                    <td>₱<?php echo number_format($order_price, 2); ?></td>
                                    <td>
                                        <div class="qnty-td">
                                            <div class="qnty-js"><?php echo $data["prod_qnty"]; ?></div>   
                                        </div>
                                    </td>
                                    <td class="total-price-js">₱<span class="subtotal-js"><?php echo number_format($subtotal, 2); ?></span></td>
                                    <td><?php echo $data["status_name"] == "PROCESS" ? "PENDING" : $data["status_name"]; ?></td>
                                    <?php 
                                    if ($data["status_id"] == 3) {
                                    ?>
                                    <td>
                                        <span class="view-driver" data-toggle="modal" data-target="#exampleModal<?php echo $data["item_id"] ?>" data-whatever="@mdo">
                                            <i class="fa-solid fa-eye"></i>
                                        </span>
                                        <span class="delete-js" id="<?php echo $data["item_id"]; ?>">
                                            <i class="fa-solid fa-x"></i>
                                        </span>
                                    </td>
                                    
                                    <?php }else{ ?>
                                        <td >
                                        <span class="view-driver" data-toggle="modal" data-target="#exampleModal<?php echo $data["item_id"] ?>" data-whatever="@mdo">
                                            <i class="fa-solid fa-eye"></i>
                                        </span>
                                        </td>
                                    <?php } ?>
                                </tr>

                                <div class="modal fade" id="exampleModal<?php echo $data["item_id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <?php 
                                        $query2 = "SELECT * FROM tbl_rider_details WHERE item_id = ?";
                                        $stmt2 = $conn->prepare($query2);
                                        $stmt2->bind_param("i", $data["item_id"]);
                                        $stmt2->execute();
                                        $result2 = $stmt2->get_result();
                                        $data2 = $result2->fetch_assoc();
                                    ?>
                                    <div class="modal-dialog modal-dialog-centered modal-md">
                                        <div class="modal-content shadow-lg border-0 rounded-3">
                                            <!-- Modal Header -->
                                            <div class="modal-header bg-info text-white rounded-top-3">
                                                <h5 class="modal-title fw-bold" id="exampleModalLabel">Delivery Rider Details</h5>
                                                <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <!-- Modal Body -->
                                            <div class="modal-body px-4 py-5">
                                                <div class="row">
                                                    <!-- Rider Name -->
                                                    <div class="col-md-6 mb-3">
                                                        <label for="riderName" class="form-label">Rider Name</label>
                                                        <input type="text" disabled class="form-control" value="<?php echo $data2["rider_name"] ?>">
                                                    </div>
                                                    <!-- Rider Contact -->
                                                    <div class="col-md-6 mb-3">
                                                        <label for="riderContact" class="form-label">Contact</label>
                                                        <input type="text" disabled class="form-control" value="<?php echo $data2["rider_contact"] ?>">
                                                    </div>
                                                    <!-- Address -->
                                                    <div class="col-12">
                                                        <label for="riderRemarks" class="form-label">Remarks</label>
                                                        <textarea id="remarks" name="address" class="form-control" rows="5" disabled><?php echo $data2["rider_remarks"] ?></textarea>
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- Modal Footer -->
                                            <div class="modal-footer bg-light rounded-bottom-3">
                                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
    } else {
    ?>
        <div class="no-products-message">
            <p>No products available at the moment.</p>
        </div>
    <?php } ?>





    <?php include "./footer.php"; ?>
    <script src="../scripts/navbar.js"></script>
    <script src="../jquery/cancelOrder.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
