<x-layout.app>
    <x-slot name="title">Edit Tugas</x-slot>
    <x-slot name="subtitle">Update informasi tugas</x-slot>

    <x-ui.card>
        <form action="{{ route('tasks.update', $task) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="md:col-span-2">
                    <label for="title" class="block text-sm font-medium text-slate-700 mb-2">Judul Tugas *</label>
                    <x-ui.input 
                        type="text" 
                        id="title" 
                        name="title" 
                        :value="old('title', $task->title)"
                        required
                        placeholder="Contoh: Follow up klien PT Maju"
                    />
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-slate-700 mb-2">Deskripsi</label>
                    <textarea 
                        id="description" 
                        name="description" 
                        rows="4"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                        placeholder="Detail tugas yang perlu dilakukan..."
                    >{{ old('description', $task->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Due Date -->
                <div>
                    <label for="due_date" class="block text-sm font-medium text-slate-700 mb-2">Tanggal Jatuh Tempo *</label>
                    <x-ui.input 
                        type="date" 
                        id="due_date" 
                        name="due_date" 
                        :value="old('due_date', $task->due_date->format('Y-m-d'))"
                        required
                    />
                    @error('due_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-slate-700 mb-2">Status</label>
                    <x-ui.select id="status" name="status">
                        <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                    </x-ui.select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-end space-x-3 pt-6 border-t border-slate-200">
                <x-ui.button href="{{ route('tasks.index') }}" variant="secondary">
                    Batal
                </x-ui.button>
                <x-ui.button type="submit" variant="primary">
                    <ion-icon name="save" class="mr-2"></ion-icon>
                    Update Tugas
                </x-ui.button>
            </div>
        </form>
    </x-ui.card>
</x-layout.app>
