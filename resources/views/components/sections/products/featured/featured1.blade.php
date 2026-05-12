<section id="featured1" class="pt-[50px] mb-[50px] container relative">
    <div class="featured-product flex">
        <x-products.images />
        <div class="product-information bg-white absolute w-1/2 top-1/2 -translate-y-1/2 right-0 p-[25px] rounded-xs">
            <x-products.reviews />
            <div class="product-details">
                <p class="text-[32px] font-semibold w-2/3 mt-[10px]">White Flower See Through Bridal Lingerie Set</p>
                <p class="leading-[30px] text-grey w-[550px] mt-[10px] mb-[10px]">Soft satin fabric feels gentle against smooth skin. Elegant lace design enhances charm and defines beauty. Stylish lingerie highlights curves with stunning appeal.</p>
                <div class="product-price flex items-center gap-[20px]">
                    <p class="old-price text-[25px] text-grey line-through">1,500 RS</p>
                    <p class="new-price text-[42px] text-secondary font-semibold">1,000 RS</p>
                </div>
            </div>
            <div class="product-countdown flex mt-[20px]">
                <x-blocks.countdown type="days" />
                <x-blocks.countdown type="hrs" />
                <x-blocks.countdown type="mins" />
                <x-blocks.countdown type="secs" />
            </div>
            <button class="h-[44px] w-[179px] bg-black text-white flex items-center justify-center gap-[10px] rounded-full mt-[20px]">
                    <img  src="{{ asset('assets/images/basket-white.png') }}" />
                    Add to Cart
            </button>
        </div>
    </div>
</section>


