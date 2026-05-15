<x-layout.app>
    <x-breadcrumb />

     <div id="checkout" class="container mt-17.5 flex justify-between items-start gap-7.5">
        <div class="w-3/4 customer-information mt-5 flex flex-col gap-5">
            <div class="rounded-md overflow-hidden border border-stroke">
                <table class="w-full">
                    <tr class="bg-pinkish">
                        <th class="text-[16px] font-medium font-poppins py-3 pl-8 text-left">Product</th>
                        <th class="text-[16px] font-medium font-poppins py-3 text-left">Price</th>
                        <th class="text-[16px] font-medium font-poppins py-3">Quantity</th>
                        <th class="text-[16px] font-medium font-poppins py-3">Total</th>
                        <th class="text-[16px] font-medium font-poppins py-3">Delete</th>
                    </tr>
                    <tr class="border-b border-stroke ">
                        <td class="flex items-center gap-4 py-6 pl-8">
                            <img src="https://placehold.co/80x80" class="rounded-md">
                            <p class="text-[14px] font-semibold font-poppins">Harriette handle bag</p>
                        </td>
                        <td>
                            <p class="text-[16px] font-medium font-poppins">100 PKR</p>
                        </td>
                        <td>
                            <div class="flex justify-center gap-3.75">
                                <button class="h-11 w-11 border border-black rounded-full flex items-center justify-center">
                                    <img src="{{ asset('assets/images/black-arrow.png') }}" />
                                </button>
                                <div class="bg-pinkish h-11 w-11 border border-black rounded-full flex items-center justify-center">
                                    <p class="font-[14px] font-poppins">5</p>
                                </div>

                                <button class="h-11 w-11 border border-black rounded-full flex items-center justify-center">
                                    <img class="rotate-180" src="{{ asset('assets/images/black-arrow.png') }}" />
                                </button>
                            </div>
                        </td>
                        <td class="text-center">
                            <p class="text-[16px] font-medium font-poppins">100 PKR</p>
                        </td>
                        <td>
                            <div class="flex justify-center items-center gap-3.75">
                                <i class="fa-regular fa-trash-can text-secondary"></i>
                                <a href="#" class="font-[14px] font-poppins text-secondary">Remove</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="flex items-center gap-4 py-6 pl-8">
                            <img src="https://placehold.co/80x80" class="rounded-md">
                            <p class="text-[14px] font-semibold font-poppins">Harriette handle bag</p>
                        </td>
                        <td>
                            <p class="text-[16px] font-medium font-poppins">100 PKR</p>
                        </td>
                        <td>
                            <div class="flex justify-center gap-3.75">
                                <button class="h-11 w-11 border border-black rounded-full flex items-center justify-center">
                                    <img src="{{ asset('assets/images/black-arrow.png') }}" />
                                </button>
                                <div class="bg-pinkish h-11 w-11 border border-black rounded-full flex items-center justify-center">
                                    <p class="font-[14px] font-poppins">5</p>
                                </div>

                                <button class="h-11 w-11 border border-black rounded-full flex items-center justify-center">
                                    <img class="rotate-180" src="{{ asset('assets/images/black-arrow.png') }}" />
                                </button>
                            </div>
                        </td>
                        <td class="text-center">
                            <p class="text-[16px] font-medium font-poppins">100 PKR</p>
                        </td>
                        <td>
                            <div class="flex justify-center items-center gap-3.75">
                                <i class="fa-regular fa-trash-can text-secondary"></i>
                                <a href="#" class="font-[14px] font-poppins text-secondary">Remove</a>
                            </div>
                        </td>
                    </tr>
                </table>
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
    </div>

</x-layout.app>
