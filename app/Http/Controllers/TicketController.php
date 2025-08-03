<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $status = $request->get('status');
        $priority = $request->get('priority');
        
        $user = auth()->user();
        
        $tickets = Ticket::query()
            ->with(['createdBy', 'assignedTo'])
            ->when(!$user->isAdmin(), function ($query) use ($user) {
                return $query->where('created_by', $user->id);
            })
            ->when($search, function ($query, $search) {
                return $query->where('title', 'ilike', "%{$search}%")
                    ->orWhere('description', 'ilike', "%{$search}%");
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($priority, function ($query, $priority) {
                return $query->where('priority', $priority);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return Inertia::render('tickets/index', [
            'tickets' => $tickets,
            'search' => $search,
            'status' => $status,
            'priority' => $priority,
            'isAdmin' => $user->isAdmin(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('tickets/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        $ticket = Ticket::create([
            ...$request->validated(),
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('tickets.show', $ticket)
            ->with('success', 'Ticket created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        $ticket->load(['createdBy', 'assignedTo']);
        
        $user = auth()->user();
        
        // Check if user can view this ticket
        if (!$user->isAdmin() && $ticket->created_by !== $user->id) {
            abort(403);
        }
        
        return Inertia::render('tickets/show', [
            'ticket' => $ticket,
            'isAdmin' => $user->isAdmin(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        $user = auth()->user();
        
        // Check if user can edit this ticket
        if (!$user->isAdmin() && $ticket->created_by !== $user->id) {
            abort(403);
        }
        
        $technicians = User::admins()->orderBy('name')->get();

        return Inertia::render('tickets/edit', [
            'ticket' => $ticket,
            'technicians' => $technicians,
            'isAdmin' => $user->isAdmin(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $user = auth()->user();
        
        // Check if user can update this ticket
        if (!$user->isAdmin() && $ticket->created_by !== $user->id) {
            abort(403);
        }
        
        $data = $request->validated();
        
        // Only admins can assign tickets and update status
        if (!$user->isAdmin()) {
            unset($data['assigned_to'], $data['status']);
        }
        
        $ticket->update($data);

        return redirect()->route('tickets.show', $ticket)
            ->with('success', 'Ticket updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $user = auth()->user();
        
        // Check if user can delete this ticket
        if (!$user->isAdmin() && $ticket->created_by !== $user->id) {
            abort(403);
        }
        
        $ticket->delete();

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket deleted successfully.');
    }
}