<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('user')
            ->where('user_id', auth()->id())
            ->latest('start_time')
            ->paginate(15);
        
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'location' => 'nullable|string|max:255',
        ]);

        $validated['user_id'] = auth()->id();

        Event::create($validated);

        return redirect()->route('events.index')
            ->with('success', 'Event berhasil ditambahkan.');
    }

    public function show(Event $event)
    {
        if ($event->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403);
        }
        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        if ($event->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403);
        }
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        if ($event->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'location' => 'nullable|string|max:255',
        ]);

        $event->update($validated);

        return redirect()->route('events.index')
            ->with('success', 'Event berhasil diperbarui.');
    }

    public function destroy(Event $event)
    {
        if ($event->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403);
        }

        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Event berhasil dihapus.');
    }
}
