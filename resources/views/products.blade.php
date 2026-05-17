<x-layout.app>
    <div class="relative min-h-[800px]">
        <!-- Shimmering Skeleton Loader -->
        <x-skeletons.product />

        <!-- Actual Product Details Content -->
        <div id="product-details-content" class="container mx-auto py-[50px] transition-opacity duration-500 opacity-0">
            <div class="flex gap-[20px] flex-col lg:flex-row">
            <!-- Product Images Gallery -->
            <div class="flex gap-[20px] w-full lg:w-auto">
                <div class="side-images w-[100px] sm:w-[150px] flex flex-col gap-[20px] flex-shrink-0">
                    @foreach($product->media as $index => $mediaItem)
                        <div 
                            class="side-image w-[100px] sm:w-[150px] h-[100px] sm:h-[150px] flex-shrink-0 p-1 bg-white border-2 {{ $index === 0 ? 'border-[#8B3118]' : 'border-transparent' }} hover:border-[#8B3118] transition-all rounded-[8px] cursor-pointer"
                            onclick="changeMainImage('{{ $mediaItem->url }}', this)"
                        >
                            <img 
                                src="{{ $mediaItem->url }}" 
                                alt="{{ $product->name }} image {{ $index + 1 }}" 
                                class="w-full h-full object-cover rounded-[4px]" 
                            />
                        </div>
                    @endforeach
                </div>
                <div class="main-image w-full lg:w-[680px]">
                    <style>
                        .main-image-container #zoom-lens {
                            opacity: 0;
                            visibility: hidden;
                            pointer-events: none;
                            transition: opacity 0.25s ease, visibility 0.25s ease;
                        }
                        .main-image-container:hover #zoom-lens {
                            opacity: 1;
                            visibility: visible;
                        }
                        .flying-cart-item {
                            position: fixed;
                            z-index: 99999;
                            border-radius: 50%;
                            border: 2px solid #8B3118;
                            box-shadow: 0 10px 25px rgba(0,0,0,0.15), 0 0 10px rgba(139,49,24,0.3);
                            pointer-events: none;
                            transition: all 0.9s cubic-bezier(0.66, -0.01, 0.3, 0.99);
                            object-fit: cover;
                        }
                        @keyframes cart-bounce {
                            0% { transform: scale(1); }
                            30% { transform: scale(1.3); }
                            50% { transform: scale(0.9); }
                            70% { transform: scale(1.15); }
                            100% { transform: scale(1); }
                        }
                        .cart-bounce-active {
                            animation: cart-bounce 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) both;
                            display: inline-block;
                        }
                    </style>
                    <div class="main-image-container aspect-[688/690] w-full bg-pinkish rounded-xs overflow-hidden border border-[#EAEAEA] shadow-sm relative cursor-zoom-in">
                        <img 
                            id="main-product-image" 
                            src="{{ $product->media->first()?->url ?? asset('assets/images/product.png') }}" 
                            alt="{{ $product->name }}" 
                            class="w-full h-full object-cover transition-opacity duration-300" 
                        />
                        <!-- Telescope / Magnifying Lens Overlay -->
                        <div id="zoom-lens" class="absolute pointer-events-none rounded-full border-2 border-white bg-no-repeat transition-opacity duration-200" style="width: 180px; height: 180px; box-shadow: 0 0 0 1px rgba(0,0,0,0.15), 0 15px 35px rgba(0,0,0,0.3), inset 0 0 15px rgba(0,0,0,0.15);"></div>
                    </div>
                </div>
            </div>

            <!-- Product Purchase Details -->
            <div class="product-data flex-1 pl-0 lg:pl-[40px] flex flex-col justify-between">
                <div class="product-data-header flex gap-[15px] justify-between">
                    <div class="stock text-grey font-[14px] capitalize bg-pinkish border border-stroke px-[15px] py-[10px] font-poppins rounded-full">
                        {{ $product->stock === 'instock' ? 'in stock' : 'out of stock' }}
                    </div>
                    <div class="sku text-grey font-[14px] capitalize bg-pinkish border border-stroke px-[15px] py-[10px] font-poppins rounded-full">
                        <span class="font-medium uppercase">sku:</span> {{ $product->sku }}
                    </div>
                </div>
                
                <div class="product-reviews mt-[10px]">
                    <x-products.reviews />
                </div>
                
                <div class="product-info mt-2">
                    <h1 class="font-semibold text-[32px] font-poppins text-primary leading-tight">{{ $product->name }}</h1>
                    <p class="text-grey text-[14px] font-poppins mt-2 leading-relaxed">
                        {{ $product->short_description }}
                    </p>
                    <div class="product-price flex items-center gap-4 mt-4">
                        @if($product->discount_percentage > 0)
                            <span class="text-grey text-[16px] line-through font-poppins">PKR {{ number_format($product->price, 2) }}</span>
                            <span class="text-primary text-[25px] font-bold font-poppins">PKR {{ number_format($product->price - ($product->price * ($product->discount_percentage / 100)), 2) }}</span>
                            <span class="text-[#8B3118] bg-orange-50 text-[12px] font-bold font-poppins px-3 py-1 rounded-full border border-[#8B3118]/10">-{{ round($product->discount_percentage) }}% OFF</span>
                        @else
                            <span class="text-primary text-[25px] font-bold font-poppins">PKR {{ number_format($product->price, 2) }}</span>
                        @endif
                    </div>
                </div>

                <!-- Color & Size Selection -->
                <div class="product-selection mt-4 border-y border-stroke py-4 flex flex-col sm:flex-row items-stretch gap-6 sm:gap-0">
                    <div class="size-selection w-full sm:w-1/2 sm:pr-8">
                        <h3 class="text-[20px] font-bold font-poppins text-primary mb-4">Size</h3>
                        <div class="flex gap-3 flex-wrap">
                            @forelse($product->sizes as $index => $size)
                                <button 
                                    type="button"
                                    class="size-option w-12 h-12 flex items-center justify-center bg-pinkish text-primary font-poppins font-medium rounded-xs cursor-pointer border-2 {{ $index === 0 ? 'border-primary bg-stroke' : 'border-transparent' }} hover:bg-stroke transition-all"
                                    onclick="selectSize(this, '{{ $size->name }}')"
                                >
                                    {{ $size->name }}
                                </button>
                            @empty
                                <div class="text-grey font-poppins text-[14px]">No sizes available</div>
                            @endforelse
                        </div>
                        <input type="hidden" id="selected-size" name="size" value="{{ $product->sizes->first()?->name ?? '' }}">
                    </div>
                    <div class="color-selection w-full sm:w-1/2 sm:pl-8 sm:border-l border-stroke">
                        <h3 class="text-[20px] font-bold font-poppins text-primary mb-4">Color</h3>
                        <div class="flex gap-4 flex-wrap">
                            @forelse($product->colors as $index => $color)
                                <button 
                                    type="button"
                                    class="color-option w-10 h-10 rounded-full cursor-pointer border-2 {{ $index === 0 ? 'border-primary ring-2 ring-offset-2 ring-primary' : 'border-transparent' }} transition-all relative"
                                    style="background-color: {{ $color->hex_code }};"
                                    title="{{ $color->name }}"
                                    onclick="selectColor(this, '{{ $color->name }}')"
                                >
                                    @if($index === 0)
                                        <div class="w-full h-full flex items-center justify-center">
                                            <div class="w-2 h-2 rounded-full bg-white mix-blend-difference"></div>
                                        </div>
                                    @endif
                                </button>
                            @empty
                                <div class="text-grey font-poppins text-[14px]">No colors available</div>
                            @endforelse
                        </div>
                        <input type="hidden" id="selected-color" name="color" value="{{ $product->colors->first()?->name ?? '' }}">
                    </div>
                </div>

                <!-- Quantity Control & Primary Actions -->
                <div class="product-actions mt-4 flex flex-col md:flex-row md:flex-wrap items-stretch md:items-center gap-6">
                    <div class="quantity-control flex items-center gap-6">
                        <span class="text-[16px] font-poppins text-grey mt-2">Quantity:</span>
                        <div class="flex items-center gap-5">
                            <button 
                                type="button"
                                class="group w-[44px] h-[44px] rounded-full border border-primary flex items-center justify-center hover:bg-primary transition-all"
                                onclick="adjustQuantity(-1)"
                            >
                                <img src="{{ asset('assets/images/black-arrow.png') }}" class="w-4 rotate-180 group-hover:hidden" alt="decrease">
                                <img src="{{ asset('assets/images/white-arrow.png') }}" class="rotate-180 w-4 hidden group-hover:block" alt="decrease">
                            </button>
                            <div 
                                id="quantity-display" 
                                class="w-[44px] h-[44px] rounded-full bg-pinkish flex items-center justify-center text-[14px] font-poppins text-primary border border-primary"
                            >
                                1
                            </div>
                            <button 
                                type="button"
                                class="group w-[44px] h-[44px] rounded-full border border-primary flex items-center justify-center hover:bg-primary transition-all"
                                onclick="adjustQuantity(1)"
                            >
                                <img src="{{ asset('assets/images/black-arrow.png') }}" class="w-4 group-hover:hidden" alt="increase">
                                <img src="{{ asset('assets/images/white-arrow.png') }}" class="w-4 hidden group-hover:block" alt="increase">
                            </button>
                        </div>
                        <input type="hidden" id="product-quantity" name="quantity" value="1">
                    </div>

                    <button 
                        id="add-to-cart-btn"
                        class="group h-[44px] flex-1 min-w-[160px] bg-white border border-primary rounded-full flex items-center justify-center gap-5 px-6 hover:bg-primary transition-all cursor-pointer"
                        onclick="addToCart({{ $product->id }})"
                    >
                        <img src="{{ asset('assets/images/basket.png') }}" class="w-7 group-hover:hidden" alt="basket">
                        <img src="{{ asset('assets/images/basket-white.png') }}" alt="basket" class="w-7 hidden group-hover:block transition-all">
                        <span id="add-to-cart-text" class="text-[14px] font-poppins group-hover:text-white transition-all">Add To Cart</span>
                    </button>

                    <div class="flex gap-4">
                        <button class="w-[44px] h-[44px] rounded-full border border-primary flex items-center justify-center hover:bg-primary group transition-all">
                            <i class="fa-regular fa-heart text-[18px] group-hover:text-white transition-all"></i>
                        </button>

                        <button class="w-[44px] h-[44px] rounded-full border border-primary flex items-center justify-center hover:bg-primary group transition-all">
                            <i class="fa-regular fa-eye text-[18px] text-primary group-hover:text-white transition-all"></i>
                        </button>
                    </div>
                </div>

                <div class="product-buy mt-6 flex items-center gap-4">
                    <button class="w-[44px] h-[44px] rounded-full border border-primary flex items-center justify-center hover:bg-primary group transition-all">
                        <i class="fa-solid fa-share text-[18px] text-primary group-hover:text-white transition-all"></i>
                    </button>
                    <button onclick="buyItNow({{ $product->id }}, event)" class="flex-1 h-[44px] bg-[#8B3118] text-white rounded-full font-poppins text-[14px] font-bold hover:bg-opacity-90 transition-all cursor-pointer">
                        Buy It Now
                    </button>
                </div>
            </div>
        </div>

        <!-- Togglable Sections (Tabs) -->
        <div class="tabbed-sections mt-12 flex flex-col gap-[25px]">
            <!-- Description Tab -->
            <div>
                <div 
                    class="cursor-pointer flex justify-between items-center tab bg-pinkish border border-stroke px-5 py-4 rounded-sm hover:bg-stroke transition-all"
                    onclick="toggleTab('description-content', this)"
                >
                    <p class="font-[18px] font-semibold font-poppins text-primary">Description</p>
                    <i class="fa-solid fa-plus text-grey tab-icon transition-transform duration-300"></i>
                </div>
                <div id="description-content" class="tab-content hidden px-5 py-6 border-x border-b border-stroke rounded-b-sm bg-white">
                    <p class="font-poppins font-[16px] text-grey leading-[36px] whitespace-pre-line">{{ $product->description }}</p>
                </div>
            </div>

            <!-- Additional Info Tab -->
            <div>
                <div 
                    class="cursor-pointer flex justify-between items-center tab bg-pinkish border border-stroke px-5 py-4 rounded-sm hover:bg-stroke transition-all"
                    onclick="toggleTab('additional-info-content', this)"
                >
                    <p class="font-[18px] font-semibold font-poppins text-primary">Additional Information</p>
                    <i class="fa-solid fa-plus text-grey tab-icon transition-transform duration-300"></i>
                </div>
                <div id="additional-info-content" class="tab-content hidden flex-col md:flex-row justify-between items-start gap-4 md:gap-[80px] px-5 py-6 border-x border-b border-stroke rounded-b-sm bg-white">
                    <div class="w-full md:w-1/2">
                        <x-product-characterstic characterstic="Primary Colors" value="{{ $product->colors->pluck('name')->join(', ') ?: 'N/A' }}" />
                        <x-product-characterstic characterstic="Sizes Available" value="{{ $product->sizes->pluck('name')->join(', ') ?: 'N/A' }}" />
                        <x-product-characterstic characterstic="Item SKU" value="{{ $product->sku }}" />
                        <x-product-characterstic characterstic="Quantity in Stock" value="{{ $product->quantity }}" />
                    </div>
                    <div class="w-full md:w-1/2">
                        <x-product-characterstic characterstic="Product Status" value="{{ ucfirst($product->status) }}" />
                        <x-product-characterstic characterstic="Stock Availability" value="{{ $product->stock === 'instock' ? 'In Stock' : 'Out of Stock' }}" />
                        <x-product-characterstic characterstic="Product Categories" value="{{ $product->categories->pluck('name')->join(', ') ?: 'N/A' }}" />
                    </div>
                </div>
            </div>

            <!-- Recommended Products Section -->
            <x-blueprints.section
                heading="Recommended Products"
                description="We have selected suggested products optimised for you"
            >
                <div class="pt-[40px] flex flex-wrap justify-center lg:justify-between gap-[36px]">
                    @forelse($relatedProducts as $relatedProduct)
                        <x-blocks.card 
                            :name="$relatedProduct->name" 
                            :price="number_format($relatedProduct->price, 2)" 
                            :type="$relatedProduct->short_description" 
                            :image="$relatedProduct->media->first()?->url ?? asset('assets/images/product.png')" 
                            :slug="'\'' . $relatedProduct->slug . '\''"
                        />
                    @empty
                        <div class="text-center w-full text-grey py-10 font-poppins">No related products found.</div>
                    @endforelse
                </div>
            </x-blueprints.section>
        </div>
    </div>
