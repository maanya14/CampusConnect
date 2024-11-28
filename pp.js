// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Get the form element
    const form = document.getElementById('student-info-form');
    
    // Add submit event listener to the form
    form.addEventListener('submit', function(event) {
        // Prevent the default form submission
        event.preventDefault();
        
        // Get password fields
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm-password').value;
        
        // Basic password validation
        if (password !== confirmPassword) {
            alert('Passwords do not match!');
            return false;
        }
        
        // Basic enrollment number validation (assuming it should be numbers only)
        const enrollment = document.getElementById('enrollment').value;
        if (!/^\d+$/.test(enrollment)) {
            alert('Enrollment number should contain only numbers!');
            return false;
        }
        
        // If all validations pass, submit the form
        const formData = new FormData(form);
        
        // Send data to PHP using basic fetch
        fetch('signup.php', {
            method: 'POST',
            body: formData
        })
        .then(function(response) {
            return response.text();
        })
        .then(function(data) {
            // Check if the response contains success message
            if (data.includes('Record added successfully')) {
                // Hide the form
                document.getElementById('signup-form').style.display = 'none';
                // Show success message
                document.getElementById('success-message').style.display = 'block';
                
                // Redirect after 2 seconds
                setTimeout(function() {
                    window.location.href = '1.html';
                }, 2000);
            } else {
                // Show error message
                alert('Error: ' + data);
            }
        })
        .catch(function(error) {
            alert('Error: ' + error.message);
        });
    });
});
