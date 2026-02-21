<section id="latest-category1" class="container pt-[50px] mb-[50px]">
    <div class="category-header flex justify-between">
        <div class="section-info">
            <h1 class="text-[32px] font-semibold">{{ $heading }}</h1>
            <p class="text-grey mt-[10px]">{{ $description }}</p>
        </div>
        <div class="action-buttons flex gap-[20px] items-end">
            <div class="back-button">
                <button class="border border-black rounded-full h-[44px] w-[44px]">
                    <img class="mx-auto" src="{{ asset('assets/images/black-arrow.png') }}" />
                </button>
            </div>
            <div class="next-button">
                <button class="bg-black h-[44px] w-[44px] rounded-full">
                    <img class="mx-auto" src="{{ asset('assets/images/white-arrow.png') }}" />
                </button>
            </div>
        </div>
    </div>
    {{ $slot }}
</section>