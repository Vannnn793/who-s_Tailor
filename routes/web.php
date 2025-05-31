<?php
// routes/web.php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TailorController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\OrderController;
use App\Models\Tailor;
use Faker\Guesser\Name;

Route::get('/register', [AuthController::class, 'showRegisterForm']);
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/passworreset', [AuthController::class, 'showResetForm'])->name('passworreset');
Route::post('/passworreset', [AuthController::class, 'reset'])->name('password.reset');

// Route::middleware(['auth', 'tailor'])->group(function () {
//     Route::get('/tailor/profile', function () {
//         return view('tailor.profile.show');
//     });
//     Route::get('/tailor/edit', [TailorController::class, 'edit'])->name('tailor.profile.edit');
//     Route::post('/tailor/profile', [TailorController::class, 'update'])->name('tailor.profile.update');
//     Route::get('/tailor/profile/{id}', [TailorController::class, 'show'])->name('tailor.profile.show');
//     Route::get('/tailor/orders', [TailorController::class, 'orders'])->name('tailor.orders');
// });

    // Route::get('/checkout', function() {
    //      echo("faf");
    // })->name('cekot');


Route::middleware(['auth'])->group(function () {
//     // Dashboard penjahit
    Route::get('/profile', [TailorController::class, 'showProfilePage'])->name('profile');

    // Upload foto ke tailor_photos
    Route::get('/edit', [TailorController::class, 'edit'])->name('edit');
    Route::post('/profile', [TailorController::class, 'update'])->name('update');
    Route::get("/",function() {
    $user =User::with(['tailor'])->get();
    
    return view("welcome",compact("user"));
})->name('home');
Route::get('/tailor/{id}', [TailorController::class, 'show'])->name('show');



});
// Route::get('/profile', function () {
//     return 'profile';
// });
Route::middleware(['auth'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/del/{id}',[OrderController::class,'del'])->name('rmv');
    Route::get('/orders/{order}/payment', [OrderController::class, 'payment'])->name('orders.payment');
    Route::get('/admin/orders/{id}', [OrderController::class, 'show'])->name('admin.orders.show');
    Route::post('/midtrans/callback', [OrderController::class, 'handleCallback']);


});

use App\Http\Controllers\Admin\OrderAdminController;

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/orders', [OrderAdminController::class, 'index'])->name('admin.orders.index');
    Route::post('/admin/orders/{order}/update-status', [OrderAdminController::class, 'updateStatus'])->name('admin.orders.updateStatus');
});
