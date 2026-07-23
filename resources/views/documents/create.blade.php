<x-layout.app>
    <x-slot name="title">Upload Document</x-slot>
    <x-slot name="subtitle">Add new document</x-slot>
    <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data" class="max-w-2xl mx-auto space-y-6">
        @csrf
        <x-ui.card>
            <div class="space-y-4">
                <div><label class="block text-sm font-medium text-slate-700 mb-1">Title *</label><input type="text" name="title" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500"></div>
                <div><label class="block text-sm font-medium text-slate-700 mb-1">Client *</label><select name="client_id" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500">@foreach($clients as $c)<option value="{{ $c->id }}">{{ $c->company_name }}</option>@endforeach</select></div>
                <div><label class="block text-sm font-medium text-slate-700 mb-1">Type *</label><select name="type" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500"><option value="contract">Contract</option><option value="nda">NDA</option><option value="other">Other</option></select></div>
                <div><label class="block text-sm font-medium text-slate-700 mb-1">File *</label><input type="file" name="file" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500"></div>
            </div>
        </x-ui.card>
        <div class="flex justify-end space-x-4"><a href="{{ route('documents.index') }}" class="px-6 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50">Cancel</a><button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Upload</button></div>
    </form>
</x-layout.app>
