// Javascript for marquee tag
const marquee = document.querySelector('.floating-headline marquee');
const messages = ["Welcome to CampusConnect!", "Empowering Students!", "Discover Opportunities!"];
let messageIndex = 0;

setInterval(() => {
    marquee.textContent = messages[messageIndex];
    messageIndex = (messageIndex + 1) % messages.length;}, 5000); // Changes every 3 seconds

//Javascript for contact us
function validateemail()  
{  
var x=document.myform.email.value;  
var y=document.myform.name.value;
var z=document.myform.message.value;
var atposition=x.indexOf("@");  
var dotposition=x.lastIndexOf(".");  
if (atposition<1 || dotposition<atposition+2 || dotposition+2>=x.length){  
    alert("Please enter a valid e-mail address \n atpostion:"+atposition+"\n dotposition:"+dotposition);  
    return false;  
    } 
if (!email.endsWith('@mail.jiit.ac.in')) {
        alert("Email must end with @mail.jiit.ac.in.");
        return false;
  }  
}  
