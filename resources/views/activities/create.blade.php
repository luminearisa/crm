<x-layout.app>
    <x-slot name="title">Tambah Aktivitas</x-slot>
    <x-slot name="subtitle">Catat interaksi baru dengan lead</x-slot>

    <x-ui.card>
        <form action="{{ route('activities.store') }}" method="POST">
            @csrf
            
            <div class="space-y-6">
                <x-ui.select 
                    name="lead_id" 
                    label="Pilih Lead" 
                    :required="true"
                    :value="old('lead_id')"
                >
                    <option value="">-- Pilih Lead --</option>
                    @foreach($leads as $lead)
                        <option value="{{ $lead->id }}" {{ old('lead_id') == $lead->id ? 'selected' : '' }}>
                            {{ $lead->title }} ({{ $lead->client->company_name ?? '-' }})
                        </option>
                    @endforeach
                </x-ui.select>

                <x-ui.select 
                    name="type" 
                    label="Tipe Aktivitas" 
                    :required="true"
                    :value="old('type')"
                >
                    <option value="">-- Pilih Tipe --</option>
                    <option value="call" {{ old('type') === 'call' ? 'selected' : '' }}>Telepon</option>
                    <option value="email" {{ old('type') === 'email' ? 'selected' : '' }}>Email</option>
                    <option value="meeting" {{ old('type') === 'meeting' ? 'selected' : '' }}>Meeting</option>
                </x-ui.select>

                <x-ui.input 
                    type="date"
                    name="activity_date" 
                    label="Tanggal Aktivitas" 
                    :required="true"
                    :value="old('activity_date', date('Y-m-d'))"
                />

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Catatan</label>
                    <textarea 
                        name="notes" 
                        rows="4" 
                        class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('notes') border-red-500 @enderror"
                        placeholder="Deskripsikan hasil interaksi..."
                    >{{ old('notes') }}</textarea>
                    @error('notes')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-3 pt-4 border-t">
                    <x-ui.button href="{{ route('activities.index') }}" variant="secondary">
                        Batal
                    </x-ui.button>
                    <x-ui.button type="submit" variant="primary">
                        Simpan Aktivitas
                    </x-ui.button>
                </div>
            </div>
        </form>
    </x-ui.card>
</x-layout.app>
