function validateInput(input) {
    // Remove non-numeric characters
    input.value = input.value.replace(/\D/g, '');
}

// function validateEmail(email) {
//     const emailPattern = /^[a-zA-Z0-9._%+-]+@(gmail\.com|yahoo\.com|outlook\.com|hotmail\.com)$/;
//     return emailPattern.test(email);
// }

function validatePassword(password) {
    const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
    return passwordPattern.test(password);
}

function validateContactNo(contactNo) {
    const contactPattern = /^09\d{9}$/;
    return contactPattern.test(contactNo);
}

$(document).ready(function(){
    $(".button").on("click", function(e){
        e.preventDefault();
        const fName = document.getElementById("fname").value;      
        const mName = document.getElementById("mname").value;    
        const lName = document.getElementById("lname").value;    
        const username = document.getElementById("uname").value;    
        const address = document.getElementById("address").value;    
        const contact = document.getElementById("contact").value;    
        const password = document.getElementById("password").value;    
        const confirmPass = document.getElementById("confirmPass").value;
        const gender = document.getElementById("gender").value; 
        
        if(fName === '' || fName === null)
        {
            swal("Empty Field!", "First Name is required!", "warning");
            return;
        }
        if(lName === '' || lName === null)
        {
            swal("Empty Field!", "Last Name is required!", "warning");
            return;
        }
        if(username === '' || username === null)
        {
            swal("Empty Field!", "Username is required!", "warning");
            return;
        }
        if(address === '' || address === null)
        {
            swal("Empty Field!", "Address is required!", "warning");
            return;
        }
        if(contact === '' || contact === null)
        {
            swal("Empty Field!", "Contact is required!", "warning");
            return;
        }
        if(password === '' || password === null)
        {
            swal("Empty Field!", "Password is required!", "warning");
            return;
        }


        if(fName && lName && username && address && contact && password && gender) {
            if (!validateContactNo(contact)) {
                swal("Invalid Contact Number!", "Contact number must be 11 digits long and start with 09.", "warning");
                return;
            }


            if(confirmPass)
            {
                if (password && password !== confirmPass) {
                    swal("Password doesn't match!", "Make sure that your passwords are the same.", "warning");
                    return;
                }
                
                if (!validatePassword(confirmPass)) {
                    swal("Weak Password!", "Password must be at least 8 characters long and include at least one uppercase letter and one lowercase letter.", "warning");
                    return;
                }
            }


            $.ajax({
                url: "../backend/user/updateProfile.php",
                method: "post",
                data: {
                    fName,
                    mName,
                    lName,
                    username,
                    address,
                    contact,
                    password,
                    confirmPass,
                    gender,
                },
                success: function(response) {
                    if(response === "empty") {
                        swal("Empty Fields!", "Current Password or New Password are empty!", "warning");
                    } else if(response === "invalid") {
                        swal("Invalid Password!", "Invalid current Password!", "warning");
                    } else if(response === "empty1") {
                        swal("Empty Fields!", "Please make sure other fields are filled!", "warning");
                    } else if(response === "updated") {
                        swal("Profile Updated!", "Profile has been updated!", "")
                        .then((value) => {
                            window.location.href = "./profile.php";
                        });
                    }else if(response === "existed") {
                        swal("Username Existed!", "Username is already existed!", "warning");
                    }
                },
                error: function() {
                    alert("Connection error!");
                }
            });
        } 
    });
});
