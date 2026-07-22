<x-layout.app title="Digital Invoice">
    <!-- Digital Invoice View - HTML Murni untuk Share -->
    <div class="max-w-4xl mx-auto">
        <!-- Header Actions -->
        <div class="flex items-center justify-between mb-6">
            <a href="{{ route('invoices.index') }}" class="text-slate-600 hover:text-slate-900 flex items-center">
                <ion-icon name="arrow-back" class="mr-2"></ion-icon>
                Kembali
            </a>
            <div class="flex items-center space-x-3">
                <x-ui.button variant="secondary" size="sm" icon="download" onclick="window.print()">
                    Download PDF
                </x-ui.button>
            </div>
        </div>
        
        <!-- Invoice Container -->
        <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
            <!-- Invoice Header -->
            <div class="bg-gradient-to-r from-primary-600 to-primary-700 px-8 py-10 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold">INVOICE</h1>
                        <p class="text-primary-100 mt-1">{{ $invoice->invoice_number }}</p>
                    </div>
                    <div class="text-right">
                        @php
                            $companyName = \App\Models\Setting::get('company_name', 'CRM Enterprise');
                            $companyLogo = \App\Models\Setting::get('logo_url', null);
                        @endphp
                        @if($companyLogo)
                            <img src="{{ $companyLogo }}" alt="Logo" class="h-12 w-auto mb-2">
                        @endif
                        <p class="font-semibold">{{ $companyName }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Invoice Body -->
            <div class="px-8 py-8">
                <!-- Status Badge -->
                <div class="flex items-center justify-between mb-8">
                    @php
                        $statusBadges = [
                            'unpaid' => ['variant' => 'danger', 'label' => 'Belum Dibayar'],
                            'partial' => ['variant' => 'warning', 'label' => 'Dibayar Sebagian'],
                            'paid' => ['variant' => 'success', 'label' => 'Lunas'],
                        ];
                        $badge = $statusBadges[$invoice->status] ?? $statusBadges['unpaid'];
                    @endphp
                    <x-ui.badge :variant="$badge['variant']" size="lg">
                        {{ $badge['label'] }}
                    </x-ui.badge>
                    <p class="text-slate-600">
                        Tanggal: {{ $invoice->created_at->format('d F Y') }}
                    </p>
                </div>
                
                <!-- Bill To & Ship To -->
                <div class="grid grid-cols-2 gap-8 mb-8">
                    <div>
                        <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-3">Kepada:</h3>
                        <p class="font-semibold text-slate-900">{{ $invoice->proposal->lead->client->company_name ?? 'N/A' }}</p>
                        <p class="text-slate-600 mt-1">{{ $invoice->proposal->lead->client->contact_person ?? 'N/A' }}</p>
                        <p class="text-slate-600">{{ $invoice->proposal->lead->client->email ?? 'N/A' }}</p>
                        <p class="text-slate-600">{{ $invoice->proposal->lead->client->phone ?? 'N/A' }}</p>
                        @if($invoice->proposal->lead->client->address)
                            <p class="text-slate-600 mt-2">{{ $invoice->proposal->lead->client->address }}</p>
                        @endif
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-3">Detail Lead:</h3>
                        <p class="font-semibold text-slate-900">{{ $invoice->proposal->lead->title ?? 'N/A' }}</p>
                        <p class="text-slate-600 mt-1">Status: {{ ucfirst($invoice->proposal->lead->status) }}</p>
                        <p class="text-slate-600">PIC: {{ $invoice->proposal->lead->user->name ?? 'N/A' }}</p>
                    </div>
                </div>
                
                <!-- Items Table -->
                <div class="mb-8">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b-2 border-slate-200">
                                <th class="text-left py-3 px-4 text-sm font-semibold text-slate-700">No</th>
                                <th class="text-left py-3 px-4 text-sm font-semibold text-slate-700">Layanan/Produk</th>
                                <th class="text-center py-3 px-4 text-sm font-semibold text-slate-700">Qty</th>
                                <th class="text-right py-3 px-4 text-sm font-semibold text-slate-700">Harga Satuan</th>
                                <th class="text-right py-3 px-4 text-sm font-semibold text-slate-700">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoice->proposal->items as $index => $item)
                                <tr class="border-b border-slate-100">
                                    <td class="py-3 px-4 text-sm text-slate-600">{{ $index + 1 }}</td>
                                    <td class="py-3 px-4 text-sm text-slate-900">{{ $item->service->name ?? 'N/A' }}</td>
                                    <td class="py-3 px-4 text-sm text-slate-600 text-center">{{ $item->qty }}</td>
                                    <td class="py-3 px-4 text-sm text-slate-600 text-right">
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </td>
                                    <td class="py-3 px-4 text-sm font-semibold text-slate-900 text-right">
                                        Rp {{ number_format($item->qty * $item->price, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="py-3 px-4 text-right font-semibold text-slate-700">Subtotal:</td>
                                <td class="py-3 px-4 text-right font-semibold text-slate-900">
                                    Rp {{ number_format($invoice->total_amount, 0, ',', '.') }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="py-3 px-4 text-right font-semibold text-slate-700">Total Amount:</td>
                                <td class="py-3 px-4 text-right font-bold text-lg text-primary-600">
                                    Rp {{ number_format($invoice->total_amount, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <!-- Payment Terms -->
                <div class="bg-slate-50 rounded-lg p-6 mb-8">
                    <h3 class="text-lg font-semibold text-slate-900 mb-4">Informasi Pembayaran</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm text-slate-600 mb-1">Minimum Pembayaran</p>
                            <p class="text-2xl font-bold text-primary-600">
                                Rp {{ number_format($invoice->minimum_payment, 0, ',', '.') }}
                            </p>
                            <p class="text-xs text-slate-500 mt-1">
                                Silakan transfer minimal jumlah di atas untuk memproses pesanan Anda
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-600 mb-1">Status Pembayaran</p>
                            <p class="text-lg font-semibold text-slate-900 capitalize">{{ $invoice->status }}</p>
                            @if($invoice->status === 'partial')
                                <p class="text-xs text-slate-500 mt-1">
                                    Sisa yang belum dibayar akan ditagihkan kemudian
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Bank Account Info -->
                <div class="border-t border-slate-200 pt-6">
                    <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-4">Rekening Pembayaran</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-slate-50 rounded-lg p-4">
                            <p class="text-xs text-slate-500 mb-1">Bank</p>
                            <p class="font-semibold text-slate-900">BCA</p>
                        </div>
                        <div class="bg-slate-50 rounded-lg p-4">
                            <p class="text-xs text-slate-500 mb-1">Nomor Rekening</p>
                            <p class="font-semibold text-slate-900">1234567890</p>
                        </div>
                        <div class="bg-slate-50 rounded-lg p-4">
                            <p class="text-xs text-slate-500 mb-1">Atas Nama</p>
                            <p class="font-semibold text-slate-900">{{ $companyName }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Footer Notes -->
                <div class="mt-8 pt-6 border-t border-slate-200">
                    <p class="text-sm text-slate-500 text-center">
                        Terima kasih atas kepercayaan Anda. Untuk pertanyaan lebih lanjut, silakan hubungi kami.
                    </p>
                    <p class="text-xs text-slate-400 text-center mt-2">
                        Invoice ini dibuat secara elektronik dan sah tanpa tanda tangan.
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Print Styles (Hidden on Screen) -->
        <style media="print">
            @page {
                margin: 0;
                size: auto;
            }
            body {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }
            .no-print {
                display: none !important;
            }
        </style>
    </div>
</x-layout.app>
