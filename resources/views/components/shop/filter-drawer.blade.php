<div id="filter-overlay" class="drawer-overlay"></div>
<div id="filter-drawer" class="filter-drawer px-[40px] py-6 custom-scrollbar">
    <x-shop.filter-section title="Filters">
        <x-slot name="header_action">
            <button id="close-filter-drawer"><i class="fa-solid fa-xmark font-[14pt]"></i></button>
        </x-slot>
    </x-shop.filter-section>

    <x-shop.filter-section title="Categories">
        <ul id="categories-list" class="h-[300px] overflow-y-scroll custom-scrollbar flex flex-col gap-y-[10px]">
            <li class="category-item font-[14pt] font-poppins"><a href="#"> <span class="text-grey mr-2">All</span> (85)</a></li>
            <li class="category-item font-[14pt] font-poppins"><a href="#"> <span class="text-grey mr-2">Handbags</span> (15)</a></li>
            <li class="category-item font-[14pt] font-poppins"><a href="#"> <span class="text-grey mr-2">Backpacks</span> (20)</a></li>
            <li class="category-item font-[14pt] font-poppins"><a href="#"> <span class="text-grey mr-2">Crossbody Bags</span> (10)</a></li>
            <li class="category-item font-[14pt] font-poppins"><a href="#"> <span class="text-grey mr-2">Wallets</span> (5)</a></li>
            <li class="category-item font-[14pt] font-poppins"><a href="#"> <span class="text-grey mr-2">Totes</span> (12)</a></li>
            <li class="category-item font-[14pt] font-poppins"><a href="#"> <span class="text-grey mr-2">All</span> (85)</a></li>
            <li class="category-item font-[14pt] font-poppins"><a href="#"> <span class="text-grey mr-2">Handbags</span> (15)</a></li>
            <li class="category-item font-[14pt] font-poppins"><a href="#"> <span class="text-grey mr-2">Backpacks</span> (20)</a></li>
            <li class="category-item font-[14pt] font-poppins"><a href="#"> <span class="text-grey mr-2">Crossbody Bags</span> (10)</a></li>
            <li class="category-item font-[14pt] font-poppins"><a href="#"> <span class="text-grey mr-2">Wallets</span> (5)</a></li>
            <li class="category-item font-[14pt] font-poppins"><a href="#"> <span class="text-grey mr-2">Totes</span> (12)</a></li>
        </ul>
    </x-shop.filter-section>

    <x-shop.filter-section title="filter by color">
        <ul id="color-list" class="flex flex-wrap gap-[10px] gap-y-[20px]">
            <x-shop.color-item color="#8DB4A2" />
            <x-shop.color-item color="#5D4037" />
            <x-shop.color-item color="#C6913B" />
            <x-shop.color-item color="#4A4E69" />
            <x-shop.color-item color="#F8BBD0" />
            <x-shop.color-item color="#333333" />
            <x-shop.color-item color="#014F86" />
            <x-shop.color-item color="#FF5252" />
            <x-shop.color-item color="#6B8E23" />
            <x-shop.color-item color="#2ECC71" />
            <x-shop.color-item color="#4CC9F0" />
            <x-shop.color-item color="#A67C52" />
            <x-shop.color-item color="#0B3D2E" />
            <x-shop.color-item color="#FFF3E0" />
            <x-shop.color-item color="#B39DDB" />
            <x-shop.color-item color="#A9D6E5" />
            <x-shop.color-item color="#D1FFD1" />
            <x-shop.color-item color="#FFD1DC" />
        </ul>
    </x-shop.filter-section>

    <x-shop.filter-section title="Size">
        <ul id="size-list" class="flex flex-wrap gap-[10px]">
            <x-shop.size-item label="S" />
            <x-shop.size-item label="M" />
            <x-shop.size-item label="L" />
            <x-shop.size-item label="XL" />
            <x-shop.size-item label="XXL" />
        </ul>
    </x-shop.filter-section>

    <x-shop.filter-section title="Availability">
        <x-shop.checkbox-item id="in-stock" label="In Stock" count="05" checked="true" />
        <x-shop.checkbox-item id="out-of-stock" label="Out of Stock" count="35" />
    </x-shop.filter-section>

    <x-shop.filter-section title="Price">
        <div class="flex flex-col gap-y-[15px] mb-[25px]">
            <a href="#" class="text-[#555] font-poppins text-[16px] hover:text-black transition-colors">$100.00 & Under</a>
            <a href="#" class="text-[#555] font-poppins text-[16px] hover:text-black transition-colors">$100.00 - $299.00</a>
            <a href="#" class="text-[#555] font-poppins text-[16px] hover:text-black transition-colors">$300.00 - $999.00</a>
            <a href="#" class="text-[#555] font-poppins text-[16px] hover:text-black transition-colors">$700.00 - $6,999.00</a>
            <a href="#" class="text-[#555] font-poppins text-[16px] hover:text-black transition-colors">$6,999.00 & Over</a>
        </div>
        <div class="flex items-center justify-end gap-x-3">
            <button class="bg-black text-white h-[50px] px-8 rounded-full font-poppins text-[16px] cursor-pointer hover:bg-shade transition-colors">Go</button>
        </div>
    </x-shop.filter-section>
</div>
