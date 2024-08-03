<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserRequestController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishListController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;

use App\Models\Product;
use App\Models\Category;






Route::fallback(function () {
    return view('notfound');
});


Route::get('/', function () {
    $products = Product::all();
    $categories = Category::all();

    return view('welcome', compact('products', 'categories'));
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $products = Product::all();
        $categories = Category::all();
        return view('dashboard', compact('products', 'categories'));
    })->name('dashboard');
});


Route::resource('categories', CategoryController::class); 
Route::resource('products_admin', ProductController::class); 
Route::resource('products', UserRequestController::class); 

Route::get('/detailes/{id}', [UserRequestController::class, 'detailes']);

Route::post('/addtocart/{id}', [CartController::class, 'addtocart'])->name('addtocart');
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::patch('update-cart', [CartController::class, 'update'])->name('update_cart');
Route::delete('remove-from-cart', [CartController::class, 'remove'])->name('remove_from_cart');

Route::post('/session', [StripeController::class, 'session'])->name('session');
Route::get('/success', [StripeController::class, 'success'])->name('success');
Route::get('/cancel', [StripeController::class, 'cancel'])->name('cancel');

Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/checkout', [CheckoutController::class, 'showCheckoutForm'])->name('checkout.form');
    Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders');
    Route::patch('/admin/orders/{order}', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
});