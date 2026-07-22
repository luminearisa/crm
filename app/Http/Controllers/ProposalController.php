<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proposal;
use App\Models\Lead;
use App\Models\Service;
use App\Models\ProposalItem;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProposalController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        $query = Proposal::with(['lead.client', 'items.service']);
        
        // Filter berdasarkan role
        if ($user->role === 'agent') {
            $query->whereHas('lead', function($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        } elseif ($user->role === 'manager') {
            $agentIds = User::where('role', 'agent')->pluck('id');
            $query->whereHas('lead', function($q) use ($agentIds) {
                $q->whereIn('user_id', $agentIds);
            });
        }
        
        $proposals = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('proposals.index', compact('proposals'));
    }

    public function create(Lead $lead = null)
    {
        $this->authorizeLeadAccess($lead);
        
        $services = Service::where('is_active', true)->get();
        $leads = $this->getAccessibleLeads();
        
        return view('proposals.create', compact('services', 'leads', 'lead'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'lead_id' => 'required|exists:leads,id',
            'status' => 'required|in:draft,sent,accepted,rejected',
            'items' => 'required|array|min:1',
            'items.*.service_id' => 'required|exists:services,id',
            'items.*.qty' => 'required|numeric|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);
        
        $this->authorizeLeadAccess(Lead::findOrFail($validated['lead_id']));
        
        DB::beginTransaction();
        try {
            // Hitung total amount dari items
            $totalAmount = 0;
            foreach ($validated['items'] as $item) {
                $totalAmount += $item['qty'] * $item['price'];
            }
            
            $proposal = Proposal::create([
                'lead_id' => $validated['lead_id'],
                'total_amount' => $totalAmount,
                'status' => $validated['status'],
            ]);
            
            // Simpan items
            foreach ($validated['items'] as $item) {
                ProposalItem::create([
                    'proposal_id' => $proposal->id,
                    'service_id' => $item['service_id'],
                    'qty' => $item['qty'],
                    'price' => $item['price'],
                ]);
            }
            
            DB::commit();
            
            return redirect()->route('proposals.show', $proposal)
                ->with('success', 'Proposal berhasil dibuat.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal membuat proposal: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function show(Proposal $proposal)
    {
        $this->authorizeLeadAccess($proposal->lead);
        
        $proposal->load(['items.service', 'lead.client', 'invoice']);
        
        return view('proposals.show', compact('proposal'));
    }

    public function edit(Proposal $proposal)
    {
        $this->authorizeLeadAccess($proposal->lead);
        
        $services = Service::where('is_active', true)->get();
        $proposal->load('items');
        
        return view('proposals.edit', compact('proposal', 'services'));
    }

    public function update(Request $request, Proposal $proposal)
    {
        $this->authorizeLeadAccess($proposal->lead);
        
        $validated = $request->validate([
            'status' => 'required|in:draft,sent,accepted,rejected',
            'items' => 'required|array|min:1',
            'items.*.service_id' => 'required|exists:services,id',
            'items.*.qty' => 'required|numeric|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.id' => 'nullable|exists:proposal_items,id',
        ]);
        
        DB::beginTransaction();
        try {
            // Hitung total amount dari items
            $totalAmount = 0;
            foreach ($validated['items'] as $item) {
                $totalAmount += $item['qty'] * $item['price'];
            }
            
            $proposal->update([
                'total_amount' => $totalAmount,
                'status' => $validated['status'],
            ]);
            
            // Hapus items lama yang tidak ada di request
            $existingItemIds = collect($validated['items'])
                ->pluck('id')
                ->filter()
                ->toArray();
            
            if (!empty($existingItemIds)) {
                $proposal->items()->whereNotIn('id', $existingItemIds)->delete();
            } else {
                $proposal->items()->delete();
            }
            
            // Update atau create items baru
            foreach ($validated['items'] as $item) {
                if (isset($item['id'])) {
                    // Update existing item
                    ProposalItem::where('id', $item['id'])->update([
                        'service_id' => $item['service_id'],
                        'qty' => $item['qty'],
                        'price' => $item['price'],
                    ]);
                } else {
                    // Create new item
                    ProposalItem::create([
                        'proposal_id' => $proposal->id,
                        'service_id' => $item['service_id'],
                        'qty' => $item['qty'],
                        'price' => $item['price'],
                    ]);
                }
            }
            
            DB::commit();
            
            return redirect()->route('proposals.show', $proposal)
                ->with('success', 'Proposal berhasil diupdate.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal mengupdate proposal: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function destroy(Proposal $proposal)
    {
        $this->authorizeLeadAccess($proposal->lead);
        
        $proposal->delete();
        
        return redirect()->route('proposals.index')
            ->with('success', 'Proposal berhasil dihapus.');
    }

    private function authorizeLeadAccess(Lead $lead)
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

    private function getAccessibleLeads()
    {
        $user = Auth::user();
        
        if ($user->role === 'admin') {
            return Lead::all();
        }
        
        if ($user->role === 'manager') {
            $agentIds = User::where('role', 'agent')->pluck('id');
            return Lead::whereIn('user_id', $agentIds)->get();
        }
        
        return Lead::where('user_id', $user->id)->get();
    }
}
