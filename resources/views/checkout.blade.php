<x-layout.app>
    <x-breadcrumb />

    <div id="checkout" class="container mt-[70px] flex justify-between items-start gap-[30px]">
        <div class="w-3/4 customer-information mt-[20px] flex flex-col gap-[20px]">
            <h1 class="text-[26px] font-poppins font-semibold">Billing &amp; Shipping Address</h1>
            <div class="flex gap-[30px]">
                <x-theme-input placeholder="First Name" />
                <x-theme-input placeholder="Last Name" />
            </div>
            <div class="flex gap-[30px]">
                <x-theme-input placeholder="Country" />
                <x-theme-input placeholder="House Number & Street Name" />
            </div>
            <div class="flex gap-[30px]">
                <x-theme-input placeholder="Postcode" />
                <x-theme-input placeholder="City" />
            </div>
            <div class="flex gap-[30px]">
                <x-theme-input placeholder="Phone" />
                <x-theme-input placeholder="Email Address" />
            </div>
            <div>
                <x-theme-input placeholder="Account Username" :fullWidth="true"/>
            </div>
             <div>
                <x-theme-textarea placeholder="Order Notes (Optional)" :fullWidth="true"/>
            </div>
        </div>
        <div class="product-information w-1/4 border border-stroke px-5 py-5 rounded-md">
            <h2 class="text-[22px] font-poppins font-semibold">Cart Totals</h2>
            <div class="invoice-list mt-5 flex flex-col gap-2.5 bg-pinkish px-4 py-4 rounded-md">
                <div class="subtotal flex justify-between items-center">
                    <p class="font-[14px] text-grey font-poppins">Subtotal</p>
                    <p class="font-[14px] font-poppins">$20.00</p>
                </div>
                <div class="delivery flex justify-between items-center">
                    <p class="font-[14px] text-grey font-poppins">Estimated Delivery</p>
                    <p class="font-[14px] font-poppins">Free</p>
                </div>
                <div class="taxes flex justify-between items-center">
                    <p class="font-[14px] text-grey font-poppins">Estimated Taxes</p>
                    <p class="font-[14px] font-poppins">$20.00</p>
                </div>
            </div>
            <div class="coupon border rounded-full border-stroke pl-2.5 pr-1 mt-5 flex justify-between">
                <input type="text" placeholder="Coupon Code" class="outline-0 w-3/4"/>
                <button class="apply-btn px-2.5 py-2 my-1 text-[14px] text-white bg-black w-1/4 rounded-full">Apply</button>
            </div>
            <div class="total flex justify-between mt-5 bg-pinkish px-6 py-3 rounded-full">
                <p class="font-[14px] text-grey font-poppins">Estimated Taxes</p>
                <p class="font-[14px] font-poppins">$20.00</p>
            </div>

            <button class="mt-5 bg-secondary text-white rounded-full text-[14px] font-poppins w-full px-7.5 py-2.5">
                Place Order
            </button>
        </div>
    </div>

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
</x-layout.app>
