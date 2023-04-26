<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\PlanningController;
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
Route::middleware(['throttle:global'])->group(function () {

    Route::get('/', function () {
        return view('welcome');
    })->name('index');

    //USERS
    Route::get('/user/list', [UserController::class, 'list'])->name('user.list')->middleware('auth')->middleware('is_verified')->middleware('is_admin');
    Route::post('/user/search', [UserController::class, 'search'])->name('user.search')->middleware('auth')->middleware('is_verified')->middleware('is_admin');
    Route::get('/user/list/etudiant', [UserController::class, 'listEtudiant'])->name('user.list.student')->middleware('auth')->middleware('is_verified')->middleware('is_admin');
    Route::get('/user/list/enseignant', [UserController::class, 'listEnseignant'])->name('user.list.teacher')->middleware('auth')->middleware('is_verified')->middleware('is_admin');
    Route::get('/user/not-verified', [UserController::class, 'notVerified'])->name('user.notVerified')->middleware('auth')->middleware('is_verified')->middleware('is_admin');
    Route::get('/user/{id}', [UserController::class, 'index'])->name('user.index')->middleware('auth')->middleware('is_verified');
    Route::post('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit')->middleware('auth')->middleware('is_verified');
    Route::delete('/user/{id}', [UserController::class, 'delete'])->name('user.destroy')->middleware('auth')->middleware('is_verified');

    //FORMATION
    Route::get('/formation', [FormationController::class, 'list'])->name('formation.index')->middleware('auth')->middleware('is_verified');
    Route::get('/formation/create', [FormationController::class, 'create'])->name('formation.create')->middleware('auth')->middleware('is_verified')->middleware('is_admin');
    Route::post('/formation', [FormationController::class, 'store'])->name('formation.store')->middleware('auth')->middleware('is_verified')->middleware('is_admin');
    Route::get('/formation/edit/{id}', [FormationController::class, 'edit'])->name('formation.edit')->middleware('auth')->middleware('is_verified')->middleware('is_admin');
    Route::put('/formation/update/{id}', [FormationController::class, 'update'])->name('formation.update')->middleware('auth')->middleware('is_verified')->middleware('is_admin');
    Route::delete('/formation/{id}', [FormationController::class, 'destroy'])->name('formation.destroy')->middleware('auth')->middleware('is_verified')->middleware('is_admin');

    //COURS
    Route::post('/cours/search', [CoursController::class, 'search'])->name('cours.search')->middleware('auth')->middleware('is_verified')->middleware('is_admin');
    Route::get('/cours/formation/my', [CoursController::class, 'my_formation'])->name('cours.formation.my')->middleware('auth')->middleware('is_verified');
    Route::get('/cours/iteach', [CoursController::class, 'i_teach'])->name('cours.iteach')->middleware('auth')->middleware('is_verified');
    Route::get('/cours/my', [CoursController::class, 'my'])->name('cours.my')->middleware('auth')->middleware('is_verified');
    Route::post('/cours/subscribe/{id}', [CoursController::class, 'subscribe'])->name('cours.subscribe')->middleware('auth')->middleware('is_verified');
    Route::post('/cours/unsubscribe/{id}', [CoursController::class, 'unsubscribe'])->name('cours.unsubscribe')->middleware('auth')->middleware('is_verified');
    Route::get('/cours/list', [CoursController::class, 'list'])->name('cours.list')->middleware('auth')->middleware('is_verified');
    Route::get('/cours/list/enseignant/{id}', [CoursController::class, 'listbyEnseignant'])->name('cours.list.enseignant')->middleware('auth')->middleware('is_verified')->middleware('is_admin');
    Route::get('/cours/create', [CoursController::class, 'create'])->name('cours.create')->middleware('auth')->middleware('is_verified')->middleware('is_admin');
    Route::get('/cours/{id}', [CoursController::class, 'index'])->name('cours.index')->middleware('auth')->middleware('is_verified');
    Route::post('/cours', [CoursController::class, 'store'])->name('cours.store')->middleware('auth')->middleware('is_verified')->middleware('is_admin');
    Route::put('/cours/{id}', [CoursController::class, 'update'])->name('cours.update')->middleware('auth')->middleware('is_verified')->middleware('is_admin');
    Route::delete('/cours/{id}', [CoursController::class, 'destroy'])->name('cours.destroy')->middleware('auth')->middleware('is_verified')->middleware('is_admin');

    //PLANNING
    Route::get('/planning/list', [PlanningController::class, 'list'])->name('planning.list')->middleware('auth')->middleware('is_verified')->middleware('is_admin');
    Route::get('/planning/list/teacher', [PlanningController::class, 'listTeacher'])->name('planning.list.teacher')->middleware('auth')->middleware('is_verified');
    Route::get('/planning/list/teacher/course/{id}', [PlanningController::class, 'listTeacherByCourse'])->name('planning.list.teacher.course')->middleware('auth')->middleware('is_verified');
    Route::post('/planning/list/teacher/week', [PlanningController::class, 'listTeacherByWeek'])->name('planning.list.teacher.week')->middleware('auth')->middleware('is_verified');
    Route::get('/planning/list/student', [PlanningController::class, 'listStudent'])->name('planning.list.student')->middleware('auth')->middleware('is_verified');
    Route::get('/planning/list/student/course/{id}', [PlanningController::class, 'listStudentByCourse'])->name('planning.list.student.course')->middleware('auth')->middleware('is_verified');
    Route::post('/planning/list/student/week', [PlanningController::class, 'listStudentByWeek'])->name('planning.list.student.week')->middleware('auth')->middleware('is_verified');
    Route::get('/planning/create/admin', [PlanningController::class, 'createAdmin'])->name('planning.create.admin')->middleware('auth')->middleware('is_verified')->middleware('is_admin');
    Route::get('/planning/create/teacher', [PlanningController::class, 'createTeacher'])->name('planning.create.teacher')->middleware('auth')->middleware('is_verified');
    Route::get('/planning/edit/admin/{id}', [PlanningController::class, 'editAdmin'])->name('planning.edit.admin')->middleware('auth')->middleware('is_verified')->middleware('is_admin');
    Route::get('/planning/edit/teacher/{id}', [PlanningController::class, 'editTeacher'])->name('planning.edit.teacher')->middleware('auth')->middleware('is_verified');
    Route::post('/planning', [PlanningController::class, 'store'])->name('planning.store')->middleware('auth')->middleware('is_verified');
    Route::put('/planning/{id}', [PlanningController::class, 'update'])->name('planning.update')->middleware('auth')->middleware('is_verified');
    Route::delete('/planning/{id}', [PlanningController::class, 'destroy'])->name('planning.destroy')->middleware('auth')->middleware('is_verified');
});

//AUTHENTIFICATION
Route::middleware(['throttle:auth'])->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class,'formLogin'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class,'login']);
    Route::get('/logout', [AuthenticatedSessionController::class,'logout'])->name('logout');;
    Route::get('/register', [UserController::class,'registerForm'])->name('register');;
    Route::post('/register', [UserController::class,'store']);
});

