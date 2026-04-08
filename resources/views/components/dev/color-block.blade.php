@props([
    'group',
    'shades'
])
<div class="mb-6">
    <h2 class="text-4xl font-thin mb-24 text-content-contrast">{{ $group }}</h2>
    <div class="grid lg:grid-cols-6 md:grid-cols-4 sm:grid-cols-3 gap-16">
        @foreach($shades as $shade => $hex)
            <div class="flex gap-y-4 flex-col relative">
                <div class="{{ $shade }} rounded-md w-full h-48 border border-dashed border-gray-dark"></div>
                <p class="text-xs text-dark-grey-dark font-bold">{{ substr($shade, 3) }}</p>
                <p class="text-xs text-dark-grey-dark bg-white border solid border-gray-dark rounded-md p-2 w-fit absolute top-4 left-4">{{ $hex }}</p>
            </div>
        @endforeach
    </div>
</div>
