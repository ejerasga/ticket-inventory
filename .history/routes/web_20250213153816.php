<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;


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




/*************  ✨ Codeium Command 🌟  *************/
Route::get('/users/create', 'UserController@index')->name('users.create');  // send user to creating users page
Route::get('/user/create', 'UserController@index')->name('user_create');  // send user to creating users page

/******  fa70ba3d-900f-4b2e-b1c2-d7d639c40a4a  *******/