@props([
    'images' => []
])
<div class="product-images flex">
    <div class="side-images w-[150px] flex flex-col gap-[30px]">
        @foreach($images as $img)
            <div class="side-image">
                <img src="{{ $img }}" class="rounded-xs border border-stroke hover:border-primary transition-all cursor-pointer w-[150px] h-[150px] object-cover" onclick="document.getElementById('featured-main-img').src = this.src" />
            </div>
        @endforeach
    </div>
    <div class="main-image px-[30px] flex-1">
        <img id="featured-main-img" src="{{ $images[0] ?? asset('assets/images/product.png') }}" class="rounded-xs w-[688px] h-[690px] object-cover">
    </div>
</div>
