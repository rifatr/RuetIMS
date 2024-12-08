// Smooth scrolling for navigation links
document.querySelectorAll('header nav a').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const targetId = this.getAttribute('href').substring(1);
        document.getElementById(targetId).scrollIntoView({ behavior: 'smooth' });
    });
});

// Modal functionality
function openModal(departmentName) {
    document.getElementById('modal-title').innerText = departmentName;
    document.getElementById('modal-description').innerText = 
        `Detailed information about the ${departmentName} department and its instruments.`;
    document.getElementById('modal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('modal').style.display = 'none';
}

// Close modal when clicking outside content
window.onclick = function(event) {
    if (event.target === document.getElementById('modal')) {
        closeModal();
    }
};