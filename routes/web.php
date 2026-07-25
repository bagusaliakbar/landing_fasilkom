<?php

use Illuminate\Support\Facades\Route;

use App\Data\FasilkomApps;

Route::get('/', function () {
    return view('welcome', [
        'apps' => FasilkomApps::getAll(),
        'categories' => FasilkomApps::getCategories(),
    ]);
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
