@props([
    'text'
])
{{--All--}}                 {{--Mobile--}}
{{--font-weight: 700;--}}
{{--font-size: 64px;--}}    {{--font-size: 32px;--}}
{{--line-height: 72px;--}}  {{--line-height: 40px;--}}

<h2 {{ $attributes->class('text-4xl md:text-6xl font-bold') }}>{{ $text ?? $slot }}</h2>
