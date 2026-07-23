<x-layout.app>
    <x-slot name="title">Leaderboard Penjualan</x-slot>
    <x-slot name="subtitle">Ranking performa tim sales</x-slot>

    <div class="space-y-6">
        <!-- Top Performers -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($topPerformers as $index => $user)
            <x-ui.card class="{{ $index === 0 ? 'ring-2 ring-yellow-400 bg-gradient-to-br from-yellow-50 to-white' : '' }} {{ $index === 1 ? 'ring-2 ring-slate-300 bg-gradient-to-br from-slate-50 to-white' : '' }} {{ $index === 2 ? 'ring-2 ring-orange-300 bg-gradient-to-br from-orange-50 to-white' : '' }}">
                <div class="text-center">
                    <div class="relative inline-block mb-4">
                        <div class="w-20 h-20 rounded-full bg-primary-600 flex items-center justify-center text-white text-2xl font-bold mx-auto">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                        @if($index === 0)
                            <div class="absolute -top-2 -right-2 w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center text-yellow-900 font-bold shadow-lg">🥇</div>
                        @elseif($index === 1)
                            <div class="absolute -top-2 -right-2 w-8 h-8 bg-slate-300 rounded-full flex items-center justify-center text-slate-700 font-bold shadow-lg">🥈</div>
                        @elseif($index === 2)
                            <div class="absolute -top-2 -right-2 w-8 h-8 bg-orange-300 rounded-full flex items-center justify-center text-orange-800 font-bold shadow-lg">🥉</div>
                        @endif
                    </div>
                    <h3 class="text-lg font-semibold text-slate-900">{{ $user->name }}</h3>
                    <p class="text-sm text-slate-500 capitalize">{{ ucfirst($user->role) }}</p>
                    
                    <div class="mt-4 grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-2xl font-bold text-primary-600">{{ $user->wonLeadsCount ?? 0 }}</p>
                            <p class="text-xs text-slate-500">Deals Won</p>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-green-600">Rp {{ number_format($user->totalSales ?? 0, 0, ',', '.') }}</p>
                            <p class="text-xs text-slate-500">Total Sales</p>
                        </div>
                    </div>
                    
                    <div class="mt-4 pt-4 border-t border-slate-200">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-600">Win Rate</span>
                            <span class="text-lg font-bold text-primary-600">{{ $user->winRate ?? 0 }}%</span>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2 mt-2">
                            <div class="bg-primary-600 h-2 rounded-full" style="width: {{ $user->winRate ?? 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </x-ui.card>
            @endforeach
        </div>

        <!-- Full Ranking Table -->
        <x-ui.card>
            <h3 class="text-lg font-semibold text-slate-900 mb-4">Ranking Lengkap</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">#</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Role</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase">Total Leads</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase">Won</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase">Lost</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase">Win Rate</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase">Total Sales</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        @foreach($allUsers as $index => $user)
                        <tr class="{{ $index < 3 ? 'bg-slate-50' : '' }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($index === 0)
                                    <span class="text-xl">🥇</span>
                                @elseif($index === 1)
                                    <span class="text-xl">🥈</span>
                                @elseif($index === 2)
                                    <span class="text-xl">🥉</span>
                                @else
                                    <span class="text-sm font-medium text-slate-900">{{ $index + 1 }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 font-semibold mr-3">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <span class="text-sm font-medium text-slate-900">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800 capitalize">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-slate-900">{{ $user->totalLeads ?? 0 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-green-600 font-medium">{{ $user->wonLeadsCount ?? 0 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-red-600">{{ $user->lostLeadsCount ?? 0 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ ($user->winRate ?? 0) >= 50 ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $user->winRate ?? 0 }}%
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium text-slate-900">
                                Rp {{ number_format($user->totalSales ?? 0, 0, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-ui.card>
    </div>
</x-layout.app>
