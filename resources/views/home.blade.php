<x-layout.app>
    @push('styles')
        <style>
            :root {
                --background-image: url('{{ asset('assets/images/cover-1.jpg') }}');
                --cover-pattern: url("{{ asset('assets/images/zigzag-pattern.png') }}")
            }
        </style>
    @endpush

    
    <x-dynamic-component :component="layout()->banner?->name" />
    
    @foreach(layout()->arrangement as $arrangement)
        <x-dynamic-component :component="$arrangement?->section?->name" />
    @endforeach

</x-layout.app>
