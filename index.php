<?php require_once('./backend/config/config.php') ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/general.css">
    <link rel="stylesheet" href="./styles/navbar.css">
    <link rel="stylesheet" href="./styles/index.css">
    <link rel="stylesheet" href="./styles/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Home</title>
</head>
<body>
    <nav>
      <div class="left">
        <a href="./index.php"><div class="title-name">Maristel's Eatery</div></a>
        <a href="./index.php"><div>Home</div></a>
        <a href="./components/aboutUs.php"><div>About Us</div></a>
      </div>

      <div id="bar">
        <i class="fa-solid fa-bars"></i>
      </div>



      <div class="right">
      <a href="./components/Menus.php"><div class="prod">Shop</div></a>
             <a href="./components/cart.php">Cart</i></a>
             <a href="./components/ProcessOrders.php">Orders</a>
          <?php if(!empty($_SESSION["user_id"])){ 
                $query = "SELECT COUNT(*) AS CountItems FROM tbl_cart WHERE status_id = 4 and account_id = ?;";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("i", $_SESSION["user_id"]);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_assoc();
            ?>
                
            <a href="./components/cart.php">
                <div class="count-div">
                    <i class="fa-solid fa-bell"></i>
                    <div class="count">
                        <?php echo $data["CountItems"]; ?>
                    </div>
                </div>
            </a>
            <?php } ?>
          

          <?php if(!empty($_SESSION["user_id"])){ ?>
              <div class="dropdown">
                  <i class="fa-regular fa-user" onclick="toggleDropdown()"></i>
                  <div class="dropdown-content" id="dropdownContent">
                      <a href="./components/profile.php">Profile</a>
                      <a href="./components/logout.php">Log out</a>
                  </div>
              </div>
          <?php } else { ?>
              <a href="./components/login.php"><div class="login">Sign in</div></a>
          <?php }?>
      </div>
    </nav>

    <main>
        <div class="header-con center">
            <div class="img-con">
                <img src="./assets/imgs/pancit-palabok-2.jpg" alt="">
            </div>
            <div class="header-text">
                <h1>Maristel's Eatery</h1>
                <p>Delicious food at your doorstep</p>
                <button>Order Now</button>
            </div>
        </div>

        <div class="center">
            <div class="con">
                <div class="center">
                    <div class="con-div-first">
                            <div class="context-div">
                                <h3>Best Quality Products</h3>
                                <p>                         
                                    We're your one-stop shop for delightful dishes like Maha-Biko, Pansit, and flavorful Pasta. Our friendly team is passionate about crafting dishes that satisfy your cravings, prepared with care and attention to your preferences.
                                </p>
        
                                <div style="display: flex; justify-content: center;">
                                    <a href="./components/Menus.php">
                                        <button>
                                            <div><i class="fa-solid fa-cart-shopping"></i></div>
                                            SHOP NOW
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div class="img-con">
                                <img src="./assets/imgs/maha-biko.jpg" alt="">
                            </div>
                        </div>
                </div>

                <div class="con-div-second">
                    <div class="container">
                        <div><i class="fa-solid fa-truck"></i></div>
                        <div class="title">Delivery Process</div>
                        <p>On time process</p>
                    </div>

                    <div class="container">
                        <div><i class="fa-solid fa-certificate"></i></div>
                        <div class="title">Certified Quality</div>
                        <p>100% Guarantee</p>
                    </div>

                    <div class="container">
                        <div><i class="fa-regular fa-money-bill-1"></i></div>
                        <div class="title">Huge Savings</div>
                        <p>On time process</p>
                    </div>

                    <div class="container">
                        <div><i class="fa-solid fa-recycle"></i></div>
                        <div class="title">Easy Returns</div>
                        <p>No Questions Asked</p>
                    </div>
                </div>

                <div class="center">
                    <div class="con-div-first reversed">
                        <div class="context-div">
                            <h3>Best Quality Pasta</h3>
                            <p>                         
                                Discover your favorites at our one-stop shop, featuring Maha-Biko, Pansit, and a variety of flavorful Pasta dishes. Each is lovingly prepared to bring joy to your table, crafted to perfection just for you.
                            </p>
    
                            <div style="display: flex; justify-content: center;">
                                <a href="./components/Menus.php">
                                    <button>
                                        <div><i class="fa-solid fa-cart-shopping"></i></div>
                                        SHOP NOW
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="img-con">
                            <img src="./assets/imgs/pancit.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
            

    <footer>
        <div class="center">
        <div class="soc-flex">
          <div class="soc-media-con">
            <a href="./components/privacyPolicy.php">Privacy Policy</a>
            <div> | </div>
            <a href="./components/terms.php">Terms And Condition</a>
            <div> | </div>
            <a href="./components/aboutUs.php">About us</a>
          </div>
        </div>
      </footer>


    <script src="./scripts/navbar.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    function toggleDropdown() {
        document.getElementById("dropdownContent").classList.toggle("show");
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.fa-user')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>
<script>
    $('.img-con-click').click(function() {
        var typeId = $(this).data("item-id");
        const url = `./components/fetch_item.php?type=${typeId}`;
        window.open(url, "_blank");
    });
</script>
</body>
</html>