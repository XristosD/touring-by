<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PlaceController;

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
    });
});


Route::get('/', function () {
    return view('welcome');
});