var studentInfo = {};

function showSection(sectionId) {
    var sections = ['signup-form', 'password-form', 'success-message'];
    for (var i = 0; i < sections.length; i++) {
        document.getElementById(sections[i]).style.display = sections[i] === sectionId ? 'block' : 'none';
    }
}

document.getElementById('student-info-form').onsubmit = function(e) {
    e.preventDefault();
    studentInfo = {
        name: document.getElementById('name').value,
        enrollment: document.getElementById('enrollment').value,
        gsuitid: document.getElementById('gsuitid').value,
        gender: document.getElementById('gender').value,
        dob: document.getElementById('dob').value,
        batch: document.getElementById('batch').value,
        branch: document.getElementById('branch').value
    };
    showSection('password-form');
};

document.getElementById('password-set-form').onsubmit = function(e) {
    e.preventDefault();
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('confirm-password').value;
    if (password !== confirmPassword) {
        alert('Passwords do not match!');
        return;
    }
    studentInfo.password = password;
    showSection('success-message');
    setTimeout(function() {
        // Redirect to the new page
        window.location.href = 'https://example.com/new-page';
    }, 2000);
};