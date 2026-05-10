document.addEventListener('DOMContentLoaded', function() {
    const dropdown = document.getElementById('sort-dropdown');
    const menu = document.getElementById('sort-menu');
    const options = document.querySelectorAll('.sort-option');

    if (!dropdown || !menu) return;

    function toggleMenu() {
        menu.classList.toggle('active');
    }

    function closeMenu() {
        menu.classList.remove('active');
    }

    dropdown.addEventListener('click', function(e) {
        e.stopPropagation();
        toggleMenu();
    });

    document.addEventListener('click', function(e) {
        if (!menu.contains(e.target) && !dropdown.contains(e.target)) {
            closeMenu();
        }
    });

    options.forEach(option => {
        option.addEventListener('click', function() {
            options.forEach(opt => opt.classList.remove('active'));
            this.classList.add('active');
            
            const selectedText = this.textContent.trim();
            const textElement = dropdown.querySelector('p');
            if (textElement) textElement.innerText = selectedText;
            
            setTimeout(closeMenu, 200);
        });
    });

    const filterBtn = document.getElementById('filter-btn');
    const filterDrawer = document.getElementById('filter-drawer');
    const filterOverlay = document.getElementById('filter-overlay');
    const closeFilter = document.getElementById('close-filter-drawer');

    if (filterBtn && filterDrawer && filterOverlay) {
        function openFilter() {
            filterDrawer.classList.add('active');
            filterOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeFilterDrawer() {
            filterDrawer.classList.remove('active');
            filterOverlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        filterBtn.addEventListener('click', openFilter);
        if (closeFilter) closeFilter.addEventListener('click', closeFilterDrawer);
        filterOverlay.addEventListener('click', closeFilterDrawer);

        // Close on Esc key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && filterDrawer.classList.contains('active')) {
                closeFilterDrawer();
            }
        });
    }
});

