<x-layout.app>
    <x-breadcrumb />

    <div id="cart-page" class="container mt-17.5">
        <!-- Loading Skeleton Placeholder -->
        <div v-if="loading" id="cart-skeleton-loading">
            <x-skeletons.cart />
        </div>

        <!-- Dynamic Cart Content -->
        <div v-else v-cloak>
            <!-- Empty State -->
            <div v-if="cart.items.length === 0" class="py-20 flex flex-col items-center justify-center text-center">
                <div class="w-[100px] h-[100px] bg-[#F6F6F6] rounded-full flex items-center justify-center mb-6">
                    <i class="fa-solid fa-basket-shopping text-[40px] text-gray-300"></i>
                </div>
                <h3 class="font-poppins text-[24px] font-semibold mb-2 text-black">Your Cart is Empty</h3>
                <p class="font-poppins text-[16px] text-grey max-w-[400px] mb-8">
                    Looks like you haven't added any products to your cart yet. Browse our shop to find premium bags!
                </p>
                <a href="{{ route('home.shop') }}" class="bg-black text-white px-8 py-4 rounded-full font-poppins font-semibold hover:bg-shade transition-colors">
                    Return to Shop
                </a>
            </div>

            <!-- Cart Table & Subtotal Summary -->
            <div v-else class="flex justify-between items-start gap-7.5">
                <!-- Cart Items Table -->
                <div class="w-3/4 customer-information mt-5 flex flex-col gap-5">
                    <div class="rounded-md overflow-hidden border border-stroke bg-white shadow-sm">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-pinkish border-b border-stroke">
                                    <th class="text-[15px] font-semibold font-poppins py-4 pl-8 text-left text-black">Product</th>
                                    <th class="text-[15px] font-semibold font-poppins py-4 text-left text-black">Price</th>
                                    <th class="text-[15px] font-semibold font-poppins py-4 text-center text-black">Quantity</th>
                                    <th class="text-[15px] font-semibold font-poppins py-4 text-center text-black">Total</th>
                                    <th class="text-[15px] font-semibold font-poppins py-4 text-center text-black">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in cart.items" :key="item.key" class="border-b border-[#EAEAEA] last:border-none hover:bg-[#FAFADA] transition-colors duration-200">
                                    <!-- Product Info -->
                                    <td class="flex items-center gap-4 py-6 pl-8">
                                        <img :src="item.image" class="rounded-md w-20 h-20 object-cover border border-stroke shadow-xs">
                                        <div>
                                            <p class="text-[15px] font-semibold font-poppins text-black hover:text-secondary cursor-pointer">@{{ item.name }}</p>
                                            <p v-if="item.color || item.size" class="text-[12px] text-grey font-poppins mt-1">
                                                <span v-if="item.color" class="mr-3">Color: <span class="text-black font-semibold">@{{ item.color }}</span></span>
                                                <span v-if="item.size">Size: <span class="text-black font-semibold">@{{ item.size }}</span></span>
                                            </p>
                                        </div>
                                    </td>
                                    <!-- Price -->
                                    <td class="py-6">
                                        <p class="text-[15px] font-semibold font-poppins text-black">PKR @{{ formatPrice(item.price) }}</p>
                                    </td>
                                    <!-- Quantity Selector -->
                                    <td class="py-6">
                                        <div class="flex justify-center items-center gap-3">
                                            <button @click="updateQty(item.key, item.quantity - 1)" 
                                                    :disabled="item.quantity <= 1"
                                                    class="h-9 w-9 border border-[#EAEAEA] rounded-full flex items-center justify-center hover:bg-black hover:text-white disabled:opacity-30 disabled:hover:bg-transparent disabled:hover:text-black transition-colors cursor-pointer">
                                                <i class="fa-solid fa-minus text-[10px]"></i>
                                            </button>
                                            <div class="bg-pinkish h-9 w-12 border border-[#EAEAEA] rounded-md flex items-center justify-center">
                                                <p class="font-[14px] font-poppins font-semibold text-black">@{{ item.quantity }}</p>
                                            </div>
                                            <button @click="updateQty(item.key, item.quantity + 1)" 
                                                    class="h-9 w-9 border border-[#EAEAEA] rounded-full flex items-center justify-center hover:bg-black hover:text-white transition-colors cursor-pointer">
                                                <i class="fa-solid fa-plus text-[10px]"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <!-- Total -->
                                    <td class="py-6 text-center">
                                        <p class="text-[15px] font-bold font-poppins text-black">PKR @{{ formatPrice(item.price * item.quantity) }}</p>
                                    </td>
                                    <!-- Delete Button -->
                                    <td class="py-6 text-center">
                                        <button @click="removeItem(item.key)" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-[#FFF5F5] hover:bg-[#FFE5E5] text-red-500 hover:text-red-700 transition-colors cursor-pointer">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Subtotal Summary Section -->
                <div class="product-information w-1/4 border border-stroke px-6 py-6 rounded-md shadow-sm bg-white">
                    <h2 class="text-[20px] font-poppins font-semibold border-b border-stroke pb-4 mb-4">Cart Totals</h2>
                    
                    <div class="invoice-list flex flex-col gap-3.5 bg-pinkish px-5 py-5 rounded-md mb-6">
                        <div class="subtotal flex justify-between items-center">
                            <p class="font-[14px] text-grey font-poppins">Subtotal</p>
                            <p class="font-[15px] font-bold font-poppins text-black">PKR @{{ formatPrice(cart.subtotal) }}</p>
                        </div>
                        <div class="delivery flex justify-between items-center border-t border-dashed border-[#EAEAEA] pt-3 mt-1">
                            <p class="font-[14px] text-grey font-poppins">Delivery</p>
                            <p class="font-[15px] font-bold font-poppins text-green-600">@{{ deliveryCost }}</p>
                        </div>
                    </div>

                    <div class="total flex justify-between items-center mt-5 bg-pinkish px-6 py-4 rounded-full mb-6">
                        <p class="font-[14px] font-poppins font-semibold text-black">Total</p>
                        <p class="font-[16px] font-bold font-poppins text-secondary">PKR @{{ totalCostFormatted }}</p>
                    </div>

                    <button @click="checkout" class="bg-black hover:bg-shade transition-colors text-white rounded-full text-[15px] font-semibold font-poppins w-full py-4 shadow-md cursor-pointer block text-center">
                        Proceed To Checkout
                    </button>
                </div>
            </div>
        </div>

        <!-- Recommended Products -->
        <x-blueprints.section
            heading="Recommended Products"
            description="We have selected suggested products optimised for you"
        >
            <!-- Loading Skeletons -->
            <div v-if="loadingRelated" class="pt-[80px] flex justify-between w-full">
                <x-skeletons.card />
                <x-skeletons.card />
                <x-skeletons.card />
                <x-skeletons.card />
            </div>

            <!-- Dynamic Related Cards -->
            <div v-else class="pt-[80px] flex justify-between w-full flex-wrap gap-y-8">
                <div v-for="product in relatedProducts" :key="product.id">
                    <x-blocks.card 
                        name="@{{ product.name }}" 
                        price="@{{ formatPrice(product.price) }}" 
                        type="@{{ product.short_description || 'Premium Collection' }}" 
                        image="product.image || '/assets/images/product.png'" 
                        slug="product.slug"
                    />
                </div>
            </div>
        </x-blueprints.section>
    </div>

    @push('scripts')
        @vite('resources/js/cart.js')
    @endpush
</x-layout.app>
