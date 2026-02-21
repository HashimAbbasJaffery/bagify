@push("styles")
<style>
    .arrow {
        right: -6px;
    }
    /* Initially hide the tooltip */
.eye-btn .tooltip,
.wishlist-btn .tooltip {
    opacity: 0;
    pointer-events: none; /* prevents accidental hover on tooltip itself */
    transition: opacity 0.3s ease; /* smooth fade-in */
}

/* Show tooltip when the button is hovered */
.eye-btn:hover .tooltip,
.wishlist-btn:hover .tooltip {
    opacity: 1;
    pointer-events: auto; /* optional: allows interacting with tooltip */
}

</style>
@endpush
<div class="product w-[303px] text-left cursor-pointer">
    <div class="product-image relative group">
        <img src="{{ asset('assets/images/product.png') }}" class="rounded-xs mb-[20px]" />

        <button
            class="wishlist-btn cursor-pointer absolute top-5 right-5 w-[44px] h-[44px] 
            bg-white text-[14px] 
            rounded-full flex items-center justify-center 
            border border-black
            transform translate-x-8 opacity-0
            transition-all duration-300
            hover:bg-black
            hover:text-white
            group-hover:translate-x-0 group-hover:opacity-100
            group-hover:delay-0">
            <i class="fa-regular fa-heart text-xl"></i>
            <div class="tooltip bg-black text-[12px] rounded-xxs text-white right-15 w-[86px] h-[30px] flex justify-center items-center absolute">
                Wishlist
                <div class="arrow bg-black absolute rounded-tr-xxs rotate-45 w-[12px] h-[12px]">&nbsp;</div>
            </div>
        
        </button>

        <button class="eye-btn cursor-pointer absolute top-20 right-5 w-[44px] h-[44px] 
            bg-white text-[14px] 
            rounded-full flex items-center justify-center 
            border border-black
            transform translate-x-8 opacity-0
            transition-all duration-300
            hover:bg-black
            hover:text-white
            group-hover:translate-x-0 group-hover:opacity-100
            group-hover:delay-150">
            <i class="fa-solid fa-eye text-xl"></i>

            <div class="tooltip bg-black text-[12px] rounded-xxs text-white right-15 w-[86px] h-[30px] flex justify-center items-center absolute">
                Quick View
                <div class="arrow bg-black absolute rounded-tr-xxs rotate-45 w-[12px] h-[12px]">&nbsp;</div>
            </div>
        </button>

        <button
            class="cursor-pointer absolute bottom-0 w-[180px] mb-[15px] left-1/2 -translate-x-1/2 
               bg-white text-[14px] px-[30px] py-[10px] 
               rounded-full flex items-center gap-[10px] border border-black
               transform translate-y-8 opacity-0
               transition-all duration-300
               group-hover:translate-y-0 group-hover:opacity-100">
            <img src="{{ asset('assets/images/basket.png') }}" />
            Add To Cart
        </button>
    </div>
    <div class="product-body">
        <p class="product-title font-semibold mb-[5px]">
            Whispers of the Emerald Bloom
        </p>
        <p class="product-type text-[12px] text-grey mb-[5px]">
            Brown Leather Handbag
        </p>
        <p class="product-price font-semibold">
            <span class="currency">PKR </span>
            1,000
        </p>
    </div>
</div>
