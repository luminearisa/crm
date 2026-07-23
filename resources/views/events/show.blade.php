<x-layout.app>
    <x-slot name="title">{{ $event->title }}</x-slot>
    <x-slot name="subtitle">Event details</x-slot>

    <div class="max-w-4xl mx-auto space-y-6">
        <x-ui.card>
            <div class="flex items-start justify-between mb-6">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0 h-16 w-16 bg-blue-100 rounded-full flex items-center justify-center">
                        <ion-icon name="calendar-outline" class="h-8 w-8 text-blue-600"></ion-icon>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900">{{ $event->title }}</h2>
                        <p class="text-slate-500">Created by {{ $event->user->name ?? 'Unknown' }}</p>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('events.edit', $event) }}" 
                        class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg transition-colors">
                        <ion-icon name="create-outline" class="mr-1"></ion-icon> Edit
                    </a>
                    <form action="{{ route('events.destroy', $event) }}" method="POST" onsubmit="return confirm('Delete this event?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">
                            <ion-icon name="trash-outline" class="mr-1"></ion-icon> Delete
                        </button>
                    </form>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-500 mb-1">Start Date & Time</label>
                        <div class="flex items-center text-slate-900">
                            <ion-icon name="time-outline" class="mr-2 text-blue-600"></ion-icon>
                            {{ $event->start_time->format('d F Y, H:i') }}
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-500 mb-1">End Date & Time</label>
                        <div class="flex items-center text-slate-900">
                            <ion-icon name="time-outline" class="mr-2 text-blue-600"></ion-icon>
                            {{ $event->end_time->format('d F Y, H:i') }}
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-500 mb-1">Duration</label>
                        <div class="flex items-center text-slate-900">
                            <ion-icon name="hourglass-outline" class="mr-2 text-blue-600"></ion-icon>
                            {{ $event->start_time->diffInHours($event->end_time) }} hours
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-500 mb-1">Location</label>
                        <div class="flex items-center text-slate-900">
                            <ion-icon name="location-outline" class="mr-2 text-blue-600"></ion-icon>
                            {{ $event->location ?? 'No location specified' }}
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-500 mb-1">Created At</label>
                        <div class="flex items-center text-slate-900">
                            <ion-icon name="document-text-outline" class="mr-2 text-blue-600"></ion-icon>
                            {{ $event->created_at->format('d M Y, H:i') }}
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-500 mb-1">Last Updated</label>
                        <div class="flex items-center text-slate-900">
                            <ion-icon name="refresh-outline" class="mr-2 text-blue-600"></ion-icon>
                            {{ $event->updated_at->format('d M Y, H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </x-ui.card>

        @if($event->description)
            <x-ui.card>
                <h3 class="text-lg font-semibold text-slate-800 mb-4">Description</h3>
                <p class="text-slate-700 whitespace-pre-line">{{ $event->description }}</p>
            </x-ui.card>
        @endif

        <div class="flex justify-end">
            <a href="{{ route('events.index') }}" 
                class="inline-flex items-center px-6 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition-colors">
                <ion-icon name="arrow-back-outline" class="mr-2"></ion-icon>
                Back to Events
            </a>
        </div>
    </div>
</x-layout.app>
