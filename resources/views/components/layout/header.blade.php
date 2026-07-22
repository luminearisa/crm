<header class="bg-white shadow-sm border-b border-slate-200 h-16">
    <div class="h-full px-4 flex items-center justify-between">
        <!-- Left: Menu Toggle & Page Title -->
        <div class="flex items-center space-x-4">
            <button 
                @click="sidebarOpen = true"
                class="lg:hidden p-2 rounded-lg text-slate-500 hover:bg-slate-100 hover:text-slate-700"
            >
                <ion-icon name="menu" class="text-xl"></ion-icon>
            </button>
            
            <h1 class="text-lg font-semibold text-slate-800 hidden sm:block">
                {{ $pageTitle ?? 'Dashboard' }}
            </h1>
        </div>
        
        <!-- Right: Actions -->
        <div class="flex items-center space-x-3">
            <!-- Notifications -->
            <button class="relative p-2 rounded-lg text-slate-500 hover:bg-slate-100 hover:text-slate-700">
                <ion-icon name="notifications" class="text-xl"></ion-icon>
                <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
            </button>
            
            <!-- Profile Dropdown -->
            <div class="relative" x-data="{ dropdownOpen: false }">
                <button 
                    @click="dropdownOpen = !dropdownOpen"
                    @click.away="dropdownOpen = false"
                    class="flex items-center space-x-2 p-2 rounded-lg hover:bg-slate-100"
                >
                    <div class="w-8 h-8 rounded-full bg-primary-600 flex items-center justify-center text-white text-sm font-semibold">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <span class="hidden md:block text-sm font-medium text-slate-700">
                        {{ auth()->user()->name }}
                    </span>
                    <ion-icon name="chevron-down" class="text-slate-400"></ion-icon>
                </button>
                
                <!-- Dropdown Menu -->
                <div 
                    x-show="dropdownOpen"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-2"
                    class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-slate-200 py-1 z-50"
                    x-cloak
                >
                    <a href="#" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
                        <div class="flex items-center">
                            <ion-icon name="person" class="mr-2"></ion-icon>
                            Profil
                        </div>
                    </a>
                    <a href="#" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
                        <div class="flex items-center">
                            <ion-icon name="settings" class="mr-2"></ion-icon>
                            Pengaturan
                        </div>
                    </a>
                    <div class="border-t border-slate-100 my-1"></div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                            <div class="flex items-center">
                                <ion-icon name="log-out" class="mr-2"></ion-icon>
                                Logout
                            </div>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
