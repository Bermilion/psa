@extends('dev.components.layout')
@section('title', 'Цветовая схема')

@php
    $colorsJson = base_path('scripts/colors.json');
    $colors = file_exists($colorsJson)
        ? json_decode(file_get_contents($colorsJson), true)
        : ['grouped' => [], 'all' => [], 'meta' => []];
@endphp

@section('content')
    <x-dev.type.hero class="mb-40 md:mb-[72px]" text="Цветовая схема"/>

    @foreach($colors['grouped'] as $group => $shades)
        <x-dev.color-block :group="$group" :shades="$shades" />
    @endforeach

@endsection
