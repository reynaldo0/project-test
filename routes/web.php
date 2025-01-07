<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\TicketController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [TicketController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

Route::middleware(['auth', 'role:agent'])->group(function () {
    Route::get('/agent/dashboard', [AgentController::class, 'dashboard'])->name('agent.dashboard');
});

Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
Route::get('/tickets/{id}/edit', [TicketController::class, 'edit'])->name('tickets.edit');
Route::put('/tickets/{id}', [TicketController::class, 'update'])->name('tickets.update');
Route::delete('/tickets/{id}', [TicketController::class, 'destroy'])->name('tickets.destroy');
Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
Route::post('/tickets/store', [TicketController::class, 'store'])->name('tickets.store');
route::get('/produk/edit{id}', [TicketController::class, 'edit'])->name('tickets.edit');
route::put('/produk/update{id}', [TicketController::class, 'update'])->name('tickets.update');

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/tickets/create', [AdminController::class, 'createTicket'])->name('admin.tickets.create');
    Route::post('/tickets', [AdminController::class, 'storeTicket'])->name('admin.tickets.store');
    Route::get('/tickets/{id}/edit', [AdminController::class, 'editTicket'])->name('admin.tickets.edit');
});

require __DIR__ . '/auth.php';
