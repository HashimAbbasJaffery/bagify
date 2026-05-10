<div id="wishlist-overlay" class="drawer-overlay"></div>
<div id="wishlist-drawer" class="wishlist-drawer px-[40px] py-8 flex flex-col h-full">
    <div class="flex justify-between items-center border-b border-stroke pb-6 mb-8">
        <h2 class="font-semibold text-[22px] font-poppins">My Wishlist <span class="text-grey font-medium text-[16px] ml-2">(02)</span></h2>
        <button id="close-wishlist-drawer" class="hover:rotate-90 transition-transform duration-300">
            <i class="fa-solid fa-xmark text-[24px]"></i>
        </button>
    </div>

    <!-- Wishlist Items -->
    <div class="flex-1 overflow-y-auto custom-scrollbar pr-4 -mr-4">
        <!-- Item 1 -->
        <div class="flex gap-5 mb-8 group relative">
            <div class="w-[100px] h-[100px] bg-[#F6F6F6] rounded-2xl overflow-hidden flex-shrink-0">
                <img src="{{ asset('assets/images/bag3.jpg') }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
            </div>
            <div class="flex flex-col justify-between py-1">
                <div>
                    <h3 class="font-poppins font-medium text-[16px] mb-1">Night Weave Handbag</h3>
                    <p class="text-grey text-[14px]">Textured Black Handbag</p>
                </div>
                <div class="flex justify-between items-center">
                    <p class="font-semibold font-poppins text-black">$120.00</p>
                    <button class="text-grey hover:text-black transition-colors text-[14px] underline underline-offset-4">Add to Cart</button>
                </div>
            </div>
            <button class="absolute -top-1 -right-1 w-6 h-6 bg-white border border-stroke rounded-full flex items-center justify-center shadow-sm opacity-0 group-hover:opacity-100 transition-opacity">
                <i class="fa-solid fa-xmark text-[10px]"></i>
            </button>
        </div>

        <!-- Item 2 -->
        <div class="flex gap-5 mb-8 group relative">
            <div class="w-[100px] h-[100px] bg-[#F6F6F6] rounded-2xl overflow-hidden flex-shrink-0">
                <img src="{{ asset('assets/images/bag4.jpg') }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
            </div>
            <div class="flex flex-col justify-between py-1">
                <div>
                    <h3 class="font-poppins font-medium text-[16px] mb-1">Crimson Glaze Shoulder Bag</h3>
                    <p class="text-grey text-[14px]">Glossy Red Mini Bag</p>
                </div>
                <div class="flex justify-between items-center">
                    <p class="font-semibold font-poppins text-black">$75.00</p>
                    <button class="text-grey hover:text-black transition-colors text-[14px] underline underline-offset-4">Add to Cart</button>
                </div>
            </div>
            <button class="absolute -top-1 -right-1 w-6 h-6 bg-white border border-stroke rounded-full flex items-center justify-center shadow-sm opacity-0 group-hover:opacity-100 transition-opacity">
                <i class="fa-solid fa-xmark text-[10px]"></i>
            </button>
        </div>
    </div>

    <!-- Footer -->
    <div class="border-t border-stroke pt-8 mt-auto">
        <button class="w-full bg-black text-white py-4 rounded-full font-poppins font-semibold hover:bg-shade transition-colors">Add All to Cart</button>
        <button class="w-full mt-3 border border-stroke py-4 rounded-full font-poppins font-semibold hover:bg-[#F6F6F6] transition-colors">View All Wishlist</button>
    </div>
</div>
