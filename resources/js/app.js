import './bootstrap';

document.addEventListener('DOMContentLoaded', function () {
    const searchBtn = document.getElementById('search-btn');
    const searchOverlay = document.getElementById('search-overlay');
    const closeSearch = document.getElementById('close-search');
    const searchInput = document.getElementById('search-input');

    if (searchBtn && searchOverlay && closeSearch) {
        function openSearch() {
            searchOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
            setTimeout(() => searchInput.focus(), 500);
        }

        function closeSearchOverlay() {
            searchOverlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        searchBtn.addEventListener('click', function (e) {
            e.preventDefault();
            openSearch();
        });

        closeSearch.addEventListener('click', closeSearchOverlay);

        searchInput.addEventListener('input', function () {
            const results = document.getElementById('search-results');
            const loading = document.getElementById('search-loading');

            if (this.value.length > 0) {
                loading.classList.remove('hidden');
                results.classList.add('hidden', 'opacity-0', 'translate-y-4');

                clearTimeout(window.searchTimeout);

                window.searchTimeout = setTimeout(() => {
                    loading.classList.add('hidden');
                    results.classList.remove('hidden');
                    setTimeout(() => {
                        results.classList.remove('opacity-0', 'translate-y-4');
                    }, 0);
                }, 0);

            } else {
                loading.classList.add('hidden');
                results.classList.add('opacity-0', 'translate-y-4');
                setTimeout(() => {
                    results.classList.add('hidden');
                }, 500);
            }
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && searchOverlay.classList.contains('active')) {
                closeSearchOverlay();
            }
        });
    }

    // Cart Drawer Logic
    const cartBtn = document.getElementById('cart-btn');
    const cartDrawer = document.getElementById('cart-drawer');
    const cartOverlay = document.getElementById('cart-overlay');
    const closeCart = document.getElementById('close-cart-drawer');

    if (cartBtn && cartDrawer && cartOverlay) {
        function openCart() {
            cartDrawer.classList.add('active');
            cartOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeCartDrawer() {
            cartDrawer.classList.remove('active');
            cartOverlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        cartBtn.addEventListener('click', function (e) {
            e.preventDefault();
            openCart();
        });

        if (closeCart) closeCart.addEventListener('click', closeCartDrawer);
        cartOverlay.addEventListener('click', closeCartDrawer);

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && cartDrawer.classList.contains('active')) {
                closeCartDrawer();
            }
        });
    }

    // Wishlist Drawer Logic
    const wishlistBtn = document.getElementById('wishlist-btn');
    const wishlistDrawer = document.getElementById('wishlist-drawer');
    const wishlistOverlay = document.getElementById('wishlist-overlay');
    const closeWishlist = document.getElementById('close-wishlist-drawer');

    if (wishlistBtn && wishlistDrawer && wishlistOverlay) {
        function openWishlist() {
            wishlistDrawer.classList.add('active');
            wishlistOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeWishlistDrawer() {
            wishlistDrawer.classList.remove('active');
            wishlistOverlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        wishlistBtn.addEventListener('click', function (e) {
            e.preventDefault();
            openWishlist();
        });

        if (closeWishlist) closeWishlist.addEventListener('click', closeWishlistDrawer);
        wishlistOverlay.addEventListener('click', closeWishlistDrawer);

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && wishlistDrawer.classList.contains('active')) {
                closeWishlistDrawer();
            }
        });
    }

    // Category Slider Logic
    const catSlider = document.getElementById('category-slider');
    const catPrev = document.getElementById('cat-prev');
    const catNext = document.getElementById('cat-next');

    if (catSlider && catPrev && catNext) {
        const itemWidth = 303 + 36; // Card width + Gap
        const originalCount = 8; // Number of original items
        const totalWidth = originalCount * itemWidth;

        // Initialize at the start of the middle set
        catSlider.scrollLeft = totalWidth;

        catNext.addEventListener('click', function () {
            catSlider.scrollBy({ left: itemWidth, behavior: 'smooth' });

            // Check after animation if we should reset to middle
            setTimeout(() => {
                if (catSlider.scrollLeft >= totalWidth * 2) {
                    catSlider.scrollTo({ left: catSlider.scrollLeft - totalWidth, behavior: 'auto' });
                }
            }, 500);
        });

        catPrev.addEventListener('click', function () {
            catSlider.scrollBy({ left: -itemWidth, behavior: 'smooth' });

            // Check after animation if we should reset to middle
            setTimeout(() => {
                if (catSlider.scrollLeft <= totalWidth - itemWidth) {
                    catSlider.scrollTo({ left: catSlider.scrollLeft + totalWidth, behavior: 'auto' });
                }
            }, 500);
        });
    }
});
