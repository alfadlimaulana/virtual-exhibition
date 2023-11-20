@props(['disabled' => false])

<a {{ $attributes->merge(['class' => 'inline-flex items-center justify-center rounded-md font-medium px-6 py-2.5 text-center text-sm focus:outline-none cursor-pointer'.($disabled?' opacity-50 cursor-default':'')]) }}>
    {{ $slot }}
</a>