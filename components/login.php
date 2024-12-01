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
    <title>Log In</title>
</head>
<body>

    <div class="center">
        <div class="div">
            <a href="../index.php">
                <div class="back" style="margin-bottom:20px; font-weight: 500; font-size: 26px;">
                    <i class="fas fa-arrow-left"></i>
                </div>
            </a>
            <div class="wrapper">
                <h1>Login</h1>
                <form action="#">
                <div class="field email">
                    <div class="input-area">
                    <input type="email" id="email" placeholder="Email Address">
                    <i class="icon fas fa-envelope"></i>
                    <i class="error error-icon fas fa-exclamation-circle"></i>
                    </div>
                    <div class="error error-txt">Email can't be blank</div>
                </div>
                <div class="field password">
                    <div class="input-area" style="position: relative;">
                        <input type="password" id="password" placeholder="Password" style="width: 100%; padding-right: 40px;">
                        <i class="icon fas fa-lock" style="position: absolute; top: 50%; left: 10px; transform: translateY(-50%);"></i>
                        <i id="togglePassword" class="fas fa-eye" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;"></i>
                        <i class="error error-icon fas fa-exclamation-circle" style="position: absolute; top: 50%; right: 40px; transform: translateY(-50%); display: none;"></i>
                    </div>
                    <div class="error error-txt" style="display: none;">Password can't be blank</div>
                </div>
                <div class="pass-txt"><a href="./forgotPass.php">Forgot password?</a></div>
                <!-- <div class="pass-txt"><a href="./forgotPass.php">Forgot password?</a></div> -->
                <input type="submit" id="submit" value="Login">
                </form>
                <div class="sign-txt">Not yet member? <a href="./signup.php">Signup now</a></div>
            </div>
        </div>
    </div>
    
  <script src="../scripts/navbar.js"></script>
  <script src="../scripts/loginframe.js"></script>
  <script src="../jquery/login.js"></script>
  
<script>
    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('password');

    togglePassword.addEventListener('click', () => {
        const type = passwordField.type === 'password' ? 'text' : 'password';
        passwordField.type = type;

        // Toggle the icon
        togglePassword.classList.toggle('fa-eye');
        togglePassword.classList.toggle('fa-eye-slash');
    });
</script>
</body>
</html>