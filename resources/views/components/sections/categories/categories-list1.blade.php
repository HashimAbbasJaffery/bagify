<x-blueprints.section
    heading="Latest Category"
    description="Shop the latest products from the most popular collections"
>
       <div class="categories flex flex-wrap gap-[36px] pt-[80px]">
        <x-blocks.category-card 
            image="{{ asset('assets/images/bag1.jpg') }}"
            category="Business Bags"
        />
        <x-blocks.category-card 
            image="{{ asset('assets/images/bag2.jpg') }}"
            category="Vacation Bags"
        />
        <x-blocks.category-card 
            image="{{ asset('assets/images/bag3.jpg') }}"
            category="Atheletes Bags"
        />
        <x-blocks.category-card 
            image="{{ asset('assets/images/bag4.jpg') }}"
            category="Office Bags"
        />
    </div>
</x-blueprints.section>