@props(['title'])

<div {{ $attributes->merge(['class' => 'mb-[40px] border-b border-stroke pb-[30px] last:mb-0 last:border-b-0']) }}>
    <div class="flex justify-between items-center">
        <h3 class="font-semibold text-[20px] font-poppins capitalize">{{ $title }}</h3>
        {{ $header_action ?? '' }}
    </div>
    @if($slot->isNotEmpty())
        <div class="mt-[20px]">
            {{ $slot }}
        </div>
    @endif
</div>
