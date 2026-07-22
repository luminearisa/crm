@props([
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'disabled' => false,
    'href' => null,
])

@php
$baseClasses = 'inline-flex items-center justify-center font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2';

$variantClasses = [
    'primary' => 'bg-primary-600 text-white hover:bg-primary-700 focus:ring-primary-500',
    'secondary' => 'bg-slate-100 text-slate-700 hover:bg-slate-200 focus:ring-slate-500',
    'success' => 'bg-green-600 text-white hover:bg-green-700 focus:ring-green-500',
    'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-500',
    'warning' => 'bg-yellow-500 text-white hover:bg-yellow-600 focus:ring-yellow-400',
];

$sizeClasses = [
    'sm' => 'px-3 py-1.5 text-xs',
    'md' => 'px-4 py-2 text-sm',
    'lg' => 'px-6 py-3 text-base',
];

$classes = $baseClasses . ' ' . ($variantClasses[$variant] ?? $variantClasses['primary']) . ' ' . ($sizeClasses[$size] ?? $sizeClasses['md']);

if ($disabled) {
    $classes .= ' opacity-50 cursor-not-allowed';
}
@endphp

@if($href && !$disabled)
    <a href="{{ $href }}" class="{{ $classes }}" {{ $attributes }}>
        @if(isset($icon))
            <ion-icon name="{{ $icon }}" class="mr-2"></ion-icon>
        @endif
        {{ $slot }}
    </a>
@else
    <button 
        type="{{ $type }}" 
        class="{{ $classes }}" 
        {{ $attributes }}
        @if($disabled) disabled @endif
    >
        @if(isset($icon))
            <ion-icon name="{{ $icon }}" class="mr-2"></ion-icon>
        @endif
        {{ $slot }}
    </button>
@endif
