<x-layout.app>
    <x-slot name="title">Documents</x-slot>
    <x-slot name="subtitle">Manage client documents and contracts</x-slot>
    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('documents.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg"><ion-icon name="add-circle-outline" class="mr-2"></ion-icon>New Document</a>
    </div>
    <x-ui.card>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($documents as $doc)
                <div class="border border-slate-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-shrink-0 h-12 w-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <ion-icon name="document-text-outline" class="h-6 w-6 text-blue-600"></ion-icon>
                        </div>
                        <x-ui.badge :status="$doc->type" type="document" />
                    </div>
                    <h3 class="font-semibold text-slate-900 mb-1">{{ $doc->title }}</h3>
                    <p class="text-sm text-slate-500 mb-3">{{ $doc->client->company_name ?? '-' }}</p>
                    <div class="flex justify-between items-center pt-3 border-t">
                        <span class="text-xs text-slate-400">{{ $doc->created_at->format('d M Y') }}</span>
                        <div class="flex space-x-2">
                            <a href="{{ route('documents.show', $doc) }}" class="text-blue-600 hover:text-blue-900"><ion-icon name="eye-outline"></ion-icon></a>
                            <a href="{{ route('documents.edit', $doc) }}" class="text-amber-600 hover:text-amber-900"><ion-icon name="create-outline"></ion-icon></a>
                            <form action="{{ route('documents.destroy', $doc) }}" method="POST" class="inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button type="submit" class="text-red-600 hover:text-red-900"><ion-icon name="trash-outline"></ion-icon></button></form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 text-slate-500"><ion-icon name="folder-open-outline" class="text-5xl mb-3 block mx-auto"></ion-icon>No documents uploaded.</div>
            @endforelse
        </div>
        @if($documents->hasPages())<div class="mt-4">{{ $documents->links() }}</div>@endif
    </x-ui.card>
</x-layout.app>
