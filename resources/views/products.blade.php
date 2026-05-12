<x-layout.app>
    <div class="container mx-auto py-[50px]">
        <div class="flex gap-[20px]">
            <div class="side-images w-[150px] flex flex-col gap-[20px]">
                <div class="side-image aspect-square">
                    <img src="{{ asset('assets/images/side-image.png') }}" class="rounded-xs w-full h-full object-cover cursor-pointer hover:border-primary border border-transparent transition-all" />
                </div>
                <div class="side-image aspect-square">
                    <img src="{{ asset('assets/images/side-image.png') }}" class="rounded-xs w-full h-full object-cover cursor-pointer hover:border-primary border border-transparent transition-all" />
                </div>
                <div class="side-image aspect-square">
                    <img src="{{ asset('assets/images/side-image.png') }}" class="rounded-xs w-full h-full object-cover cursor-pointer hover:border-primary border border-transparent transition-all" />
                </div>
                <div class="side-image aspect-square">
                    <img src="{{ asset('assets/images/side-image.png') }}" class="rounded-xs w-full h-full object-cover cursor-pointer hover:border-primary border border-transparent transition-all" />
                </div>
            </div>
            <div class="main-image w-[680px]">
                <div class="aspect-[688/690] w-full bg-pinkish rounded-xs overflow-hidden border border-stroke">
                    <img src="{{ asset('assets/images/main-image.png') }}" class="w-full h-full object-cover" />
                </div>
            </div>
            <div class="product-data flex-1 pl-[40px] flex flex-col justify-between">
                <div class="product-data-header flex gap-[15px] justify-between">
                    <div class="stock text-grey font-[14px] capitalize bg-pinkish border border-stroke px-[15px] py-[10px] font-poppins rounded-full">in stock</div>
                    <div class="sku text-grey font-[14px] capitalize bg-pinkish border border-stroke px-[15px] py-[10px] font-poppins rounded-full"><span class="font-medium uppercase">sku:</span> 00456</div>
                </div>
                <div class="product-reviews mt-[10px]">
                    <x-products.reviews />
                </div>
                <div class="product-info mt-2">
                    <h1 class="font-semibold text-[32px] font-poppins text-primary">Sleek Midnight Crossbody</h1>
                    <p class="text-grey text-[14px] font-poppins mt-2 leading-relaxed">
                        There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form,
                    </p>
                    <div class="product-price flex items-center gap-4 mt-4">
                        <span class="text-grey text-[16px] line-through font-poppins">$323.00</span>
                        <span class="text-primary text-[25px] font-bold font-poppins">$122.85</span>
                    </div>
                </div>

                <div class="product-selection mt-4 border-y border-stroke py-4 flex">
                    <div class="size-selection w-1/2 pr-8">
                        <h3 class="text-[20px] font-bold font-poppins text-primary mb-6">Size</h3>
                        <div class="flex gap-3">
                            @foreach(['S', 'M', 'L', 'XL', 'XXL'] as $size)
                                <div class="w-12 h-12 flex items-center justify-center bg-pinkish text-primary font-poppins font-medium rounded-xs cursor-pointer hover:bg-stroke transition-all">
                                    {{ $size }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="color-selection w-1/2 pl-8 border-l border-stroke">
                        <h3 class="text-[20px] font-bold font-poppins text-primary mb-6">Color</h3>
                        <div class="flex gap-4">
                            <div class="w-10 h-10 rounded-full bg-[#3B3B5E] cursor-pointer ring-offset-2 hover:ring-2 ring-primary transition-all"></div>
                            <div class="w-10 h-10 rounded-full bg-[#E54242] cursor-pointer ring-offset-2 ring-2 ring-primary flex items-center justify-center transition-all">
                                <div class="w-2 h-2 rounded-full bg-white"></div>
                            </div>
                            <div class="w-10 h-10 rounded-full bg-[#34B374] cursor-pointer ring-offset-2 hover:ring-2 ring-primary transition-all"></div>
                            <div class="w-10 h-10 rounded-full bg-[#B26E43] cursor-pointer ring-offset-2 hover:ring-2 ring-primary transition-all"></div>
                            <div class="w-10 h-10 rounded-full bg-[#52C4EE] cursor-pointer ring-offset-2 hover:ring-2 ring-primary transition-all"></div>
                        </div>
                    </div>
                </div>

                <div class="product-actions mt-4 flex items-center gap-6">
                    <div class="quantity-control flex items-center gap-6">
                        <span class="text-[16px] font-poppins text-grey mt-2">Quantity:</span>
                        <div class="flex items-center gap-5">
                            <button class="group w-[44px] h-[44px] rounded-full border-1 border-primary flex items-center justify-center hover:bg-primary transition-all">
                                <img src="{{ asset('assets/images/black-arrow.png') }}" class="w-4 group-hover:hidden" alt="decrease">
                                <img src="{{ asset('assets/images/white-arrow.png') }}" class="rotate-180 w-4 hidden group-hover:block" alt="decrease">
                            </button>
                            <div class="w-[44px] h-[44px] rounded-full bg-pinkish flex items-center justify-center text-[14px] font-poppins text-primary border-1 border-primary">
                                5
                            </div>
                             <button class="group w-[44px] h-[44px] rounded-full border-1 border-primary flex items-center justify-center hover:bg-primary transition-all">
                                <img src="{{ asset('assets/images/black-arrow.png') }}" class="w-4 rotate-180 group-hover:hidden" alt="increase">
                                <img src="{{ asset('assets/images/white-arrow.png') }}" class="w-4 hidden group-hover:block" alt="increase">
                            </button>
                        </div>
                    </div>

                    <button class="group h-[44px] flex-1 bg-white border-1 border-primary rounded-full flex items-center justify-center gap-5 px-6 hover:bg-primary transition-all">
                        <img src="{{ asset('assets/images/basket.png') }}" class="w-7 group-hover:hidden" alt="basket">
                        <img src="{{ asset('assets/images/basket-white.png') }}" alt="basket" class="w-7 hidden group-hover:block transition-all">
                        <span class="text-[14px] font-poppins group-hover:text-white transition-all">Add To Cart</span>
                    </button>

                    <button class="w-[44px] h-[44px] rounded-full border-1 border-primary flex items-center justify-center hover:bg-primary group transition-all">
                        <i class="fa-regular fa-heart text-[18px] group-hover:text-white transition-all"></i>
                    </button>

                    <button class="w-[44px] h-[44px] rounded-full border-1 border-primary flex items-center justify-center hover:bg-primary group transition-all">
                        <i class="fa-regular fa-eye text-[18px] text-primary group-hover:text-white transition-all"></i>
                    </button>
                </div>

                <div class="product-buy mt-6 flex items-center gap-4">
                    <button class="w-[44px] h-[44px] rounded-full border-1 border-primary flex items-center justify-center hover:bg-primary group transition-all">
                        <i class="fa-solid fa-share text-[18px] text-primary group-hover:text-white transition-all"></i>
                    </button>
                    <button class="flex-1 h-[44px] bg-[#8B3118] text-white rounded-full font-poppins text-[14px] font-bold hover:bg-opacity-90 transition-all">
                        Buy It Now
                    </button>
                </div>
            </div>
        </div>
        <div class="tabbed-sections mt-6 flex flex-col gap-[25px]">
            <div class="cursor-pointer flex justify-between items-center tab bg-pinkish border border-stroke px-5 py-4 rounded-sm" id="product-description">
                <p class="font-[18px] text-medium font-poppins">Description</p>
                <i class="fa-solid fa-plus text-grey"></i>
            </div>
            <div class="description-tab-content">
                <p class="font-poppins font-[16px] text-grey leading-[36px]">Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda placeat, qui, quidem illo iure culpa impedit enim explicabo dolorem voluptatem officia beatae perferendis aliquam est ipsum quisquam inventore labore nisi dolorum ullam et sequi quas doloribus nihil? Necessitatibus amet doloribus odit deserunt aliquam iusto quia, esse suscipit harum exercitationem, inventore voluptatum voluptatibus consequatur ullam quos corporis quibusdam repellendus temporibus pariatur fuga aspernatur! Beatae, sunt dolorem rem praesentium ducimus, non natus ullam deserunt alias molestias voluptatum distinctio ea porro consequuntur explicabo animi. Accusamus, ducimus inventore vitae repudiandae minima omnis quod, aperiam odio, suscipit numquam eveniet eos porro. Reiciendis neque accusamus cum!</p>
                <p class="font-poppins font-[16px] text-grey leading-[36px]">Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda placeat, qui, quidem illo iure culpa impedit enim explicabo dolorem voluptatem officia beatae perferendis aliquam est ipsum quisquam inventore labore nisi dolorum ullam et sequi quas doloribus nihil? Necessitatibus amet doloribus odit deserunt aliquam iusto quia, esse suscipit harum exercitationem, inventore voluptatum voluptatibus consequatur ullam quos corporis quibusdam repellendus temporibus pariatur fuga aspernatur! Beatae, sunt dolorem rem praesentium ducimus, non natus ullam deserunt alias molestias voluptatum distinctio ea porro consequuntur explicabo animi. Accusamus, ducimus inventore vitae repudiandae minima omnis quod, aperiam odio, suscipit numquam eveniet eos porro. Reiciendis neque accusamus cum!</p>
            </div>
            <div class="cursor-pointer flex justify-between items-center tab bg-pinkish border border-stroke px-5 py-4 rounded-sm" id="product-description">
                <p class="font-[18px] text-medium font-poppins">Additional Information</p>
                <i class="fa-solid fa-plus text-grey"></i>
            </div>
            <div class="additional-info-tab-content flex justify-between items-center gap-[80px]">
                <div class="w-1/2">
                    <x-product-characterstic characterstic="Color" value="Green" />
                    <x-product-characterstic characterstic="Item Port Number" value="53XLUD84" />
                    <x-product-characterstic characterstic="Primary Material" value="Wool" />
                    <x-product-characterstic characterstic="Capacity" value="Free Size" />
                    <x-product-characterstic characterstic="Weight" value="80 Grams" />

                </div>
                <div class="w-1/2">
                    <x-product-characterstic characterstic="Item Model Number" value="Adjustable" />
                    <x-product-characterstic characterstic="Assembly Required" value="No" />
                    <x-product-characterstic characterstic="Finish Type" value="Chrome" />
                    <x-product-characterstic characterstic="Number of Pieces" value="10" />
                    <x-product-characterstic characterstic="Manufacturer" value="Licogel" />
                </div>
            </div>
            {{-- <div class="cursor-pointer flex justify-between items-center tab bg-pinkish border border-stroke px-5 py-4 rounded-sm" id="product-description">
                <p class="font-[18px] text-medium font-poppins">Reviews</p>
                <i class="fa-solid fa-plus text-grey"></i>
            </div> --}}

            <x-blueprints.section
                heading="Related Products"
                description="We have selected suggested products optimised for you"
            >
            <div class="pt-[80px] flex justify-between">
                <x-blocks.card />
                <x-blocks.card />
                <x-blocks.card />
                <x-blocks.card />
            </div>
            </x-blueprints.section>
        </div>
    </div>
</x-layout.app>
