<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;

Route::group(['prefix' => 'admin','middleware'=>'admin'],function(){
    Route::get('home',[AdminController::class,'home'])->name('admin#home');
    Route::get('user/list',[AdminController::class,'userList'])->name('admin#userlist');
    Route::get('sale/list',[AdminController::class,'saleList'])->name('admin#sale');
    Route::get('contact/list',[AdminController::class,'contactList'])->name('admin#contact');

    Route::group(['prefix'=>'category'], function(){
        Route::get('list',[CategoryController::class,'categoryList'])->name('category#list');
        Route::post('create',[CategoryController::class,'categoryCreate'])->name('category#create');
        Route::get('delete/{id}',[CategoryController::class,'categoryDelete'])->name('category#delete');
        Route::get('edit/{id}',[CategoryController::class,'categoryEdit'])->name('category#edit');
        Route::post('update/{id}',[CategoryController::class,'categoryUpdate'])->name('category#update');
    });

    Route::group(['prefix' => 'profile'], function(){
        Route::get('password',[ProfileController::class,'Password'])->name('password');
        Route::post('change',[ProfileController::class,'passwordChange'])->name('password#change');
        Route::get('account',[ProfileController::class,'accountInfo'])->name('account');
        Route::get('edit',[ProfileController::class,'accountEdit'])->name('account#edit');
        Route::post('update',[ProfileController::class,'accountUpdate'])->name('account#update');

        Route::group(['middleware' => 'superadmin'], function(){
            Route::get('add/adminJr',[ProfileController::class,'adminJr'])->name('admin#jr');
            Route::post('add/adminJr/create',[ProfileController::class,'adminJrCreate'])->name('adminJr#create');
            Route::get('adminJr/list',[ProfileController::class,'adminJrList'])->name('adminJr#list');
            Route::get('adminJr/delete/{id}',[ProfileController::class,'adminJrDelete'])->name('adminJr#Delete');
        });

    });

    Route::group(['prefix' => 'product'],function(){
        Route::get('form',[ProductController::class,'createForm'])->name('product#form');
        Route::get('list/{amt?}',[ProductController::class,'productList'])->name('product#list');
        Route::post('create',[ProductController::class,'productCreate'])->name('product#create');
        Route::get('delete/{id}',[ProductController::class,'productDelete'])->name('product#delete');
        Route::get('edit/{id}',[ProductController::class,'productEdit'])->name('product#edit');
        Route::post('update/{id}',[ProductController::class,'productUpdate'])->name('product#update');
    });

    Route::group(['prefix' => 'payment'],function(){
        Route::get('list',[PaymentController::class,'paymentList'])->name('payment#list');
        Route::post('create',[PaymentController::class,'paymentCreate'])->name('payment#create');
        Route::get('delete/{id}',[PaymentController::class,'paymentDelete'])->name('payment#delete');
    });

    Route::group(['prefix' => 'order'],function(){
        Route::get('list',[OrderController::class,'orderList'])->name('adminorder#list');
        Route::get('detail/{ordercode}',[OrderController::class,'orderDetail'])->name('adminorder#detail');
        Route::get('status',[OrderController::class,'orderStatus'])->name('order#status'); //ajax
        Route::get('confirm',[OrderController::class,'orderConfirm'])->name('order#confirm');
        Route::get('reject',[OrderController::class,'orderReject'])->name('order#reject');
    });



});
