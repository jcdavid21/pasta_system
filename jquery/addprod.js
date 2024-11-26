$(document).ready(function() {
    $('#addProd').submit(function(event) {
        event.preventDefault(); // Prevent the form from submitting normally
        
        // Get form values
        var productName = $('#prod_name').val();
        var productPriceSmall = $('#prod_price_small').val();
        var productPriceMedium = $('#prod_price_medium').val();
        var productPriceLarge = $('#prod_price_large').val();
        var productType = $('#prod_type').val();
        var productImage = $('#prod_img').prop('files')[0];

        if(!productName || !productPriceSmall || !productPriceMedium || !productPriceLarge || !productType || !productImage){
            Swal.fire({
                title: "Empty Field!",
                text: "Please fill in all fields.",
                showConfirmButton: true,
            })
            return;
        }


        // Create FormData object
        var formData = new FormData();
        formData.append('productName', productName);
        formData.append('productPriceSmall', productPriceSmall);
        formData.append('productPriceMedium', productPriceMedium);
        formData.append('productPriceLarge', productPriceLarge);
        formData.append('productType', productType);
        formData.append('productImage', productImage);

        // AJAX request to submit form data
        $.ajax({
            url: '../backend/admin/add_product.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // Handle success response
                if (response === 'success') {
                    Swal.fire({
                        title: "Successfully Added",
                        text: "Product Added Successfully!",
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result)=>{
                        if(result){
                            $('#addProd')[0].reset();
                            location.reload();
                        }
                    })
                    
                } else {
                    alert('Failed to add product. Please try again later.');
                }
            },
            error: function() {
                // Handle error response
                alert('Error: Failed to communicate with server.');
            }
        });
    });

    $('#addProdMain').submit(function(e){
        e.preventDefault();
        var prodNameMain = $('#prod_name_main').val();

        if(!prodNameMain){
            Swal.fire({
                title: "Empty Product Name!",
                text: "Please fill in all fields.",
                showConfirmButton: true,
            })
            return;
        }

        $.ajax({
            url: "../backend/admin/addProdMain.php",
            method: "post",
            data: {prodNameMain},
            success: function(response){
                if(response === 'success'){
                    Swal.fire({
                        title: "Successfully Added",
                        text: "Product Added Successfully!",
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result)=>{
                        if(result){
                            location.reload();
                        }
                    })
                }else if(response === 'exist'){
                    Swal.fire({
                        title: "Folder Already Exist!",
                        text: "Please try another name.",
                        showConfirmButton: true,
                        timer: 2000
                    })
                }
            },
            error: function() {
                // Handle error response
                alert('Error: Failed to communicate with server.');
            }
        })
    })

});
