@props(['id', 'label', 'count', 'checked' => false])

<div class="flex items-center gap-x-4 mb-4 last:mb-0">
    <input type="checkbox" id="{{ $id }}" class="opacity-0 absolute peer" {{ $checked ? 'checked' : '' }}>
    <label for="{{ $id }}" class="w-[28px] h-[28px] bg-[#F6F6F6] rounded-[6px] flex items-center justify-center cursor-pointer transition-all peer-checked:bg-transparent">
        <i class="fa-solid fa-check text-black text-[16px] opacity-0 peer-checked:opacity-100 transition-opacity"></i>
    </label>
    <label for="{{ $id }}" class="cursor-pointer text-[#555] font-poppins text-[16px] hover:text-black transition-colors">
        {{ $label }} <span class="ml-2 font-medium">({{ $count }})</span>
    </label>
</div>
