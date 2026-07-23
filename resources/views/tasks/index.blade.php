<x-layout.app>
    <x-slot name="title">Manajemen Tugas</x-slot>
    <x-slot name="subtitle">Kelola tugas dan to-do list Anda</x-slot>

    <div class="space-y-6">
        <!-- Header Actions -->
        <div class="flex justify-between items-center">
            <div class="flex space-x-3">
                <a href="{{ route('tasks.create') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700">
                    <ion-icon name="add" class="mr-2"></ion-icon>
                    Tambah Tugas
                </a>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('tasks.index') }}" class="px-3 py-2 rounded-lg {{ request('filter') == '' ? 'bg-primary-100 text-primary-700' : 'text-slate-600 hover:bg-slate-100' }}">
                    Semua
                </a>
                <a href="{{ route('tasks.index', ['filter' => 'pending']) }}" class="px-3 py-2 rounded-lg {{ request('filter') == 'pending' ? 'bg-yellow-100 text-yellow-700' : 'text-slate-600 hover:bg-slate-100' }}">
                    Pending
                </a>
                <a href="{{ route('tasks.index', ['filter' => 'in_progress']) }}" class="px-3 py-2 rounded-lg {{ request('filter') == 'in_progress' ? 'bg-blue-100 text-blue-700' : 'text-slate-600 hover:bg-slate-100' }}">
                    Proses
                </a>
                <a href="{{ route('tasks.index', ['filter' => 'completed']) }}" class="px-3 py-2 rounded-lg {{ request('filter') == 'completed' ? 'bg-green-100 text-green-700' : 'text-slate-600 hover:bg-slate-100' }}">
                    Selesai
                </a>
            </div>
        </div>

        <!-- Tasks Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($tasks as $task)
            <x-ui.card class="hover:shadow-lg transition-shadow">
                <div class="flex justify-between items-start mb-3">
                    <x-ui.badge :status="$task->status" />
                    <div class="flex space-x-2">
                        <a href="{{ route('tasks.edit', $task) }}" class="text-slate-400 hover:text-blue-600">
                            <ion-icon name="create"></ion-icon>
                        </a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline" onsubmit="return confirm('Hapus tugas ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-slate-400 hover:text-red-600">
                                <ion-icon name="trash"></ion-icon>
                            </button>
                        </form>
                    </div>
                </div>
                
                <h3 class="text-lg font-semibold text-slate-900 mb-2">{{ $task->title }}</h3>
                <p class="text-sm text-slate-600 mb-4 line-clamp-2">{{ $task->description }}</p>
                
                <div class="flex items-center justify-between text-sm text-slate-500 pt-4 border-t border-slate-100">
                    <div class="flex items-center">
                        <ion-icon name="calendar" class="mr-2"></ion-icon>
                        {{ $task->due_date->format('d M Y') }}
                    </div>
                    @if($task->isOverdue())
                        <span class="text-red-600 font-medium">Terlambat</span>
                    @endif
                </div>
            </x-ui.card>
            @empty
            <div class="col-span-full text-center py-12">
                <ion-icon name="checkbox-outline" class="text-6xl text-slate-300 mb-4"></ion-icon>
                <p class="text-slate-500 text-lg">Belum ada tugas</p>
                <a href="{{ route('tasks.create') }}" class="text-primary-600 hover:text-primary-900 mt-2 inline-block">Buat tugas pertama Anda</a>
            </div>
            @endforelse
        </div>

        @if($tasks->hasPages())
        <div class="mt-6">
            {{ $tasks->links() }}
        </div>
        @endif
    </div>
</x-layout.app>
