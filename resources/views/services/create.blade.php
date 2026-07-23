<x-layout.app>
    <x-slot name="title">New Service</x-slot>
    <x-slot name="subtitle">Add service to catalog</x-slot>
    <form action="{{ route('services.store') }}" method="POST" class="max-w-2xl mx-auto space-y-6">@csrf
        <x-ui.card><div class="space-y-4"><div><label class="block text-sm font-medium text-slate-700 mb-1">Name *</label><input type="text" name="name" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500"></div><div><label class="block text-sm font-medium text-slate-700 mb-1">Description</label><textarea name="description" rows="4" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500"></textarea></div><div><label class="block text-sm font-medium text-slate-700 mb-1">Base Price (Rp) *</label><input type="number" name="base_price" min="0" step="0.01" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500"></div><div class="flex items-center"><input type="checkbox" name="is_active" value="1" checked class="h-4 w-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500"><label class="ml-2 text-sm text-slate-700">Active</label></div></div></x-ui.card>
        <div class="flex justify-end space-x-4"><a href="{{ route('services.index') }}" class="px-6 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50">Cancel</a><button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Create Service</button></div>
    </form>
</x-layout.app>
