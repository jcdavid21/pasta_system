$(document).ready(()=>{
    $('#submit').on('click', function(e){
        e.preventDefault();
        const username = $('#username').val();
        const password = $('#password').val();
        const confirmPassword = $('#confirmPassword').val();

        if(password !== confirmPassword){
            Swal.fire({
                title: "Password Mismatch",
                text: "Password does not match",
                showConfirmButton: false,
                timer: 2000
                });
            return;
        }
        
        if(username && password){
            $.ajax({
                url: "../backend/user/newPassword.php",
                method: "post",
                data:{
                    username,
                    password
                },
                success: function(response){
                    if(response === 'success'){
                        Swal.fire({
                            title: "Success",
                            text: "Password reset successfully",
                            showConfirmButton: false,
                            timer: 2000
                          }).then((result)=>{
                            if(result){
                                window.location.href = "./login.php"
                            }
                          })
                    }else if(response === 'invalid'){
                        Swal.fire({
                            title: "Invalid Email!",
                            text: "Make sure your email is correct.",
                            showConfirmButton: false,
                            timer: 2000
                          });
                    }
                }
            })
        }
    })
})