@props(['color'])

<li class="color-filter-item cursor-pointer flex items-center justify-center" style="background-color: {{ $color }}; width: 30px; height: 30px; border-radius: 50%;">
    <div class="selected-color bg-white h-[12px] w-[12px] rounded-full hidden"></div>
</li>
