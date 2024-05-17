<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

// Route::get('/home', function () {
//     return view('home');
// });

Route::get('/home',[UserController::class,'home']);
Route::get('/',[UserController::class,'index']);
Route::get('/register',[UserController::class,'register']);

Route::get('/logout',[UserController::class,'logout']);
Route::post('/login',[UserController::class,'login']);
Route::post('/reg_user',[UserController::class,'reg_user']);
