<x-layout.app>
    <x-breadcrumb />

    <div class="container mt-[70px] relative min-h-[600px]">
        <!-- 1. Pure Laravel Static Skeleton: Painted instantly by browser on initial load -->
        <div id="checkout-skeleton" class="w-full">
            <x-skeletons.cart />
            
            <x-blueprints.section
                heading="Recommended Products"
                description="We have selected suggested products optimised for you"
            >
                <div class="pt-[80px] grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-[36px] w-full">
                    <x-skeletons.card />
                    <x-skeletons.card />
                    <x-skeletons.card />
                    <x-skeletons.card />
                </div>
            </x-blueprints.section>
        </div>

        <!-- 2. Dynamic Vue Checkout App (Initially hidden, then fades in once compiled and loaded) -->
        <div id="checkout-page" v-cloak class="opacity-0 transition-opacity duration-300 w-full">
            <!-- Checkout Form Content -->
            <div class="flex flex-col lg:flex-row justify-between items-start gap-[30px] mb-16">
                <form @submit.prevent="placeOrder" class="w-full lg:w-3/4 customer-information mt-[20px] flex flex-col gap-[20px]">
                    <h1 class="text-[26px] font-poppins font-semibold text-black">Billing &amp; Shipping Address</h1>
                    
                    <!-- First Name / Last Name -->
                    <div class="flex flex-col sm:flex-row gap-[30px] w-full">
                        <div class="w-full sm:w-1/2 flex flex-col">
                            <input type="text" v-model="form.first_name" name="first_name" placeholder="First Name" class="outline-0 placeholder:text-grey placeholder:font-poppins bg-pinkish border text-[14px] px-5 py-4 rounded-md border-stroke w-full transition-all" :class="{'border-red-500 ring-1 ring-red-500/20': errors.first_name, 'focus:border-primary': !errors.first_name}" />
                            <span v-if="errors.first_name" class="text-red-500 text-[12px] font-poppins mt-1.5"><i class="fa-solid fa-circle-exclamation mr-1"></i>@{{ errors.first_name[0] }}</span>
                        </div>
                        <div class="w-full sm:w-1/2 flex flex-col">
                            <input type="text" v-model="form.last_name" name="last_name" placeholder="Last Name" class="outline-0 placeholder:text-grey placeholder:font-poppins bg-pinkish border text-[14px] px-5 py-4 rounded-md border-stroke w-full transition-all" :class="{'border-red-500 ring-1 ring-red-500/20': errors.last_name, 'focus:border-primary': !errors.last_name}" />
                            <span v-if="errors.last_name" class="text-red-500 text-[12px] font-poppins mt-1.5"><i class="fa-solid fa-circle-exclamation mr-1"></i>@{{ errors.last_name[0] }}</span>
                        </div>
                    </div>

                    <!-- Country / Street Address -->
                    <div class="flex flex-col sm:flex-row gap-[30px] w-full">
                        <div class="w-full sm:w-1/2 flex flex-col">
                            <input type="text" v-model="form.country" name="country" placeholder="Country" class="outline-0 placeholder:text-grey placeholder:font-poppins bg-pinkish border text-[14px] px-5 py-4 rounded-md border-stroke w-full transition-all" :class="{'border-red-500 ring-1 ring-red-500/20': errors.country, 'focus:border-primary': !errors.country}" />
                            <span v-if="errors.country" class="text-red-500 text-[12px] font-poppins mt-1.5"><i class="fa-solid fa-circle-exclamation mr-1"></i>@{{ errors.country[0] }}</span>
                        </div>
                        <div class="w-full sm:w-1/2 flex flex-col">
                            <input type="text" v-model="form.street_address" name="street_address" placeholder="House Number & Street Name" class="outline-0 placeholder:text-grey placeholder:font-poppins bg-pinkish border text-[14px] px-5 py-4 rounded-md border-stroke w-full transition-all" :class="{'border-red-500 ring-1 ring-red-500/20': errors.street_address, 'focus:border-primary': !errors.street_address}" />
                            <span v-if="errors.street_address" class="text-red-500 text-[12px] font-poppins mt-1.5"><i class="fa-solid fa-circle-exclamation mr-1"></i>@{{ errors.street_address[0] }}</span>
                        </div>
                    </div>

                    <!-- Postcode / City -->
                    <div class="flex flex-col sm:flex-row gap-[30px] w-full">
                        <div class="w-full sm:w-1/2 flex flex-col">
                            <input type="text" v-model="form.postcode" name="postcode" placeholder="Postcode" class="outline-0 placeholder:text-grey placeholder:font-poppins bg-pinkish border text-[14px] px-5 py-4 rounded-md border-stroke w-full transition-all" :class="{'border-red-500 ring-1 ring-red-500/20': errors.postcode, 'focus:border-primary': !errors.postcode}" />
                            <span v-if="errors.postcode" class="text-red-500 text-[12px] font-poppins mt-1.5"><i class="fa-solid fa-circle-exclamation mr-1"></i>@{{ errors.postcode[0] }}</span>
                        </div>
                        <div class="w-full sm:w-1/2 flex flex-col">
                            <input type="text" v-model="form.city" name="city" placeholder="City" class="outline-0 placeholder:text-grey placeholder:font-poppins bg-pinkish border text-[14px] px-5 py-4 rounded-md border-stroke w-full transition-all" :class="{'border-red-500 ring-1 ring-red-500/20': errors.city, 'focus:border-primary': !errors.city}" />
                            <span v-if="errors.city" class="text-red-500 text-[12px] font-poppins mt-1.5"><i class="fa-solid fa-circle-exclamation mr-1"></i>@{{ errors.city[0] }}</span>
                        </div>
                    </div>

                    <!-- Phone / Email -->
                    <div class="flex flex-col sm:flex-row gap-[30px] w-full">
                        <div class="w-full sm:w-1/2 flex flex-col">
                            <input type="text" v-model="form.phone" name="phone" placeholder="Phone" class="outline-0 placeholder:text-grey placeholder:font-poppins bg-pinkish border text-[14px] px-5 py-4 rounded-md border-stroke w-full transition-all" :class="{'border-red-500 ring-1 ring-red-500/20': errors.phone, 'focus:border-primary': !errors.phone}" />
                            <span v-if="errors.phone" class="text-red-500 text-[12px] font-poppins mt-1.5"><i class="fa-solid fa-circle-exclamation mr-1"></i>@{{ errors.phone[0] }}</span>
                        </div>
                        <div class="w-full sm:w-1/2 flex flex-col">
                            <input type="email" v-model="form.email" name="email" placeholder="Email Address" class="outline-0 placeholder:text-grey placeholder:font-poppins bg-pinkish border text-[14px] px-5 py-4 rounded-md border-stroke w-full transition-all" :class="{'border-red-500 ring-1 ring-red-500/20': errors.email, 'focus:border-primary': !errors.email}" />
                            <span v-if="errors.email" class="text-red-500 text-[12px] font-poppins mt-1.5"><i class="fa-solid fa-circle-exclamation mr-1"></i>@{{ errors.email[0] }}</span>
                        </div>
                    </div>

                    <!-- Notes -->
                    <div class="w-full flex flex-col">
                        <textarea v-model="form.notes" placeholder="Order Notes (Optional)" rows="4" class="resize-none outline-0 placeholder:text-grey placeholder:font-poppins bg-pinkish border text-[14px] px-5 py-4 rounded-md border-stroke w-full focus:border-primary"></textarea>
                    </div>
                </form>

                <!-- Checkout Order Summary Card -->
                <div class="product-information w-full lg:w-1/4 border border-stroke px-5 py-5 rounded-md bg-white shadow-xs mt-[20px] lg:mt-0">
                    <h2 class="text-[22px] font-poppins font-semibold text-black">Cart Totals</h2>
                    <div class="invoice-list mt-5 flex flex-col gap-2.5 bg-pinkish px-4 py-4 rounded-md">
                        <div class="subtotal flex justify-between items-center">
                            <p class="font-[14px] text-grey font-poppins">Subtotal</p>
                            <p class="font-[14px] font-poppins text-black font-semibold">PKR @{{ formatPrice(cart.subtotal) }}</p>
                        </div>
                        <div class="delivery flex justify-between items-center border-t border-dashed border-[#EAEAEA] pt-2.5 mt-1">
                            <p class="font-[14px] text-grey font-poppins">Estimated Delivery</p>
                            <p class="font-[14px] font-poppins text-black font-semibold">Free</p>
                        </div>
                    </div>
                    
                    <div class="total flex justify-between mt-5 bg-pinkish px-6 py-3 rounded-full">
                        <p class="font-[14px] text-grey font-poppins mt-0.5">Total</p>
                        <p class="font-[16px] font-poppins font-bold text-black">PKR @{{ totalCostFormatted }}</p>
                    </div>

                    <button @click="placeOrder" :disabled="loadingOrder" class="mt-5 bg-secondary hover:bg-shade transition-colors text-white rounded-full text-[15px] font-poppins w-full px-7.5 py-4 cursor-pointer font-semibold shadow-md flex items-center justify-center gap-2">
                        <span v-if="loadingOrder" class="flex items-center justify-center gap-2">
                            <i class="fa-solid fa-circle-notch animate-spin mr-1"></i> Processing Order...
                        </span>
                        <span v-else>Place Order</span>
                    </button>
                </div>
            </div>

            <!-- Recommended Products Section -->
            <x-blueprints.section
                heading="Recommended Products"
                description="We have selected suggested products optimised for you"
            >
                <div class="pt-[80px] grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-[36px] w-full">
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
    </div>

    @push('scripts')
        @vite('resources/js/checkout.js')
    @endpush
</x-layout.app>
