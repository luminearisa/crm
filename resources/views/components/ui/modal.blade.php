@props([
    'id' => 'modal',
    'title' => 'Modal',
    'show' => false,
    'maxWidth' => 'lg',
])

@php
$maxWidthClasses = [
    'sm' => 'sm:max-w-md',
    'md' => 'sm:max-w-lg',
    'lg' => 'sm:max-w-2xl',
    'xl' => 'sm:max-w-4xl',
    '2xl' => 'sm:max-w-6xl',
];
@endphp

<div 
    x-data="{ showModal: @js($show) }"
    x-on:open-modal.window="showModal = true"
    x-on:close-modal.window="showModal = false"
    x-show="showModal"
    x-cloak
    class="fixed inset-0 z-50 overflow-y-auto"
    style="display: none;"
>
    <!-- Backdrop -->
    <div 
        x-show="showModal"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/50 transition-opacity"
        @click="showModal = false"
    ></div>
    
    <!-- Modal Panel -->
    <div class="flex min-h-full items-center justify-center p-4">
        <div 
            x-show="showModal"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative bg-white rounded-xl shadow-xl {{ $maxWidthClasses[$maxWidth] ?? $maxWidthClasses['lg'] }} w-full overflow-hidden"
            @click.stop
        >
            <!-- Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200">
                <h3 class="text-lg font-semibold text-slate-900">
                    {{ $title }}
                </h3>
                <button 
                    @click="showModal = false"
                    class="p-2 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors"
                >
                    <ion-icon name="close" class="text-xl"></ion-icon>
                </button>
            </div>
            
            <!-- Body -->
            <div class="px-6 py-4">
                {{ $slot }}
            </div>
            
            <!-- Footer (Optional) -->
            @if(isset($footer))
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-200 flex justify-end space-x-3">
                {{ $footer }}
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Script to handle modal events -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    window.openModal = function(modalId) {
        window.dispatchEvent(new CustomEvent('open-modal', { detail: { id: modalId } }));
    };
    
    window.closeModal = function(modalId) {
        window.dispatchEvent(new CustomEvent('close-modal', { detail: { id: modalId } }));
    };
});
</script>
