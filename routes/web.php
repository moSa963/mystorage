<?php

use App\Http\Controllers\SessionAuth\SessionLoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('register',  [SessionLoginController::class, 'register']);

Route::post('login',  [SessionLoginController::class, 'login']);

Route::delete('logout',  [SessionLoginController::class, 'destroy']);

Route::view("/{path}", "index")->where("path", "(.*)");
