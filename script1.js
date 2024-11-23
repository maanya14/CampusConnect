// Javascript for marquee tag
const marquee = document.querySelector('.floating-headline marquee');
const messages = ["Welcome to CampusConnect!", "Empowering Students!", "Discover Opportunities!"];
let messageIndex = 0;

setInterval(() => {
    marquee.textContent = messages[messageIndex];
    messageIndex = (messageIndex + 1) % messages.length;}, 5000); // Changes every 3 seconds

    // Javascript for ContactUs
    function submitform(event) {
        // Prevent the default form submission behavior
        event.preventDefault();
        
        // Get the user input values
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const message = document.getElementById('message').value.trim();
    
        // Check if inputs are filled
        if (name === "" || email === "" || message === "") {
            alert('Please fill in all required fields.');
            return; // Prevent further execution if fields are empty
        }
    
        // Display a thank-you message
        const formContainer = document.getElementById('contactForm').parentElement;
        formContainer.innerHTML = '<p>Thank you for your message! We will get back to you soon.</p>';
        formContainer.querySelector('p').style.color = 'green';
    }
    


