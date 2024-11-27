// Simulated student data (in a real scenario, this would come from a server)
var studentInfo = {
    name: "John Doe",
    enrollment: "EN12345",
    gsuitid: "john.doe@example.com",
    gender: "Male",
    dob: "2000-01-01",
    batch: "2022",
    branch: "Computer Science",
    photo: "male-avatar.jpg"
};

// Function to populate the profile information
function populateProfile() {
    document.getElementById('student-name').textContent = studentInfo.name;
    document.getElementById('student-branch').textContent = studentInfo.branch;
    document.getElementById('enrollment').textContent = studentInfo.enrollment;
    document.getElementById('gsuitid').textContent = studentInfo.gsuitid;
    document.getElementById('gender').textContent = studentInfo.gender;
    document.getElementById('dob').textContent = studentInfo.dob;
    document.getElementById('batch').textContent = studentInfo.batch;
    document.getElementById('branch').textContent = studentInfo.branch;
    
    // Set the profile image
    var profileImage = document.getElementById('profile-image');
    profileImage.src = studentInfo.photo || 'default-avatar.jpg';
    profileImage.alt = studentInfo.name + "'s photo";
}

// Call the function when the page loads
window.onload = populateProfile;