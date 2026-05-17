<x-layout.app>
    <x-breadcrumb />

    <section id="shop-app">
        <!-- Active Filters Badges Section -->
        <div v-if="activeFilters.length > 0" class="container mt-6 flex flex-wrap gap-3 items-center select-none" v-cloak>
            <span class="text-grey font-poppins text-[14px]">Active Filters:</span>
            <div v-for="filter in activeFilters" :key="filter.type + '-' + filter.id" 
                 class="flex items-center gap-2 bg-[#F6F6F6] text-black border border-[#E6E6E6] px-4 py-1.5 rounded-full font-poppins text-[13px] hover:border-black transition-all">
                <span>@{{ filter.label }}</span>
                <button @click="removeFilter(filter)" class="text-grey hover:text-black focus:outline-none ml-1 cursor-pointer">
                    <i class="fa-solid fa-xmark text-[11px] font-bold"></i>
                </button>
            </div>
            <button @click="resetFilters" class="text-[#8B3118] hover:text-black font-poppins text-[13px] ml-2 font-medium cursor-pointer transition-colors">Clear All</button>
        </div>

        <div class="mt-10 action-btns container mb-[80px] flex justify-between relative z-10" v-cloak>
            <button id="filter-btn" class="bg-black text-white px-6 py-2 flex gap-4 items-center rounded-full cursor-pointer">
                <i class="fa-solid fa-sliders"></i>
                Filters
            </button>
            <div class="relative w-1/3">
                <div id="sort-dropdown" class="cursor-pointer flex justify-between items-center px-5 py-3 rounded-full w-full select-none" style="border: 1px solid #E6E6E6; background-color: #F6F6F6;" @click.stop="toggleSortMenu">
                    <p class="font-[14px]" style="color: #555555;">@{{ getSortLabel() }}</p>
                    <p><i class="fa-solid fa-angle-down font-[14px]" style="color: #555555;"></i></p>
                </div>
                <div id="sort-menu" class="sort-menu" :class="{ 'active': sortMenuOpen }">
                    <div class="sort-option" :class="{ 'active': sortBy === 'best_selling' }" @click="selectSort('best_selling')">Best Selling Products</div>
                    <div class="sort-option" :class="{ 'active': sortBy === 'newest' }" @click="selectSort('newest')">Newest Arrivals</div>
                    <div class="sort-option" :class="{ 'active': sortBy === 'price_asc' }" @click="selectSort('price_asc')">Price: Low to High</div>
                    <div class="sort-option" :class="{ 'active': sortBy === 'price_desc' }" @click="selectSort('price_desc')">Price: High to Low</div>
                </div>
            </div>
        </div>

        <transition name="fade" mode="out-in">
            <div v-if="loading" key="loader" class="w-full">
                <div class="products container grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-[36px] min-h-[400px]">
                    <x-skeletons.card />
                    <x-skeletons.card />
                    <x-skeletons.card />
                    <x-skeletons.card />
                    <x-skeletons.card />
                    <x-skeletons.card />
                    <x-skeletons.card />
                    <x-skeletons.card />
                </div>
            </div>
            
            <div v-else key="products" v-cloak class="mb-10 products-wrapper">
                <div v-if="products.length > 0" class="products container grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-[36px] min-h-[400px]">
                    <div v-for="product in products" :key="product.id">
                        <x-blocks.card 
                            name="@{{ product.name }}" 
                            price="@{{ formatPrice(product.price) }}" 
                            type="@{{ product.short_description || 'Premium Collection' }}" 
                            image="product.image || '/assets/images/product.png'" 
                            slug="product.slug"
                        />
                    </div>
                </div>

                <!-- Empty State Message -->
                <div v-else class="container py-20 flex flex-col items-center justify-center text-center">
                    <div class="w-[100px] h-[100px] bg-[#F6F6F6] rounded-full flex items-center justify-center mb-6">
                        <i class="fa-solid fa-box-open text-[40px] text-gray-300"></i>
                    </div>
                    <h3 class="font-poppins text-[24px] font-semibold mb-2 text-black">No Products Found</h3>
                    <p class="font-poppins text-[16px] text-grey max-w-[400px]">
                        We couldn't find any products matching your current filters. Try adjusting your search or filter criteria.
                    </p>
                </div>

                <!-- Vue Pagination -->
                <div v-if="pagination.last_page > 1" class="pagination container flex justify-center items-center gap-[15px] my-[80px]">
                    <template v-for="link in pagination.links" :key="link.label">
                        <div v-if="link.label.includes('Previous')" 
                             @click="changePage(link.url)"
                             :class="['page-item w-[60px] h-[60px] rounded-full flex items-center justify-center cursor-pointer transition-all', 
                                      link.url ? 'bg-black text-white hover:bg-shade' : 'bg-gray-200 text-gray-400 cursor-not-allowed']">
                            <i class="fa-solid fa-angle-left"></i>
                        </div>
                        
                        <div v-else-if="link.label.includes('Next')"
                             @click="changePage(link.url)"
                             :class="['page-item w-[60px] h-[60px] rounded-full flex items-center justify-center cursor-pointer transition-all', 
                                      link.url ? 'bg-black text-white hover:bg-shade' : 'bg-gray-200 text-gray-400 cursor-not-allowed']">
                            <img src="{{ asset('assets/images/white-arrow.png') }}" alt="Next">
                        </div>

                        <div v-else-if="link.label === '...'" 
                             class="page-item w-[60px] h-[60px] flex items-center justify-center text-gray-400">
                            ...
                        </div>

                        <div v-else
                             @click="changePage(link.url)"
                             :class="['page-item w-[60px] h-[60px] rounded-full flex items-center justify-center cursor-pointer font-poppins text-[18px] transition-all', 
                                      link.active ? 'bg-black text-white' : 'bg-[#F6F6F6] text-black hover:bg-black hover:text-white']">
                            @{{ link.label }}
                        </div>
                    </template>
                </div>
            </div>
        </transition>

        <!-- Filter Drawer (Dynamic with Vue) -->
        <div id="filter-overlay" class="drawer-overlay"></div>
        <div id="filter-drawer" class="filter-drawer px-[40px] py-6 custom-scrollbar">
            <x-shop.filter-section title="Filters">
                <x-slot name="header_action">
                    <button id="close-filter-drawer"><i class="fa-solid fa-xmark font-[14pt]"></i></button>
                </x-slot>
            </x-shop.filter-section>

            <x-shop.filter-section title="Categories">
                <ul id="categories-list" class="h-[300px] overflow-y-scroll custom-scrollbar flex flex-col gap-y-[10px]">
                    <li v-for="category in categories" :key="category.id" 
                        @click="toggleCategory(category.id)"
                        class="category-item font-[14pt] font-poppins cursor-pointer transition-colors"
                        :class="isCategorySelected(category.id) ? 'text-black font-semibold' : 'text-grey hover:text-black'">
                        <span class="mr-2">@{{ category.name }}</span> (@{{ category.products_count }})
                    </li>
                </ul>
            </x-shop.filter-section>

            <x-shop.filter-section title="filter by color">
                <ul id="color-list" class="flex flex-wrap gap-[10px] gap-y-[20px]">
                    <li v-for="color in colors" :key="color.id" 
                        @click="toggleColor(color.id)"
                        class="color-filter-item cursor-pointer flex items-center justify-center border border-gray-100 transition-transform hover:scale-110" 
                        :style="{ backgroundColor: color.code, width: '30px', height: '30px', borderRadius: '50%' }"
                        :title="color.name">
                        <div :class="['selected-color bg-white h-[12px] w-[12px] rounded-full transition-all', isColorSelected(color.id) ? 'scale-100 opacity-100' : 'scale-0 opacity-0']"></div>
                    </li>
                </ul>
            </x-shop.filter-section>

            <x-shop.filter-section title="Size">
                <ul id="size-list" class="flex flex-wrap gap-[10px]">
                    <li v-for="size in sizes" :key="size.id"
                        @click="toggleSize(size.id)"
                        :class="['size-filter-item cursor-pointer flex items-center justify-center rounded-[8px] min-w-[50px] h-[50px] px-4 font-poppins text-[15px] transition-all hover:bg-black hover:text-white', 
                                  isSizeSelected(size.id) ? 'bg-black text-white' : 'bg-[#F6F6F6] text-black']">
                        @{{ size.name.toUpperCase() }}
                    </li>
                </ul>
            </x-shop.filter-section>

            <x-shop.filter-section title="Availability">
                <!-- In Stock -->
                <div class="flex items-center gap-x-4 mb-4 cursor-pointer" @click="toggleStock('in_stock')">
                    <div :class="['w-[28px] h-[28px] rounded-[6px] flex items-center justify-center transition-all', stockStatus === 'in_stock' ? 'bg-black text-white' : 'bg-[#F6F6F6] text-transparent']">
                        <i class="fa-solid fa-check text-[16px]"></i>
                    </div>
                    <span :class="['font-poppins text-[16px] transition-colors', stockStatus === 'in_stock' ? 'text-black' : 'text-[#555]']">In Stock</span>
                </div>
                <!-- Out of Stock -->
                <div class="flex items-center gap-x-4 mb-4 cursor-pointer" @click="toggleStock('out_of_stock')">
                    <div :class="['w-[28px] h-[28px] rounded-[6px] flex items-center justify-center transition-all', stockStatus === 'out_of_stock' ? 'bg-black text-white' : 'bg-[#F6F6F6] text-transparent']">
                        <i class="fa-solid fa-check text-[16px]"></i>
                    </div>
                    <span :class="['font-poppins text-[16px] transition-colors', stockStatus === 'out_of_stock' ? 'text-black' : 'text-[#555]']">Out of Stock</span>
                </div>
            </x-shop.filter-section>

            <x-shop.filter-section title="Price">
                <div class="range-slider-container">
                    <div class="range-slider">
                        <div class="progress" :style="progressStyle"></div>
                        <input type="range" :min="minLimit" :max="maxLimit" :value="minPrice" @input="handleMinPrice" step="10">
                        <input type="range" :min="minLimit" :max="maxLimit" :value="maxPrice" @input="handleMaxPrice" step="10">
                    </div>
                    <div class="flex justify-between items-center mt-4">
                        <div class="font-poppins text-[16px] text-black">
                            <span class="text-grey mr-1">Min:</span> PKR @{{ formatPrice(minPrice) }}
                        </div>
                        <div class="font-poppins text-[16px] text-black">
                            <span class="text-grey mr-1">Max:</span> PKR @{{ formatPrice(maxPrice) }}
                        </div>
                    </div>
                </div>
                <div class="items-center flex justify-end gap-x-3 mt-6">
                    <button @click="resetFilters" class="text-grey font-poppins text-[16px] hover:text-black transition-colors px-4">Reset</button>
                    <button @click="applyFilters" class="bg-black text-white h-[50px] px-8 rounded-full font-poppins text-[16px] cursor-pointer hover:bg-shade transition-colors">Go</button>
                </div>
            </x-shop.filter-section>
        </div>

        @push('scripts')
            @vite('resources/js/shop.js')
        @endpush
    </section>
</x-layout.app>
