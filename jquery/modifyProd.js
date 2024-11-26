$(document).ready(()=>{
    $('.updateResBtn').on('click', function(){
        const prod_name = $(this).closest('.modal-content').find('.updatedName').val();
        const prod_price_small = $(this).closest('.modal-content').find('.priceSmall').val();
        const prod_price_medium = $(this).closest('.modal-content').find('.priceMedium').val();
        const prod_price_large = $(this).closest('.modal-content').find('.priceLarge').val();
        const prod_id = $(this).val();
        const prod_description = $(this).closest('.modal-content').find('.updatedDesc').val();
        
        if(prod_id && prod_name && prod_price_small && prod_price_medium && prod_price_large ){
            $.ajax({
                url: "../backend/admin/updateProd.php",
                method: "post",
                data:{
                    prod_id,
                    prod_name,
                    prod_price_small,
                    prod_price_medium,
                    prod_price_large,
                    prod_description
                },
                success: function(response){
                    if(response === 'success'){
                        Swal.fire({
                            title: "Product Updated",
                            text: "Product has been updated",
                        }).then((result)=>{
                            if(result.isConfirmed){
                                window.location.reload();
                            }
                        })
                    }else if(response === 'you cannot reduce the stocks'){
                        Swal.fire({
                            title: "Invalid Stocks",
                            text: "You cannot reduce the stocks",
                        })
                    }else{
                        Swal.fire({
                            title: "Product Not Updated",
                            text: "Product has not been updated",
                        })
                    }
                },
                error: function(){
                    alert("Connection Error")
                }
            })
        }else{
            Swal.fire({
                title: "Empty Field!",
                text: "You cannot empty the field.",
                showConfirmButton: false,
                timer: 1500
              });
        }
    })

    $('.deleteProd').on('click', function(){
        const prod_id = $(this).val();
        Swal.fire({
            title: "Are you sure you want to delete this product?",
            showCancelButton: true,
            confirmButtonText: "Yes",
            cancelButtonText: "No"
        }).then((result)=>{
            if(result.isConfirmed){
                $.ajax({
                    url:"../backend/admin/deleteProd.php",
                    method: "post",
                    data:{
                        prod_id,
                    },
                    success: function(response){
                        if(response === "deleted"){
                            Swal.fire({
                                title: "Product Deleted",
                                text: "Product has been deleted",
                            }).then((result)=>{
                                if(result.isConfirmed){
                                    window.location.reload();
                                }
                            })
                        }
                    },
                    error: function(){
                        alert("Connection Error!");
                    }
                })
            }
        })
    })
})
