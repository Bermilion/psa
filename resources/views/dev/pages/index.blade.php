@extends('dev.components.layout')
@section('title', 'Основная страница разработки')

@section('content')
    <x-dev.type.hero class="mb-40 md:mb-[72px]" text="Руководство по разработке"/>
    <ul>
        <li>
            <x-dev.type.link href="{{ asset('/dev/color-theme') }}" text="Цветовая схема проекта" />
        </li>
        <li>
            <x-dev.type.link href="{{ asset('/dev/typography') }}" text="Типографика" />
        </li>
    </ul>

@endsection
