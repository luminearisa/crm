<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\Client;
use App\Models\Activity;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        
        // Metrics untuk semua role
        $totalLeads = Lead::count();
        $activeLeads = Lead::whereIn('status', ['new', 'contacted', 'proposal', 'negotiation'])->count();
        $wonLeads = Lead::where('status', 'won')->count();
        $lostLeads = Lead::where('status', 'lost')->count();
        
        $totalRevenue = Invoice::where('status', 'paid')->sum('total_amount');
        $pendingRevenue = Invoice::whereIn('status', ['unpaid', 'partial'])->sum('total_amount');
        $totalInvoices = Invoice::count();
        $unpaidInvoices = Invoice::where('status', 'unpaid')->count();
        
        $recentActivities = Activity::with(['lead', 'user'])
            ->orderBy('activity_date', 'desc')
            ->limit(10)
            ->get();
        
        // Leaderboard - Top performers
        $leaderboard = User::withCount(['leads as total_leads' => function ($query) {
                $query->where('status', 'won');
            }])
            ->withSum(['leads as total_value' => function ($query) {
                $query->where('status', 'won');
            }], 'expected_value')
            ->orderByDesc('total_leads')
            ->limit(5)
            ->get();
        
        // Win rate calculation per user
        $winRates = [];
        foreach ($leaderboard as $agent) {
            $total = $agent->leads()->count();
            $won = $agent->leads()->where('status', 'won')->count();
            $winRates[$agent->id] = $total > 0 ? round(($won / $total) * 100, 1) : 0;
        }
        
        // Filter data berdasarkan role
        if ($user->role === 'agent') {
            $totalLeads = Lead::where('user_id', $user->id)->count();
            $activeLeads = Lead::where('user_id', $user->id)
                ->whereIn('status', ['new', 'contacted', 'proposal', 'negotiation'])
                ->count();
            $wonLeads = Lead::where('user_id', $user->id)->where('status', 'won')->count();
            $lostLeads = Lead::where('user_id', $user->id)->where('status', 'lost')->count();
            
            $myInvoices = Invoice::whereHas('proposal', function($q) use ($user) {
                $q->whereHas('lead', function($q2) use ($user) {
                    $q2->where('user_id', $user->id);
                });
            });
            
            $totalRevenue = (clone $myInvoices)->where('status', 'paid')->sum('total_amount');
            $pendingRevenue = (clone $myInvoices)->whereIn('status', ['unpaid', 'partial'])->sum('total_amount');
            $totalInvoices = (clone $myInvoices)->count();
            $unpaidInvoices = (clone $myInvoices)->where('status', 'unpaid')->count();
            
            $recentActivities = Activity::where('user_id', $user->id)
                ->with(['lead', 'user'])
                ->orderBy('activity_date', 'desc')
                ->limit(10)
                ->get();
        } elseif ($user->role === 'manager') {
            // Manager melihat timnya saja (asumsi: manager mengelola semua agent)
            $agentIds = User::where('role', 'agent')->pluck('id');
            
            $totalLeads = Lead::whereIn('user_id', $agentIds)->count();
            $activeLeads = Lead::whereIn('user_id', $agentIds)
                ->whereIn('status', ['new', 'contacted', 'proposal', 'negotiation'])
                ->count();
            $wonLeads = Lead::whereIn('user_id', $agentIds)->where('status', 'won')->count();
            $lostLeads = Lead::whereIn('user_id', $agentIds)->where('status', 'lost')->count();
            
            $teamInvoices = Invoice::whereHas('proposal', function($q) use ($agentIds) {
                $q->whereHas('lead', function($q2) use ($agentIds) {
                    $q2->whereIn('user_id', $agentIds);
                });
            });
            
            $totalRevenue = (clone $teamInvoices)->where('status', 'paid')->sum('total_amount');
            $pendingRevenue = (clone $teamInvoices)->whereIn('status', ['unpaid', 'partial'])->sum('total_amount');
            $totalInvoices = (clone $teamInvoices)->count();
            $unpaidInvoices = (clone $teamInvoices)->where('status', 'unpaid')->count();
            
            $recentActivities = Activity::whereIn('user_id', $agentIds)
                ->with(['lead', 'user'])
                ->orderBy('activity_date', 'desc')
                ->limit(10)
                ->get();
        }
        
        return view('dashboard.index', compact(
            'totalLeads',
            'activeLeads',
            'wonLeads',
            'lostLeads',
            'totalRevenue',
            'pendingRevenue',
            'totalInvoices',
            'unpaidInvoices',
            'recentActivities',
            'leaderboard',
            'winRates'
        ));
    }
}
