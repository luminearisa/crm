@props([
    'name',
    'label' => null,
    'options' => [],
    'value' => null,
    'placeholder' => 'Pilih opsi...',
    'required' => false,
    'disabled' => false,
    'error' => null,
])

<div class="w-full">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-slate-700 mb-1">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif
    
    <select 
        id="{{ $name }}" 
        name="{{ $name }}" 
        @if($required) required @endif
        @if($disabled) disabled @endif
        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-colors appearance-none bg-white
            {{ $error ? 'border-red-500 bg-red-50' : 'border-slate-300' }}
            {{ $disabled ? 'bg-slate-100 cursor-not-allowed' : '' }}"
        {{ $attributes }}
    >
        <option value="">{{ $placeholder }}</option>
        @foreach($options as $key => $option)
            @php
                $optionValue = is_array($option) ? ($option['value'] ?? $key) : $key;
                $optionLabel = is_array($option) ? ($option['label'] ?? $option) : $option;
            @endphp
            <option 
                value="{{ $optionValue }}" 
                @if(old($name, $value) == $optionValue) selected @endif
            >
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>
    
    <!-- Custom arrow icon -->
    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
        <ion-icon name="chevron-down" class="text-slate-400"></ion-icon>
    </div>
    
    @if($error)
        <p class="mt-1 text-xs text-red-600">{{ $error }}</p>
    @elseif($errors->has($name))
        <p class="mt-1 text-xs text-red-600">{{ $errors->first($name) }}</p>
    @endif
</div>
