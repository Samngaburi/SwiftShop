<?php
require __DIR__.'/auth.php';
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;


use App\Models\Product;
use Illuminate\Http\Request;



// Public Home Page
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout.index');

Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/order/process', [CartController::class, 'processOrder'])->name('order.process');
Route::get('/payment', [CartController::class, 'payment'])->name('payment.index');
Route::get('/order-success', [CartController::class, 'orderSuccess'])->name('order.success');



// Protected Admin Area
Route::middleware(['auth'])->group(function () {
    
    // 1. ADD THIS LINE: It catches the "empty" /admin and sends it to the dashboard
   // Place this right above your middleware group
Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
})->middleware('auth');

    // 2. Your existing dashboard route
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Inventory Route - Now pointing to showInventory
    Route::get('/inventory', [AdminController::class, 'showInventory'])->name('admin.inventory');
    
    // Store Route
    Route::post('/inventory', [AdminController::class, 'store'])->name('admin.store');
    });
});

