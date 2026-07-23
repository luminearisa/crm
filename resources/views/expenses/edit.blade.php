<x-layout.app>
    <x-slot name="title">Edit Expense</x-slot>
    <x-slot name="subtitle">Update expense record</x-slot>
    <form action="{{ route('expenses.update', $expense) }}" method="POST" class="max-w-2xl mx-auto space-y-6">@csrf @method('PUT')
        <x-ui.card>
            <div class="space-y-4">
                <div><label class="block text-sm font-medium text-slate-700 mb-1">Description *</label><input type="text" name="description" value="{{ $expense->description }}" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500"></div>
                <div class="grid grid-cols-2 gap-4"><div><label class="block text-sm font-medium text-slate-700 mb-1">Amount *</label><input type="number" name="amount" value="{{ $expense->amount }}" min="0" step="0.01" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500"></div><div><label class="block text-sm font-medium text-slate-700 mb-1">Date *</label><input type="date" name="date" value="{{ $expense->date->format('Y-m-d') }}" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500"></div></div>
                <div><label class="block text-sm font-medium text-slate-700 mb-1">Category *</label><select name="category" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500"><option value="transport" {{ $expense->category == 'transport' ? 'selected' : '' }}>Transport</option><option value="meals" {{ $expense->category == 'meals' ? 'selected' : '' }}>Meals</option><option value="accommodation" {{ $expense->category == 'accommodation' ? 'selected' : '' }}>Accommodation</option><option value="office_supplies" {{ $expense->category == 'office_supplies' ? 'selected' : '' }}>Office Supplies</option><option value="client_entertainment" {{ $expense->category == 'client_entertainment' ? 'selected' : '' }}>Client Entertainment</option><option value="other" {{ $expense->category == 'other' ? 'selected' : '' }}>Other</option></select></div>
            </div>
        </x-ui.card>
        <div class="flex justify-end space-x-4"><a href="{{ route('expenses.index') }}" class="px-6 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50">Cancel</a><button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Update</button></div>
    </form>
</x-layout.app>
