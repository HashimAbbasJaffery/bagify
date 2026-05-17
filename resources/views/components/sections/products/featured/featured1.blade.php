@php
    $featuredProduct = \App\Models\Product::with(['colors', 'sizes', 'media', 'categories'])
        ->where('is_featured', true)
        ->where('status', 'active')
        ->first() ?? \App\Models\Product::with(['colors', 'sizes', 'media', 'categories'])
        ->where('status', 'active')
        ->first();
@endphp

@if($featuredProduct)
<section id="featured1" class="pt-[50px] mb-[50px] container relative">
    <div class="featured-product flex">
        <x-products.images :images="$featuredProduct->media->pluck('url')->toArray()" />
        <div class="product-information bg-white absolute w-1/2 top-1/2 -translate-y-1/2 right-0 p-[25px] rounded-xs shadow-sm">
            <x-products.reviews />
            <div class="product-details">
                <p class="text-[32px] font-semibold w-2/3 mt-[10px]">{!! $featuredProduct->name !!}</p>
                <p class="leading-[30px] text-grey w-[550px] mt-[10px] mb-[10px]">{!! $featuredProduct->short_description !!}</p>
                <div class="product-price flex items-center gap-[20px]">
                    @if($featuredProduct->discount_percentage > 0)
                        <p class="old-price text-[25px] text-grey line-through">PKR {{ number_format($featuredProduct->price) }}</p>
                        <p class="new-price text-[42px] text-secondary font-semibold">PKR {{ number_format(round($featuredProduct->price - ($featuredProduct->price * ($featuredProduct->discount_percentage / 100)), 2)) }}</p>
                    @else
                        <p class="new-price text-[42px] text-secondary font-semibold">PKR {{ number_format($featuredProduct->price) }}</p>
                    @endif
                </div>
            </div>
            <div class="product-countdown flex mt-[20px]">
                <x-blocks.countdown type="days" />
                <x-blocks.countdown type="hrs" />
                <x-blocks.countdown type="mins" />
                <x-blocks.countdown type="secs" />
            </div>
            <button class="h-[44px] w-[179px] bg-black text-white flex items-center justify-center gap-[10px] rounded-full mt-[20px] cursor-pointer hover:bg-shade transition-colors"
                onclick="event.stopPropagation(); event.preventDefault(); window.addCardToCart({{ $featuredProduct->id }}, this, event)">
                    <img src="{{ asset('assets/images/basket-white.png') }}" />
                    Add to Cart
            </button>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Set countdown to 7 days from now
            const targetDate = new Date();
            targetDate.setDate(targetDate.getDate() + 7);

            function updateCountdown() {
                const now = new Date();
                const difference = targetDate - now;

                if (difference <= 0) {
                    clearInterval(timerInterval);
                    return;
                }

                const days = Math.floor(difference / (1000 * 60 * 60 * 24));
                const hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((difference % (1000 * 60)) / 1000);

                const daysEl = document.querySelector('.days p.font-semibold');
                const hrsEl = document.querySelector('.hrs p.font-semibold');
                const minsEl = document.querySelector('.mins p.font-semibold');
                const secsEl = document.querySelector('.secs p.font-semibold');

                if (daysEl) daysEl.textContent = String(days).padStart(2, '0');
                if (hrsEl) hrsEl.textContent = String(hours).padStart(2, '0');
                if (minsEl) minsEl.textContent = String(minutes).padStart(2, '0');
                if (secsEl) secsEl.textContent = String(seconds).padStart(2, '0');
            }

            updateCountdown();
            const timerInterval = setInterval(updateCountdown, 1000);
        });
    </script>
    @endpush
</section>
@endif


