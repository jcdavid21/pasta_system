<?php require_once("../backend/config/config.php") ?>
<?php 
  session_start();
?>
<nav>
      <div class="left">
        
        <a href="../index.php"><div class="title-name">Maristel's Eatery</div></a>
        <a href="../index.php"><div>Home</div></a>
        <a href="./aboutUs.php"><div>About Us</div></a>
      </div>

      <div id="bar">
        <i class="fa-solid fa-bars"></i>
      </div>



      <div class="right">
          <a href="./Menus.php"><div class="prod">Shop</div></a>
          <a href="./cart.php">Cart</i></a>
          <a href="./ProcessOrders.php">Orders</a>
          <?php if(!empty($_SESSION["user_id"])){ 
                $query = "SELECT COUNT(*) AS CountItems FROM tbl_cart WHERE status_id = 4 and account_id = ?;";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("i", $_SESSION["user_id"]);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_assoc();
            ?>
                
            <a href="./cart.php">
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
                  <i class="fa-solid fa-circle-chevron-down" onclick="toggleDropdown()"></i>
                  <div class="dropdown-content" id="dropdownContent">
                      <a href="./profile.php">Profile</a>
                      <a href="./logout.php">Log out</a>
                  </div>
              </div>
          <?php } else { ?>
              <a href="./login.php"><div class="login">Sign in</div></a>
          <?php }?>
      </div>
    </nav>

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