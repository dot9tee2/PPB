document.addEventListener('DOMContentLoaded', () => {
    const menuBtn = document.querySelector('.menu-btn');
    const sidebar = document.querySelector('.sidebar');
    const closeBtn = document.querySelector('.close-btn');

    if (menuBtn && sidebar) {
        // Toggle sidebar on menu button click
        menuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });

        // Close sidebar when close button is clicked
        if (closeBtn) {
            closeBtn.addEventListener('click', () => {
                sidebar.classList.remove('active');
            });
        }

        // Close sidebar when clicking outside
        document.addEventListener('click', (e) => {
            if (!sidebar.contains(e.target) && !menuBtn.contains(e.target)) {
                sidebar.classList.remove('active');
            }
        });

        // Close sidebar on window resize (if wider than mobile breakpoint)
        window.addEventListener('resize', () => {
            if (window.innerWidth > 768) {
                sidebar.classList.remove('active');
            }
        });
    }
}); 