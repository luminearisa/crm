<x-layout.app title="Login">
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-primary-600 to-primary-800 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full">
            <!-- Logo & Title -->
            <div class="text-center mb-8">
                <div class="mx-auto h-16 w-16 bg-white rounded-xl flex items-center justify-center shadow-lg">
                    <ion-icon name="business" class="text-4xl text-primary-600"></ion-icon>
                </div>
                <h2 class="mt-4 text-3xl font-bold text-white">CRM Enterprise</h2>
                <p class="mt-2 text-primary-100">Masuk ke akun Anda</p>
            </div>
            
            <!-- Login Form -->
            <x-ui.card padding="p-8" class="shadow-xl">
                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <x-ui.input 
                            name="email" 
                            label="Email" 
                            type="email" 
                            placeholder="nama@perusahaan.com"
                            required
                            :error="$errors->first('email')"
                        />
                    </div>
                    
                    <div>
                        <x-ui.input 
                            name="password" 
                            label="Password" 
                            type="password" 
                            placeholder="••••••••"
                            required
                            :error="$errors->first('password')"
                        />
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input 
                                id="remember" 
                                name="remember" 
                                type="checkbox" 
                                class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-slate-300 rounded"
                            >
                            <label for="remember" class="ml-2 block text-sm text-slate-700">
                                Ingat saya
                            </label>
                        </div>
                        
                        <a href="#" class="text-sm font-medium text-primary-600 hover:text-primary-700">
                            Lupa password?
                        </a>
                    </div>
                    
                    <div>
                        <x-ui.button type="submit" variant="primary" class="w-full" size="lg">
                            Masuk
                        </x-ui.button>
                    </div>
                </form>
                
                <!-- Demo Credentials -->
                <div class="mt-6 pt-6 border-t border-slate-200">
                    <p class="text-xs text-slate-500 text-center mb-3">Demo Credentials:</p>
                    <div class="space-y-2 text-xs">
                        <div class="flex justify-between p-2 bg-slate-50 rounded">
                            <span class="text-slate-600">Admin:</span>
                            <span class="text-slate-900 font-mono">admin@crm.test / password</span>
                        </div>
                        <div class="flex justify-between p-2 bg-slate-50 rounded">
                            <span class="text-slate-600">Manager:</span>
                            <span class="text-slate-900 font-mono">manager@crm.test / password</span>
                        </div>
                        <div class="flex justify-between p-2 bg-slate-50 rounded">
                            <span class="text-slate-600">Agent:</span>
                            <span class="text-slate-900 font-mono">agent@crm.test / password</span>
                        </div>
                    </div>
                </div>
            </x-ui.card>
            
            <!-- Footer -->
            <p class="mt-8 text-center text-sm text-primary-100">
                &copy; {{ date('Y') }} CRM Enterprise. All rights reserved.
            </p>
        </div>
    </div>
</x-layout.app>
