<x-layout.app>
    <x-slot name="title">{{ $ticket->subject }}</x-slot>
    <x-slot name="subtitle">Ticket details</x-slot>
    <div class="max-w-4xl mx-auto space-y-6">
        <x-ui.card>
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900">{{ $ticket->subject }}</h2>
                    <p class="text-slate-500">Client: {{ $ticket->client->company_name ?? '-' }}</p>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('tickets.edit', $ticket) }}" class="px-4 py-2 bg-amber-600 text-white rounded-lg"><ion-icon name="create-outline"></ion-icon> Edit</a>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div><span class="text-sm text-slate-500">Status:</span> <x-ui.badge :status="$ticket->status" type="ticket"/></div>
                <div><span class="text-sm text-slate-500">Priority:</span> <x-ui.badge :status="$ticket->priority" type="priority"/></div>
                <div><span class="text-sm text-slate-500">Created:</span> <span class="font-medium">{{ $ticket->created_at->format('d M Y, H:i') }}</span></div>
                <div><span class="text-sm text-slate-500">Updated:</span> <span class="font-medium">{{ $ticket->updated_at->format('d M Y, H:i') }}</span></div>
            </div>
            <div class="border-t pt-4"><p class="text-slate-700 whitespace-pre-line">{{ $ticket->description }}</p></div>
        </x-ui.card>
        <a href="{{ route('tickets.index') }}" class="inline-flex items-center px-6 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50"><ion-icon name="arrow-back-outline" class="mr-2"></ion-icon>Back</a>
    </div>
</x-layout.app>
