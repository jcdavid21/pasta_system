$(document).ready(function() {
    
    $('.submit').on('click', function(e) {
        e.preventDefault();
        const report = $(this).closest('.modal-content').find('.message-response').val();
        const email = $(this).closest('.modal-content').find('.email-val').val();

        if (report === '') {
            Swal.fire({
                title: 'Empty Fields!',
                text: 'Please fill out the required fields.',
            });
            return;
        }

        // Show the loading modal before the AJAX call
        Swal.fire({
            title: 'Sending Report...',
            text: 'Please wait while we process your request.',
            allowOutsideClick: false, // Prevent closing by clicking outside
            didOpen: () => {
                Swal.showLoading(); // Show loading spinner
            }
        });

        $.ajax({
            url: '../backend/admin/responseReport.php',
            method: 'post',
            data: {
                report: report,
                email: email
            },
            success: function(response) {
                
                // Close the loading modal
                Swal.close();

                if (response === 'success') {
                    Swal.fire({
                        title: 'Report Sent!',
                        text: 'Report has been sent successfully!',
                        
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Something went wrong, please try again later.',
                        
                    });
                }
            },
            error: function() {
                Swal.close(); // Close the loading modal
                Swal.fire({
                    title: 'Connection Error',
                    text: 'Failed to send the report. Please check your connection.',
                    
                });
            }
        });
    });
});
