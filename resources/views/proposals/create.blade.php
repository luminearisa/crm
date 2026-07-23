<x-layout.app>
    <x-slot name="title">Create Proposal</x-slot>
    <x-slot name="subtitle">Create a new proposal for your client</x-slot>

    <div class="max-w-4xl mx-auto">
        <x-ui.card>
            <form action="{{ route('proposals.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Select Lead -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Select Lead *</label>
                    <select name="lead_id" id="lead_id" required 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('lead_id') border-red-500 @enderror">
                        <option value="">Choose a lead...</option>
                        @foreach($leads as $lead)
                        <option value="{{ $lead->id }}" {{ old('lead_id') == $lead->id ? 'selected' : '' }}>
                            {{ $lead->title }} - {{ $lead->client->company_name ?? 'N/A' }}
                        </option>
                        @endforeach
                    </select>
                    @error('lead_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Issue Date & Valid Until -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Issue Date *</label>
                        <input type="date" name="issue_date" value="{{ old('issue_date', date('Y-m-d')) }}" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('issue_date') border-red-500 @enderror">
                        @error('issue_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Valid Until *</label>
                        <input type="date" name="valid_until" value="{{ old('valid_until', date('Y-m-d', strtotime('+14 days'))) }}" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('valid_until') border-red-500 @enderror">
                        @error('valid_until')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Tax Rate & Discount -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tax Rate (%)</label>
                        <input type="number" name="tax_rate" value="{{ old('tax_rate', 11) }}" step="0.01" min="0" max="100"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('tax_rate') border-red-500 @enderror">
                        @error('tax_rate')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Discount (%)</label>
                        <input type="number" name="discount_rate" value="{{ old('discount_rate', 0) }}" step="0.01" min="0" max="100"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('discount_rate') border-red-500 @enderror">
                        @error('discount_rate')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Proposal Items -->
                <div id="items-container" class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-900">Proposal Items</h3>
                    <div class="item-row space-y-4 p-4 bg-gray-50 rounded-lg">
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-6">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Service *</label>
                                <select name="items[0][service_id]" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                    <option value="">Choose service...</option>
                                    @foreach($services as $service)
                                    <option value="{{ $service->id }}" data-price="{{ $service->base_price }}">{{ $service->name }} (Rp {{ number_format($service->base_price, 0, ',', '.') }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Qty *</label>
                                <input type="number" name="items[0][qty]" value="1" min="1" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div class="col-span-3">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Price *</label>
                                <input type="number" name="items[0][price]" value="0" min="0" required class="price-input w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div class="col-span-1 flex items-end">
                                <button type="button" class="remove-item-btn px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600" disabled>
                                    <ion-icon name="trash-outline"></ion-icon>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="button" id="add-item-btn" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                    <ion-icon name="add-outline" class="mr-1"></ion-icon>
                    Add Item
                </button>

                <!-- Notes & Terms -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                    <textarea name="notes" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('notes') border-red-500 @enderror">{{ old('notes') }}</textarea>
                    @error('notes')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Terms & Conditions</label>
                    <textarea name="terms_and_conditions" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('terms_and_conditions') border-red-500 @enderror">{{ old('terms_and_conditions') }}</textarea>
                    @error('terms_and_conditions')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="flex justify-end space-x-3 pt-6 border-t">
                    <a href="{{ route('proposals.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Create Proposal
                    </button>
                </div>
            </form>
        </x-ui.card>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let itemCount = 1;
            const container = document.getElementById('items-container');
            const addButton = document.getElementById('add-item-btn');

            // Auto-fill price when service is selected
            container.addEventListener('change', function(e) {
                if (e.target.tagName === 'SELECT' && e.target.classList.contains('service-select')) {
                    const option = e.target.options[e.target.selectedIndex];
                    const price = option.getAttribute('data-price');
                    const row = e.target.closest('.item-row');
                    const priceInput = row.querySelector('.price-input');
                    if (price && priceInput) {
                        priceInput.value = price;
                    }
                }
            });

            // Add new item row
            addButton.addEventListener('click', function() {
                const newRow = document.createElement('div');
                newRow.className = 'item-row space-y-4 p-4 bg-gray-50 rounded-lg mt-4';
                newRow.innerHTML = `
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-6">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Service *</label>
                            <select name="items[${itemCount}][service_id]" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 service-select">
                                <option value="">Choose service...</option>
                                @foreach($services as $service)
                                <option value="{{ $service->id }}" data-price="{{ $service->base_price }}">{{ $service->name }} (Rp {{ number_format($service->base_price, 0, ',', '.') }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Qty *</label>
                            <input type="number" name="items[${itemCount}][qty]" value="1" min="1" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="col-span-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Price *</label>
                            <input type="number" name="items[${itemCount}][price]" value="0" min="0" required class="price-input w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="col-span-1 flex items-end">
                            <button type="button" class="remove-item-btn px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                <ion-icon name="trash-outline"></ion-icon>
                            </button>
                        </div>
                    </div>
                `;
                container.appendChild(newRow);
                itemCount++;
            });

            // Remove item row
            container.addEventListener('click', function(e) {
                if (e.target.closest('.remove-item-btn')) {
                    const btn = e.target.closest('.remove-item-btn');
                    const row = btn.closest('.item-row');
                    if (container.querySelectorAll('.item-row').length > 1) {
                        row.remove();
                    } else {
                        alert('At least one item is required');
                    }
                }
            });
        });
    </script>
    @endpush
</x-layout.app>
