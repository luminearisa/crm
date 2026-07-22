<x-layout.app title="Pipeline Leads">
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-900">Pipeline Leads</h2>
                <p class="text-slate-600 mt-1">Kelola dan lacak progress leads Anda</p>
            </div>
            <div class="flex items-center space-x-3">
                <x-ui.button variant="primary" icon="add" href="{{ route('leads.create') }}">
                    Lead Baru
                </x-ui.button>
            </div>
        </div>
        
        <!-- Search & Filter -->
        <x-ui.card padding="p-4">
            <form action="{{ route('leads.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <x-ui.input 
                        name="search" 
                        placeholder="Cari lead atau perusahaan..." 
                        value="{{ request('search') }}" 
                    />
                </div>
                <div class="sm:w-48">
                    <x-ui.select 
                        name="status" 
                        placeholder="Semua Status"
                        :options="['new' => 'New', 'contacted' => 'Contacted', 'proposal' => 'Proposal', 'negotiation' => 'Negotiation', 'won' => 'Won', 'lost' => 'Lost']"
                        value="{{ request('status') }}"
                    />
                </div>
                <x-ui.button type="submit" variant="secondary" icon="search">
                    Filter
                </x-ui.button>
            </form>
        </x-ui.card>
        
        <!-- Kanban Board -->
        <div class="overflow-x-auto pb-4">
            <div class="flex gap-4 min-w-max">
                @php
                    $statusColors = [
                        'new' => 'bg-blue-50 border-blue-200',
                        'contacted' => 'bg-purple-50 border-purple-200',
                        'proposal' => 'bg-yellow-50 border-yellow-200',
                        'negotiation' => 'bg-orange-50 border-orange-200',
                        'won' => 'bg-green-50 border-green-200',
                        'lost' => 'bg-red-50 border-red-200',
                    ];
                    
                    $statusLabels = [
                        'new' => 'New',
                        'contacted' => 'Contacted',
                        'proposal' => 'Proposal',
                        'negotiation' => 'Negotiation',
                        'won' => 'Won',
                        'lost' => 'Lost',
                    ];
                    
                    $statusIcons = [
                        'new' => 'sparkles',
                        'contacted' => 'chatbubbles',
                        'proposal' => 'document',
                        'negotiation' => 'swap-horizontal',
                        'won' => 'checkmark-circle',
                        'lost' => 'close-circle',
                    ];
                @endphp
                
                @foreach(['new', 'contacted', 'proposal', 'negotiation', 'won', 'lost'] as $status)
                    <div class="w-80 flex-shrink-0">
                        <!-- Column Header -->
                        <div class="flex items-center justify-between mb-3 px-2">
                            <div class="flex items-center space-x-2">
                                <ion-icon name="{{ $statusIcons[$status] }}" class="text-slate-500"></ion-icon>
                                <h3 class="font-semibold text-slate-700">{{ $statusLabels[$status] }}</h3>
                                <span class="px-2 py-0.5 bg-slate-200 text-slate-600 text-xs rounded-full">
                                    {{ $kanban[$status]->count() }}
                                </span>
                            </div>
                        </div>
                        
                        <!-- Cards Container -->
                        <div class="space-y-3 {{ $statusColors[$status] }} border rounded-xl p-3 min-h-[200px]">
                            @forelse($kanban[$status] as $lead)
                                <div class="kanban-card bg-white rounded-lg shadow-sm border border-slate-200 p-4 cursor-pointer hover:shadow-md transition-shadow"
                                     onclick="window.location.href='{{ route('leads.show', $lead) }}'">
                                    <div class="flex items-start justify-between mb-2">
                                        <h4 class="font-semibold text-slate-900 text-sm line-clamp-2">{{ $lead->title }}</h4>
                                        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'manager')
                                            <span class="text-xs text-slate-500">{{ $lead->user->name }}</span>
                                        @endif
                                    </div>
                                    
                                    <p class="text-xs text-slate-600 mb-3">
                                        <ion-icon name="business"></ion-icon>
                                        {{ $lead->client->company_name ?? 'N/A' }}
                                    </p>
                                    
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm font-semibold text-primary-600">
                                            Rp {{ number_format($lead->expected_value, 0, ',', '.') }}
                                        </span>
                                        <div class="flex items-center space-x-1 text-xs text-slate-400">
                                            <ion-icon name="time"></ion-icon>
                                            <span>{{ $lead->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                    
                                    @if($lead->activities->count() > 0)
                                        <div class="mt-3 pt-3 border-t border-slate-100">
                                            <div class="flex items-center space-x-2 text-xs text-slate-500">
                                                @php
                                                    $lastActivity = $lead->activities->first();
                                                @endphp
                                                @if($lastActivity->type === 'call')
                                                    <ion-icon name="call"></ion-icon>
                                                @elseif($lastActivity->type === 'email')
                                                    <ion-icon name="mail"></ion-icon>
                                                @else
                                                    <ion-icon name="meetings"></ion-icon>
                                                @endif
                                                <span>{{ $lastActivity->activity_date->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <div class="text-center py-8 text-slate-400 text-sm">
                                    <ion-icon name="folder-open" class="text-3xl mx-auto mb-2"></ion-icon>
                                    <p>Tidak ada lead</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layout.app>
