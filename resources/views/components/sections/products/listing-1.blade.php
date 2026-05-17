<section id="productListing1" class="text-center container mb-[15px] pt-[50px] mb-[50px]">
    <h1 class="text-[32px] font-semibold mb-[10px]">Mega Best Deal</h1>
    <p class="text-[18px] text-grey mb-[100px]">Shop the latest products from the most popular collections</p>
    <div class="products flex flex-wrap gap-[36px]">
        @foreach($products as $product)
            <x-blocks.card
                :id="$product->id"
                :name="$product->name"
                :price="number_format($product->price)"
                :type="$product->short_description"
                :image="$product->media->first()?->url ?? asset('assets/images/product.png')"
                :slug="'\'' . $product->slug . '\''"
            />
        @endforeach
    </div>
</section>