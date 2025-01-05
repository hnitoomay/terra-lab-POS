<?php

use App\Http\Controllers\API\RouteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialAuthController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

require_once __DIR__.'/admin.php';
require_once __DIR__.'/user.php';

Route::redirect('/','login');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/auth/{provider}/redirect', [SocialAuthController::class,'redirect'])->name('socialprovider');

Route::get('/auth/{provider}/callback', [SocialAuthController::class,'callback']);





