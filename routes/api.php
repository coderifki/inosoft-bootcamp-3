<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TodoListController;
use Illuminate\Support\Facades\Route;

// Routes for Subjects
Route::prefix('subjects')->group(function () {
    Route::get('/', [SubjectController::class, 'index']);
    Route::post('/', [SubjectController::class, 'store']);
    Route::get('/{id}', [SubjectController::class, 'show']);
    Route::put('/{id}', [SubjectController::class, 'update']);
    Route::delete('/{id}', [SubjectController::class, 'destroy']);
    Route::get('/{id}/calculate-total-score', [SubjectController::class, 'calculateTotalScore']);
});

// Routes for Students
Route::prefix('students')->group(function () {
    Route::get('/', [StudentController::class, 'index']);
    Route::post('/', [StudentController::class, 'store']);
    Route::get('/{id}', [StudentController::class, 'show']);
    Route::put('/{id}', [StudentController::class, 'update']);
    Route::delete('/{id}', [StudentController::class, 'destroy']);
    Route::get('/{id}/calculate-average-score', [StudentController::class, 'calculateAverageScore']);
});

// Routes for Todos
Route::prefix('todos')->group(function () {
    Route::post('/', [TodoListController::class, 'store']);
    Route::get('/', [TodoListController::class, 'getTodoList']);
    Route::get('/{id}', [TodoListController::class, 'show']);
    Route::put('/{id}', [TodoListController::class, 'update']);
    Route::delete('/{id}', [TodoListController::class, 'destroy']);
});

// Routes authentication
// Route::post('/register', [AuthController::class, 'register']);
// Route::post('/login', [AuthController::class, 'login']);
// Route::middleware('auth.jwt')->get('/user', [AuthController::class, 'getUser']);

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->name('me');
    Route::get('/profile',  [AuthController::class, 'getAuthenticatedUser']);
});
