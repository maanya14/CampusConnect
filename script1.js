// Javascript for marquee tag
const marquee = document.querySelector('.floating-headline marquee');
const messages = ["Welcome to CampusConnect!", "Empowering Students!", "Discover Opportunities!"];
let messageIndex = 0;

setInterval(() => {
    marquee.textContent = messages[messageIndex];
    messageIndex = (messageIndex + 1) % messages.length;
}, 5000); // Changes every 5 seconds

// Javascript for contact us
function validateEmail(email) {
    var atposition = email.indexOf("@");
    var dotposition = email.lastIndexOf(".");
    if (atposition < 1 || dotposition < atposition + 2 || dotposition + 2 >= email.length) {
        return false;
    }
    return email.endsWith('@mail.jiit.ac.in');
}

document.getElementById('contactForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var message = document.getElementById('message').value;
    
    if (name.trim() === '') {
        alert("Please enter your name.");
        return;
    }
    
    if (!validateEmail(email)) {
        alert("Please enter a valid email address");
        return;
    }
    
    if (message.trim() === '') {
        alert("Please enter a message.");
        return;
    }
    
    // If all validations pass, submit the form
    var formData = new FormData(this);
    
    fetch('contact.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('feedbackMessage').innerHTML = data;
        document.getElementById('feedbackMessage').style.display = 'block';
        document.getElementById('contactForm').reset();
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    });
});
