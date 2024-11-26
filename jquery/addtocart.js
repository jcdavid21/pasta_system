$(document).ready(() => {
    $(".add-to-cart").on("click", function() {
        const userDetails = JSON.parse(localStorage.getItem("userDetails"));

        if (userDetails) {
            const prodId = $(this).data("prod-id");
            const qnty = $("#quantity").val();
            const selectedSize = $("input[name='prod-size']:checked").val();

            // Check if a size is selected
            if (!selectedSize) {
                Swal.fire({
                    icon: "warning",
                    title: "Select a Size",
                    text: "Please choose a size before adding to the cart.",
                });
                return;
            }
           
            if (prodId === null || qnty === '' || qnty === '0') {
                Swal.fire({
                    title: "Invalid Input",
                    text: "Make sure you have selected all the order selection fields.",
                });
                return;
            }

            if(qnty > 10){
                Swal.fire({
                    title: "Invalid Quantity",
                    text: "You can only order up to 10 items per transaction.",
                });
                return;
            }


            $.ajax({
                url: "../backend/user/addcart.php",
                method: "POST",
                data: {
                    prodId,
                    qnty,
                    selectedSize,
                },
                success: function(response) {
                    if (response === 'exceeds') {
                        Swal.fire({
                            title: "Item already in cart!",
                            text: "This item is already in your cart.",
                        });
                    } else if (response === 'success') {
                        Swal.fire({
                            title: "Success",
                            text: "Item added to cart!",
                        }).then(() => {
                            location.reload();
                        });
                        
                    } else if(response === 'stocks') {
                        Swal.fire({
                            title: "Insufficient Stocks",
                            text: "The quantity you entered exceeds the available stocks.",
                        });
                    }else{
                        Swal.fire({
                            title: "Error",
                            text: "An error occured while adding to cart.",
                        });
                    }
                },
                error: function() {
                    alert("Connection Error");
                }
            });
        } else {
            Swal.fire({
                title: "Log in first!",
                text: "You need to log in first before you order!",
            });
        }
    });
});
