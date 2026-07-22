<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Auth Routes
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\InvoiceController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Protected Routes
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Leads
    Route::resource('leads', LeadController::class);
    Route::post('/leads/{lead}/status', [LeadController::class, 'updateStatus'])->name('leads.status');
    Route::post('/leads/move', [LeadController::class, 'moveColumn'])->name('leads.move');
    
    // Proposals
    Route::resource('proposals', ProposalController::class);
    
    // Invoices
    Route::resource('invoices', InvoiceController::class);
    Route::get('/invoices/{invoice}/digital', [InvoiceController::class, 'digitalView'])->name('invoices.digital');
});
