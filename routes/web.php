<?php

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

Route::redirect('/', '/login');
// Login routes
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');

// Logout route
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Registration routes
Route::get('/register', [App\Http\Controllers\Auth\RegisterController ::class, 'showRegistrationForm'])->name('staff.create');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('staff.store');

Route::middleware(['web', 'auth'])->group(function () {
    // Dashboard route
    Route::get('/dashboard',[App\Http\Controllers\AppController::class, 'dashboard'])->name('dashboard');

    // Routes for the task, request, and analysis pages
    Route::get('/task',[App\Http\Controllers\AppController::class, 'taskPage'])->name('task.page');
    Route::get('/request',[App\Http\Controllers\AppController::class, 'requestPage'])->name('request.page');
    Route::get('/analysis',[App\Http\Controllers\AppController::class, 'analysisPage'])->name('analysis.page');

    // Route for referencing
    Route::post('/notify',[App\Http\Controllers\AppController::class, 'notifyStaff'])->name('notify');
});