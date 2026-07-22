<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Proposal;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        $query = Invoice::with(['proposal.lead.client']);
        
        // Filter berdasarkan role
        if ($user->role === 'agent') {
            $query->whereHas('proposal', function($q) use ($user) {
                $q->whereHas('lead', function($q2) use ($user) {
                    $q2->where('user_id', $user->id);
                });
            });
        } elseif ($user->role === 'manager') {
            $agentIds = User::where('role', 'agent')->pluck('id');
            $query->whereHas('proposal', function($q) use ($agentIds) {
                $q->whereHas('lead', function($q2) use ($agentIds) {
                    $q2->whereIn('user_id', $agentIds);
                });
            });
        }
        
        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        $invoices = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('invoices.index', compact('invoices'));
    }

    public function create(Proposal $proposal = null)
    {
        $this->authorizeProposalAccess($proposal);
        
        $proposals = $this->getAccessibleProposals();
        
        return view('invoices.create', compact('proposals', 'proposal'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'proposal_id' => 'required|exists:proposals,id',
            'minimum_payment' => 'required|numeric|min:0',
            'status' => 'required|in:unpaid,partial,paid',
        ]);
        
        $proposal = Proposal::findOrFail($validated['proposal_id']);
        $this->authorizeProposalAccess($proposal);
        
        // Generate invoice number
        $invoiceNumber = 'INV-' . date('Ymd') . '-' . str_pad(Invoice::count() + 1, 4, '0', STR_PAD_LEFT);
        
        $invoice = Invoice::create([
            'proposal_id' => $validated['proposal_id'],
            'invoice_number' => $invoiceNumber,
            'total_amount' => $proposal->total_amount,
            'minimum_payment' => $validated['minimum_payment'],
            'status' => $validated['status'],
        ]);
        
        return redirect()->route('invoices.show', $invoice)
            ->with('success', 'Invoice berhasil dibuat.');
    }

    public function show(Invoice $invoice)
    {
        $this->authorizeProposalAccess($invoice->proposal);
        
        $invoice->load(['proposal.items.service', 'proposal.lead.client']);
        
        return view('invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        $this->authorizeProposalAccess($invoice->proposal);
        
        return view('invoices.edit', compact('invoice'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $this->authorizeProposalAccess($invoice->proposal);
        
        $validated = $request->validate([
            'minimum_payment' => 'required|numeric|min:0',
            'status' => 'required|in:unpaid,partial,paid',
        ]);
        
        $invoice->update($validated);
        
        return redirect()->route('invoices.show', $invoice)
            ->with('success', 'Invoice berhasil diupdate.');
    }

    public function destroy(Invoice $invoice)
    {
        $this->authorizeProposalAccess($invoice->proposal);
        
        $invoice->delete();
        
        return redirect()->route('invoices.index')
            ->with('success', 'Invoice berhasil dihapus.');
    }

    public function digitalView(Invoice $invoice)
    {
        $this->authorizeProposalAccess($invoice->proposal);
        
        $invoice->load(['proposal.items.service', 'proposal.lead.client']);
        
        return view('invoices.digital', compact('invoice'));
    }

    private function authorizeProposalAccess(Proposal $proposal)
    {
        $user = Auth::user();
        
        if ($user->role === 'admin') {
            return;
        }
        
        if ($user->role === 'manager') {
            $agentIds = User::where('role', 'agent')->pluck('id');
            if (!in_array($proposal->lead->user_id, $agentIds->toArray())) {
                abort(403, 'Unauthorized access.');
            }
            return;
        }
        
        if ($user->role === 'agent' && $proposal->lead->user_id !== $user->id) {
            abort(403, 'Unauthorized access.');
        }
    }

    private function getAccessibleProposals()
    {
        $user = Auth::user();
        
        if ($user->role === 'admin') {
            return Proposal::all();
        }
        
        if ($user->role === 'manager') {
            $agentIds = User::where('role', 'agent')->pluck('id');
            return Proposal::whereHas('lead', function($q) use ($agentIds) {
                $q->whereIn('user_id', $agentIds);
            })->get();
        }
        
        return Proposal::whereHas('lead', function($q) use ($user) {
            $q->where('user_id', $user->id);
        })->get();
    }
}
