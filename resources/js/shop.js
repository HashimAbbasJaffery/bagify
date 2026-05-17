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
                sortBy: 'best_selling',
                sortMenuOpen: false,
                // Applied filters state (only computed & applied when they click "Go" or loaded from URL)
                appliedColors: [],
                appliedSizes: [],
                appliedCategories: [],
                appliedStockStatus: null,
                appliedMinPrice: 0,
                appliedMaxPrice: 5000,
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
            },
            activeFilters() {
                const list = [];

                // 1. Categories
                this.appliedCategories.forEach(id => {
                    const cat = this.categories.find(c => c.id === id);
                    if (cat) {
                        list.push({
                            type: 'category',
                            id: id,
                            label: cat.name
                        });
                    }
                });

                // 2. Colors
                this.appliedColors.forEach(id => {
                    const col = this.colors.find(c => c.id === id);
                    if (col) {
                        list.push({
                            type: 'color',
                            id: id,
                            label: col.name
                        });
                    }
                });

                // 3. Sizes
                this.appliedSizes.forEach(id => {
                    const sz = this.sizes.find(s => s.id === id);
                    if (sz) {
                        list.push({
                            type: 'size',
                            id: id,
                            label: sz.name.toUpperCase()
                        });
                    }
                });

                // 4. Stock
                if (this.appliedStockStatus) {
                    list.push({
                        type: 'stock',
                        id: this.appliedStockStatus,
                        label: this.appliedStockStatus === 'in_stock' ? 'In Stock' : 'Out of Stock'
                    });
                }

                // 5. Price
                if (this.appliedMinPrice !== this.minLimit || this.appliedMaxPrice !== this.maxLimit) {
                    list.push({
                        type: 'price',
                        id: 'price',
                        label: `Price: PKR ${this.formatPrice(this.appliedMinPrice)} - PKR ${this.formatPrice(this.appliedMaxPrice)}`
                    });
                }

                return list;
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
                    if (this.appliedColors.length > 0) apiParams += `&colors=${this.appliedColors.join(',')}`;
                    if (this.appliedSizes.length > 0) apiParams += `&sizes=${this.appliedSizes.join(',')}`;
                    if (this.appliedCategories.length > 0) apiParams += `&categories=${this.appliedCategories.join(',')}`;
                    if (this.appliedStockStatus) apiParams += `&stock=${this.appliedStockStatus}`;
                    if (this.appliedMinPrice !== this.minLimit) apiParams += `&min_price=${this.appliedMinPrice}`;
                    if (this.appliedMaxPrice !== this.maxLimit) apiParams += `&max_price=${this.appliedMaxPrice}`;
                    if (this.sortBy) apiParams += `&sort_by=${this.sortBy}`;

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
                // Copy all draft selections to applied state!
                this.appliedColors = [...this.selectedColors];
                this.appliedSizes = [...this.selectedSizes];
                this.appliedCategories = [...this.selectedCategories];
                this.appliedStockStatus = this.stockStatus;
                this.appliedMinPrice = this.minPrice;
                this.appliedMaxPrice = this.maxPrice;

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
                // Clear draft selections
                this.selectedColors = [];
                this.selectedSizes = [];
                this.selectedCategories = [];
                this.stockStatus = null;
                this.minPrice = this.minLimit;
                this.maxPrice = this.maxLimit;

                // Clear applied selections
                this.appliedColors = [];
                this.appliedSizes = [];
                this.appliedCategories = [];
                this.appliedStockStatus = null;
                this.appliedMinPrice = this.minLimit;
                this.appliedMaxPrice = this.maxLimit;

                this.fetchProducts(1);
            },
            loadFiltersFromUrl() {
                const params = new URLSearchParams(window.location.search);
                if (params.has('colors')) {
                    this.selectedColors = params.get('colors').split(',').map(Number);
                    this.appliedColors = [...this.selectedColors];
                }
                if (params.has('sizes')) {
                    this.selectedSizes = params.get('sizes').split(',').map(Number);
                    this.appliedSizes = [...this.selectedSizes];
                }
                if (params.has('categories')) {
                    this.selectedCategories = params.get('categories').split(',').map(Number);
                    this.appliedCategories = [...this.selectedCategories];
                }
                if (params.has('stock')) {
                    this.stockStatus = params.get('stock');
                    this.appliedStockStatus = this.stockStatus;
                }
                if (params.has('min_price')) {
                    this.minPrice = parseInt(params.get('min_price'));
                    this.appliedMinPrice = this.minPrice;
                } else {
                    this.appliedMinPrice = this.minLimit;
                }
                if (params.has('max_price')) {
                    this.maxPrice = parseInt(params.get('max_price'));
                    this.appliedMaxPrice = this.maxPrice;
                } else {
                    this.appliedMaxPrice = this.maxLimit;
                }
                if (params.has('sort_by')) this.sortBy = params.get('sort_by');
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
            },
            toggleSortMenu() {
                this.sortMenuOpen = !this.sortMenuOpen;
            },
            selectSort(option) {
                this.sortBy = option;
                this.sortMenuOpen = false;
                this.fetchProducts(1);
            },
            getSortLabel() {
                switch(this.sortBy) {
                    case 'newest': return 'Newest Arrivals';
                    case 'price_asc': return 'Price: Low to High';
                    case 'price_desc': return 'Price: High to Low';
                    case 'best_selling':
                    default:
                        return 'Best Selling Products';
                }
            },
            removeFilter(filter) {
                if (filter.type === 'category') {
                    const indexApplied = this.appliedCategories.indexOf(filter.id);
                    if (indexApplied > -1) this.appliedCategories.splice(indexApplied, 1);
                    const indexSelected = this.selectedCategories.indexOf(filter.id);
                    if (indexSelected > -1) this.selectedCategories.splice(indexSelected, 1);
                } else if (filter.type === 'color') {
                    const indexApplied = this.appliedColors.indexOf(filter.id);
                    if (indexApplied > -1) this.appliedColors.splice(indexApplied, 1);
                    const indexSelected = this.selectedColors.indexOf(filter.id);
                    if (indexSelected > -1) this.selectedColors.splice(indexSelected, 1);
                } else if (filter.type === 'size') {
                    const indexApplied = this.appliedSizes.indexOf(filter.id);
                    if (indexApplied > -1) this.appliedSizes.splice(indexApplied, 1);
                    const indexSelected = this.selectedSizes.indexOf(filter.id);
                    if (indexSelected > -1) this.selectedSizes.splice(indexSelected, 1);
                } else if (filter.type === 'stock') {
                    this.appliedStockStatus = null;
                    this.stockStatus = null;
                } else if (filter.type === 'price') {
                    this.appliedMinPrice = this.minLimit;
                    this.appliedMaxPrice = this.maxLimit;
                    this.minPrice = this.minLimit;
                    this.maxPrice = this.maxLimit;
                }
                this.fetchProducts(1);
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

            // Close sort dropdown if clicked outside
            document.addEventListener('click', (e) => {
                const dropdown = document.getElementById('sort-dropdown');
                const menu = document.getElementById('sort-menu');
                if (menu && !menu.contains(e.target) && dropdown && !dropdown.contains(e.target)) {
                    this.sortMenuOpen = false;
                }
            });
        }
    });

    app.mount('#shop-app');
};

document.addEventListener('DOMContentLoaded', function () {
    initVue();

    // Sort menu dropdown is completely handled by Vue inside #shop-app

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
