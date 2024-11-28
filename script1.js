// Javascript for marquee tag
const marquee = document.querySelector('.floating-headline marquee');
const messages = ["Welcome to CampusConnect!", "Empowering Students!", "Discover Opportunities!"];
let messageIndex = 0;

setInterval(() => {
    marquee.textContent = messages[messageIndex];
    messageIndex = (messageIndex + 1) % messages.length;
}, 5000); // Changes every 5 seconds

// Javascript for contact us
function validateForm() {
            // Get the field values
            var name = document.getElementById('name').value;
            var email = document.getElementById('email').value;
            var message = document.getElementById('message').value;

            // Check if any field is empty
            if (name === "" || email === "" || message === "") {
                alert('All fields are required!');
                return false; // Prevent form submission
            }

            // Email validation for .jiit.mail.ac.in domain
            var emailRegex = /^[a-zA-Z0-9._%+-]+@mail\.jiit\.ac\.in$/;
            if (!emailRegex.test(email)) {
                alert('Please enter a valid email address ending with @mail.jiit.ac.in');
                return false; // Prevent form submission
            }

            return true; // Allow form submission if all validations pass
}

function likePost(postId, button) {
    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();
    
    // Configure it to send a POST request to like_post.php
    xhr.open('POST', 'like_post.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    // Define what happens on successful data submission
    xhr.onload = function() {
        if (xhr.status === 200) {
            if (xhr.responseText === 'success') {
                // Update the like count in the button
                var likeCountSpan = button.querySelector('.like-count');
                var currentLikes = parseInt(likeCountSpan.textContent);
                likeCountSpan.textContent = currentLikes + 1;
            } else {
                console.error('Error liking post');
            }
        }
    };
    
    // Send the request
    xhr.send('post_id=' + postId);
}