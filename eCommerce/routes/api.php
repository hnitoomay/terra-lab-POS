<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//api

    Route::get('product/list',[RouteController::class,'productList'])->name('product#list');
    Route::post('product/create',[RouteController::class,'productCreate'])->name('product#create');
    Route::post('product/delete',[RouteController::class,'productDelete'])->name('product#delete');
    Route::post('product/update',[RouteController::class,'productUpdate'])->name('product#update');

//localhost:8000/api/product/list
//localhost:8000/api/product/create
//localhost:8000/api/product/delete?id=20
