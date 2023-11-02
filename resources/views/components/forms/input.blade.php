@props(['disabled' => false])

<input {{ $attributes->class(['bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5', 'bg-gray-50 cursor-default' => $disabled])->merge(['type' => 'text']) }}/>