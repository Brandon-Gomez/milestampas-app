<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VariationController;
use App\Http\Controllers\VariationOptionController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        // 'laravelVersion' => Application::VERSION,
        // 'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/products/new2024', [ProductController::class, 'getProductsNewIn2024']);

// Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/cart', [CartController::class, 'Index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
// Route::get('/cart', [CartController::class, 'get'])->name('cart.get');
// Route::post('/cart/add/', [CartController::class, 'add'])->name('add');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // produ
    Route::resource('products', ProductController::class);
    // show product
    // Route::patch('/products', [ProductController::class, 'update'])->name('products.update');
    Route::patch('/categories', [ProductController::class, 'update'])->name('categories.update');
    Route::resource('categories', CategoryController::class);
    Route::resource('variations', VariationController::class);
    Route::resource('variationOptions', VariationOptionController::class);
    Route::patch('/variationOptions', [VariationOptionController::class, 'update'])->name('variation_options.update');
});

require __DIR__.'/auth.php';
