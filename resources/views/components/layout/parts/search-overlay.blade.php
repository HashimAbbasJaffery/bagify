<div id="search-overlay" class="search-overlay">
    <div class="search-content container">
        <div class="flex justify-between items-center mb-[50px]">
            <h2 class="text-white text-[40px] font-semibold font-poppins">What are you looking for?</h2>
            <button id="close-search" class="text-white hover:rotate-90 transition-transform duration-300">
                <i class="fa-solid fa-xmark text-[35px]"></i>
            </button>
        </div>
        <div class="relative group">
            <input type="text" id="search-input" placeholder="Type to search..." 
                class="w-full bg-transparent border-b-2 border-white/20 py-6 text-white text-[45px] font-poppins outline-none focus:border-white transition-colors placeholder:text-white/20">
            <button class="absolute right-0 top-1/2 -translate-y-1/2 hover:scale-110 transition-transform">
                <img src="{{ asset('assets/images/search.png') }}" class="invert w-[40px] h-[40px]" />
            </button>
        </div>
        <div class="mt-8">
            <p class="text-white/50 font-poppins text-[16px]">Popular: Handbags, Backpacks, New Arrivals</p>
        </div>

        <!-- Search Loading -->
        <div id="search-loading" class="mt-[60px] hidden flex flex-col items-center">
            <div class="w-12 h-12 border-4 border-white/20 border-t-white rounded-full animate-spin"></div>
            <p class="mt-4 text-white/50 font-poppins tracking-widest uppercase text-[12px]">Searching for your style...</p>
        </div>

        <!-- Search Results -->
        <div id="search-results" class="mt-[60px] hidden opacity-0 transition-all duration-300 transform translate-y-4 max-h-[60vh] overflow-y-auto scrollbar-hide pr-4">
            <h3 id="search-results-title" class="text-white/40 text-[14px] uppercase tracking-widest mb-6 font-poppins">Products Found</h3>
            <div id="search-results-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                <!-- Dynamic results will be injected here by app.js -->
            </div>
        </div>
    </div>
</div>
