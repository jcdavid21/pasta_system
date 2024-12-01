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
                    <label for="fname">First name</label>
                    <input 
                        type="text" 
                        placeholder="Enter first name" 
                        required
                        id="fname" 
                        pattern="^[A-Za-z\s]+$" 
                        title="First name should only contain letters and spaces" />
                </div>
                <div class="input-box">
                    <label for="mname">Middle name</label>
                    <input 
                        type="text" 
                        placeholder="Enter middle name" 
                        required
                        id="mname" 
                        pattern="^[A-Za-z\s]+$" 
                        title="Middle name should only contain letters and spaces" />
                </div>
                <div class="input-box">
                    <label for="lname">Last name</label>
                    <input 
                        type="text" 
                        placeholder="Enter last name" 
                        required
                        id="lname" 
                        pattern="^[A-Za-z\s]+$" 
                        title="Last name should only contain letters and spaces" />
                </div>
                <div class="input-box">
                    <label for="email">Email Address</label>
                    <input 
                        type="email" 
                        placeholder="Enter email address" 
                        required
                        id="email" />
                </div>
            </div>

            <div class="grid">
                <div class="column">
                <div class="input-box">
                    <label for="phoneNum">Phone Number</label>
                    <input 
                        type="tel" 
                        id="phoneNum" 
                        placeholder="Enter phone number" 
                        required 
                        maxlength="11" 
                        pattern="^[0-9]{11}$" 
                        title="Phone number must be 11 digits" />
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
                    <input type="radio" id="check-male" name="gender" value="Male" checked />
                    <label for="check-male" >Male</label>
                    </div>
                    <div class="gender">
                    <input type="radio" id="check-female" name="gender" value="Female" />
                    <label for="check-female">Female</label>
                    </div>
                    <div class="gender">
                    <input type="radio" id="check-other" name="gender" value="Other"  />
                    <label for="check-other">Other</label>
                    </div>
                </div>
                </div>
            <div class="pass-con">
            <div class="input-box">
                <label>Username</label>
                <input type="text" placeholder="Username" required id="uname" />
            </div>
            <div class="input-box">
                <label>Password</label>
                <div style="position: relative;">
                    <input type="password" placeholder="Enter Password" required id="password" style="width: 100%; padding-right: 40px;" />
                    <i class="fas fa-eye" id="togglePassword" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;"></i>
                </div>
            </div>
            <div class="input-box">
                <label>Confirm Password</label>
                <div style="position: relative;">
                    <input type="password" placeholder="Confirm Password" required id="confirmPass" style="width: 100%; padding-right: 40px;" />
                    <i class="fas fa-eye" id="toggleConfirmPass" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;"></i>
                </div>
            </div>
            <button class="button">Submit</button>
        </form>
        </section>
    </div>
    <script>
    // Toggle password visibility for Password field
    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('password');
    togglePassword.addEventListener('click', () => {
        const type = passwordField.type === 'password' ? 'text' : 'password';
        passwordField.type = type;
        togglePassword.classList.toggle('fa-eye');
        togglePassword.classList.toggle('fa-eye-slash');
    });

    // Toggle password visibility for Confirm Password field
    const toggleConfirmPass = document.getElementById('toggleConfirmPass');
    const confirmPassField = document.getElementById('confirmPass');
    toggleConfirmPass.addEventListener('click', () => {
        const type = confirmPassField.type === 'password' ? 'text' : 'password';
        confirmPassField.type = type;
        toggleConfirmPass.classList.toggle('fa-eye');
        toggleConfirmPass.classList.toggle('fa-eye-slash');
    });

    document.getElementById('phoneNum').addEventListener('input', function(e) {
    // Remove all non-numeric characters
    this.value = this.value.replace(/[^0-9]/g, '');
    });
    // Prevent numbers and special characters
    document.getElementById('fname').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^A-Za-z\s]/g, ''); // Only letters and spaces allowed
    });

    document.getElementById('mname').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^A-Za-z\s]/g, ''); // Only letters and spaces allowed
    });

    document.getElementById('lname').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^A-Za-z\s]/g, ''); // Only letters and spaces allowed
    });

    document.getElementById('uname').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^A-Za-z0-9]/g, ''); // Only letters and numbers allowed
    });

    document.getElementById('email').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^A-Za-z0-9]/g, ''); // Only letters and numbers allowed
    });
    
    // Function to capitalize the first letter of each word
    function capitalizeFirstLetter(inputId) {
        const inputField = document.getElementById(inputId);
        inputField.addEventListener('input', function() {
            const value = inputField.value;
            const capitalizedValue = value
                .toLowerCase() // Convert the entire value to lowercase first
                .replace(/\b\w/g, char => char.toUpperCase()); // Capitalize the first letter of each word
            inputField.value = capitalizedValue;
        });
    }

    // Apply the capitalization function to the name fields
    capitalizeFirstLetter('fname');
    capitalizeFirstLetter('mname');
    capitalizeFirstLetter('lname');


</script>

  <script src="../scripts/navbar.js"></script>
  <script src="../jquery/signup.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>