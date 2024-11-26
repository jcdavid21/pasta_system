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
    <link rel="stylesheet" href="../styles/privacy.css">
    <title>Terms and Conditions</title>
</head>
<body>
    <?php include "./navbar.php" ?>

    <div class="center">
        <div class="accordion">
            <h1>Terms and Conditions</h1>
            <div class="accordion-content">
                <header>
                    <span class="title">Acceptance of Terms</span>
                    <i class="fa-solid fa-plus"></i>
                </header>
                <p class="description">
                    By accessing and using our website, you agree to comply with and be bound by these Terms and Conditions. If you do not agree, you must not use this website.
                </p>
            </div>
            <div class="accordion-content">
                <header>
                    <span class="title">User Responsibilities</span>
                    <i class="fa-solid fa-plus"></i>
                </header>
                <p class="description">
                    Users are responsible for ensuring the accuracy of the information provided and for using our platform in compliance with applicable laws and regulations. Any misuse of our services may result in account termination.
                </p>
            </div>
            <div class="accordion-content">
                <header>
                    <span class="title">Intellectual Property</span>
                    <i class="fa-solid fa-plus"></i>
                </header>
                <p class="description">
                    All content on this site, including text, images, logos, and designs, is the property of our company and is protected by copyright laws. You may not reproduce, distribute, or create derivative works without written permission.
                </p>
            </div>
            <div class="accordion-content">
                <header>
                    <span class="title">Limitation of Liability</span>
                    <i class="fa-solid fa-plus"></i>
                </header>
                <p class="description">
                    We are not liable for any damages arising from the use of our website, including errors, interruptions, or the inability to access certain features. Users assume all responsibility for any risks associated with using the platform.
                </p>
            </div>
            <div class="accordion-content">
                <header>
                    <span class="title">Amendments to Terms</span>
                    <i class="fa-solid fa-plus"></i>
                </header>
                <p class="description">
                    We reserve the right to update or modify these Terms and Conditions at any time. Users are encouraged to review this page regularly to stay informed of any changes. Continued use of the website constitutes acceptance of the revised terms.
                </p>
            </div>
            <div class="accordion-content">
                <header>
                    <span class="title">Governing Law</span>
                    <i class="fa-solid fa-plus"></i>
                </header>
                <p class="description">
                    These Terms and Conditions are governed by and construed in accordance with the laws of [Your Country/State]. Any disputes shall be resolved in the courts of [Your Jurisdiction].
                </p>
            </div>
        </div>
    </div>

    <?php include "./footer.php" ?>
    <script>
         const accordionContent = document.querySelectorAll(".accordion-content");

        accordionContent.forEach((item, index) => {
            let header = item.querySelector("header");
            header.addEventListener("click", () => {
                item.classList.toggle("open");

                let description = item.querySelector(".description");
                if (item.classList.contains("open")) {
                    description.style.height = `${description.scrollHeight}px`;
                    item.querySelector("i").classList.replace("fa-plus", "fa-minus");
                } else {
                    description.style.height = "0px";
                    item.querySelector("i").classList.replace("fa-minus", "fa-plus");
                }
                removeOpen(index);
            });
        });

        function removeOpen(index1) {
            accordionContent.forEach((item2, index2) => {
                if (index1 !== index2) {
                    item2.classList.remove("open");

                    let des = item2.querySelector(".description");
                    des.style.height = "0px";
                    item2.querySelector("i").classList.replace("fa-minus", "fa-plus");
                }
            });
        }
    </script>
    <script src="../scripts/navbar.js"></script>
</body>
</html>
