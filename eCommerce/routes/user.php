<?php

use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'user','middleware'=>'user'],function(){
    Route::get('home',[UserController::class,'home'])->name('user#home');

    Route::get('contact',[UserController::class,'contact'])->name('user#contact');
    Route::post('contact/create',[UserController::class,'contactCreate'])->name('contact#create');

    Route::group(['prefix'=>'profile'],function(){
        Route::get('/',[ProfileController::class,'userProfile'])->name('user#profile');
        Route::get('edit',[ProfileController::class,'edit'])->name('user#edit');
        Route::post('update/{id}',[ProfileController::class,'update'])->name('user#update');
        Route::get('password',[ProfileController::class,'password'])->name('user#password');
        Route::post('password/update',[ProfileController::class,'passwordUpdate'])->name('password#update');
    });
    Route::group(['prefix'=>'product'],function(){
        Route::get('detail/{id}',[ProductController::class,'productDetail'])->name('product#detail');
        Route::post('addCart',[UserController::class,'addToCart'])->name('addtocart');

        Route::get('cart',[UserController::class,'cartPage'])->name('cart#page');
        Route::get('cartDelete',[UserController::class, 'cartDelete'])->name('cart#delete');
        Route::get('cart/tempo',[UserController::class,'cartTempo'])->name('cart#tempo');

        Route::get('payment',[UserController::class,'payment'])->name('user#payment');
        Route::post('order',[UserController::class,'orderCreate'])->name('order#create');
        Route::get('order/list',[UserController::class,'orderList'])->name('order#list');

        Route::post('review',[UserController::class,'reviewCreate'])->name('review#create');
        Route::post('rating',[UserController::class,'ratingCreate'])->name('rating#create');
        Route::get('review/delete/{id}',[UserController::class,'reviewDelete'])->name('review#delete');
    });
});
