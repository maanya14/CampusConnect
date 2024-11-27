var rotatingImage = document.getElementById("rotatingImage");
var imagePaths = [
    "C:/Users/hp/Downloads/jiit1.webp",
    "C:/Users/hp/Downloads/jiit3.jpeg",
    "C:/Users/hp/Downloads/jiit2.jpeg"
];
var currentImageIndex = 0;

function rotateImages() {
    currentImageIndex = currentImageIndex + 1;
    if (currentImageIndex >= imagePaths.length) {
        currentImageIndex = 0;
    }
    rotatingImage.src = imagePaths[currentImageIndex];
}

setInterval(rotateImages, 5000); // Change image every 5 seconds

// Smooth scroll for navigation links
var anchors = document.getElementsByTagName('a');
for (var i = 0; i < anchors.length; i++) {
    var anchor = anchors[i];
    if (anchor.getAttribute('href').charAt(0) === '#') {
        anchor.onclick = function(e) {
            e.preventDefault();
            var targetId = this.getAttribute('href').substring(1);
            var targetElement = document.getElementById(targetId);
            if (targetElement) {
                targetElement.scrollIntoView();
            }
        };
    }
}

// Add animation to cards on scroll
var cards = document.getElementsByClassName('card');
window.onscroll = function() {
    for (var i = 0; i < cards.length; i++) {
        var card = cards[i];
        var cardPosition = card.getBoundingClientRect().top;
        var screenPosition = window.innerHeight / 1.3;
        
        if (cardPosition < screenPosition) {
            card.style.opacity = 1;
            card.style.transform = 'translateY(0)';
        }
    }
};

for (var i = 0; i < cards.length; i++) {
    var card = cards[i];
    card.style.opacity = 0;
    card.style.transform = 'translateY(20px)';
    card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
}

// Add interactivity to the learn button
var learnButton = document.querySelector('.learn-button');
if (learnButton) {
    learnButton.onclick = function() {
        alert('Welcome to Hype Hub HQ! Explore our sections to learn more about campus life, events, and career opportunities.');
    };
}

// Add interactivity to the explore button
var exploreButton = document.querySelector('.explore-button');
if (exploreButton) {
    exploreButton.onclick = function() {
        window.location.href = '#'; // Replace with the actual URL for exploring new hubs
    };
}