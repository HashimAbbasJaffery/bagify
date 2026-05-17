<x-layout.app>
    <x-breadcrumb />

    <div class="container mx-auto py-16 px-4">
        <!-- Success Header -->
        <div class="flex flex-col items-center justify-center text-center mb-12">
            <div class="w-20 h-20 bg-green-50 rounded-full border border-green-200 flex items-center justify-center mb-6 animate-pulse">
                <i class="fa-solid fa-check text-[36px] text-green-600"></i>
            </div>
            <h1 class="text-[32px] font-poppins font-bold text-black leading-tight">Order Placed Successfully!</h1>
            <p class="text-grey font-poppins text-[16px] mt-2 max-w-[500px]">
                Thank you for shopping with Bagify! Your order has been registered and is currently being prepared for shipping.
            </p>
        </div>

        <!-- Receipt Information Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
            <!-- Order Number -->
            <div class="bg-pinkish border border-stroke p-6 rounded-md flex flex-col justify-center items-center text-center shadow-xs">
                <span class="text-grey font-poppins text-[13px] uppercase tracking-wider font-semibold">Order Number</span>
                <span class="text-black font-poppins text-[18px] font-bold mt-2">{{ $order['order_number'] }}</span>
            </div>
            <!-- Order Date -->
            <div class="bg-pinkish border border-stroke p-6 rounded-md flex flex-col justify-center items-center text-center shadow-xs">
                <span class="text-grey font-poppins text-[13px] uppercase tracking-wider font-semibold">Order Date</span>
                <span class="text-black font-poppins text-[18px] font-bold mt-2">{{ $order['date'] }}</span>
            </div>
            <!-- Total Cost -->
            <div class="bg-pinkish border border-stroke p-6 rounded-md flex flex-col justify-center items-center text-center shadow-xs">
                <span class="text-grey font-poppins text-[13px] uppercase tracking-wider font-semibold">Total Amount</span>
                <span class="text-secondary font-poppins text-[18px] font-bold mt-2">PKR {{ number_format($order['total'], 2) }}</span>
            </div>
            <!-- Payment Method -->
            <div class="bg-pinkish border border-stroke p-6 rounded-md flex flex-col justify-center items-center text-center shadow-xs">
                <span class="text-grey font-poppins text-[13px] uppercase tracking-wider font-semibold">Payment Method</span>
                <span class="text-black font-poppins text-[18px] font-bold mt-2">Cash on Delivery</span>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row justify-between items-stretch gap-10">
            <!-- Order Summary Items Details -->
            <div class="w-full lg:w-2/3 border border-stroke rounded-md p-6 bg-white shadow-xs">
                <h2 class="text-[20px] font-poppins font-semibold text-black mb-6 pb-4 border-b border-stroke"><i class="fa-solid fa-cubes mr-2"></i>Ordered Items</h2>
                <div class="flex flex-col gap-5">
                    @foreach($order['items'] as $item)
                        <div class="flex items-center gap-5 pb-5 border-b border-[#EAEAEA] last:border-none last:pb-0">
                            <img src="{{ $item['image'] }}" class="w-16 h-16 object-cover rounded-md border border-stroke shadow-xs" alt="{{ $item['name'] }}">
                            <div class="flex-1">
                                <h4 class="font-poppins text-[15px] font-semibold text-black leading-tight">{{ $item['name'] }}</h4>
                                <p class="text-[12px] text-grey font-poppins mt-1">
                                    @if(!empty($item['color'])) <span class="mr-3">Color: <span class="text-black font-semibold">{{ $item['color'] }}</span></span> @endif
                                    @if(!empty($item['size'])) <span>Size: <span class="text-black font-semibold">{{ $item['size'] }}</span></span> @endif
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="font-poppins text-[14px] text-grey">Qty: <span class="text-black font-semibold">{{ $item['quantity'] }}</span></p>
                                <p class="font-poppins text-[15px] font-bold text-black mt-1">PKR {{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Shipping/Billing & Invoice Summary -->
            <div class="w-full lg:w-1/3 flex flex-col gap-6">
                <!-- Shipping Address -->
                <div class="border border-stroke rounded-md p-6 bg-white shadow-xs">
                    <h2 class="text-[20px] font-poppins font-semibold text-black mb-4 pb-4 border-b border-stroke"><i class="fa-solid fa-truck-ramp-box mr-2"></i>Shipping Address</h2>
                    <div class="font-poppins text-[14px] text-grey flex flex-col gap-2.5">
                        <p class="font-semibold text-black text-[15px]">{{ $order['billing']['first_name'] }} {{ $order['billing']['last_name'] }}</p>
                        <p>{{ $order['billing']['street_address'] }}</p>
                        <p>{{ $order['billing']['city'] }}, {{ $order['billing']['postcode'] }}</p>
                        <p>{{ $order['billing']['country'] }}</p>
                        <p class="mt-2.5 pt-2.5 border-t border-[#EAEAEA]"><i class="fa-solid fa-phone mr-1.5 text-black"></i>{{ $order['billing']['phone'] }}</p>
                        <p><i class="fa-solid fa-envelope mr-1.5 text-black"></i>{{ $order['billing']['email'] }}</p>
                    </div>
                </div>

                <!-- Action Button -->
                <a href="{{ route('home.shop') }}" class="bg-black hover:bg-shade transition-colors text-white font-poppins text-[15px] font-semibold py-4 rounded-full w-full text-center shadow-md block">
                    <i class="fa-solid fa-bag-shopping mr-2"></i>Continue Shopping
                </a>
            </div>
        </div>
    </div>
</x-layout.app>
