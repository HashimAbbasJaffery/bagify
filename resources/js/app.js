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
            const grid = document.getElementById('search-results-grid');
            const title = document.getElementById('search-results-title');
            const loading = document.getElementById('search-loading');

            const queryText = this.value.trim();

            if (queryText.length > 0) {
                loading.classList.remove('hidden');
                results.classList.add('hidden', 'opacity-0', 'translate-y-4');

                clearTimeout(window.searchTimeout);

                window.searchTimeout = setTimeout(() => {
                    fetch(`/api/products/search?query=${encodeURIComponent(queryText)}`)
                        .then(res => res.json())
                        .then(resData => {
                            const products = resData.data || [];
                            grid.innerHTML = '';
                            
                            if (products.length > 0) {
                                title.textContent = "Products Found";
                                products.forEach(product => {
                                    const mainImage = product.image || '/assets/images/product.png';
                                    const productUrl = `/product/${product.slug}`;
                                    const priceText = product.discount_percentage > 0 
                                        ? `PKR ${parseFloat(product.price - (product.price * product.discount_percentage / 100)).toLocaleString()} <span class="text-white/40 line-through ml-2 text-[12px]">PKR ${parseFloat(product.price).toLocaleString()}</span>`
                                        : `PKR ${parseFloat(product.price).toLocaleString()}`;

                                    const itemHtml = `
                                        <a href="${productUrl}" class="group block cursor-pointer">
                                            <div class="aspect-square bg-white/5 rounded-2xl overflow-hidden mb-4 relative">
                                                <img src="${mainImage}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                                ${product.discount_percentage > 0 ? `<span class="absolute top-3 left-3 bg-[#8B3118] text-white text-[10px] font-bold px-2 py-0.5 rounded-full">-${Math.round(product.discount_percentage)}%</span>` : ''}
                                            </div>
                                            <h4 class="text-white font-poppins text-[16px] truncate font-medium group-hover:text-[#8B3118] transition-colors">${product.name}</h4>
                                            <p class="text-white/60 font-poppins text-[14px] mt-1">${priceText}</p>
                                        </a>
                                    `;
                                    grid.insertAdjacentHTML('beforeend', itemHtml);
                                });
                            } else {
                                title.textContent = "No Results Found";
                                grid.innerHTML = `
                                    <div class="col-span-full py-10 text-center">
                                        <p class="text-white/40 font-poppins text-[16px]">We couldn't find any products matching "${queryText.replace(/</g, "&lt;").replace(/>/g, "&gt;")}"</p>
                                    </div>
                                `;
                            }

                            loading.classList.add('hidden');
                            results.classList.remove('hidden');
                            setTimeout(() => {
                                results.classList.remove('opacity-0', 'translate-y-4');
                            }, 50);
                        })
                        .catch(err => {
                            console.error("Search error:", err);
                            loading.classList.add('hidden');
                        });
                }, 400);

            } else {
                loading.classList.add('hidden');
                results.classList.add('opacity-0', 'translate-y-4');
                setTimeout(() => {
                    results.classList.add('hidden');
                }, 300);
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
        window.openCartDrawer = function() {
            cartDrawer.classList.add('active');
            cartOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        };

        function closeCartDrawer() {
            cartDrawer.classList.remove('active');
            cartOverlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        cartBtn.addEventListener('click', function (e) {
            e.preventDefault();
            window.openCartDrawer();
        });

        if (closeCart) closeCart.addEventListener('click', closeCartDrawer);
        cartOverlay.addEventListener('click', closeCartDrawer);

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && cartDrawer.classList.contains('active')) {
                closeCartDrawer();
            }
        });

        // Global Cart Manager & Actions
        window.refreshCartDrawer = function() {
            fetch('/api/cart')
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        renderCartData(data.cart);
                    }
                })
                .catch(err => console.error("Error fetching cart data:", err));
        };

        window.updateCartItemQty = function(key, qty) {
            if (qty < 1) {
                window.removeCartItem(key);
                return;
            }
            
            fetch(`/api/cart/${key}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({ quantity: qty })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        renderCartData(data.cart);
                    } else {
                        alert(data.message || "Failed to update cart.");
                    }
                })
                .catch(err => console.error("Error updating cart item:", err));
        };

        window.removeCartItem = function(key) {
            fetch(`/api/cart/${key}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                }
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        renderCartData(data.cart);
                    }
                })
                .catch(err => console.error("Error removing cart item:", err));
        };

        function renderCartData(cart) {
            const itemsContainer = document.getElementById('cart-items-container');
            const countBadge = document.getElementById('cart-count-drawer-badge');
            const subtotalVal = document.getElementById('cart-subtotal-value');
            const emptyMsg = document.getElementById('cart-empty-message');
            
            if (!itemsContainer) return;
            
            // Update Count Badges
            if (countBadge) {
                countBadge.innerText = `(${cart.count})`;
            }
            
            const headerBadge = document.getElementById('cart-count-badge');
            if (headerBadge) {
                headerBadge.innerText = cart.count;
                if (cart.count > 0) {
                    headerBadge.classList.remove('hidden', 'scale-0');
                } else {
                    headerBadge.classList.add('hidden', 'scale-0');
                }
            }
            
            // Update Subtotal
            if (subtotalVal) {
                subtotalVal.innerText = `PKR ${cart.subtotal_formatted}`;
            }
            
            // Clear previous items (except the empty message)
            const oldItems = itemsContainer.querySelectorAll('.cart-item-row');
            oldItems.forEach(el => el.remove());
            
            if (cart.items.length === 0) {
                if (emptyMsg) emptyMsg.classList.remove('hidden');
                return;
            }
            
            if (emptyMsg) emptyMsg.classList.add('hidden');
            
            // Build items
            cart.items.forEach(item => {
                const itemHtml = `
                    <div class="cart-item-row flex gap-5 mb-8 group" data-key="${item.key}">
                        <div class="w-[100px] h-[100px] bg-[#F6F6F6] rounded-2xl overflow-hidden flex-shrink-0">
                            <img src="${item.image}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <div class="flex flex-col justify-between py-1 flex-1">
                            <div>
                                <div class="flex justify-between items-start">
                                    <h3 class="font-poppins font-medium text-[16px] mb-1 leading-snug">${item.name}</h3>
                                    <button class="text-grey hover:text-black transition-colors ml-2 cursor-pointer" onclick="window.removeCartItem('${item.key}')">
                                        <i class="fa-solid fa-trash-can text-[14px]"></i>
                                    </button>
                                </div>
                                <p class="text-grey text-[14px]">Color: ${item.color || 'N/A'} / Size: ${item.size || 'N/A'}</p>
                            </div>
                            <div class="flex justify-between items-end mt-2">
                                <div class="flex items-center gap-4 bg-[#F6F6F6] px-3 py-1 rounded-full">
                                    <button class="text-[12px] cursor-pointer text-grey hover:text-black transition-colors" onclick="window.updateCartItemQty('${item.key}', ${item.quantity - 1})">
                                        <i class="fa-solid fa-minus"></i>
                                    </button>
                                    <span class="font-poppins text-[14px] font-medium">${String(item.quantity).padStart(2, '0')}</span>
                                    <button class="text-[12px] cursor-pointer text-grey hover:text-black transition-colors" onclick="window.updateCartItemQty('${item.key}', ${item.quantity + 1})">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </div>
                                <p class="font-semibold font-poppins text-[16px]">PKR ${new Intl.NumberFormat().format(item.price * item.quantity)}</p>
                            </div>
                        </div>
                    </div>
                `;
                itemsContainer.insertAdjacentHTML('beforeend', itemHtml);
            });
        }

        // Initial Load of Cart
        window.refreshCartDrawer();
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

