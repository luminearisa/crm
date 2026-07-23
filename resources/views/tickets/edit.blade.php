<x-layout.app>
    <x-slot name="title">Edit Ticket</x-slot>
    <x-slot name="subtitle">Update ticket details</x-slot>

    <form action="{{ route('tickets.update', $ticket) }}" method="POST" class="max-w-4xl mx-auto space-y-6">
        @csrf @method('PUT')
        <x-ui.card>
            <h3 class="text-lg font-semibold text-slate-800 mb-4">Ticket Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Subject *</label>
                    <input type="text" name="subject" required value="{{ old('subject', $ticket->subject) }}" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Client *</label>
                    <select name="client_id" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ $client->id == $ticket->client_id ? 'selected' : '' }}>{{ $client->company_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Priority *</label>
                    <select name="priority" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="low" {{ $ticket->priority == 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ $ticket->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ $ticket->priority == 'high' ? 'selected' : '' }}>High</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Status</label>
                    <select name="status" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>Open</option>
                        <option value="progress" {{ $ticket->status == 'progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Description *</label>
                    <textarea name="description" rows="6" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('description', $ticket->description) }}</textarea>
                </div>
            </div>
        </x-ui.card>
        <div class="flex justify-end space-x-4">
            <a href="{{ route('tickets.index') }}" class="px-6 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50">Cancel</a>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Update Ticket</button>
        </div>
    </form>
</x-layout.app>
