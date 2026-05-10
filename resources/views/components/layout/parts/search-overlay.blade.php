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

        <!-- Search Results (Demo) -->
        <div id="search-results" class="mt-[60px] hidden opacity-0 transition-all duration-300 transform translate-y-4 max-h-[60vh] overflow-y-auto scrollbar-hide pr-4">
            <h3 class="text-white/40 text-[14px] uppercase tracking-widest mb-6 font-poppins">Products Found</h3>
            <div class="grid grid-cols-4 gap-8">
                <!-- Demo Product 1 -->
                <div class="group cursor-pointer">
                    <div class="aspect-square bg-white/5 rounded-2xl overflow-hidden mb-4">
                        <img src="{{ asset('assets/images/bag1.jpg') }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <h4 class="text-white font-poppins text-[16px]">Black Woven Bag</h4>
                    <p class="text-white/60 font-poppins text-[14px]">$98.00</p>
                </div>
                <!-- Demo Product 2 -->
                <div class="group cursor-pointer">
                    <div class="aspect-square bg-white/5 rounded-2xl overflow-hidden mb-4">
                        <img src="{{ asset('assets/images/bag2.jpg') }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <h4 class="text-white font-poppins text-[16px]">Red Patent Bag</h4>
                    <p class="text-white/60 font-poppins text-[14px]">$89.00</p>
                </div>
                <!-- Demo Product 3 -->
                <div class="group cursor-pointer">
                    <div class="aspect-square bg-white/5 rounded-2xl overflow-hidden mb-4">
                        <img src="{{ asset('assets/images/bag3.jpg') }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <h4 class="text-white font-poppins text-[16px]">Night Weave Handbag</h4>
                    <p class="text-white/60 font-poppins text-[14px]">$120.00</p>
                </div>
                <!-- Demo Product 4 -->
                <div class="group cursor-pointer">
                    <div class="aspect-square bg-white/5 rounded-2xl overflow-hidden mb-4">
                        <img src="{{ asset('assets/images/bag4.jpg') }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <h4 class="text-white font-poppins text-[16px]">Crimson Glaze Shoulder Bag</h4>
                    <p class="text-white/60 font-poppins text-[14px]">$75.00</p>
                </div>
                <!-- Duplicate for Scroll Demo -->
                <div class="group cursor-pointer">
                    <div class="aspect-square bg-white/5 rounded-2xl overflow-hidden mb-4">
                        <img src="{{ asset('assets/images/bag1.jpg') }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <h4 class="text-white font-poppins text-[16px]">Black Woven Bag</h4>
                    <p class="text-white/60 font-poppins text-[14px]">$98.00</p>
                </div>
                <div class="group cursor-pointer">
                    <div class="aspect-square bg-white/5 rounded-2xl overflow-hidden mb-4">
                        <img src="{{ asset('assets/images/bag2.jpg') }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <h4 class="text-white font-poppins text-[16px]">Red Patent Bag</h4>
                    <p class="text-white/60 font-poppins text-[14px]">$89.00</p>
                </div>
                <div class="group cursor-pointer">
                    <div class="aspect-square bg-white/5 rounded-2xl overflow-hidden mb-4">
                        <img src="{{ asset('assets/images/bag3.jpg') }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <h4 class="text-white font-poppins text-[16px]">Night Weave Handbag</h4>
                    <p class="text-white/60 font-poppins text-[14px]">$120.00</p>
                </div>
                <div class="group cursor-pointer">
                    <div class="aspect-square bg-white/5 rounded-2xl overflow-hidden mb-4">
                        <img src="{{ asset('assets/images/bag4.jpg') }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <h4 class="text-white font-poppins text-[16px]">Crimson Glaze Shoulder Bag</h4>
                    <p class="text-white/60 font-poppins text-[14px]">$75.00</p>
                </div>
            </div>
            
            <div class="flex justify-center mt-12 pb-10">
                <button class="bg-white text-black px-10 py-3 rounded-full font-poppins font-medium hover:bg-black hover:text-white border border-white transition-all duration-300">
                    Load More Results
                </button>
            </div>
        </div>
    </div>
</div>
