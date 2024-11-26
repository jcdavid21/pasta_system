<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/general.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/navbar.css">
    <script src="../jquery/jquery.js"></script>
    <script src="../scripts/sweetalert2.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet" href="../styles/contactUs.css">
    <title>Contact Us</title>
</head>
<body>

    <?php include "./navbar.php" ?>

    <main>
        <!-- <div class="con-relative">
            <div class="img-con img-con-8">
              <img src="../assets/imgs/20.jpg" alt="">
            </div>
            <div class="con-abs">
             <div class="flex">
              <div class="header">Contact Us</div>
              <a href="#desc"><button id="desc">Get in Touch</button></a>
             </div>
            </div>
        </div> -->

        <div class="center">
            <div class="con">
                <div class="con-flex">
                    <div class="con-desc">
                        <h1>Contact Us</h1>
                        <div class="context">
                            Got a question or craving some wings? We’d love to hear from you!
                        </div>
                        <div class="context">
                        📍 Visit Us: Drop by Ninong’s Food Corner to enjoy our delicious chicken wings in person.
                        </div>
                        <div class="context">
                        📞 Call Us: Have a question about our menu or need help with an order? Give us a call at 123-456-7890.
                        </div>

                        <div class="context">
                        ✉️ Email Us: For inquiries, feedback, or special orders, feel free to send us an email at [Your Email Address].
                        </div>

                        <div class="context">
                        💬 Follow Us: Stay updated on our latest flavors, promos, and more by following us on Social Media.
                        </div>

                        <div class="context">
                        We’re here to serve you the best wings with a smile! Whether it’s a quick meal or a big event, Ninong’s Food Corner has got you covered.
                        </div>

                        <div class="context">
                            
                        </div>
                    </div>
                    
                    <form action="">
                        <div class="form-div">
                            <label for="name">Name</label>
                            <input type="text" id="name" placeholder="Enter your name" required>
                        </div>

                        <div class="form-div">
                            <label for="email">Email</label>
                            <input type="email" id="email" placeholder="Enter your email" required>
                        </div>

                        <div class="form-div">
                            <label for="message">Message</label>
                            <textarea name="message" id="message" cols="30" rows="10" required></textarea>
                        </div>
                        <div style="display: flex; justify-content: end;">
                            <button type="submit" id="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php include "./footer.php" ?>

    <script src="../scripts/navbar.js"></script>
    <script src="../jquery/report.js"></script>
</body>
</html>