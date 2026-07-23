<x-layout.app>
    <x-slot name="title">Events Calendar</x-slot>
    <x-slot name="subtitle">Manage your schedule and appointments</x-slot>

    <div class="flex justify-between items-center mb-6">
        <div class="relative w-64">
            <input type="text" placeholder="Search events..." 
                class="w-full pl-10 pr-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <ion-icon name="search-outline" class="absolute left-3 top-2.5 text-slate-400"></ion-icon>
        </div>
        <a href="{{ route('events.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
            <ion-icon name="add-circle-outline" class="mr-2"></ion-icon>
            New Event
        </a>
    </div>

    <x-ui.card>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Date & Time</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Location</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Created By</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @forelse($events as $event)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                                        <ion-icon name="calendar-outline" class="h-6 w-6 text-blue-600"></ion-icon>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-slate-900">{{ $event->title }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-slate-900">{{ $event->start_time->format('d M Y') }}</div>
                                <div class="text-sm text-slate-500">{{ $event->start_time->format('H:i') }} - {{ $event->end_time->format('H:i') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                {{ $event->location ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                {{ $event->user->name ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    <a href="{{ route('events.show', $event) }}" class="text-blue-600 hover:text-blue-900">
                                        <ion-icon name="eye-outline"></ion-icon>
                                    </a>
                                    <a href="{{ route('events.edit', $event) }}" class="text-amber-600 hover:text-amber-900">
                                        <ion-icon name="create-outline"></ion-icon>
                                    </a>
                                    <form action="{{ route('events.destroy', $event) }}" method="POST" class="inline" onsubmit="return confirm('Delete this event?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            <ion-icon name="trash-outline"></ion-icon>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                                <ion-icon name="calendar-outline" class="text-4xl mb-2 block mx-auto"></ion-icon>
                                No events scheduled.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($events->hasPages())
            <div class="mt-4">
                {{ $events->links() }}
            </div>
        @endif
    </x-ui.card>
</x-layout.app>
