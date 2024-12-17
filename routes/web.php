<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

// Checkout - User
Route::middleware(['auth'])->group(function () {
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('/orders', [OrderController::class, 'userOrders'])->name('orders.index');
});

// Manage Orders - Admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/orders', [OrderController::class, 'manageOrders'])->name('admin.orders');
    Route::post('/admin/orders/{order}/approve', [OrderController::class, 'approveOrder'])->name('orders.approve');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/products/manage', [ProductController::class, 'manageProducts'])->name('products.manage');
    Route::post('/products/manage', [ProductController::class, 'manageProducts'])->name('products.manage');
    Route::get('/products/add', [ProductController::class, 'create'])->name('products.add');
    Route::get('/admin/create-admin', [AdminController::class, 'createAdminForm'])->name('admin.create-admin');
    Route::post('/admin/create-admin', [AdminController::class, 'storeAdmin'])->name('admin.store'); // Add this line
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::post('/products/add', [ProductController::class, 'store'])->name('products.store');
});



Route::get('/store', [ProductController::class, 'storePage'])->name('store.index');

// Landing Page - accessible to everyone
// Home Page
Route::get('/', function () {
    return view('landing');  // Adjust to your home page view
})->name('home');

// About Page
Route::get('about', function () {
    return view('about');  // Adjust to your About page view
})->name('about');

// Contact Page
Route::get('contact', function () {
    return view('contact');  // Adjust to your Contact page view
})->name('contact');


// Authenticated routes
Route::group(['middleware' => 'auth'], function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/billing', function () {
        return view('billing');
    })->name('billing');

    Route::get('/profile', function () {
        return view('profile');    })->name('profile');

    Route::get('/rtl', function () {
        return view('rtl');
    })->name('rtl');

    Route::get('/user-management', function () {
        return view('laravel-examples/user-management');
    })->name('user-management');

    Route::get('/tables', function () {
        return view('tables');
    })->name('tables');

    Route::get('/virtual-reality', function () {
        return view('virtual-reality');
    })->name('virtual-reality');

    Route::get('/logout', [SessionsController::class, 'destroy']);
    Route::get('/user-profile', [InfoUserController::class, 'create']);
    Route::post('/user-profile', [InfoUserController::class, 'store']);
});

// Guest routes
Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register'); // Add ->name('register')
Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create'])->name('login');
    Route::post('/session', [SessionsController::class, 'store']);
    Route::get('/login/forgot-password', [ResetController::class, 'create']);
    Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
    Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
    Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});
