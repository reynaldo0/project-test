<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\AssignController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketLogController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/tickets', [AdminController::class, 'dashboard'])->name('admin.index');
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/tickets/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

    Route::get('/admin/ticket-logs', [TicketLogController::class, 'index'])->name('ticket.logs');
    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/admin/labels', [LabelController::class, 'index'])->name('labels.index');
    
    Route::put('/admin/users/update-role', [UserController::class, 'updateRole'])->name('users.updateRole');
    Route::get('/admin/tickets/{id}/details', [TicketLogController::class, 'details']);
    Route::post('/admin/tickets/{ticketId}/assign', [TicketLogController::class, 'assignTicket'])->name('tickets.assign');
});

Route::middleware(['auth', 'role:agent'])->group(function () {
    Route::get('/agent/dashboard', [AgentController::class, 'dashboard'])->name('agent.dashboard');
    Route::get('/agent/tickets', [AgentController::class, 'tickets'])->name('agent.index');
    Route::get('/agent/assign', [AssignController::class, 'index'])->name('assign.index');

    Route::get('/agent/create', [AgentController::class, 'create'])->name('agent.create');
    Route::post('/agent/store', [AgentController::class, 'store'])->name('agent.store');
    Route::get('/agent/tickets/{id}/edit', [AgentController::class, 'edit'])->name('agent.edit');
    Route::put('/agent/{id}', [AgentController::class, 'update'])->name('agent.update');
    Route::delete('/agent/{id}', [AgentController::class, 'destroy'])->name('agent.destroy');
});

Route::get('/ticket', [TicketController::class, 'index'])->name('ticket.index');
Route::put('/tickets/{id}', [TicketController::class, 'update'])->name('tickets.update');
Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
Route::post('/tickets/store', [TicketController::class, 'store'])->name('tickets.store');
Route::get('/ticket/{id}/edit', [TicketController::class, 'edit'])->name('ticket.edit');
Route::put('/ticket/{id}', [TicketController::class, 'update'])->name('ticket.update');

require __DIR__ . '/auth.php';
