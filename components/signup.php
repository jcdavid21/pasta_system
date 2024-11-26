<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/general.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="../jquery/jquery.js"></script>
    <script src="../scripts/sweetalert2.js"></script>
    <link rel="stylesheet" href="../styles/signup.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Sign up</title>
</head>
<body>
    <?php include "./navbar.php" ?>
    <div class="center">
        <section class="container">
        <header>Registration Form</header>
        <form action="#" class="form">
            <div class="grid">
                <div class="input-box">
                    <label>First name</label>
                    <input type="text" placeholder="Enter first name" required
                    id="fname" />
                </div>
                <div class="input-box">
                    <label>Middle name</label>
                    <input type="text" placeholder="Enter middle name" required
                    id="mname" />
                </div>
                <div class="input-box">
                    <label>Last name</label>
                    <input type="text" placeholder="Enter first name" required
                    id="lname" />
                </div>
                <div class="input-box">
                    <label>Email Address</label>
                    <input type="email" placeholder="Enter email address" required
                    id="email" />
                </div>
            </div>
            <div class="grid">
                <div class="column">
                <div class="input-box">
                    <label>Phone Number</label>
                    <input type="number" placeholder="Enter phone number" required
                    id="phoneNum" />
                </div>
                </div>
                <div class="input-box address">
                <label>Address</label>
                <input type="text" placeholder="Enter street address" required
                id="address" />
                </div>
            </div>
            <div class="gender-box">
                <h3>Gender</h3>
                <div class="gender-option">
                    <div class="gender">
                    <input type="radio" id="check-male" name="gender" checked />
                    <label for="check-male">male</label>
                    </div>
                    <div class="gender">
                    <input type="radio" id="check-female" name="gender" />
                    <label for="check-female">Female</label>
                    </div>
                    <div class="gender">
                    <input type="radio" id="check-other" name="gender" />
                    <label for="check-other">prefer not to say</label>
                    </div>
                </div>
                </div>
            <div class="pass-con">
            <div class="input-box">
                    <label>Username</label>
                    <input type="text" placeholder="Username" required
                    id="uname" />
                </div>
                <div class="input-box">
                    <label>Password</label>
                    <input type="password" placeholder="Enter Password" required
                    id="password" />
                </div>
                <div class="input-box">
                    <label>Confirm Password</label>
                    <input type="password" placeholder="Confirm Password" required
                    id="confirmPass" />
                </div>
            </div>
            <button class="button">Submit</button>
        </form>
        </section>
    </div>

  <script src="../scripts/navbar.js"></script>
  <script src="../jquery/signup.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>