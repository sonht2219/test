<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ManufacturerController;
use App\Http\Controllers\Admin\ManufacturingCountryController;
use App\Http\Controllers\Admin\UnitController;
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

Route::group(['prefix' => 'manufacturers'], function () {
    Route::post('create', [ManufacturerController::class, 'create']);
    Route::put('edit/{id}', [ManufacturerController::class, 'edit']);
    Route::delete('delete/{id}', [ManufacturerController::class, 'delete']);
    Route::get('single/{id}', [ManufacturerController::class, 'single']);
    Route::get('list', [ManufacturerController::class, 'list']);
});

Route::group(['prefix' => 'manufacturing_countries'], function () {
    Route::post('create', [ManufacturingCountryController::class, 'create']);
    Route::put('edit/{id}', [ManufacturingCountryController::class, 'edit']);
    Route::delete('delete/{id}', [ManufacturingCountryController::class, 'delete']);
    Route::get('single/{id}', [ManufacturingCountryController::class, 'single']);
    Route::get('list', [ManufacturingCountryController::class, 'list']);
});

Route::group(['prefix' => 'units'], function () {
    Route::post('create', [UnitController::class, 'create']);
    Route::put('edit/{id}', [UnitController::class, 'edit']);
    Route::delete('delete/{id}', [UnitController::class, 'delete']);
    Route::get('single/{id}', [UnitController::class, 'single']);
    Route::get('list', [UnitController::class, 'list']);
});

Route::group(['prefix' => 'attributes'], function () {
    Route::post('create', [AttributeController::class, 'create']);
    Route::put('edit/{id}', [AttributeController::class, 'edit']);
    Route::delete('delete/{id}', [AttributeController::class, 'delete']);
    Route::get('single/{id}', [AttributeController::class, 'single']);
    Route::get('list', [AttributeController::class, 'list']);
});
