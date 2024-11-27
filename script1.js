// Javascript for marquee tag
const marquee = document.querySelector('.floating-headline marquee');
const messages = ["Welcome to CampusConnect!", "Empowering Students!", "Discover Opportunities!"];
let messageIndex = 0;

setInterval(() => {
    marquee.textContent = messages[messageIndex];
    messageIndex = (messageIndex + 1) % messages.length;
}, 5000); // Changes every 5 seconds

// Javascript for contact us
function validateemail(email) {
    var atposition = email.indexOf("@");
    var dotposition = email.lastIndexOf(".");
    if (atposition < 1 || dotposition < atposition + 2 || dotposition + 2 >= email.length) {
        return false;
    }
    return email.endsWith('@mail.jiit.ac.in');
}

document.getElementById('contactForm').addEventListener('submit', function(event) {
    event.preventDefault();  // Prevent form from submitting the usual way

    var name = document.getElementById('name').value.trim();
    var email = document.getElementById('email').value.trim();
    var message = document.getElementById('message').value.trim();
    
    if (name === '') {
        alert("Please enter your name.");
        return;
    }
    
    if (!validateemail(email)) {
        alert("Please enter a valid JIIT email address.");
        return;
    }
    
    if (message === '') {
        alert("Please enter a message.");
        return;
    }

    // Hide the form
    document.getElementById('contactForm').style.display = 'none';
    
    // Show the thank you message
    document.getElementById('feedbackMessage').style.display = 'block';

    // Optionally, you can send the form data to a PHP script here using AJAX (if needed)
    // For now, the form is just being hidden and thank you message is displayed without actual form submission.
});
