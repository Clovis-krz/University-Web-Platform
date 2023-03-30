<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthenticatedSessionController;

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

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::get('/user/not-verified', [UserController::class, 'notVerified'])->name('user.notVerified');
Route::get('/user/{id}', [UserController::class, 'index'])->name('user.index');
Route::post('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::delete('/user/{id}', [UserController::class, 'delete'])->name('user.destroy');



Route::get('/login', [AuthenticatedSessionController::class,'formLogin'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class,'login']);
Route::get('/logout', [AuthenticatedSessionController::class,'logout'])->name('logout');;
Route::get('/register', [UserController::class,'registerForm'])->name('register');;
Route::post('/register', [UserController::class,'store']);
