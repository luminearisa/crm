<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Enterprise CRM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 h-screen w-full flex overflow-hidden">

    <!-- Left Side: Branding & Visual (Hidden on Mobile) -->
    <div class="hidden lg:flex lg:w-1/2 bg-slate-900 relative flex-col justify-between p-12 text-white overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-20">
            <svg class="h-full w-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M0 100 C 20 0 50 0 100 100 Z" fill="url(#grad1)" />
                <defs>
                    <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" style="stop-color:#3b82f6;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#8b5cf6;stop-opacity:1" />
                    </linearGradient>
                </defs>
            </svg>
        </div>
        
        <!-- Content -->
        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center shadow-lg shadow-blue-500/50">
                    <ion-icon name="pulse" class="text-2xl text-white"></ion-icon>
                </div>
                <span class="text-2xl font-bold tracking-tight">Nexus<span class="text-blue-400">CRM</span></span>
            </div>
        </div>

        <div class="relative z-10 max-w-md">
            <h1 class="text-4xl font-bold mb-6 leading-tight">Kelola Hubungan Pelanggan dengan Lebih Cerdas.</h1>
            <p class="text-slate-300 text-lg mb-8">Platform all-in-one untuk tim sales, support, dan manajemen. Pantau pipeline, kelola invoice, dan tingkatkan produktivitas dalam satu dashboard.</p>
            
            <div class="flex gap-4">
                <div class="flex -space-x-3">
                    <img class="w-10 h-10 rounded-full border-2 border-slate-900" src="https://i.pravatar.cc/100?img=1" alt="User">
                    <img class="w-10 h-10 rounded-full border-2 border-slate-900" src="https://i.pravatar.cc/100?img=2" alt="User">
                    <img class="w-10 h-10 rounded-full border-2 border-slate-900" src="https://i.pravatar.cc/100?img=3" alt="User">
                    <div class="w-10 h-10 rounded-full border-2 border-slate-900 bg-slate-700 flex items-center justify-center text-xs font-medium">+2k</div>
                </div>
                <div class="flex flex-col justify-center">
                    <span class="text-yellow-400 flex text-sm">
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                    </span>
                    <span class="text-slate-400 text-xs">Dipercaya oleh 2,000+ perusahaan</span>
                </div>
            </div>
        </div>

        <div class="relative z-10 text-xs text-slate-500">
            &copy; {{ date('Y') }} NexusCRM Enterprise Solutions. All rights reserved.
        </div>
    </div>

    <!-- Right Side: Login Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 bg-white relative">
        <div class="w-full max-w-md space-y-8">
            
            <!-- Mobile Logo -->
            <div class="lg:hidden flex items-center gap-2 mb-8">
                <div class="w-8 h-8 bg-blue-600 rounded flex items-center justify-center">
                    <ion-icon name="pulse" class="text-xl text-white"></ion-icon>
                </div>
                <span class="text-xl font-bold text-slate-800">Nexus<span class="text-blue-600">CRM</span></span>
            </div>

            <div class="text-center lg:text-left">
                <h2 class="text-3xl font-bold tracking-tight text-slate-900">Selamat Datang Kembali</h2>
                <p class="mt-2 text-sm text-slate-500">Silakan masukkan kredensial Anda untuk mengakses dashboard.</p>
            </div>

            <form class="mt-8 space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                
                <div class="space-y-5">
                    <!-- Email Input -->
                    <div>
                        <label for="email" class="block text-sm font-medium leading-6 text-slate-700 mb-1">Alamat Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <ion-icon name="mail-outline" class="text-slate-400"></ion-icon>
                            </div>
                            <input id="email" name="email" type="email" autocomplete="email" required 
                                class="block w-full pl-10 pr-3 py-3 border border-slate-300 rounded-lg text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 sm:text-sm" 
                                placeholder="nama@perusahaan.com" value="{{ old('email') }}">
                        </div>
                        @error('email')
                            <p class="mt-2 text-xs text-red-600 flex items-center gap-1">
                                <ion-icon name="warning"></ion-icon> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div>
                        <label for="password" class="block text-sm font-medium leading-6 text-slate-700 mb-1">Kata Sandi</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <ion-icon name="lock-closed-outline" class="text-slate-400"></ion-icon>
                            </div>
                            <input id="password" name="password" type="password" autocomplete="current-password" required 
                                class="block w-full pl-10 pr-3 py-3 border border-slate-300 rounded-lg text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 sm:text-sm" 
                                placeholder="••••••••">
                        </div>
                        @error('password')
                            <p class="mt-2 text-xs text-red-600 flex items-center gap-1">
                                <ion-icon name="warning"></ion-icon> {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox" 
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300 rounded cursor-pointer">
                        <label for="remember-me" class="ml-2 block text-sm text-slate-600 cursor-pointer select-none">Ingat saya</label>
                    </div>

                    <div class="text-sm">
                        <a href="#" class="font-medium text-blue-600 hover:text-blue-500 hover:underline">Lupa kata sandi?</a>
                    </div>
                </div>

                <div>
                    <button type="submit" 
                        class="group relative flex w-full justify-center py-3 px-4 border border-transparent text-sm font-semibold rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <ion-icon name="log-in-outline" class="text-blue-300 group-hover:text-white transition-colors"></ion-icon>
                        </span>
                        Masuk ke Dashboard
                    </button>
                </div>
            </form>

            <!-- Demo Credentials Hint -->
            <div class="mt-6 pt-6 border-t border-slate-100">
                <p class="text-xs text-center text-slate-400 mb-2">Demo Login (Gunakan salah satu):</p>
                <div class="grid grid-cols-3 gap-2 text-[10px] text-slate-500">
                    <div class="bg-slate-50 p-2 rounded border border-slate-100 text-center">
                        <span class="block font-semibold text-slate-700">Admin</span>
                        admin@crm.com
                    </div>
                    <div class="bg-slate-50 p-2 rounded border border-slate-100 text-center">
                        <span class="block font-semibold text-slate-700">Manager</span>
                        manager@crm.com
                    </div>
                    <div class="bg-slate-50 p-2 rounded border border-slate-100 text-center">
                        <span class="block font-semibold text-slate-700">Agent</span>
                        john@crm.com
                    </div>
                </div>
                <p class="text-[10px] text-center text-slate-400 mt-2">Password: <code class="bg-slate-100 px-1 py-0.5 rounded text-slate-600">password123</code></p>
            </div>
        </div>
    </div>

</body>
</html>
