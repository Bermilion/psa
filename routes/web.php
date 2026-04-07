<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dev.pages.index');
});
Route::get('/color-theme', function () {
    return view('dev.pages.color-theme');
});
