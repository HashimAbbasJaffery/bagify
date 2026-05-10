<div id="breadcrumb" class="bg-pinkish p-2">
    <div class="container flex gap-3">
        @foreach (explode(".", request()->route()->getName()) as $routeLevel)

            <a href="#" class="text-lg font-poppins text-grey capitalize">{{ $routeLevel }}</a>

            @if(!$loop->last)
                <a href="#" class="text-lg font-poppins text-grey">&gt;</a>
            @endif
        @endforeach
    </div>
</div>