</div>

    <!-- Gallery & Interaction JS -->
    <script>
        function runFlyToCartAnimation() {
            const mainImg = document.getElementById('main-product-image');
            const cartBtn = document.getElementById('cart-btn');
            
            if (!mainImg || !cartBtn) {
                if (window.openCartDrawer) window.openCartDrawer();
                return;
            }
            
            const imgRect = mainImg.getBoundingClientRect();
            const cartRect = cartBtn.getBoundingClientRect();
            
            // Create dynamic floating clone element
            const flyer = document.createElement('img');
            flyer.src = mainImg.src;
            flyer.className = 'flying-cart-item';
            
            // Position flyer at the exact starting coordinates
            flyer.style.left = `${imgRect.left}px`;
            flyer.style.top = `${imgRect.top}px`;
            flyer.style.width = `${imgRect.width}px`;
            flyer.style.height = `${imgRect.height}px`;
            
            document.body.appendChild(flyer);
            
            // Force browser layout recalculation (reflow)
            flyer.offsetWidth;
            
            // Target coordinates centered inside the header cart icon
            const destX = cartRect.left + (cartRect.width / 2) - 20;
            const destY = cartRect.top + (cartRect.height / 2) - 20;
            
            // Transform & fly elements smoothly
            flyer.style.left = `${destX}px`;
            flyer.style.top = `${destY}px`;
            flyer.style.width = '40px';
            flyer.style.height = '40px';
            flyer.style.opacity = '0.1';
            
            // Pop bounce cart button when landing and open the drawer
            setTimeout(() => {
                flyer.remove();
                
                cartBtn.classList.add('cart-bounce-active');
                
                setTimeout(() => {
                    cartBtn.classList.remove('cart-bounce-active');
                    
                    if (window.openCartDrawer) {
                        window.openCartDrawer();
                    }
                }, 600);
            }, 900);
        }

        function addToCart(productId) {
            const qty = parseInt(document.getElementById('product-quantity')?.value || '1');
            const size = document.getElementById('selected-size')?.value || '';
            const color = document.getElementById('selected-color')?.value || '';
            
            const btn = document.getElementById('add-to-cart-btn');
            const btnText = document.getElementById('add-to-cart-text');
            
            if (btn) btn.disabled = true;
            if (btnText) btnText.innerText = 'Adding...';
            
            fetch('/api/cart', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: qty,
                    color: color,
                    size: size
                })
            })
            .then(res => {
                if (!res.ok) {
                    return res.json().then(err => { throw err; });
                }
                return res.json();
            })
            .then(data => {
                if (data.success) {
                    if (window.refreshCartDrawer) {
                        window.refreshCartDrawer();
                    }
                    // Trigger the awesome fly-to-cart animation!
                    runFlyToCartAnimation();
                }
            })
            .catch(err => {
                console.error("Error adding to cart:", err);
                alert(err.message || "Failed to add product to cart. Please check stock and try again.");
            })
            .finally(() => {
                if (btn) btn.disabled = false;
                if (btnText) btnText.innerText = 'Add To Cart';
            });
        }

        function buyItNow(productId, event) {
            const qty = parseInt(document.getElementById('product-quantity')?.value || '1');
            const size = document.getElementById('selected-size')?.value || '';
            const color = document.getElementById('selected-color')?.value || '';
            
            const btn = event.currentTarget;
            const originalText = btn.innerText;
            btn.disabled = true;
            btn.innerText = 'Processing...';
            
            fetch('/api/cart', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: qty,
                    color: color,
                    size: size
                })
            })
            .then(res => {
                if (!res.ok) {
                    return res.json().then(err => { throw err; });
                }
                return res.json();
            })
            .then(data => {
                if (data.success) {
                    window.location.href = '/cart';
                }
            })
            .catch(err => {
                console.error("Error with Buy It Now:", err);
                alert(err.message || "Failed to process Buy It Now. Please check stock and try again.");
            })
            .finally(() => {
                btn.disabled = false;
                btn.innerText = originalText;
            });
        }

        function changeMainImage(url, element) {
            const mainImage = document.getElementById('main-product-image');
            if (mainImage) {
                mainImage.style.opacity = '0.3';
                setTimeout(() => {
                    mainImage.src = url;
                    mainImage.style.opacity = '1';
                    // Update zoom lens background image
                    const lens = document.getElementById('zoom-lens');
                    if (lens) {
                        lens.style.backgroundImage = `url('${url}')`;
                    }
                }, 150);
            }
            
            document.querySelectorAll('.side-image').forEach(el => {
                el.classList.remove('border-[#8B3118]');
                el.classList.add('border-transparent');
            });
            element.classList.remove('border-transparent');
            element.classList.add('border-[#8B3118]');
        }

        // Initialize magnifying glass / telescope effect
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.querySelector('.main-image-container');
            const mainImg = document.getElementById('main-product-image');
            const lens = document.getElementById('zoom-lens');
            
            if (container && mainImg && lens) {
                container.addEventListener('mouseenter', () => {
                    lens.style.backgroundImage = `url('${mainImg.src}')`;
                    const imgWidth = mainImg.offsetWidth;
                    const imgHeight = mainImg.offsetHeight;
                    lens.style.backgroundSize = `${imgWidth * 2.5}px ${imgHeight * 2.5}px`;
                });
                
                container.addEventListener('mousemove', (e) => {
                    const rect = container.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    
                    const lensWidth = lens.offsetWidth;
                    const lensHeight = lens.offsetHeight;
                    
                    // Position the lens centered on the cursor
                    const lensX = x - lensWidth / 2;
                    const lensY = y - lensHeight / 2;
                    
                    lens.style.left = `${lensX}px`;
                    lens.style.top = `${lensY}px`;
                    
                    // Zoom position calculation
                    const zoomFactor = 2.5;
                    const bgX = -((x * zoomFactor) - lensWidth / 2);
                    const bgY = -((y * zoomFactor) - lensHeight / 2);
                    
                    lens.style.backgroundPosition = `${bgX}px ${bgY}px`;
                });
            }
        });

        function selectSize(element, sizeName) {
            document.querySelectorAll('.size-option').forEach(el => {
                el.classList.remove('border-primary', 'bg-stroke');
                el.classList.add('border-transparent');
            });
            element.classList.remove('border-transparent');
            element.classList.add('border-primary', 'bg-stroke');
            document.getElementById('selected-size').value = sizeName;
        }

        function selectColor(element, colorName) {
            document.querySelectorAll('.color-option').forEach(el => {
                el.classList.remove('border-primary', 'ring-2', 'ring-offset-2', 'ring-primary');
                // Remove indicator dot
                el.innerHTML = '';
            });
            element.classList.add('border-primary', 'ring-2', 'ring-offset-2', 'ring-primary');
            element.innerHTML = '<div class="w-full h-full flex items-center justify-center"><div class="w-2 h-2 rounded-full bg-white mix-blend-difference"></div></div>';
            document.getElementById('selected-color').value = colorName;
        }

        function adjustQuantity(amount) {
            const display = document.getElementById('quantity-display');
            const input = document.getElementById('product-quantity');
            const currentQty = parseInt(input.value);
            const maxQty = {{ $product->quantity ?: 1 }};
            
            let newQty = currentQty + amount;
            if (newQty < 1) newQty = 1;
            if (newQty > maxQty) newQty = maxQty;
            
            display.innerText = newQty;
            input.value = newQty;
        }

        function toggleTab(tabId, tabHeader) {
            const content = document.getElementById(tabId);
            const icon = tabHeader.querySelector('.tab-icon');
            
            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                if (tabId === 'additional-info-content') {
                    content.classList.add('flex');
                }
                icon.classList.remove('fa-plus');
                icon.classList.add('fa-minus');
                icon.style.transform = 'rotate(180deg)';
            } else {
                content.classList.add('hidden');
                if (tabId === 'additional-info-content') {
                    content.classList.remove('flex');
                }
                icon.classList.remove('fa-minus');
                icon.classList.add('fa-plus');
                icon.style.transform = 'rotate(0deg)';
            }
        }

        // Fade out skeleton loader and reveal product details page
        window.addEventListener('load', () => {
            const skeleton = document.getElementById('product-details-skeleton');
            const content = document.getElementById('product-details-content');
            if (skeleton && content) {
                skeleton.style.opacity = '0';
                content.style.opacity = '1';
                setTimeout(() => {
                    skeleton.style.display = 'none';
                }, 400);
            }
        });
    </script>
</x-layout.app>

