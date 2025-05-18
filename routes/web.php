<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\ZoneController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/countries', [CountryController::class, 'store'])->name('countries.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/countries', [CountryController::class, 'index'])->name('countries.index');
    Route::post('/countries', [CountryController::class, 'store'])->name('countries.store');
    Route::post('/dashboard/countries/{id}', [CountryController::class, 'update'])->name('countries.update');
});

// Route::resource('cities', \App\Http\Controllers\CityController::class);
Route::resource('cities', CityController::class);

Route::resource('districts', DistrictController::class);
Route::resource('zones', ZoneController::class);

route::resource('customers', \App\Http\Controllers\CustomerController::class);



require __DIR__.'/auth.php';
