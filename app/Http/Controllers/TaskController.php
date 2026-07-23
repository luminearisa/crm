<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::where('user_id', auth()->id());
        
        // Filter by status
        if ($request->has('filter') && in_array($request->filter, ['pending', 'in_progress', 'completed'])) {
            $query->where('status', $request->filter);
        }
        
        $tasks = $query->latest('due_date')->paginate(12);
        
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $validated['user_id'] = auth()->id();

        Task::create($validated);

        return redirect()->route('tasks.index')
            ->with('success', 'Tugas berhasil dibuat!');
    }

    public function show(Task $task)
    {
        // Authorization check
        if ($task->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403);
        }

        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        // Authorization check
        if ($task->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403);
        }

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        // Authorization check
        if ($task->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')
            ->with('success', 'Tugas berhasil diupdate!');
    }

    public function destroy(Task $task)
    {
        // Authorization check
        if ($task->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403);
        }

        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Tugas berhasil dihapus!');
    }
}
