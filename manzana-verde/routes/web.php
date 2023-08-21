<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/{patchMatch}', function () {
    return view('welcome');
})->where('patchMatch', '.*');

