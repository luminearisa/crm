<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NexusCRM - Platform CRM #1 untuk Bisnis Indonesia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .gradient-text {
            background: linear-gradient(135deg, #3B82F6 0%, #8B5CF6 50%, #EC4899 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hero-gradient {
            background: linear-gradient(135deg, #1e293b 0%, #334155 50%, #475569 100%);
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">
    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 bg-white/95 backdrop-blur-sm shadow-sm z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                        <ion-icon name="pulse" class="text-white text-xl"></ion-icon>
                    </div>
                    <span class="text-xl font-bold gradient-text">NexusCRM</span>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#features" class="text-slate-600 hover:text-blue-600 transition-colors font-medium">Fitur</a>
                    <a href="#benefits" class="text-slate-600 hover:text-blue-600 transition-colors font-medium">Keunggulan</a>
                    <a href="#testimonials" class="text-slate-600 hover:text-blue-600 transition-colors font-medium">Testimoni</a>
                    <a href="{{ route('login') }}" class="text-slate-600 hover:text-blue-600 transition-colors font-medium">Login</a>
                    <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg font-semibold transition-all shadow-md hover:shadow-lg">
                        Mulai Sekarang
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 hero-gradient text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-4xl mx-auto">
                <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full mb-6">
                    <ion-icon name="star" class="text-yellow-400"></ion-icon>
                    <span class="text-sm font-medium">Platform CRM #1 di Indonesia</span>
                </div>
                <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                    Kelola Hubungan Pelanggan dengan Lebih <span class="text-blue-400">Cerdas</span>
                </h1>
                <p class="text-xl text-slate-300 mb-10 max-w-2xl mx-auto">
                    Tingkatkan penjualan, otomatisasi follow-up, dan berikan layanan pelanggan terbaik dengan platform CRM all-in-one yang dirancang untuk bisnis modern.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-4 rounded-xl font-semibold text-lg transition-all shadow-lg hover:shadow-xl flex items-center justify-center space-x-2">
                        <span>Coba Gratis</span>
                        <ion-icon name="arrow-forward"></ion-icon>
                    </a>
                    <a href="#features" class="bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white px-8 py-4 rounded-xl font-semibold text-lg transition-all flex items-center justify-center space-x-2">
                        <ion-icon name="play-circle"></ion-icon>
                        <span>Lihat Demo</span>
                    </a>
                </div>
            </div>
            
            <!-- Stats -->
            <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto">
                <div class="text-center">
                    <div class="text-4xl font-bold text-blue-400 mb-2">2000+</div>
                    <div class="text-slate-300">Perusahaan Percaya</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-purple-400 mb-2">98%</div>
                    <div class="text-slate-300">Kepuasan Pelanggan</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-pink-400 mb-2">24/7</div>
                    <div class="text-slate-300">Dukungan Teknis</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-slate-900 mb-4">Fitur Lengkap untuk Bisnis Anda</h2>
                <p class="text-xl text-slate-600 max-w-2xl mx-auto">Semua alat yang Anda butuhkan untuk mengelola hubungan pelanggan dalam satu platform terintegrasi.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-slate-50 rounded-2xl p-8 card-hover transition-all duration-300">
                    <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center mb-6">
                        <ion-icon name="funnel" class="text-blue-600 text-2xl"></ion-icon>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Pipeline Kanban</h3>
                    <p class="text-slate-600">Visualisasikan proses penjualan dengan board Kanban yang intuitif. Drag & drop leads melalui setiap tahap pipeline.</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="bg-slate-50 rounded-2xl p-8 card-hover transition-all duration-300">
                    <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center mb-6">
                        <ion-icon name="document-text" class="text-purple-600 text-2xl"></ion-icon>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Digital Invoice</h3>
                    <p class="text-slate-600">Buat dan kirim invoice profesional secara digital. Lacak pembayaran dengan sistem notifikasi otomatis.</p>
                </div>
                
                <!-- Feature 3 -->
                <div class="bg-slate-50 rounded-2xl p-8 card-hover transition-all duration-300">
                    <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center mb-6">
                        <ion-icon name="people" class="text-green-600 text-2xl"></ion-icon>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Client Management</h3>
                    <p class="text-slate-600">Kelola data klien secara terpusat. Akses riwayat interaksi, dokumen, dan transaksi dalam satu tempat.</p>
                </div>
                
                <!-- Feature 4 -->
                <div class="bg-slate-50 rounded-2xl p-8 card-hover transition-all duration-300">
                    <div class="w-14 h-14 bg-orange-100 rounded-xl flex items-center justify-center mb-6">
                        <ion-icon name="calendar" class="text-orange-600 text-2xl"></ion-icon>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Smart Calendar</h3>
                    <p class="text-slate-600">Jadwalkan meeting, follow-up, dan tugas dengan kalender terintegrasi. Dapatkan pengingat otomatis.</p>
                </div>
                
                <!-- Feature 5 -->
                <div class="bg-slate-50 rounded-2xl p-8 card-hover transition-all duration-300">
                    <div class="w-14 h-14 bg-red-100 rounded-xl flex items-center justify-center mb-6">
                        <ion-icon name="ticket" class="text-red-600 text-2xl"></ion-icon>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Ticketing System</h3>
                    <p class="text-slate-600">Kelola dukungan pelanggan dengan sistem tiket yang efisien. Prioritaskan dan selesaikan masalah dengan cepat.</p>
                </div>
                
                <!-- Feature 6 -->
                <div class="bg-slate-50 rounded-2xl p-8 card-hover transition-all duration-300">
                    <div class="w-14 h-14 bg-indigo-100 rounded-xl flex items-center justify-center mb-6">
                        <ion-icon name="analytics" class="text-indigo-600 text-2xl"></ion-icon>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Analytics & Reports</h3>
                    <p class="text-slate-600">Dapatkan insight mendalam dengan dashboard analitik. Pantau performa tim dan metrik penjualan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section id="benefits" class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-4xl font-bold text-slate-900 mb-6">Mengapa Memilih NexusCRM?</h2>
                    <p class="text-xl text-slate-600 mb-8">Platform kami dirancang khusus untuk membantu bisnis Indonesia tumbuh lebih cepat dengan manajemen pelanggan yang efektif.</p>
                    
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <ion-icon name="checkmark-circle" class="text-green-500 text-xl mt-1"></ion-icon>
                            <div>
                                <h4 class="font-semibold text-slate-900">Interface Intuitif</h4>
                                <p class="text-slate-600">Mudah digunakan tanpa perlu pelatihan panjang</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <ion-icon name="checkmark-circle" class="text-green-500 text-xl mt-1"></ion-icon>
                            <div>
                                <h4 class="font-semibold text-slate-900">Integrasi Lengkap</h4>
                                <p class="text-slate-600">Terhubung dengan tools favorit Anda</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <ion-icon name="checkmark-circle" class="text-green-500 text-xl mt-1"></ion-icon>
                            <div>
                                <h4 class="font-semibold text-slate-900">Keamanan Terjamin</h4>
                                <p class="text-slate-600">Data Anda dilindungi dengan enkripsi tingkat enterprise</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <ion-icon name="checkmark-circle" class="text-green-500 text-xl mt-1"></ion-icon>
                            <div>
                                <h4 class="font-semibold text-slate-900">Support Lokal</h4>
                                <p class="text-slate-600">Tim dukungan siap membantu 24/7 dalam Bahasa Indonesia</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="relative">
                    <div class="bg-white rounded-2xl shadow-2xl p-8">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-blue-50 rounded-xl p-6 text-center">
                                <div class="text-3xl font-bold text-blue-600 mb-2">+45%</div>
                                <div class="text-sm text-slate-600">Peningkatan Lead</div>
                            </div>
                            <div class="bg-purple-50 rounded-xl p-6 text-center">
                                <div class="text-3xl font-bold text-purple-600 mb-2">+32%</div>
                                <div class="text-sm text-slate-600">Conversion Rate</div>
                            </div>
                            <div class="bg-green-50 rounded-xl p-6 text-center">
                                <div class="text-3xl font-bold text-green-600 mb-2">-60%</div>
                                <div class="text-sm text-slate-600">Waktu Admin</div>
                            </div>
                            <div class="bg-orange-50 rounded-xl p-6 text-center">
                                <div class="text-3xl font-bold text-orange-600 mb-2">+85%</div>
                                <div class="text-sm text-slate-600">Kepuasan Klien</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-slate-900 mb-4">Apa Kata Mereka?</h2>
                <p class="text-xl text-slate-600">Ribuan bisnis telah merasakan manfaat NexusCRM</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-slate-50 rounded-2xl p-8">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold text-lg">A</div>
                        <div class="ml-4">
                            <div class="font-semibold text-slate-900">Andi Pratama</div>
                            <div class="text-sm text-slate-600">CEO, TechStart Indonesia</div>
                        </div>
                    </div>
                    <p class="text-slate-600">"Sejak menggunakan NexusCRM, tim sales kami menjadi 3x lebih produktif. Pipeline management sangat mudah dan intuitif."</p>
                    <div class="flex mt-4 text-yellow-400">
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                    </div>
                </div>
                
                <!-- Testimonial 2 -->
                <div class="bg-slate-50 rounded-2xl p-8">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center text-white font-bold text-lg">S</div>
                        <div class="ml-4">
                            <div class="font-semibold text-slate-900">Siti Nurhaliza</div>
                            <div class="text-sm text-slate-600">Marketing Director, Digital Solutions</div>
                        </div>
                    </div>
                    <p class="text-slate-600">"Fitur digital invoice sangat membantu kami mempercepat proses billing. Cash flow perusahaan jadi lebih sehat."</p>
                    <div class="flex mt-4 text-yellow-400">
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                    </div>
                </div>
                
                <!-- Testimonial 3 -->
                <div class="bg-slate-50 rounded-2xl p-8">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center text-white font-bold text-lg">B</div>
                        <div class="ml-4">
                            <div class="font-semibold text-slate-900">Budi Santoso</div>
                            <div class="text-sm text-slate-600">Founder, E-Commerce Hub</div>
                        </div>
                    </div>
                    <p class="text-slate-600">"Customer support kami jadi lebih responsif dengan sistem ticketing. Pelanggan lebih puas dan loyalitas meningkat."</p>
                    <div class="flex mt-4 text-yellow-400">
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-blue-600 to-purple-600">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-bold text-white mb-6">Siap Meningkatkan Bisnis Anda?</h2>
            <p class="text-xl text-blue-100 mb-10">Bergabunglah dengan ribuan bisnis lain yang telah merasakan manfaat NexusCRM.</p>
            <a href="{{ route('login') }}" class="inline-flex items-center space-x-2 bg-white text-blue-600 px-8 py-4 rounded-xl font-semibold text-lg hover:bg-blue-50 transition-all shadow-lg hover:shadow-xl">
                <span>Mulai Sekarang - Gratis!</span>
                <ion-icon name="arrow-forward"></ion-icon>
            </a>
            <p class="text-blue-200 mt-4 text-sm">Tidak perlu kartu kredit • Setup dalam 5 menit</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                            <ion-icon name="pulse" class="text-white text-xl"></ion-icon>
                        </div>
                        <span class="text-xl font-bold">NexusCRM</span>
                    </div>
                    <p class="text-slate-400 mb-6">Platform CRM terdepan untuk membantu bisnis Indonesia berkembang lebih cepat.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-slate-400 hover:text-white transition-colors">
                            <ion-icon name="logo-facebook" class="text-xl"></ion-icon>
                        </a>
                        <a href="#" class="text-slate-400 hover:text-white transition-colors">
                            <ion-icon name="logo-twitter" class="text-xl"></ion-icon>
                        </a>
                        <a href="#" class="text-slate-400 hover:text-white transition-colors">
                            <ion-icon name="logo-instagram" class="text-xl"></ion-icon>
                        </a>
                        <a href="#" class="text-slate-400 hover:text-white transition-colors">
                            <ion-icon name="logo-linkedin" class="text-xl"></ion-icon>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">Produk</h4>
                    <ul class="space-y-2 text-slate-400">
                        <li><a href="#features" class="hover:text-white transition-colors">Fitur</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Harga</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Integrasi</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">API</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">Perusahaan</h4>
                    <ul class="space-y-2 text-slate-400">
                        <li><a href="#" class="hover:text-white transition-colors">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Karir</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Blog</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Kontak</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">Bantuan</h4>
                    <ul class="space-y-2 text-slate-400">
                        <li><a href="#" class="hover:text-white transition-colors">Pusat Bantuan</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Dokumentasi</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Status Sistem</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Kebijakan Privasi</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-slate-800 mt-12 pt-8 text-center text-slate-400">
                <p>&copy; 2024 NexusCRM. Hak cipta dilindungi undang-undang.</p>
            </div>
        </div>
    </footer>
</body>
</html>
