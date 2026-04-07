@extends('dev.components.layout')
@section('title', 'Цветовая схема')

@section('content')
    <h1 class="text-6xl font-bold mb-40 text-content-contrast">Цветовая схема</h1>
    @include('dev.components.color-block', [
        'colors' => [
            'bg-accent-base',
            'bg-accent-light',
            'bg-accent-light-50',
            'bg-accent-dark',
            'bg-accent-contrast',
            'bg-accent-pale',
        ],
        'name' => 'Accent'
    ])
    @include('dev.components.color-block', [
        'colors' => [
            'bg-brand-accent',
            'bg-brand-light'
        ],
        'name' => 'Brand'
    ])
    @include('dev.components.color-block', [
        'colors' => [
            'bg-content-base',
            'bg-content-light',
            'bg-content-dark',
            'bg-content-contrast',
        ],
        'name' => 'Content'
    ])
    @include('dev.components.color-block', [
        'colors' => [
            'bg-dark-grey-light',
            'bg-dark-grey-base',
            'bg-dark-grey-dark',
        ],
        'name' => 'Dark grey'
    ])
    @include('dev.components.color-block', [
        'colors' => [
            'bg-darkest-blue',
            'bg-darkest-blue-90',
        ],
        'name' => 'Darkest'
    ])
    @include('dev.components.color-block', [
        'colors' => [
            'bg-gray-light',
            'bg-gray-light-50',
            'bg-gray-base',
            'bg-gray-dark',
            'bg-gray-contrast',
        ],
        'name' => 'Gray'
    ])
    @include('dev.components.color-block', [
        'colors' => [
            'bg-light-blue-base',
            'bg-light-blue-light',
            'bg-light-blue-dark',
        ],
        'name' => 'Light'
    ])
    @include('dev.components.color-block', [
        'colors' => [
            'bg-success-base',
            'bg-success-contrast',
            'bg-success-light',
            'bg-success-light-50',
            'bg-success-dark',
            'bg-success-pale',
        ],
        'name' => 'Success'
    ])
    @include('dev.components.color-block', [
        'colors' => [
            'bg-danger-base',
            'bg-danger-contrast',
            'bg-danger-light',
            'bg-danger-light-50',
            'bg-danger-dark',
            'bg-danger-pale',
        ],
        'name' => 'Danger'
    ])

@endsection
