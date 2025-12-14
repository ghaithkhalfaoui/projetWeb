// Main Application Logic
document.addEventListener('DOMContentLoaded', () => {
    highlightActiveLink();
});

// Navigation Active State Resource
function highlightActiveLink() {
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.nav-link');
    
    navLinks.forEach(link => {
        // Simple check for path match
        if(link.getAttribute('href') === currentPath || 
           (currentPath.endsWith('/') && link.getAttribute('href') === 'index.html')) {
            link.classList.add('active');
        } else {
            // Handle sub-pages in same folder
            const href = link.getAttribute('href');
            if(currentPath.includes(href) && href !== 'index.html') {
                 link.classList.add('active');
            }
        }
    });
}
