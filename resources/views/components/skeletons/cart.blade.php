@push('styles')
<style>
    @keyframes shimmer {
        0% {
            background-position: -200% 0;
        }
        100% {
            background-position: 200% 0;
        }
    }
    .shimmer-block {
        background: linear-gradient(90deg, #F3F3F3 25%, #EAEAEA 50%, #F3F3F3 75%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite linear;
    }
</style>
@endpush

<div class="flex justify-between items-start gap-7.5 w-full mt-5">
    <!-- Left Table Skeleton -->
    <div class="w-3/4 flex flex-col gap-5">
        <div class="rounded-md overflow-hidden border border-stroke bg-white shadow-sm">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-pinkish border-b border-stroke">
                        <th class="py-4 pl-8 text-left w-1/2">
                            <div class="h-5 w-24 shimmer-block rounded-xs"></div>
                        </th>
                        <th class="py-4 text-left">
                            <div class="h-5 w-16 shimmer-block rounded-xs"></div>
                        </th>
                        <th class="py-4 text-center">
                            <div class="h-5 w-20 shimmer-block rounded-xs mx-auto"></div>
                        </th>
                        <th class="py-4 text-center">
                            <div class="h-5 w-16 shimmer-block rounded-xs mx-auto"></div>
                        </th>
                        <th class="py-4 text-center">
                            <div class="h-5 w-12 shimmer-block rounded-xs mx-auto"></div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Row 1 -->
                    <tr class="border-b border-[#EAEAEA]">
                        <td class="flex items-center gap-4 py-6 pl-8">
                            <div class="w-20 h-20 shimmer-block rounded-md"></div>
                            <div class="flex flex-col gap-3">
                                <div class="h-5 w-48 shimmer-block rounded-xs"></div>
                                <div class="h-4 w-32 shimmer-block rounded-xs"></div>
                            </div>
                        </td>
                        <td class="py-6">
                            <div class="h-5 w-20 shimmer-block rounded-xs"></div>
                        </td>
                        <td class="py-6">
                            <div class="flex justify-center items-center gap-3">
                                <div class="h-8 w-8 shimmer-block rounded-full"></div>
                                <div class="h-8 w-12 shimmer-block rounded-md"></div>
                                <div class="h-8 w-8 shimmer-block rounded-full"></div>
                            </div>
                        </td>
                        <td class="py-6 text-center">
                            <div class="h-5 w-24 shimmer-block rounded-xs mx-auto"></div>
                        </td>
                        <td class="py-6 text-center">
                            <div class="h-8 w-8 shimmer-block rounded-full mx-auto"></div>
                        </td>
                    </tr>
                    <!-- Row 2 -->
                    <tr class="border-b border-[#EAEAEA] last:border-none">
                        <td class="flex items-center gap-4 py-6 pl-8">
                            <div class="w-20 h-20 shimmer-block rounded-md"></div>
                            <div class="flex flex-col gap-3">
                                <div class="h-5 w-36 shimmer-block rounded-xs"></div>
                                <div class="h-4 w-24 shimmer-block rounded-xs"></div>
                            </div>
                        </td>
                        <td class="py-6">
                            <div class="h-5 w-20 shimmer-block rounded-xs"></div>
                        </td>
                        <td class="py-6">
                            <div class="flex justify-center items-center gap-3">
                                <div class="h-8 w-8 shimmer-block rounded-full"></div>
                                <div class="h-8 w-12 shimmer-block rounded-md"></div>
                                <div class="h-8 w-8 shimmer-block rounded-full"></div>
                            </div>
                        </td>
                        <td class="py-6 text-center">
                            <div class="h-5 w-24 shimmer-block rounded-xs mx-auto"></div>
                        </td>
                        <td class="py-6 text-center">
                            <div class="h-8 w-8 shimmer-block rounded-full mx-auto"></div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Right Total Card Skeleton -->
    <div class="w-1/4 border border-stroke px-6 py-6 rounded-md shadow-sm bg-white">
        <div class="h-6 w-28 shimmer-block rounded-xs mb-6"></div>
        
        <div class="invoice-list flex flex-col gap-4 bg-pinkish px-5 py-5 rounded-md mb-6">
            <div class="flex justify-between items-center">
                <div class="h-4 w-16 shimmer-block rounded-xs"></div>
                <div class="h-4 w-20 shimmer-block rounded-xs"></div>
            </div>
            <div class="flex justify-between items-center border-t border-dashed border-[#EAEAEA] pt-3 mt-1">
                <div class="h-4 w-16 shimmer-block rounded-xs"></div>
                <div class="h-4 w-12 shimmer-block rounded-xs"></div>
            </div>
        </div>

        <div class="flex justify-between items-center mt-5 bg-pinkish px-6 py-4 rounded-full mb-6">
            <div class="h-4 w-12 shimmer-block rounded-xs"></div>
            <div class="h-5 w-24 shimmer-block rounded-xs"></div>
        </div>

        <div class="h-12 w-full shimmer-block rounded-full"></div>
    </div>
</div>
