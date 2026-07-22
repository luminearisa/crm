<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NexusCRM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .gradient-bg {
            background: linear-gradient(135deg, #1e293b 0%, #334155 50%, #475569 100%);
        }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-6xl bg-white rounded-2xl shadow-2xl overflow-hidden grid grid-cols-1 lg:grid-cols-2">
        <!-- Left Side - Branding -->
        <div class="gradient-bg p-12 flex flex-col justify-between hidden lg:flex">
            <div>
                <div class="flex items-center space-x-3 mb-8">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-purple-500 rounded-xl flex items-center justify-center">
                        <ion-icon name="pulse" class="text-white text-2xl"></ion-icon>
                    </div>
                    <span class="text-2xl font-bold text-white">NexusCRM</span>
                </div>
                <h1 class="text-4xl font-bold text-white mb-6 leading-tight">
                    Kelola Bisnis dengan Lebih Cerdas
                </h1>
                <p class="text-slate-300 text-lg mb-8">
                    Bergabunglah dengan ribuan bisnis lain yang telah merasakan manfaat platform CRM terintegrasi kami.
                </p>
                
                <div class="space-y-4">
                    <div class="flex items-center space-x-3 text-slate-300">
                        <ion-icon name="checkmark-circle" class="text-green-400 text-xl"></ion-icon>
                        <span>Pipeline Kanban yang Intuitif</span>
                    </div>
                    <div class="flex items-center space-x-3 text-slate-300">
                        <ion-icon name="checkmark-circle" class="text-green-400 text-xl"></ion-icon>
                        <span>Digital Invoice Otomatis</span>
                    </div>
                    <div class="flex items-center space-x-3 text-slate-300">
                        <ion-icon name="checkmark-circle" class="text-green-400 text-xl"></ion-icon>
                        <span>Analytics & Reporting Lengkap</span>
                    </div>
                </div>
            </div>
            
            <div>
                <div class="flex items-center space-x-2 mb-4">
                    <div class="flex -space-x-2">
                        <div class="w-10 h-10 bg-blue-400 rounded-full border-2 border-slate-700"></div>
                        <div class="w-10 h-10 bg-purple-400 rounded-full border-2 border-slate-700"></div>
                        <div class="w-10 h-10 bg-green-400 rounded-full border-2 border-slate-700"></div>
                        <div class="w-10 h-10 bg-orange-400 rounded-full border-2 border-slate-700"></div>
                    </div>
                    <span class="text-slate-300 ml-2">2000+ pengguna aktif</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="flex text-yellow-400">
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                    </div>
                    <span class="text-white font-semibold">4.9/5 rating</span>
                </div>
            </div>
        </div>
        
        <!-- Right Side - Login Form -->
        <div class="p-8 lg:p-12">
            <div class="max-w-md mx-auto">
                <div class="lg:hidden flex items-center space-x-3 mb-8">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                        <ion-icon name="pulse" class="text-white text-xl"></ion-icon>
                    </div>
                    <span class="text-xl font-bold gradient-text">NexusCRM</span>
                </div>
                
                <h2 class="text-3xl font-bold text-slate-900 mb-2">Selamat Datang Kembali</h2>
                <p class="text-slate-600 mb-8">Masukkan kredensial Anda untuk mengakses dashboard</p>
                
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <div class="flex items-center space-x-2 text-red-700 mb-2">
                            <ion-icon name="warning" class="text-lg"></ion-icon>
                            <span class="font-semibold">Login Gagal</span>
                        </div>
                        <ul class="text-sm text-red-600 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-2">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <ion-icon name="mail" class="text-slate-400"></ion-icon>
                            </div>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}"
                                required 
                                autofocus
                                class="w-full pl-10 pr-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                                placeholder="nama@perusahaan.com"
                            >
                        </div>
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <ion-icon name="lock-closed" class="text-slate-400"></ion-icon>
                            </div>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                required
                                class="w-full pl-10 pr-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                                placeholder="••••••••"
                            >
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input 
                                type="checkbox" 
                                name="remember" 
                                class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500"
                            >
                            <span class="ml-2 text-sm text-slate-600">Ingat saya</span>
                        </label>
                        <a href="#" class="text-sm text-blue-600 hover:text-blue-700 font-medium">Lupa password?</a>
                    </div>
                    
                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white py-3 rounded-lg font-semibold transition-all shadow-md hover:shadow-lg flex items-center justify-center space-x-2"
                    >
                        <ion-icon name="log-in"></ion-icon>
                        <span>Masuk ke Dashboard</span>
                    </button>
                </form>
                
                <div class="mt-8 pt-8 border-t border-slate-200">
                    <p class="text-sm text-slate-600 text-center mb-4 font-medium">Demo Credentials:</p>
                    <div class="space-y-2 text-xs">
                        <div class="flex justify-between items-center p-3 bg-slate-50 rounded-lg">
                            <span class="text-slate-700 font-medium">Admin</span>
                            <code class="text-slate-600">admin@crm.com / password123</code>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-slate-50 rounded-lg">
                            <span class="text-slate-700 font-medium">Manager</span>
                            <code class="text-slate-600">manager@crm.com / password123</code>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-slate-50 rounded-lg">
                            <span class="text-slate-700 font-medium">Agent</span>
                            <code class="text-slate-600">john@crm.com / password123</code>
                        </div>
                    </div>
                </div>
                
                <p class="mt-8 text-center text-sm text-slate-600">
                    Belum punya akun? 
                    <a href="#" class="text-blue-600 hover:text-blue-700 font-semibold">Hubungi Admin</a>
                </p>
            </div>
        </div>
    </div>
    
    <footer class="fixed bottom-4 text-center text-sm text-slate-500">
        &copy; 2024 NexusCRM. All rights reserved.
    </footer>
</body>
</html>
