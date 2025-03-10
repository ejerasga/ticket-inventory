<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use A

Route::get('/', function () {
    return view('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');


Route::get('login', [LoginController::class, 'showLoginForm'])->name('login'); // Show the login form
Route::post('login', [LoginController::class, 'login']); // Handle the login form submission
Route::post('logout', [LoginController::class, 'logout'])->name('logout'); // Handle logout
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');  // send user to dashboard



// Users
Route::get('/user/create', [UserController::class, 'index'])->name('user_create'); // User creation page
Route::post('/user/store', [UserController::class, 'store'])->name('user_save'); // Save user
Route::get('/user/edit/{u_id}', [UserController::class, 'edit'])->name('user_edit'); // Edit user page
Route::put('/user/update/{u_id}', [UserController::class, 'update'])->name('user_update'); // Update user
Route::get('/user/list', [UserController::class, 'users'])->name('user_list'); // List users
Route::get('/user/profile/{u_id}', [UserController::class, 'profile'])->name('user_profile'); // User profile page



// Tickets
Route::get('/ticket/create', [TicketController::class, 'index'])->name('user_create'); // User creation page
