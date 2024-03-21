 $(document).ready(function(){
            $('form').on('submit', function(e){
                e.preventDefault(); // prevent default form submission
                var formData = $(this).serialize(); // gather form data
                $.ajax({
                    type: 'POST',
                    url: './php/login.php',
                    data: formData,
                    success: function(response){
                        // Handle success response
                        console.log(response); // For testing, you can log the response
                        // Redirect or show success message to the user
                    },
                    error: function(xhr, status, error){
                        // Handle error
                        console.error(xhr.responseText); // Log error response
                        // Show error message to the user
                    }
                });
            });
        });