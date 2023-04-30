<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->group(
    function () {

Route::apiResource("contacts",ContactController::class);
Route::get('/profile', [UserController::class, "profile"]);
Route::get('/logout', [UserController::class, "logout"]);

        }
    );

Route::prefix('users')->group(function () {
    Route::post('/register', [UserController::class,"register"])->name("register");
    Route::post('/login', [UserController::class,"login"])->name("login");
});
