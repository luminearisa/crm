<x-layout.app>
    <x-slot name="title">Expense Tracker</x-slot>
    <x-slot name="subtitle">Track operational expenses</x-slot>
    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('expenses.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg"><ion-icon name="add-circle-outline" class="mr-2"></ion-icon>New Expense</a>
    </div>
    <x-ui.card>
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr><th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Description</th><th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Category</th><th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Amount</th><th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Date</th><th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">User</th><th class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase">Actions</th></tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-200">
                @forelse($expenses as $expense)
                    <tr class="hover:bg-slate-50"><td class="px-6 py-4 text-sm text-slate-900">{{ $expense->description }}</td><td class="px-6 py-4"><x-ui.badge :status="$expense->category" type="expense"/></td><td class="px-6 py-4 text-sm font-medium text-slate-900">Rp {{ number_format($expense->amount, 0, ',', '.') }}</td><td class="px-6 py-4 text-sm text-slate-500">{{ $expense->date->format('d M Y') }}</td><td class="px-6 py-4 text-sm text-slate-500">{{ $expense->user->name ?? '-' }}</td><td class="px-6 py-4 text-right"><div class="flex justify-end space-x-2"><a href="{{ route('expenses.edit', $expense) }}" class="text-amber-600"><ion-icon name="create-outline"></ion-icon></a><form action="{{ route('expenses.destroy', $expense) }}" method="POST" class="inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button type="submit" class="text-red-600"><ion-icon name="trash-outline"></ion-icon></button></form></div></td></tr>
                @empty
                    <tr><td colspan="6" class="px-6 py-8 text-center text-slate-500"><ion-icon name="wallet-outline" class="text-4xl mb-2 block mx-auto"></ion-icon>No expenses recorded.</td></tr>
                @endforelse
            </tbody>
        </table>
        @if($expenses->hasPages())<div class="mt-4">{{ $expenses->links() }}</div>@endif
    </x-ui.card>
</x-layout.app>
