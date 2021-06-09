<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/user-data', [AuthController::class, 'userData']);

Route::group(['prefix' => 'users'], function () {
   Route::post('create', [UserController::class, 'create']);
   Route::put('edit/{id}', [UserController::class, 'edit']);
   Route::delete('delete/{id}', [UserController::class, 'delete']);
   Route::get('single/{id}', [UserController::class, 'single']);
   Route::get('list', [UserController::class, 'list']);
});

Route::group(['prefix' => 'categories'], function () {
    Route::post('create', [CategoryController::class, 'create']);
    Route::put('edit/{id}', [CategoryController::class, 'edit']);
    Route::delete('delete/{id}', [CategoryController::class, 'delete']);
    Route::get('single/{id}', [CategoryController::class, 'single']);
    Route::get('list', [CategoryController::class, 'list']);
});
