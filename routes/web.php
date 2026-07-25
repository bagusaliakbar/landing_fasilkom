<?php

use Illuminate\Support\Facades\Route;
use App\Data\FasilkomApps;

Route::get('/', function () {
    return view('welcome', [
        'apps' => FasilkomApps::getAll(),
        'categories' => FasilkomApps::getCategories(),
    ]);
})->name('home');
