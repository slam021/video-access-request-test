<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pages\RoleController;
use App\Http\Controllers\Pages\UserController;
use App\Http\Controllers\Pages\VideoController;
use App\Http\Controllers\Pages\CustomerController;
use App\Http\Controllers\Pages\VideoAccessRequestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::prefix('role')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('role.index')->middleware(['adminAble']);
        Route::get('/create', [RoleController::class, 'create'])->name('role.create')->middleware(['adminAble']);
        Route::post('/store', [RoleController::class, 'store'])->name('role.store')->middleware(['adminAble']);
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('role.edit')->middleware(['adminAble']);
        Route::post('/update/{id}', [RoleController::class, 'update'])->name('role.update')->middleware(['adminAble']);
        Route::delete('/delete/{id}', [RoleController::class, 'delete'])->name('role.delete')->middleware(['adminAble']);
    });

    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index')->middleware(['adminAble']);
        Route::get('/create', [UserController::class, 'create'])->name('user.create')->middleware(['adminAble']);
        Route::post('/store', [UserController::class, 'store'])->name('user.store')->middleware(['adminAble']);
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit')->middleware(['adminAble']);
        Route::post('/update/{id}', [UserController::class, 'update'])->name('user.update')->middleware(['adminAble']);
        Route::delete('/delete/{id}', [UserController::class, 'delete'])->name('user.delete')->middleware(['adminAble']);
    });

    Route::prefix('customer')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('customer.index')->middleware(['adminAble']);
        Route::get('/create', [CustomerController::class, 'create'])->name('customer.create')->middleware(['adminAble']);
        Route::post('/store', [CustomerController::class, 'store'])->name('customer.store')->middleware(['adminAble']);
        Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit')->middleware(['adminAble']);
        Route::post('/update/{id}', [CustomerController::class, 'update'])->name('customer.update')->middleware(['adminAble']);
        Route::delete('/delete/{id}', [CustomerController::class, 'delete'])->name('customer.delete')->middleware(['adminAble']);

    });

    Route::prefix('video')->group(function () {
        Route::get('/', [VideoController::class, 'index'])->name('video.index');
        Route::get('/create', [VideoController::class, 'create'])->name('video.create')->middleware(['adminAble']);
        Route::post('/store', [VideoController::class, 'store'])->name('video.store')->middleware(['adminAble']);
        Route::get('/edit/{id}', [VideoController::class, 'edit'])->name('video.edit')->middleware(['adminAble']);
        Route::post('/update/{id}', [VideoController::class, 'update'])->name('video.update')->middleware(['adminAble']);
        Route::delete('/delete/{id}', [VideoController::class, 'delete'])->name('video.delete')->middleware(['adminAble']);
        Route::get('/show/{id}', [VideoController::class, 'show'])->name('video.show')->middleware(['customerAble']);
        Route::get('/check-status/{id}', [VideoController::class, 'checkStatus'])->name('video.checkStatus')->middleware(['customerAble']);

    });

    Route::prefix('video-access-request')->group(function () {
        Route::get('/', [VideoAccessRequestController::class, 'index'])->name('video-access-request.index');
        // Route::get('/create', [VideoAccessRequestController::class, 'create'])->name('video-access-request.create')->middleware(['adminAble']);
        Route::post('/store', [VideoAccessRequestController::class, 'store'])->name('video-access-request.store')->middleware(['customerAble']);
        Route::get('/edit/{id}', [VideoAccessRequestController::class, 'edit'])->name('video-access-request.edit')->middleware(['adminAble']);
        Route::post('/update/{id}', [VideoAccessRequestController::class, 'update'])->name('video-access-request.update')->middleware(['adminAble']);
        Route::delete('/delete/{id}', [VideoAccessRequestController::class, 'delete'])->name('video-access-request.delete')->middleware(['adminAble']);

    });
});

