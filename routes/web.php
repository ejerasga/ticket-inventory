<?php

use App\Http\Controllers\StockController;
use App\Models\Stock;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ItemDeployedController;
use App\Http\Controllers\PCSpecsController;
use App\Http\Controllers\PrRequestController;

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
Route::post('/user/delete/{u_id}', [UserController::class, 'destroy'])->name('user_delete');
Route::put('/profile/{u_id}', [UserController::class, 'updateProfile'])->name('profile.update');



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

Route::get('/alerts', [TicketController::class, 'getAlerts'])->name('alerts'); // Get alerts for notifications

// Inventory

Route::get('/inventory/viewInventory', [InventoryController::class, 'viewInventory'])->name('view_inventory'); 

    // --- Stocks
Route::get('/inventory/viewstock', [StockController::class, 'index'])->name('view_stock');
Route::get('/inventory/createstock', [StockController::class, 'create'])->name('create_stock');
Route::post('/inventory/storestock', [StockController::class, 'store'])->name('store_stock');
Route::get('/inventory/editstock/{id}', [StockController::class, 'edit'])->name('edit_stock');
Route::put('/inventory/updatestock/{id}', [StockController::class, 'update'])->name('update_stock');
Route::delete('/inventory/deletestock/{id}', [StockController::class, 'destroy'])->name('delete_stock');

    // --- Items Deployed
Route::get('/inventory/itemdeployed', [ItemDeployedController::class, 'index'])->name('item_deployed');
Route::get('/inventory/createitemdeployed', [ItemDeployedController::class, 'create'])->name('create_itemdeployed');
Route::post('/inventory/storeitemdeployed', [ItemDeployedController::class, 'store'])->name('store_itemdeployed');
Route::get('/inventory/edititemdeployed/{id}', [ItemDeployedController::class, 'edit'])->name('edit_itemdeployed');
Route::put('/inventory/updateitemdeployed/{id}', [ItemDeployedController::class, 'update'])->name('update_itemdeployed');
Route::delete('/inventory/deleteitemdeployed/{id}', [ItemDeployedController::class, 'destroy'])->name('delete_itemdeployed');   

    // --- PC Specs 
Route::get('/inventory/pcspecs', [PcSpecsController::class, 'index'])->name('pcspecs.index');
Route::post('/inventory/pcspecs', [PcSpecsController::class, 'store'])->name('pcspecs.store');
Route::get('/inventory/pcspecs/{pcspec}/edit', [PcSpecsController::class, 'edit'])->name('pcspecs.edit');
Route::put('/inventory/pcspecs/{pcspec}', [PcSpecsController::class, 'update'])->name('pcspecs.update');
Route::delete('/inventory/pcspecs/{pcspec}', [PcSpecsController::class, 'destroy'])->name('pcspecs.destroy');
Route::get('/inventory/pcspecs/{pcspec}/images', [PcSpecsController::class, 'images'])->name('pcspecs.images');

    // --- PR Requests
Route::get('/prrequests', [PrRequestController::class, 'index'])->name('prrequests.index');
Route::post('/prrequests', [PrRequestController::class, 'store'])->name('prrequests.store');
Route::get('/prrequests/{prrequest}/edit', [PrRequestController::class, 'edit'])->name('prrequests.edit');
Route::put('/prrequests/{prrequest}', [PrRequestController::class, 'update'])->name('prrequests.update');
Route::delete('/prrequests/{prrequest}', [PrRequestController::class, 'destroy'])->name('prrequests.destroy');

// FullCalendar
Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar'); // send user to calendar
Route::get('/calendar/events', [CalendarController::class, 'getEvents'])->name('calendar.events'); // get calendar events