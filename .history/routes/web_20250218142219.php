<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TicketController;

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
Route::get('/user/list', [UserController::class, 'users'])->name('user_list'); // List of users
Route::get('/user/profile/{u_id}', [UserController::class, 'profile'])->name('user_profile'); // User profile page



// Tickets
Route::get('/ticket/create', [TicketController::class, 'index'])->name('ticket_create'); // Ticket creation page
Route::post('/ticket/store', [TicketController::class, 'store'])->name('ticket_save'); // Save ticket
Route::get('/ticket/list', [TicketController::class, 'tickets'])->name('ticket_list'); // List of tickets
Route::post('/ticket/assign/{id}', [TicketController::class, 'assignTicket'])->name('ticket_assign'); // Assign ticket
Route::post('/ticket/complete/{id}', [TicketController::class, 'completeTicket'])->name('ticket_complete'); // Complete ticket
Route::post('/ticket/reject/{id}', [TicketController::class, 'rejectTicket'])->name('ticket_reject'); // Reject ticket
Route::get('/ticket/evaluate/{id}', [TicketController::class, 'evaluateTicket'])->name('ticket_evaluate'); // Evaluate ticket
Route::post('/ticket/evaluate/{id}/save', [TicketController::class, 'saveEvaluation'])->name('ticket_evaluate_save'); // Save evaluation
Route::get('/ticket/info/{id}', [TicketController::class, 'showTicketInfo'])->name('ticket_info'); // Show ticket info



Route::get('/alerts', [TicketController::class, 'getAlerts'])->name('alerts');



// FullCalendar
Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar'); // send user to calendar
Route::get('/calendar/events', [CalendarController::class, 'getEvents'])->name('calendar.events'); // get calendar events