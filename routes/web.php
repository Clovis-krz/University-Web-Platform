<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\FormationController;
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


//USERS
Route::get('/user/list', [UserController::class, 'list'])->name('user.list');
Route::get('/user/not-verified', [UserController::class, 'notVerified'])->name('user.notVerified');
Route::get('/user/{id}', [UserController::class, 'index'])->name('user.index');
Route::post('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::delete('/user/{id}', [UserController::class, 'delete'])->name('user.destroy');

//FORMATION
Route::get('/formation', [FormationController::class, 'list'])->name('formation.index');
Route::get('/formation/create', [FormationController::class, 'create'])->name('formation.create');
Route::post('/formation', [FormationController::class, 'store'])->name('formation.store');
Route::get('/formation/edit/{id}', [FormationController::class, 'edit'])->name('formation.edit');
Route::put('/formation/update/{id}', [FormationController::class, 'update'])->name('formation.update');
Route::delete('/formation/{id}', [FormationController::class, 'destroy'])->name('formation.destroy');

//COURS 
Route::get('/cours/list', [CoursController::class, 'list'])->name('cours.list');
Route::get('/cours/create', [CoursController::class, 'create'])->name('cours.create');
Route::get('/cours/{id}', [CoursController::class, 'index'])->name('cours.index');
Route::post('/cours', [CoursController::class, 'store'])->name('cours.store');
Route::put('/cours/{id}', [CoursController::class, 'update'])->name('cours.update');
Route::delete('/cours/{id}', [CoursController::class, 'destroy'])->name('cours.destroy');

//AUTHENTIFICATION
Route::get('/login', [AuthenticatedSessionController::class,'formLogin'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class,'login']);
Route::get('/logout', [AuthenticatedSessionController::class,'logout'])->name('logout');;
Route::get('/register', [UserController::class,'registerForm'])->name('register');;
Route::post('/register', [UserController::class,'store']);
