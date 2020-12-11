<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PlaceController;
use App\Http\Controllers\Admin\PointController;

Route::prefix('/admin')->name('admin.')->group( function () {
    Route::name('auth.')->group( function () {
        Route::get('/', [LoginController::class, 'index'])->name('login');
        Route::post('/', [LoginController::class, 'login']);
    });
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::prefix('/places')->name('places.')->group( function() {
        Route::get('/', [PlaceController::class, 'index']);
        Route::get('/create', [PlaceController::class, 'create']);
        Route::post('/create', [PlaceController::class, 'store']);
        Route::get('/{place}', [PlaceController::class, 'show']);
        Route::get('/{place}/edit', [PlaceController::class, 'edit']);
        Route::put('/{place}', [PlaceController::class, 'update']);
        Route::delete('/{place}', [PlaceController::class, 'destroy']);
        Route::get('/{place}/edit-points', [PlaceController::class, 'editPoints']);
        Route::post('/{place}/add-points', [PlaceController::class, 'addPoints']);
        Route::post('/{place}/remove-points', [PlaceController::class, 'removePoints']);
    });

    Route::prefix('/points')->name('points.')->group( function() {
        Route::get('/', [PointController::class, 'index']);
        Route::get('/create', [PointController::class, 'create']);
        Route::post('/create', [PointController::class, 'store']);
        Route::get('/{point}', [PointController::class, 'show']);
        Route::get('/{point}/edit', [PointController::class, 'edit']);
        Route::put('/{point}', [PointController::class, 'update']);
        Route::delete('/{point}', [PointController::class, 'destroy']);
        Route::get('/{point}/location', [PointController::class, 'changeLocation']);
        Route::post('/{point}/location', [PointController::class, 'storeLocation']);
        Route::get('/{point}/edit-places', [PointController::class, 'editPlaces']);
        Route::post('/{point}/add-places', [PointController::class, 'addPlaces']);
        Route::post('/{point}/remove-places', [PointController::class, 'removePlaces']);
    });
});


Route::get('/', function () {
    return view('welcome');
});
