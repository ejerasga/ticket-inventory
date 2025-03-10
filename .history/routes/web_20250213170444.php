<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');


// Show the login form
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');

// Handle the login form submission
Route::post('login', [LoginController::class, 'login']);

// Handle logout
Route::post('logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');  // send user to dashboard

Route::get('/user/create', [UserController::class, 'index'])->name('user_create'); // send user to creating users page
Route::post('/user/store', [UserController::class, 'store'])->name('user_save'); // saving user to database
Route::get('/user/edit/{id}', [UserController::class, 'store'])->name('user_edit'); // send user to edit page

