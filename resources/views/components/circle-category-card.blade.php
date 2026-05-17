@props(['name' => 'Party Wear', 'image' => 'https://placehold.co/190x190'])

<div style="width: 190px;" id="circle-category-card" {{ $attributes }}>
    <div class="overlay rounded-full relative" style="height: 190px; width: 190px; overflow: hidden;">
        <img src="https://placehold.co/190x190" class="rounded-full scale-1.1" />
    </div>

    <p class="text-center text-lg font-semibold mt-[10px]" v-text="{{ $name }}"></p>
</div>
