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

/// Function to toggle like/unlike a post
function toggleLike(event) {
    const button = event.target.closest('button');  // Get the button clicked
    const likeCountSpan = button.querySelector(".like-count");
    const heartIcon = button.querySelector("i");
    let currentLikes = parseInt(likeCountSpan.textContent);

    if (heartIcon.classList.contains("fa-heart")) {  // If heart is unfilled (unliked)
        heartIcon.classList.remove("fa-heart");  // Change to filled heart
        heartIcon.classList.add("fa-heart-solid");
        likeCountSpan.textContent = currentLikes + 1;  // Increment likes
    } else {  // If heart is filled (liked)
        heartIcon.classList.remove("fa-heart-solid");  // Change to unfilled heart
        heartIcon.classList.add("fa-heart");
        likeCountSpan.textContent = currentLikes - 1;  // Decrement likes
    }
}

// Function to open contact page
function openContactUs(event) {
    window.location.href = 'contact.php';  // Navigate to the contact page
}