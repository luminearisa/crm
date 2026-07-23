<x-layout.app>
    <x-slot name="title">Create Ticket</x-slot>
    <x-slot name="subtitle">New support request</x-slot>

    <form action="{{ route('tickets.store') }}" method="POST" class="max-w-4xl mx-auto space-y-6">
        @csrf
        <x-ui.card>
            <h3 class="text-lg font-semibold text-slate-800 mb-4">Ticket Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Subject *</label>
                    <input type="text" name="subject" required value="{{ old('subject') }}" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('subject') border-red-500 @enderror">
                    @error('subject')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Client *</label>
                    <select name="client_id" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->company_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Priority *</label>
                    <select name="priority" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>
                    </select>
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Description *</label>
                    <textarea name="description" rows="6" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>
        </x-ui.card>
        <div class="flex justify-end space-x-4">
            <a href="{{ route('tickets.index') }}" class="px-6 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50">Cancel</a>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Create Ticket</button>
        </div>
    </form>
</x-layout.app>
