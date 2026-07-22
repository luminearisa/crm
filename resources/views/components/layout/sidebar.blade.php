@props(['sidebarOpen' => false])

<aside 
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 text-white transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0"
>
    <!-- Logo -->
    <div class="flex items-center justify-between h-16 px-4 bg-slate-800 border-b border-slate-700">
        <div class="flex items-center space-x-2">
            <ion-icon name="business" class="text-2xl text-primary-400"></ion-icon>
            <span class="text-lg font-bold">CRM Enterprise</span>
        </div>
        <button 
            @click="sidebarOpen = false" 
            class="lg:hidden text-slate-400 hover:text-white"
        >
            <ion-icon name="close" class="text-xl"></ion-icon>
        </button>
    </div>
    
    <!-- Navigation -->
    <nav class="mt-4 px-2 space-y-1 overflow-y-auto max-h-[calc(100vh-4rem)]">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" 
           class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('dashboard') ? 'bg-primary-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            <ion-icon name="stats-chart" class="text-lg mr-3"></ion-icon>
            Dashboard
        </a>
        
        <!-- Leads -->
        <a href="{{ route('leads.index') }}" 
           class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('leads.*') ? 'bg-primary-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            <ion-icon name="funnel" class="text-lg mr-3"></ion-icon>
            Pipeline Leads
        </a>
        
        <!-- Clients -->
        <a href="#" 
           class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white">
            <ion-icon name="people" class="text-lg mr-3"></ion-icon>
            Klien
        </a>
        
        <!-- Proposals -->
        <a href="{{ route('proposals.index') }}" 
           class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('proposals.*') ? 'bg-primary-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            <ion-icon name="document-text" class="text-lg mr-3"></ion-icon>
            Proposal
        </a>
        
        <!-- Invoices -->
        <a href="{{ route('invoices.index') }}" 
           class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('invoices.*') ? 'bg-primary-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            <ion-icon name="cash" class="text-lg mr-3"></ion-icon>
            Invoice
        </a>
        
        <!-- Divider -->
        <div class="my-4 border-t border-slate-700"></div>
        
        <!-- Activities -->
        <a href="#" 
           class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white">
            <ion-icon name="calendar" class="text-lg mr-3"></ion-icon>
            Aktivitas
        </a>
        
        <!-- Tasks -->
        <a href="#" 
           class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white">
            <ion-icon name="checkbox" class="text-lg mr-3"></ion-icon>
            Tugas
        </a>
        
        <!-- Events -->
        <a href="#" 
           class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white">
            <ion-icon name="today" class="text-lg mr-3"></ion-icon>
            Kalender
        </a>
        
        <!-- Tickets -->
        <a href="#" 
           class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white">
            <ion-icon name="ticket" class="text-lg mr-3"></ion-icon>
            Tiket Support
        </a>
        
        <!-- Documents -->
        <a href="#" 
           class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white">
            <ion-icon name="folder" class="text-lg mr-3"></ion-icon>
            Dokumen
        </a>
        
        <!-- Expenses -->
        <a href="#" 
           class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white">
            <ion-icon name="wallet" class="text-lg mr-3"></ion-icon>
            Pengeluaran
        </a>
        
        <!-- Services -->
        <a href="#" 
           class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white">
            <ion-icon name="pricetag" class="text-lg mr-3"></ion-icon>
            Layanan
        </a>
        
        <!-- Divider -->
        <div class="my-4 border-t border-slate-700"></div>
        
        <!-- Settings (Admin Only) -->
        @if(auth()->user()->role === 'admin')
        <a href="#" 
           class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white">
            <ion-icon name="settings" class="text-lg mr-3"></ion-icon>
            Pengaturan
        </a>
        @endif
        
        <!-- Leaderboard -->
        <a href="#" 
           class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white">
            <ion-icon name="trophy" class="text-lg mr-3"></ion-icon>
            Leaderboard
        </a>
    </nav>
    
    <!-- User Info (Bottom) -->
    <div class="absolute bottom-0 left-0 right-0 p-4 bg-slate-800 border-t border-slate-700">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 rounded-full bg-primary-600 flex items-center justify-center text-white font-semibold">
                {{ substr(auth()->user()->name, 0, 1) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-white truncate">{{ auth()->user()->name }}</p>
                <p class="text-xs text-slate-400 capitalize">{{ auth()->user()->role }}</p>
            </div>
        </div>
    </div>
</aside>
