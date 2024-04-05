<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/poducts', [ProductController::class, 'show'])->name('products.show');
Route::get('/poducts/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/poducts', [ProductController::class, 'store'])->name('products.store');
Route::get('/poducts/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/poducts/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/poducts/{product}', [ProductController::class, 'destroye'])->name('products.destroye');






Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
