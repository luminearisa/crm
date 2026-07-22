@props(['class' => '', 'padding' => 'p-6'])

<div {{ $attributes->merge(['class' => "bg-white rounded-xl shadow-sm border border-slate-200 {$padding} {$class}"]) }}>
    {{ $slot }}
</div>
