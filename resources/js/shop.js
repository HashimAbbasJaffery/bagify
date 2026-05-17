import { createApp } from 'vue';

const initVue = () => {
    const shopApp = document.getElementById('shop-app');
    if (!shopApp) return;

    const app = createApp({
        data() {
            return {
                products: [],
                colors: [],
                sizes: [],
                categories: [],
                selectedColors: [],
                selectedSizes: [],
                selectedCategories: [],
                stockStatus: null,
                minPrice: 0,
                maxPrice: 5000,
                minLimit: 0,
                maxLimit: 5000,
                pagination: {
                    current_page: 1,
                    last_page: 1,
                    links: []
                },
                loading: true,
                error: null
            }
        },
        computed: {
            progressStyle() {
                const left = (this.minPrice / this.maxLimit) * 100;
                const right = 100 - (this.maxPrice / this.maxLimit) * 100;
                return {
                    left: `${left}%`,
                    right: `${right}%`
                };
            }
        },
        methods: {
            handleMinPrice(e) {
                const val = parseInt(e.target.value);
                if (this.maxPrice - val >= 100) {
                    this.minPrice = val;
                } else {
                    this.minPrice = this.maxPrice - 100;
                }
            },
            handleMaxPrice(e) {
                const val = parseInt(e.target.value);
                if (val - this.minPrice >= 100) {
                    this.maxPrice = val;
                } else {
                    this.maxPrice = this.minPrice + 100;
                }
            },
            async fetchProducts(page = 1) {
                this.loading = true;
                this.error = null;
                try {
                    let apiParams = `page=${page}`;
                    if (this.selectedColors.length > 0) apiParams += `&colors=${this.selectedColors.join(',')}`;
                    if (this.selectedSizes.length > 0) apiParams += `&sizes=${this.selectedSizes.join(',')}`;
                    if (this.selectedCategories.length > 0) apiParams += `&categories=${this.selectedCategories.join(',')}`;
                    if (this.stockStatus) apiParams += `&stock=${this.stockStatus}`;
                    if (this.minPrice !== this.minLimit) apiParams += `&min_price=${this.minPrice}`;
                    if (this.maxPrice !== this.maxLimit) apiParams += `&max_price=${this.maxPrice}`;

                    const response = await fetch(`/api/products?${apiParams}`);
                    const data = await response.json();
                    this.products = data.data;

                    if (data.meta) {
                        this.pagination = {
                            current_page: data.meta.current_page,
                            last_page: data.meta.last_page,
                            links: data.meta.links
                        };
                    }

                    // Update Browser URL
                    this.updateBrowserUrl(apiParams);

                    window.scrollTo({ top: 0, behavior: 'smooth' });
                } catch (err) {
                    console.error('Error fetching products:', err);
                    this.error = 'Failed to load products.';
                } finally {
                    this.loading = false;
                }
            },
            updateBrowserUrl(params) {
                // If it's just page=1 and nothing else, reset to base URL
                if (params === 'page=1') {
                    window.history.pushState({ path: window.location.pathname }, '', window.location.pathname);
                } else {
                    const newUrl = `${window.location.pathname}?${params}`;
                    window.history.pushState({ path: newUrl }, '', newUrl);
                }
            },
            async fetchFilters() {
                try {
                    const [colorsRes, sizesRes, categoriesRes] = await Promise.all([
                        fetch('/api/colors'),
                        fetch('/api/sizes'),
                        fetch('/api/categories')
                    ]);

                    const colorsData = await colorsRes.json();
                    const sizesData = await sizesRes.json();
                    const categoriesData = await categoriesRes.json();

                    this.colors = colorsData.data || colorsData;
                    this.sizes = sizesData.data || sizesData;
                    this.categories = categoriesData.data || categoriesData;
                } catch (err) {
                    console.error('Error fetching filters:', err);
                }
            },
            toggleColor(colorId) {
                const index = this.selectedColors.indexOf(colorId);
                if (index > -1) this.selectedColors.splice(index, 1);
                else this.selectedColors.push(colorId);
            },
            toggleSize(sizeId) {
                const index = this.selectedSizes.indexOf(sizeId);
                if (index > -1) this.selectedSizes.splice(index, 1);
                else this.selectedSizes.push(sizeId);
            },
            toggleCategory(categoryId) {
                const index = this.selectedCategories.indexOf(categoryId);
                if (index > -1) this.selectedCategories.splice(index, 1);
                else this.selectedCategories.push(categoryId);
            },
            toggleStock(status) {
                this.stockStatus = this.stockStatus === status ? null : status;
            },
            applyFilters() {
                this.fetchProducts(1);
                const filterDrawer = document.getElementById('filter-drawer');
                const filterOverlay = document.getElementById('filter-overlay');
                if (filterDrawer && filterOverlay) {
                    filterDrawer.classList.remove('active');
                    filterOverlay.classList.remove('active');
                    document.body.style.overflow = '';
                }
            },
            resetFilters() {
                this.selectedColors = [];
                this.selectedSizes = [];
                this.selectedCategories = [];
                this.stockStatus = null;
                this.minPrice = this.minLimit;
                this.maxPrice = this.maxLimit;
                this.applyFilters();
            },
            loadFiltersFromUrl() {
                const params = new URLSearchParams(window.location.search);
                if (params.has('colors')) this.selectedColors = params.get('colors').split(',').map(Number);
                if (params.has('sizes')) this.selectedSizes = params.get('sizes').split(',').map(Number);
                if (params.has('categories')) this.selectedCategories = params.get('categories').split(',').map(Number);
                if (params.has('stock')) this.stockStatus = params.get('stock');
                if (params.has('min_price')) this.minPrice = parseInt(params.get('min_price'));
                if (params.has('max_price')) this.maxPrice = parseInt(params.get('max_price'));
                if (params.has('page')) this.pagination.current_page = parseInt(params.get('page'));
            },
            isColorSelected(colorId) { return this.selectedColors.includes(colorId); },
            isSizeSelected(sizeId) { return this.selectedSizes.includes(sizeId); },
            isCategorySelected(categoryId) { return this.selectedCategories.includes(categoryId); },
            formatPrice(price) { return new Intl.NumberFormat().format(price); },
            changePage(url) {
                if (!url) return;
                const urlParams = new URLSearchParams(new URL(url).search);
                const page = urlParams.get('page');
                this.fetchProducts(page);
            },
            addToCartFromCard(productId, event) {
                if (window.addCardToCart) {
                    window.addCardToCart(productId, event.currentTarget, event);
                }
            }
        },
        mounted() {
            this.loadFiltersFromUrl();
            this.fetchProducts(this.pagination.current_page);
            this.fetchFilters();

            // Handle back/forward button
            window.addEventListener('popstate', () => {
                this.loadFiltersFromUrl();
                this.fetchProducts(this.pagination.current_page);
            });
        }
    });

    app.mount('#shop-app');
};

document.addEventListener('DOMContentLoaded', function () {
    initVue();

    const dropdown = document.getElementById('sort-dropdown');
    const menu = document.getElementById('sort-menu');
    const options = document.querySelectorAll('.sort-option');

    if (dropdown && menu) {
        function toggleMenu() { menu.classList.toggle('active'); }
        function closeMenu() { menu.classList.remove('active'); }

        dropdown.addEventListener('click', function (e) {
            e.stopPropagation();
            toggleMenu();
        });

        document.addEventListener('click', function (e) {
            if (menu && !menu.contains(e.target) && dropdown && !dropdown.contains(e.target)) {
                closeMenu();
            }
        });

        options.forEach(option => {
            option.addEventListener('click', function () {
                options.forEach(opt => opt.classList.remove('active'));
                this.classList.add('active');
                const selectedText = this.textContent.trim();
                const textElement = dropdown.querySelector('p');
                if (textElement) textElement.innerText = selectedText;
                setTimeout(closeMenu, 200);
            });
        });
    }

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

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && filterDrawer.classList.contains('active')) {
                closeFilterDrawer();
            }
        });
    }
});
