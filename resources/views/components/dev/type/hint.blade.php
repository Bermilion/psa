@props([
    'text',
])

{{--font-weight: 400;--}}
{{--font-size: 12px;--}}
{{--line-height: 16px;--}}
{{--color: #999999;--}}

<p {{ $attributes->class('text-xs text-dark-grey-light') }}>{{ $text ?? $slot }}</p>
