<div id="cart-overlay" class="drawer-overlay"></div>
<div id="cart-drawer" class="cart-drawer px-[40px] py-8 flex flex-col h-full">
    <div class="flex justify-between items-center border-b border-stroke pb-6 mb-8">
        <h2 class="font-semibold text-[22px] font-poppins">My Cart <span class="text-grey font-medium text-[16px] ml-2">(03)</span></h2>
        <button id="close-cart-drawer" class="hover:rotate-90 transition-transform duration-300">
            <i class="fa-solid fa-xmark text-[24px]"></i>
        </button>
    </div>

    <!-- Cart Items -->
    <div class="flex-1 overflow-y-auto custom-scrollbar pr-4 -mr-4">
        <!-- Item 1 -->
        <div class="flex gap-5 mb-8 group">
            <div class="w-[100px] h-[100px] bg-[#F6F6F6] rounded-2xl overflow-hidden flex-shrink-0">
                <img src="{{ asset('assets/images/bag1.jpg') }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
            </div>
            <div class="flex flex-col justify-between py-1">
                <div>
                    <h3 class="font-poppins font-medium text-[16px] mb-1">Black Woven Bag</h3>
                    <p class="text-grey text-[14px]">Color: Black / Size: M</p>
                </div>
                <div class="flex justify-between items-end">
                    <div class="flex items-center gap-4 bg-[#F6F6F6] px-3 py-1 rounded-full">
                        <button class="text-[12px]"><i class="fa-solid fa-minus"></i></button>
                        <span class="font-poppins text-[14px]">01</span>
                        <button class="text-[12px]"><i class="fa-solid fa-plus"></i></button>
                    </div>
                    <p class="font-semibold font-poppins">$98.00</p>
                </div>
            </div>
        </div>

        <!-- Item 2 -->
        <div class="flex gap-5 mb-8 group">
            <div class="w-[100px] h-[100px] bg-[#F6F6F6] rounded-2xl overflow-hidden flex-shrink-0">
                <img src="{{ asset('assets/images/bag2.jpg') }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
            </div>
            <div class="flex flex-col justify-between py-1">
                <div>
                    <h3 class="font-poppins font-medium text-[16px] mb-1">Red Patent Bag</h3>
                    <p class="text-grey text-[14px]">Color: Red / Size: S</p>
                </div>
                <div class="flex justify-between items-end">
                    <div class="flex items-center gap-4 bg-[#F6F6F6] px-3 py-1 rounded-full">
                        <button class="text-[12px]"><i class="fa-solid fa-minus"></i></button>
                        <span class="font-poppins text-[14px]">01</span>
                        <button class="text-[12px]"><i class="fa-solid fa-plus"></i></button>
                    </div>
                    <p class="font-semibold font-poppins">$89.00</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="border-t border-stroke pt-8 mt-auto">
        <div class="flex justify-between items-center mb-6">
            <p class="font-poppins text-grey">Subtotal</p>
            <p class="font-semibold text-[20px] font-poppins">$187.00</p>
        </div>
        <div class="flex flex-col gap-3">
            <button class="w-full bg-black text-white py-4 rounded-full font-poppins font-semibold hover:bg-shade transition-colors">Checkout Now</button>
            <button class="w-full border border-stroke py-4 rounded-full font-poppins font-semibold hover:bg-[#F6F6F6] transition-colors">View Shopping Cart</button>
        </div>
    </div>
</div>
