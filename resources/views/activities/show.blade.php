<x-layout.app>
    <x-slot name="title">Detail Aktivitas</x-slot>
    <x-slot name="subtitle">{{ $activity->lead->title ?? '-' }}</x-slot>

    <div class="space-y-6">
        <x-ui.card>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-slate-500">Tipe Aktivitas</label>
                    <p class="mt-1 text-lg font-semibold text-slate-900 capitalize">
                        <ion-icon name="{{ $activity->type === 'call' ? 'call' : ($activity->type === 'email' ? 'mail' : 'people') }}" class="mr-2"></ion-icon>
                        {{ $activity->type }}
                    </p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-500">Tanggal</label>
                    <p class="mt-1 text-lg font-semibold text-slate-900">
                        {{ $activity->activity_date->format('d F Y') }}
                    </p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-500">Lead</label>
                    <p class="mt-1 text-lg font-semibold text-slate-900">
                        {{ $activity->lead->title ?? '-' }}
                    </p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-500">Dicatat oleh</label>
                    <p class="mt-1 text-lg font-semibold text-slate-900">
                        {{ $activity->user->name ?? '-' }}
                    </p>
                </div>
                
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-slate-500">Catatan</label>
                    <p class="mt-1 text-base text-slate-900 whitespace-pre-line">
                        {{ $activity->notes ?? 'Tidak ada catatan' }}
                    </p>
                </div>
            </div>
            
            <div class="mt-6 pt-6 border-t flex justify-end space-x-3">
                <x-ui.button href="{{ route('activities.index') }}" variant="secondary">
                    Kembali
                </x-ui.button>
                <x-ui.button href="{{ route('activities.edit', $activity) }}" variant="primary">
                    Edit
                </x-ui.button>
            </div>
        </x-ui.card>
    </div>
</x-layout.app>
