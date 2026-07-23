<x-layout.app>
    <x-slot name="title">Daftar Klien</x-slot>
    <x-slot name="subtitle">Manajemen hubungan pelanggan</x-slot>

    <div class="space-y-6">
        <!-- Header Actions -->
        <div class="flex justify-between items-center">
            <div class="relative w-96">
                <input type="text" 
                       placeholder="Cari klien..." 
                       class="w-full pl-10 pr-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                <ion-icon name="search" class="absolute left-3 top-2.5 text-slate-400"></ion-icon>
            </div>
            <a href="{{ route('clients.create') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700">
                <ion-icon name="add" class="mr-2"></ion-icon>
                Tambah Klien
            </a>
        </div>

        <!-- Clients Table -->
        <x-ui.card>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Perusahaan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Kontak Person</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Telepon</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">PIC Internal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Kota</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        @forelse($clients as $client)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 font-semibold mr-3">
                                        {{ substr($client->company_name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-slate-900">{{ $client->company_name }}</div>
                                        <div class="text-xs text-slate-500">{{ Str::limit($client->address, 30) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">{{ $client->contact_person }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">{{ $client->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">{{ $client->phone }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($client->user)
                                <div class="flex items-center">
                                    <div class="w-6 h-6 rounded-full bg-slate-200 flex items-center justify-center text-xs font-medium text-slate-600 mr-2">
                                        {{ substr($client->user->name, 0, 1) }}
                                    </div>
                                    <span class="text-sm text-slate-900">{{ $client->user->name }}</span>
                                </div>
                                @else
                                <span class="text-slate-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800">
                                    {{ Str::before($client->address, ',') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('clients.show', $client) }}" class="text-primary-600 hover:text-primary-900 mr-3">Detail</a>
                                <a href="{{ route('clients.edit', $client) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-slate-500">
                                <ion-icon name="people-outline" class="text-4xl mb-2 block mx-auto"></ion-icon>
                                <p>Belum ada data klien</p>
                                <a href="{{ route('clients.create') }}" class="text-primary-600 hover:text-primary-900 mt-2 inline-block">Tambah klien pertama</a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($clients->hasPages())
            <div class="px-6 py-4 border-t border-slate-200">
                {{ $clients->links() }}
            </div>
            @endif
        </x-ui.card>
    </div>
</x-layout.app>
