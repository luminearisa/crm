<x-layout.app>
    <x-slot name="title">{{ $document->title }}</x-slot>
    <x-slot name="subtitle">Document details</x-slot>
    <x-ui.card class="max-w-2xl mx-auto">
        <div class="text-center mb-6"><div class="inline-flex h-20 w-20 bg-blue-100 rounded-full items-center justify-center mb-4"><ion-icon name="document-text-outline" class="h-10 w-10 text-blue-600"></ion-icon></div><h2 class="text-2xl font-bold text-slate-900">{{ $document->title }}</h2><x-ui.badge :status="$document->type" type="document" class="mt-2"/></div>
        <div class="space-y-4 border-t pt-4">
            <div class="flex justify-between"><span class="text-slate-500">Client:</span><span class="font-medium">{{ $document->client->company_name ?? '-' }}</span></div>
            <div class="flex justify-between"><span class="text-slate-500">File:</span><span class="font-medium text-blue-600">{{ $document->file_path }}</span></div>
            <div class="flex justify-between"><span class="text-slate-500">Uploaded:</span><span class="font-medium">{{ $document->created_at->format('d M Y, H:i') }}</span></div>
        </div>
        <div class="mt-6 flex justify-center space-x-4"><a href="#" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"><ion-icon name="download-outline" class="mr-2"></ion-icon>Download</a><a href="{{ route('documents.index') }}" class="px-6 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50">Back</a></div>
    </x-ui.card>
</x-layout.app>
