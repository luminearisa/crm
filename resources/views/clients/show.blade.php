<x-layout.app>
    <x-slot name="title">Detail Klien</x-slot>
    <x-slot name="subtitle">{{ $client->company_name }}</x-slot>

    <div class="space-y-6">
        <!-- Action Buttons -->
        <div class="flex justify-between items-center">
            <a href="{{ route('clients.index') }}" class="text-slate-600 hover:text-slate-900 flex items-center">
                <ion-icon name="arrow-back" class="mr-2"></ion-icon>
                Kembali
            </a>
            <div class="space-x-3">
                <a href="{{ route('clients.edit', $client) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    <ion-icon name="create" class="mr-2"></ion-icon>
                    Edit
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Info -->
            <div class="lg:col-span-2 space-y-6">
                <x-ui.card>
                    <h3 class="text-lg font-semibold text-slate-900 mb-4">Informasi Perusahaan</h3>
                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-6">
                        <div>
                            <dt class="text-sm font-medium text-slate-500">Nama Perusahaan</dt>
                            <dd class="mt-1 text-base text-slate-900">{{ $client->company_name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-slate-500">Kontak Person</dt>
                            <dd class="mt-1 text-base text-slate-900">{{ $client->contact_person }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-slate-500">Email</dt>
                            <dd class="mt-1 text-base text-slate-900">
                                <a href="mailto:{{ $client->email }}" class="text-primary-600 hover:text-primary-900">{{ $client->email }}</a>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-slate-500">Telepon</dt>
                            <dd class="mt-1 text-base text-slate-900">
                                <a href="tel:{{ $client->phone }}" class="text-primary-600 hover:text-primary-900">{{ $client->phone }}</a>
                            </dd>
                        </div>
                        <div class="md:col-span-2">
                            <dt class="text-sm font-medium text-slate-500">Alamat</dt>
                            <dd class="mt-1 text-base text-slate-900">{{ $client->address }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-slate-500">PIC Internal</dt>
                            <dd class="mt-1 text-base text-slate-900">
                                @if($client->user)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium bg-primary-100 text-primary-800">
                                        {{ $client->user->name }} - {{ ucfirst($client->user->role) }}
                                    </span>
                                @else
                                    <span class="text-slate-400">Belum ditentukan</span>
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-slate-500">Bergabung Sejak</dt>
                            <dd class="mt-1 text-base text-slate-900">{{ $client->created_at->format('d M Y') }}</dd>
                        </div>
                    </dl>
                </x-ui.card>

                <!-- Leads Related -->
                <x-ui.card>
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-slate-900">Pipeline Leads</h3>
                        <a href="{{ route('leads.create') }}?client_id={{ $client->id }}" class="text-sm text-primary-600 hover:text-primary-900">
                            <ion-icon name="add" class="align-middle"></ion-icon>
                            Tambah Lead
                        </a>
                    </div>
                    <div class="space-y-3">
                        @forelse($client->leads as $lead)
                        <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg hover:bg-slate-100">
                            <div class="flex-1">
                                <a href="{{ route('leads.show', $lead) }}" class="text-sm font-medium text-slate-900 hover:text-primary-600">
                                    {{ $lead->title }}
                                </a>
                                <p class="text-xs text-slate-500 mt-1">
                                    {{ number_format($lead->expected_value, 0, ',', '.') }} IDR
                                </p>
                            </div>
                            <x-ui.badge :status="$lead->status" />
                        </div>
                        @empty
                        <p class="text-slate-500 text-sm text-center py-4">Belum ada leads untuk klien ini</p>
                        @endforelse
                    </div>
                </x-ui.card>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Quick Stats -->
                <x-ui.card>
                    <h3 class="text-lg font-semibold text-slate-900 mb-4">Statistik</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-600">Total Leads</span>
                            <span class="text-lg font-semibold text-slate-900">{{ $client->leads->count() }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-600">Leads Won</span>
                            <span class="text-lg font-semibold text-green-600">{{ $client->leads->where('status', 'won')->count() }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-600">Win Rate</span>
                            <span class="text-lg font-semibold text-primary-600">
                                @php
                                    $total = $client->leads->count();
                                    $won = $client->leads->where('status', 'won')->count();
                                    $rate = $total > 0 ? round(($won / $total) * 100) : 0;
                                @endphp
                                {{ $rate }}%
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-600">Total Documents</span>
                            <span class="text-lg font-semibold text-slate-900">{{ $client->documents->count() }}</span>
                        </div>
                    </div>
                </x-ui.card>

                <!-- Recent Activities -->
                <x-ui.card>
                    <h3 class="text-lg font-semibold text-slate-900 mb-4">Aktivitas Terbaru</h3>
                    <div class="space-y-3">
                        @php
                            $activities = $client->leads->flatMap->activities->sortByDesc('created_at')->take(5);
                        @endphp
                        @forelse($activities as $activity)
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center">
                                @if($activity->type === 'call')
                                    <ion-icon name="call" class="text-slate-600"></ion-icon>
                                @elseif($activity->type === 'email')
                                    <ion-icon name="mail" class="text-slate-600"></ion-icon>
                                @else
                                    <ion-icon name="people" class="text-slate-600"></ion-icon>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-slate-900 truncate">{{ $activity->notes ?? 'No notes' }}</p>
                                <p class="text-xs text-slate-500">{{ $activity->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        @empty
                        <p class="text-slate-500 text-sm text-center py-4">Belum ada aktivitas</p>
                        @endforelse
                    </div>
                </x-ui.card>
            </div>
        </div>
    </div>
</x-layout.app>
