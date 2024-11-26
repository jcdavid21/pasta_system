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
    <title>Privacy & Policy</title>
</head>
<body>
    <?php include "./navbar.php" ?>

    <div class="center">
        <div class="accordion">
        <h1>Privacy Policy</h1>
        <div class="accordion-content">
            <header>
                <span class="title">Information We Collect</span>
                <i class="fa-solid fa-plus"></i>
            </header>
            <p class="description">
                We collect information to provide better services to our users. This includes personal details such as your name, email address, contact information, and other data you provide when interacting with us. Additionally, we may collect technical data like your IP address, browser type, device information, and usage patterns. If you make transactions with us, payment details may also be collected securely.
            </p>
        </div>
        <div class="accordion-content">
            <header>
                <span class="title">How We Use Your Information</span>
                <i class="fa-solid fa-plus"></i>
            </header>
            <p class="description">
                Your information helps us improve our services, tailor content to your preferences, and provide seamless support. We use it for purposes like processing transactions, communicating updates, ensuring security, personalizing user experiences, and analyzing trends to improve our offerings. Additionally, we may use your data to send promotional emails or notifications, which you can opt out of at any time.
            </p>
        </div>
        <div class="accordion-content">
            <header>
                <span class="title">Sharing Your Information</span>
                <i class="fa-solid fa-plus"></i>
            </header>
            <p class="description">
                We respect your privacy and only share your information when necessary. This includes sharing with trusted third-party service providers who assist in delivering our services, such as payment processors, delivery partners, and analytics providers. We may also disclose your data when required by law, during legal processes, or to protect our rights, enforce our policies, or ensure the safety of our users and platform.
            </p>
        </div>
        <div class="accordion-content">
            <header>
                <span class="title">Your Rights and Choices</span>
                <i class="fa-solid fa-plus"></i>
            </header>
            <p class="description">
                You have the right to access, update, or delete your personal information at any time. You can also opt out of receiving promotional communications by following the unsubscribe instructions included in our messages. If you have concerns about how your data is used, feel free to contact us for assistance.
            </p>
        </div>
        <div class="accordion-content">
            <header>
                <span class="title">Data Security</span>
                <i class="fa-solid fa-plus"></i>
            </header>
            <p class="description">
                We take the security of your information seriously and implement appropriate measures to protect it from unauthorized access, alteration, or disclosure. Our platform uses encryption, firewalls, and regular security assessments to safeguard your data.
            </p>
            </div>
            <div class="accordion-content">
                <header>
                    <span class="title">Changes to This Policy</span>
                    <i class="fa-solid fa-plus"></i>
                </header>
                <p class="description">
                    We may update this Privacy Policy from time to time to reflect changes in our practices or legal requirements. Any updates will be communicated on our website, and we encourage you to review this policy periodically to stay informed about how we protect your information.
                </p>
            </div>
        </div>
    </div>


    <?php include "./footer.php" ?>
    <script>
         const accordionContent = document.querySelectorAll(".accordion-content");

        accordionContent.forEach((item, index) => {
            let header = item.querySelector("header");
            header.addEventListener("click", () =>{
                item.classList.toggle("open");

                let description = item.querySelector(".description");
                if(item.classList.contains("open")){
                    description.style.height = `${description.scrollHeight}px`; //scrollHeight property returns the height of an element including padding , but excluding borders, scrollbar or margin
                    item.querySelector("i").classList.replace("fa-plus", "fa-minus");
                }else{
                    description.style.height = "0px";
                    item.querySelector("i").classList.replace("fa-minus", "fa-plus");
                }
                removeOpen(index); //calling the funtion and also passing the index number of the clicked header
            })
        })

        function removeOpen(index1){
            accordionContent.forEach((item2, index2) => {
                if(index1 != index2){
                    item2.classList.remove("open");

                    let des = item2.querySelector(".description");
                    des.style.height = "0px";
                    item2.querySelector("i").classList.replace("fa-minus", "fa-plus");
                }
            })
        }
    </script>
    <script src="../scripts/navbar.js"></script>
</body>
</html>