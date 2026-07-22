<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\Client;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        $query = Lead::with(['client', 'user', 'activities']);
        
        // Filter berdasarkan role
        if ($user->role === 'agent') {
            $query->where('user_id', $user->id);
        } elseif ($user->role === 'manager') {
            $agentIds = User::where('role', 'agent')->pluck('id');
            $query->whereIn('user_id', $agentIds);
        }
        
        // Filter status jika ada
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', "%{$request->search}%")
                  ->orWhereHas('client', function($q2) use ($request) {
                      $q2->where('company_name', 'like', "%{$request->search}%");
                  });
            });
        }
        
        $leads = $query->orderBy('created_at', 'desc')->get();
        
        // Group by status untuk Kanban
        $kanban = [
            'new' => $leads->where('status', 'new'),
            'contacted' => $leads->where('status', 'contacted'),
            'proposal' => $leads->where('status', 'proposal'),
            'negotiation' => $leads->where('status', 'negotiation'),
            'won' => $leads->where('status', 'won'),
            'lost' => $leads->where('status', 'lost'),
        ];
        
        $clients = Client::all();
        $statuses = ['new', 'contacted', 'proposal', 'negotiation', 'won', 'lost'];
        
        return view('leads.index', compact('kanban', 'clients', 'statuses'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('leads.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'title' => 'required|string|max:255',
            'status' => 'required|in:new,contacted,proposal,negotiation,won,lost',
            'expected_value' => 'required|numeric|min:0',
        ]);
        
        $validated['user_id'] = Auth::id();
        
        Lead::create($validated);
        
        return redirect()->route('leads.index')
            ->with('success', 'Lead berhasil ditambahkan.');
    }

    public function show(Lead $lead)
    {
        $this->authorizeLead($lead);
        
        $lead->load(['client', 'user', 'activities.user', 'proposal']);
        $activities = $lead->activities()->with('user')->orderBy('activity_date', 'desc')->get();
        
        return view('leads.show', compact('lead', 'activities'));
    }

    public function edit(Lead $lead)
    {
        $this->authorizeLead($lead);
        
        $clients = Client::all();
        return view('leads.edit', compact('lead', 'clients'));
    }

    public function update(Request $request, Lead $lead)
    {
        $this->authorizeLead($lead);
        
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'title' => 'required|string|max:255',
            'status' => 'required|in:new,contacted,proposal,negotiation,won,lost',
            'expected_value' => 'required|numeric|min:0',
        ]);
        
        $lead->update($validated);
        
        return redirect()->route('leads.index')
            ->with('success', 'Lead berhasil diupdate.');
    }

    public function destroy(Lead $lead)
    {
        $this->authorizeLead($lead);
        
        $lead->delete();
        
        return redirect()->route('leads.index')
            ->with('success', 'Lead berhasil dihapus.');
    }

    public function updateStatus(Request $request, Lead $lead)
    {
        $this->authorizeLead($lead);
        
        $validated = $request->validate([
            'status' => 'required|in:new,contacted,proposal,negotiation,won,lost',
        ]);
        
        $lead->update($validated);
        
        return redirect()->route('leads.index')
            ->with('success', 'Status lead berhasil diubah.');
    }

    public function moveColumn(Request $request)
    {
        $validated = $request->validate([
            'lead_id' => 'required|exists:leads,id',
            'status' => 'required|in:new,contacted,proposal,negotiation,won,lost',
        ]);
        
        $lead = Lead::findOrFail($validated['lead_id']);
        $this->authorizeLead($lead);
        
        $lead->update(['status' => $validated['status']]);
        
        return response()->json(['success' => true]);
    }

    private function authorizeLead(Lead $lead)
    {
        $user = Auth::user();
        
        if ($user->role === 'admin') {
            return;
        }
        
        if ($user->role === 'manager') {
            $agentIds = User::where('role', 'agent')->pluck('id');
            if (!in_array($lead->user_id, $agentIds->toArray())) {
                abort(403, 'Unauthorized access.');
            }
            return;
        }
        
        if ($user->role === 'agent' && $lead->user_id !== $user->id) {
            abort(403, 'Unauthorized access.');
        }
    }
}
