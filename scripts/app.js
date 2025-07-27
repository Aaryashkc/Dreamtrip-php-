// Mobile menu toggle functionality
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // Initialize page-specific scripts if they exist
    if (typeof initializePage === 'function') {
        initializePage();
    }
});

// Function to show a status message
function showStatusMessage(message, type = 'success') {
    const statusDiv = document.createElement('div');
    statusDiv.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 ${
        type === 'success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
    }`;
    statusDiv.textContent = message;
    document.body.appendChild(statusDiv);
    
    // Remove message after 5 seconds
    setTimeout(() => {
        statusDiv.remove();
    }, 5000);
}
