<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;


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




Route::get('/user/create', [UserController::class, 'index'])->name('user_create');  // send user to creating users page