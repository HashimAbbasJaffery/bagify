<div id="cart-overlay" class="drawer-overlay"></div>
<div id="cart-drawer" class="cart-drawer px-[40px] py-8 flex flex-col h-full">
    <div class="flex justify-between items-center border-b border-stroke pb-6 mb-8">
        <h2 class="font-semibold text-[22px] font-poppins">My Cart <span id="cart-count-drawer-badge" class="text-grey font-medium text-[16px] ml-2">(0)</span></h2>
        <button id="close-cart-drawer" class="hover:rotate-90 transition-transform duration-300">
            <i class="fa-solid fa-xmark text-[24px]"></i>
        </button>
    </div>

    <!-- Cart Items Container (Populated Dynamically) -->
    <div id="cart-items-container" class="flex-1 overflow-y-auto custom-scrollbar pr-4 -mr-4">
        <!-- Dynamic items will be injected here by app.js -->
        <div id="cart-empty-message" class="flex flex-col items-center justify-center h-full text-center py-10 hidden">
            <i class="fa-solid fa-basket-shopping text-grey text-[48px] mb-4"></i>
            <p class="text-grey font-poppins text-[16px]">Your cart is empty.</p>
        </div>
    </div>

    <!-- Footer -->
    <div class="border-t border-stroke pt-8 mt-auto">
        <div class="flex justify-between items-center mb-6">
            <p class="font-poppins text-grey">Subtotal</p>
            <p id="cart-subtotal-value" class="font-semibold text-[20px] font-poppins">PKR 0.00</p>
        </div>
        <div class="flex flex-col gap-3 text-center">
            <a href="{{ route('home.checkout') }}" class="w-full bg-black text-white py-4 rounded-full font-poppins font-semibold hover:bg-shade transition-colors block">Checkout Now</a>
            <a href="{{ route('home.cart') }}" class="w-full border border-stroke py-4 rounded-full font-poppins font-semibold hover:bg-[#F6F6F6] transition-colors block">View Shopping Cart</a>
        </div>
    </div>
</div>