// Global Card Quick-Add Managers
window.addCardToCart = function(productId, buttonElement, event) {
    if (event) {
        event.stopPropagation();
        event.preventDefault();
    }
    
    if (!productId) {
        console.error("No product ID provided for add to cart.");
        return;
    }
    
    // Disable button to prevent double-click
    buttonElement.disabled = true;
    const originalContent = buttonElement.innerHTML;
    buttonElement.innerHTML = `<i class="fa-solid fa-spinner animate-spin"></i> Adding...`;
    
    fetch('/api/cart', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: 1,
            color: null,
            size: null
        })
    })
    .then(res => {
        if (!res.ok) {
            return res.json().then(err => { throw err; });
        }
        return res.json();
    })
    .then(data => {
        if (data.success) {
            if (window.refreshCartDrawer) {
                window.refreshCartDrawer();
            }
            
            // Run the dynamic Fly-to-Cart animation from this card's image!
            runCardFlyToCartAnimation(buttonElement);
        }
    })
    .catch(err => {
        console.error("Error adding to cart:", err);
        alert(err.message || "Failed to add product to cart. Please check stock.");
    })
    .finally(() => {
        buttonElement.disabled = false;
        buttonElement.innerHTML = originalContent;
    });
};

function runCardFlyToCartAnimation(buttonElement) {
    const card = buttonElement.closest('.product');
    const mainImg = card ? card.querySelector('img') : null;
    const cartBtn = document.getElementById('cart-btn');
    
    if (!mainImg || !cartBtn) {
        if (window.openCartDrawer) window.openCartDrawer();
        return;
    }
    
    const imgRect = mainImg.getBoundingClientRect();
    const cartRect = cartBtn.getBoundingClientRect();
    
    const flyer = document.createElement('img');
    flyer.src = mainImg.src;
    flyer.className = 'flying-cart-item';
    
    flyer.style.left = `${imgRect.left}px`;
    flyer.style.top = `${imgRect.top}px`;
    flyer.style.width = `${imgRect.width}px`;
    flyer.style.height = `${imgRect.height}px`;
    
    document.body.appendChild(flyer);
    
    flyer.offsetWidth;
    
    const destX = cartRect.left + (cartRect.width / 2) - 20;
    const destY = cartRect.top + (cartRect.height / 2) - 20;
    
    flyer.style.left = `${destX}px`;
    flyer.style.top = `${destY}px`;
    flyer.style.width = '40px';
    flyer.style.height = '40px';
    flyer.style.opacity = '0.1';
    
    setTimeout(() => {
        flyer.remove();
        
        cartBtn.classList.add('cart-bounce-active');
        
        setTimeout(() => {
            cartBtn.classList.remove('cart-bounce-active');
            
            if (window.openCartDrawer) {
                window.openCartDrawer();
            }
        }, 600);
    }, 900);
}

