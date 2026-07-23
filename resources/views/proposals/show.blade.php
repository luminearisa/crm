<x-layout.app>
    <x-slot name="title">Proposal Details</x-slot>
    <x-slot name="subtitle">{{ $proposal->proposal_number }}</x-slot>

    <div class="space-y-6">
        <!-- Header Actions -->
        <div class="flex justify-between items-center">
            <a href="{{ route('proposals.index') }}" class="text-blue-600 hover:text-blue-900 flex items-center">
                <ion-icon name="arrow-back-outline" class="mr-2"></ion-icon>
                Back to Proposals
            </a>
            <div class="flex space-x-3">
                @if($proposal->status === 'accepted')
                <a href="{{ route('invoices.create', ['proposal_id' => $proposal->id]) }}" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    <ion-icon name="cash-outline" class="mr-2"></ion-icon>
                    Create Invoice
                </a>
                @endif
                <a href="{{ route('proposals.edit', $proposal) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                    <ion-icon name="create-outline" class="mr-2"></ion-icon>
                    Edit
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Proposal Info Card -->
                <x-ui.card>
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">{{ $proposal->lead->title ?? 'N/A' }}</h2>
                            <p class="text-gray-500 mt-1">{{ $proposal->lead->client->company_name ?? 'N/A' }}</p>
                        </div>
                        @php
                            $statusColors = [
                                'draft' => 'gray',
                                'sent' => 'yellow',
                                'accepted' => 'green',
                                'rejected' => 'red',
                                'expired' => 'gray'
                            ];
                        @endphp
                        <x-ui.badge :color="$statusColors[$proposal->status] ?? 'gray'" class="text-lg">
                            {{ ucfirst($proposal->status) }}
                        </x-ui.badge>
                    </div>

                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Proposal Items</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Service</th>
                                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Qty</th>
                                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Price</th>
                                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($proposal->items as $item)
                                    <tr>
                                        <td class="px-4 py-3 text-sm text-gray-900">{{ $item->service->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 text-sm text-right text-gray-900">{{ $item->qty }}</td>
                                        <td class="px-4 py-3 text-sm text-right text-gray-900">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 text-sm text-right font-medium text-gray-900">Rp {{ number_format($item->qty * $item->price, 0, ',', '.') }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-8 text-center text-gray-500">No items in this proposal</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                <tfoot class="bg-gray-50">
                                    <tr>
                                        <td colspan="3" class="px-4 py-3 text-right text-sm font-medium text-gray-900">Subtotal:</td>
                                        <td class="px-4 py-3 text-right text-sm font-medium text-gray-900">Rp {{ number_format($proposal->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                    @if($proposal->discount > 0)
                                    <tr>
                                        <td colspan="3" class="px-4 py-3 text-right text-sm font-medium text-gray-900">Discount ({{ $proposal->discount_rate }}%):</td>
                                        <td class="px-4 py-3 text-right text-sm font-medium text-red-600">- Rp {{ number_format($proposal->discount, 0, ',', '.') }}</td>
                                    </tr>
                                    @endif
                                    @if($proposal->tax_amount > 0)
                                    <tr>
                                        <td colspan="3" class="px-4 py-3 text-right text-sm font-medium text-gray-900">Tax ({{ $proposal->tax_rate }}%):</td>
                                        <td class="px-4 py-3 text-right text-sm font-medium text-gray-900">Rp {{ number_format($proposal->tax_amount, 0, ',', '.') }}</td>
                                    </tr>
                                    @endif
                                    <tr class="bg-blue-50">
                                        <td colspan="3" class="px-4 py-4 text-right text-base font-bold text-gray-900">Total Amount:</td>
                                        <td class="px-4 py-4 text-right text-base font-bold text-blue-600">Rp {{ number_format($proposal->total_amount, 0, ',', '.') }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    @if($proposal->notes)
                    <div class="border-t border-gray-200 mt-6 pt-6">
                        <h4 class="text-sm font-medium text-gray-900 mb-2">Notes</h4>
                        <p class="text-sm text-gray-600">{{ $proposal->notes }}</p>
                    </div>
                    @endif

                    @if($proposal->terms_and_conditions)
                    <div class="border-t border-gray-200 mt-6 pt-6">
                        <h4 class="text-sm font-medium text-gray-900 mb-2">Terms & Conditions</h4>
                        <p class="text-sm text-gray-600">{{ $proposal->terms_and_conditions }}</p>
                    </div>
                    @endif
                </x-ui.card>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <x-ui.card>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Proposal Information</h3>
                    <dl class="space-y-3">
                        <div>
                            <dt class="text-sm text-gray-500">Proposal Number</dt>
                            <dd class="text-sm font-medium text-gray-900">{{ $proposal->proposal_number }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500">Issue Date</dt>
                            <dd class="text-sm font-medium text-gray-900">{{ $proposal->issue_date ? $proposal->issue_date->format('d M Y') : 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500">Valid Until</dt>
                            <dd class="text-sm font-medium text-gray-900">{{ $proposal->valid_until ? $proposal->valid_until->format('d M Y') : 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500">Created At</dt>
                            <dd class="text-sm font-medium text-gray-900">{{ $proposal->created_at->format('d M Y H:i') }}</dd>
                        </div>
                    </dl>
                </x-ui.card>

                <x-ui.card>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Client Information</h3>
                    <dl class="space-y-3">
                        <div>
                            <dt class="text-sm text-gray-500">Company Name</dt>
                            <dd class="text-sm font-medium text-gray-900">{{ $proposal->lead->client->company_name ?? 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500">Contact Person</dt>
                            <dd class="text-sm font-medium text-gray-900">{{ $proposal->lead->client->contact_person ?? 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500">Email</dt>
                            <dd class="text-sm font-medium text-gray-900">{{ $proposal->lead->client->email ?? 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500">Phone</dt>
                            <dd class="text-sm font-medium text-gray-900">{{ $proposal->lead->client->phone ?? 'N/A' }}</dd>
                        </div>
                    </dl>
                </x-ui.card>

                <x-ui.card>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Actions</h3>
                    <div class="space-y-2">
                        @if($proposal->status !== 'accepted' && $proposal->status !== 'rejected')
                        <form action="{{ route('proposals.update-status', $proposal) }}" method="POST" class="space-y-2">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="sent">
                            <button type="submit" class="w-full px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 text-sm">
                                <ion-icon name="send-outline" class="mr-1"></ion-icon>
                                Mark as Sent
                            </button>
                        </form>
                        <form action="{{ route('proposals.update-status', $proposal) }}" method="POST" class="space-y-2">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="accepted">
                            <button type="submit" class="w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 text-sm">
                                <ion-icon name="checkmark-circle-outline" class="mr-1"></ion-icon>
                                Mark as Accepted
                            </button>
                        </form>
                        <form action="{{ route('proposals.update-status', $proposal) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm">
                                <ion-icon name="close-circle-outline" class="mr-1"></ion-icon>
                                Mark as Rejected
                            </button>
                        </form>
                        @endif
                    </div>
                </x-ui.card>
            </div>
        </div>
    </div>
</x-layout.app>
