<section id="featured1" class="pt-[50px] mb-[50px] container relative">
    <div class="featured-product flex">
        <div class="side-images w-[150px] flex flex-col justify-between">
            <div class="side-image">
                <img src="{{ asset('assets/images/side-image.png') }}" class="rounded-xs" />
            </div>

            <div class="side-image">
                <img src="{{ asset('assets/images/side-image.png') }}" class="rounded-xs" />
            </div>

            <div class="side-image">
                <img src="{{ asset('assets/images/side-image.png') }}" class="rounded-xs" />
            </div>

            <div class="side-image">
                <img src="{{ asset('assets/images/side-image.png') }}" class="rounded-xs" />
            </div>
        </div>
        <div class="main-image px-[30px]">
            <img src="{{ asset('assets/images/main-image.png') }}" class="rounded-xs">
        </div>
        <div class="product-information bg-white absolute w-1/2 top-1/2 -translate-y-1/2 right-0 p-[25px] rounded-xs">
            <div class="product-reviews flex items-center">
                <div class="review-stars text-royal flex gap-[5px]">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                </div>
                <p class="text-grey mx-[5px] mt-[3px]">45 Reviews</p>
            </div>
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


