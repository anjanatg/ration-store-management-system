document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.getElementById('sidebarToggle');
    const closeButton = document.getElementById('sidebarClose');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.querySelector('.main-content');

    if (!toggleButton || !sidebar || !mainContent) {
        console.error('Sidebar toggle elements not found.');
        return;
    }

    toggleButton.addEventListener('click', function () {
        if (window.innerWidth <= 991) {
            sidebar.classList.toggle('sidebar-open');
        } else {
            sidebar.classList.toggle('sidebar-hidden');
            mainContent.classList.toggle('expanded');
        }
    });

    if (closeButton) {
        closeButton.addEventListener('click', function () {
            sidebar.classList.remove('sidebar-open');
        });
    }
});