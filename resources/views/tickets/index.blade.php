<x-layout.app>
    <x-slot name="title">Support Tickets</x-slot>
    <x-slot name="subtitle">Manage client support requests</x-slot>

    <div class="flex justify-between items-center mb-6">
        <div class="relative w-64">
            <input type="text" placeholder="Search tickets..." 
                class="w-full pl-10 pr-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <ion-icon name="search-outline" class="absolute left-3 top-2.5 text-slate-400"></ion-icon>
        </div>
        <a href="{{ route('tickets.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
            <ion-icon name="add-circle-outline" class="mr-2"></ion-icon>
            New Ticket
        </a>
    </div>

    <x-ui.card>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Subject</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Client</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Priority</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Created</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @forelse($tickets as $ticket)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-slate-900">{{ $ticket->subject }}</div>
                                <div class="text-sm text-slate-500 truncate max-w-xs">{{ Str::limit($ticket->description, 50) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">
                                {{ $ticket->client->company_name ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <x-ui.badge :status="$ticket->priority" type="priority" />
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <x-ui.badge :status="$ticket->status" type="ticket" />
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                {{ $ticket->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    <a href="{{ route('tickets.show', $ticket) }}" class="text-blue-600 hover:text-blue-900">
                                        <ion-icon name="eye-outline"></ion-icon>
                                    </a>
                                    <a href="{{ route('tickets.edit', $ticket) }}" class="text-amber-600 hover:text-amber-900">
                                        <ion-icon name="create-outline"></ion-icon>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-slate-500">
                                <ion-icon name="ticket-outline" class="text-4xl mb-2 block mx-auto"></ion-icon>
                                No tickets found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($tickets->hasPages())
            <div class="mt-4">{{ $tickets->links() }}</div>
        @endif
    </x-ui.card>
</x-layout.app>
