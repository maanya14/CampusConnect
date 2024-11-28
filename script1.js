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