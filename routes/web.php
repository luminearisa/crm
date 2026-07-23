<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;

// Landing page
Route::get('/', function () {
    return view('welcome');
});

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Clients
    Route::resource('clients', ClientController::class);

    // Leads
    Route::resource('leads', LeadController::class);
    Route::patch('/leads/{lead}/status', [LeadController::class, 'updateStatus'])->name('leads.update-status');

    // Proposals
    Route::resource('proposals', ProposalController::class);
    Route::get('/proposals/{proposal}/print', [ProposalController::class, 'print'])->name('proposals.print');

    // Invoices
    Route::resource('invoices', InvoiceController::class);
    Route::get('/invoices/{invoice}/digital', [InvoiceController::class, 'digital'])->name('invoices.digital');
    Route::post('/invoices/{invoice}/payment', [InvoiceController::class, 'recordPayment'])->name('invoices.payment');

    // Tasks
    Route::resource('tasks', TaskController::class);

    // Activities
    Route::resource('activities', ActivityController::class);

    // Events
    Route::resource('events', EventController::class);

    // Tickets
    Route::resource('tickets', TicketController::class);

    // Documents
    Route::resource('documents', DocumentController::class);
    Route::get('/documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');

    // Expenses
    Route::resource('expenses', ExpenseController::class);

    // Services
    Route::resource('services', ServiceController::class);

    // Settings (Admin only)
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Leaderboard
    Route::get('/leaderboard', [DashboardController::class, 'leaderboard'])->name('leaderboard.index');
});
