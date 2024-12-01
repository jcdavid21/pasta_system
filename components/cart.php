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
            <h1>Your Cart</h1>
        </div>
    </div>

    <?php
    $query = "SELECT tc.*, tp.*, ts.status_name, tpt.prod_type_name
    FROM tbl_cart tc
    JOIN tbl_products tp ON tc.prod_id = tp.prod_id
    JOIN tbl_status ts ON tc.status_id = ts.status_id
    JOIN tbl_product_type tpt ON tp.prod_type = tpt.prod_type_id
    WHERE tc.account_id = ? AND tc.status_id = 1";
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
            <div class="div">
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
                                            <div class="minus-btn" data-item-id="<?php echo $data["item_id"] ?>">-</div>
                                            <div class="qnty-js"><?php echo $data["prod_qnty"]; ?></div>
                                            <div class="add-btn" data-item-id="<?php echo $data["item_id"] ?>" data-qnty-add=<?php echo $data["prod_qnty"] ?> >+</div>
                                        </div>
                                    </td>
                                    <td class="total-price-js">₱<span class="subtotal-js"><?php echo number_format($subtotal, 2); ?></span></td>
                                    <td class="delete-js" id="<?php echo $data["item_id"]; ?>"><i class="fa-solid fa-x"></i></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="right-con">
                    <div class="total-con">
                        <h1>Order Summary</h1>
                        <div class="price-div">
                            <div class="text">
                                <div>Subtotal/Item:</div>
                                <span class="text-price">₱<?php echo number_format($subtotalOnly, 2); ?></span>
                            </div>
                            <div class="text">
                                <div>Total:</div>
                                <div class="text-total">₱<?php echo number_format($total, 2); ?></div>
                            </div>
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Proceed</button>
                        </div>
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

    <!--MODAL-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content shadow-lg border-0 rounded-3">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white rounded-top-3">
                    <h5 class="modal-title fw-bold" id="exampleModalLabel">Receipt Submission</h5>
                    <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body px-4 py-5">
                    <form>
                        <!-- Total Amount -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Total Amount:</label>
                            <input type="text" class="form-control-plaintext fs-5 fw-bold text-success" id="overAllTotal" 
                                value="₱<?php echo number_format($total, 2); ?>" disabled>
                        </div>
                        
                        <!-- Upload Receipt -->
                        <div class="mb-4">
                            <label for="receiptFile" class="form-label fw-semibold">Upload Your Receipt</label>
                            <input type="file" class="form-control" id="receiptFile">
                        </div>
                        
                        <!-- Reference Number -->
                        <div class="mb-4">
                            <label for="refNumber" class="form-label fw-semibold">Reference Number</label>
                            <input type="text" class="form-control" id="refNumber" maxlength="13" 
                                placeholder="Enter 13-digit reference number">
                        </div>
                        
                        <!-- Deposit Amount -->
                        <div class="mb-4">
                            <label for="depAmount" class="form-label fw-semibold">Deposit Amount</label>
                            <input type="text" class="form-control" id="depAmount" 
                                oninput="this.value = this.value.replace(/[^0-9]/g, '');" 
                                placeholder="Enter deposit amount">
                        </div>

                        <div class="mb-4">
                            <label for="claimDate">Set Date To Deliver</label>
                            <input type="date" class="form-control" id="claimDate" required>
                            <small id="error-message" class="text-danger" style="display: none;">The delivery date must be at least two weeks from today.</small>
                        </div>

                        <div class="mb-4">
                            <label for="remarks">Order Remarks</label>
                            <textarea class="form-control" id="remarks" rows="3" placeholder="Enter your order remarks"></textarea>

                        </div>

                        
                        <!-- Payment QR Code -->
                        <div class="text-center">
                            <label class="form-label fw-semibold mb-3 d-block">Send Your Payment Here:</label>
                            <div class="position-relative">
                                <img src="../assets/imgs/qr-code.jpeg" alt="QR Code" class="img-fluid rounded shadow-sm" style="max-height: 500px; object-fit: contain;">
                            </div>
                        </div>
                    </form>
                </div>
                
                <!-- Modal Footer -->
                <div class="modal-footer bg-light rounded-bottom-3">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary proceed-btn">Proceed</button>
                </div>
            </div>
        </div>
    </div>






    <?php include "./footer.php"; ?>
    <script src="../scripts/navbar.js"></script>
    <script src="../jquery/cart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            const claimDateInput = document.getElementById('claimDate');
            const today = new Date();
            // Set the date to two weeks from today
            today.setDate(today.getDate() + 15);
            
            // Format the date to YYYY-MM-DD (the format required by <input type="date">)
            const dd = String(today.getDate()).padStart(2, '0');
            const mm = String(today.getMonth() + 1).padStart(2, '0'); // Months are zero-indexed
            const yyyy = today.getFullYear();

            const twoWeeksFromNow = yyyy + '-' + mm + '-' + dd;
            
            // Set the value of the input to two weeks from now
            claimDateInput.value = twoWeeksFromNow;
        });

    </script>
</body>
</html>
