<x-layout.app>
    <x-slot name="title">Aktivitas</x-slot>
    <x-slot name="subtitle">Riwayat interaksi dengan leads</x-slot>

    <div class="space-y-6">
        <!-- Header Actions -->
        <div class="flex justify-between items-center">
            <x-ui.button href="{{ route('activities.create') }}" variant="primary">
                <ion-icon name="add" class="mr-2"></ion-icon>
                Tambah Aktivitas
            </x-ui.button>
        </div>

        <!-- Activities List -->
        <x-ui.card>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Tipe</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Lead</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Catatan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">User</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        @forelse($activities as $activity)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                {{ $activity->activity_date->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $icons = ['call' => 'call', 'email' => 'mail', 'meeting' => 'people'];
                                    $colors = ['call' => 'blue', 'email' => 'green', 'meeting' => 'purple'];
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $colors[$activity->type] }}-100 text-{{ $colors[$activity->type] }}-800">
                                    <ion-icon name="{{ $icons[$activity->type] }}" class="mr-1"></ion-icon>
                                    {{ ucfirst($activity->type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                {{ $activity->lead->title ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-500 max-w-xs truncate">
                                {{ $activity->notes ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                {{ $activity->user->name ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('activities.edit', $activity) }}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                                <form action="{{ route('activities.destroy', $activity) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-slate-500">
                                <ion-icon name="chatbubbles-outline" class="text-4xl mb-2"></ion-icon>
                                <p>Belum ada aktivitas</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($activities->hasPages())
            <div class="border-t border-slate-200 px-6 py-4">
                {{ $activities->links() }}
            </div>
            @endif
        </x-ui.card>
    </div>
</x-layout.app>
