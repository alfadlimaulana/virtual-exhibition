@props(['disabled' => false])

<label {{ $attributes->class(['block mb-2 text-sm font-medium text-gray-900', 'text-gray-400' => $disabled]) }}>
    {{ $slot }}
</label>