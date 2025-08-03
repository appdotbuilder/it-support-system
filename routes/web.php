<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\InventoryCategoryController;
use App\Http\Controllers\InventoryItemController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/health-check', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
    ]);
})->name('health-check');

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Employee Management (Admin only)
    Route::resource('employees', EmployeeController::class);
    
    // Inventory Category Management (Admin only)  
    Route::resource('inventory-categories', InventoryCategoryController::class);
    
    // Inventory Item Management (Admin only)
    Route::resource('inventory-items', InventoryItemController::class);
    
    // Ticket Management (All authenticated users)
    Route::resource('tickets', TicketController::class);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';