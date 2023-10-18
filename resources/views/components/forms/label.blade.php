@props(['disabled' => false])

<label {{ $attributes->merge(['class' => 'block mb-2 text-sm font-medium'.($disabled? ' text-gray-400': ' text-gray-900')]) }}>
    {{ $slot }}
</label>