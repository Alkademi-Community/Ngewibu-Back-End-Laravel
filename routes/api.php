<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('auth')
     ->controller(AuthController::class)
     ->group(function (){
        Route::post('/login', 'authenticate');
});

Route::prefix('profile')
     ->middleware('auth:sanctum')
     ->controller(ProfileController::class)
     ->group(function (){
      Route::get('/', 'show');

      Route::post('/update', 'update');
});

Route::prefix('events')
     ->controller(EventController::class)
     ->group(function (){
          Route::get('/', 'index');
     });