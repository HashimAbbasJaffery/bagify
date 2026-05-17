@once
@push('styles')
<style>
    @keyframes shimmer {
        0% {
            background-position: -200% 0;
        }
        100% {
            background-position: 200% 0;
        }
    }
    .shimmer-block {
        background: linear-gradient(90deg, #F3F3F3 25%, #EAEAEA 50%, #F3F3F3 75%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite linear;
    }
</style>
@endpush
@endonce

<div class="product-card group relative w-full max-w-[310px] h-[450px] overflow-hidden flex flex-col justify-start items-center mx-auto">
    <!-- Image Placeholder -->
    <div class="w-full aspect-square rounded-lg border border-stroke bg-white flex items-center justify-center overflow-hidden">
        <div class="w-full h-full shimmer-block"></div>
    </div>
    
    <!-- Info Placeholder -->
    <div class="product-info flex flex-col justify-start items-center gap-[5px] mt-[15px] w-full px-4">
        <!-- Category/Type -->
        <div class="h-4 w-24 shimmer-block rounded-xs"></div>
        <!-- Title -->
        <div class="h-5 w-40 shimmer-block rounded-xs mt-1.5"></div>
        <!-- Price -->
        <div class="h-4 w-16 shimmer-block rounded-xs mt-2"></div>
    </div>
</div>
