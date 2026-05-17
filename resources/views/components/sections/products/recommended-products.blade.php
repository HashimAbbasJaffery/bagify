<x-blueprints.section
    heading="Recommended Products"
    description="We have selected suggested products optimised for you"
>
<div class="pt-[80px] flex justify-between">
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
</x-blueprints.section>