@props([
    'size' => 2,
    'mode' => null,
])
{{--h1--}}                  {{--mobile--}}
{{--font-weight: 700;--}}
{{--font-size: 48px;--}}    {{--font-size: 24px;--}}
{{--line-height: 56px;--}}  {{--line-height: 32px;--}}

{{--h2--}}                  {{--mobile--}}
{{--font-weight: 700;--}}
{{--font-size: 40px;--}}    {{--font-size: 20px;--}}
{{--line-height: 48px;--}}  {{--line-height: 24px;--}}

{{--h3--}}                  {{--mobile--}}
{{--font-weight: 700;--}}
{{--font-size: 32px;--}}    {{--font-size: 16px;--}}
{{--line-height: 40px;--}}  {{--line-height: 24px;--}}

{{--h4--}}                  {{--mobile--}}
{{--font-weight: 500;--}}
{{--font-size: 32px;--}}    {{--font-size: 24px;--}}
{{--line-height: 40px;--}}  {{--line-height: 32px;--}}

{{--h5--}}                  {{--mobile--}}
{{--font-weight: 500;--}}
{{--font-size: 24px;--}}    {{--font-size: 20px;--}}
{{--line-height: 32px;--}}  {{--line-height: 24px;--}}

{{--h6--}}
{{--font-weight: 500;--}}
{{--font-size: 16px;--}}
{{--line-height: 24px;--}}

@php
    $size = (int) $size;
    $size = max(1, min(6, $size)); // Ограничиваем размер от 1 до 6
    $tag = 'h' . $size;
    $tableSizes = [
        1 => ['lg:text-5xl', 'font-bold', 'text-3xl'],
        2 => ['lg:text-4xl', 'font-bold', 'text-2xl'],
        3 => ['lg:text-3xl', 'font-bold', 'text-base'],
        4 => ['lg:text-2xl', 'font-medium', 'text-xl'],
        5 => ['lg:text-xl', 'font-medium', 'text-lg'],
        6 => ['text-base', 'font-medium']
    ];

    // Добавляем классы из таблицы размеров
    $class = 'text-content-contrast';
    if (isset($tableSizes[$size])) {
        $class .= ' ' . implode(' ', $tableSizes[$size]);
    }
    $class = trim($class);
@endphp

<{{ $tag }} {{ $attributes->except('text')->class($class) }}>
{{ $slot }}
</{{ $tag }}>
