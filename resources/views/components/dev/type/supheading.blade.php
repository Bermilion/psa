@props([
    'text'
])
{{--All--}}
{{--font-weight: 400;--}}
{{--font-size: 12px;--}}
{{--line-height: 16px;--}}
{{--text-transform: uppercase;--}}

<p {{ $attributes->class('text-xs uppercase text-dark-grey-light') }}>{{ $text ?? $slot }}</p>
