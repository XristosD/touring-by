<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\PlaceController;
use App\Http\Controllers\Api\TourController;
use App\Http\Controllers\Api\TouringByController;
use App\Http\Controllers\Api\TouringByPointController;
use App\Http\Controllers\Api\SharedTouringByController;
use App\Http\Controllers\Api\UserController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::name('api.')->group( function(){
    Route::name('auth.')->group( function(){
        Route::post('/register', [RegisterController::class, 'register']);
        Route::post('/login', [LoginController::class, 'login']);
    });
    Route::middleware('auth:sanctum')->group( function(){
        Route::get('/logout', [LogoutController::class, 'logout']);
        Route::get('/places', [PlaceController::class, 'index']);
        Route::get('/places/{place}', [PlaceController::class, 'indexTour']);
        Route::get('/tours/{tour}', [TourController::class, 'indexPoint']);
        Route::get('/touringby/start/{tour}', [TouringByController::class, 'getNew']);
        Route::get('/finduserbyemail', [UserController::class, 'findUserByEmail']);
        Route::get('/touringby/index', [TouringByController::class, 'index']);
        Route::get('/sharedtouringby/index', [SharedTouringByController::class, 'indexShared']);
        Route::middleware('can:update,touringBy')->group( function() {
            Route::get('/touringby/{touringBy}/resume', [TouringByController::class, 'get']);
            Route::get('/touringby/{touringBy}/currentpoint', [TouringByController::class, 'currentTuringByPoint']);
            Route::get('/touringby/{touringBy}/nextpoint', [TouringByController::class, 'nextTouringByPoint']);
            Route::get('/touringby/{touringBy}/complete', [TouringByController::class, 'completeTouringBy']);
            Route::get('/touringby/{touringBy}/shareto/{user}', [SharedTouringByController::class, 'shareTouringByToUser']);
        });
        Route::middleware('can:get,touringBy')->group( function() {
            Route::get('/touringby/{touringBy}/showtouringby', [TouringByController::class, 'showTouringBy']);
        });
        Route::middleware('can:update,touringByPoint')->group( function() {
            Route::get('/touringbypoint/{touringByPoint}/like', [TouringByPointController::class, 'like']);
            Route::get('/touringbypoint/{touringByPoint}/unlike', [TouringByPointController::class, 'unLike']);
            Route::post('/touringbypoint/{touringByPoint}/uploadimage', [TouringByPointController::class, 'uploadImage']);
            Route::get('/touringbypoint/{touringByPoint}/image', [TouringByPointController::class, 'image']);
        });     
    });
});



