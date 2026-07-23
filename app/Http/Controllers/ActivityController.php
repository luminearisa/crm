<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Lead;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activities = Activity::with(['lead', 'user'])
            ->latest('activity_date')
            ->paginate(15);

        return view('activities.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $leads = Lead::all();
        return view('activities.create', compact('leads'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'lead_id' => 'required|exists:leads,id',
            'type' => 'required|in:call,email,meeting',
            'activity_date' => 'required|date',
            'notes' => 'nullable|string|max:1000',
        ]);

        $validated['user_id'] = auth()->id();

        Activity::create($validated);

        return redirect()->route('activities.index')
            ->with('success', 'Aktivitas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        return view('activities.show', compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        $leads = Lead::all();
        return view('activities.edit', compact('activity', 'leads'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activity $activity)
    {
        $validated = $request->validate([
            'lead_id' => 'required|exists:leads,id',
            'type' => 'required|in:call,email,meeting',
            'activity_date' => 'required|date',
            'notes' => 'nullable|string|max:1000',
        ]);

        $activity->update($validated);

        return redirect()->route('activities.index')
            ->with('success', 'Aktivitas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();

        return redirect()->route('activities.index')
            ->with('success', 'Aktivitas berhasil dihapus.');
    }
}
