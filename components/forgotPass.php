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
    <link rel="stylesheet" href="../styles/login.css">
    <title>Reset Password</title>
</head>
<body>
    <?php include "./navbar.php" ?>
    <div class="center">
        <div class="wrapper" style="height: 460px;">
            <header>Reset Password</header>
            <form action="#">
            <div class="field email">
                <div class="input-area">
                <input type="text" id="username" placeholder="Username">
                <i class="icon fas fa-user"></i>
                <i class="error error-icon fas fa-exclamation-circle"></i>
                </div>
                <div class="error error-txt">Username can't be blank</div>
            </div>
            <div class="field password">
                <div class="input-area">
                    <input type="password" id="password" placeholder="New Password">
                    <i class="icon fas fa-lock"></i>
                    <i class="eye-icon fas fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                    <i class="error error-icon fas fa-exclamation-circle" style="display: none;"></i>
                </div>
                <div class="error error-txt" id="passwordError" style="display: none;">Password can't be blank</div>
            </div>

            <div class="field confirm-password">
                <div class="input-area">
                    <input type="password" id="confirmPassword" placeholder="Confirm Password">
                    <i class="icon fas fa-lock"></i>
                    <i class="eye-icon fas fa-eye" id="toggleConfirmPassword" style="cursor: pointer;"></i>
                    <i class="error error-icon fas fa-exclamation-circle" style="display: none;"></i>
                </div>
                <div class="error error-txt" id="confirmPasswordError" style="display: none;">Passwords do not match</div>
            </div>

            <div class="pass-txt"><a href="./login.php">Back to login</a></div>

            <input type="submit" id="submit" value="Submit">
            </form>
        </div>
    </div>
  <?php include "./footer.php" ?>
  
  <script src="../scripts/navbar.js"></script>
  <script src="../jquery/forgotPass.js"></script>
  <script>
    // Show/hide password for New Password field
    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('password');
    togglePassword.addEventListener('click', () => {
        const type = passwordField.type === 'password' ? 'text' : 'password';
        passwordField.type = type;
        togglePassword.classList.toggle('fa-eye-slash');
    });

    // Show/hide password for Confirm Password field
    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    const confirmPasswordField = document.getElementById('confirmPassword');
    toggleConfirmPassword.addEventListener('click', () => {
        const type = confirmPasswordField.type === 'password' ? 'text' : 'password';
        confirmPasswordField.type = type;
        toggleConfirmPassword.classList.toggle('fa-eye-slash');
    });

    // Validate Password fields
    const passwordError = document.getElementById('passwordError');
    const confirmPasswordError = document.getElementById('confirmPasswordError');

    confirmPasswordField.addEventListener('input', () => {
        if (confirmPasswordField.value !== passwordField.value) {
            confirmPasswordError.style.display = 'block';
        } else {
            confirmPasswordError.style.display = 'none';
        }
    });

    passwordField.addEventListener('input', () => {
        if (passwordField.value === '') {
            passwordError.style.display = 'block';
        } else {
            passwordError.style.display = 'none';
        }
    });
</script>



</body>
</html>