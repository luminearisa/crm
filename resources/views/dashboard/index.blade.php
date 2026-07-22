<x-layout.app title="Dashboard">
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-900">Dashboard</h2>
                <p class="text-slate-600 mt-1">Selamat datang, {{ auth()->user()->name }}!</p>
            </div>
            <div class="flex items-center space-x-3">
                <x-ui.button variant="primary" icon="add" href="{{ route('leads.create') }}">
                    Lead Baru
                </x-ui.button>
            </div>
        </div>
        
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Leads -->
            <x-ui.card padding="p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-600">Total Leads</p>
                        <p class="text-3xl font-bold text-slate-900 mt-1">{{ number_format($totalLeads) }}</p>
                        <p class="text-xs text-slate-500 mt-2">
                            <span class="text-green-600 font-medium">{{ $activeLeads }}</span> aktif
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center">
                        <ion-icon name="funnel" class="text-2xl text-primary-600"></ion-icon>
                    </div>
                </div>
            </x-ui.card>
            
            <!-- Won Deals -->
            <x-ui.card padding="p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-600">Deal Won</p>
                        <p class="text-3xl font-bold text-green-600 mt-1">{{ number_format($wonLeads) }}</p>
                        <p class="text-xs text-slate-500 mt-2">
                            <span class="text-red-500 font-medium">{{ $lostLeads }}</span> lost
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                        <ion-icon name="trophy" class="text-2xl text-green-600"></ion-icon>
                    </div>
                </div>
            </x-ui.card>
            
            <!-- Revenue -->
            <x-ui.card padding="p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-600">Revenue (Paid)</p>
                        <p class="text-2xl font-bold text-slate-900 mt-1">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                        <p class="text-xs text-slate-500 mt-2">
                            Pending: Rp {{ number_format($pendingRevenue, 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <ion-icon name="cash" class="text-2xl text-blue-600"></ion-icon>
                    </div>
                </div>
            </x-ui.card>
            
            <!-- Unpaid Invoices -->
            <x-ui.card padding="p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-600">Invoice Belum Dibayar</p>
                        <p class="text-3xl font-bold text-orange-600 mt-1">{{ number_format($unpaidInvoices) }}</p>
                        <p class="text-xs text-slate-500 mt-2">
                            Total: {{ number_format($totalInvoices) }} invoice
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                        <ion-icon name="document-text" class="text-2xl text-orange-600"></ion-icon>
                    </div>
                </div>
            </x-ui.card>
        </div>
        
        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Recent Activities -->
            <div class="lg:col-span-2">
                <x-ui.card>
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-slate-900">Aktivitas Terbaru</h3>
                        <a href="#" class="text-sm text-primary-600 hover:text-primary-700 font-medium">Lihat Semua</a>
                    </div>
                    
                    @if($recentActivities->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentActivities as $activity)
                                <div class="flex items-start space-x-3 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                                    <div class="flex-shrink-0">
                                        @if($activity->type === 'call')
                                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                                <ion-icon name="call" class="text-blue-600 text-lg"></ion-icon>
                                            </div>
                                        @elseif($activity->type === 'email')
                                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                                <ion-icon name="mail" class="text-green-600 text-lg"></ion-icon>
                                            </div>
                                        @else
                                            <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                                                <ion-icon name="meetings" class="text-purple-600 text-lg"></ion-icon>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-slate-900">
                                            {{ $activity->notes ?? 'Tidak ada catatan' }}
                                        </p>
                                        <p class="text-xs text-slate-500 mt-1">
                                            {{ $activity->user->name }} • {{ $activity->lead->title ?? 'N/A' }}
                                        </p>
                                        <p class="text-xs text-slate-400 mt-1">
                                            {{ $activity->activity_date->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <ion-icon name="calendar-outline" class="text-4xl text-slate-300 mx-auto mb-2"></ion-icon>
                            <p class="text-slate-500">Belum ada aktivitas</p>
                        </div>
                    @endif
                </x-ui.card>
            </div>
            
            <!-- Leaderboard -->
            <div class="lg:col-span-1">
                <x-ui.card>
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-slate-900">Top Performers</h3>
                        <ion-icon name="trophy" class="text-yellow-500 text-xl"></ion-icon>
                    </div>
                    
                    @if($leaderboard->count() > 0)
                        <div class="space-y-3">
                            @foreach($leaderboard as $index => $agent)
                                <div class="flex items-center space-x-3 p-2 rounded-lg {{ $index < 3 ? 'bg-yellow-50' : '' }}">
                                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-primary-600 flex items-center justify-center text-white text-sm font-semibold">
                                        {{ substr($agent->name, 0, 1) }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-slate-900 truncate">{{ $agent->name }}</p>
                                        <p class="text-xs text-slate-500">
                                            {{ $agent->total_leads }} won • Win rate: {{ $winRates[$agent->id] }}%
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-semibold text-slate-900">
                                            Rp {{ number_format($agent->total_value ?? 0, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <ion-icon name="people-outline" class="text-4xl text-slate-300 mx-auto mb-2"></ion-icon>
                            <p class="text-slate-500">Belum ada data performer</p>
                        </div>
                    @endif
                </x-ui.card>
            </div>
        </div>
    </div>
</x-layout.app>
