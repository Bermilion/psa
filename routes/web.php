<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dev', function () {
    return view('dev.pages.index');
});
Route::get('/dev/{page}', function ($page) {
    return view('dev.pages.' . $page);
})->where('page', '.*');
