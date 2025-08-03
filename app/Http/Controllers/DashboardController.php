<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\InventoryItem;
use App\Models\Ticket;
use App\Models\User;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $user = auth()->user();
        
        $stats = [
            'employees' => Employee::count(),
            'inventory_items' => InventoryItem::count(),
            'available_items' => InventoryItem::where('status', 'Available')->count(),
            'assigned_items' => InventoryItem::where('status', 'Assigned')->count(),
            'total_tickets' => $user->isAdmin() ? Ticket::count() : $user->createdTickets()->count(),
            'open_tickets' => $user->isAdmin() ? Ticket::where('status', 'Open')->count() : $user->createdTickets()->where('status', 'Open')->count(),
            'in_progress_tickets' => $user->isAdmin() ? Ticket::where('status', 'In Progress')->count() : $user->createdTickets()->where('status', 'In Progress')->count(),
            'resolved_tickets' => $user->isAdmin() ? Ticket::where('status', 'Resolved')->count() : $user->createdTickets()->where('status', 'Resolved')->count(),
        ];
        
        $recentTickets = $user->isAdmin() 
            ? Ticket::with(['createdBy', 'assignedTo'])->latest()->take(5)->get()
            : $user->createdTickets()->with(['createdBy', 'assignedTo'])->latest()->take(5)->get();
            
        $recentItems = InventoryItem::with(['category', 'assignedEmployee'])->latest()->take(5)->get();

        return Inertia::render('dashboard', [
            'stats' => $stats,
            'recentTickets' => $recentTickets,
            'recentItems' => $recentItems,
            'isAdmin' => $user->isAdmin(),
        ]);
    }
}