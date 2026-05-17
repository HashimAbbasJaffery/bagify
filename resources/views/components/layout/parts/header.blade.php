<header class="container flex justify-between items-center font-poppins h-[70px]">
    <div class="logo">
        <a href="{{ route('home') }}">
            <img src="{{ asset('assets/images/logo.png') }}" />
        </a>
    </div>
    <nav class="absolute left-1/2 -translate-x-1/2">
        <ul class="flex gap-small">
            <li><a href="{{ route('home') }}" class="link-ltr">Home</a></li>
            <li><a href="{{ route('home.shop') }}" class="link-ltr">Shop</a></li>
            <li><a href="#" class="link-ltr">Products</a></li>
            <li><a href="#" class="link-ltr">Blogs</a></li>
            <li><a href="#" class="link-ltr">About Us</a></li>
            <li><a href="#" class="link-ltr">Pages</a></li>
        </ul>
    </nav>
    <div class="action-buttons flex gap-small justify-between">
        <a href="#" id="search-btn">
            <img src="{{ asset('assets/images/search.png') }}" />
        </a>
        <a href="#" id="wishlist-btn">
            <img src="{{ asset('assets/images/wishlist.png') }}" />
        </a>
        @php
            $initialCartCount = array_sum(array_column(session()->get('cart', []), 'quantity'));
        @endphp
        <a href="#" id="cart-btn" class="relative inline-block">
            <img src="{{ asset('assets/images/add-to-cart.png') }}" />
            <span 
                id="cart-count-badge" 
                class="absolute -top-1.5 -right-1.5 bg-[#8B3118] text-white text-[10px] font-bold font-poppins w-[18px] h-[18px] rounded-full flex items-center justify-center border border-white transition-all duration-300 {{ $initialCartCount > 0 ? '' : 'hidden scale-0' }}"
            >
                {{ $initialCartCount }}
            </span>
        </a>
        <a href="#">
            <img src="{{ asset('assets/images/account.png') }}" />
        </a>
    </div>
</header>