@extends('dev.components.layout')
@section('title', 'Цветовая схема')

@php
    $colorsJson = base_path('scripts/colors.json');
    $colors = file_exists($colorsJson)
        ? json_decode(file_get_contents($colorsJson), true)
        : ['grouped' => [], 'all' => [], 'meta' => []];
@endphp

@section('content')
    <h1 class="text-6xl font-bold mb-40 text-content-contrast">Цветовая схема</h1>
    @foreach($colors['grouped'] as $group => $shades)
        <x-color-block :group="$group" :shades="$shades" />
    @endforeach

@endsection
