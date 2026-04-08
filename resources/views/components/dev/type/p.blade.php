@props([
    'text' => null
])

{{--font-weight: 400;--}}
{{--font-size: 16px;--}}
{{--line-height: 24px;--}}

<p {{ $attributes->class('text-base text-dark-grey-dark') }}>
    {{ $text ?? $slot }}
</p>
