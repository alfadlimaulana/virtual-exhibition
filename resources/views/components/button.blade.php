@props(['disabled' => false])

<button {{ $attributes->class(['inline-flex items-center justify-center rounded-md font-medium px-4 py-2 text-center text-sm focus:outline-none', 'opacity-50 cursor-default' => $disabled]) }}>
    {{ $slot }}
</button>