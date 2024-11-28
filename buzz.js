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

setInterval(rotateImages, 5000); 


