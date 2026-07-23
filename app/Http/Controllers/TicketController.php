<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Client;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $query = Ticket::with(['client', 'user']);
        
        // Agent hanya lihat tiket dari client mereka
        if (auth()->user()->role === 'agent') {
            $query->whereHas('client', function($q) {
                $q->where('user_id', auth()->id());
            });
        }
        
        $tickets = $query->latest()->paginate(15);
        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('tickets.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high',
        ]);

        $validated['status'] = 'open';
        $validated['user_id'] = auth()->id();

        Ticket::create($validated);

        return redirect()->route('tickets.index')
            ->with('success', 'Tiket berhasil dibuat.');
    }

    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    public function edit(Ticket $ticket)
    {
        $clients = Client::all();
        return view('tickets.edit', compact('ticket', 'clients'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:open,progress,closed',
            'priority' => 'required|in:low,medium,high',
        ]);

        $ticket->update($validated);

        return redirect()->route('tickets.index')
            ->with('success', 'Tiket berhasil diperbarui.');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()->route('tickets.index')
            ->with('success', 'Tiket berhasil dihapus.');
    }
}
