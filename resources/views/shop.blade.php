<x-layout.app>
    <x-breadcrumb />

    <div class="container my-[70px] flex gap-10">
        <x-circle-category-card />
        <x-circle-category-card />
        <x-circle-category-card />
        <x-circle-category-card />
        <x-circle-category-card />
        <x-circle-category-card />
    </div>

    <section>
        <div class="action-btns container mb-[80px] flex justify-between relative z-10">
            <button id="filter-btn" class="bg-black text-white px-6 py-2 flex gap-4 items-center rounded-full cursor-pointer">
                <i class="fa-solid fa-sliders"></i>
                Filters
            </button>
            <div class="relative w-1/3">
                <div id="sort-dropdown" class="cursor-pointer flex justify-between items-center px-5 py-3 rounded-full w-full" style="border: 1px solid #E6E6E6; background-color: #F6F6F6;">
                    <p class="font-[14px]" style="color: #555555;">Best Selling Products</p>
                    <p><i class="fa-solid fa-angle-down font-[14px]" style="color: #555555;"></i></p>
                </div>
                <div id="sort-menu" class="sort-menu">
                    <div class="sort-option active">Best Selling Products</div>
                    <div class="sort-option">Newest Arrivals</div>
                    <div class="sort-option">Price: Low to High</div>
                    <div class="sort-option">Price: High to Low</div>
                </div>
            </div>
        </div>
        <div class="products container flex flex-wrap gap-[36px]">
            <x-blocks.card />
            <x-blocks.card />
            <x-blocks.card />
            <x-blocks.card />
            <x-blocks.card />
            <x-blocks.card />
            <x-blocks.card />
        </div>
    </section>

    <x-shop.filter-drawer />

    @push('scripts')
        @vite('resources/js/shop.js')
    @endpush
</x-layout.app>
