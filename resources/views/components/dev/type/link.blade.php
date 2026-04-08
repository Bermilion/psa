@props([
    'href' => '#',
    'text' => null,
    'variant' => 'light'
])

<a href="{{ $href }}"
   class="text-accent-base
   {{ $variant === 'light' ? 'hover:text-accent-light' : 'hover:text-content-contrast' }}
   transition-colors
   duration-300
   text-lg"
>
    {{ $text ?? $slot }}
</a>
