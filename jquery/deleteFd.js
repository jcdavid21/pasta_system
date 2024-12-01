$(document).ready(function(){
    $(".delete").on("click", function(e){
        e.preventDefault();
        const id = $(this).attr("id");
        Swal.fire({
            title: "Are you sure?",
            text: "Delete this feedback?",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "../backend/admin/deleteFd.php",
                    type: "POST",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        Swal.fire(
                            "Deleted!",
                            "Record has been deleted.",
                        ).then((result) => {
                            location.reload();
                        });
                    }
                });
            }
        });
    });
})