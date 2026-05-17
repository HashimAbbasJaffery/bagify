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
    #product-details-skeleton {
        transition: opacity 0.4s ease, visibility 0.4s ease;
    }
</style>
@endpush
@endonce

<div id="product-details-skeleton" class="container mx-auto py-[50px] bg-white absolute inset-x-0 top-0 z-[999] pointer-events-none">
    <div class="flex gap-[20px] flex-col lg:flex-row">
        <!-- Left Side Gallery Skeleton -->
        <div class="flex gap-[20px] w-full lg:w-auto">
            <div class="side-images w-[100px] sm:w-[150px] flex flex-col gap-[20px] flex-shrink-0">
                <div class="w-[100px] sm:w-[150px] h-[100px] sm:h-[150px] shimmer-block rounded-[8px]"></div>
                <div class="w-[100px] sm:w-[150px] h-[100px] sm:h-[150px] shimmer-block rounded-[8px]"></div>
                <div class="w-[100px] sm:w-[150px] h-[100px] sm:h-[150px] shimmer-block rounded-[8px]"></div>
            </div>
            <div class="main-image w-full lg:w-[680px] aspect-[688/690] shimmer-block rounded-xs border border-[#EAEAEA]"></div>
        </div>

        <!-- Right Side Purchase Details Skeleton -->
        <div class="product-data flex-1 pl-0 lg:pl-[40px] flex flex-col justify-between">
            <div class="product-data-header flex gap-[15px] justify-between">
                <div class="h-10 w-24 shimmer-block rounded-full"></div>
                <div class="h-10 w-32 shimmer-block rounded-full"></div>
            </div>
            
            <div class="h-6 w-36 shimmer-block rounded-xs mt-[15px]"></div>
            
            <div class="product-info mt-6 flex flex-col gap-3">
                <div class="h-9 w-3/4 shimmer-block rounded-xs"></div>
                <div class="h-4 w-full shimmer-block rounded-xs mt-2"></div>
                <div class="h-4 w-5/6 shimmer-block rounded-xs"></div>
                <div class="h-10 w-44 shimmer-block rounded-xs mt-4"></div>
            </div>

            <!-- Size & Color Selection Skeleton -->
            <div class="product-selection mt-6 border-y border-stroke py-6 flex flex-col sm:flex-row gap-6">
                <div class="w-full sm:w-1/2 sm:pr-8">
                    <div class="h-5 w-16 shimmer-block rounded-xs mb-4"></div>
                    <div class="flex gap-3">
                        <div class="h-12 w-12 shimmer-block rounded-xs"></div>
                        <div class="h-12 w-12 shimmer-block rounded-xs"></div>
                        <div class="h-12 w-12 shimmer-block rounded-xs"></div>
                    </div>
                </div>
                <div class="w-full sm:w-1/2 sm:pl-8 sm:border-l border-stroke">
                    <div class="h-5 w-16 shimmer-block rounded-xs mb-4"></div>
                    <div class="flex gap-4">
                        <div class="h-10 w-10 shimmer-block rounded-full"></div>
                        <div class="h-10 w-10 shimmer-block rounded-full"></div>
                        <div class="h-10 w-10 shimmer-block rounded-full"></div>
                    </div>
                </div>
            </div>

            <!-- Actions Skeleton -->
            <div class="product-actions mt-6 flex flex-col md:flex-row items-center gap-6">
                <div class="flex items-center gap-5">
                    <div class="h-11 w-11 shimmer-block rounded-full"></div>
                    <div class="h-11 w-11 shimmer-block rounded-full"></div>
                    <div class="h-11 w-11 shimmer-block rounded-full"></div>
                </div>
                <div class="h-11 flex-1 min-w-[160px] shimmer-block rounded-full"></div>
                <div class="flex gap-4">
                    <div class="h-11 w-11 shimmer-block rounded-full"></div>
                    <div class="h-11 w-11 shimmer-block rounded-full"></div>
                </div>
            </div>

            <div class="product-buy mt-6 flex gap-4">
                <div class="h-11 w-11 shimmer-block rounded-full"></div>
                <div class="h-11 flex-1 shimmer-block rounded-full"></div>
            </div>
        </div>
    </div>

    <!-- Related Products Skeleton at the bottom -->
    <div class="mt-20 pt-16 border-t border-stroke w-full">
        <!-- Heading placeholders -->
        <div class="h-8 w-64 shimmer-block rounded-xs mb-3 mx-auto lg:mx-0"></div>
        <div class="h-4 w-96 shimmer-block rounded-xs mb-10 mx-auto lg:mx-0"></div>

        <!-- Skeletons matching shop grid -->
        <div class="products grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-[36px]">
            <x-skeletons.card />
            <x-skeletons.card />
            <x-skeletons.card />
            <x-skeletons.card />
        </div>
    </div>
</div>
