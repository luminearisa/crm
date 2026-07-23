<x-layout.app>
    <x-slot name="title">Proposals</x-slot>
    <x-slot name="subtitle">Manage all proposals and quotations</x-slot>

    <div class="space-y-6">
        <!-- Header Actions -->
        <div class="flex justify-between items-center">
            <div class="flex space-x-3">
                <x-ui.button href="{{ route('proposals.create') }}" variant="primary">
                    <ion-icon name="add-outline" class="mr-2"></ion-icon>
                    New Proposal
                </x-ui.button>
                <x-ui.button variant="secondary">
                    <ion-icon name="download-outline" class="mr-2"></ion-icon>
                    Export
                </x-ui.button>
            </div>
            <div class="relative">
                <input type="text" 
                       placeholder="Search proposals..." 
                       class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <ion-icon name="search-outline" class="absolute left-3 top-2.5 text-gray-400"></ion-icon>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <x-ui.card>
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-lg">
                        <ion-icon name="document-text-outline" class="text-2xl text-blue-600"></ion-icon>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-500">Total Proposals</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $proposals->total() }}</p>
                    </div>
                </div>
            </x-ui.card>
            <x-ui.card>
                <div class="flex items-center">
                    <div class="p-3 bg-yellow-100 rounded-lg">
                        <ion-icon name="send-outline" class="text-2xl text-yellow-600"></ion-icon>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-500">Pending</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $proposals->where('status', 'sent')->count() }}</p>
                    </div>
                </div>
            </x-ui.card>
            <x-ui.card>
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-lg">
                        <ion-icon name="checkmark-circle-outline" class="text-2xl text-green-600"></ion-icon>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-500">Accepted</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $proposals->where('status', 'accepted')->count() }}</p>
                    </div>
                </div>
            </x-ui.card>
            <x-ui.card>
                <div class="flex items-center">
                    <div class="p-3 bg-purple-100 rounded-lg">
                        <ion-icon name="cash-outline" class="text-2xl text-purple-600"></ion-icon>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-500">Total Value</p>
                        <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($proposals->sum('total_amount'), 0, ',', '.') }}</p>
                    </div>
                </div>
            </x-ui.card>
        </div>

        <!-- Proposals Table -->
        <x-ui.card>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Proposal #</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lead</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($proposals as $proposal)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-medium text-blue-600">{{ $proposal->proposal_number }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $proposal->lead->client->company_name ?? 'N/A' }}</div>
                                <div class="text-sm text-gray-500">{{ $proposal->lead->client->contact_person ?? '' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-900">{{ $proposal->lead->title ?? 'N/A' }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-medium text-gray-900">Rp {{ number_format($proposal->total_amount, 0, ',', '.') }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $statusColors = [
                                        'draft' => 'gray',
                                        'sent' => 'yellow',
                                        'accepted' => 'green',
                                        'rejected' => 'red',
                                        'expired' => 'gray'
                                    ];
                                @endphp
                                <x-ui.badge :color="$statusColors[$proposal->status] ?? 'gray'">
                                    {{ ucfirst($proposal->status) }}
                                </x-ui.badge>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-500">{{ $proposal->created_at->format('d M Y') }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    <a href="{{ route('proposals.show', $proposal) }}" class="text-blue-600 hover:text-blue-900">
                                        <ion-icon name="eye-outline"></ion-icon>
                                    </a>
                                    <a href="{{ route('proposals.edit', $proposal) }}" class="text-yellow-600 hover:text-yellow-900">
                                        <ion-icon name="create-outline"></ion-icon>
                                    </a>
                                    <form action="{{ route('proposals.destroy', $proposal) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            <ion-icon name="trash-outline"></ion-icon>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                <ion-icon name="folder-open-outline" class="text-4xl mb-2"></ion-icon>
                                <p>No proposals found. Create your first proposal!</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($proposals->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $proposals->links() }}
            </div>
            @endif
        </x-ui.card>
    </div>
</x-layout.app>
