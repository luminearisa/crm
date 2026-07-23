<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $query = Expense::with('user');
        
        // Agent hanya lihat expense mereka sendiri
        if (auth()->user()->role === 'agent') {
            $query->where('user_id', auth()->id());
        }
        
        $expenses = $query->latest('date')->paginate(15);
        return view('expenses.index', compact('expenses'));
    }

    public function create()
    {
        return view('expenses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $validated['user_id'] = auth()->id();

        Expense::create($validated);

        return redirect()->route('expenses.index')
            ->with('success', 'Expense berhasil ditambahkan.');
    }

    public function show(Expense $expense)
    {
        if ($expense->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403);
        }
        return view('expenses.show', compact('expense'));
    }

    public function edit(Expense $expense)
    {
        if ($expense->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403);
        }
        return view('expenses.edit', compact('expense'));
    }

    public function update(Request $request, Expense $expense)
    {
        if ($expense->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $expense->update($validated);

        return redirect()->route('expenses.index')
            ->with('success', 'Expense berhasil diperbarui.');
    }

    public function destroy(Expense $expense)
    {
        if ($expense->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403);
        }

        $expense->delete();

        return redirect()->route('expenses.index')
            ->with('success', 'Expense berhasil dihapus.');
    }
}
