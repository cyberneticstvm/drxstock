<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CoatingController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::prefix('/')->controller(HelperController::class)->group(function () {
    Route::get('/', 'login')->name('login');
    Route::post('/', 'signin')->name('signin');
});

Route::middleware(['web', 'auth'])->group(function () {
    Route::prefix('/')->controller(HelperController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::get('/logout', 'logout')->name('logout');
    });

    Route::prefix('/user')->controller(UserController::class)->group(function () {
        Route::get('/', 'index')->name('user.register');
        Route::get('/create', 'create')->name('user.create');
        Route::post('/create', 'store')->name('user.save');
        Route::get('/edit/{id}', 'edit')->name('user.edit');
        Route::post('/edit/{id}', 'update')->name('user.update');
        Route::get('/delete/{id}', 'destroy')->name('user.delete');
    });

    Route::prefix('/category')->controller(CategoryController::class)->group(function () {
        Route::get('/', 'index')->name('category.register');
        Route::get('/create', 'create')->name('category.create');
        Route::post('/create', 'store')->name('category.save');
        Route::get('/edit/{id}', 'edit')->name('category.edit');
        Route::post('/edit/{id}', 'update')->name('category.update');
        Route::get('/delete/{id}', 'destroy')->name('category.delete');
    });

    Route::prefix('/type')->controller(TypeController::class)->group(function () {
        Route::get('/', 'index')->name('type.register');
        Route::get('/create', 'create')->name('type.create');
        Route::post('/create', 'store')->name('type.save');
        Route::get('/edit/{id}', 'edit')->name('type.edit');
        Route::post('/edit/{id}', 'update')->name('type.update');
        Route::get('/delete/{id}', 'destroy')->name('type.delete');
    });

    Route::prefix('/material')->controller(MaterialController::class)->group(function () {
        Route::get('/', 'index')->name('material.register');
        Route::get('/create', 'create')->name('material.create');
        Route::post('/create', 'store')->name('material.save');
        Route::get('/edit/{id}', 'edit')->name('material.edit');
        Route::post('/edit/{id}', 'update')->name('material.update');
        Route::get('/delete/{id}', 'destroy')->name('material.delete');
    });

    Route::prefix('/coating')->controller(CoatingController::class)->group(function () {
        Route::get('/', 'index')->name('coating.register');
        Route::get('/create', 'create')->name('coating.create');
        Route::post('/create', 'store')->name('coating.save');
        Route::get('/edit/{id}', 'edit')->name('coating.edit');
        Route::post('/edit/{id}', 'update')->name('coating.update');
        Route::get('/delete/{id}', 'destroy')->name('coating.delete');
    });
});
