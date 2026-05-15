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
        <x-cart-subtotal />
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
