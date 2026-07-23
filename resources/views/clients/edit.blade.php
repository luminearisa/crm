<x-layout.app>
    <x-slot name="title">Edit Klien</x-slot>
    <x-slot name="subtitle">Update informasi klien</x-slot>

    <x-ui.card>
        <form action="{{ route('clients.update', $client) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Company Name -->
                <div>
                    <label for="company_name" class="block text-sm font-medium text-slate-700 mb-2">Nama Perusahaan *</label>
                    <x-ui.input 
                        type="text" 
                        id="company_name" 
                        name="company_name" 
                        :value="old('company_name', $client->company_name)"
                        required
                        placeholder="PT Contoh Perusahaan"
                    />
                    @error('company_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Contact Person -->
                <div>
                    <label for="contact_person" class="block text-sm font-medium text-slate-700 mb-2">Kontak Person *</label>
                    <x-ui.input 
                        type="text" 
                        id="contact_person" 
                        name="contact_person" 
                        :value="old('contact_person', $client->contact_person)"
                        required
                        placeholder="Nama kontak person"
                    />
                    @error('contact_person')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-2">Email *</label>
                    <x-ui.input 
                        type="email" 
                        id="email" 
                        name="email" 
                        :value="old('email', $client->email)"
                        required
                        placeholder="email@perusahaan.com"
                    />
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-slate-700 mb-2">Telepon *</label>
                    <x-ui.input 
                        type="text" 
                        id="phone" 
                        name="phone" 
                        :value="old('phone', $client->phone)"
                        required
                        placeholder="0812-3456-7890"
                    />
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- PIC Internal -->
                <div>
                    <label for="user_id" class="block text-sm font-medium text-slate-700 mb-2">PIC Internal</label>
                    <x-ui.select id="user_id" name="user_id">
                        <option value="">Pilih PIC...</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id', $client->user_id) == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ ucfirst($user->role) }})
                            </option>
                        @endforeach
                    </x-ui.select>
                    @error('user_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Address -->
                <div class="md:col-span-2">
                    <label for="address" class="block text-sm font-medium text-slate-700 mb-2">Alamat Lengkap *</label>
                    <textarea 
                        id="address" 
                        name="address" 
                        rows="3"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                        required
                        placeholder="Jl. Contoh No. 123, Jakarta"
                    >{{ old('address', $client->address) }}</textarea>
                    @error('address')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-end space-x-3 pt-6 border-t border-slate-200">
                <x-ui.button href="{{ route('clients.show', $client) }}" variant="secondary">
                    Batal
                </x-ui.button>
                <x-ui.button type="submit" variant="primary">
                    <ion-icon name="save" class="mr-2"></ion-icon>
                    Update Klien
                </x-ui.button>
            </div>
        </form>
    </x-ui.card>
</x-layout.app>
