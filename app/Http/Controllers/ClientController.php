<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct()
    {
        // Middleware sudah di-handle di routes
    }

    public function index(Request $request)
    {
        $query = Client::with('user');
        
        // Filter berdasarkan PIC untuk agent (hanya lihat klien mereka sendiri)
        if (auth()->user()->role === 'agent') {
            $query->where('user_id', auth()->id());
        }
        
        // Search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('company_name', 'like', "%{$search}%")
                  ->orWhere('contact_person', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        $clients = $query->latest()->paginate(15);
        
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        $users = User::where('role', '!=', 'admin')->get();
        return view('clients.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'address' => 'required|string',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $validated['user_id'] = $validated['user_id'] ?: auth()->id();

        Client::create($validated);

        return redirect()->route('clients.index')
            ->with('success', 'Klien berhasil ditambahkan!');
    }

    public function show(Client $client)
    {
        // Authorization check
        if (auth()->user()->role === 'agent' && $client->user_id !== auth()->id()) {
            abort(403);
        }

        $client->load(['leads.activities', 'documents']);
        
        return view('clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        // Authorization check
        if (auth()->user()->role === 'agent' && $client->user_id !== auth()->id()) {
            abort(403);
        }

        $users = User::where('role', '!=', 'admin')->get();
        
        return view('clients.edit', compact('client', 'users'));
    }

    public function update(Request $request, Client $client)
    {
        // Authorization check
        if (auth()->user()->role === 'agent' && $client->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'address' => 'required|string',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $client->update($validated);

        return redirect()->route('clients.show', $client)
            ->with('success', 'Klien berhasil diupdate!');
    }

    public function destroy(Client $client)
    {
        // Authorization check
        if (auth()->user()->role === 'agent' && $client->user_id !== auth()->id()) {
            abort(403);
        }

        $client->delete();

        return redirect()->route('clients.index')
            ->with('success', 'Klien berhasil dihapus!');
    }
}
