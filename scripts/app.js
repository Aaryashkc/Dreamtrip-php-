document.addEventListener('DOMContentLoaded', function() {
    const mainContent = document.getElementById('main-content');

    const loadPage = async (url, pushState = true) => {
        try {
            const response = await fetch(`${url}?ajax=1`);
            if (!response.ok) {
                throw new Error('Network response was not ok.');
            }
            const content = await response.text();

            // Fade out, replace content, fade in
            mainContent.style.opacity = 0;
            setTimeout(() => {
                mainContent.innerHTML = content;
                mainContent.style.opacity = 1;
                if (pushState) {
                    history.pushState({ path: url }, '', url);
                }
                reinitializeDynamicScripts();
            }, 200); 

        } catch (error) {
            console.error('Failed to load page:', error);
            window.location.href = url;
        }
    };

    document.body.addEventListener('click', function(e) {
        const link = e.target.closest('a.nav-link');
        if (link) {
            e.preventDefault();
            const href = link.getAttribute('href');
            loadPage(href);
        }
    });

    window.addEventListener('popstate', function(e) {
        if (e.state && e.state.path) {
            loadPage(e.state.path, false);
        }
    });


    history.replaceState({ path: window.location.pathname }, '', window.location.pathname);

    function reinitializeDynamicScripts() {
        if (typeof initializeDashboard === 'function') {
            initializeDashboard();
        }
        if (typeof initializeAddDestination === 'function') {
            initializeAddDestination();
        }
    }
});
