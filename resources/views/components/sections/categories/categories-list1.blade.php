<x-blueprints.section
    heading="Latest Category"
    description="Shop the latest products from the most popular collections"
    prevId="cat-prev"
    nextId="cat-next"
>
    <div id="category-slider" class="categories flex flex-nowrap gap-[36px] pt-[80px] overflow-hidden scrollbar-hide">
        @php
            $categories = [
                ['image' => 'bag1.jpg', 'name' => 'Business Bags'],
                ['image' => 'bag2.jpg', 'name' => 'Vacation Bags'],
                ['image' => 'bag3.jpg', 'name' => 'Atheletes Bags'],
                ['image' => 'bag4.jpg', 'name' => 'Office Bags'],
                ['image' => 'bag1.jpg', 'name' => 'Travel Bags'],
                ['image' => 'bag2.jpg', 'name' => 'Luxury Bags'],
                ['image' => 'bag3.jpg', 'name' => 'Weekend Bags'],
                ['image' => 'bag4.jpg', 'name' => 'Handmade Bags'],
            ];
        @endphp

        {{-- Triple the items to ensure seamless looping in both directions --}}
        @foreach(array_merge($categories, $categories, $categories) as $item)
            <x-blocks.category-card 
                image="{{ asset('assets/images/' . $item['image']) }}"
                category="{{ $item['name'] }}"
            />
        @endforeach
    </div>
</x-blueprints.section>