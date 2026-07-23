<x-layout.app>
    <x-slot name="title">Edit Proposal</x-slot>
    <x-slot name="subtitle">Update quotation details</x-slot>

    <form action="{{ route('proposals.update', $proposal) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-ui.card>
                <h3 class="text-lg font-semibold text-slate-800 mb-4">Proposal Information</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Lead</label>
                        <select name="lead_id" required
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            @foreach($leads as $lead)
                                <option value="{{ $lead->id }}" {{ $lead->id == $proposal->lead_id ? 'selected' : '' }}>
                                    {{ $lead->title }} - {{ $lead->client->company_name ?? 'N/A' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Status</label>
                        <select name="status" required
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="draft" {{ $proposal->status == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="sent" {{ $proposal->status == 'sent' ? 'selected' : '' }}>Sent</option>
                            <option value="accepted" {{ $proposal->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                            <option value="rejected" {{ $proposal->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            <option value="expired" {{ $proposal->status == 'expired' ? 'selected' : '' }}>Expired</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Issue Date</label>
                        <input type="date" name="issue_date" value="{{ $proposal->issue_date?->format('Y-m-d') }}" 
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Valid Until</label>
                        <input type="date" name="valid_until" value="{{ $proposal->valid_until?->format('Y-m-d') }}" 
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
            </x-ui.card>

            <x-ui.card>
                <h3 class="text-lg font-semibold text-slate-800 mb-4">Financial Details</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Tax Rate (%)</label>
                        <input type="number" name="tax_rate" step="0.01" value="{{ $proposal->tax_rate }}" 
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Discount (%)</label>
                        <input type="number" name="discount" step="0.01" value="{{ $proposal->discount }}" 
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="pt-4 border-t border-slate-200">
                        <div class="flex justify-between mb-2">
                            <span class="text-slate-600">Subtotal:</span>
                            <span class="font-medium">Rp {{ number_format($proposal->subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="text-slate-600">Tax:</span>
                            <span class="font-medium">Rp {{ number_format($proposal->tax_amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-lg font-bold text-blue-600">
                            <span>Total:</span>
                            <span>Rp {{ number_format($proposal->total_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </x-ui.card>
        </div>

        <x-ui.card>
            <h3 class="text-lg font-semibold text-slate-800 mb-4">Proposal Items</h3>
            
            <div id="items-container" class="space-y-4">
                @foreach($proposal->items as $index => $item)
                    <div class="item-row grid grid-cols-12 gap-4 items-end">
                        <div class="col-span-5">
                            <label class="block text-sm font-medium text-slate-700 mb-1">Service</label>
                            <select name="items[{{ $index }}][service_id]" required
                                class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" {{ $item->service_id == $service->id ? 'selected' : '' }}>
                                        {{ $service->name }} (Rp {{ number_format($service->base_price, 0, ',', '.') }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-slate-700 mb-1">Qty</label>
                            <input type="number" name="items[{{ $index }}][qty]" value="{{ $item->qty }}" min="1" required
                                class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="col-span-3">
                            <label class="block text-sm font-medium text-slate-700 mb-1">Price</label>
                            <input type="number" name="items[{{ $index }}][price]" value="{{ $item->price }}" min="0" required
                                class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="col-span-2">
                            <button type="button" onclick="this.parentElement.parentElement.remove()" 
                                class="w-full px-3 py-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition-colors">
                                <ion-icon name="trash-outline"></ion-icon>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <button type="button" onclick="addItem()" 
                class="mt-4 inline-flex items-center px-4 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition-colors">
                <ion-icon name="add-circle-outline" class="mr-2"></ion-icon>
                Add Item
            </button>
        </x-ui.card>

        <x-ui.card>
            <h3 class="text-lg font-semibold text-slate-800 mb-4">Additional Information</h3>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Notes</label>
                    <textarea name="notes" rows="3" 
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ $proposal->notes }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Terms & Conditions</label>
                    <textarea name="terms_and_conditions" rows="4" 
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ $proposal->terms_and_conditions }}</textarea>
                </div>
            </div>
        </x-ui.card>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('proposals.index') }}" 
                class="px-6 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition-colors">
                Cancel
            </a>
            <button type="submit" 
                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                Update Proposal
            </button>
        </div>
    </form>

    <script>
        let itemCount = {{ count($proposal->items) }};
        
        function addItem() {
            const container = document.getElementById('items-container');
            const html = `
                <div class="item-row grid grid-cols-12 gap-4 items-end">
                    <div class="col-span-5">
                        <label class="block text-sm font-medium text-slate-700 mb-1">Service</label>
                        <select name="items[${itemCount}][service_id]" required
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }} (Rp {{ number_format($service->base_price, 0, ',', '.') }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-1">Qty</label>
                        <input type="number" name="items[${itemCount}][qty]" value="1" min="1" required
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="col-span-3">
                        <label class="block text-sm font-medium text-slate-700 mb-1">Price</label>
                        <input type="number" name="items[${itemCount}][price]" value="0" min="0" required
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="col-span-2">
                        <button type="button" onclick="this.parentElement.parentElement.remove()" 
                            class="w-full px-3 py-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition-colors">
                            <ion-icon name="trash-outline"></ion-icon>
                        </button>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
            itemCount++;
        }
    </script>
</x-layout.app>
