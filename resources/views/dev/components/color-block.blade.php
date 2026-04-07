@props([
    'colors' => [],
    'name' => null,
])
<div>
    @if($name)
        <h2 class="text-4xl font-thin mb-24 text-content-contrast">{{ $name }}</h2>
    @endif
    <div class="grid md:grid-cols-6 sm:grid-cols-3 gap-16 mb-6">
        @foreach ($colors as $_color)
            <div class="flex gap-y-4 flex-col">
                <div class="{{ $_color }} rounded-md w-full h-48 border border-dashed border-gray-dark"></div>
                <p class="text-xs text-dark-grey-dark">{{ substr($_color, 3) }}</p>
            </div>
        @endforeach
    </div>
</div>
